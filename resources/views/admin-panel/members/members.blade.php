@extends('admin-panel.master')
@section('title')
    Members
@stop
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">All Member</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_all_members }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=approve" class="text-decoration-none">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Active Member</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_active_members }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-child fa-2x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=not_check" class="text-decoration-none">
            <div class="card bg-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Pending Member</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $count_pending_members }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=deactivated" class="text-decoration-none">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Deactivated Member</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_deactivated_members }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=banned" class="text-decoration-none">
                <div class="card bg-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">trash</div>
                                <div class="h5 mb-0 font-weight-bold text-light">{{ $count_banned_members }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

{{--        <!-- Total Bife member card example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card bg-warning shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Life Member</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-light">8999</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-american-sign-language-interpreting fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Total General Member Example Card -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card bg-secondary shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total General Memmber</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-light">1800</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-user fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Member Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div>
                    <div class="float-left">
                        <form class="form-inline" action="{{ route('/admin_panel/members') }}" method="get">
                            <div class="form-group mb-2 mr-2">
                                <select required name="member_type" class="form-control form-control-sm">
                                    <option value="">select member types</option>
                                    @foreach($members_type as $member_type)
                                        <option value="{{ $member_type->id }}">{{ $member_type->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 btn-sm">Filter</button>
                        </form>
                    </div>
                    <div class="float-right">
                        <form class="form-inline" action="{{ route('/admin_panel/members') }}" method="get">
                            <div class="form-group mb-2 mr-2">
                                <select required name="unite" class="form-control form-control-sm">
                                    <option value="">select unite</option>
                                    @foreach($unites as $unite)
                                        <option value="{{ $unite->id }}">{{ $unite->unite_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 btn-sm">Filter</button>
                        </form>
                    </div>

                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Photo</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach($members_data as $member_data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img class="members_table_image" src="{{ asset('user_panel').'/'.$member_data->profile_image }}" alt=""></td>
                            <td>{!! ($member_data->beca_reg_id) ? $member_data->beca_reg_id: '<span class="text-danger">Not Approve Yet</span>' !!}</td>
                            <td>{{ $member_data->name }}</td>
                            <td>{{ $member_data->email }}</td>
                            <td>{{ $member_data->type_name }}</td>
                            <td>{{ $member_data->phone }}</td>
                            <td class="text-center">
                                {!! ($member_data->status == 'approve') ? '<i class="fas fa-check text-success" data-toggle="tooltip" data-placement="top" title="Approve"></i>'
                                    : ( ($member_data->status == 'reject') ? '<i class="fas fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Reject"></i>'
                                    : ( ($member_data->status == 'banned') ? '<i class="fas fa-times text-dark" data-toggle="tooltip" data-placement="top" title="banned"></i>'
                                    : '<i class="fas fa-pause-circle text-warning" data-toggle="tooltip" data-placement="top" title="Not Check"></i>')) !!}
                            </td>
                            <td>
                                <a href="{{ route('/admin_panel/members/details/',['user_id'=>$member_data->id]) }}" title="">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>
                        </tr>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
