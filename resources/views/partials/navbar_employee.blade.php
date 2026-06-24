<nav>
    <a href="{{ route('home') }}">Home</a>

    <a href="{{ route('employee.dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('applications.index') }}">
        Applications
    </a>

    <a href="{{ route('job.create') }}">
        add job
    </a>

    <a href="{{ route('profile.edit') }}">
        Profile
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>