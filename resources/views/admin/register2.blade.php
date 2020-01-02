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
    <div class="col-8">
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
        <h3 lang="en" style="color: #4F4F4F; margin-right: -0.5em;">Register</h3>
        <label lang="en" class="clight s15" data-lang-token="info-regis1">Let’s us understand more about you, please fill your information to continue,  so you can using our app.</label>
      

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link homeq disabled" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false" aria-disabled="disabled">Community Information</a>

    <a class="nav-item nav-link profileq active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Personal Information</a>
  </div>
</nav>

<form method="POST" id="form_registersecond_admin" action="{{route('registersecond')}}" class="kontenregsiter mgtop-1" style="margin-bottom: 2em;">{{ csrf_field() }}

<div class="container">
<div class="row" style="margin-top: 0.3em;">

<div class="col">
    <div class="form-group row">
        <label lang="en" class="h6 cgrey s14">Connect With</label>
        <!-- <div id="my-signin"></div>  -->
        <div class="g-signin2" data-onsuccess="onSignIn" style="margin-top: 1.7em; margin-left: -5.3em;"></div>

        <input type="hidden" id="sso_type" name="sso_type" value="1">
        <input type="hidden" id="sso_token" name="sso_token">
    </div>

     <div class="form-group row">
        <label for="name_admin" class="h6 cgrey s14" lang="en">Name</label>
            <input id="name_admin" type="text" class="form-control @error('name_admin') is-invalid @enderror" name="name_admin" value="{{ old('name_admin') }}" required autocomplete="name_admin" autofocus>
            <small lang="en" id="pesan_nameadmin" class="redhide">At least 3 character and Only Letters!</small>@if($errors->has('name_admin'))
            <small class="error_regis2" style="color: red;" lang="en">{{ $errors->first('name_admin')}}</small>
            @endif
    </div>

    <div class="form-group row">
        <label for="email_admin" class="h6 cgrey s14" lang="en">Email Address</label>
        <input id="email_admin" type="email" class="form-control @error('email') is-invalid @enderror" name="email_admin" value="{{ old('email_admin') }}" required autocomplete="email_admin"><small id="pesan_emailadmin" class="redhide" lang="en">Include '@' in format email address!</small>
        <small id="pesan_emailadmin2" class="redhide" lang="en">Email has been registered! Try another</small>
        @if($errors->has('email_admin'))
        <small class="error_regis2" style="color: red;">{{ $errors->first('email_admin')}}</small>
        @endif
    </div>

<div class="form-group row">
    <label for="password_admin" class="h6 cgrey s15" lang="en">Password</label>
                                
<div class="input-group">
  <input class="form-control" id="password_admin" type="password"  value="{{ old('password_admin') }}"  class="form-control @error('password_admin') is-invalid @enderror" name="password_admin" required autocomplete="password_admin" aria-describedby="btn_showpass">
  <div class="input-group-append">
    <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
    </button>
  </div>
</div>

<small id="pesan_passadmin" lang="en" class="redhide">Mininum 8 character contain Numbers and Letters!</small>
@if($errors->has('password_admin'))
<small class="error_regis2" style="color: red;">{{ $errors->first('password_admin')}} Must contain numbers and letters
</small>
@endif
</div>


</div>

<div class="col-1"></div>

<div class="col">
    <div class="form-group row">
        <label for="username_admin" class="h6 cgrey s14" lang="en">Username Login</label>
        <input id="username_admin" type="text" class="form-control @error('username_admin') is-invalid @enderror" name="username_admin" value="{{ old('username_admin') }}" required autocomplete="username_admin">
        <small id="pesan_usernameadmin" lang="en" class="redhide">Mininum 6 character contain Numbers and Letters!</small>
        <small id="pesan_usernameadmin2" lang="en" class="redhide">Username already taken! Try another!</small>
         @if($errors->has('username_admin'))
         <small class="error_regis2" style="color: red;" lang="en">{{ $errors->first('username_admin')}} At least 6 characters contain Numbers and Letters</small>
         @endif
     </div>

<div class="form-group row"> 
    <label for="phone_admin" class="h6 cgrey s14" lang="en">Phone Number</label>
    <input id="phone_admin" type="text" class="form-control @error('phone_admin') is-invalid @enderror" name="phone_admin" value="{{ old('phone_admin') }}" required autocomplete="phone_admin" autofocus>
    <small id="pesan_phone" class="redhide" lang="en">At least contains 10 Numbers!</small>
    <small id="pesan_phone2" class="redhide" lang="en">Number phone has registered! Try another</small>

    @if($errors->has('phone_admin'))
    <small class="error_regis2" style="color: red;">{{ $errors->first('phone_admin')}} </small>
    @endif
</div>
                  
<div class="form-group row">
    <label for="alamat_admin" class="h6 cgrey s14" lang="en">Address</label>
    <textarea id="alamat_admin" rows="1" class="form-control @error('alamat_admin') is-invalid @enderror" name="alamat_admin" required autocomplete="alamat_admin">{{ old('alamat_admin') }}</textarea>
    <small id="pesan_alamatadmin" class="redhide" lang="en" >Input your detail address!</small>
    @if($errors->has('alamat_admin'))
    <small class="error_regis2" style="color: red;">{{ $errors->first('alamat_admin')}}</small>
    @endif
</div>

<div class="form-group row">
    <label for="password_confirm" class="h6 cgrey" lang="en">Confirm Password </label>
    <input id="password_confirm" type="password"  value="{{ old('password_confirm') }}" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" required autocomplete="password_confirm">
    <small id="pconfirmpass" lang="en" class="redhide">Password & Confirm Password didnt match!</small>
    @if($errors->has('password_confirm'))
    <small class="error_regis2" style="color: red;">{{ $errors->first('password_confirm')}}</small>
@endif
</div>

</div> <!-- end-col -->
</div> <!-- end-row -->

<div class="row" style="margin-bottom: -0.5em; margin-top: 1em;">
 <button type="button" onclick="location.href='/admin/register';"  class="btn backbtn" lang="en">Back</button>
&nbsp;&nbsp;&nbsp;
 <button id="btn_register2" type="submit" class="btn" lang="en">Next</button>
</div>

</div> <!-- end-container -->              
</form>

</div>
</div>
@endsection



@section('script')
<script type="text/javascript">
$(document).ready(function () {
get_session2();
});


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
        if (result != ""){
        $("#name_admin").val(result.full_name);
        $("#phone_admin").val(result.notelp);
        $("#email_admin").val(result.email);
        $("#alamat_admin").val(result.alamat);
        $("#username_admin").val(result.user_name);
        $("#password_admin").val(result.password);
        $("#password_confirm").val(result.password); 
        }
        
      },
      error: function (result) {
        console.log("Cant Reach Session Register One");
    }
});
}

</script>

@endsection





