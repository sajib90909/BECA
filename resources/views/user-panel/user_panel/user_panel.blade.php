@extends('user-panel.master')
@section('title')
    User Info
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4 border">
                    <div class="d-block">
                        <span class="text-success">{{ Session::get('message')}}</span>
                        <span class="text-danger">{{ Session::get('error_message')}}</span>
                    </div>
                    <h1 class="h3 mb-0 text-gray-800">User Panel (Main)</h1>
                    <a href="{{route('customer.printpdf')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                </div>

                <!-- Content Row -->
                <div class="row pb-lg-3">

                    <div class="col-lg-6 bg-white p-2 border ml-2">
                        <img class="img-fluid user_img" src="{{ $personal_info->profile_image }}" alt="">
                        <div class="d-inline-block px-lg-3 w-50">
                            <div class="font-weight-bold">{{ $personal_info->name }}</div>
                            <div class="small">{{ $member_type }}</div>
                            <div class="small">{{ 'Current Unite: '.$current_unite }}</div>
                            <div class="small">
                                <a href="" title="">{{ $account_info->email }}</a>
                            </div>
                            <div class="">
                                <span class="small">{{ $account_info->phone }}</span>
                            </div>
                            @if ($account_info->status != 'approve')
                                <div class="small">BECA Reg: <span class="text-danger"> Not Approve</span></div>
                            @else
                                <div class="small">BECA Reg: {{ $beca_details->beca_reg_id }}</div>
                            @endif


                        </div>
                    </div>
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="float-lg-right p-lg-2">--}}
{{--                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">Donate For COVID-19</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>



            </div>
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4 border-primary">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">BECA Details</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right disabled d-inline-block" href="" title="">Locked</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($account_info->status != 'approve')
                                <span class="p-4 text-danger"> Your account is not approve yet. please wait or contact with Authorised</span>
                            @else
                                <div class="col-lg-6">
                                    <table class="table table-borderless details-show">
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-bold">BECA Reg. Number</td>
                                            <td>: {!! ($beca_details->beca_reg_id) ? $beca_details->beca_reg_id : '<span class="text-danger">Not Created</span>' !!}</td>
                                        </tr>

{{--                                        <tr>--}}
{{--                                            <td class="font-weight-bold">Registration Unite</td>--}}
{{--                                            <td>: {!! ($registration_unite) ? $registration_unite: '<span class="text-danger">empty</span>' !!}</td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <td class="font-weight-bold">Member Since</td>
                                            <td>: {{ date($account_info->created_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Current Unite</td>
                                            <td>: {!! ($current_unite) ? $current_unite : '<span class="text-danger">empty</span>' !!}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-borderless details-show">
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Member Type</td>
                                            <td>: {!! ($member_type) ? $member_type : '<span class="text-danger">empty</span>' !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">NEC Member</td>
                                            <td>: {{ ($beca_details->nec_member == 1)? 'Yes':'No' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Position</td>
                                            <td>: {!! ($beca_details->position) ? $beca_details->position : '<span class="text-danger">empty</span>' !!}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold d-inline-block">Personal Information</h6>
                        @if ($personal_info->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/personal_info/edit') }}" title="">Edit</a>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Name</td>
                                        <td>: {!! ($personal_info->name) ? $personal_info->name : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Spouse Name</td>
                                        <td>: {!! ($personal_info->spouse_name) ? $personal_info->spouse_name : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Father Name</td>
                                        <td>: {!! ($personal_info->father_name) ? $personal_info->father_name : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Mother Name</td>
                                        <td>: {!! ($personal_info->mother_name) ? $personal_info->mother_name : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Gender</td>
                                        <td>: {!! ($personal_info->gender) ? $personal_info->gender : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Blood Group</td>
                                        <td>: {!! ($personal_info->blood) ? $personal_info->blood : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Hight</td>
                                        <td>: {!! ($personal_info->height) ? $personal_info->height : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Religion</td>
                                        <td>: {!! ($personal_info->religion) ? $personal_info->religion : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Birth</td>
                                        <td>: {!! ($personal_info->birth_date) ? $personal_info->birth_date : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">NID/Passport</td>
                                        <td>: {!! ($personal_info->nid_pass) ? $personal_info->nid_pass : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Driving Licence</td>
                                        <td>: {!! ($personal_info->driving_lic) ? $personal_info->driving_lic : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>




            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Address Details</h6>

                        @if ($address_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/address_details/edit') }}" title="">Edit</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="w-50 text-dark font-weight-bold">
                                    Present Address
                                </div>
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">House No</td>
                                        <td>: {!! ($address_details->present_house) ? $address_details->present_house : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold">Village/Area</td>
                                        <td>: {!! ($address_details->present_village) ? $address_details->present_village : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Upazila/Thana</td>
                                        <td>: {!! ($address_details->present_upazila) ? $address_details->present_upazila : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">District</td>
                                        <td>: {!! ($address_details->present_district) ? $address_details->present_district : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">division</td>
                                        <td>: {!! ($address_details->present_division) ? $address_details->present_division : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <div class="w-50 text-dark font-weight-bold">
                                    Permanant Address
                                </div>
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">House No</td>
                                        <td>: {!! ($address_details->permanent_house) ? $address_details->permanent_house : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Village/Area</td>
                                        <td>: {!! ($address_details->permanent_village) ? $address_details->permanent_village : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Upazila/Thana</td>
                                        <td>: {!! ($address_details->permanent_upazila) ? $address_details->permanent_upazila : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">District</td>
                                        <td>: {!! ($address_details->permanent_district) ? $address_details->permanent_district : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Division</td>
                                        <td>: {!! ($address_details->permanent_division) ? $address_details->permanent_division : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Education & Proffession Details</h6>
                        @if ($edu_pro_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/edu_pro_details/edit') }}" title="">Edit</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">SSC Batch</td>
                                        <td>: {!! ($edu_pro_details->ssc_batch) ? $edu_pro_details->ssc_batch : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Higher Degree</td>
                                        <td>: {!! ($edu_pro_details->edu_qualification) ? $edu_pro_details->edu_qualification : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Profession</td>
                                        <td>: {!! ($edu_pro_details->profession) ? $edu_pro_details->profession : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Work Address</td>
                                        <td>: {!! ($edu_pro_details->work_address) ? $edu_pro_details->work_address : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Cadate Details</h6>
                        @if ($cadet_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary disabled shadow-sm float-right d-inline-block">Locked</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/user_panel/user_details/cadet_details/edit') }}" title="">Edit</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Institute Name</td>
                                        <td>: {!! ($cadet_details->institute_name) ? $cadet_details->institute_name : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Institute Address</td>
                                        <td>: {!! ($cadet_details->institute_address) ? $cadet_details->institute_address : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Cadet ID</td>
                                        <td>: {!! ($cadet_details->cadet_id) ? $cadet_details->cadet_id : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Regiment</td>
                                        <td>: {!! ($cadet_details->regiment) ? $cadet_details->regiment : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Cadet Rank</td>
                                        <td>: {!! ($cadet_details->cadet_rank) ? $cadet_details->cadet_rank : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Cadet Wing</td>
                                        <td>: {!! ($cadet_details->cadet_wing) ? $cadet_details->cadet_wing : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Cadetship Year</td>
                                        <td>: {!! ($cadet_details->cadet_ship_year) ? $cadet_details->cadet_ship_year : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>




    </div>


@endsection
