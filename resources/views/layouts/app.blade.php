<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RBAC System') – Dashboard</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary:    #4F46E5;
            --primary-dark: #3730A3;
            --accent:     #06B6D4;
            --success:    #10B981;
            --warning:    #F59E0B;
            --danger:     #EF4444;
            --sidebar-w:  260px;
            --sidebar-bg: #0F172A;
            --sidebar-text: rgba(255,255,255,.75);
            --sidebar-active: rgba(255,255,255,.1);
            --topbar-h:   64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F1F5F9;
            color: #1E293B;
            margin: 0;
        }

        /* ── Sidebar ── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform .3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
            margin-bottom: 8px;
        }

        .sidebar-brand .brand-name {
            font-size: 16px; font-weight: 700;
            color: #fff; margin: 0;
        }

        .sidebar-brand .brand-sub {
            font-size: 11px; color: rgba(255,255,255,.4);
            text-transform: uppercase; letter-spacing: 1px;
        }

        .sidebar-nav { flex: 1; padding: 16px 0; }

        .nav-section-label {
            font-size: 10px; font-weight: 600;
            color: rgba(255,255,255,.3);
            text-transform: uppercase; letter-spacing: 1.5px;
            padding: 12px 24px 4px;
        }

        .sidebar-nav a {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 24px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 13.5px; font-weight: 500;
            border-radius: 0;
            transition: all .2s;
            position: relative;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            color: #fff;
            background: var(--sidebar-active);
        }

        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--primary);
            border-radius: 0 4px 4px 0;
        }

        .sidebar-nav a .nav-icon {
            width: 18px; text-align: center;
            font-size: 14px;
        }

        .sidebar-nav .badge-count {
            margin-left: auto;
            background: var(--primary);
            color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 12px;
        }

        .sidebar-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 14px;
            flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,.4); }

        .btn-logout {
            display: flex; align-items: center; gap: 8px;
            width: 100%;
            padding: 9px 14px;
            background: rgba(239,68,68,.15);
            color: #FCA5A5;
            border: none;
            border-radius: 8px;
            font-size: 13px; font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-logout:hover { background: rgba(239,68,68,.25); color: #FCA5A5; }

        /* ── Main Content ── */
        #main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Bar ── */
        .topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #E2E8F0;
            display: flex; align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky; top: 0; z-index: 100;
        }

        .topbar-title { font-size: 18px; font-weight: 700; color: #1E293B; flex: 1; }

        .topbar-badge {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }

        /* ── Page Content ── */
        .page-content { padding: 28px; flex: 1; }

        /* ── Stat Cards ── */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            border: 1px solid #E2E8F0;
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,.1); }

        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .stat-value { font-size: 32px; font-weight: 800; color: #1E293B; line-height: 1; }
        .stat-label { font-size: 13px; font-weight: 500; color: #64748B; margin-top: 4px; }

        .stat-change { font-size: 12px; margin-top: 8px; }
        .stat-change.up   { color: var(--success); }
        .stat-change.down { color: var(--danger); }

        /* ── Data Table ── */
        .data-table { background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #E2E8F0; }
        .data-table .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #E2E8F0;
            display: flex; align-items: center; justify-content: space-between;
        }
        .data-table .table-title { font-size: 16px; font-weight: 700; color: #1E293B; margin: 0; }

        .table > :not(caption) > * > * { padding: .85rem 1.2rem; }
        .table thead { background: #F8FAFC; }
        .table thead th { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748B; border-bottom: 0; }
        .table tbody tr { transition: background .15s; }
        .table tbody tr:hover { background: #F8FAFC; }

        /* ── Cards ── */
        .app-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }
        .app-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #E2E8F0;
            font-size: 15px; font-weight: 700;
        }
        .app-card-body { padding: 24px; }

        /* ── Badges & Pills ── */
        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .5px;
        }
        .role-admin  { background: rgba(79,70,229,.1);  color: var(--primary); }
        .role-user   { background: rgba(6,182,212,.1);  color: var(--accent); }

        .status-badge {
            padding: 4px 12px; border-radius: 20px;
            font-size: 11px; font-weight: 600;
        }
        .status-active  { background: rgba(16,185,129,.1); color: var(--success); }
        .status-pending { background: rgba(245,158,11,.1);  color: var(--warning); }

        /* ── Alert ── */
        .alert { border: none; border-radius: 12px; font-size: 14px; }
        .alert-success { background: rgba(16,185,129,.1); color: #065F46; }
        .alert-danger   { background: rgba(239,68,68,.1);  color: #7F1D1D; }
        .alert-info     { background: rgba(6,182,212,.1);  color: #164E63; }
        .alert-warning  { background: rgba(245,158,11,.1); color: #78350F; }

        /* ── Buttons ── */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #7C3AED);
            color: #fff; border: none;
            padding: 10px 22px; border-radius: 10px;
            font-size: 14px; font-weight: 600;
            transition: all .2s; cursor: pointer;
        }
        .btn-primary-custom:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(79,70,229,.4); color: #fff; }

        /* ── Mobile ── */
        #sidebar-toggle { display: none; }

        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #main-content { margin-left: 0; }
            #sidebar-toggle { display: flex; align-items: center; background: none; border: none; font-size: 20px; color: #1E293B; }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 3px; }
    </style>

    @stack('styles')
</head>
<body>

<!-- ──────────────────────── Sidebar ──────────────────────── -->
<div id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-shield-halved"></i></div>
        <div class="brand-name">RBAC System</div>
        <div class="brand-sub">Role-Based Access Control</div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isAdmin())
            <div class="nav-section-label">Admin Panel</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-gauge-high"></i></span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-users"></i></span> Manage Users
            </a>
            <a href="{{ route('admin.submissions') }}" class="{{ request()->routeIs('admin.submissions') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-file-lines"></i></span> All Submissions
            </a>
        @else
            <div class="nav-section-label">My Account</div>
            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fas fa-gauge"></i></span> Dashboard
            </a>
            <a href="{{ route('user.dashboard') }}#profile">
                <span class="nav-icon"><i class="fas fa-id-card"></i></span> My Profile
            </a>
        @endif

        <div class="nav-section-label" style="margin-top:16px;">Security</div>
        <a href="{{ route('password.change') }}" class="{{ request()->routeIs('password.change') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-lock"></i></span> Change Password
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ Str::limit(auth()->user()->name, 18) }}</div>
                <div class="sidebar-user-role">{{ ucfirst(auth()->user()->role) }} · {{ auth()->user()->user_uid }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-right-from-bracket"></i> Sign Out
            </button>
        </form>
    </div>
</div>

<!-- ──────────────────────── Main ──────────────────────── -->
<div id="main-content">
    <!-- Top Bar -->
    <div class="topbar">
        <button id="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
            <i class="fas fa-bars"></i>
        </button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <span class="topbar-badge">
            <i class="fas fa-circle-check me-1" style="font-size:10px;"></i>
            {{ ucfirst(auth()->user()->role) }}
        </span>
    </div>

    <!-- Flash Messages -->
    <div style="padding: 16px 28px 0;">
        @foreach(['success','error','info','warning'] as $type)
            @if(session($type))
                <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show" role="alert">
                    {{ session($type) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Page Content -->
    <div class="page-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
