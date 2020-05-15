<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Support Commjunction</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- plugins:css -->
    <link rel="stylesheet" href="/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/purple/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('css/superadmin.css')}}">
    <link rel="stylesheet" href="/purple/css/style.css">


    <!-- ICON WEB -->
    <link rel="icon" href="/img/commjuction_icoweb.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            @include('support.support_navbar')
        </nav>
    </div>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
                <div class="row flex-grow">
                    <div class="col-lg-7 mx-auto text-white">
                        <div class="row align-items-center d-flex flex-row">
                            <div class="col-lg-6 text-lg-right pr-lg-4">
                                <h1 class="display-1 mb-0">Hi !</h1>
                            </div>
                            <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                                <h2>WELCOME!</h2>
                                <h4 class="font-weight-light">To Commjunction Support System</h4>
                                <br>
                                <h3 class="font-weight-light">Manage information for inquiry bussiness</h2>
                            </div>
                        </div>

                        <div class="row mt-5" id="hide_link_support">
                            <div class="col-12 mt-xl-2">
                                <a class="font-weight-medium" href="/superadmin/dashboard"
                                    style="color: #4e4e4e !important;"><i class="fa fa-chevron-left"></i> Back to
                                    Application</a>
                                &nbsp;&nbsp;&nbsp;
                                <a class="text-white font-weight-medium tebal" href="/support/inquiry_log">Go Support <i
                                        class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- MODAL INPUT LOGIN SUPERADMIN-->
    <div class="modal fade" id="modal_input_login_superadmin" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 400px;
        min-height: 350px;">

                <form method="POST" id="form_input_loginsuper" action="{{route('InputloginSuperadmin')}}">
                    {{ csrf_field() }}

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                        <center>
                            <img src="/visual/logo2.png" id="img_changepass">
                        </center>
                        <form class="form-login-super" method="POST" id="form_registerfirst_admin"
                            action="{{route('loginSuperadmin')}}" enctype="multipart/form-data">{{ csrf_field() }}
                            <div class="form-group ">
                                <label for="username_superadmin" class="h6 s14" lang="en">Username</label>
                                <input type="text" name="username_superadmin" class="form-control input-abu"
                                    id="username_superadmin" value="{{ old('username_superadmin') }}"
                                    placeholder="Username" lang="en">
                            </div>

                            <div class="form-group  mgtop-1">
                                <label for="pass_superadmin" class="h6 s14" lang="en">Password</label>
                                <div class="input-group">
                                    <input class="form-control" id="pass_superadmin" type="password"
                                        placeholder="Password" lang="en" value="{{ old('pass_superadmin') }}"
                                        class="form-control @error('pass_superadmin') is-invalid @enderror"
                                        name="pass_superadmin" required autocomplete="pass_superadmin"
                                        aria-describedby="btn_showpasssuper"
                                        style="border-radius: 10px 0px 0px 10px; background: #efefef;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-light btn-round" type="button"
                                            id="btn_showpasssuper" onclick="showPassSuper()" style="border-radius: 0px 10px 10px 0px;
                                                    background: #efefef;
                                                    margin-top: -0.1em;
                                                    height: 47.5px;">
                                            <span class="mdi mdi-eye cgrey" id="ico-mata-superadmin"
                                                aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- end-body -->

                    <div class="modal-footer changepass" style="border: none; margin-left: auto; margin-right: auto;">
                        <center>
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                style="border-radius: 10px;">
                                <i class="mdi mdi-close"></i> Cancel
                            </button>
                            &nbsp;
                            <button type="submit" class="btn btn-tosca btn-sm"
                                style="border-radius: 10px; border: none;">
                                <i class="mdi mdi-check btn-icon-prepend">
                                </i> Submit </button>
                        </center>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->

        </div>
    </div>



    <!-- plugins:js -->
    <script src="/purple/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/purple/js/off-canvas.js"></script>
    <script src="/purple/js/hoverable-collapse.js"></script>
    <script src="/purple/js/misc.js"></script>
    <!-- endinject -->

    <!-- Sweetalert -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

    <script type="text/javascript">
        $(document).ready(function () {
            $("#nav_minimize_sidebar").hide();
            session_logged_superadmin();
        });


        function session_logged_superadmin() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/superadmin/get_session_logged_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                success: function (result) {
                    console.log(result);

                    if (result == "session is null") {
                        $("#modal_input_login_superadmin").modal('show');
                        $("#hide_link_support").hide();
                    } else {
                        ("#hide_link_support").show();
                    }
                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show session superadmin");
                }
            });
        }

        function showPassSuper() {
            var a = document.getElementById("pass_superadmin");
            if (a.type == "password") {
                a.type = "text";
            } else {
                a.type = "password";
            }
        }
    </script>

</body>

</html>
