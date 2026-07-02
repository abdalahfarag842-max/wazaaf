<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs – Wazaaf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   @vite(['resources/css/app.css', 'resources/css/pages/job-board.css'])
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('candidate.home') }}">
        <div class="brand-icon"><i class="fas fa-briefcase"></i></div>
        Wazaaf
    </a>
    <div class="nav-links">
        <a href="{{ route('candidate.home') }}">Home</a>
        <a href="{{ route('candidate.jobs.index') }}" class="active">Browse Jobs</a>
        <a href="{{ route('candidate.applications.index') }}">My Applications</a>
    </div>
    <div class="navbar-right">
        <a href="{{ route('candidate.notifications.index') }}" class="notif-btn">
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
            <button type="submit" class="btn-logout-nav"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>

<div class="browse-layout">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <form action="{{ route('candidate.jobs.index') }}" method="GET" id="filterForm">

            {{-- CATEGORY FILTER --}}
            <div class="filter-card">
                <h3><i class="fas fa-th-large"></i> Category</h3>
                <div class="filter-option">
                    <input type="radio" name="category" value="" id="cat_all" {{ !request('category') ? 'checked' : '' }}>
                    <label for="cat_all">All Categories</label>
                </div>
                @foreach($categories as $cat)
                    <div class="filter-option">
                        <input type="radio" name="category" value="{{ $cat->id }}" id="cat_{{ $cat->id }}"
                            {{ request('category') == $cat->id ? 'checked' : '' }}>
                        <label for="cat_{{ $cat->id }}">{{ $cat->name }}</label>
                        <span class="count">{{ $cat->jobs()->count() }}</span>
                    </div>
                @endforeach
            </div>

            {{-- JOB TYPE --}}
            <div class="filter-card">
                <h3><i class="fas fa-briefcase"></i> Job Type</h3>
                @foreach([''=>'All Types','full_time'=>'Full Time','part_time'=>'Part Time','remote'=>'Remote','internship'=>'Internship'] as $val => $label)
                    <div class="filter-option">
                        <input type="radio" name="job_type" value="{{ $val }}" id="type_{{ $val ?: 'all' }}"
                            {{ request('job_type', '') === $val ? 'checked' : '' }}>
                        <label for="type_{{ $val ?: 'all' }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            {{-- STATUS --}}
            <div class="filter-card">
                <h3><i class="fas fa-toggle-on"></i> Status</h3>
                @foreach([''=>'All','open'=>'Open','closed'=>'Closed'] as $val => $label)
                    <div class="filter-option">
                        <input type="radio" name="status" value="{{ $val }}" id="status_{{ $val ?: 'all' }}"
                            {{ request('status', '') === $val ? 'checked' : '' }}>
                        <label for="status_{{ $val ?: 'all' }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn-apply-filter">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
            <a href="{{ route('candidate.jobs.index') }}" class="btn-clear-filter">Clear All</a>

        </form>
    </div>

    {{-- MAIN --}}
    <div class="main-content">
        <div class="results-header">
            <div class="results-count">
                <span>{{ $jobs->total() }}</span> jobs found
            </div>
        </div>

        @php
            $logoColors = ['#3b82f6','#f59e0b','#10b981','#8b5cf6','#ef4444','#06b6d4'];
            $badgeMap = ['full_time'=>['class'=>'badge-fulltime','label'=>'Full Time'],'part_time'=>['class'=>'badge-parttime','label'=>'Part Time'],'remote'=>['class'=>'badge-remote','label'=>'Remote'],'internship'=>['class'=>'badge-internship','label'=>'Internship']];
        @endphp

        @if($jobs->count())
            @foreach($jobs as $i => $job)
                @php
                    $color = $logoColors[$i % count($logoColors)];
                    $badge = $badgeMap[$job->job_type] ?? ['class'=>'badge-fulltime','label'=>ucfirst($job->job_type)];
                    $isClosed = $job->status === 'closed';
                @endphp
                <a href="{{ route('candidate.jobs.show', $job) }}" class="job-card {{ $isClosed ? 'closed' : '' }}">
                    <div class="job-logo" style="background:{{ $color }}">
                        {{ strtoupper(substr($job->title, 0, 1)) }}
                    </div>
                    <div class="job-info">
                        <div class="job-title">{{ $job->title }}</div>
                        <div class="job-company">
                            <i class="fas fa-building" style="font-size:11px;"></i>
                            {{ $job->category->name ?? 'Company' }}
                        </div>
                        <div class="job-tags">
                            <span class="tag"><i class="fas fa-map-marker-alt"></i> {{ $job->location }}</span>
                            @if($job->deadline)
                                <span class="tag"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}</span>
                            @endif
                            <span class="tag"><i class="fas fa-users"></i> {{ $job->applications()->count() }} applicants</span>
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

            <div style="padding:20px 0;">
                {{ $jobs->withQueryString()->links('pagination::simple-bootstrap-4') }}
            </div>

        @else
            <div class="empty-state">
                <i class="fas fa-search" style="font-size:40px;opacity:0.3;"></i>
                <p style="margin-top:12px;">No jobs found. Try adjusting your filters.</p>
                <a href="{{ route('candidate.jobs.index') }}" style="color:#1a56db;font-size:14px;margin-top:8px;display:inline-block;">Clear filters</a>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>