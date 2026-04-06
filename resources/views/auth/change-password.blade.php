@extends('layouts.auth')
@section('title', 'Change Password')
@section('content')

@if(auth()->user()->is_first_login)
<div style="background:linear-gradient(135deg,#FEF3C7,#FDE68A);border-radius:12px;padding:14px 18px;margin-bottom:24px;border:1px solid #FCD34D;">
    <div style="display:flex;align-items:center;gap:10px;">
        <i class="fas fa-star" style="color:#D97706;font-size:18px;"></i>
        <div>
            <div style="font-size:13px;font-weight:700;color:#92400E;">First Login – Action Required</div>
            <div style="font-size:12.5px;color:#B45309;margin-top:2px;">Please create a new secure password to continue.</div>
        </div>
    </div>
</div>
@endif

<h2>{{ auth()->user()->is_first_login ? 'Set Your Password' : 'Change Password' }}</h2>
<p class="subtitle">{{ auth()->user()->is_first_login ? 'Create a strong password for your new account.' : 'Update your account password below.' }}</p>

<form action="{{ route('password.change.update') }}" method="POST" novalidate>
    @csrf

    @if(!auth()->user()->is_first_login)
    <div class="mb-4">
        <label class="form-label" for="current_password"><i class="fas fa-key me-1" style="color:#4F46E5;"></i> Current Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
            <input type="password" id="current_password" name="current_password"
                class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password">
            <button type="button" class="password-toggle" onclick="togglePassword('current_password',this)"><i class="fas fa-eye"></i></button>
            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    @endif

    <div class="mb-4">
        <label class="form-label" for="new_password"><i class="fas fa-lock-open me-1" style="color:#4F46E5;"></i> New Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
            <input type="password" id="new_password" name="new_password"
                class="form-control @error('new_password') is-invalid @enderror"
                placeholder="Min 8 chars, upper, lower, number, symbol" oninput="checkStrength(this.value)">
            <button type="button" class="password-toggle" onclick="togglePassword('new_password',this)"><i class="fas fa-eye"></i></button>
            @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div style="margin-top:8px;">
            <div style="height:4px;background:#E2E8F0;border-radius:4px;overflow:hidden;">
                <div id="strength-bar" style="height:100%;width:0;transition:all .3s;border-radius:4px;"></div>
            </div>
            <div id="strength-label" style="font-size:11px;color:#94A3B8;margin-top:4px;"></div>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label" for="new_password_confirmation"><i class="fas fa-check-double me-1" style="color:#4F46E5;"></i> Confirm New Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-check-double"></i></span>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Re-enter new password">
            <button type="button" class="password-toggle" onclick="togglePassword('new_password_confirmation',this)"><i class="fas fa-eye"></i></button>
            @error('new_password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div style="background:#F8FAFC;border-radius:10px;padding:14px 16px;margin-bottom:24px;border:1px solid #E2E8F0;">
        <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Password Requirements</p>
        <div style="font-size:12.5px;color:#64748B;line-height:2.2;">
            <div id="r-length">⬜ At least 8 characters</div>
            <div id="r-upper">⬜ At least one uppercase letter</div>
            <div id="r-lower">⬜ At least one lowercase letter</div>
            <div id="r-number">⬜ At least one number</div>
            <div id="r-symbol">⬜ At least one special character</div>
        </div>
    </div>

    <button type="submit" class="btn-auth">
        <i class="fas fa-shield-check me-2"></i>
        {{ auth()->user()->is_first_login ? 'Set Password & Continue' : 'Update Password' }}
    </button>
</form>

@if(!auth()->user()->is_first_login)
<div style="text-align:center;margin-top:16px;">
    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
       style="font-size:13px;color:#64748B;text-decoration:none;">
        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
    </a>
</div>
@endif
@endsection

@push('scripts')
<script>
function checkStrength(val) {
    const checks = { 'r-length': val.length >= 8, 'r-upper': /[A-Z]/.test(val), 'r-lower': /[a-z]/.test(val), 'r-number': /\d/.test(val), 'r-symbol': /[!@#$%^&*(),.?":{}|<>_\-]/.test(val) };
    let score = 0;
    for (const [id, pass] of Object.entries(checks)) {
        const el = document.getElementById(id);
        if (el) { el.innerHTML = (pass ? '✅' : '⬜') + el.innerHTML.replace(/^[✅⬜]/, ''); el.style.color = pass ? '#10B981' : '#64748B'; }
        if (pass) score++;
    }
    const bar = document.getElementById('strength-bar'), lbl = document.getElementById('strength-label');
    const cols = ['#EF4444','#F59E0B','#F59E0B','#10B981','#059669'];
    const lbls = ['Very Weak','Weak','Fair','Strong','Very Strong'];
    bar.style.width = (score/5*100)+'%'; bar.style.background = cols[score-1]||'#E2E8F0';
    lbl.textContent = score > 0 ? lbls[score-1] : ''; lbl.style.color = cols[score-1]||'#94A3B8';
}
</script>
@endpush
