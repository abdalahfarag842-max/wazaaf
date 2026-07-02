{{-- NAVBAR --}}
<nav class="navbar-custom">
    <a class="navbar-brand-custom" href="{{ route('candidate.home') }}">
        <div class="brand-icon"><img src="{{ asset('images/logo.png') }}" alt="Wazaaf Logo"></div>
        Wazaaf
    </a>

    <div class="nav-links">
        <a href="{{ route('candidate.home') }}" class="{{ request()->routeIs('candidate.home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('candidate.jobs.index') }}" class="{{ request()->routeIs('candidate.jobs.*') ? 'active' : '' }}">Browse Jobs</a>
        <a href="{{ route('candidate.applications.index') }}" class="{{ request()->routeIs('candidate.applications.*') ? 'active' : '' }}">My Applications</a>
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
            <button type="submit" class="btn-logout-nav" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
        </form>
    </div>
</nav>