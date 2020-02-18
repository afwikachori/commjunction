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
                  <span class="text-secondary text-small">Project Manager</span>
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
              <a class="nav-link" href="/superadmin/module">
                <span class="menu-title">Module Management</span>
                <i class="mdi mdi-view-module menu-icon"></i>
              </a>
            </li>

             <li class="nav-item">
              <a class="nav-link" href="">
                <span class="menu-title">User Management</span>
                <i class="mdi mdi-account-convert menu-icon"></i>
              </a>
            </li>

          </ul>
