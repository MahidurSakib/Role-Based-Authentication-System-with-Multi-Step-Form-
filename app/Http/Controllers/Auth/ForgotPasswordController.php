<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
        ]);

        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_uid';

        $user = User::where($field, $login)->first();

        if (!$user) {
            return back()->withErrors(['login' => 'No account found with that User ID or email.']);
        }

        // Generate a temporary password
        $tempPassword = 'Temp@' . strtoupper(Str::random(6));

        $user->update([
            'password'       => Hash::make($tempPassword),
            'is_first_login' => true,
        ]);

        // Send temporary password via email
        Mail::to($user->email)->send(new \App\Mail\TemporaryPasswordMail($user, $tempPassword));

        return redirect()->route('login')
            ->with('success', '📧 A temporary password has been sent to your registered email address.');
    }
}
