@extends('layout.app')
@section('title', 'Subscriber')

@if (Session::has('auth_subs'))
@foreach($subs_data as $dt)

@section('css')
    <style lang="sass">
        :root {
             --base_color: {{ $dt['cust_portal_login']['base_color'] }};
            --accent_color: {{ $dt['cust_portal_login']['accent_color'] }};
        }
    </style>
@endsection

   {{-- "font_headline": "Times New Roman",
      "font_link": "Times New Roman",
      "base_color": "#FF5733 ",
      "accent_color": "#FF5733 " --}}

@section('content')
<div class="row" style="overflow: hidden;">
    <div class="col-md-8 biruq">
        <img src="{{ env('CDN') }}/{{ $dt['cust_portal_login']['image'] }}" id="img_portal_bg"
        onerror="this.onerror=null;this.src='/visual/bg_subs.png';">

        <div class="row">
            <div class="col-md-6 relativeini">
                <img src="{{ env('CDN') }}/{{ $dt['cust_portal_login']['icon'] }}" id="img_icon_portal"
                    class="img-fluid" onerror="this.onerror=null;this.src='/visual/commjuction.png';">
            </div>
            <div class="col-md-6" style="text-align: right;">
                <!-- <img src="{{ env('CDN') }}/{{ $dt['cust_portal_login']['image'] }}" id="login-left-commjuctioncdn"
                    class="rounded-circle img-fluid" onerror="this.onerror=null;this.src='/visual/logo2.png';"> -->
            </div>
        </div>


        <div class="container subs_judul">
            <h2 class="cgrey2 relativepos">{{ $dt['name'] }}</h2>
            <h5 class="relativeini">{{ $dt['cust_portal_login']['headline_text']}}</h5>
            <p class="relativeini">{{ $dt['cust_portal_login']['description'] }}</p>
        </div>

        <!-- <img src="/visual/loginadmin.png" id="login-img-subs"> -->

    </div>
    <div class="col-md-4">
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
            <span lang="en" class="h6 cteal">Didn't have account yet ?</span>
            <a href="/subscriber/register" class="h6" id="subsregisklik" lang="en"
                data-lang-token="registernow">Register Now</a>
        </div>

        <div class="container pdsubslogin">
            <h2 class="accent_color" lang="en">Welcome</h2>
            <label lang="en" class="cgrey textlogin" lang="en">Please login to continue</label>

            <!-- login  Form -->
            <form method="POST" id="form_login_admin" action="{{route('LoginSubscriber')}}">

                {{ csrf_field() }}
                <input type="hidden" class="form-control" value="{{ $dt['id'] }}" name="id_community">
                @if( $dt['form_type'] == 1)
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Username</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp"
                        class="form-control @error('input_login') is-invalid @enderror" name="input_login"
                        value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
                @elseif( $dt['form_type'] == 2)
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Phone Number</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp"
                        class="form-control @error('input_login') is-invalid @enderror" name="input_login"
                        value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
                @else
                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="input_login" lang="en">Email</label>
                    <input lang="en" type="text" class="form-control" id="input_login" aria-describedby="emailHelp"
                        class="form-control @error('input_login') is-invalid @enderror" name="input_login"
                        value="{{ old('input_login') }}" required autocomplete="input_login" autofocus>
                </div>
                @endif

                <div class="form-group mb-3">
                    <label class="h6 cgrey" for="pass_subs" lang="en">Password</label>

                    <div class="input-group">
                        <input class="form-control" id="pass_subs" type="password" value="{{ old('pass_subs') }}"
                            class="form-control @error('pass_subs') is-invalid @enderror" name="pass_subs" required
                            autocomplete="pass_subs" aria-describedby="btn_showpass">
                        <div class="input-group-append">
                            <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()"
                                style="border-color: #ced4da;">
                                <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberme">
                            <label class="h6 form-check-label cteal" for="gridCheck"
                                style="color: rgba(14, 95, 117, 0.75);" lang="en">Remember me</label>
                        </div>
                    </div>
                    <div class="col" style="text-align: right;">
                        <label><a href="/admin/forgetpass_admin" class="h6" style="color: rgba(14, 95, 117, 0.4);"
                                lang="en">Forgot password?</a></label>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button lang="en" type="submit" class="btn btn-basecolor" id="LoginSubscriber"
                        lang="en">Login</button>
                </div>

                <!-- <div id="login_btn_google">
                <div class='hr-or'><small class="clight" lang="en">or login with</small></div>

                <center>
                <div class="row" style="margin-bottom: 2em;">
                    <div class="col" style="margin-bottom: 0.5em;">
                        <div  id="signGoogle2" class="RegisterGoogle mgtop-1"></div>
                    </div>
                    <div class="col">

                    </div>
                </div> </center>
                </div> -->
            </form>
        </div>
    </div>
</div>
@endsection

@endforeach
@else
<script>window.location = "/404";</script>
@endif



@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        checking_remember();
    });


    function remember_me_admin() {
        var checkBox = document.getElementById("rememberme");

        if (checkBox.checked == true) {
            var username = $('#input_login').val();
            var password = $('#pass_subs').val();

            $.cookie('input_login', username, { expires: 30 });
            $.cookie('pass_subs', password, { expires: 30 });
            $.cookie('rememberme', true, { expires: 30 });
        }
        else {
            $.cookie('input_login', null);
            $.cookie('pass_subs', null);
            $.cookie('rememberme', null);
        }
    }

    function checking_remember() {
        var remember = $.cookie('rememberme');

        if (remember == 'true') {
            var username = $.cookie('input_login');
            var password = $.cookie('pass_subs');
            if (username != null && password != null) {
                $('#input_login').val(username);
                $('#pass_subs').val(password);
                $('#rememberme').attr("checked", "checked");
            } else {
                $('#input_login').val("");
                $('#pass_subs').val("");
                $('#rememberme').removeAttr("checked", "checked");
            }
        } else {
            $('#input_login').val("");
            $('#pass_subs').val("");
            $('#rememberme').removeAttr("checked", "checked");
        }
    }


    function showPass() {
        var a = document.getElementById("pass_subs");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }


    // function onSignIn(googleUser) {
    //     var profile = googleUser.getBasicProfile();
    //     var id_token = googleUser.getAuthResponse().id_token;

    //     console.log('ID: ' + profile.getId());
    //     console.log('Name: ' + profile.getName());
    //     console.log('Image URL: ' + profile.getImageUrl());
    //     console.log('Email: ' + profile.getEmail());
    //     console.log(id_token);

    // }


    // function onSuccess(googleUser) {
    //     console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    // }

    // function onFailure(error) {
    //     console.log(error);
    // }

    // function renderButton() {
    //     gapi.signin2.render('signGoogle2', {
    //         'scope': 'profile email',
    //         'width': 200,
    //         'height': 37,
    //         'longtitle': true,
    //         'theme': 'dark',
    //         'onsuccess': onSuccess,
    //         'onfailure': onFailure
    //     });
    // }

</script>

@endsection
