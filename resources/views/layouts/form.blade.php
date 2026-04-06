<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Application Form') – RBAC System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root { --primary:#4F46E5; --accent:#06B6D4; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
            min-height: 100vh;
            padding: 32px 16px;
        }

        .form-container {
            max-width: 680px;
            margin: 0 auto;
        }

        /* Branding */
        .form-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .form-brand .brand-icon {
            width: 54px; height: 54px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 24px; color: #fff;
            margin-bottom: 10px;
            box-shadow: 0 10px 30px rgba(79,70,229,.4);
        }

        .form-brand h1 { font-size: 22px; font-weight: 800; color: #fff; margin: 0; }
        .form-brand p  { font-size: 13px; color: rgba(255,255,255,.5); margin: 4px 0 0; }

        /* Stepper */
        .stepper {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
            background: rgba(255,255,255,.05);
            border-radius: 16px;
            padding: 20px 24px;
        }

        .step-item {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .step-item:last-child { flex: 0; }

        .step-circle {
            width: 40px; height: 40px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700;
            flex-shrink: 0;
            transition: all .3s;
            border: 2px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.4);
        }

        .step-circle.done {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .step-circle.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 4px rgba(79,70,229,.3);
        }

        .step-info { margin-left: 10px; }
        .step-info .step-num  { font-size: 10px; font-weight: 700; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: 1px; }
        .step-info .step-name { font-size: 12.5px; font-weight: 600; color: rgba(255,255,255,.7); }
        .step-info .step-name.active { color: #fff; }

        .step-connector {
            flex: 1;
            height: 2px;
            background: rgba(255,255,255,.1);
            margin: 0 12px;
            position: relative;
            overflow: hidden;
        }

        .step-connector::after {
            content: '';
            position: absolute;
            top: 0; left: 0; height: 100%;
            background: var(--accent);
            width: 0;
            transition: width .4s ease;
        }

        .step-connector.done::after { width: 100%; }

        /* Form Card */
        .form-card {
            background: #fff;
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,.3);
        }

        .form-card h2 { font-size: 20px; font-weight: 800; color: #1E293B; margin-bottom: 4px; }
        .form-card .subtitle { font-size: 13.5px; color: #64748B; margin-bottom: 28px; }

        .section-label {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.5px; color: #94A3B8;
            border-bottom: 1px solid #F1F5F9;
            padding-bottom: 8px; margin-bottom: 16px;
        }

        .form-label {
            font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #E2E8F0;
            padding: 11px 14px; font-size: 14px;
            color: #1E293B; background: #F8FAFC;
            transition: all .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.1);
            background: #fff;
        }

        .form-control.is-invalid { border-color: #EF4444; background: #FFF5F5; }
        .invalid-feedback { font-size: 12px; color: #EF4444; }

        textarea.form-control { resize: vertical; min-height: 90px; }

        .btn-nav {
            padding: 12px 28px; border-radius: 12px;
            font-size: 14px; font-weight: 700;
            cursor: pointer; transition: all .2s;
            border: none;
        }

        .btn-next {
            background: linear-gradient(135deg, var(--primary), #7C3AED);
            color: #fff;
        }
        .btn-next:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,.4); }

        .btn-prev {
            background: #F1F5F9; color: #64748B;
        }
        .btn-prev:hover { background: #E2E8F0; }

        .btn-submit {
            background: linear-gradient(135deg, #10B981, #059669);
            color: #fff; padding: 14px 36px;
        }
        .btn-submit:hover { box-shadow: 0 6px 20px rgba(16,185,129,.4); transform: translateY(-1px); }

        .alert { border: none; border-radius: 12px; font-size: 13.5px; }
        .alert-danger  { background: rgba(239,68,68,.1); color: #7F1D1D; }
        .alert-info    { background: rgba(6,182,212,.1);  color: #164E63; }

        .char-count { font-size: 11px; color: #94A3B8; text-align: right; }
    </style>

    @stack('styles')
</head>
<body>
<div class="form-container">

    <!-- Brand -->
    <div class="form-brand">
        <div class="brand-icon"><i class="fas fa-shield-halved"></i></div>
        <h1>RBAC System</h1>
        <p>Complete the form below to create your account</p>
    </div>

    <!-- Stepper -->
    <div class="stepper">
        <!-- Step 1 -->
        <div class="step-item">
            <div class="step-circle @if($currentStep >= 1) @if($currentStep > 1) done @else active @endif @endif">
                @if($currentStep > 1) <i class="fas fa-check"></i> @else 1 @endif
            </div>
            <div class="step-info">
                <div class="step-num">Step 1</div>
                <div class="step-name @if($currentStep == 1) active @endif">Personal Info</div>
            </div>
        </div>
        <div class="step-connector @if($currentStep > 1) done @endif"></div>

        <!-- Step 2 -->
        <div class="step-item">
            <div class="step-circle @if($currentStep >= 2) @if($currentStep > 2) done @else active @endif @endif">
                @if($currentStep > 2) <i class="fas fa-check"></i> @else 2 @endif
            </div>
            <div class="step-info">
                <div class="step-num">Step 2</div>
                <div class="step-name @if($currentStep == 2) active @endif">Address & Work</div>
            </div>
        </div>
        <div class="step-connector @if($currentStep > 2) done @endif"></div>

        <!-- Step 3 -->
        <div class="step-item">
            <div class="step-circle @if($currentStep >= 3) active @endif">3</div>
            <div class="step-info">
                <div class="step-num">Step 3</div>
                <div class="step-name @if($currentStep == 3) active @endif">Review & Submit</div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        @foreach(['error','info'] as $type)
            @if(session($type))
                <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show mb-4">
                    {{ session($type) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach

        @yield('content')
    </div>

    <p style="text-align:center;color:rgba(255,255,255,.3);font-size:12px;margin-top:20px;">
        Already registered? <a href="{{ route('login') }}" style="color:rgba(255,255,255,.5);">Sign in here</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
