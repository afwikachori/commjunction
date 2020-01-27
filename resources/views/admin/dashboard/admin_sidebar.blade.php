 <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
@if (Session::has('ses_admin_logged'))
@foreach(Session::get('ses_admin_logged') as $user)

       <div class="nav-profile-image">
                  <img src="/img/default.png" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">

                  <span class="font-weight-bold mb-2">
                  {{ $user['full_name'] }}</span>
                 
                    @if($user['user_level'] == 1)
                     <span class="text-secondary text-small">Admin Commjuction
                     </span>
                    @elseif($user['user_level'] == 2)
                    <span class="text-secondary text-small">Admin Community
                     </span>
                    @else
                    <span class="text-secondary text-small">Subscriber
                     </span>
                    @endif
                  
                </div>
@endforeach
@endif        
        </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/dashboard">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                <button class="btn btn-block btn-md btn-gradient-primary mt-4" onclick="">Menu</button> 
                </div>
                
              </span>
            </li>
          </ul>