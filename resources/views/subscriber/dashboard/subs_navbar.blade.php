<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="">
        <img src="/visual/commjuction.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="">
        <img src="/visual/logo.png" alt="logo" class="img-logo-admincom" /></a>
</div>
<div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
    </button>

    <ul class="navbar-nav navbar-menu-wrapper d-flex align-items-stretch" id="nav_web_help">
        <li class="nav-item">
            <div class="d-none d-md-block">
                <a class="nav-link" href="">
                    Fitur Base 1
                </a>
            </div>
        </li>

        <li class="nav-item">
            <div class="d-none d-md-block">
                <a class="nav-link" href="">
                    Fitur Base 2
                </a>
            </div>
        </li>

        <li class="nav-item">
            <div class="d-none d-md-block">
                <a class="nav-link" href="">
                    Fitur Base 3
                </a>
            </div>
        </li>


    </ul>

    <!--   <ul class="navbar-nav" id="nav_mobile_help">
    <li class="nav-item nav-logout dropdown">
              <a class="nav-link dropdown-toggle" id="helpDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-arrow-down-bold-hexagon-outline"></i>
              </a>

              <div class="dropdown-menu navbar-dropdown dropdown-menu-left" aria-labelledby="helpDropdown">
                <a class="dropdown-item" href="/admin/settings">
                 Fitur Base 1</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="">
                Fitur Base 2</a>
                 <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="">
                Fitur Base 3</a>
              </div>
            </li>
  </ul> -->


    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                aria-expanded="false">
                <div class="nav-profile-img">
                    <img src="/img/loading2.gif" alt="image" class="foto_profil_subs"
                        onerror="this.onerror=null;this.src='/img/cam.png';">
                    <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                    <p class="mb-1 text-black nama_subs_login">
                        @if(Session::has('fullname'))
                        {{ Session::get('fullname')}}
                        @endif
                    </p>


                </div>
            </a>

            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                    <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/admin/logout">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                            <i class="mdi mdi-calendar"></i>
                        </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                        <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                            <i class="mdi mdi-settings"></i>
                        </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                        <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                            <i class="mdi mdi-link-variant"></i>
                        </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                        <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                        <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
        </li>


        <li class="nav-item nav-logout dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                aria-expanded="false">
                <i class="mdi mdi-settings"></i>
            </a>

            <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="settingDropdown">
                <a class="dropdown-item" href="/admin/settings">
                    Community Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="">
                    Etc</a>
            </div>
        </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
    </button>
</div>
