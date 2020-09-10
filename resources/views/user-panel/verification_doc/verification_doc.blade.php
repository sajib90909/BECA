@extends('user-panel.master')
@section('title')
    Documents
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">
    <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Verification Document</h1>
                <a href="{{route('customer.printpdf')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-block">
                        <span class="text-success">{{ Session::get('message')}}</span>
                        <span class="text-danger">{{ Session::get('error_message')}}</span>
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block">Verification Document Details</h6>
                    @if ($verification_docs->check == 1)
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                    @else
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/document_details/edit') }}" title="">Edit</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 table-responsive">
                            <table class="table table-borderless details-show">
                                <tbody>
                                <tr class="border-bottom">
                                    <td class="font-weight-bold">NID/Passport</td>
                                    <td>: {!! ($verification_docs->user_nid_pass_doc) ? str_replace("uploaded_document/","",$verification_docs->user_nid_pass_doc) : '<span class="text-danger">empty</span>' !!}</td>
                                    @if($verification_docs->user_nid_pass_doc)
                                        <td><a target="_blank" href="{{ route('user_panel/view/',['action'=>'user_nid_pass_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                        <td><a href="{{ route('user_panel/download/',['action'=>'user_nid_pass_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                    @endif

                                </tr>
                                <tr class="border-bottom">
                                    <td class="font-weight-bold">Cadet Certificate</td>
                                    <td>: {!! ($verification_docs->user_cadet_certificate_doc) ? str_replace("uploaded_document/","",$verification_docs->user_cadet_certificate_doc) : '<span class="text-danger">empty</span>' !!}</td>
                                    @if($verification_docs->user_cadet_certificate_doc)
                                        <td><a target="_blank" href="{{ route('user_panel/view/',['action'=>'user_cadet_certificate_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                        <td><a href="{{ route('user_panel/download/',['action'=>'user_cadet_certificate_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                    @endif
                                </tr>
                                <tr class="border-bottom">
                                    <td class="font-weight-bold">Beca Documents</td>
                                    <td>: {!! ($verification_docs->user_beca_doc) ? str_replace("uploaded_document/","",$verification_docs->user_beca_doc) : '<span class="text-danger">empty</span>' !!}</td>
                                    @if($verification_docs->user_beca_doc)
                                        <td><a target="_blank" href="{{ route('user_panel/view/',['action'=>'user_beca_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                        <td><a href="{{ route('user_panel/download/',['action'=>'user_beca_doc']) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
