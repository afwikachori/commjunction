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
    <link rel="stylesheet" href="{{asset('css/subscriber.css')}}">

    <!-- toastr -->
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

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
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            <a class="cdarkgrey" href="" style="padding-right: 2em;" lang="en">Terms & Conditions</a>
                            <a class="cdarkgrey" href="" style="padding-right: 2em;" lang="en">Privacy Policy</a>
                            <a class="cdarkgrey" href="" style="padding-right: 2em;" lang="en" data-toggle="modal"
                                data-target="#modal_confirmpay_membership">Payment Confirmation</a>
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <a class="cdarkgrey" href="#" style="padding-left: 2em;" lang="en">Documentation &nbsp;<i
                                    class="mdi mdi-checkbox-blank-circle cteal s10"></i> </a>
                            <a class="cdarkgrey" href="#" style="padding-left: 2em;" lang="en">Support &nbsp;<i
                                    class="mdi mdi-phone cteal"></i> </a>
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </div> <!-- container-scroller -->
    <input type="hidden" id="server_cdn" value="{{ env('CDN') }}">
    <input type="hidden" class="id_komunitas">
    <input type="hidden" class="community_name">


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

    <!-- MOdal Image Viewer-->
    <div class="modal fade bd-example-modal-xl" id="mdl-img-click" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 50px;color: red;">&times;</span>
                    </button>
                </div>
                <center>
                    <img id="mdl-img-view">
                </center>
            </div>
        </div>
    </div>

    <!-- MODAL LOGOUT-->
    <div class="modal fade" id="modal_logout_subscriber" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 80%; min-height: 350px;">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/img/logout.png" id="img_signout_subs">
                        <h3 class="cgrey" lang="en">Logout Confirmation</h3>
                        <small class="clight" lang="en">Are you sure, you want to exit ?</small>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">No, Im Doubt</span>
                        </button>
                        &nbsp;
                        <button onclick="LogoutSubscriber()" id="btn_logout_all" type="button"
                            class="btn btn-tosca btn-sm">

                            <span class="hide_load_log" style="display: none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                            </span>
                            <div id="text_logout"><i class="mdi mdi-check btn-icon-prepend"></i><span lang="en">Yeah, Im
                                    Sure</span></div>
                        </button>

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
                        <h4 class="modal-title cgrey" lang="en">Edit Profile</h4>

                        <button type="button" id="btn_mdl_changepass" class="btn btn-tosca btn-sm"
                            style="margin-bottom: 1em;" data-toggle="modal" data-target="#modal_changepass_subs"
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
                                    <small class="clight" lang="en">Fullname</small>
                                    <input type="text" id="name_subs" name="name_subs" class="form-control input-abu">
                                </div>
                                <div class="form-group">
                                    <small class="clight" lang="en">Username</small>
                                    <input type="text" id="username_subs" name="username_subs"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <small class="clight" lang="en">Phone Number</small>
                                    <input type="text" id="phone_subs" name="phone_subs" class="form-control input-abu">
                                </div>
                                <div class="form-group">
                                    <small class="clight" lang="en">Email</small>
                                    <input type="text" id="email_subs" name="email_subs" class="form-control input-abu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <small class="clight" lang="en">Address</small>
                                <textarea class="form-control input-abu" id="alamat_subs" name="alamat_subs"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div> <!-- end-body -->

                    <div class="modal-footer" style="border: none;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i><span lang="en">Edit</span> </button>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>

    <!-- MODAL CHANGE PASSWORD-->
    <div class="modal fade" id="modal_changepass_subs" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 400px; min-height: 350px;">

                <form method="POST" id="form_changepass_admin" action="{{route('change_password_subs')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                        <center>
                            <img src="/img/key.png" id="img_changepass">
                        </center>
                        <div class="form-group">
                            <small class="clight" lang="en">Old Password</small>
                            <input type="password" id="old_pass_subs" name="old_pass_subs"
                                class="form-control input-abu">
                        </div>

                        <div class="form-group">
                            <small class="clight" lang="en">New Password</small>
                            <div class="input-group">
                                <input class="form-control input-abu" id="new_pass_subs" type="password"
                                    name="new_pass_subs" required="" autocomplete="passadmin"
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

                    <div class="modal-footer changepass pas_tengah" style="border: none;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">No, Im Doubt</button>
                        &nbsp;
                        <button type="submit" class="btn btn-tosca btn-sm btn-center">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> <span lang="en">Yeah, Im Sure</span></button>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>









    @else
    @if (Session::has('auth_subs'))
    @foreach(Session::get('auth_subs') as $newdata)
    <script>window.location = "/subscriber/url/{{ $newdata['name'] }}";</script>
    @endforeach
    @else
    <script>window.location = "/";</script>
    @endif
    @endif

    <!-- plugins:js -->
    <script src="{{asset('js/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('purple/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('purple/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('purple/js/off-canvas.js')}}"></script>
    <script src="{{asset('purple/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('purple/js/misc.js')}}"></script>
    <script src="{{asset('purple/js/dashboard.js')}}"></script>
    <script src="{{asset('purple/js/todolist.js')}}"></script>
    <script src="{{asset('purple/js/file-upload.js')}}"></script>

    <!-- afwika custom translate page  -->
    <script src="{{asset('js/js.cookie.js')}}" charset="utf-8" type="text/javascript"></script>
    <script src="{{asset('js/jquery-lang.js')}}" charset="utf-8" type="text/javascript"></script>


    <!-- js custum superadmin -->
    <script src="{{asset('js/subscriber.js')}}"></script>

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

    <!-- Sweetalert -->
    <!-- <script src="/js/sweetalert.min.js"></script> -->



    <!-- Sweetalert -->
    <script src="{{asset('js/sweetalert.min.js')}}"></script>


    <!-- <script src="{{asset('')}}"></script> -->





    @include('sweet::alert')


    @yield('script')
</body>

</html>
