@extends('admin-panel.master')
@section('title')
    Payments
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
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Recived</div>
                                <div class="h5 mb-0 font-weight-bold text-light">${{ $all_payment }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @if($withdraw != 'not_approve' || $withdraw == 0)
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Balance</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-light">${{ $balance }}</div>
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
        @endif
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=donation" class="text-decoration-none">
                <div class="card bg-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Donation Recived</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-light">${{ $donation_payment }}</div>
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
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=membership" class="text-decoration-none">
                <div class="card bg-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Membership Payment</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-light">${{ $membership_payment }}</div>
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

        @if($withdraw != 'not_approve' || $withdraw == 0)
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=withdraw" class="text-decoration-none">
                <div class="card bg-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Withdrew</div>
                                <div class="h5 mb-0 font-weight-bold text-light">${{ $withdraw }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Total Bife member card example -->

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="" class="text-decoration-none" data-toggle="modal" data-target="#exampleModal">
                <div class="card bg-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Create New Withdrow</div>
                                <div class="h5 mb-0 font-weight-bold text-light">++++</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endif


{{--        <!-- Total General Member Example Card -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card bg-secondary shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Bank Change</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-light">Total $29995</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Total Rejected Member Example Card -->
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
            <span class="text-success">{{ Session::get('message') }}</span>
            @if($payment_table_data == 'undefined')
                <h6 class="m-0 font-weight-bold text-primary">Withdraw Details</h6>
            @else
                <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($payment_table_data == 'undefined')
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Withdraw by</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Purpose</th>
                            <th>Date</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraws as $key => $data)
                            <tr>
                                <td>{{ $withdraws->firstItem() + $key }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->withdraw_title }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ $data->purpose }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td><a href="{{ route('admin_panel/delete/withdraw/action',['target'=>$data->id]) }}" class="badge badge-secondary">Cancel & Delete</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $withdraws->links() }}
                @else
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Purpose</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payment_table_data as $key => $data)
                            <tr>
                                <td>{{ $payment_table_data->firstItem() + $key }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->payment_amount }}</td>
                                <td>{{ $data->method }}</td>
                                <td>{{ $data->payment_for }}</td>
                                <td>{{ $data->payment_date }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $payment_table_data->links() }}
                @endif

            </div>
        </div>
    </div>
    @if($withdraw != 'not_approve' || $withdraw == 0)
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin_panel/add/withdraw/action', 'method' => 'post','class' => 'py-lg-2']) !!}
                <div class="modal-body">
                    <div class="">
                        <div class="form-group">
                            <label for="withdraw_title">Withdraw Title</label>
                            <input type="text" class="form-control" name="withdraw_title" id="withdraw_title" value="{{ old('withdraw_title') }}" placeholder="Enter withdraw title">
                            <span class="text-danger">{{ $errors->has('withdraw_title')? $errors->first('withdraw_title') : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label for="amount">Withdraw amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}" placeholder="Enter Amount">
                            <span class="text-danger">{{ $errors->has('amount')? $errors->first('amount') : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label for="purpose">description</label>
                            <textarea class="form-control" name="purpose" id="purpose" rows="3">{{ old('purpose') }}</textarea>
                            <span class="text-danger">{{ $errors->has('purpose')? $errors->first('purpose') : '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Confirm</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif

@stop
