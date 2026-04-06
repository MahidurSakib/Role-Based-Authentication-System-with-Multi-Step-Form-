<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'new_password'              => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'confirmed'],
            'new_password_confirmation' => 'required',
        ];

        // Only require current password if NOT a first-login forced change
        if (!$user->is_first_login) {
            $rules['current_password'] = 'required';
        }

        $request->validate($rules);

        // Verify current password for non-first-login changes
        if (!$user->is_first_login) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        }

        $user->update([
            'password'       => Hash::make($request->new_password),
            'is_first_login' => false,
        ]);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('success', '✅ Password changed successfully!');
        }

        return redirect()->route('user.dashboard')
            ->with('success', '✅ Password changed successfully! Welcome to your dashboard.');
    }
}
