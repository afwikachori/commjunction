@extends('layout.app')

@section('content')
<div id="bg-superadmin">
    <div class="row">
        <div class="col-11"></div>
        <div class="col" style="margin-top: 0.5em;">
            <a href="" class="langimg" onclick="window.lang.change('en'); return false;">
                <img border="0" src="/img/en.png" width="30" height="30">
            </a>
            <a href="" class="langimg" onclick="window.lang.change('id'); return false;">
                <img border="0" src="/img/id.png" width="30" height="30">
            </a>
        </div>
    </div>

    <img src="/visual/rumput.png" id="rumput_superadmin">
    <img src="/visual/oramen1.png" id="oramen_loginsuper">

    <div class="container">

        <div class="container login-top2">
            <div class="row">
                <div class="col">
                    <!-- kiri - layout -->
                    <!-- 1 of 3 -->
                </div>
                <div class="col-lg-4">
                    <!--  layout  -->
                    <center>
                        <img src="/visual/logo.png" id="logologinsuperadmin">

                        <h3 class="judullogin">Login</h3>
                        <p class="h6">Welcome to Commjuction Admin Area</p>
                    </center>

                    <form class="form-login-super" method="POST" id="form_registerfirst_admin"
                        action="{{route('loginSuperadmin')}}" enctype="multipart/form-data">{{ csrf_field() }}
                        <div class="form-group ">
                            <label for="username_superadmin" class="h6 s14" lang="en">Username</label>
                            <input type="text" name="username_superadmin" class="form-control" id="username_superadmin"
                                placeholder="Username" lang="en">
                        </div>

                        <div class="form-group  mgtop-1">
                            <label for="pass_superadmin" class="h6 s14" lang="en">Password</label>
                            <div class="input-group">
                                <input class="form-control" id="pass_superadmin" type="password" placeholder="Password"
                                    lang="en" value="{{ old('pass_superadmin') }}"
                                    class="form-control @error('pass_superadmin') is-invalid @enderror"
                                    name="pass_superadmin" required autocomplete="pass_superadmin"
                                    aria-describedby="btn_showpasssuper">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-light" type="button" id="btn_showpasssuper"
                                        onclick="showPassSuper()" style="border-color: #ced4da;">
                                        <span class="fa fa-eye" id="ico-mata-superadmin" aria-hidden="true"
                                            style="color: #cbe5ff;"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme_superadmin" onclick="remember_me_superadmin()">
                                    <label class="form-check-label cteal" for="gridCheck" style="color: rgba(255, 255, 255, 0.75);" lang="en">Remember
                                        me</label>
                                </div>
                            </div>

                            <div class="col" style="text-align: right;">
                                <label><a href="" style="color: rgba(255, 255, 255, 0.75);" lang="en">Forgot
                                        password?</a></label>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary" id="loginSuper" lang="en">Sign In</button>
                        </center>
                    </form>

                </div>
                <!-- end-tengah -->

                <div class="col">
                    <!-- kanan layout -->
                    <!-- 3 of 3 -->
                </div>
            </div>
        </div>


    </div>
</div> <!-- end-bg -->

<div class="footer-superadmin">
    <div class="row" style="margin-top: 1em;">
        <div class="col">
            <img src="/visual/commjuction.png" id="com_superadminlogin">
            <div class="textfooter-kiri">
                <a href="" class="cgrey"><small>Privacy Police</small></a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="" class="cgrey"><small>Terms and Condition</small></a>
            </div>
        </div>

        <div class="col textfooter-kanan">
            <a href="" class="cgrey h6 s13">Documentation</a>
            <span class="fa fa-circle" aria-hidden="true" style="color: #D96120;"></span>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="" class="cgrey h6 s13">Support</a>
            <span class="fa fa-question" aria-hidden="true" style="color: #D96120;"></span>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        checking_remember_superadmin();

    });


    function showPassSuper() {
        var a = document.getElementById("pass_superadmin");
        var b = document.getElementById("ico-mata");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }


    function remember_me_superadmin() {
        // alert('ceked');
        var checkBox = document.getElementById("rememberme_superadmin");

        if (checkBox.checked == true) {
            var username = $('#username_superadmin').val();
            var password = $('#pass_superadmin').val();

            $.cookie('useradmin', username, { expires: 30 });
            $.cookie('passadmin', password, { expires: 30 });
            $.cookie('rememberme_superadmin', true, { expires: 30 });
        }
        else {
            $.cookie('useradmin', null);
            $.cookie('passadmin', null);
            $.cookie('remember', null);
        }
    }



    function checking_remember_superadmin() {
        var remember = $.cookie("rememberme_superadmin");
        if (remember == 'true') {
            var username = $.cookie('useradmin');
            var password = $.cookie('passadmin');
            if (username != null && password != null) {

                $('#username_superadmin').val(username);
                $('#pass_superadmin').val(password);
                $('#rememberme_superadmin').attr("checked", "checked");
            } else {
                $('#username_superadmin').val("");
                $('#pass_superadmin').val("");
                $('#rememberme_superadmin').removeAttr("checked", "checked");
            }
        } else {
            $('#username_superadmin').val("");
            $('#pass_superadmin').val("");
            $('#rememberme_superadmin').removeAttr("checked", "checked");
        }
    }

</script>
@endsection
