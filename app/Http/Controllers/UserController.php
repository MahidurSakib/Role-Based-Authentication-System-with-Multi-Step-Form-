<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user       = auth()->user();
        $submission = $user->formSubmission;

        return view('user.dashboard', compact('user', 'submission'));
    }
}
