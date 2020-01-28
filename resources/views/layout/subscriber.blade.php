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
    <link rel="stylesheet" href="/css/subscriber.css">

    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    


    <!-- End layout styles
    <link rel="shortcut icon" href="/visual/commjuction.png" />

    <!-- Styles -->
    @yield('css')
  </head>

  
  <body>

  <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        @include('subscriber.dashboard.subs_navbar')
      </nav>


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
         @include('subscriber.dashboard.subs_sidebar')
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


<!-- Modal INITIAL-3-->
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






</div>
<!-- container-scroller -->

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
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- js custum superadmin -->
    <script src="/js/subscriber.js"></script>

    <!-- Sweetalert -->
    <script src="/js/sweetalert.min.js"></script>
    @include('sweet::alert')
    
    @yield('script')

  </body>
</html>