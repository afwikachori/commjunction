<ul class="nav">
    <li class="nav-item nav-profile">
        <center>
            <img src="/img/loading.gif" class="rounded-circle img-fluid dash-img-profil logo_komunitas"
                style="margin-bottom: 3%;" onerror="this.onerror=null;this.src='/img/default.png';">
            <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold judul_komunitas">Community Name</span>
                <span class="text-secondary text-small" id="comm_status_admin">Status Community</span>

        </center>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard">
            <span class="menu-title" lang="en">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
            aria-controls="general-pages">
            <span class="menu-title">Member Management</span>
            <i class="mdi mdi-arrow-down-drop-circle menu-arrow"></i>
            <i class="mdi mdi-account-multiple menu-icon"></i>
        </a>
        <div class="collapse" id="general-pages">
            <ul class="nav sub-sidebar flex-column sub-menu">
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/subs_management">Subscriber Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/membership_management">Membership Management</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#modules" aria-expanded="false"
            aria-controls="modules">
            <span class="menu-title">Modules</span>
            <i class="mdi mdi-arrow-down-drop-circle menu-arrow"></i>
            <i class="mdi mdi-view-module menu-icon"></i>
        </a>
        <div class="collapse" id="modules">
            <ul class="nav sub-sidebar flex-column sub-menu">
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/news_management">News Management</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#administration" aria-expanded="false"
            aria-controls="administration">
            <span class="menu-title">Administration</span>
            <i class="mdi mdi-arrow-down-drop-circle menu-arrow"></i>
            <i class="mdi mdi-buffer menu-icon"></i>
        </a>
        <div class="collapse" id="administration">
            <ul class="nav sub-sidebar flex-column sub-menu">
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/user_management">User Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/usertype_management">User Type Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/module_management">Module Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/report_management">Report Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/transaction">Transaction Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/payment_management">Payment Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/notification_management">Notification Management</a>
                </li>
                <li class="nav-item sub-sidebar">
                    <a class="nav-link" href="/admin/inbox_management">Inbox Management</a>
                </li>
            </ul>
        </div>
    </li>

        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
                aria-controls="general-pages">
                <span class="menu-title">Module test</span>
                <i class="mdi mdi-arrow-down-drop-circle menu-arrow"></i>
                <i class="mdi mdi-view-module menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav sub-sidebar flex-column sub-menu">
                    <li class="nav-item sub-sidebar">
                        <a class="nav-link" href="/admin/event">Event</a>
                    </li>
            </div>

              <div class="collapse" id="general-pages">
                <ul class="nav sub-sidebar flex-column sub-menu">
                    <li class="nav-item sub-sidebar">
                        <a class="nav-link" href="/admin/forum">Forum</a>
                    </li>
            </div>
        </li> --}}

</ul>
