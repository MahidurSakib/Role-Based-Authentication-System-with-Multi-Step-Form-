<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration – Step 1 of 3 | RBAC System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root{--primary:#4F46E5;--accent:#06B6D4;}*{box-sizing:border-box;}
        body{font-family:'Inter',sans-serif;background:#F1F5F9;min-height:100vh;padding:30px 16px;}
        .form-container{max-width:720px;margin:0 auto;}
        .form-header{text-align:center;margin-bottom:32px;}
        .form-header .logo{width:52px;height:52px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:14px;display:inline-flex;align-items:center;justify-content:center;font-size:24px;color:#fff;margin-bottom:12px;box-shadow:0 8px 25px rgba(79,70,229,.35);}
        .form-header h1{font-size:24px;font-weight:800;color:#1E293B;margin:0;}
        .form-header p{font-size:14px;color:#64748B;margin:4px 0 0;}
        .step-indicator{display:flex;align-items:flex-start;justify-content:center;margin-bottom:12px;}
        .step-wrapper{display:flex;flex-direction:column;align-items:center;}
        .step-circle{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;transition:all .3s;}
        .step-circle.active{background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff;box-shadow:0 4px 14px rgba(79,70,229,.5);}
        .step-circle.pending{background:#E2E8F0;color:#94A3B8;}
        .step-label{font-size:11px;font-weight:600;margin-top:6px;text-align:center;width:80px;}
        .step-label.active{color:var(--primary);}.step-label.pending{color:#94A3B8;}
        .step-connector{width:60px;height:2px;background:#E2E8F0;margin:0 4px;position:relative;top:20px;}
        .form-card{background:#fff;border-radius:20px;padding:36px;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1px solid #E2E8F0;}
        .card-title-row{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
        .card-title-row h2{font-size:18px;font-weight:700;color:#1E293B;margin:0;}
        .card-icon{width:36px;height:36px;background:rgba(79,70,229,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:16px;}
        .card-subtitle{font-size:13.5px;color:#64748B;margin-bottom:28px;}
        .form-label{font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;}
        .form-control,.form-select{border-radius:10px;border:1.5px solid #E2E8F0;padding:11px 14px;font-size:14px;color:#1E293B;background:#F8FAFC;transition:all .2s;}
        .form-control:focus,.form-select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(79,70,229,.1);background:#fff;}
        .form-control.is-invalid,.form-select.is-invalid{border-color:#EF4444;}
        .invalid-feedback{font-size:12px;color:#EF4444;}
        .igtext{background:#F8FAFC;border:1.5px solid #E2E8F0;border-right:none;border-radius:10px 0 0 10px;padding:0 14px;display:flex;align-items:center;color:#94A3B8;}
        .igtext+.form-control{border-radius:0 10px 10px 0;}
        .btn-next{background:linear-gradient(135deg,var(--primary),#7C3AED);color:#fff;border:none;border-radius:12px;padding:13px 32px;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;}
        .btn-next:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(79,70,229,.45);}
        .btn-back{background:#F1F5F9;color:#64748B;border:none;border-radius:12px;padding:13px 24px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
        .btn-back:hover{background:#E2E8F0;color:#475569;}
        .progress-bar-wrap{background:#E2E8F0;border-radius:4px;height:5px;margin-bottom:6px;overflow:hidden;}
        .progress-fill{height:100%;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:4px;}
        .progress-text{font-size:11px;color:#94A3B8;text-align:right;}
        .alert{border:none;border-radius:12px;font-size:13.5px;}
        .alert-danger{background:rgba(239,68,68,.1);color:#7F1D1D;}
        .gender-group{display:flex;gap:10px;flex-wrap:wrap;}
        .gender-opt{flex:1;min-width:100px;}
        .gender-opt input{display:none;}
        .gender-opt label{display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 14px;border:1.5px solid #E2E8F0;border-radius:10px;cursor:pointer;font-size:13px;font-weight:500;color:#64748B;transition:all .2s;background:#F8FAFC;text-align:center;}
        .gender-opt input:checked+label{border-color:var(--primary);background:rgba(79,70,229,.07);color:var(--primary);font-weight:600;}
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <div class="logo"><i class="fas fa-shield-halved"></i></div>
        <h1>Create Your Account</h1>
        <p>Complete the 3-step registration form to get your unique User ID</p>
    </div>

    <div class="step-indicator mb-2">
        <div class="step-wrapper">
            <div class="step-circle active"><i class="fas fa-user"></i></div>
            <div class="step-label active">Personal</div>
        </div>
        <div class="step-connector"></div>
        <div class="step-wrapper">
            <div class="step-circle pending">2</div>
            <div class="step-label pending">Address</div>
        </div>
        <div class="step-connector"></div>
        <div class="step-wrapper">
            <div class="step-circle pending">3</div>
            <div class="step-label pending">Review</div>
        </div>
    </div>

    <div class="progress-bar-wrap"><div class="progress-fill" style="width:33%;"></div></div>
    <div class="progress-text mb-4">Step 1 of 3 &mdash; 33% complete</div>

    @if($errors->any())
    <div class="alert alert-danger mb-3">
        <i class="fas fa-circle-exclamation me-2"></i><strong>Please fix the errors below:</strong>
        <ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="form-card">
        <div class="card-title-row">
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <h2>Personal Information</h2>
        </div>
        <div class="card-subtitle">Fill in your personal details. All fields marked * are required.</div>

        <form action="{{ route('form.step1.store') }}" method="POST" novalidate>
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="first_name">First Name <span style="color:#EF4444">*</span></label>
                    <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $formData['first_name'] ?? '') }}" placeholder="John">
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="last_name">Last Name <span style="color:#EF4444">*</span></label>
                    <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $formData['last_name'] ?? '') }}" placeholder="Doe">
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="email">Email Address <span style="color:#EF4444">*</span></label>
                    <div class="input-group">
                        <span class="igtext"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $formData['email'] ?? '') }}" placeholder="john.doe@example.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="phone">Phone Number <span style="color:#EF4444">*</span></label>
                    <div class="input-group">
                        <span class="igtext"><i class="fas fa-phone"></i></span>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $formData['phone'] ?? '') }}" placeholder="+1 555 000-0000">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="date_of_birth">Date of Birth <span style="color:#EF4444">*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth', $formData['date_of_birth'] ?? '') }}" max="{{ date('Y-m-d', strtotime('-16 years')) }}">
                    @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Gender <span style="color:#EF4444">*</span></label>
                    <div class="gender-group">
                        @foreach(['male'=>'&#9794; Male','female'=>'&#9792; Female','other'=>'&#9892; Other','prefer_not_to_say'=>'&#128274; Prefer Not to Say'] as $val=>$lbl)
                        <div class="gender-opt">
                            <input type="radio" id="g_{{ $val }}" name="gender" value="{{ $val }}" {{ old('gender',$formData['gender']??'')!==$val?'':'checked' }}>
                            <label for="g_{{ $val }}">{!! $lbl !!}</label>
                        </div>
                        @endforeach
                    </div>
                    @error('gender')<div style="font-size:12px;color:#EF4444;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top:1px solid #F1F5F9;">
                <a href="{{ route('login') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Login</a>
                <button type="submit" class="btn-next">Continue <i class="fas fa-arrow-right ms-1"></i></button>
            </div>
        </form>
    </div>

    <p style="text-align:center;font-size:12.5px;color:#94A3B8;margin-top:16px;"><i class="fas fa-lock me-1"></i> Your information is secure and encrypted.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
