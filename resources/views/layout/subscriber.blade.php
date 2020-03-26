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
    <link rel="stylesheet" href="/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/purple/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/purple/css/style.css">
    <link rel="stylesheet" href="/css/subscriber.css">

    <!-- toastr -->
    <link rel="stylesheet" href="/css/toastr.min.css">

    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <!-- export datatble -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

    @yield('css')
</head>


<body>
    @if (Session::has('session_subscriber_logged'))
    <div class="container-scroller">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            @include('subscriber.dashboard.subs_navbar')
        </nav>


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('subscriber.dashboard.subs_sidebar')
            </nav>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a
                                href="">Commjuction</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
            </div>
        </div>


        <!-- Modal INITIAL-3-->
        <div class="modal fade bd-example-modal-xl" id="mdl-img-click" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                        </button>
                    </div>
                    <center>
                        <img id="mdl-img-view">
                    </center>
                </div>
            </div>
        </div>


        <!-- MODAL LOADING AJAX -->
        <div class="modal fade modal_ajax" id="modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content loading">
                    <center>
                        <div class="spinner-border text-light" style="width: 5rem; height: 5rem; margin-bottom: 1em;"
                            role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="h6 iniloading">Loading . . .</p>
                        <center>
                </div>
            </div>
        </div>
        <!-- END-MODAL -->


        <!-- MOdal Image Viewer-->
        <div class="modal fade bd-example-modal-xl" id="mdl-img-click" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 50px;">&times;</span>
                        </button>
                    </div>
                    <center>
                        <img id="mdl-img-view">
                    </center>
                </div>
            </div>
        </div>
    </div> <!-- container-scroller -->



    <!-- MODAL LOGOUT-->
    <div class="modal fade" id="modal_logout_subscriber" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 80%; min-height: 350px;">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/img/logout.png" id="img_signout_subs">
                        <h3 class="cgrey">Logout Comfirmation</h3>
                        <small class="clight">Are you sure, you want to exit ?</small>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> No, Im Doubt
                        </button>
                        &nbsp;
                        <a href="/subscriber/logout" type="button" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Yeah, Im Sure </a>
                    </center>
                </div> <!-- end-footer     -->
            </div> <!-- END-MDL CONTENT -->
        </div>
    </div>


<!-- MODAL EDIT PROFILE-->
<div class="modal fade" id="modal_profile_management" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_edit_profile_subs" action="{{route('edit_profile_subs')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-bottom: 0em !important;">
                    <h4 class="modal-title cgrey">Edit Profile</h4>

                    <button type="button" id="btn_mdl_changepass" class="btn btn-tosca btn-sm"
                        style="margin-bottom: 1em;" data-toggle="modal" data-target="#modal_changepass_admin"
                        data-dismiss="modal">Change Password</button>
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
                                <small class="clight">Fullname</small>
                                <input type="text" id="name_subs" name="name_subs" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight">Username</small>
                                <input type="text" id="username_subs" name="username_subs"
                                    class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Phone Number</small>
                                <input type="text" id="phone_subs" name="phone_subs" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight">Email</small>
                                <input type="text" id="email_subs" name="email_subs" class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <small class="clight">Alamat</small>
                            <textarea class="form-control input-abu" id="alamat_subs" name="alamat_subs"
                                rows="3"></textarea>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Edit </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

    @else
    @foreach(Session::get('auth_subs') as $newdata)
    <script>window.location = "/subscriber/url/{{ $newdata['name'] }}";</script>
    @endforeach
    @endif

    <!-- plugins:js -->
    <script src="/js/jquery.3.2.1.min.js"></script>
    <script src="/purple/vendors/js/vendor.bundle.base.js"></script>
    <script src="/purple/vendors/chart.js/Chart.min.js"></script>
    <script src="/purple/js/off-canvas.js"></script>
    <script src="/purple/js/hoverable-collapse.js"></script>
    <script src="/purple/js/misc.js"></script>
    <script src="/purple/js/dashboard.js"></script>
    <script src="/purple/js/todolist.js"></script>
    <script src="/purple/js/file-upload.js"></script>

    <!-- dataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- js custum superadmin -->
    <script src="/js/subscriber.js"></script>


    <script src="/js/toastr.min.js"></script>

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

    <!-- Sweetalert -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

    @yield('script')
</body>

</html>
