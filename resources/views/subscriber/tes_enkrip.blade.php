@extends('layout.app')
@section('title', 'Subscriber')
@section('content')


<div class="row">
    <div class="col-sm biruq">

        <div class="container subs_judul">

        </div>

        <img src="/visual/loginadmin.png" id="login-img-subs">

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
            <span lang="en" class="h6 cteal">Didn't have account yet ?</span>
            <a href="/subscriber/register" class="h6" id="subsregisklik" lang="en"
                data-lang-token="registernow">Register Now</a>
        </div>

        <div class="container pdsubslogin">
            <h2 lang="en" style="color: #4F4F4F;" lang="en">TES ENKRIP</h2>
            <label lang="en" class="cgrey textlogin" lang="en">Please login to continue</label>

            <!-- login  Form -->
            <form method="POST" id="form_login_admin" action="{{route('tes_enkrip')}}">

                {{ csrf_field() }}
                <label class="h6 cgrey">Community Id</label>
                <input type="text" class="form-control" value="" name="id_community">
                <br>
                <label class="h6 cgrey">Username</label>
                <input type="text" class="form-control" value="" name="input_login">
                <br>
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

<br>
                <div class="form-group mb-3">
                    <button lang="en" type="submit" class="btn btn-primary" id="LoginSubscriber"
                        lang="en">Login</button>
                </div>


            </form>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">

    $(document).ready(function () {

    });

    function showPass() {
        var a = document.getElementById("pass_subs");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }


</script>

@endsection
