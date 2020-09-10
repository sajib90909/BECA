<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BECA- BANGLADESH EX-CADETS' ASSOCIATION</title>
    <link rel="icon" href="{{ asset('admin-panel/img/logo.png') }}"/>
    <link href="{{ asset('/') }}admin-panel/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- custom css -->
    <link href="{{ asset('/') }}admin-panel/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}admin-panel/css/user-style.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/') }}admin-panel/js/jquery.min.js"></script>
    <script src="{{ asset('/') }}admin-panel/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="page-warrper mt-2 mb-2">
    <section class="header pl-4 pr-4 pt-4 pb-1 clearfix row">
        <div class="logo text-center col-md-2 col-sm-3">
            <img src="{{ asset('/admin-panel') }}{{ (!empty($logo)) ? '/'.$logo->content_details : '/img/logo.png' }}" class="rounded bg-white w-100" alt="...">
        </div>
        <div class="heading bg-white text-center col-md-10 col-sm-9">
            {!! (!empty($header_content)) ? $header_content->content_details : '<h3 class="text-danger m-0">বাংলাদেশ এক্স-ক্যাডেটস এসোসিয়েশন (বেকা)</h3>'  !!}
        </div>
    </section>
    <section class="Content border-top border-bottom">
        @yield('content')
    </section>
    <section class="footer bg-white p-4">
        <div class="text-right">
            <p class="d-inline-block float-left"> <strong>Powered</strong> by <strong><a href="https://nirviq.com/" target='_blank'>NIRVIQ IT LIMITED</a></strong></p>
            <a href="https://nirviq.com/" target="_blank"><img src="{{ asset('/') }}admin-panel/img/nirviq.png" class="nirviq-logo ml-2" alt=""></a>
        </div>
    </section>
</div>
<script src="{{ asset('/') }}admin-panel/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('/') }}admin-panel/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('/') }}admin-panel/js/all.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('/') }}admin-panel/js/custom.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>

