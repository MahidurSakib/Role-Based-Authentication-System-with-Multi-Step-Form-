@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
<h2>Welcome back!</h2>
<p class="subtitle">Sign in with your User ID or email address.</p>

<form action="{{ route('login') }}" method="POST" novalidate>
    @csrf

    <!-- Login Field -->
    <div class="mb-4">
        <label class="form-label" for="login">
            <i class="fas fa-fingerprint me-1" style="color:#4F46E5;"></i> User ID or Email
        </label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input
                type="text"
                id="login"
                name="login"
                class="form-control @error('login') is-invalid @enderror"
                value="{{ old('login') }}"
                placeholder="USR-XXXXX or email@example.com"
                autofocus
            >
            @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label class="form-label" for="password">
            <i class="fas fa-lock me-1" style="color:#4F46E5;"></i> Password
        </label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter your password"
            >
            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                <i class="fas fa-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Remember Me -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember" style="font-size:13px;color:#64748B;">
                Remember me
            </label>
        </div>
        <a href="{{ route('password.forgot') }}" style="font-size:13px;color:#4F46E5;font-weight:600;text-decoration:none;">
            Forgot password?
        </a>
    </div>

    <button type="submit" class="btn-auth">
        <i class="fas fa-right-to-bracket me-2"></i> Sign In
    </button>
</form>

<div class="auth-divider" style="margin-top:24px;">
    <span>Don't have an account?</span>
</div>

<a href="{{ route('form.step1') }}" style="
    display:block; text-align:center; padding:12px;
    border:2px solid #4F46E5; border-radius:12px;
    color:#4F46E5; font-weight:700; font-size:14px;
    text-decoration:none; transition:all .2s;
" onmouseover="this.style.background='rgba(79,70,229,.07)'"
   onmouseout="this.style.background='transparent'">
    <i class="fas fa-user-plus me-2"></i> Create New Account
</a>

<!-- Demo Credentials -->
<div style="margin-top:20px; padding:14px; background:#F8FAFC; border-radius:12px; border:1px dashed #CBD5E1;">
    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#94A3B8;margin-bottom:8px;">
        Demo Admin Credentials
    </p>
    <div style="font-size:12.5px;color:#475569;line-height:1.8;">
        <strong>User ID:</strong> ADM-000001<br>
        <strong>Password:</strong> Admin@12345
    </div>
</div>
@endsection

@section('footer')
    <span style="color:#94A3B8;">New user?</span>
    <a href="{{ route('form.step1') }}">Register via Application Form →</a>
@endsection
