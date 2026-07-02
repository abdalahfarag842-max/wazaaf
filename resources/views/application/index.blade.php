<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications – Wazaaf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f0f2f8; font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; }
        .navbar-custom { background: #fff; border-bottom: 1px solid #e5e9f0; height: 64px; position: sticky; top: 0; z-index: 100; display: flex; align-items: center; padding: 0 32px; }
        .navbar-brand-custom { display: flex; align-items: center; gap: 8px; font-size: 20px; font-weight: 700; color: #1a56db; text-decoration: none; }
        .navbar-brand-custom .brand-icon { background: #1a56db; color: #fff; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .nav-links { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .nav-links a { font-size: 14px; color: #6b7280; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; border-bottom: 2px solid transparent; transition: all 0.15s; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .notif-btn { position: relative; background: none; border: none; cursor: pointer; color: #6b7280; font-size: 18px; padding: 4px; text-decoration: none; }
        .notif-badge { position: absolute; top: -2px; right: -4px; background: #ef4444; color: #fff; font-size: 10px; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .btn-logout-nav { background: none; border: none; color: #6b7280; font-size: 13px; cursor: pointer; padding: 4px 8px; }
        .btn-logout-nav:hover { color: #ef4444; }
        .page-wrapper { max-width: 900px; margin: 40px auto; padding: 0 24px 60px; }
        .page-header { margin-bottom: 28px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .page-subtitle { font-size: 14px; color: #6b7280; }
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 28px; }
        .stat-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 12px; padding: 18px 20px; }
        .stat-number { font-size: 28px; font-weight: 800; color: #0f172a; }
        .stat-label { font-size: 12px; color: #9ca3af; font-weight: 500; margin-top: 2px; }
        .stat-card.pending .stat-number { color: #f59e0b; }
        .stat-card.reviewed .stat-number { color: #1a56db; }
        .stat-card.accepted .stat-number { color: #16a34a; }
        .stat-card.rejected .stat-number { color: #ef4444; }
        .app-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 14px; padding: 22px 24px; margin-bottom: 14px; display: flex; align-items: center; gap: 16px; transition: box-shadow 0.15s; }
        .app-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .app-logo { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; color: #fff; flex-shrink: 0; }
        .app-info { flex: 1; }
        .app-title { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 3px; text-decoration: none; }
        .app-title:hover { color: #1a56db; }
        .app-meta { font-size: 13px; color: #6b7280; display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .app-meta span { display: flex; align-items: center; gap: 4px; }
        .app-right { text-align: right; flex-shrink: 0; }
        .status-badge { font-size: 12px; padding: 5px 14px; border-radius: 20px; font-weight: 600; display: inline-block; }
        .status-pending  { background: #fef9c3; color: #a16207; }
        .status-reviewed { background: #dbeafe; color: #1d4ed8; }
        .status-accepted { background: #dcfce7; color: #16a34a; }
        .status-rejected { background: #fee2e2; color: #dc2626; }
        .app-date { font-size: 12px; color: #9ca3af; margin-top: 6px; }
        .empty-state { text-align: center; padding: 80px 40px; background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; }
        .empty-icon { font-size: 52px; margin-bottom: 16px; opacity: 0.25; }
        .empty-title { font-size: 18px; font-weight: 700; color: #374151; margin-bottom: 8px; }
        .empty-text { font-size: 14px; color: #9ca3af; margin-bottom: 24px; }
        .btn-find-jobs { background: #1a3a8f; color: #fff; padding: 12px 28px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; }
        .btn-find-jobs:hover { background: #1447b8; color: #fff; }
    </style>
</head>
<body>

<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('candidate.home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>
    <div class="nav-links">
        <a href="{{ route('candidate.home') }}">Home</a>
        <a href="{{ route('candidate.jobs.index') }}">Browse Jobs</a>
        <a href="{{ route('candidate.applications.index') }}" class="active">My Applications</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('candidate.notifications.index') }}" class="notif-btn">
            <i class="fas fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

<div class="page-wrapper">
    <div class="page-header">
        <h1 class="page-title">My Applications</h1>
        <p class="page-subtitle">Track the status of all your job applications.</p>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #bbf7d0;border-radius:10px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-size:14px;color:#16a34a;font-weight:500;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @php
        $total    = $applications->count();
        $pending  = $applications->where('status','pending')->count();
        $reviewed = $applications->where('status','reviewed')->count();
        $accepted = $applications->where('status','accepted')->count();
        $rejected = $applications->where('status','rejected')->count();
    @endphp

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-number">{{ $total }}</div>
            <div class="stat-label">Total Applications</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-number">{{ $pending }}</div>
            <div class="stat-label">Pending Review</div>
        </div>
        <div class="stat-card accepted">
            <div class="stat-number">{{ $accepted }}</div>
            <div class="stat-label">Accepted</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-number">{{ $rejected }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    @if($applications->count())
        @php
            $logoColors = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#06b6d4'];
            $statusMap  = [
                'pending'  => ['class'=>'status-pending',  'label'=>'Pending',  'icon'=>'fas fa-clock'],
                'reviewed' => ['class'=>'status-reviewed', 'label'=>'Reviewed', 'icon'=>'fas fa-eye'],
                'accepted' => ['class'=>'status-accepted', 'label'=>'Accepted', 'icon'=>'fas fa-check-circle'],
                'rejected' => ['class'=>'status-rejected', 'label'=>'Rejected', 'icon'=>'fas fa-times-circle'],
            ];
        @endphp

        @foreach($applications as $i => $app)
            @php
                $color = $logoColors[$i % count($logoColors)];
                $st = $statusMap[$app->status] ?? ['class'=>'status-pending','label'=>ucfirst($app->status),'icon'=>'fas fa-circle'];
            @endphp
            <div class="app-card">
                <div class="app-logo" style="background:{{ $color }}">
                    {{ strtoupper(substr($app->job->title ?? 'J', 0, 1)) }}
                </div>
                <div class="app-info">
                    <a href="{{ route('candidate.jobs.show', $app->job) }}" class="app-title">
                        {{ $app->job->title ?? 'Job Deleted' }}
                    </a>
                    <div class="app-meta">
                        <span><i class="fas fa-building" style="font-size:11px;color:#1a56db;"></i> {{ $app->job->category->name ?? '—' }}</span>
                        <span><i class="fas fa-map-marker-alt" style="font-size:11px;"></i> {{ $app->job->location ?? '—' }}</span>
                        @if($app->job->salary)
                            <span><i class="fas fa-money-bill-wave" style="font-size:11px;color:#16a34a;"></i> EGP {{ number_format($app->job->salary, 0) }}</span>
                        @endif
                    </div>
                </div>
                <div class="app-right">
                    <span class="status-badge {{ $st['class'] }}">
                        <i class="{{ $st['icon'] }}" style="font-size:10px;"></i> {{ $st['label'] }}
                    </span>
                    <div class="app-date">Applied {{ $app->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @endforeach

    @else
        <div class="empty-state">
            <div class="empty-icon"></div>
            <div class="empty-title">No Applications Yet</div>
            <p class="empty-text">You haven't applied to any jobs yet.<br>Start exploring opportunities!</p>
            <a href="{{ route('candidate.jobs.index') }}" class="btn-find-jobs">
                <i class="fas fa-search"></i> Find Jobs
            </a>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>