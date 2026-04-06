<?php

namespace App\Http\Controllers;

use App\Mail\UserIdMail;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MultiStepFormController extends Controller
{
    // ──────────────────────────────────────────────
    // STEP 1 – Personal Information
    // ──────────────────────────────────────────────

    public function step1()
    {
        return view('form.step1', [
            'formData' => session('form_step1', []),
        ]);
    }

    public function step1Store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|min:2|max:50',
            'last_name'     => 'required|string|min:2|max:50',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|regex:/^[0-9\+\-\s\(\)]{7,20}$/',
            'date_of_birth' => 'required|date|before:-16 years',
            'gender'        => 'required|in:male,female,other,prefer_not_to_say',
        ], [
            'first_name.required'    => 'First name is required.',
            'last_name.required'     => 'Last name is required.',
            'email.unique'           => 'This email is already registered.',
            'phone.regex'            => 'Please enter a valid phone number.',
            'date_of_birth.before'   => 'You must be at least 16 years old to register.',
            'gender.required'        => 'Please select your gender.',
        ]);

        session(['form_step1' => $validated]);

        return redirect()->route('form.step2');
    }

    // ──────────────────────────────────────────────
    // STEP 2 – Address & Professional Info
    // ──────────────────────────────────────────────

    public function step2()
    {
        if (!session('form_step1')) {
            return redirect()->route('form.step1')
                ->with('error', 'Please complete Step 1 first.');
        }

        return view('form.step2', [
            'formData' => session('form_step2', []),
        ]);
    }

    public function step2Store(Request $request)
    {
        if (!session('form_step1')) {
            return redirect()->route('form.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        $validated = $request->validate([
            'address'    => 'required|string|min:5|max:255',
            'city'       => 'required|string|min:2|max:100',
            'state'      => 'required|string|min:2|max:100',
            'country'    => 'required|string|min:2|max:100',
            'zip_code'   => 'required|string|min:3|max:20',
            'occupation' => 'required|string|min:2|max:100',
            'company'    => 'nullable|string|max:100',
            'experience' => 'required|string',
            'skills'     => 'nullable|string|max:500',
            'bio'        => 'nullable|string|max:1000',
        ]);

        session(['form_step2' => $validated]);

        return redirect()->route('form.step3');
    }

    // ──────────────────────────────────────────────
    // STEP 3 – Review & Submit
    // ──────────────────────────────────────────────

    public function step3()
    {
        if (!session('form_step1') || !session('form_step2')) {
            return redirect()->route('form.step1')
                ->with('error', 'Please complete all previous steps first.');
        }

        return view('form.step3', [
            'step1' => session('form_step1'),
            'step2' => session('form_step2'),
        ]);
    }

    public function submit(Request $request)
    {
        $step1 = session('form_step1');
        $step2 = session('form_step2');

        if (!$step1 || !$step2) {
            return redirect()->route('form.step1')
                ->with('error', 'Session expired. Please start again.');
        }

        // Generate unique User ID
        $userUid = $this->generateUserUid();

        // Generate a temporary password
        $tempPassword = 'Welcome@' . rand(1000, 9999);

        // Create the user
        $user = User::create([
            'name'           => $step1['first_name'] . ' ' . $step1['last_name'],
            'email'          => $step1['email'],
            'password'       => Hash::make($tempPassword),
            'role'           => 'user',
            'user_uid'       => $userUid,
            'is_first_login' => true,
        ]);

        // Store form submission
        FormSubmission::create(array_merge(
            ['user_id' => $user->id],
            $step1,
            $step2
        ));

        // Send welcome email
        try {
            Mail::to($user->email)->send(new UserIdMail($user, $tempPassword));
        } catch (\Exception $e) {
            // Log but don't break the flow
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        // Clear session data
        session()->forget(['form_step1', 'form_step2']);

        return redirect()->route('form.success')->with([
            'user_uid'      => $userUid,
            'user_name'     => $user->name,
            'user_email'    => $user->email,
            'temp_password' => $tempPassword,
        ]);
    }

    public function success()
    {
        if (!session('user_uid')) {
            return redirect()->route('form.step1');
        }

        return view('form.success');
    }

    // ──────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────

    private function generateUserUid(): string
    {
        do {
            $uid = 'USR-' . strtoupper(Str::random(3)) . rand(100, 999);
        } while (User::where('user_uid', $uid)->exists());

        return $uid;
    }
}
