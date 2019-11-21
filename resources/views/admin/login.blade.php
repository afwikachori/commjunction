@extends('layout.app')

@section('content')
<div class="container login-top">
    <div class="row">
        <div class="col-sm-7">  <!-- bagian kiri -->
            <div class="rectangle">
                <h4 style="padding-top: 30%;">Welcome to <br>
                    COMMJUCTION ! </h4>
            </div>
        </div>
        <div class="col-md-5"> <!-- bagian kanan -->
            <h1>Please Login to </h1>       
            <h1>Continue</h1>
            <!-- login  Form -->
            <form>
                 {{ csrf_field() }}
                <div class="form-group">
                    <input type="email" class="form-control" id="emailadmin" aria-describedby="emailHelp" placeholder="Enter email" class="form-control @error('emailadmin') is-invalid @enderror" name="emailadmin" value="{{ old('emailadmin') }}" required autocomplete="emailadmin" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="passadmin" placeholder="Password" class="form-control @error('passadmin') is-invalid @enderror" name="passadmin" value="{{ old('passadmin') }}" required autocomplete="passadmin" autofocus>
                </div>

                <div class="form-check" style="margin-top: -0.5em">
                    <input class="form-check-input" type="checkbox" value="" id="check_showpass">
                    <label class="form-check-label" for="check_showpass">
                        Show Password
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mgtop-1" id="LoginComm">Login</button>

                <div id="my-signin2" id="signGoogle" class="RegisterGoogle mgtop-1"></div>
            </form>
            <br>
            <span class="mgtop-2">didnt have community yet ?</span>
            <a href="/admin/register">Register Now</a>
            <br>
        </div> <!-- end-bagian kanan -->
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    $('#check_showpass').click(function () {
        $(this).is(':checked') ? $('#passadmin').attr('type', 'text') : $('#passadmin').attr('type', 'password');
    });

        // alert($(this).is(':checked'));
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