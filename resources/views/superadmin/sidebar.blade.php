<ul class="nav">
    <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
            <div class="nav-profile-image">
                <img src="/img/commjuction_icoweb.ico" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2 logged_fullname">
                    @if(Session::has('fullname'))
                    {{ Session::get('fullname')}}
                    @endif
                </span>
                <span class="text-secondary text-small">Administrator</span>
            </div>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/dashboard">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/payment">
            <span class="menu-title">Verify Payment</span>
            <i class="mdi mdi-coin menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/subscriber">
            <span class="menu-title">Subscriber Management</span>
            <i class="mdi mdi-account-multiple menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/module">
            <span class="menu-title">Module Management</span>
            <i class="mdi mdi-view-module menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/usertype">
            <span class="menu-title">User Type Management</span>
            <i class="mdi mdi-account-convert menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/transaction">
            <span class="menu-title">Transaction Management</span>
            <i class="mdi mdi-cart menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/user_manage">
            <span class="menu-title">User Management</span>
            <i class="mdi mdi-account-plus menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/log_management">
            <span class="menu-title">Log Management</span>
            <i class="mdi mdi-playlist-check menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/module_report">
            <span class="menu-title">Module Report</span>
            <i class="mdi mdi-book-open-variant menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/superadmin/pricing_management">
            <span class="menu-title">Pricing Management</span>
            <i class="mdi mdi-diamond menu-icon"></i>
        </a>
    </li>

</ul>
