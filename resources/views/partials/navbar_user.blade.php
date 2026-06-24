<nav>
    <a href="{{ route('home') }}">Home</a>

    <a href="{{ route('jobs.index') }}">
        Browse Jobs
    </a>

    <a href="{{ route('applications.index') }}">
        My Applications
    </a>

    <a href="{{ route('profile.edit') }}">
        Profile
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>