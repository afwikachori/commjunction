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
    <link rel="stylesheet" href="/css/superadmin.css">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <!-- export datatble -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">


    <!-- Styles -->
    @yield('css')
</head>


<body>

    @if (Session::has('session_logged_superadmin'))

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            @include('superadmin.navbar')
        </nav>


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('superadmin.sidebar')
            </nav>


            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->

                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            <a class="cdarkgrey" href="" style="padding-right: 2em;">Terms & Conditions</a>
                            <a class="cdarkgrey" href="" style="padding-right: 2em;">Privacy Policy</a>
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <a class="cdarkgrey" href="" style="padding-left: 2em;">
                                Documentation &nbsp;<i class="mdi mdi-checkbox-blank-circle cteal s10"></i> </a>
                            <a class="cdarkgrey" href="" style="padding-left: 2em;">
                                Support &nbsp;<i class="mdi mdi-phone cteal"></i> </a>
                        </span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->


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


    </div>
    <!-- container-scroller -->



    <!-- MODAL LOGOUT-->
    <div class="modal fade" id="modal_logout_superadmin" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #ffffff; width: 80%;
    min-height: 350px;">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/img/logout.png" id="img_signout_superadmin">
                        <h3 class="cgrey">Logout Comfirmation</h3>
                        <small class="clight">Are you sure, you want to exit ?</small>
                    </center>
                </div>
                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> No, Im Doubt
                        </button>
                        &nbsp;
                        <a href="/superadmin/logout" type="button" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Yeah, Im Sure </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL LOGOUT -->

    @else
    <script>window.location = "/superadmin";</script>
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

    <!-- datatable export  -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- js custum superadmin -->
    <script src="/js/superadmin.js"></script>

    <!-- js multiselect -->
    {{-- <script src="/js/BsMultiSelect.js"></script> --}}

    <!-- Sweetalert -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')

    @yield('script')

</body>

</html>
