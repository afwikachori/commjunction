@extends('layout.app')

@section('content')

  <div class="row">
    <div class="col biruq">
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


      <div class="pdregis2">
      <div class="col-9 inforegis_subs">
        <h2 lang="en" style="color: #4F4F4F;">Register</h3>
        <label lang="en" class="clight s15" data-lang-token="info-regis1">Let’s us understand more about you, please fill your information to continue,  so you can using our app.</label>
      </div>

        <div class="row">
      <div class="col-xs-12 ">
        <nav class="navtab-subscriber">
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

            <a class="nav-item cus-a nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true" lang="en">Personal Information</a>

            <a class="nav-item cus-a nav-link disabled" id="nav-community-tab" data-toggle="tab" href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="false" aria-disabled="disabled" lang="en">Community Information</a>

             <a class="nav-item cus-a nav-link disabled" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false" aria-disabled="disabled" lang="en">Payment</a>
          </div>
        </nav>

        <form method="POST" id="form_regispersonal_subs" action="">{{ csrf_field() }}

<div class="container">
<div class="row">
    <div class="col">

    <div class="form-group row">
        <label lang="en" class="h6 cgrey s14">Connect With</label>
        <div id="my-signin3"></div>
        <input type="hidden" id="sso_type" name="sso_type" value="1">
        <input type="hidden" id="sso_token" name="sso_token">
    </div>

     <div class="form-group row">
        <label class="h6 cgrey s14" for="fullname_subs" lang="en">Full Name</label>

        <input id="fullname_subs" type="text" class="form-control @error('fullname_subs') is-invalid @enderror" name="fullname_subs" value="{{ old('fullname_subs') }}" required>
        <small id="pesan_name1" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('fullname_subs'))
        <small class="error_name1" style="color: red;">
        {{ $errors->first('fullname_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label for="email_subs" class="h6 cgrey s14" lang="en">Email Address</label>
        <input id="email_subs" type="email" class="form-control @error('email') is-invalid @enderror" name="email_subs" value="{{ old('email_subs') }}" required autocomplete="email_subs"><small id="pesan_emailadmin" class="redhide" lang="en">Include '@' in format email address!</small>
        <small id="pesan_emailsubs" class="redhide" lang="en">Email has been registered! Try another</small>
        @if($errors->has('email_subs'))
        <small class="error_emailsubs" style="color: red;">{{ $errors->first('email_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
    <label for="password_subs" class="h6 cgrey s14" lang="en">Password</label>
    <div class="input-group">
        <input class="form-control" id="password_subs" type="password"  value="{{ old('password_subs') }}"  class="form-control @error('password_subs') is-invalid @enderror" name="password_subs" required autocomplete="password_subs" aria-describedby="btn_showpass">

        <div class="input-group-append">
        <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
        </button>
        </div>
    </div>
        <small id="pesan_passwordsubs" lang="en" class="redhide">Mininum 8 character contain Numbers and Letters!</small>
        @if($errors->has('password_subs'))
        <small class="error_passwordsubs" style="color: red;">{{ $errors->first('password_subs')}} Must contain numbers and letters
        </small>
        @endif
    </div>


    </div> <!-- end-col kiri -->
    <div class="col-1"></div>
    <div class="col">
        <div class="form-group row">
        <label class="h6 clight s14" for="community_id" lang="en">
        Id Community</label>
            <input type="text"  readonly class="form-control-plaintext" name="community_id" value="104" placeholder="104">
        </div>

      <div class="form-group row">
        <label class="h6 cgrey s14" for="notlp_subs" lang="en">
        Phone Number
        </label>

        <input id="notlp_subs" type="text" class="form-control @error('notlp_subs') is-invalid @enderror" name="notlp_subs" value="{{ old('notlp_subs') }}" required>
        <small id="pesan_notlpsubs" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('notlp_subs'))
        <small class="error_notlpsubs" style="color: red;">
        {{ $errors->first('notlp_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label class="h6 cgrey s14" for="username_subs" lang="en">Username</label>

        <input id="username_subs" type="text" class="form-control @error('username_subs') is-invalid @enderror" name="username_subs" value="{{ old('username_subs') }}" required>
        <small id="pesan_usernamesubs" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('username_subs'))
        <small class="error_usernamesubs" style="color: red;">
        {{ $errors->first('username_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label for="passconfirm_subs" class="h6 cgrey s14" lang="en">Confirm Password</label>

        <input id="passconfirm_subs" type="password"  value="{{ old('passconfirm_subs') }}" class="form-control @error('passconfirm_subs') is-invalid @enderror" name="passconfirm_subs" required autocomplete="passconfirm_subs">

        <small id="pesan_passconfirmsubs" lang="en" class="redhide">Password & Confirm Password didnt match!</small>
        @if($errors->has('passconfirm_subs'))
        <small class="error_passconfirmsubs" style="color: red;">{{ $errors->first('passconfirm_subs')}}</small>
         @endif
    </div>

    </div> <!-- end-col kanan -->
  </div> <!-- end-row -->

<div class="form-group row">
    <button type="submit" class="btn btn-regissubs1" lang="en">Next</button>
</div>
</div> <!-- end-container -->

</form>

      </div>
    </div>
 </div>
</div>
</div>

@section('script')
<script type="text/javascript">


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

$("#fullname_subs").val(isinama);
$("#email_subs").val(isiemail);
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
        gapi.signin2.render('my-signin3', {
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


</script>
@endsection
