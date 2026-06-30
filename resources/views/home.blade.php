<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wazaaf – Find Your Next Job</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/pages/job-board.css'])
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

        <a href="{{ route('profile.edit') }}" class="user-menu">
            <div class="user-avatar">
                <i class="fas fa-user" style="color:#9ca3af;font-size:16px;"></i>
            </div>
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout-nav" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

{{-- HERO --}}
<div style="padding: 0 24px;">
<section class="hero-section">
    <div class="hero-inner">
        <div class="hero-content">
            <h1 class="hero-title">Find Your Dream Job</h1>
            <p class="hero-sub">Browse thousands of job opportunities and find the perfect fit for your skills.</p>

            <form action="{{ route('home') }}" method="GET">
                <div class="search-box">
                    <div class="search-field">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Job title or keyword" value="{{ request('search') }}">
                    </div>
                    <div class="search-field">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" name="location" placeholder="Location / Governorate" value="{{ request('location') }}">
                    </div>
                    <button type="submit" class="btn-search">Search Jobs</button>
                </div>
            </form>

            <div class="popular-searches">
                <span class="popular-label">Popular:</span>
                @foreach($categories->take(5) as $cat)
                    <a href="{{ route('home', ['category' => $cat->id]) }}" class="popular-tag">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="hero-image">
            <svg viewBox="0 0 400 280" xmlns="http://www.w3.org/2000/svg">
                <rect x="20" y="40" width="140" height="80" rx="12" fill="#fff" stroke="#e5e9f0" stroke-width="1.5"/>
                <circle cx="50" cy="70" r="16" fill="#dbeafe"/>
                <rect x="72" y="58" width="70" height="8" rx="4" fill="#e5e9f0"/>
                <rect x="72" y="72" width="50" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="30" y="92" width="110" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="240" y="20" width="140" height="70" rx="12" fill="#fff" stroke="#e5e9f0" stroke-width="1.5"/>
                <rect x="258" y="36" width="50" height="8" rx="4" fill="#dbeafe"/>
                <rect x="258" y="50" width="90" height="6" rx="3" fill="#f3f4f6"/>
                <rect x="258" y="62" width="70" height="6" rx="3" fill="#f3f4f6"/>
                <circle cx="200" cy="155" r="30" fill="#fff" stroke="#e5e9f0" stroke-width="2"/>
                <circle cx="195" cy="150" r="12" fill="none" stroke="#1a56db" stroke-width="2.5"/>
                <line x1="203" y1="158" x2="212" y2="167" stroke="#1a56db" stroke-width="2.5" stroke-linecap="round"/>
                <rect x="110" y="175" width="180" height="8" rx="4" fill="#e5e9f0"/>
                <rect x="220" y="108" width="8" height="30" rx="4" fill="#6b7280"/>
                <ellipse cx="224" cy="98" rx="18" ry="22" fill="#22c55e" opacity="0.7"/>
            </svg>
        </div>
    </div>
</section>
</div>

{{-- BROWSE BY CATEGORY --}}
<div class="section-wrapper">
    <div class="section-header">
        <h2 class="section-title">Browse by Category</h2>
        <a href="{{ route('jobs.index') }}" class="section-link">View all →</a>
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

{{-- LATEST JOBS --}}
<div class="section-wrapper" style="padding-bottom: 40px;">
    <div class="section-header">
        <h2 class="section-title">
            Latest Jobs
            @if(request()->hasAny(['search','category','job_type','status','location']))
                <span style="font-size:14px;color:#6b7280;font-weight:400;margin-left:8px;">{{ $jobs->total() }} results</span>
            @endif
        </h2>
    </div>

    {{-- FILTERS BAR --}}
    <form action="{{ route('home') }}" method="GET">
        @if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
        @if(request('location'))<input type="hidden" name="location" value="{{ request('location') }}">@endif

        <div class="filters-bar">
            <i class="fas fa-filter" style="color:#9ca3af;font-size:13px;"></i>
            <span style="font-size:13px;color:#6b7280;font-weight:500;">Filter:</span>

            <select name="category" class="filter-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="job_type" class="filter-select" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
            </select>

            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="">Open & Closed</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open Only</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed Only</option>
            </select>

            @if(request()->hasAny(['category','job_type','status']))
                <a href="{{ route('home', array_filter(['search'=>request('search'),'location'=>request('location')])) }}" class="filter-reset">
                    <i class="fas fa-times"></i> Clear filters
                </a>
            @endif
        </div>
    </form>

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
                    $isClosed = $job->status === 'closed';
                @endphp
                <a href="{{ route('jobs.show', $job) }}" class="job-card {{ $isClosed ? 'job-closed' : '' }}">
                    <div class="job-logo" style="background:{{ $color }}">
                        {{ strtoupper(substr($job->title, 0, 1)) }}
                    </div>
                    <div class="job-info">
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="job-company">
                            <i class="fas fa-building" style="font-size:10px;"></i>
                            {{ $job->category->name ?? 'Company' }}
                        </div>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                            @if($job->deadline)
                                <span><i class="fas fa-calendar"></i> Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="job-right">
                        @if($job->salary)
                            <div class="job-salary">EGP {{ number_format($job->salary, 0) }}</div>
                        @endif
                        <span class="badge-type {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                        @if($isClosed)
                            <div><span class="badge-closed-tag">Closed</span></div>
                        @endif
                        <div class="job-time">{{ $job->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-search" style="font-size:40px;opacity:0.3;"></i>
            <p style="margin-top:12px;">No jobs found matching your search.</p>
            <a href="{{ route('home') }}" style="color:#1a56db;font-size:14px;margin-top:8px;display:inline-block;">Clear search</a>
        </div>
    @endif

    <div class="pagination-wrapper">
        {{ $jobs->withQueryString()->links('pagination::simple-bootstrap-4') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>