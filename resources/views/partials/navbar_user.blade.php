<style>
    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: "Segoe UI", sans-serif;
    background:#f5f7fb;
}

.navbar{
    height:75px;
    background:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 60px;
    box-shadow:0 4px 15px rgba(0,0,0,.06);
    border-bottom:1px solid #e6eaf0;
    position:sticky;
    top:0;
    z-index:1000;
}

.logo a{
    text-decoration:none;
    font-size:28px;
    font-weight:700;
    color:#2563eb;
    letter-spacing:1px;
}

.nav-links{
    display:flex;
    align-items:center;
    gap:35px;
}

.nav-links a{
    text-decoration:none;
    color:#475569;
    font-size:15px;
    font-weight:600;
    transition:.3s;
    position:relative;
}

.nav-links a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-8px;
    width:0;
    height:3px;
    background:#2563eb;
    border-radius:20px;
    transition:.3s;
}

.nav-links a:hover{
    color:#2563eb;
}

.nav-links a:hover::after{
    width:100%;
}

.logout-btn{
    border:none;
    outline:none;
    padding:12px 24px;
    background:#2563eb;
    color:#fff;
    border-radius:8px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.logout-btn:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(37,99,235,.25);
}
</style>
<header class="navbar">
    <div class="logo">
        <a href="{{ route('home') }}">Wazaaf</a>
    </div>

    <nav class="nav-links">
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
    </nav>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">
            Logout
        </button>
    </form>
</header>