<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wazaaf – Find Your Next Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f0f2f8; font-family: 'Segoe UI', system-ui, sans-serif; color: #1a1a2e; }

        /* ===== NAVBAR ===== */
        .navbar-custom {
            background: #fff;
            border-bottom: 1px solid #e5e9f0;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            padding: 0 32px;
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 700;
            color: #1a56db;
            text-decoration: none;
        }
        .navbar-brand-custom .brand-icon {
            background: #1a56db;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        .nav-links { display: flex; align-items: center; gap: 4px; margin: 0 auto; }
        .nav-links a {
            font-size: 14px;
            color: #6b7280;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.15s;
            border-bottom: 2px solid transparent;
        }
        .nav-links a:hover { color: #1a1a2e; }
        .nav-links a.active { color: #1a56db; border-bottom: 2px solid #1a56db; border-radius: 0; }
        .navbar-right { display: flex; align-items: center; gap: 16px; margin-left: auto; }
        .notif-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            font-size: 18px;
            padding: 4px;
            text-decoration: none;
        }
        .notif-badge {
            position: absolute;
            top: -2px;
            right: -4px;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.15s;
        }
        .user-menu:hover { background: #f5f7fb; }
        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #d1d5db;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-name { font-size: 14px; font-weight: 500; color: #1a1a2e; }
        .logout-form { display: inline; }
        .btn-logout-nav {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 13px;
            cursor: pointer;
            padding: 4px 8px;
        }
        .btn-logout-nav:hover { color: #ef4444; }

        /* ===== HERO ===== */
        .hero-section {
            background: #eef2fb;
            padding: 48px 32px;
            margin: 24px 24px 0;
            border-radius: 16px;
        }
        .hero-inner { display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: 0 auto; gap: 40px; }
        .hero-content { flex: 1; max-width: 520px; }
        .hero-title { font-size: 38px; font-weight: 800; color: #0f172a; line-height: 1.2; margin-bottom: 12px; }
        .hero-sub { font-size: 15px; color: #6b7280; margin-bottom: 28px; line-height: 1.6; }
        .search-box {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            gap: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 16px;
        }
        .search-field {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            padding: 0 12px;
            border-right: 1px solid #e5e9f0;
        }
        .search-field:last-of-type { border-right: none; }
        .search-field i { color: #9ca3af; font-size: 14px; }
        .search-field input {
            border: none;
            outline: none;
            font-size: 14px;
            color: #1a1a2e;
            width: 100%;
            background: transparent;
        }
        .search-field input::placeholder { color: #9ca3af; }
        .btn-search {
            background: #1a3a8f;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s;
        }
        .btn-search:hover { background: #1447b8; }
        .popular-searches { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .popular-label { font-size: 13px; color: #6b7280; font-weight: 500; }
        .popular-tag {
            font-size: 12px;
            color: #374151;
            background: #fff;
            border: 1px solid #e5e9f0;
            padding: 4px 12px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.15s;
        }
        .popular-tag:hover { border-color: #1a56db; color: #1a56db; }
        .hero-image { flex-shrink: 0; width: 380px; }
        .hero-image svg { width: 100%; }

        /* ===== SECTIONS ===== */
        .section-wrapper { max-width: 1200px; margin: 0 auto; padding: 32px 24px 0; }
        .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .section-title { font-size: 20px; font-weight: 700; color: #0f172a; }
        .section-link { font-size: 14px; color: #1a56db; text-decoration: none; font-weight: 500; }
        .section-link:hover { text-decoration: underline; }

        /* ===== CATEGORIES ===== */
        .categories-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; }
        .cat-card {
            background: #fff;
            border: 1px solid #e5e9f0;
            border-radius: 12px;
            padding: 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.15s;
        }
        .cat-card:hover { border-color: #1a56db; box-shadow: 0 2px 12px rgba(26,86,219,0.08); }
        .cat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .cat-info .cat-name { font-size: 13px; font-weight: 600; color: #0f172a; }
        .cat-info .cat-count { font-size: 12px; color: #9ca3af; }

        /* ===== JOB CARDS ===== */
        .jobs-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .job-card {
            background: #fff;
            border: 1px solid #e5e9f0;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 14px;
            align-items: flex-start;
            text-decoration: none;
            transition: all 0.15s;
        }
        .job-card:hover { border-color: #93b4f0; box-shadow: 0 2px 12px rgba(26,86,219,0.07); }
        .job-logo {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            flex-shrink: 0;
            color: #fff;
        }
        .job-info { flex: 1; }
        .job-title { font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 3px; }
        .job-company { font-size: 13px; color: #6b7280; margin-bottom: 6px; }
        .job-location { font-size: 12px; color: #9ca3af; display: flex; align-items: center; gap: 4px; }
        .job-right { text-align: right; flex-shrink: 0; }
        .job-salary { font-size: 13px; font-weight: 600; color: #16a34a; margin-bottom: 6px; }
        .badge-type {
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
        }
        .badge-fulltime { background: #dcfce7; color: #16a34a; }
        .badge-parttime { background: #fef9c3; color: #ca8a04; }
        .badge-remote { background: #e0f2fe; color: #0369a1; }
        .badge-internship { background: #f3e8ff; color: #7c3aed; }
        .job-time { font-size: 11px; color: #9ca3af; margin-top: 4px; }

        /* ===== EMPTY ===== */
        .empty-state { text-align: center; padding: 60px; color: #9ca3af; }

        /* ===== PAGINATION ===== */
        .pagination-wrapper { padding: 24px 0 40px; }

        @media (max-width: 768px) {
            .hero-image { display: none; }
            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .jobs-grid { grid-template-columns: 1fr; }
            .search-box { flex-direction: column; }
            .search-field { border-right: none; border-bottom: 1px solid #e5e9f0; padding-bottom: 12px; }
        }
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'active' : '' }}">Jobs</a>
        <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">My Applications</a>
        <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">Notifications</a>
    </div>

    <div class="navbar-right">
        {{-- Bell icon كـ link حقيقي --}}
        <a href="{{ route('notifications.index') }}" class="notif-btn">
            <i class="fas fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notif-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>

        <div class="user-menu">
            <div class="user-avatar">
                <i class="fas fa-user" style="color:#9ca3af;font-size:16px;"></i>
            </div>
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
            <i class="fas fa-chevron-down" style="font-size:11px;color:#9ca3af;"></i>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

{{-- ===== HERO ===== --}}
<div style="padding: 0 24px;">
<section class="hero-section">
    <div class="hero-inner">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Job</h1>
            <p class="hero-sub">Browse thousands of job opportunities and<br>find the perfect fit for your skills.</p>

            <form action="{{ route('home') }}" method="GET">
                <div class="search-box">
                    <div class="search-field">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Job title or keyword" value="{{ request('search') }}">
                    </div>
                    <div class="search-field">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
                    </div>
                    <button type="submit" class="btn-search">Search Jobs</button>
                </div>
            </form>

            <div class="popular-searches">
                <span class="popular-label">Popular searches:</span>
                @foreach($categories->take(5) as $cat)
                    <a href="{{ route('home', ['category' => $cat->id]) }}" class="popular-tag">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>

        {{-- SVG illustration --}}
        <div class="hero-image">
            <svg viewBox="0 0 420 300" xmlns="http://www.w3.org/2000/svg">
                <rect x="20" y="40" width="140" height="80" rx="12" fill="#fff" stroke="#e5e9f0" stroke-width="1.5"/>
                <circle cx="50" cy="70" r="16" fill="#dbeafe"/>
                <rect x="72" y="58" width="70" height="8" rx="4" fill="#e5e9f0"/>
                <rect x="72" y="72" width="50" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="30" y="92" width="110" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="30" y="104" width="80" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="260" y="20" width="140" height="70" rx="12" fill="#fff" stroke="#e5e9f0" stroke-width="1.5"/>
                <rect x="278" y="38" width="50" height="8" rx="4" fill="#dbeafe"/>
                <rect x="278" y="52" width="90" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="278" y="64" width="70" height="6" rx="3" fill="#f3f4f6"/>
                <circle cx="210" cy="160" r="30" fill="#fff" stroke="#e5e9f0" stroke-width="2"/>
                <circle cx="205" cy="155" r="12" fill="none" stroke="#1a56db" stroke-width="2.5"/>
                <line x1="213" y1="163" x2="222" y2="172" stroke="#1a56db" stroke-width="2.5" stroke-linecap="round"/>
                <rect x="100" y="180" width="200" height="8" rx="4" fill="#e5e9f0"/>
                <rect x="130" y="140" width="140" height="90" rx="8" fill="#1a3a8f"/>
                <rect x="138" y="148" width="124" height="74" rx="4" fill="#2563eb" opacity="0.3"/>
                <rect x="110" y="228" width="180" height="8" rx="4" fill="#374151"/>
                <circle cx="270" cy="120" r="22" fill="#fbbf24"/>
                <rect x="248" y="140" width="44" height="60" rx="10" fill="#3b82f6"/>
                <rect x="80" y="220" width="8" height="30" rx="4" fill="#6b7280"/>
                <ellipse cx="84" cy="210" rx="18" ry="22" fill="#22c55e" opacity="0.7"/>
                <ellipse cx="72" cy="218" rx="14" ry="18" fill="#16a34a" opacity="0.8"/>
                <rect x="330" y="60" width="50" height="40" rx="8" fill="#fff" stroke="#e5e9f0" stroke-width="1.5"/>
                <rect x="342" y="52" width="26" height="14" rx="4" fill="none" stroke="#e5e9f0" stroke-width="1.5"/>
                <line x1="330" y1="78" x2="380" y2="78" stroke="#e5e9f0" stroke-width="1.5"/>
            </svg>
        </div>
    </div>
</section>
</div>

{{-- ===== BROWSE BY CATEGORY ===== --}}
<div class="section-wrapper">
    <div class="section-header">
        <h2 class="section-title">Browse by Category</h2>
        <a href="{{ route('jobs.index') }}" class="section-link">View all categories</a>
    </div>

    @php
        $catColors = [
            ['bg'=>'#dbeafe','color'=>'#1d4ed8','icon'=>'fas fa-code'],
            ['bg'=>'#fce7f3','color'=>'#be185d','icon'=>'fas fa-paint-brush'],
            ['bg'=>'#dcfce7','color'=>'#15803d','icon'=>'fas fa-bullhorn'],
            ['bg'=>'#fef9c3','color'=>'#a16207','icon'=>'fas fa-chart-bar'],
            ['bg'=>'#ede9fe','color'=>'#6d28d9','icon'=>'fas fa-chart-pie'],
            ['bg'=>'#e0f2fe','color'=>'#0369a1','icon'=>'fas fa-headset'],
        ];
    @endphp

    <div class="categories-grid">
        @foreach($categories->take(6) as $i => $cat)
            @php $c = $catColors[$i % count($catColors)]; @endphp
            <a href="{{ route('home', ['category' => $cat->id]) }}" class="cat-card">
                <div class="cat-icon" style="background:{{ $c['bg'] }};color:{{ $c['color'] }}">
                    <i class="{{ $c['icon'] }}"></i>
                </div>
                <div class="cat-info">
                    <div class="cat-name">{{ $cat->name }}</div>
                    <div class="cat-count">{{ $cat->jobs()->count() }} Jobs</div>
                </div>
            </a>
        @endforeach
    </div>
</div>

{{-- ===== LATEST JOBS ===== --}}
<div class="section-wrapper" style="padding-bottom: 40px;">
    <div class="section-header">
        <h2 class="section-title">Latest Jobs</h2>
        <a href="{{ route('jobs.index') }}" class="section-link">View all jobs</a>
    </div>

    @php
        $logoColors = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#06b6d4'];
        $badgeMap = [
            'full_time'   => ['class'=>'badge-fulltime',   'label'=>'Full Time'],
            'part_time'   => ['class'=>'badge-parttime',   'label'=>'Part Time'],
            'remote'      => ['class'=>'badge-remote',     'label'=>'Remote'],
            'internship'  => ['class'=>'badge-internship', 'label'=>'Internship'],
        ];
    @endphp

    @if($jobs->count())
        <div class="jobs-grid">
            @foreach($jobs as $i => $job)
                @php
                    $color = $logoColors[$i % count($logoColors)];
                    $badge = $badgeMap[$job->job_type] ?? ['class'=>'badge-fulltime','label'=>ucfirst($job->job_type)];
                @endphp
                <a href="{{ route('jobs.show', $job) }}" class="job-card">
                    <div class="job-logo" style="background:{{ $color }}">
                        {{ strtoupper(substr($job->title, 0, 1)) }}
                    </div>
                    <div class="job-info">
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="job-company">{{ $job->category->name ?? '—' }}</div>
                        <div class="job-location">
                            <i class="fas fa-map-marker-alt" style="font-size:10px;"></i>
                            {{ $job->location }}
                        </div>
                    </div>
                    <div class="job-right">
                        @if($job->salary)
                            <div class="job-salary">EGP {{ number_format($job->salary, 0) }}</div>
                        @endif
                        <span class="badge-type {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                        <div class="job-time">{{ $job->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-search" style="font-size:40px;opacity:0.3;"></i>
            <p style="margin-top:12px;">No jobs found.</p>
        </div>
    @endif

    <div class="pagination-wrapper">
        {{ $jobs->withQueryString()->links('pagination::simple-bootstrap-4') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>