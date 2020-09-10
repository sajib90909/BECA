@extends('admin-panel.master')
@section('title')
    Dashboard
@stop
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total MEMBER'S</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_all_number }}</div>
{{--                            <div class="text-xs font-weight-bold text-light mb-1 mt-lg-3">Workers</div>--}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Payment</div>
                            <div class="h5 mb-0 font-weight-bold text-light">${{ $count_payment }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Notice</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $notice_count }}</div>
{{--                                    <div class="text-xs font-weight-bold text-light mb-1 mt-lg-3">Earnings</div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        @if($admin_count != 'not_approve')
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Admin/Unite User's</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $admin_count }}</div>
{{--                            <div class="text-xs font-weight-bold text-light mb-1 mt-lg-3">Earnings</div>--}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">SMS</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $sms_count }}</div>
{{--                            <div class="text-xs font-weight-bold text-light mb-1 mt-lg-3">Earnings</div>--}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($active_logs != 'not_approve')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span class="text-success" >{{ Session::get('message') }}</span>
                <h6 class="m-0 font-weight-bold text-primary">Admins Active Logs</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form class="form-inline" action="{{ route('/admin_panel') }}" method="get">
                        <div class="form-group mb-2 mr-2">
                            <select name="active_log" class="form-control form-control-sm">
                                <option value="">select Admin</option>
                                @foreach($active_logs_admins as $active_logs_admin)
                                    <option value="{{ $active_logs_admin->action_admin_id }}">{{ $active_logs_admin->admin_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 btn-sm">Filter</button>
                    </form>
                    <table class="table table-striped table-sm d-inline-block" id="dataTable">
                        <tbody>
                        {{--                    @php($i = $admins->getFrom())--}}
                        @foreach($active_logs as $key => $active_log)
                            <tr>
                                <td>{{ $active_logs->firstItem() + $key }}</td>
                                <td class="pl-4 pr-4">
                                    <small class="">
                                        <a href="" class="badge badge-info">{{ ($active_log->action_admin_id == Session::get('admin_id'))? 'you' :$active_log->admin_name }} </a>
                                    {{ $active_log->action_details }}
                                        <a href="" class="badge badge-secondary">{{
                                                    ($active_log->user_name) ? $active_log->user_name :
                                                    (($active_log->type_name) ? $active_log->type_name :
                                                    (($active_log->member_name) ? $active_log->member_name :
                                                    (($active_log->unite_name) ? $active_log->unite_name :
                                                    (($active_log->user_type == 'sms') ? 'show' :
                                                    (($active_log->user_type == 'notice') ? 'show' : '')))))

                                                     }}</a>
                                    </small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($active_log->created_at)->diffForHumans() }}</td>
{{--                                <td>{{ $active_log->created_at }}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $active_logs->links() }}
                </div>
            </div>
        </div>
    @endif
@stop
