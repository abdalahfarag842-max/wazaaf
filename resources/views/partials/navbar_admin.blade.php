<nav>
    <a href="{{ route('admin.dashboard') }}">
        Dashboard
    </a>

    <a href="{{ route('users.index') }}">
        Users
    </a>

    <a href="{{ route('companies.index') }}">
        Companies
    </a>

    <a href="{{ route('jobs.index') }}">
        Jobs
    </a>

    <a href="{{ route('applications.index') }}">
        Applications
    </a>

    <a href="{{ route('reports.index') }}">
        Reports
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>