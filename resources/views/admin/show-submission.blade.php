@extends('layouts.app')
@section('title', 'View Submission')
@section('page-title', 'Submission Detail')

@section('content')
<div style="margin-bottom:16px;">
    <a href="{{ route('admin.submissions') }}" style="color:#64748B;text-decoration:none;font-size:13.5px;font-weight:500;">
        <i class="fas fa-arrow-left me-1"></i> Back to All Submissions
    </a>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="app-card">
            <div class="app-card-body" style="text-align:center;padding:32px;">
                <div style="width:80px;height:80px;background:linear-gradient(135deg,#4F46E5,#06B6D4);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;font-weight:800;margin:0 auto 16px;">
                    {{ strtoupper(substr($submission->first_name,0,1)) }}
                </div>
                <h3 style="font-size:20px;font-weight:800;color:#1E293B;margin-bottom:4px;">{{ $submission->first_name }} {{ $submission->last_name }}</h3>
                <p style="font-size:13.5px;color:#64748B;margin-bottom:16px;">{{ $submission->occupation }}</p>
                <div style="background:#F8FAFC;border-radius:12px;padding:14px;margin-bottom:16px;">
                    <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">User ID</div>
                    <div style="font-size:22px;font-weight:800;color:#4F46E5;font-family:monospace;letter-spacing:2px;">{{ $submission->user->user_uid }}</div>
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;text-align:left;">
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-envelope" style="color:#4F46E5;width:16px;"></i> {{ $submission->user->email }}
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-phone" style="color:#4F46E5;width:16px;"></i> {{ $submission->phone }}
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-location-dot" style="color:#4F46E5;width:16px;"></i> {{ $submission->city }}, {{ $submission->country }}
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.5px;color:#475569;">
                        <i class="fas fa-calendar" style="color:#4F46E5;width:16px;"></i> Born: {{ \Carbon\Carbon::parse($submission->date_of_birth)->format('d M Y') }}
                    </div>
                </div>
                <div style="margin-top:16px;">
                    <span class="status-badge {{ $submission->user->is_first_login ? 'status-pending' : 'status-active' }}" style="font-size:12px;">
                        <i class="fas fa-circle me-1" style="font-size:8px;"></i>
                        {{ $submission->user->is_first_login ? 'Awaiting Password Setup' : 'Active Account' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="app-card" style="margin-top:16px;">
            <div class="app-card-header" style="font-size:13px;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:1px;">Quick Actions</div>
            <div class="app-card-body" style="padding:16px;display:flex;flex-direction:column;gap:8px;">
                <form action="{{ route('admin.user.toggle', $submission->user) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" style="width:100%;background:#FEF3C7;color:#92400E;border:none;border-radius:10px;padding:10px 14px;font-size:13px;font-weight:600;cursor:pointer;text-align:left;">
                        <i class="fas fa-key me-2"></i> {{ $submission->user->is_first_login ? 'Remove Password Reset Requirement' : 'Force Password Reset' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="col-lg-8">
        <!-- Personal Info -->
        <div class="app-card mb-4">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-user" style="color:#4F46E5;"></i> Personal Information
            </div>
            <div class="app-card-body">
                <div class="row g-3">
                    @foreach(['Gender'=>ucwords(str_replace('_',' ',$submission->gender)),'Phone'=>$submission->phone,'Date of Birth'=>\Carbon\Carbon::parse($submission->date_of_birth)->format('d M Y'),'Age'=>\Carbon\Carbon::parse($submission->date_of_birth)->age.' years','Account Created'=>$submission->created_at->format('d M Y, h:i A'),'Last Updated'=>$submission->updated_at->diffForHumans()] as $label=>$value)
                    <div class="col-md-6">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">{{ $label }}</div>
                            <div style="font-size:14px;color:#1E293B;font-weight:500;">{{ $value }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="app-card mb-4">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-location-dot" style="color:#06B6D4;"></i> Address Information
            </div>
            <div class="app-card-body">
                <div class="row g-3">
                    @foreach(['Street Address'=>$submission->address,'City'=>$submission->city,'State'=>$submission->state,'Country'=>$submission->country,'ZIP Code'=>$submission->zip_code] as $l=>$v)
                    <div class="col-md-6 {{ $l==='Street Address'?'col-md-12':'' }}">
                        <div style="background:#F8FAFC;border-radius:10px;padding:14px;">
                            <div style="font-size:11px;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">{{ $l }}</div>
                            <div style="font-size:14px;color:#1E293B;font-weight:500;">{{ $v }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Professional -->
        <div class="app-card">
            <div class="app-card-header" style="display:flex;align-items:center;gap:8px;">
                <i class="fas fa-briefcase" style="color:#10B981;"></i> Professional Information
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
@endsection
