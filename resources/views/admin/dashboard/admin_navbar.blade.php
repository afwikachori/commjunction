
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="">
            <img src="/visual/commjuction.png" id="logo_admin_img" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="">
            <img src="/visual/logo.png" alt="logo" class="img-logo-admincom" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="/img/loading.gif" alt="image" class="foto_profil_admin" onerror="this.onerror=null;this.src='/img/default.png';">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black user_admin_logged">
                     @if(Session::has('nama_admin'))
                      {{ Session::get('nama_admin')}}
                    @endif
                  </p>

                </div>
              </a>

              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item"  data-toggle="modal" data-target="#modal_profile_management">
                  <i class="mdi mdi mdi-brush mr-2 text-primary"></i><span lang="en">Profile Management</span></a>
                <div class="dropdown-divider"></div>
                 <a class="dropdown-item" data-toggle="modal" data-target="#modal_logout_admin" data-dismiss="modal">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> <span lang="en">Logout</span> </a>


              </div>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger" id="ada_notif" style="display: none;"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown"
              style="min-width: 250px;">
                <h6 class="p-3 mb-0" lang="en">Notifications</h6>
                <div class="dropdown-divider"></div>
                <div id="isi_notif_navbar">

                </div>
                <div class="dropdown-divider"></div>
                <a href="/admin/notification_management"><h6 class="p-3 mb-0 text-center" lang="en">See all notifications</h6></a>
              </div>
            </li>


            <li class="nav-item nav-logout dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-settings"></i>
              </a>

              <div class="dropdown-menu navbar-dropdown dropdown-menu-right" aria-labelledby="settingDropdown">
                <a class="dropdown-item" href="/admin/community_setting" lang="en" lang="Community Setting">Community Setting</a>
                <div class="dropdown-divider"></div>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item langimg" onclick="window.lang.change('id'); return false;">
                            <img border="0" src="/img/id.png" width="20" height="20"> &nbsp; &nbsp; Indonesia</a>
                        <a class="dropdown-item langimg" onclick="window.lang.change('en'); return false;">
                            <img border="0" src="/img/en.png" width="20" height="20"> &nbsp; &nbsp; English</a>
              </div>
            </li>

          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
