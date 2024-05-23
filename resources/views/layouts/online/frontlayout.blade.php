<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>
        {{ config('app.name', 'ZK Superstore') }}
    </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('online/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('online/css/style.css') }}" type="text/css">


    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

@livewireStyles  

</head>
<body>
        
    @include('layouts.online.navbar')
    @yield('content')
    @include('layouts.online.footer')


<!-- Js Plugins -->
<script src="{{ asset('online/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('online/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('online/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('online/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('online/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('online/js/mixitup.min.js') }}"></script>
<script src="{{ asset('online/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('online/js/main.js') }}"></script>    

<!-- Scripts -->
<!-- plugins:js -->
<script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->

@livewireScripts
@stack('scripts')
</body>
</html>