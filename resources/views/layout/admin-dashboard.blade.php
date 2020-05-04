<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ICON WEB -->
    <link rel="icon" href="/img/commjuction_icoweb.ico" />

    <!-- CSS Files -->

    <link rel="stylesheet" href="{{asset('purple/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('purple/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('purple/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin-mobile.css')}}">

    <!-- toastr -->
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">




    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <!-- export datatble -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


    <!-- news management -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">


    <script src="{{asset('js/jquery.3.2.1.min.js')}}"></script>

    <!-- Language translate page  -->
    <script src="{{asset('js/js.cookie.js')}}" charset="utf-8" type="text/javascript"></script>
    <script src="{{asset('js/jquery-lang.js')}}" charset="utf-8" type="text/javascript"></script>


    @yield('css')
</head>


<body>
    @if (Session::has('session_admin_logged'))
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            @include('admin.dashboard.admin_navbar')
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('admin.dashboard.admin_sidebar')
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            <a class="cdarkgrey" href="" style="padding-right: 2em;" lang="en" data-lang-token="Terms & Conditions">Terms & Conditions</a>
                            <a class="cdarkgrey" href="" style="padding-right: 2em;" lang="en" data-lang-token="">Privacy Policy</a>
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <a class="cdarkgrey" href="" style="padding-left: 2em;" lang="en" data-lang-token="Documentation">
                                Documentation &nbsp;<i class="mdi mdi-checkbox-blank-circle cteal s10"></i> </a>
                            <a class="cdarkgrey" href="" style="padding-left: 2em;" lang="en" data-lang-token="Support">
                                Support &nbsp;<i class="mdi mdi-phone cteal"></i> </a>
                        </span>
                    </div>
                </footer>
            </div>
        </div>

        <input type="hidden" id="server_cdn" value="{{ env('CDN') }}">
    </div>

    <!-- MODAL LOADING AJAX -->
    <div class="modal fade modal_ajax" id="modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content loading">
                <div id="comjuction_loading">
                    @include('loading')
                </div>
            </div>
        </div>
    </div>
    <!-- END-MODAL -->


    <!-- MOdal Image Viewer-->
    <div class="modal fade bd-example-modal-xl" id="mdl-img-click" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px; color:red;">&times;</span>
                    </button>
                </div>
                <center>
                    <img id="mdl-img-view">
                </center>
            </div>
        </div>
    </div>



    <!-- MODAL EDIT PROFILE-->
    <div class="modal fade" id="modal_profile_management" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #ffffff;">

                <form method="POST" id="form_edit_profiladmincom" action="{{route('edit_profile_admincom')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-header" style="padding-bottom: 0em !important;">
                        <h4 class="modal-title cgrey" lang="en">Edit Profile</h4>

                        <button type="button" id="btn_mdl_changepass" class="btn btn-tosca btn-sm"
                            style="margin-bottom: 1em;" data-toggle="modal" data-target="#modal_changepass_admin"
                            data-dismiss="modal" lang="en">Change Password</button>
                    </div> <!-- end-header -->

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                        <div class="img-upload-profil editprofil">
                            <div class="circle editprofil">
                                <img id="view_edit_user" class="profile-pic rounded-circle img-fluid editprofil"
                                    src="/img/loading.gif" onerror="this.onerror=null;this.src='/img/default.png';">
                            </div>
                            <div class="p-image editprofil">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="editprofil" style="width: 30px; height: 30px;">
                                    <i id="browse_user_admin" class="mdi mdi-camera upload-button editprofil"></i>
                                </button>
                                <input id="file_edit_profil_user" class="file-upload file-upload-default editprofil"
                                    type="file" name="fileup" accept="image/*" />
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <small class="clight" lang="en">Full Name</small>
                                    <input type="text" id="name_admin" name="name_admin" class="form-control input-abu">
                                </div>
                                <div class="form-group">
                                    <small class="clight" lang="en">Username</small>
                                    <input type="text" id="username_admin" name="username_admin"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <small class="clight" lang="en">Phone Number</small>
                                    <input type="text" id="phone_admin" name="phone_admin"
                                        class="form-control input-abu">
                                </div>
                                <div class="form-group">
                                    <small class="clight" lang="en">Email</small>
                                    <input type="text" id="email_admin" name="email_admin"
                                        class="form-control input-abu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <small class="clight" lang="en">Address</small>
                                <textarea class="form-control input-abu" id="alamat_admin" name="alamat_admin"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div> <!-- end-body -->

                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" id="" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Edit </button>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>

    <!-- MODAL CHANGE PASSWORD-->
    <div class="modal fade" id="modal_changepass_admin" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 400px;
    min-height: 350px;">

                <form method="POST" id="form_changepass_admin" action="{{route('change_password_admincom')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                        <center>
                            <img src="/img/key.png" id="img_changepass">
                        </center>
                        <div class="form-group">
                            <small class="clight" lang="en">Old Password</small>
                            <input type="password" id="old_pass_admin" name="old_pass_admin"
                                class="form-control input-abu">
                        </div>

                        <div class="form-group">
                            <small class="clight" lang="en">New Password</small>
                            <div class="input-group">
                                <input class="form-control input-abu" id="new_pass_admin" type="password"
                                    name="new_pass_admin" required="" autocomplete="passadmin"
                                    aria-describedby="btn_newshowpass">
                                <div class="input-group-append">
                                    <a class="btn btn-outline-light" type="button" id="btn_newshowpass"
                                        onclick="showPassNew()"
                                        style="background-color: #efefef; border-radius: 0px 10px 10px 0px;">
                                        <span class="mdi mdi-eye s16" aria-hidden="true" style="color: grey;"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end-body -->

                    <div class="modal-footer changepass" style="border: none;">
                        <center>
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                style="border-radius: 10px;">
                                <i class="mdi mdi-close"></i><span lang="en">No, Im Doubt</span>
                            </button>
                            &nbsp;
                            <button type="submit" class="btn btn-tosca btn-sm">
                                <i class="mdi mdi-check btn-icon-prepend">
                                </i> <span lang="en">Yeah, Im Sure</span> </button>
                        </center>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>


    <!-- MODAL LOGOUT-->
    <div class="modal fade" id="modal_logout_admin" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 80%;
    min-height: 350px;">


                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/img/logout.png" id="img_signout_admin">
                        <h3 class="cgrey" lang="en">Logout Comfirmation</h3>
                        <small class="clight" lang="en">Are you sure, you want to exit ?</small>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">No, Im Doubt</span>
                        </button>
                        &nbsp;
                        <button onclick="LogoutAdmin()" id="btn_logout_all" type="button" class="btn btn-tosca btn-sm">

                            <span class="hide_load_log" style="display: none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only" lang="en">Loading...</span>
                            </span>
                            <div id="text_logout"><i class="mdi mdi-check btn-icon-prepend"></i><span lang="en">Yeah, Im Sure</span></div>
                        </button>

                    </center>
                </div> <!-- end-footer     -->

            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>






    @else
    <script>window.location = "/admin";</script>
    @endif



    <!-- plugins:js -->
    <script src="{{asset('purple/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('purple/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('purple/js/off-canvas.js')}}"></script>
    <script src="{{asset('purple/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('purple/js/misc.js')}}"></script>
    <script src="{{asset('purple/js/dashboard.js')}}"></script>
    <script src="{{asset('purple/js/todolist.js')}}"></script>
    <script src="{{asset('purple/js/file-upload.js')}}"></script>

    <script src="/js/nicEdit.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="{{asset('js/admincom.js')}}"></script>


    <script src="{{asset('js/toastr.min.js')}}"></script>

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- dataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- datatable export  -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



    <!-- js pdf -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->


    <!-- Sweetalert -->
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    @include('sweet::alert')

    @yield('script')
</body>

</html>
