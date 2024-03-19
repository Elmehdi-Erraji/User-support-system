<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="fully responsive." name="description" />
    <meta content="Mehdi" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>


<body>
<div class="wrapper">
    @include('partials.topbar')

    @include('partials.sidebar')

    <div class="content-page">
        <div class="content">
            @section('content')
            @show
        </div>
    </div>
</div>





<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Created by<b> Mehdi</b>
            </div>
        </div>
    </div>
</footer>



<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>


</html>
