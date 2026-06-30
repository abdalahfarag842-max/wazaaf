<button class="menu-toggle" id="menuToggle">
    ☰
</button>
<aside class="sidebar" id="sidebar">

    <div class="sidebar-logo">
        <div class="brand">Wazaaf</div>
        <div class="tagline">Recruitment Management System</div>
    </div>

    <nav class="sidebar-nav">
        <a class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="ti ti-layout-dashboard" aria-hidden="true"></i>
            <span class="nav-text">Dashboard</span>
        </a>

        <a class="nav-item {{ request()->routeIs('jobs.*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">
            <i class="ti ti-briefcase" aria-hidden="true"></i>
            <span class="nav-text">Jobs</span>
        </a>

        <a class="nav-item {{ request()->routeIs('candidates.*') ? 'active' : '' }}"
            href="{{ route('candidates.index') }}">
            <i class="ti ti-users" aria-hidden="true"></i>
            <span class="nav-text">Candidates</span>
        </a>

        <a class="nav-item {{ request()->routeIs('applications.*') ? 'active' : '' }}"
            href="{{ route('applications.index') }}">
            <i class="ti ti-file-text" aria-hidden="true"></i>
            <span class="nav-text">Applications</span>
        </a>


        <a class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}"
            href="{{ route('categories.index') }}">
            <i class="ti ti-tag" aria-hidden="true"></i>
            <span class="nav-text">Categories</span>
        </a>

        <a class="nav-item {{ request()->routeIs('companies.*') ? 'active' : '' }}"
            href="{{ route('companies.index') }}">
            <i class="ti ti-building" aria-hidden="true"></i>
            <span class="nav-text">Companies</span>
        </a>
    </nav>

    <div class="sidebar-user">
        <div class="user-row">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="ti ti-logout" aria-hidden="true"></i>
                <span class="nav-text">Logout</span>
            </button>
        </form>
    </div>

</aside>