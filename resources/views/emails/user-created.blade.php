<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome – Your RBAC Account Details</title>
    <style>
        body{font-family:'Segoe UI',Arial,sans-serif;background:#F1F5F9;margin:0;padding:24px;}
        .email-wrap{max-width:600px;margin:0 auto;}
        .header{background:linear-gradient(135deg,#4F46E5,#7C3AED,#06B6D4);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;}
        .header .icon{font-size:48px;margin-bottom:12px;}
        .header h1{color:#fff;font-size:24px;font-weight:800;margin:0;}
        .header p{color:rgba(255,255,255,.8);font-size:14px;margin:6px 0 0;}
        .body{background:#fff;padding:36px 40px;}
        .greeting{font-size:18px;font-weight:700;color:#1E293B;margin-bottom:8px;}
        .text{font-size:14.5px;color:#475569;line-height:1.8;margin-bottom:20px;}
        .uid-box{background:linear-gradient(135deg,#1E293B,#334155);border-radius:14px;padding:24px;text-align:center;margin-bottom:24px;}
        .uid-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:rgba(255,255,255,.5);margin-bottom:8px;}
        .uid-value{font-size:32px;font-weight:800;color:#fff;letter-spacing:4px;font-family:monospace;}
        .creds-box{background:#F8FAFC;border-radius:12px;padding:20px;border:1px solid #E2E8F0;margin-bottom:24px;}
        .cred-row{display:flex;align-items:center;padding:10px 0;border-bottom:1px solid #E2E8F0;}
        .cred-row:last-child{border-bottom:none;}
        .cred-label{font-size:12px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:.5px;width:140px;flex-shrink:0;}
        .cred-value{font-size:14px;color:#1E293B;font-weight:600;font-family:monospace;}
        .steps{margin-bottom:24px;}
        .step-row{display:flex;align-items:flex-start;gap:14px;margin-bottom:14px;}
        .step-num{width:28px;height:28px;background:linear-gradient(135deg,#4F46E5,#7C3AED);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;flex-shrink:0;margin-top:1px;}
        .step-text{font-size:14px;color:#475569;line-height:1.6;}
        .btn-login{display:block;background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;text-align:center;padding:16px;border-radius:12px;font-size:15px;font-weight:700;text-decoration:none;margin-bottom:24px;}
        .warning{background:#FEF3C7;border:1px solid #FCD34D;border-radius:10px;padding:14px 16px;font-size:13px;color:#92400E;margin-bottom:24px;}
        .footer{background:#F8FAFC;border-radius:0 0 16px 16px;padding:20px 40px;text-align:center;border-top:1px solid #E2E8F0;}
        .footer p{font-size:12px;color:#94A3B8;margin:0;}
    </style>
</head>
<body>
<div class="email-wrap">
    <div class="header">
        <div class="icon">🎉</div>
        <h1>Welcome to RBAC System!</h1>
        <p>Your account has been successfully created</p>
    </div>

    <div class="body">
        <div class="greeting">Hello, {{ $user->name }}!</div>
        <p class="text">Congratulations! Your registration has been completed successfully. Below are your account credentials. Please keep them safe and do not share them with anyone.</p>

        <div class="uid-box">
            <div class="uid-label">Your Unique User ID</div>
            <div class="uid-value">{{ $user->user_uid }}</div>
        </div>

        <div class="creds-box">
            <div class="cred-row">
                <div class="cred-label">User ID</div>
                <div class="cred-value">{{ $user->user_uid }}</div>
            </div>
            <div class="cred-row">
                <div class="cred-label">Email</div>
                <div class="cred-value">{{ $user->email }}</div>
            </div>
            <div class="cred-row">
                <div class="cred-label">Temp Password</div>
                <div class="cred-value">{{ $tempPassword }}</div>
            </div>
        </div>

        <div class="warning">
            ⚠️ <strong>Important:</strong> This is a temporary password. You will be required to change it on your first login.
        </div>

        <div class="steps">
            <p style="font-size:12px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;">Getting Started</p>
            <div class="step-row"><div class="step-num">1</div><div class="step-text">Click the login button below to access the system.</div></div>
            <div class="step-row"><div class="step-num">2</div><div class="step-text">Enter your <strong>User ID ({{ $user->user_uid }})</strong> or email and the temporary password above.</div></div>
            <div class="step-row"><div class="step-num">3</div><div class="step-text">Create a new secure password when prompted.</div></div>
            <div class="step-row"><div class="step-num">4</div><div class="step-text">Access your dashboard to view your profile and data.</div></div>
        </div>

        <a href="{{ url('/login') }}" class="btn-login">🔐 Login to Your Account</a>

        <p class="text" style="font-size:13px;">If you did not register for this account or believe this email was sent to you by mistake, please ignore it or contact support immediately.</p>
    </div>

    <div class="footer">
        <p>This email was sent by <strong>RBAC System</strong> &bull; {{ config('app.name') }}</p>
        <p style="margin-top:6px;">© {{ date('Y') }} RBAC System. All rights reserved.</p>
    </div>
</div>
</body>
</html>
