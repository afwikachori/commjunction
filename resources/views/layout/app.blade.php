<!DOCTYPE html>
<html lang="en">
<head>
    <!-- @yield('head') -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


     <meta name="google-signin-client_id" content="889108417330-5undo76r5eqfl1fuf3e93eusu2kbaei8.apps.googleusercontent.com">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>@yield('title')</title>

    <!-- ICON WEB -->
    <link rel="icon" href="/img/commjuction_icoweb.ico"/>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/master.css"> <!-- //custom -->
    <link rel="stylesheet" href="/css/master-mobile.css"> <!-- //custom -->

    <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">

    <!-- Styles -->
    @yield('css')

</head>
<body>


            @yield('content')
            <div id="fb-root"></div>


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

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js"></script>
    <!-- <script src="/js/jquery-3.4.1.slim.min.js"></script> -->
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- afwika custom translate page  -->
    <script src="/js/js.cookie.js" charset="utf-8" type="text/javascript"></script>
    <script src="/js/jquery-lang.js" charset="utf-8" type="text/javascript"></script>

    <!-- afwika js custum validation admin -->
    <script src="/js/custom-validation.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>

    @include('sweet::alert')

    @yield('script')
</body>
</html>
