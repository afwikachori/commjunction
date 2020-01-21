<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <!-- ICON WEB -->
    <link rel="icon" href="/img/commjuction_icoweb.ico"/>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/purple/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/purple/css/style.css">
    <link rel="stylesheet" href="/css/superadmin.css">
    <link rel="stylesheet" href="/css/dataTables.min.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/visual/commjuction.png" />

    <!-- Styles -->
    @yield('css')
  </head>

  
  <body>
    @if (Session::has('ses_user_logged'))

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
    <!-- js custum superadmin -->
    <script src="/js/superadmin.js"></script>
    <script src="/js/dataTables.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>

    @include('sweet::alert')
    
    @yield('script')

  </body>
</html>