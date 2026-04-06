@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
<h2>Reset Password</h2>
<p class="subtitle">Enter your User ID or email to receive a temporary password.</p>

<form action="{{ route('password.forgot.send') }}" method="POST" novalidate>
    @csrf
    <div class="mb-4">
        <label class="form-label" for="login"><i class="fas fa-fingerprint me-1" style="color:#4F46E5;"></i> User ID or Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" id="login" name="login"
                class="form-control @error('login') is-invalid @enderror"
                value="{{ old('login') }}" placeholder="USR-XXXXX or email@example.com" autofocus>
            @error('login')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <button type="submit" class="btn-auth"><i class="fas fa-paper-plane me-2"></i> Send Temporary Password</button>
</form>
@endsection
@section('footer')
    <a href="{{ route('login') }}"><i class="fas fa-arrow-left me-1"></i> Back to Login</a>
@endsection
