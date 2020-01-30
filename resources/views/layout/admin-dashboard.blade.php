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
    <link rel="icon" href="/img/commjuction_icoweb.ico"/>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/purple/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/purple/css/style.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="/visual/commjuction.png" />

    <!-- Styles Custom-->
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/admin-mobile.css"> 

    <!-- chart -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"> 



    @yield('css')
  </head>

  
  <body>

  <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        @include('admin.dashboard.admin_navbar')
      </nav>


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
         @include('admin.dashboard.admin_sidebar')
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
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="">Commjuction</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

<!-- MODAL LOADING AJAX -->
<div class="modal fade modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content loading">
    <center>
    <div class="spinner-border text-light" style="width: 5rem; height: 5rem; margin-bottom: 1em;" role="status">
    <span class="sr-only">Loading...</span>
  </div>
<p class="h6 iniloading">Loading . . .</p>
  <center>
    </div>
  </div>
</div>
<!-- END-MODAL -->


<!-- MOdal Image Viewer-->
<div class="modal fade bd-example-modal-xl" id="mdl-img-click" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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



    <!-- plugins:js -->
    <script src="/js/jquery.3.2.1.min.js"></script>
    <script src="/purple/vendors/js/vendor.bundle.base.js"></script>
    <script src="/purple/vendors/chart.js/Chart.min.js"></script>
    <script src="/purple/js/off-canvas.js"></script>
    <script src="/purple/js/hoverable-collapse.js"></script>
    <script src="/purple/js/misc.js"></script>
    <script src="/purple/js/dashboard.js"></script>
    <script src="/purple/js/todolist.js"></script>

    <script src="/purple/js/todolist.js"></script>

    <script src="{{ asset('/js/admincom.js') }}"></script>

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>



    <!-- Sweetalert -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    
    @yield('script')
  </body>
</html>