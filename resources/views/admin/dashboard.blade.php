@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

<!-- Welcome Banner -->
<div style="background:linear-gradient(135deg,#4F46E5,#7C3AED,#06B6D4);border-radius:20px;padding:28px 32px;color:#fff;margin-bottom:28px;position:relative;overflow:hidden;">
    <div style="position:absolute;right:-20px;top:-20px;width:180px;height:180px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
    <div style="position:absolute;right:60px;bottom:-40px;width:120px;height:120px;background:rgba(255,255,255,.04);border-radius:50%;"></div>
    <h2 style="font-size:22px;font-weight:800;margin-bottom:4px;">Welcome back, {{ Str::words(auth()->user()->name, 1, '') }}! 👋</h2>
    <p style="font-size:14px;opacity:.8;margin:0;">Here's what's happening with your platform today.</p>
    <div style="display:flex;gap:16px;margin-top:18px;flex-wrap:wrap;">
        <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:10px 18px;font-size:13px;font-weight:600;">
            <i class="fas fa-calendar me-2"></i>{{ now()->format('l, d M Y') }}
        </div>
        <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:10px 18px;font-size:13px;font-weight:600;">
            <i class="fas fa-fingerprint me-2"></i>{{ auth()->user()->user_uid }}
        </div>
    </div>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(79,70,229,.1);color:#4F46E5;"><i class="fas fa-users"></i></div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(6,182,212,.1);color:#06B6D4;"><i class="fas fa-file-lines"></i></div>
            <div class="stat-value">{{ $stats['total_submissions'] }}</div>
            <div class="stat-label">Total Submissions</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(16,185,129,.1);color:#10B981;"><i class="fas fa-user-plus"></i></div>
            <div class="stat-value">{{ $stats['new_today'] }}</div>
            <div class="stat-label">New Today</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(245,158,11,.1);color:#F59E0B;"><i class="fas fa-clock-rotate-left"></i></div>
            <div class="stat-value">{{ $stats['first_logins'] }}</div>
            <div class="stat-label">Pending Password Set</div>
        </div>
    </div>
</div>

<!-- Recent Submissions Table -->
<div class="data-table">
    <div class="table-header">
        <h3 class="table-title"><i class="fas fa-clock me-2" style="color:#4F46E5;"></i>Recent Submissions</h3>
        <a href="{{ route('admin.submissions') }}" class="btn-primary-custom" style="font-size:13px;padding:8px 18px;">
            View All <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    @if($recentSubmissions->isEmpty())
    <div style="padding:48px;text-align:center;color:#94A3B8;">
        <i class="fas fa-inbox" style="font-size:40px;margin-bottom:12px;display:block;"></i>
        <p style="margin:0;font-size:14px;">No submissions yet.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>User ID</th>
                    <th>Occupation</th>
                    <th>Location</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentSubmissions as $sub)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;background:linear-gradient(135deg,#4F46E5,#06B6D4);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0;">
                                {{ strtoupper(substr($sub->first_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px;color:#1E293B;">{{ $sub->first_name }} {{ $sub->last_name }}</div>
                                <div style="font-size:12px;color:#94A3B8;">{{ $sub->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span style="font-family:monospace;font-size:13px;font-weight:600;color:#4F46E5;">{{ $sub->user->user_uid }}</span></td>
                    <td style="font-size:13.5px;">{{ $sub->occupation }}</td>
                    <td style="font-size:13.5px;color:#64748B;">{{ $sub->city }}, {{ $sub->country }}</td>
                    <td style="font-size:13px;color:#64748B;">{{ $sub->created_at->format('d M Y') }}</td>
                    <td>
                        <span class="status-badge {{ $sub->user->is_first_login ? 'status-pending' : 'status-active' }}">
                            {{ $sub->user->is_first_login ? 'Pending' : 'Active' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.submission.show', $sub) }}" style="color:#4F46E5;font-size:13px;text-decoration:none;font-weight:600;">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
