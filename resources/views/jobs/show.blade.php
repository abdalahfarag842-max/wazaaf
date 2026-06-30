<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} – Wazaaf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f0f2f8; font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; }

        /* NAVBAR */
        .navbar-custom { background: #fff; border-bottom: 1px solid #e5e9f0; height: 64px; position: sticky; top: 0; z-index: 100; display: flex; align-items: center; padding: 0 32px; }
        .navbar-brand-custom { display: flex; align-items: center; gap: 8px; font-size: 20px; font-weight: 700; color: #1a56db; text-decoration: none; }
        .navbar-brand-custom .brand-icon { background: #1a56db; color: #fff; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .nav-links { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .nav-links a { font-size: 14px; color: #6b7280; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; transition: all 0.15s; border-bottom: 2px solid transparent; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .notif-btn { position: relative; background: none; border: none; cursor: pointer; color: #6b7280; font-size: 18px; padding: 4px; text-decoration: none; }
        .notif-badge { position: absolute; top: -2px; right: -4px; background: #ef4444; color: #fff; font-size: 10px; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .user-menu { display: flex; align-items: center; gap: 8px; padding: 4px 8px; border-radius: 8px; }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .btn-logout-nav { background: none; border: none; color: #6b7280; font-size: 13px; cursor: pointer; padding: 4px 8px; }
        .btn-logout-nav:hover { color: #ef4444; }

        /* PAGE */
        .page-wrapper { max-width: 860px; margin: 40px auto; padding: 0 24px 60px; }

        /* BACK LINK */
        .back-link { display: inline-flex; align-items: center; gap: 6px; color: #6b7280; text-decoration: none; font-size: 14px; margin-bottom: 24px; font-weight: 500; }
        .back-link:hover { color: #1a56db; }

        /* JOB HEADER CARD */
        .job-header-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; padding: 32px; margin-bottom: 24px; }
        .job-header-top { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 24px; }
        .job-logo-big { width: 64px; height: 64px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; color: #fff; flex-shrink: 0; }
        .job-header-info { flex: 1; }
        .job-header-title { font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .job-company-name { font-size: 15px; color: #1a56db; font-weight: 600; display: flex; align-items: center; gap: 6px; margin-bottom: 12px; }
        .job-badges { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .badge-pill { font-size: 12px; padding: 5px 14px; border-radius: 20px; font-weight: 600; }
        .badge-open { background: #dcfce7; color: #16a34a; }
        .badge-closed { background: #fee2e2; color: #dc2626; }
        .badge-fulltime { background: #dcfce7; color: #16a34a; }
        .badge-parttime { background: #fef9c3; color: #ca8a04; }
        .badge-remote { background: #e0f2fe; color: #0369a1; }
        .badge-internship { background: #f3e8ff; color: #7c3aed; }

        .job-stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; padding-top: 24px; border-top: 1px solid #f3f4f6; }
        .job-stat { text-align: center; }
        .job-stat-icon { font-size: 20px; margin-bottom: 4px; }
        .job-stat-value { font-size: 16px; font-weight: 700; color: #0f172a; }
        .job-stat-label { font-size: 12px; color: #9ca3af; margin-top: 2px; }

        /* DESCRIPTION CARD */
        .content-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; padding: 32px; margin-bottom: 24px; }
        .content-card h2 { font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .content-card h2 i { color: #1a56db; font-size: 16px; }
        .job-description { font-size: 14px; color: #374151; line-height: 1.8; white-space: pre-wrap; }

        /* ACTION BUTTONS */
        .actions-card { background: #fff; border: 1px solid #e5e9f0; border-radius: 16px; padding: 28px; display: flex; gap: 16px; align-items: center; }
        .btn-apply { background: #1a3a8f; color: #fff; border: none; padding: 14px 32px; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: background 0.15s; }
        .btn-apply:hover { background: #1447b8; color: #fff; }
        .btn-apply:disabled, .btn-apply.disabled { background: #9ca3af; cursor: not-allowed; }
        .btn-back { background: #f3f4f6; color: #374151; border: none; padding: 14px 28px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: background 0.15s; }
        .btn-back:hover { background: #e5e7eb; color: #374151; }
        .already-applied { font-size: 14px; color: #16a34a; display: flex; align-items: center; gap: 6px; font-weight: 500; }
        .closed-notice { font-size: 14px; color: #dc2626; display: flex; align-items: center; gap: 6px; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">Browse Jobs</a>
        <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">My Applications</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('notifications.index') }}" class="notif-btn">
            <i class="fas fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <div class="user-menu">
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

<div class="page-wrapper">
    <a href="{{ route('home') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    {{-- JOB HEADER --}}
    @php
        $logoColors = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#06b6d4'];
        $color = $logoColors[$job->id % count($logoColors)];
        $badgeMap = ['full_time'=>['class'=>'badge-fulltime','label'=>'Full Time'],'part_time'=>['class'=>'badge-parttime','label'=>'Part Time'],'remote'=>['class'=>'badge-remote','label'=>'Remote'],'internship'=>['class'=>'badge-internship','label'=>'Internship']];
        $badge = $badgeMap[$job->job_type] ?? ['class'=>'badge-fulltime','label'=>ucfirst($job->job_type)];
        $candidate = auth()->user()->candidate;
        $alreadyApplied = $candidate ? $job->applications()->where('candidate_id', $candidate->id)->exists() : false;
    @endphp

    <div class="job-header-card">
        <div class="job-header-top">
            <div class="job-logo-big" style="background:{{ $color }}">
                {{ strtoupper(substr($job->title, 0, 1)) }}
            </div>
            <div class="job-header-info">
                <div class="job-header-title">{{ $job->title }}</div>
                <div class="job-company-name">
                    <i class="fas fa-building"></i>
                    {{ $job->category->name ?? 'Company' }}
                </div>
                <div class="job-badges">
                    <span class="badge-pill {{ $job->status === 'open' ? 'badge-open' : 'badge-closed' }}">
                        <i class="fas fa-circle" style="font-size:8px;"></i>
                        {{ ucfirst($job->status) }}
                    </span>
                    <span class="badge-pill {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                </div>
            </div>
        </div>

        <div class="job-stats-row">
            <div class="job-stat">
                <div class="job-stat-icon" style="color:#1a56db;"></div>
                <div class="job-stat-value">{{ $job->salary ? 'EGP '.number_format($job->salary, 0) : 'N/A' }}</div>
                <div class="job-stat-label">Monthly Salary</div>
            </div>
            <div class="job-stat">
                <div class="job-stat-icon" style="color:#f59e0b;"></div>
                <div class="job-stat-value">{{ $job->location }}</div>
                <div class="job-stat-label">Location</div>
            </div>
            <div class="job-stat">
                <div class="job-stat-icon" style="color:#10b981;"></div>
                <div class="job-stat-value">{{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : 'No deadline' }}</div>
                <div class="job-stat-label">Application Deadline</div>
            </div>
            <div class="job-stat">
                <div class="job-stat-icon" style="color:#8b5cf6;"></div>
                <div class="job-stat-value">{{ $job->applications()->count() }}</div>
                <div class="job-stat-label">Applicants</div>
            </div>
        </div>
    </div>

    {{-- DESCRIPTION --}}
    <div class="content-card">
        <h2><i class="fas fa-align-left"></i> Job Description</h2>
        <div class="job-description">{{ $job->description ?? 'No description provided.' }}</div>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="actions-card">
        @if($job->status === 'closed')
            <span class="closed-notice"><i class="fas fa-lock"></i> This position is closed and no longer accepting applications.</span>
        @elseif($alreadyApplied)
            <span class="already-applied"><i class="fas fa-check-circle"></i> You have already applied for this job!</span>
        @else
            <a href="{{ route('applications.create', ['job_id' => $job->id]) }}" class="btn-apply">
                <i class="fas fa-paper-plane"></i> Apply for this Job
            </a>
        @endif

        <a href="{{ route('home') }}" class="btn-back">
            <i class="fas fa-home"></i> Back to Home
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
