<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.html">
        <img src="/visual/commjuction.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="/visual/logo.png" alt="logo" /></a>
</div>
<div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                aria-expanded="false">
                <div class="nav-profile-img">
                    <img src="/img/loading.gif" alt="image" id="foto_profil_superadmin"
                        onerror="this.onerror=null;this.src='/img/default.png';">
                    <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black logged_fullname">
                        @if(Session::has('fullname'))
                        {{ Session::get('fullname')}}
                        @endif
                    </p>
                </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#modal_profile_management">
                    <i class="mdi mdi mdi-brush mr-2 text-primary"></i> Profile Management</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#modal_logout_superadmin"
                    data-dismiss="modal">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
            </div>
        </li>

        <li class="nav-item nav-logout dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-settings"></i>
            </a>

            <div class="dropdown-menu navbar-dropdown dropdown-menu-right">
                <a class="dropdown-item" href="/support" lang="en" data-lang-token="Settings">
                    Support System
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-toggle dropdown-item" href="" id="subnav_bahasa" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="menu-title" lang="en" data-lang-token="Languages">Languages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left dropleft" aria-labelledby="subnav_bahasa">
                    <a class="dropdown-item langimg" onclick="window.lang.change('id'); return false;">
                        <img border="0" src="/img/id.png" width="20" height="20"> &nbsp; &nbsp; Indonesia</a>
                    <a class="dropdown-item langimg" onclick="window.lang.change('en'); return false;">
                        <img border="0" src="/img/en.png" width="20" height="20"> &nbsp; &nbsp; English</a>
                </div>
            </div>
        </li>




    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
    </button>
</div>
