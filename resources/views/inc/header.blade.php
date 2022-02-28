<header class="blog-header">

    <div class="blog-header__title">
        <img src="https://pbs.twimg.com/profile_images/1163911054788833282/AcA2LnWL_400x400.jpg" alt="">
        <div>
            <h1>console <br> <strong>.blog()</strong></h1>
            <h4>The web development blog made for you.</h4>
        </div>
    </div>

    @guest
    @if (!Route::has('login'))
    <h3 class="blog-header__logged">Logged as  {{ Auth::user()->name }}</h3>
    @endif
    @endguest

    <ul class="blog-header__menu">
    @guest
        @if (Route::has('login'))
            <li>
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
    
        @if (Route::has('register'))
            <li>
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li>   
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>    
    @endguest
    </ul>
</header>
