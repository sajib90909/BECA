<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('admin-panel/img/logo.png') }}"/>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('/') }}admin-panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/') }}admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}admin-panel/css/style.css" rel="stylesheet">

    <script src="{{ asset('/') }}admin-panel/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}admin-panel/ckeditor/ckeditor.js"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

{{--    sidebar---------------------------------------------------------------------}}
@include('admin-panel.includes.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
{{--            top bar------------------------------------}}
@include('admin-panel.includes.topbar')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
{{--            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
        </div>

{{--            content --------------------------------}}
        @yield('content')

    </div>
    <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

{{--        footer--------------------------------------------------------------------------}}
        @include('admin-panel.includes.footer')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
@include('admin-panel.includes.logout')

<!-- Bootstrap core JavaScript-->

<script src="{{ asset('/') }}admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/') }}admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/') }}admin-panel/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('/') }}admin-panel/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/') }}admin-panel/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('/') }}admin-panel/js/demo/chart-pie-demo.js"></script>

</body>

</html>
