<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('/user_panel/user_details') }}">
        <div class="sidebar-brand-text mx-3">BECA User Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('user_panel/user_details*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/user_details') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>User Panel</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
{{--    <div class="sidebar-heading">--}}
{{--        Interface--}}
{{--    </div>--}}

    <!-- Nav Item - Utilities Collapse Menu -->

    <li class="nav-item {{ request()->is('user_panel/contact_info*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/contact_info') }}">
            <i class="fas fa-address-card"></i>
            <span>Contract Information</span>
        </a>
    </li>


    <li class="nav-item {{ request()->is('user_panel/payment_details') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/payment_details') }}">
            <i class="fas fa-donate"></i>
            <span>Payment Details</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('user_panel/account_settings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/account_settings') }}">
            <i class="far fa-credit-card"></i>
            <span>Account Settings</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('user_panel/verification_doc*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/verification_doc') }}">
            <i class="fas fa-clipboard-check"></i>
            <span>Verification Document</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <li class="nav-item {{ request()->is('user_panel/help*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('/user_panel/help') }}">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>Help</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
