<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful | RBAC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root{--primary:#4F46E5;--accent:#06B6D4;--success:#10B981;}
        body{font-family:'Inter',sans-serif;background:#F1F5F9;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;}
        .success-wrapper{max-width:540px;width:100%;text-align:center;}
        .confetti-icon{font-size:64px;margin-bottom:12px;animation:bounce 1s ease infinite alternate;}
        @keyframes bounce{from{transform:translateY(0)}to{transform:translateY(-12px)}}
        .success-card{background:#fff;border-radius:24px;padding:40px;box-shadow:0 8px 40px rgba(0,0,0,.1);border:1px solid #E2E8F0;margin-bottom:16px;}
        .success-title{font-size:26px;font-weight:800;color:#1E293B;margin-bottom:8px;}
        .success-sub{font-size:15px;color:#64748B;margin-bottom:28px;line-height:1.6;}
        .uid-box{background:linear-gradient(135deg,#1E293B,#334155);border-radius:16px;padding:24px;margin-bottom:24px;}
        .uid-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:rgba(255,255,255,.5);margin-bottom:8px;}
        .uid-value{font-size:34px;font-weight:800;color:#fff;letter-spacing:4px;font-family:monospace;}
        .uid-copy{display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:7px 16px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);border-radius:8px;color:rgba(255,255,255,.8);font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;}
        .uid-copy:hover{background:rgba(255,255,255,.2);}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px;}
        .info-item{background:#F8FAFC;border-radius:12px;padding:14px;text-align:left;border:1px solid #E2E8F0;}
        .info-item .il{font-size:11px;color:#94A3B8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;}
        .info-item .iv{font-size:13.5px;color:#1E293B;font-weight:600;}
        .steps-list{text-align:left;margin-bottom:24px;}
        .step-row{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid #F1F5F9;}
        .step-row:last-child{border-bottom:none;}
        .step-num{width:28px;height:28px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;flex-shrink:0;}
        .step-text{font-size:13.5px;color:#475569;padding-top:4px;}
        .btn-login{display:block;background:linear-gradient(135deg,var(--primary),#7C3AED);color:#fff;border:none;border-radius:12px;padding:15px;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;text-decoration:none;}
        .btn-login:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(79,70,229,.45);color:#fff;}
        .email-note{background:rgba(6,182,212,.08);border:1px solid rgba(6,182,212,.25);border-radius:12px;padding:14px 16px;font-size:13px;color:#164E63;margin-bottom:16px;text-align:left;}
    </style>
</head>
<body>
<div class="success-wrapper">
    <div class="confetti-icon">🎉</div>

    <div class="success-card">
        <h1 class="success-title">Registration Successful!</h1>
        <p class="success-sub">Your account has been created. Use the credentials below to log in to your dashboard.</p>

        <!-- UID Box -->
        <div class="uid-box">
            <div class="uid-label">Your Unique User ID</div>
            <div class="uid-value" id="uid-display">{{ session('user_uid') }}</div>
            <div onclick="copyUID()" class="uid-copy" id="copy-btn">
                <i class="fas fa-copy"></i> Click to Copy
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-item">
                <div class="il">Registered Name</div>
                <div class="iv">{{ session('user_name') }}</div>
            </div>
            <div class="info-item">
                <div class="il">Email Address</div>
                <div class="iv" style="word-break:break-all;">{{ session('user_email') }}</div>
            </div>
            <div class="info-item">
                <div class="il">Temp Password</div>
                <div class="iv" style="font-family:monospace;letter-spacing:1px;">{{ session('temp_password') }}</div>
            </div>
            <div class="info-item">
                <div class="il">Account Status</div>
                <div class="iv" style="color:#10B981;"><i class="fas fa-circle-check me-1"></i> Active</div>
            </div>
        </div>

        <!-- Email Note -->
        <div class="email-note">
            <i class="fas fa-envelope me-2"></i>
            A welcome email with your credentials has been sent to <strong>{{ session('user_email') }}</strong>. Check your inbox (and spam folder).
        </div>

        <!-- Next Steps -->
        <div class="steps-list">
            <p style="font-size:11px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">What's Next?</p>
            <div class="step-row"><div class="step-num">1</div><div class="step-text">Note your <strong>User ID: {{ session('user_uid') }}</strong> and temporary password above.</div></div>
            <div class="step-row"><div class="step-num">2</div><div class="step-text">Click "Go to Login" and sign in with your User ID or email.</div></div>
            <div class="step-row"><div class="step-num">3</div><div class="step-text">You'll be prompted to <strong>create a new secure password</strong> on your first login.</div></div>
            <div class="step-row"><div class="step-num">4</div><div class="step-text">Access your dashboard to view your submitted profile information.</div></div>
        </div>

        <a href="{{ route('login') }}" class="btn-login">
            <i class="fas fa-right-to-bracket me-2"></i> Go to Login
        </a>
    </div>

    <p style="font-size:12px;color:#94A3B8;"><i class="fas fa-lock me-1"></i> RBAC System &copy; {{ date('Y') }}. All rights reserved.</p>
</div>

<script>
function copyUID() {
    const uid = document.getElementById('uid-display').textContent.trim();
    navigator.clipboard.writeText(uid).then(() => {
        const btn = document.getElementById('copy-btn');
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.style.background = 'rgba(16,185,129,.3)';
        setTimeout(() => { btn.innerHTML = '<i class="fas fa-copy"></i> Click to Copy'; btn.style.background = ''; }, 2000);
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
