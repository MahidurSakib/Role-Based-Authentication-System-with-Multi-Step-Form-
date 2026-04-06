<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration – Review & Submit | RBAC System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root{--primary:#4F46E5;--accent:#06B6D4;}*{box-sizing:border-box;}
        body{font-family:'Inter',sans-serif;background:#F1F5F9;min-height:100vh;padding:30px 16px;}
        .form-container{max-width:720px;margin:0 auto;}
        .form-header{text-align:center;margin-bottom:32px;}
        .logo{width:52px;height:52px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:14px;display:inline-flex;align-items:center;justify-content:center;font-size:24px;color:#fff;margin-bottom:12px;box-shadow:0 8px 25px rgba(79,70,229,.35);}
        .form-header h1{font-size:24px;font-weight:800;color:#1E293B;margin:0;}
        .form-header p{font-size:14px;color:#64748B;margin:4px 0 0;}
        .step-indicator{display:flex;align-items:flex-start;justify-content:center;margin-bottom:12px;}
        .step-wrapper{display:flex;flex-direction:column;align-items:center;}
        .step-circle{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;}
        .step-circle.done{background:var(--primary);color:#fff;}.step-circle.active{background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff;box-shadow:0 4px 14px rgba(79,70,229,.5);}
        .step-label{font-size:11px;font-weight:600;margin-top:6px;text-align:center;width:80px;}
        .step-label.done,.step-label.active{color:var(--primary);}
        .step-connector{width:60px;height:2px;margin:0 4px;position:relative;top:20px;background:var(--primary);}
        .review-card{background:#fff;border-radius:20px;padding:28px;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1px solid #E2E8F0;margin-bottom:16px;}
        .review-section-title{font-size:13px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
        .review-section-title .edit-link{margin-left:auto;font-size:12px;font-weight:600;color:var(--primary);text-decoration:none;text-transform:none;letter-spacing:0;}
        .review-section-title .edit-link:hover{text-decoration:underline;}
        .review-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;}
        .review-item .label{font-size:11px;color:#94A3B8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px;}
        .review-item .value{font-size:14px;color:#1E293B;font-weight:500;}
        .review-item .value.empty{color:#CBD5E1;font-style:italic;}
        .full-width{grid-column:1/-1;}
        .progress-bar-wrap{background:#E2E8F0;border-radius:4px;height:5px;margin-bottom:6px;overflow:hidden;}
        .progress-fill{height:100%;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:4px;}
        .progress-text{font-size:11px;color:#94A3B8;text-align:right;}
        .btn-submit{background:linear-gradient(135deg,#10B981,#059669);color:#fff;border:none;border-radius:12px;padding:14px 36px;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:8px;}
        .btn-submit:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(16,185,129,.45);}
        .btn-back{background:#F1F5F9;color:#64748B;border:none;border-radius:12px;padding:13px 24px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
        .btn-back:hover{background:#E2E8F0;color:#475569;}
        .confirm-box{background:rgba(16,185,129,.07);border:1.5px solid rgba(16,185,129,.3);border-radius:14px;padding:18px;margin-bottom:20px;}
        .confirm-box p{font-size:13.5px;color:#065F46;margin:0;}
        .avatar-circle{width:64px;height:64px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:26px;font-weight:800;margin-bottom:12px;}
        .id-preview{background:linear-gradient(135deg,#1E293B,#334155);border-radius:14px;padding:20px 24px;color:#fff;display:flex;align-items:center;gap:16px;margin-bottom:20px;}
        .id-preview .badge-uid{font-size:22px;font-weight:800;letter-spacing:2px;font-family:monospace;}
        .id-preview p{font-size:12px;color:rgba(255,255,255,.6);margin:4px 0 0;}
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <div class="logo"><i class="fas fa-shield-halved"></i></div>
        <h1>Create Your Account</h1>
        <p>Review your information before submitting</p>
    </div>

    <div class="step-indicator mb-2">
        <div class="step-wrapper"><div class="step-circle done"><i class="fas fa-check"></i></div><div class="step-label done">Personal</div></div>
        <div class="step-connector"></div>
        <div class="step-wrapper"><div class="step-circle done"><i class="fas fa-check"></i></div><div class="step-label done">Address</div></div>
        <div class="step-connector"></div>
        <div class="step-wrapper"><div class="step-circle active"><i class="fas fa-eye"></i></div><div class="step-label active">Review</div></div>
    </div>

    <div class="progress-bar-wrap"><div class="progress-fill" style="width:100%;"></div></div>
    <div class="progress-text mb-4">Step 3 of 3 &mdash; Final Review</div>

    <!-- Personal Info Review -->
    <div class="review-card">
        <div class="review-section-title">
            <i class="fas fa-user" style="color:var(--primary);"></i> Personal Information
            <a href="{{ route('form.step1') }}" class="edit-link"><i class="fas fa-pencil me-1"></i>Edit</a>
        </div>
        <div class="review-grid">
            <div class="review-item"><div class="label">First Name</div><div class="value">{{ $step1['first_name'] }}</div></div>
            <div class="review-item"><div class="label">Last Name</div><div class="value">{{ $step1['last_name'] }}</div></div>
            <div class="review-item"><div class="label">Email Address</div><div class="value">{{ $step1['email'] }}</div></div>
            <div class="review-item"><div class="label">Phone Number</div><div class="value">{{ $step1['phone'] }}</div></div>
            <div class="review-item"><div class="label">Date of Birth</div><div class="value">{{ \Carbon\Carbon::parse($step1['date_of_birth'])->format('d M Y') }}</div></div>
            <div class="review-item"><div class="label">Gender</div><div class="value">{{ ucwords(str_replace('_', ' ', $step1['gender'])) }}</div></div>
        </div>
    </div>

    <!-- Address & Professional Review -->
    <div class="review-card">
        <div class="review-section-title">
            <i class="fas fa-location-dot" style="color:var(--accent);"></i> Address & Professional Info
            <a href="{{ route('form.step2') }}" class="edit-link"><i class="fas fa-pencil me-1"></i>Edit</a>
        </div>
        <div class="review-grid">
            <div class="review-item full-width"><div class="label">Street Address</div><div class="value">{{ $step2['address'] }}</div></div>
            <div class="review-item"><div class="label">City</div><div class="value">{{ $step2['city'] }}</div></div>
            <div class="review-item"><div class="label">State</div><div class="value">{{ $step2['state'] }}</div></div>
            <div class="review-item"><div class="label">Country</div><div class="value">{{ $step2['country'] }}</div></div>
            <div class="review-item"><div class="label">ZIP Code</div><div class="value">{{ $step2['zip_code'] }}</div></div>
            <div class="review-item"><div class="label">Occupation</div><div class="value">{{ $step2['occupation'] }}</div></div>
            <div class="review-item"><div class="label">Company</div><div class="value {{ empty($step2['company'])?'empty':'' }}">{{ $step2['company'] ?: 'Not provided' }}</div></div>
            <div class="review-item"><div class="label">Experience</div><div class="value">{{ $step2['experience'] }}</div></div>
            @if(!empty($step2['skills']))
            <div class="review-item full-width"><div class="label">Skills</div><div class="value">{{ $step2['skills'] }}</div></div>
            @endif
            @if(!empty($step2['bio']))
            <div class="review-item full-width"><div class="label">Bio</div><div class="value">{{ $step2['bio'] }}</div></div>
            @endif
        </div>
    </div>

    <!-- Confirmation -->
    <div class="confirm-box">
        <p><i class="fas fa-circle-info me-2"></i> After submission, a <strong>unique User ID</strong> will be generated and emailed to <strong>{{ $step1['email'] }}</strong> along with your temporary login password.</p>
    </div>

    <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('form.step2') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn-submit" id="submitBtn" onclick="this.innerHTML='<i class=\'fas fa-spinner fa-spin me-2\'></i> Submitting...';this.disabled=true;this.form.submit();">
                <i class="fas fa-paper-plane"></i> Submit Application
            </button>
        </div>
    </form>

    <p style="text-align:center;font-size:12.5px;color:#94A3B8;margin-top:16px;"><i class="fas fa-lock me-1"></i> Your information is secure and encrypted. We never share your data.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
