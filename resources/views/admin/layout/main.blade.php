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
    <link href="{{ asset('backendAdmin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/header-colors.css') }}" />
    <link href="{{ asset('backendAdmin/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backendAdmin/assets/css/custome.css') }}" />
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('admin.body.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('admin.body.header')
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
        @include('admin.body.footer')
        {{-- end footer  --}}
    </div>
    <!--end wrapper-->
    <script src="{{ asset('backendAdmin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('backendAdmin/assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
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
    <script src="{{ asset('backendAdmin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('backendAdmin/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>




    {{-- // <!--app JS--> --}}
    <script src="{{ asset('backendAdmin/assets/js/index.js') }}"></script>

    <script>
        // summernote
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Description here',
                tabsize: 2,
                height: 200
            });
        });

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");


                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })


            });

        });
    </script>
    @stack('myScript')
    <script src="{{ asset('backendAdmin/assets/js/app.js') }}"></script>
</body>

</html>
