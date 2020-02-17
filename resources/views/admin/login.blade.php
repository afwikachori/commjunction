@extends('layout.app')

@section('content')
<div class="row" id="loginadmincom" class="full_height">
    <div class="col-xl orenq">
      <img src="/visual/commjuction.png" id="login-left-commjuction">

    <div class="container cjudul">
      <h3 lang="en" class="judullogin">Lets Get Started</h3>
      <p class="deslogin" lang="en">Gathering data with a smart application that trusted and fastest.</p>
    </div>

      <img src="/visual/loginadmin.png" id="img-loginadmin">

    </div>
    <div class="col-xl-5">
<div class="row">
    <div class="col">

    </div>
    <div class="col-4" style="text-align: right; margin-right: 1em; margin-top: 0.5em;">
    <a href="" class="langimg" onclick="window.lang.change('en'); return false;">
    <img border="0" src="/img/en.png" width="30" height="30">
    </a>
    <a href="" class="langimg" onclick="window.lang.change('id'); return false;">
    <img border="0" src="/img/id.png" width="30" height="30">
    </a>
    </div>
</div>

<div style="margin-top: 1em; margin-right: 1.5em; text-align: right;">
 <span lang="en" class="h6 cteal">didnt have community yet ?</span>
<a href="/admin/register" class="h6" id="klikregister" lang="en" data-lang-token="registernow">Register Now</a>
</div>

    <div class="container pdcuslogin">
       <h1 lang="en" style="color: #4F4F4F;">Login</h1>
       <label lang="en" class="cgrey textlogin">Please login to continue using this app</label>

            <!-- login  Form -->
            <form method="POST" id="form_login_admin" action="{{route('auth_adminlogin')}}">

                 {{ csrf_field() }}
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="useradmin" lang="en">Username</label>
                    <input lang="en" type="text" class="form-control" id="useradmin" aria-describedby="emailHelp" class="form-control @error('useradmin') is-invalid @enderror" name="useradmin" required autocomplete="useradmin" autofocus>
                </div>

                <div class="form-group mb-3">
                <label class="h6 cgrey" for="passadmin" lang="en">Password</label>

                <div class="input-group">
                  <input class="form-control" id="passadmin" type="password"  class="form-control @error('passadmin') is-invalid @enderror" name="passadmin" required autocomplete="passadmin" aria-describedby="btn_showpass">
                  <div class="input-group-append">
                    <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
                         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
                    </button>
                  </div>
                </div>
                </div>

                <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="rememberme_admincomm" name="rememberme_admincomm" onclick="remember_me_admin()">
                      <label class="h6 form-check-label cteal" for="gridCheck" style="color: rgba(14, 95, 117, 0.75);" lang="en">Remember me</label>
                    </div>
                </div>
                <div class="col" style="text-align: right;">
                    <label><a href="/admin/forgetpass_admin" class="h6" style="color: rgba(14, 95, 117, 0.4);" lang="en">Forgot password?</a></label>
                </div>
                </div>

                <div class="form-group mb-3">
                <button lang="en" type="submit" class="btn btn-primary" id="LoginComm">Login</button>
                </div>
                <br>
                <div class='hr-or'><small class="clight" lang="en">or login with</small></div>

                <center>
                <div class="row" style="margin-bottom: 2em;">
                    <div class="col" style="margin-bottom: 0.5em;">
                       <div class="g-signin2 login" data-onsuccess="onSignIn"></div>
                    </div>
                    <div class="col">

                    </div>
                </div> </center>
            </form>
    </div>
</div>
  </div>
@endsection

@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
checking_remember();
});



/// BUTTON GOOGLE SIGIN
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId());
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail());
    }

    function onSuccess(googleUser) {
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
         var id_token = googleUser.getAuthResponse().id_token;
         console.log("id_token = "+id_token);
        onSignIn(googleUser);
        // window.location.href = "/admin/testing";
    }

    function onFailure(error) {
        console.log(error);
    }
// END-BUTTON GOOGLE SIGIN





 function showPass() {
  var a = document.getElementById("passadmin");
  var b = document.getElementById("ico-mata");
  if (a.type == "password") {
    a.type = "text";
    b.class = "fa fa-eye-slash";
  } else {
    a.type = "password";
    b.class = "fa fa-eye";
  }
}



function remember_me_admin() {
  var checkBox = document.getElementById("rememberme_admincomm");

  if (checkBox.checked == true){
    var username = $('#useradmin').val();
    var password = $('#passadmin').val();

    $.cookie('useradmin', username, { expires: 30 });
    $.cookie('passadmin', password, { expires: 30 });
    $.cookie('rememberme_admincomm', true, { expires: 30 });
  }
  else {
    $.cookie('useradmin', null);
    $.cookie('passadmin', null);
    $.cookie('remember', null);
  }
}

function checking_remember() {
var remember = $.cookie('rememberme_admincomm');

if ( remember == 'true' ) {
    var username = $.cookie('useradmin');
    var password = $.cookie('passadmin');
    if( username != null && password != null){
        $('#useradmin').val(username);
        $('#passadmin').val(password);
        $('#rememberme_admincomm').attr( "checked", "checked");
    }else{
        $('#useradmin').val("");
        $('#passadmin').val("");
        $('#rememberme_admincomm').removeAttr( "checked", "checked");
    }
 }else{
    $('#useradmin').val("");
    $('#passadmin').val("");
    $('#rememberme_admincomm').removeAttr( "checked", "checked");
 }
}



</script>

@endsection
