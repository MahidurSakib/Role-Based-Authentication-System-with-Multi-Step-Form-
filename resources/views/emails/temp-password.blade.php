<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Password Reset</title>
    <style>
        body{font-family:'Segoe UI',Arial,sans-serif;background:#F1F5F9;margin:0;padding:24px;}
        .email-wrap{max-width:600px;margin:0 auto;}
        .header{background:linear-gradient(135deg,#EF4444,#DC2626);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;}
        .header h1{color:#fff;font-size:22px;font-weight:800;margin:0;}
        .header p{color:rgba(255,255,255,.8);font-size:14px;margin:6px 0 0;}
        .body{background:#fff;padding:36px 40px;}
        .text{font-size:14.5px;color:#475569;line-height:1.8;margin-bottom:20px;}
        .creds-box{background:#F8FAFC;border-radius:12px;padding:20px;border:1px solid #E2E8F0;margin-bottom:24px;}
        .cred-row{display:flex;align-items:center;padding:10px 0;border-bottom:1px solid #E2E8F0;}
        .cred-row:last-child{border-bottom:none;}
        .cred-label{font-size:12px;font-weight:700;color:#94A3B8;text-transform:uppercase;width:140px;flex-shrink:0;}
        .cred-value{font-size:14px;color:#1E293B;font-weight:600;font-family:monospace;}
        .btn-login{display:block;background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;text-align:center;padding:16px;border-radius:12px;font-size:15px;font-weight:700;text-decoration:none;margin-bottom:24px;}
        .footer{background:#F8FAFC;border-radius:0 0 16px 16px;padding:20px 40px;text-align:center;border-top:1px solid #E2E8F0;}
        .footer p{font-size:12px;color:#94A3B8;margin:0;}
    </style>
</head>
<body>
<div class="email-wrap">
    <div class="header">
        <h1>🔐 Password Reset</h1>
        <p>A temporary password has been issued to your account</p>
    </div>
    <div class="body">
        <p class="text">Hello <strong>{{ $user->name }}</strong>,<br><br>We received a password reset request for your account. A temporary password has been generated for you.</p>
        <div class="creds-box">
            <div class="cred-row"><div class="cred-label">User ID</div><div class="cred-value">{{ $user->user_uid }}</div></div>
            <div class="cred-row"><div class="cred-label">Email</div><div class="cred-value">{{ $user->email }}</div></div>
            <div class="cred-row"><div class="cred-label">Temp Password</div><div class="cred-value">{{ $tempPassword }}</div></div>
        </div>
        <a href="{{ url('/login') }}" class="btn-login">Login & Set New Password</a>
        <p class="text" style="font-size:13px;">If you did not request a password reset, please contact support immediately.</p>
    </div>
    <div class="footer"><p>© {{ date('Y') }} RBAC System. All rights reserved.</p></div>
</div>
</body>
</html>
