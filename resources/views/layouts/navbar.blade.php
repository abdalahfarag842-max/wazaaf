@auth
    @if(auth()->user()->role === 'admin')
        @include('partials.sidebar_admin')

    @elseif(auth()->user()->role === 'employee')
        @include('partials.navbar_employee')

    @elseif(auth()->user()->role === 'user')
        @include('partials.navbar_user')
    @endif
    
@endauth

@guest
    <a href="{{ route('login') }}">Login</a>ِ
    <a href="{{ route('register') }}">Register</a>
@endguest