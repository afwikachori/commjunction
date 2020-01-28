@extends('layout.app')

@section('content')


@if (Session::has('subs_data'))
@foreach(Session::get('subs_data') as $dt)


<div class="row">
    <div class="col-sm biruq">
      <img src="{{ env('CDN') }}{{ $dt['logo'] }}" id="login-left-commjuctioncdn" class="rounded-circle img-fluid">

    <div class="container subs_judul">
      <h2 lang="en">{{ $dt['name'] }}</h2>
      <h5  lang="en">{{ $dt['description'] }}</h5>
    </div>

      <img src="/visual/loginadmin.png" id="login-left-img">

    </div>
    <div class="col-lg-4">
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
 <span lang="en" class="h6 cteal">didnt have account yet ?</span>
<a href="/subscriber/register" class="h6" id="subsregisklik" lang="en" data-lang-token="registernow">Register Now</a>
</div>

    <div class="container pdsubslogin">
       <h2 lang="en" style="color: #4F4F4F;">Login</h2>
       <label lang="en" class="cgrey textlogin">Please login to continue using this app</label>

            <!-- login  Form -->
            <form method="POST" id="form_login_admin" action="{{route('LoginSubscriber')}}">

                 {{ csrf_field() }}
        <input type="hidden" class="form-control" value="{{ $dt['id'] }}" name="id_community">
        @if( $dt['form_type'] == 1)
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Username</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp" class="form-control @error('input_login') is-invalid @enderror" name="input_login" value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
        @elseif( $dt['form_type'] == 2)
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Phone Number</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp" class="form-control @error('input_login') is-invalid @enderror" name="input_login" value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
        @else
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Email</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp" class="form-control @error('input_login') is-invalid @enderror" name="input_login" value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
        @endif

                <div class="form-group mb-3">
                <label class="h6 cgrey" for="pass_subs" lang="en">Password</label>

                <div class="input-group">
                  <input class="form-control" id="pass_subs" type="password"  value="{{ old('pass_subs') }}"  class="form-control @error('pass_subs') is-invalid @enderror" name="pass_subs" required autocomplete="pass_subs" aria-describedby="btn_showpass">
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
                      <input class="form-check-input" type="checkbox" id="rememberme">
                      <label class="h6 form-check-label cteal" for="gridCheck" style="color: rgba(14, 95, 117, 0.75);" lang="en">Remember me</label>
                    </div>
                </div>
                <div class="col" style="text-align: right;">
                    <label><a href="" class="h6" style="color: rgba(14, 95, 117, 0.4);" lang="en">Forgot password?</a></label>
                </div>
                </div>

                <div class="form-group mb-3">
                <button lang="en" type="submit" class="btn btn-primary" id="LoginSubscriber">Login</button>
                </div>

                <div class='hr-or'><small class="clight" lang="en">or login with</small></div>

                <center>
                <div class="row" style="margin-bottom: 2em;">
                    <div class="col" style="margin-bottom: 0.5em;">
                        <div  id="signGoogle2" class="RegisterGoogle mgtop-1"></div>
                    </div>
                    <div class="col">
                    
                    </div>
                </div> </center>
            </form>
    </div>
</div>
  </div>
@endforeach
@else
  <script>window.location = "/404";</script>
@endif

@endsection

@section('script')
<script type="text/javascript">

$( document ).ready(function() {
get_auth_subs();
});

function get_auth_subs(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/subscriber/ses_auth_subs',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Reach Session Auth Subscriber");
    }
});
}

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
        var id_token = googleUser.getAuthResponse().id_token;

        console.log('ID: ' + profile.getId());
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail());
        console.log(id_token);

    }


    function onSuccess(googleUser) {
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    }

    function onFailure(error) {
        console.log(error);
    }
    
    function renderButton() {
        gapi.signin2.render('signGoogle2', {
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