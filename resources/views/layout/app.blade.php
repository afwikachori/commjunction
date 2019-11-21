<!DOCTYPE html>
<html lang="en">
<head>
    <!-- @yield('head') -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="202656268177-a4siagg2udohucphclgl5655j6c3dsd6.apps.googleusercontent.com">
   

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    

    <title>@yield('title')</title>

    
    <!-- CSS Files -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/atlantis.min.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/master.css"> 

    <!-- Styles -->
    @yield('css')

</head>
<body>

     
            @yield('content')

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js"></script>
    <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/custom-validation.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    
    @yield('script')
</body>
</html>
