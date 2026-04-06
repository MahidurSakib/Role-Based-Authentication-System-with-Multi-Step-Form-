<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MultiStepFormController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

// Auth (guests)
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/forgot-password',  [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.forgot');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.forgot.send');
});

// Multi-Step Registration (public)
Route::prefix('register')->name('form.')->group(function () {
    Route::get('/step-1',  [MultiStepFormController::class, 'step1'])->name('step1');
    Route::post('/step-1', [MultiStepFormController::class, 'step1Store'])->name('step1.store');
    Route::get('/step-2',  [MultiStepFormController::class, 'step2'])->name('step2');
    Route::post('/step-2', [MultiStepFormController::class, 'step2Store'])->name('step2.store');
    Route::get('/step-3',  [MultiStepFormController::class, 'step3'])->name('step3');
    Route::post('/submit', [MultiStepFormController::class, 'submit'])->name('submit');
    Route::get('/success', [MultiStepFormController::class, 'success'])->name('success');
});

// Authenticated
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Change password – for all authenticated users
    Route::get('/change-password',  [ChangePasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.change.update');

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard',                [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users',                    [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/toggle',    [AdminController::class, 'toggleUserStatus'])->name('user.toggle');
        Route::get('/submissions',              [AdminController::class, 'submissions'])->name('submissions');
        Route::get('/submissions/{submission}', [AdminController::class, 'showSubmission'])->name('submission.show');
    });

    // User
    Route::middleware(['role:user', 'first.login'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });
});
