<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <div class="collapse" id="search-nav">
            <div class="navbar-left navbar-form nav-search mr-md-3">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item hidden-caret">
                        <a href="/subscriber/dashboard" class="nav-link">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                     <li class="nav-item hidden-caret cwhite">
                        <h5 class="cwhite mgt-05">Subscriber Community</h5>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="/img/def-profil.png" class="avatar-img rounded-circle foto_user"
                        onerror="this.onerror=null;this.src='/img/def-profil.png';">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn minlebar">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="/img/def-profil.png" alt="image profile"
                                        class="avatar-img rounded foto_user"
                                        onerror="this.onerror=null;this.src='/img/def-profil.png';">
                                    </div>
                                <div class="u-text">
                                    <h3 id="user_nama">-</h3>
                                    <small class="clight">Username : </small>
                                    <small id="user_username" class="clight">-</small>
                                    <p class="text-muted" id="user_email">-</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="{{ route('logout_subs_href') }}">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->
