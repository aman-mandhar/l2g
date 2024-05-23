    <!--header section start -->
    <div class="header_section">
       <div class="container">
          <nav class="navbar navbar-dark bg-dark">
            <div class="search_section"> 
            <a class="logo" href="index.html"><img src="{{ asset('ecom/images/logo.png') }}"></a>
            </div>
            <div class="search_section">
               <li>
                 @guest
                    @if (Route::has('register'))
                       <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                        <p>Hello, {{ Auth::user()->name }}<br>
                           <a href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                       </form>
                        </p>
                 @endguest
               </li>
      </div>
            <div class="search_section">
               <ul>
                     <li>
                       @guest
                          @if (Route::has('login'))
                             <a href="{{ route('login') }}">Login</a>
                          @endif
                          @else
                             <a href="#">Deleviry at - {{ Auth::user()->city }}</a>
                       @endguest
                     </li>
            </div>
            
            <div class="search_section">
                    <li><a href="#"><img src="{{ asset('ecom/images/shopping-bag.png') }}"></a></li>
                    <li><a href="#"><img src="{{ asset('ecom/images/search-icon.png') }}"></a></li>
                 </ul>
              </div>
             <div class="search_section">
               
            
             </div>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="navbar-nav mr-auto">
                   <li class="nav-item active">
                      <a class="nav-link" href="/">Home</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="/">Category</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="/">Products</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="/">Client</a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" href="/">Contact Us</a>
                   </li>
                </ul>
             </div>
          </nav>
       </div>
    </div>
    <!--header section end -->
