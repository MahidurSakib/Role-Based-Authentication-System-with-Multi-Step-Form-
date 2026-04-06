@extends('layouts.app')
@section('title', 'All Submissions')
@section('page-title', 'All Submissions')

@section('content')
<div class="data-table">
    <div class="table-header" style="flex-wrap:wrap;gap:12px;">
        <h3 class="table-title"><i class="fas fa-file-lines me-2" style="color:#4F46E5;"></i>All Submissions</h3>
        <form action="{{ route('admin.submissions') }}" method="GET" style="display:flex;gap:8px;flex:1;max-width:380px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, ID, city..." style="flex:1;border:1.5px solid #E2E8F0;border-radius:10px;padding:9px 14px;font-size:13.5px;font-family:'Inter',sans-serif;background:#F8FAFC;outline:none;">
            <button type="submit" style="background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;border-radius:10px;padding:0 16px;font-size:13px;cursor:pointer;">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ route('admin.submissions') }}" style="background:#F1F5F9;color:#64748B;border:none;border-radius:10px;padding:0 14px;font-size:13px;cursor:pointer;display:flex;align-items:center;text-decoration:none;"><i class="fas fa-xmark"></i></a>
            @endif
        </form>
        <div style="font-size:13px;color:#64748B;align-self:center;">{{ $submissions->total() }} records</div>
    </div>

    @if($submissions->isEmpty())
    <div style="padding:60px;text-align:center;color:#94A3B8;">
        <i class="fas fa-search" style="font-size:40px;margin-bottom:12px;display:block;"></i>
        <p style="margin:0;font-size:14px;">{{ request('search') ? 'No results found for "'.request('search').'".' : 'No submissions yet.' }}</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>User ID</th><th>Occupation</th><th>Location</th><th>Experience</th><th>Joined</th><th>Status</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $i => $sub)
                <tr>
                    <td style="color:#94A3B8;font-size:13px;">{{ $submissions->firstItem() + $i }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;background:linear-gradient(135deg,#4F46E5,#06B6D4);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">{{ strtoupper(substr($sub->first_name,0,1)) }}</div>
                            <div>
                                <div style="font-weight:600;font-size:13.5px;">{{ $sub->first_name }} {{ $sub->last_name }}</div>
                                <div style="font-size:12px;color:#94A3B8;">{{ $sub->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span style="font-family:monospace;font-size:12.5px;font-weight:600;color:#4F46E5;">{{ $sub->user->user_uid }}</span></td>
                    <td style="font-size:13px;">{{ $sub->occupation }}</td>
                    <td style="font-size:13px;color:#64748B;">{{ $sub->city }}, {{ $sub->country }}</td>
                    <td style="font-size:13px;">{{ $sub->experience }}</td>
                    <td style="font-size:12.5px;color:#94A3B8;">{{ $sub->created_at->format('d M Y') }}</td>
                    <td><span class="status-badge {{ $sub->user->is_first_login ? 'status-pending' : 'status-active' }}">{{ $sub->user->is_first_login ? 'Pending' : 'Active' }}</span></td>
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
    <div style="padding:16px 24px;border-top:1px solid #E2E8F0;">
        {{ $submissions->links() }}
    </div>
    @endif
</div>
@endsection
