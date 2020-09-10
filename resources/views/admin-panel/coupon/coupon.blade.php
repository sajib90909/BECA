@extends('admin-panel.master')
@section('title')
    Coupons
@stop
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-white" href="{{ route('/admin_panel/newCreate/coupons') }}" title="">
                <div class="card shadow h-100 py-2 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Create New Coupon</div>
                                <div class="h5 mb-0 font-weight-bold text-dark">++</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-white" href="{{ route('/admin_panel/coupons',['action'=>'used']) }}" title="">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Used</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_used }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-white" href="{{ route('/admin_panel/coupons',['action'=>'unused']) }}" title="">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Unused</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $count_unused }}</div>
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
            <a class="text-white" href="{{ route('/admin_panel/coupons',['action'=>'unpaid']) }}" title="">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Unpaid</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $unpaid_cash }} tk</div>
                        </div>
                        <div class="col-auto">
                            <h3 class="text-white font-weight-bolder">{{ $count_unpaid }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <!-- Total Bife member card example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="text-white" href="{{ route('/admin_panel/coupons',['action'=>'paid']) }}" title="">
            <div class="card bg-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Paid</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $paid_cash }} tk</div>
                        </div>
                        <div class="col-auto">
                            <h3 class="text-white font-weight-bolder">{{ $count_paid }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

{{--        <!-- Total General Member Example Card -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card bg-secondary shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Trash</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-light">12</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Total Rejected Member Example Card -->--}}
{{--        <div class="col-xl-6 col-md-6 mb-4">--}}
{{--            <div class="card bg-info shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Recived This Month</div>--}}
{{--                            <div class="h7 mb-0 font-weight-bold text-light">Donation: $10000, Members: $10000, Total: $20000</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-user-times fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="text-success">{{ Session::get('message')}}</span>
            <h6 class="m-0 font-weight-bold text-primary">Coupons <span class="badge badge-primary">{{ $action }}</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>code</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Made By</th>
                        <th>Cash</th>
                        <th>User</th>
                        <th>Use Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->member_type_name }}</td>
                            <td>{{ ($coupon->status == 0)? 'Unused': 'Used' }}</td>
                            <td>{{ $coupon->adder_admin_name }}</td>
                            <td>{{ ($coupon->receive_cash == 1)? 'Received': 'No' }}</td>
                            <td>{{ $coupon->use_user_name }}</td>
                            <td>{{ $coupon->use_date }}</td>
                            <td>
                            @if(!$coupon->user_id)
                                <a href="{{ route('/admin_panel/delete/coupons',['id'=>$coupon->id]) }}"><span class="badge badge-dark">Delete</span></a>
                            @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
