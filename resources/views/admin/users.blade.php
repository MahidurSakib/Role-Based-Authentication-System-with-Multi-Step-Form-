@extends('layouts.app')
@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')
<div class="data-table">
    <div class="table-header" style="flex-wrap:wrap;gap:12px;">
        <h3 class="table-title"><i class="fas fa-users me-2" style="color:#4F46E5;"></i>All Users</h3>
        <form action="{{ route('admin.users') }}" method="GET" style="display:flex;gap:8px;flex:1;max-width:380px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, user ID..." style="flex:1;border:1.5px solid #E2E8F0;border-radius:10px;padding:9px 14px;font-size:13.5px;font-family:'Inter',sans-serif;background:#F8FAFC;outline:none;">
            <button type="submit" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;border-radius:10px;padding:0 16px;font-size:13px;cursor:pointer;"><i class="fas fa-search"></i></button>
            @if(request('search'))<a href="{{ route('admin.users') }}" style="background:#F1F5F9;color:#64748B;border:none;border-radius:10px;padding:0 14px;font-size:13px;cursor:pointer;display:flex;align-items:center;text-decoration:none;"><i class="fas fa-xmark"></i></a>@endif
        </form>
        <div style="font-size:13px;color:#64748B;align-self:center;">{{ $users->total() }} users</div>
    </div>

    @if($users->isEmpty())
    <div style="padding:60px;text-align:center;color:#94A3B8;">
        <i class="fas fa-users" style="font-size:40px;margin-bottom:12px;display:block;"></i>
        <p style="margin:0;font-size:14px;">No users found.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr><th>#</th><th>User</th><th>User ID</th><th>Role</th><th>Password Status</th><th>Joined</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach($users as $i => $user)
                <tr>
                    <td style="color:#94A3B8;font-size:13px;">{{ $users->firstItem() + $i }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;background:linear-gradient(135deg,#4F46E5,#06B6D4);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">{{ strtoupper(substr($user->name,0,1)) }}</div>
                            <div>
                                <div style="font-weight:600;font-size:13.5px;color:#1E293B;">{{ $user->name }}</div>
                                <div style="font-size:12px;color:#94A3B8;">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span style="font-family:monospace;font-size:13px;font-weight:600;color:#4F46E5;">{{ $user->user_uid }}</span></td>
                    <td><span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td>
                        <span class="status-badge {{ $user->is_first_login ? 'status-pending' : 'status-active' }}">
                            {{ $user->is_first_login ? 'Pending Setup' : 'Password Set' }}
                        </span>
                    </td>
                    <td style="font-size:12.5px;color:#94A3B8;">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            @if($user->formSubmission)
                            <a href="{{ route('admin.submission.show', $user->formSubmission) }}" style="color:#4F46E5;font-size:12px;text-decoration:none;font-weight:600;padding:4px 10px;background:rgba(79,70,229,.08);border-radius:6px;">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            @endif
                            <form action="{{ route('admin.user.toggle', $user) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" style="color:#F59E0B;font-size:12px;font-weight:600;padding:4px 10px;background:rgba(245,158,11,.08);border-radius:6px;border:none;cursor:pointer;">
                                    <i class="fas fa-key me-1"></i>{{ $user->is_first_login ? 'Unlock' : 'Reset' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px 24px;border-top:1px solid #E2E8F0;">{{ $users->links() }}</div>
    @endif
</div>
@endsection
