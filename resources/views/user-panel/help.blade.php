@extends('user-panel.master')
@section('title')
    Help
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Feel free to contact with us</h1>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block"><span class="badge badge-success">Help</span></h6>
                </div>
                <div class="card-body">
                    <div class="">
                        {!! isset($content_data->content_details) ? $content_data->content_details : 'no data' !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
