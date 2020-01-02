@extends('layout.app')

@section('content')
<div class="row">
    <div class="col orenq">
       <img src="/visual/commjuction.png" id="commjuction-regis1">
       <img src="/visual/regis1.png" class="vs-regis">
       <center>
       <h5 class="putih" lang="en" style="margin-left: 1.5em; margin-right: 1.5em; margin-top: 6em;">Some detailed information your community needs</h5>
       </center>
    </div>
    <div class="col-lg-8">
      <div class="row">
        <div class="col langimgq">
          <a href="" onclick="window.lang.change('en'); return false;">
          <img border="0" src="/img/en.png" width="30" height="30">
          </a>
          <a href="" onclick="window.lang.change('id'); return false;">
          <img border="0" src="/img/id.png" width="30" height="30">
          </a>
        </div>
        <div class="col">
        <div class="sigin">
          <span lang="en" class="h6 cteal">Already member?</span>
          <a href="/admin" class="h6" id="klikregister" lang="en" data-lang-token="registernow">&nbsp;Sign In</a>
        </div>
        </div>
      </div>


      <div class="pdregis1">
      <div class="textregisinfo">
        <h3 lang="en" style="color: #4F4F4F; margin-right: -0.5em;">Register</h3>
        <label lang="en" class="clight s15" data-lang-token="info-regis1">Let’s us understand more about you, please fill your information to continue,  so you can using our app.</label>
      </div>

<!-- @include('admin.coba') -->

        <div class="row">
      <div class="col-xs-12 ">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item cus-a nav-link active" id="nav-community-tab" data-toggle="tab" href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="true" lang="en">Community Information</a>
            <a class="nav-item cus-a nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="false" lang="en">Personal Information</a>
          </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-community" role="tabpanel" aria-labelledby="nav-community-tab">
            @include('admin.register')
          </div>
          <div class="tab-pane fade" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
           @include('admin.register2')
          </div>
        </div>
      
      </div>
    </div>

 </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {
  alert('swdewewdwdw klik');

// get_session2();

});

function backregis(){
#("#nav-personal-tab").removeClass("active");
#("#nav-community-tab").addClass();

}


function onSignIn(googleUser) {
var profile = googleUser.getBasicProfile();
var id_token = googleUser.getAuthResponse().id_token;

// console.log('ID: ' + profile.getId());
// console.log('Name: ' + profile.getName());
// console.log('Image URL: ' + profile.getImageUrl());
// console.log('Email: ' + profile.getEmail());
// console.log('id_token: '+id_token);


var isinama = profile.getName();
var isiemail = profile.getEmail();

$("#name_admin").val(isinama);
$("#email_admin").val(isiemail);
$("#sso_type").val(2);
$("#sso_token").val(id_token);
}


function onSuccess(googleUser) {
console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
onSignIn(googleUser);
}

function onFailure(error) {
  console.log(error);
}

function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 150,
            'height': 38,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
});
}


 function showPass() {
  var a = document.getElementById("password_admin");
  var b = document.getElementById("ico-mata");
  if (a.type == "password") {
    a.type = "text";
    b.class = "fa fa-eye-slash";
  } else {
    a.type = "password";
    b.class = "fa fa-eye";
  }
}


function get_session2(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_regisTwo',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        $("#name_admin").val(result.full_name);
        $("#phone_admin").val(result.notelp);
        $("#email_admin").val(result.email);
        $("#alamat_admin").val(result.alamat);
        $("#username_admin").val(result.user_name);
        $("#password_admin").val(result.password);
        $("#password_confirm").val(result.password); 
      },
      error: function (result) {
        console.log("Cant Reach Session Register One");
    }
});
}

</script>

@endsection