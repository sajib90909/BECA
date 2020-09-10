@extends('user-panel.master')
@section('title')
    Contact Infos
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Contract Information</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block">Contract Information Details</h6>
                    @if ($contact_details->check == 1)
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                    @else
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/contact_details/edit') }}" title="">Edit</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-borderless details-show">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">Email Address</td>
                                    <td>: {!! ($contact_details->email) ? $contact_details->email : '<span class="text-danger">empty</span>' !!}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Secondary Number</td>
                                    <td>: {!! ($contact_details->secondary_number) ? $contact_details->secondary_number : '<span class="text-danger">empty</span>' !!}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Emergency Number</td>
                                    <td>: {!! ($contact_details->emergency_number) ? $contact_details->emergency_number : '<span class="text-danger">empty</span>' !!}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-borderless details-show">
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">Facebook ID</td>
                                    <td>: {!! ($contact_details->facebook) ? $contact_details->facebook : '<span class="text-danger">empty</span>' !!}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Twitter ID</td>
                                    <td>: {!! ($contact_details->twitter) ? $contact_details->twitter : '<span class="text-danger">empty</span>' !!}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Skype ID</td>
                                    <td>: {!! ($contact_details->skype) ? $contact_details->skype : '<span class="text-danger">empty</span>' !!}</td>
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
