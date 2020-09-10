@extends('admin-panel.master')
@section('title')
    Admins
@stop
@section('content')
    <!-- Content Row -->
    <div class="row">

        <!-- Create Admin Card Example -->
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <a class="text-white" href="{{ route('/admin_panel/add/unite') }}" title="">--}}
{{--                <div class="card shadow h-100 py-2 bg-light">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row no-gutters align-items-center">--}}
{{--                            <div class="col mr-2">--}}
{{--                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Create New Unite</div>--}}
{{--                                <div class="h5 mb-0 font-weight-bold text-dark">++</div>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto">--}}
{{--                                <i class="fas fa-user fa-2x text-gray-300"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
        <div class="col-xl-3 col-md-6 mb-4 userlink">
            <a class="text-decoration-none" href="{{ route('/admin_panel/add/admin') }}" title="">
                <div class="card shadow h-100 py-2 bg-secondary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Create New Admin</div>
                                <div class="h5 mb-0 font-weight-bold text-light">++</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card shadow h-100 py-2 bg-info">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total unite</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_unites }} Unite</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-user fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?" class="text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Total Admin User</div>
                            <div class="h5 mb-0 font-weight-bold text-light">{{ $count_admins }} Admin</div>
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
            <a href="?filter=super_admin" class="text-decoration-none">
                <div class="card bg-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Super Admin</div>
                                <div class="h5 mb-0 font-weight-bold text-light">{{ $count_s_admins }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-light"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=unite_admin" class="text-decoration-none">
                <div class="card bg-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Unite Admin</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $count_u_admins }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="?filter=trash" class="text-decoration-none">
                <div class="card bg-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Trash</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-light">{{ $count_trash }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="text-success" >{{ Session::get('message') }}</span>
            <h6 class="m-0 font-weight-bold text-primary">Admin Users Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>User ID</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Beca Id</th>
                        <th>Type</th>
                        <th>Unite</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($admins as $key =>$admin)
                        <tr>
                            <td>{{ $admins->firstItem() + $key }}</td>
                            <td>{{ $admin->user_name }}</td>
                            <td><img style="width: 100px;" src="{{ asset('/admin-panel/'.(!empty($admin->image) ? $admin->image: 'admin_profile_images/thumbnail.png')) }}" alt=""></td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->beca_reg_id }}</td>
                            <td>{{ $admin->user_type }}</td>
                            <td>{{ $admin->unite_name }}</td>
                            <td>
                                @if ($admin->status == 1)
                                    <i class="fas fa-globe-americas text-success"></i>
                                    Active <br>
                                @elseif($admin->status == 0)
                                    <i class="fas fa-globe-americas"></i>
                                    Mute <br>
                                @else
                                    <i class="fas fa-globe-americas text-danger"></i>
                                    Trash <br>
                                @endif

                            </td>
                            <td>
                                @if(($admin->user_type == 'super_admin') && (Session::get('admin_type') != 'author'))

                                @else
                                @if ($admin->status == 1)
                                    <a href="{{ route('/admin_panel/admins/mute',['admin_id'=>$admin->id]) }}">
                                        <i class="fas fa-arrow-alt-circle-down text-dark mr-2"></i>
                                    </a>
                                @else
                                     <a href="{{ route('/admin_panel/admins/active',['admin_id'=>$admin->id]) }}">
                                        <i class="fas fa-arrow-alt-circle-up text-success mr-2"></i>
                                     </a>
                                @endif
                                <a href="{{ route('/admin_panel/update/admin',['admin_id'=>$admin->id]) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                    @if ($admin->status != 2)
                                        <a class="pl-2" href="{{ route('/admin_panel/admins/trash',['admin_id'=>$admin->id]) }}">
                                            <i class="fas fa-trash-restore-alt text-danger"></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $admins->links() }}
            </div>
        </div>
    </div>
@stop
