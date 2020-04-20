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
    <link rel="stylesheet" href="{{asset('css/superadmin.css')}}">

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
    <div class="container-scroller">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- @include('support.support_navbar') -->
               @include('superadmin.navbar')
        </nav>


        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('support.support_sidebar')
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


    <!-- js custum  -->
    <script src="{{asset('js/superadmin.js')}}"></script>

    <script src="{{asset('js/toastr.min.js')}}"></script>


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
    <script src="{{asset('js/sweetalert.min.js')}}"></script>

    @include('sweet::alert')

    @yield('script')
</body>

</html>
