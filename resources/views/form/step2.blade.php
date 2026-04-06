<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration – Step 2 of 3 | RBAC System</title>
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
        .step-circle.done{background:var(--primary);color:#fff;}
        .step-circle.active{background:linear-gradient(135deg,var(--primary),var(--accent));color:#fff;box-shadow:0 4px 14px rgba(79,70,229,.5);}
        .step-circle.pending{background:#E2E8F0;color:#94A3B8;}
        .step-label{font-size:11px;font-weight:600;margin-top:6px;text-align:center;width:80px;}
        .step-label.done,.step-label.active{color:var(--primary);}.step-label.pending{color:#94A3B8;}
        .step-connector{width:60px;height:2px;margin:0 4px;position:relative;top:20px;}
        .step-connector.done{background:var(--primary);}.step-connector.pending{background:#E2E8F0;}
        .form-card{background:#fff;border-radius:20px;padding:36px;box-shadow:0 4px 24px rgba(0,0,0,.07);border:1px solid #E2E8F0;margin-bottom:12px;}
        .section-header{display:flex;align-items:center;gap:10px;margin-bottom:6px;}
        .section-header h3{font-size:15px;font-weight:700;color:#1E293B;margin:0;}
        .section-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;}
        .si-blue{background:rgba(79,70,229,.1);color:var(--primary);}
        .si-teal{background:rgba(6,182,212,.1);color:var(--accent);}
        .section-desc{font-size:12.5px;color:#94A3B8;margin-bottom:20px;}
        .form-label{font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;}
        .form-control,.form-select{border-radius:10px;border:1.5px solid #E2E8F0;padding:11px 14px;font-size:14px;color:#1E293B;background:#F8FAFC;transition:all .2s;}
        .form-control:focus,.form-select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(79,70,229,.1);background:#fff;}
        .form-control.is-invalid{border-color:#EF4444;}
        .invalid-feedback{font-size:12px;color:#EF4444;}
        .btn-next{background:linear-gradient(135deg,var(--primary),#7C3AED);color:#fff;border:none;border-radius:12px;padding:13px 32px;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;}
        .btn-next:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(79,70,229,.45);}
        .btn-back{background:#F1F5F9;color:#64748B;border:none;border-radius:12px;padding:13px 24px;font-size:14px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
        .btn-back:hover{background:#E2E8F0;color:#475569;}
        .progress-bar-wrap{background:#E2E8F0;border-radius:4px;height:5px;margin-bottom:6px;overflow:hidden;}
        .progress-fill{height:100%;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:4px;}
        .progress-text{font-size:11px;color:#94A3B8;text-align:right;}
        .alert{border:none;border-radius:12px;font-size:13.5px;}
        .alert-danger{background:rgba(239,68,68,.1);color:#7F1D1D;}
        .char-count{font-size:11px;color:#94A3B8;text-align:right;margin-top:3px;}
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
            <div class="step-circle done"><i class="fas fa-check"></i></div>
            <div class="step-label done">Personal</div>
        </div>
        <div class="step-connector done"></div>
        <div class="step-wrapper">
            <div class="step-circle active"><i class="fas fa-map-marker-alt"></i></div>
            <div class="step-label active">Address</div>
        </div>
        <div class="step-connector pending"></div>
        <div class="step-wrapper">
            <div class="step-circle pending">3</div>
            <div class="step-label pending">Review</div>
        </div>
    </div>

    <div class="progress-bar-wrap"><div class="progress-fill" style="width:66%;"></div></div>
    <div class="progress-text mb-4">Step 2 of 3 &mdash; 66% complete</div>

    @if($errors->any())
    <div class="alert alert-danger mb-3">
        <i class="fas fa-circle-exclamation me-2"></i><strong>Please fix the errors below:</strong>
        <ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('form.step2.store') }}" method="POST" novalidate>
        @csrf

        <!-- Address Section -->
        <div class="form-card">
            <div class="section-header">
                <div class="section-icon si-blue"><i class="fas fa-location-dot"></i></div>
                <h3>Address Information</h3>
            </div>
            <div class="section-desc">Enter your current residential address details.</div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="address">Street Address <span style="color:#EF4444">*</span></label>
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $formData['address'] ?? '') }}" placeholder="123 Main Street, Apt 4B">
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="city">City <span style="color:#EF4444">*</span></label>
                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $formData['city'] ?? '') }}" placeholder="New York">
                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="state">State / Province <span style="color:#EF4444">*</span></label>
                    <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $formData['state'] ?? '') }}" placeholder="NY">
                    @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="country">Country <span style="color:#EF4444">*</span></label>
                    <select id="country" name="country" class="form-select @error('country') is-invalid @enderror">
                        <option value="">Select country...</option>
                        @foreach(['Bangladesh','United States','United Kingdom','Canada','Australia','India','Germany','France','Japan','Singapore','Other'] as $c)
                        <option value="{{ $c }}" {{ old('country',$formData['country']??'')===$c?'selected':'' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="zip_code">ZIP / Postal Code <span style="color:#EF4444">*</span></label>
                    <input type="text" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $formData['zip_code'] ?? '') }}" placeholder="10001">
                    @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <!-- Professional Section -->
        <div class="form-card">
            <div class="section-header">
                <div class="section-icon si-teal"><i class="fas fa-briefcase"></i></div>
                <h3>Professional Information</h3>
            </div>
            <div class="section-desc">Tell us about your professional background.</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="occupation">Occupation <span style="color:#EF4444">*</span></label>
                    <input type="text" id="occupation" name="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation', $formData['occupation'] ?? '') }}" placeholder="Software Engineer">
                    @error('occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="company">Company / Organization</label>
                    <input type="text" id="company" name="company" class="form-control" value="{{ old('company', $formData['company'] ?? '') }}" placeholder="Acme Corp (optional)">
                </div>
                <div class="col-12">
                    <label class="form-label" for="experience">Years of Experience <span style="color:#EF4444">*</span></label>
                    <select id="experience" name="experience" class="form-select @error('experience') is-invalid @enderror">
                        <option value="">Select experience level...</option>
                        @foreach(['Less than 1 year'=>'Less than 1 year','1-2 years'=>'1-2 years','3-5 years'=>'3-5 years','6-10 years'=>'6-10 years','10+ years'=>'10+ years'] as $v=>$l)
                        <option value="{{ $v }}" {{ old('experience',$formData['experience']??'')===$v?'selected':'' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                    @error('experience')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="skills">Key Skills</label>
                    <input type="text" id="skills" name="skills" class="form-control" value="{{ old('skills', $formData['skills'] ?? '') }}" placeholder="PHP, Laravel, JavaScript, MySQL... (comma separated)">
                    <div class="char-count">Optional – separate skills with commas</div>
                </div>
                <div class="col-12">
                    <label class="form-label" for="bio">Short Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3" maxlength="1000" oninput="document.getElementById('bio-count').textContent=this.value.length+'/1000'" placeholder="Tell us a little about yourself...">{{ old('bio', $formData['bio'] ?? '') }}</textarea>
                    <div class="char-count"><span id="bio-count">{{ strlen(old('bio', $formData['bio'] ?? '')) }}</span>/1000</div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('form.step1') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
            <button type="submit" class="btn-next">Review & Submit <i class="fas fa-arrow-right ms-1"></i></button>
        </div>
    </form>

    <p style="text-align:center;font-size:12.5px;color:#94A3B8;margin-top:16px;"><i class="fas fa-lock me-1"></i> Your information is secure and encrypted.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
