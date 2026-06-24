<nav>
    <a href="{{ route('home') }}">Home</a>

    <a href="{{ route('company.dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('jobs.create') }}">
        Post Job
    </a>

    <a href="{{ route('jobs.index') }}">
        Manage Jobs
    </a>

    <a href="{{ route('company.applicants') }}">
        Applicants
    </a>

    <a href="{{ route('profile.edit') }}">
        Company Profile
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>