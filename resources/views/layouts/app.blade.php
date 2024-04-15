<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Guidely - User Support System">

    <!-- ========== Page Title ========== -->
    <title>Guidely - User Support System</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets_guest/img/favicon-32x32.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('assets_guest/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/elegant-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/validnavs.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/helper.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/shop.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_guest/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_guest/css/responsive.css') }}" rel="stylesheet" />
    
    <!-- ========== End Stylesheet ========== -->

</head>

<body>

    <header>
        <!-- Start Navigation -->
        @include('partials.navbar')
        <!-- End Navigation -->
    </header>
   

    @yield('content')



    <!-- Start Footer -->
    @include('partials.footer')
    <!-- End Footer -->

    <script src="{{ asset('assets_guest/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets_guest/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('assets_guest/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/count-to.js') }}"></script>
    <script src="{{ asset('assets_guest/js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('assets_guest/js/validnavs.js') }}"></script>
    <script src="{{ asset('assets_guest/js/main.js') }}"></script>
    
</body>
</html>