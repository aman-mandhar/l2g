<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <title>Zed Kay Superstore</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- owl carousel style -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css" />
        <!-- bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('ecom/css/bootstrap.min.css') }}">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('ecom/css/style.css') }}">
        <!-- Responsive-->
        <link rel="stylesheet" href="{{ asset('ecom/css/responsive.css') }}">
        <!-- fevicon -->
        <link rel="icon" href="{{ asset('ecom/images/fevicon.png" type="image/gif') }}" />
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="{{ asset('ecom/css/jquery.mCustomScrollbar.min.css') }}">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <!-- owl stylesheets --> 
        <link rel="stylesheet" href="{{ asset('ecom/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ecom/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
        @livewireStyles 
    </head>
    <body>
        <div class="container-scroller">
            @include('layouts.inc.ecom.navbar')
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>
                <div class="footer_section layout_padding">
                    
                        @include('layouts.inc.ecom.footer')
                                     
                </div>
            </div>
        </div>
        @livewireScripts
                <!-- Javascript files-->
 <script src="ecom/js/jquery.min.js"></script>
 <script src="ecom/js/popper.min.js"></script>
 <script src="ecom/js/bootstrap.bundle.min.js"></script>
 <script src="ecom/js/jquery-3.0.0.min.js"></script>
 <script src="ecom/js/plugin.js"></script>
 <!-- sidebar -->
 <script src="ecom/js/jquery.mCustomScrollbar.concat.min.js"></script>
 <script src="ecom/js/custom.js"></script>
 <!-- javascript --> 
 <script src="ecom/js/owl.carousel.js"></script>
 <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 
 <script type="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2//2.0.0-beta.2.4/owl.carousel.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script>window.jQuery || document.write('<script src="ecom/js/vendor/jquery-slim.min.js"><\/script>')</script>
 <script src="ecom/js/vendor/popper.min.js"></script>
 <script src="ecom/js/bootstrap.min.js"></script>
    </body>
</html>
