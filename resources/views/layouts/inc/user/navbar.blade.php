<nav class="navbar">
  <div class="nav-logo">
    <a href="{{ url('/') }}">
      <img src="{{ asset('assets/user/images/logo.png') }}" alt="Logo">
    </a>
  </div>

  <div class="nav-search">
    <input type="text" placeholder="Search" class="search-input">
    <div class="search-icon">
      <span class="material-symbols-outlined">search</span>
    </div>
  </div>

 

  <div>
    <div>
      @guest
        @if (Route::has('register'))
          <a href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
      @else
      <p>Hello, {{ Auth::user()->name }}
        <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </p>
      @endguest
    </div>
  </div>
  <div>
    @guest
      @if (Route::has('login'))
        <a href="{{ route('login') }}">Login</a>
      @endif
    @else
      <a href="#">Deleviry at - {{ Auth::user()->city }}</a>
    @endguest
</div>

  
</nav>

