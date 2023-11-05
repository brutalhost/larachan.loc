<header class="navbar container grid-md ">
    <section class="navbar-section">
        <a href="{{ route('home') }}" class="navbar-brand mr-2">{{ config('app.name') }}</a>
        @foreach($menu as $element)
        <a href="{{ $element['url'] }}" class="btn btn-link">{{ $element['name'] }}</a>
        @endforeach
    </section>
    <section class="navbar-section">
        @auth()
            <a href="{{ route('users.show', auth()->user()->username) }}" class="btn btn-link">My Profile</a>
            <form action="{{ route('logout') }}" method="post" class="">
                @csrf
                <a href="#" onclick="this.closest('form').submit();return false;" class="btn btn-link">Logout</a>
            </form>
        @endauth
        @guest()
            @if(Route::currentRouteName() !== 'login')
                <a href="{{ route('login') }}" class="btn btn-link">Login</a>
            @endif
            @if(Route::currentRouteName() !== 'register')
                <a href="{{ route('register') }}" class="btn btn-link">Register</a>
            @endif
        @endguest
    </section>
</header>
