<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Support Commjunction</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/purple/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/purple/vendors/css/vendor.bundle.base.css">
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

              <div class="row mt-5">
                <div class="col-12 mt-xl-2">
                    <a class="font-weight-medium" href="/superadmin/dashboard" style="color: #4e4e4e !important;"><i class="fa fa-chevron-left"></i> Back to Application</a>
                    &nbsp;&nbsp;&nbsp;
                   <a class="text-white font-weight-medium tebal" href="/support/inquiry_log">Go Support  <i class="fa fa-chevron-right"></i></a>
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
    });


    function session_logged_superadmin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/session_logged_superadmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show session superadmin");
            }
        });
    }


    </script>

  </body>
</html>
