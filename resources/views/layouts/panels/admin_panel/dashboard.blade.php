<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>
        {{ config('app.name', 'ZK Superstore') }}
      </title>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <!-- End plugin css for this page -->
    <!-- inject:css -->
      <!-- site icon -->
      <link rel="icon" href="{{ asset('/panels/images/fevicon.png" type="image/png') }}" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('/panels/css/bootstrap.min.css') }}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{ asset('/panels/style.css') }}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{ asset('/panels/css/responsive.css') }}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{ asset('/panels/css/colors.css') }}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{ asset('/panels/css/bootstrap-select.css') }}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{ asset('/panels/css/perfect-scrollbar.css') }}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{ asset('/panels/css/custom.css') }}" />
      
      <!-- Include jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- Include Select2 CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

      <!-- Include Select2 JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
@livewireStyles  
</head>
        <body class="dashboard dashboard_1">
          
          
          <div class="full_container">
             <div class="inner_container">
              <!-- Sidebar  -->
                @include('layouts.panels.admin_panel.sidebar')
              <!-- topbar -->
<div class="topbar">
  <nav class="navbar navbar-expand-lg navbar-light">
     <div class="full">
        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
        <div class="logo_section">
           <a href="index.html"><img class="img-responsive" src="{{ asset('ecom/images/logo.png') }}" alt="#" /></a>
        </div>
        <div class="right_topbar">
           <div class="icon_info">
              <ul>
                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                 <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                 <li><a href="#"><i class="fa fa-shopping-cart"></i><span class="badge">3</span></a></li>
              </ul>
              <ul class="user_profile_dd">
                 <li>
                    <a class="dropdown-toggle" data-toggle="dropdown"><span class="name_user">{{ Auth::user()->name }}</span></a>
                    <div class="dropdown-menu">
                       <a class="dropdown-item" href="#"><span>
                         @if (Auth::check())
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                            </form>
                         @else
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                         @endif   
                      </span> <i class="fa fa-sign-out"></i></a>
                    </div>
                 </li>
              </ul>
           </div>
        </div>
     </div>
  </nav>
</div>
<!-- end topbar -->
                <div id="content">
                  @yield('content')
                </div>
             </div>
          </div>
          

    
<!-- Scripts -->
<!-- plugins:js -->
<script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->


<!-- jQuery -->
<script src="{{ asset('/panels/js/jquery.min.js') }}"></script>
<script src="{{ asset('/panels/js/popper.min.js') }}"></script>
<script src="{{ asset('/panels/js/bootstrap.min.js') }}"></script>
<!-- wow animation -->
<script src="{{ asset('/panels/js/animate.js') }}"></script>
<!-- select country -->
<script src="{{ asset('/panels/js/bootstrap-select.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('/panels/js/owl.carousel.js') }}"></script> 
<!-- chart js -->
<script src="{{ asset('/panels/js/Chart.min.js') }}"></script>
<script src="{{ asset('/panels/js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('/panels/js/utils.js') }}"></script>
<script src="{{ asset('/panels/js/analyser.js') }}"></script>
<!-- nice scrollbar -->
<script src="{{ asset('/panels/js/perfect-scrollbar.min.js') }}"></script>
<script>
   var ps = new PerfectScrollbar('#sidebar');
</script>
<!-- custom js -->
<script src="{{ asset('/panels/js/custom.js') }}"></script>
<script src="{{ asset('/panels/js/chart_custom_style1.js') }}"></script>


@livewireScripts
@stack('scripts')
</body>
</html>