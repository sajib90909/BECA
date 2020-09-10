<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('/admin_panel') }}">
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin_panel*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/admin_panel') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('admin_panel/members*') ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('/admin_panel/members') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Member Panel</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->is('admin_panel/payments*') ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('/admin_panel/payments') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Payment</span>
        </a>
    </li>


    @if ($admin_type == 'super' || $admin_type == 'author')
        <li class="nav-item {{ request()->is('admin_panel/sms*') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('/admin_panel/sms') }}">
                <i class="fas fa-fw fa-envelope"></i>
                <span>SMS</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin_panel/admins*') ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('/admin_panel/admins') }}">
                <i class="fas fa-fw fa-user-shield"></i>
                <span>User/Admin</span>
            </a>
        </li>


    @endif
    <li class="nav-item {{ request()->is('admin_panel/add/members_type*') ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('/admin_panel/add/members_type') }}">
            <i class="fas fa-fw fa-user-shield"></i>
            <span>Members Type</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is('admin_panel/add/unite*') ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('/admin_panel/add/unite') }}">
            <i class="fas fa-fw fa-user-shield"></i>
            <span>Unites</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin_panel/coupons*') ? 'active' : ''  }}">
        <a class="nav-link" href="{{ route('/admin_panel/coupons',['action'=>'used']) }}">
            <i class="fas fa-fw fa-flag"></i>
            <span>Coupons</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    @if ($admin_type == 'super' || $admin_type == 'author')
        <li class="nav-item {{ request()->is('admin_panel/custom_page*') ? 'active' : ''  }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Content</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Pages:</h6>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'logo']) }}">Logo</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'header']) }}">Header content</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'head_notice']) }}">Notice</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'help']) }}">Help Page</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'contact']) }}">Contact Page</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'membership']) }}">About Membership Page</a>
                    <a class="collapse-item" href="{{ route('/admin_panel/custom_page',['action'=>'donation']) }}">Donation Page</a>
                </div>
            </div>
        </li>
@endif

{{--    <li class="nav-item {{ request()->is('admin_panel/help') ? 'active' : ''  }}">--}}
{{--        <a class="nav-link" href="{{ route('/admin_panel/help') }}">--}}
{{--            <i class="fas fa-fw fa-question-circle"></i>--}}
{{--            <span>HELP</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
