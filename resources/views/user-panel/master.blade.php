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
    <link href="{{ asset('user_panel') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('user_panel') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('user_panel') }}/css/style.css">
    <script src="{{ asset('user_panel') }}/vendor/jquery/jquery.min.js"></script>


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('user-panel.includes.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        @include('user-panel.includes.topbar')
            @if(isset($head_notice_user->content_details))
        <!-- marquee tag section -->
            <div class="w-100 d-block container text-warning">
                <marquee>{{ $head_notice_user->content_details }}</marquee>
            </div>
            @endif
        @yield('content')
    </div>
</div>








@include('user-panel.includes.footer')


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->

<script src="{{ asset('user_panel') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('user_panel') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('user_panel') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('user_panel') }}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('user_panel') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('user_panel') }}/js/demo/chart-pie-demo.js"></script>

</body>

</html>

