@extends('layouts.app')
@section('title', 'My Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

<!-- Welcome Banner -->
<div style="background:linear-gradient(135deg,#059669,#0891B2);border-radius:20px;padding:28px 32px;color:#fff;margin-bottom:28px;position:relative;overflow:hidden;">
    <div style="position:absolute;right:-20px;top:-20px;width:180px;height:180px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
    <h2 style="font-size:22px;font-weight:800;margin-bottom:4px;">Welcome, {{ Str::words(auth()->user()->name, 1, '') }}! 🎉</h2>
    <p style="font-size:14px;opacity:.8;margin:0;">Your profile is set up and your account is active.</p>
    <div style="display:flex;gap:16px;margin-top:18px;flex-wrap:wrap;">
        <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:10px 18px;font-size:13px;font-weight:600;">
            <i class="fas fa-fingerprint me-2"></i>{{ auth()->user()->user_uid }}
        </div>
        <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:10px 18px;font-size:13px;font-weight:600;">
            <i class="fas fa-calendar me-2"></i>Member since {{ auth()->user()->created_at->format('M Y') }}
        </div>
    </div>
</div>

@if($submission)
<div class="row g-4">
    <!-- Profile Summary -->
    <div class="col-lg-4">
        <div class="app-card">
            <div class="app-card-body" style="text-align:center;padding:32px;" id="profile">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#059669,#0891B2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;font-weight:800;margin:0 auto 16px;">
                    {{ strtoupper(substr($submission->first_name,0,1)) }}
                </div>
                <h3 style="font-size:20px;font-weight:800;color:#1E293B;margin-bottom:4px;">{{ $submission->first_name }} {{ $submission->last_name }}</h3>
                <p style="font-size:13.5px;color:#64748B;margin-bottom:4px;">{{ $submission->occupation }}</p>
                @if($submission->company)<p style="font-size:13px;color:#94A3B8;margin-bottom:16px;">@ {{ $submission->company }}</p>@endif
                <div style="background:#F8FAFC;border-radius:12px;padding:14px;margin-bottom:16px;">
                    <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">Your User ID</div>
                    <div style="font-size:20px;font-weight:800;color:#4F46E5;font-family:monospace;letter-spacing:2px;">{{ auth()->user()->user_uid }}</div>
                </div>
                <span class="status-badge status-active"><i class="fas fa-circle me-1" style="font-size:8px;"></i> Active Account</span>

                <div style="margin-top:20px;border-top:1px solid #F1F5F9;padding-top:20px;text-align:left;display:flex;flex-direction:column;gap:10px;">
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-envelope" style="color:#4F46E5;width:16px;"></i> {{ auth()->user()->email }}
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-phone" style="color:#4F46E5;width:16px;"></i> {{ $submission->phone }}
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-location-dot" style="color:#4F46E5;width:16px;"></i> {{ $submission->city }}, {{ $submission->country }}
                    </div>
                </div>

                <div style="margin-top:16px;">
                    <a href="{{ route('password.change') }}" style="display:inline-flex;align-items:center;gap:6px;padding:9px 18px;background:rgba(79,70,229,.1);color:#4F46E5;border-radius:10px;font-size:13px;font-weight:600;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='rgba(79,70,229,.15)'" onmouseout="this.style.background='rgba(79,70,229,.1)'">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Details -->
    <div class="col-lg-8">
        <!-- Personal Details -->
        <div class="app-card mb-4">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-user" style="color:#4F46E5;"></i> Personal Information
            </div>
            <div class="app-card-body">
                <div class="row g-3">
                    @foreach(['Date of Birth'=>\Carbon\Carbon::parse($submission->date_of_birth)->format('d M Y'),'Gender'=>ucwords(str_replace('_',' ',$submission->gender)),'Phone'=>$submission->phone,'Age'=>\Carbon\Carbon::parse($submission->date_of_birth)->age.' years old'] as $l=>$v)
                    <div class="col-md-6">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">{{ $l }}</div>
                            <div style="font-size:14px;color:#1E293B;font-weight:500;">{{ $v }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="app-card mb-4">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-location-dot" style="color:#06B6D4;"></i> Address
            </div>
            <div class="app-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Full Address</div>
                            <div style="font-size:14px;color:#1E293B;font-weight:500;">{{ $submission->address }}, {{ $submission->city }}, {{ $submission->state }}, {{ $submission->country }} {{ $submission->zip_code }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional -->
        <div class="app-card">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-briefcase" style="color:#10B981;"></i> Professional Background
            </div>
            <div class="app-card-body">
                <div class="row g-3">
                    @foreach(['Occupation'=>$submission->occupation,'Company'=>($submission->company??'—'),'Experience'=>$submission->experience] as $l=>$v)
                    <div class="col-md-4">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">{{ $l }}</div>
                            <div style="font-size:14px;color:#1E293B;font-weight:500;">{{ $v }}</div>
                        </div>
                    </div>
                    @endforeach
                    @if($submission->skills)
                    <div class="col-12">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">Skills</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                @foreach(explode(',',$submission->skills) as $skill)
                                <span style="background:rgba(79,70,229,.1);color:#4F46E5;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($submission->bio)
                    <div class="col-12">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Bio</div>
                            <div style="font-size:14px;color:#475569;line-height:1.7;">{{ $submission->bio }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div style="background:#fff;border-radius:20px;padding:60px;text-align:center;border:1px solid #E2E8F0;box-shadow:0 4px 24px rgba(0,0,0,.07);">
    <i class="fas fa-file-circle-question" style="font-size:48px;color:#CBD5E1;margin-bottom:16px;display:block;"></i>
    <h3 style="font-size:18px;font-weight:700;color:#1E293B;margin-bottom:8px;">No Profile Data Found</h3>
    <p style="font-size:14px;color:#64748B;">Your profile information is not available. Please contact the admin.</p>
</div>
@endif

@endsection
