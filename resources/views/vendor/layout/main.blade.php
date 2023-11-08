<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('backendAdmin/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backendAdmin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('backendAdmin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backendAdmin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('backendAdmin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('backendAdmin/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backendAdmin/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backendAdmin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backendAdmin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backendAdmin/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/header-colors.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/custome.css') }}" />
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('vendor.body.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('vendor.body.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('body')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        {{-- start footer  --}}
        @include('vendor.body.footer')
        {{-- end footer  --}}
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('backendAdmin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('backendAdmin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('backendAdmin/assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('backendAdmin/assets/js/app.js') }}"></script>
</body>

</html>
