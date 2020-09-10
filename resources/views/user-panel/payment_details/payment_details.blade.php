@extends('user-panel.master')
@section('title')
    Payment Details
@endsection
@section('content')
    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Payment Details</h1>
                <a href="{{route('customer.printpdf')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline-block"><span class="badge badge-success">payment approved</span></h6>
                </div>
                <div class="card-body">
                    <div class="">
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
        </div>
    </div>
@endsection
