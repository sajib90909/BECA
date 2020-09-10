<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">

            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pending Approve Request
                </h6>
                @php($i = 0)
                @if(count($approve_request) > 0)
                    @foreach($approve_request as $data)
                        @if((Session::get('admin_type') == 'super' || Session::get('admin_type') == 'author' ) ||
                             (Session::get('admin_type') == 'unite' && Session::get('admin_unite_id') == $data->approve_request_unite))
                            @php($i++)
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('/admin_panel/members/details/',['user_id'=>$data->approve_request_id]) }}">
                                <div>
                                    <div class="small text-gray-500">{{ \Carbon\Carbon::parse($data->date)->diffForHumans() }}</div>
                                    <span class="font-weight-bold">{{ $data->approve_request_name }}</span> is waiting for approval
                                </div>
                            </a>
                        @endif
                    @endforeach
                @else
                    <a class="dropdown-item d-flex align-items-center" href="">
                        <div>
                            <span class="font-weight-bold">No Request</span>
                        </div>
                    </a>
                @endif

{{--                <a class="dropdown-item text-center small text-gray-500" href="#">Show All</a>--}}
            </div>
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if( $i > 0)
                <span class="badge badge-danger badge-counter">{{ $i }}</span>
                @endif
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $account_data_top->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('admin-panel/'.( ($account_data_top->image) ? $account_data_top->image : '/admin_profile_images/thumbnail.png')) }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin_panel/update/account') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('/admin_panel/logout/action') }}" >

                    <a class="dropdown-item" href="{{ route('/admin_panel/logout/action') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" data-toggle="modal" data-target="#logoutModal"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('/admin_panel/logout/action') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
