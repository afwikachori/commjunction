@extends('layout.app')

@section('content')
<!-- <div class="container"> -->
  <div class="row" style="height: 670px;">
    <div class="col warnain">
      <center>
        <img src="/pic/social.jpg" class="rounded-circle img-fluid" style="width: 22%; height: auto; margin-top: 22%; margin-bottom: 1em;">
        <h2>Welcome to <br>
        Community </h2>
      </center>
    </div>
    <div class="col">
    <div class="container">
        <div class="row">
    <div class="col">
     <!--  1 of 3 -->
    </div>
    <div class="col-6" style="margin-top: 15%;">
        <h1 style="margin-bottom: 1em;">Please login to continue</h1>
<form>
    <div class="form-group">
     <input type="email" class="form-control" id="keyloginsubs"  placeholder="Enter email">
    </div>

    <div class="input-group mb-3">
  <input class="form-control" id="pass_subs" type="password" placeholder="Password" aria-describedby="btn_lihatpass">
  <div class="input-group-append">
    <button class="btn btn-outline-light" type="button" id="btn_lihatpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
    </button>
  </div>
</div>

<button type="submit" class="btn btn-primary btn-grad" id="login_subs">Login</button>

<div id="my-signin2" id="signGoogle" class="RegisterGoogle mgtop-1"></div>

</form>
 <br>
            <span class="mgtop-2">Didnt have account yet ?</span>
            <br>
            <a href="/subscriber/registerSubs">Register Now</a>
            <br>
    </div>
    <div class="col">
    <!--   3 of 3 -->
    </div>
  </div>
    </div>
    </div>
  </div>
<!-- </div> -->
@endsection

@section('script')
<script type="text/javascript">
 function showPass() {
  var a = document.getElementById("pass_subs");
  if (a.type == "password") {
    a.type = "text";
  } else {
    a.type = "password";
  }
}


    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }


    function onSuccess(googleUser) {
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    }
    function onFailure(error) {
        console.log(error);
    }
    function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 200,
            'height': 37,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }

</script>

@endsection