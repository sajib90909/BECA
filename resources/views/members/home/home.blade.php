@extends('members.master')
@section('content')
    <div class="row p-4">
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/login') }}">
                <div class="card bg-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">User Login</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/registration') }}">
                <div class="card bg-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">New Registation</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-plus fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/about_membership') }}">
                <div class="card bg-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">About Membership</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-person-booth fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/searchmembers') }}">
                <div class="card bg-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Search Member</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/donation') }}">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Donation</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-check-alt fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="nav-link" href="{{ route('/contact') }}">
                <div class="card bg-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Contact</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-address-card fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@stop
