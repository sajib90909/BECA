@extends('admin-panel.master')
@section('title')
    Members Details
@stop
@section('content')
            <div class="container-fluid">
                <!-- Content Row -->
                <div class="card shadow mb-4 p-2 pt-4">
                    @if(!empty(Session::get('message')) || !empty(Session::get('error-message')))
                    <div class="d-block pb-4 pl-4">
                        <span class="text-success">{{ Session::get('message')}}</span>
                        <span class="text-danger">{{ Session::get('error-message')}}</span>
                    </div>
                    @endif

                    <div class="row pb-lg-3">

                        <div class="col-lg-6">
                            <img class="img-fluid user_img rounded-circle" src="{{ asset('user_panel').'/'.$personal_info->profile_image }}" alt="">
                            <div class="d-inline-block px-lg-3 w-50">
                                <div class="font-weight-bold">{{ $personal_info->name }}</div>
                                <div class="small">{{ $member_type  }}</div>
                                <div class="small">{{ $current_unite  }}</div>
                                <div class="small">
                                    <a href="" title="">{{ $contact_details ->email }}</a>
                                </div>
                                <div class="">
                                    <span class="small">Mobile: {{ $account_info ->phone }}</span>
                                </div>
                                @if (!$beca_details ->beca_reg_id)
                                    <div class="small">BECA Reg: <span class="text-danger"> Not Approve</span></div>
                                @else
                                    <div class="small">BECA Reg: {{ $beca_details ->beca_reg_id }}</div>
                                @endif


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-right">
                                <div class="p-lg-2">
                                    <a href="{{ route('/admin_panel/members/beca_details/edit/status',['members_id'=>$account_info ->id,'status'=>'approve']) }}" class="d-none d-sm-inline-block btn btn-sm {{ ($account_info->status == 'approve') ? 'btn-success disabled': 'btn-outline-primary' }} shadow-sm">Approve</a>
                                    <a href="{{ route('/admin_panel/members/beca_details/edit/status',['members_id'=>$account_info ->id,'status'=>'deactivated']) }}" class="d-none d-sm-inline-block btn btn-sm {{ ($account_info->status == 'reject') ? 'btn-danger disabled': 'btn-outline-primary' }} shadow-sm">Reject</a>
                                    <a href="{{ route('/admin_panel/members/beca_details/edit/status',['members_id'=>$account_info ->id,'status'=>'banned']) }}" class="d-none d-sm-inline-block btn btn-sm {{ ($account_info->status == 'banned') ? 'btn-warning disabled': 'btn-outline-primary' }} shadow-sm">Banned</a>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="p-lg-2">
                                    @if($account_info->check_doc == 1)
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        Need Doc verification
                                    </button>
                                    @else
                                        <a href="{{ route('/admin_panel/members/account_info/edit',['members_id'=>$account_info ->id,'action'=>'check_doc_off']) }}" class="btn-outline-danger btn btn-light btn-sm">Cancel Doc verification</a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="p-lg-2">
                                    <a href="{{ route('/admin_panel/members/account_settings/edit',['members_id'=>$account_info ->id]) }}" class="btn-outline-dark btn btn-light btn-sm">Account Settings</a>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="p-lg-2">
                                    <a href="{{route('customer.printpdf.admin',['members_id'=>$account_info ->id])}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>



                <!-- marquee tag section -->
                <div class="w-100 d-block container text-warning">
                    <marquee>### এই খানে নোটিশ ঘোষণা করা থাকবে ###</marquee>
                </div>
            </div>
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4 {{ ($account_info ->status == 'approve') ? 'border-success' : (($account_info->status == 'reject') ? 'border-danger' : 'border-warning') }}">
                    <div class="card-header py-3 {{ ($account_info ->status == 'approve') ? 'bg-success' : (($account_info->status == 'reject') ? 'bg-danger' : 'bg-warning') }}">
                        <h6 class="m-0 font-weight-bold text-light d-inline-block">BECA Details</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-light shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/beca_details/edit',['members_id'=>$account_info->id]) }}" title="">Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">BECA Reg. Number</td>
                                        <td>: {!! ($beca_details ->beca_reg_id) ? $beca_details ->beca_reg_id : '<span class="text-danger">Not Created</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Member Since</td>
                                        <td>: {!! ($account_info ->created_at) ? $account_info ->created_at : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Current Unite</td>
                                        <td>: {!! ($current_unite ) ? $current_unite : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Member Type</td>
                                        <td>: {!! ($member_type ) ? $member_type : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">NEC Member</td>
                                        <td>: {{ ($beca_details ->nec_member == 1)? 'Yes':'No' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Position</td>
                                        <td>: {!! ($beca_details ->position) ? $beca_details ->position : '<span class="text-danger">empty</span>' !!}</td>
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
                        <h6 class="m-0 font-weight-bold d-inline-block">Personal Information</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/personal_info/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($personal_info->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'personal_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'personal_info','status'=>'off']) }}" title="">Close For User</a>
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
                                        <td class="font-weight-bold">Height</td>
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
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/address_details/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($address_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'address_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'address_info','status'=>'off']) }}" title="">Close For User</a>
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
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Education & Profession Details</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/edu_pro_details/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($edu_pro_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'edu_pro_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'edu_pro_info','status'=>'off']) }}" title="">Close For User</a>
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
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/cadet_details/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($cadet_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'cadet_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'cadet_info','status'=>'off']) }}" title="">Close For User</a>
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
            <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Contact Details</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/contact_details/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($contact_details->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'contact_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'contact_info','status'=>'off']) }}" title="">Close For User</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Email</td>
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
                                        <td class="font-weight-bold">Facebook</td>
                                        <td>: {!! ($contact_details->facebook) ? $contact_details->facebook : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Twitter</td>
                                        <td>: {!! ($contact_details->twitter) ? $contact_details->twitter : '<span class="text-danger">empty</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Skype</td>
                                        <td>: {!! ($contact_details->skype) ? $contact_details->skype : '<span class="text-danger">empty</span>' !!}</td>
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
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Submitted Documents</h6>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="{{ route('/admin_panel/members/document_details/edit',['members_id'=>$account_info ->id]) }}" title="">Edit</a>
                        @if($verification_docs->check == 1)
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'doc_info','status'=>'on']) }}" title="">Open For User</a>
                        @else
                            <a class="d-none d-sm-inline-block btn btn-sm btn-outline-danger shadow-sm float-right d-inline-block mr-2" href="{{ route('/admin_panel/members/beca_details/edit/permission',['members_id'=>$account_info ->id,'action'=>'doc_info','status'=>'off']) }}" title="">Close For User</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 table-responsive">
                                <table class="table table-borderless details-show">
                                    <tbody>
                                    <tr class="border-bottom">
                                        <td class="font-weight-bold">NID/Passport</td>
                                        <td>: {!! ($verification_docs->user_nid_pass_doc) ? $verification_docs->user_nid_pass_doc : '<span class="text-danger">empty</span>' !!}</td>
                                        @if($verification_docs->user_nid_pass_doc)
                                            <td><a target="_blank" href="{{ route('admin_panel/view/',['action'=>'user_nid_pass_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                            <td><a href="{{ route('admin_panel/download/',['action'=>'user_nid_pass_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                        @endif

                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="font-weight-bold">Cadet Certificate</td>
                                        <td>: {!! ($verification_docs->user_cadet_certificate_doc) ? $verification_docs->user_cadet_certificate_doc : '<span class="text-danger">empty</span>' !!}</td>
                                        @if($verification_docs->user_cadet_certificate_doc)
                                            <td><a target="_blank" href="{{ route('admin_panel/view/',['action'=>'user_cadet_certificate_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                            <td><a href="{{ route('admin_panel/download/',['action'=>'user_cadet_certificate_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                        @endif
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="font-weight-bold">Beca Documents</td>
                                        <td>: {!! ($verification_docs->user_beca_doc) ? $verification_docs->user_beca_doc : '<span class="text-danger">empty</span>' !!}</td>
                                        @if($verification_docs->user_beca_doc)
                                            <td><a target="_blank" href="{{ route('admin_panel/view/',['action'=>'user_beca_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">view</a></td>
                                            <td><a href="{{ route('admin_panel/download/',['action'=>'user_beca_doc','member_id'=>$account_info ->id]) }}" class="btn btn-sm btn-light btn-outline-dark">download</a></td>
                                        @endif
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
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Payment lists</h6>
{{--                        <a class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm float-right d-inline-block" href="" title="">Edit</a>--}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Payment Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($payment_info as $payment)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $payment->payment_amount }}</td>
                                        <td>{{ $payment->method }}</td>
                                        <td class="font-weight-bold">{{ $payment->payment_date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


            <!--doc verification  Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Select required Documment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {!! Form::open(['route' => '/admin_panel/members/account_info/check_doc_on/edit', 'method' => 'post']) !!}
                        <div class="modal-body">
                            <input hidden type="text" required name="user_id" value="{{ $account_info->id }}">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="user_nid_pass_doc" id="defaultCheck1" checked>
                                <label class="form-check-label" for="defaultCheck1">
                                    NID/Pasport
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="user_cadet_certificate_doc" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Cadate Certificate(Cadate ID/Camp Certificate)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="user_beca_doc" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    BECA Document
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
@endsection
