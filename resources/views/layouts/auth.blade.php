<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication') – RBAC System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4F46E5;
            --accent:  #06B6D4;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F1F5F9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-logo .logo-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 26px; color: #fff;
            margin-bottom: 12px;
            box-shadow: 0 10px 30px rgba(79,70,229,.4);
        }

        .auth-logo h1 {
            font-size: 22px; font-weight: 800; color: #1E293B; margin: 0;
        }

        .auth-logo p {
            font-size: 13px; color: #64748B; margin: 4px 0 0;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            border: 1px solid #E2E8F0;
        }

        .auth-card h2 {
            font-size: 20px; font-weight: 700; color: #1E293B;
            margin-bottom: 6px;
        }

        .auth-card .subtitle {
            font-size: 13.5px; color: #64748B;
            margin-bottom: 28px;
        }

        .form-label {
            font-size: 13px; font-weight: 600; color: #374151;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #E2E8F0;
            padding: 11px 14px;
            font-size: 14px;
            transition: all .2s;
            color: #1E293B;
            background: #F8FAFC;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.1);
            background: #fff;
        }

        .form-control.is-invalid { border-color: #EF4444; }
        .invalid-feedback { font-size: 12px; color: #EF4444; }

        .input-group-text {
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            color: #94A3B8;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control { border-radius: 0 10px 10px 0; }

        .btn-auth {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--primary), #7C3AED);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px; font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            letter-spacing: .3px;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(79,70,229,.45);
        }

        .auth-divider {
            text-align: center;
            position: relative;
            margin: 22px 0;
        }

        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%; left: 0;
            width: 100%; height: 1px;
            background: #E2E8F0;
        }

        .auth-divider span {
            position: relative;
            background: #fff;
            padding: 0 14px;
            font-size: 12px; color: #94A3B8;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px; color: #64748B;
        }

        .auth-footer a {
            color: var(--primary); font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover { text-decoration: underline; }

        .alert { border: none; border-radius: 12px; font-size: 13.5px; }
        .alert-success { background: rgba(16,185,129,.1); color: #065F46; }
        .alert-danger   { background: rgba(239,68,68,.1);  color: #7F1D1D; }
        .alert-info     { background: rgba(6,182,212,.1);  color: #164E63; }

        .password-toggle {
            cursor: pointer;
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 0 14px;
            color: #94A3B8;
            transition: color .2s;
        }

        .password-toggle:hover { color: var(--primary); }
    </style>
    @stack('styles')
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-logo">
        <div class="logo-icon"><i class="fas fa-shield-halved"></i></div>
        <h1>RBAC System</h1>
        <p>Role-Based Access Control Platform</p>
    </div>

    <div class="auth-card">
        @foreach(['success','error','info','warning'] as $type)
            @if(session($type))
                <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show mb-4" role="alert">
                    {{ session($type) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach

        @yield('content')
    </div>

    <div class="auth-footer">
        @yield('footer')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>
@stack('scripts')
</body>
</html>
