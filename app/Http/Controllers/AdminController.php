<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users'       => User::where('role', 'user')->count(),
            'total_submissions' => FormSubmission::count(),
            'new_today'         => FormSubmission::whereDate('created_at', today())->count(),
            'first_logins'      => User::where('role', 'user')->where('is_first_login', true)->count(),
        ];

        $recentSubmissions = FormSubmission::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions'));
    }

    public function submissions(Request $request)
    {
        $query = FormSubmission::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('user_uid', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%"));
            });
        }

        $submissions = $query->paginate(10)->withQueryString();

        return view('admin.submissions', compact('submissions'));
    }

    public function showSubmission(FormSubmission $submission)
    {
        $submission->load('user');
        return view('admin.show-submission', compact('submission'));
    }

    public function users(Request $request)
    {
        $query = User::where('role', 'user')->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%")
                ->orWhere('user_uid', 'like', "%{$s}%"));
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function toggleUserStatus(User $user)
    {
        // Admin can reset a user's first_login to force password reset
        $user->update(['is_first_login' => !$user->is_first_login]);

        $msg = $user->is_first_login
            ? 'User will be required to change password on next login.'
            : 'User password reset requirement removed.';

        return back()->with('success', $msg);
    }
}
