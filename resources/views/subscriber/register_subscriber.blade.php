@extends('layout.app')

@section('content')

@if (session()->has('register_sukses'))
<script>
    setTimeout(function () {
        window.location.href = "{{ session()->get('register_sukses') }}";
    }, 5000); //will call the function after 2 secs.
</script>
@endif

<div class="row">
    <div class="col biruq">
        <img src="/visual/commjuction.png" id="commjuction-regis1">
        <img src="/visual/loginadmin.png" class="vs-regis1">
        <center>
            <h5 class="putih" lang="en" style="margin-left: 1.5em; margin-right: 1.5em; margin-top: 6em;">Let us
                understand more about you</h5>
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
                    <a href="" class="h6" id="klik_login_subs" lang="en" data-lang-token="registernow">&nbsp;Sign In</a>
                </div>
            </div>
        </div>


        <div class="pdregis2">
            <div class="col-9 inforegis_subs">
                <h2 lang="en" style="color: #4F4F4F;">Register</h3>
                    <label lang="en" class="clight s15" data-lang-token="info-regis1">Let’s us understand more about
                        you, please fill your information to continue,  so you can using our app.</label>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                            <a class="nav-item cus-a nav-link active" id="nav-personal-tab" data-toggle="tab"
                                href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true"
                                lang="en">Personal Information</a>

                            <a class="nav-item cus-a nav-link" id="nav-community-tab" data-toggle="tab"
                                href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="false"
                                lang="en">Community Information</a>

                        </div>
                    </nav>

                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <form method="POST" id="form_regispersonal_subs"
                        action="{{route('registerSubscriber')}}">
                            {{ csrf_field() }}
                            <div class="tab-pane fade show active" id="nav-personal" role="tabpanel"
                                aria-labelledby="nav-personal-tab">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-2" style="text-align: right;">
                                        <small class="clight"><i>Step 1 / 2</i></small>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" class="form-control" name="name_community"
                                                id="name_community">
                                            <div class="form-group row">
                                                <label lang="en" class="h6 cgrey s14">Connect With</label>
                                                <br>
                                                <div id="my-signin3"></div>
                                                <input type="hidden" id="sso_type" name="sso_type" value="1">
                                                <input type="hidden" id="sso_token" name="sso_token">
                                            </div>

                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="fullname_subs" lang="en">Full
                                                    Name</label>

                                                <input id="fullname_subs" type="text"
                                                    class="form-control @error('fullname_subs') is-invalid @enderror"
                                                    name="fullname_subs" value="{{ old('fullname_subs') }}" required>
                                                <small id="pesan_name1" class="redhide" lang="en">At least 3
                                                    character!</small>

                                                @if($errors->has('fullname_subs'))
                                                <small class="error_name1" style="color: red;">
                                                    {{ $errors->first('fullname_subs')}}</small>
                                                @endif
                                            </div>

                                            <div class="form-group row">
                                                <label for="email_subs" class="h6 cgrey s14" lang="en">Email
                                                    Address</label>
                                                <input id="email_subs" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email_subs" value="{{ old('email_subs') }}" required
                                                    autocomplete="email_subs"><small id="pesan_emailadmin"
                                                    class="redhide" lang="en">Include '@' in format email
                                                    address!</small>
                                                <small id="pesan_emailsubs" class="redhide" lang="en">Email has been
                                                    registered! Try another</small>
                                                @if($errors->has('email_subs'))
                                                <small class="error_emailsubs"
                                                    style="color: red;">{{ $errors->first('email_subs')}}</small>
                                                @endif
                                            </div>

                                            <div class="form-group row">
                                                <label for="password_subs" class="h6 cgrey s14"
                                                    lang="en">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="password_subs" type="password"
                                                        value="{{ old('password_subs') }}"
                                                        class="form-control @error('password_subs') is-invalid @enderror"
                                                        name="password_subs" required autocomplete="password_subs"
                                                        aria-describedby="btn_showpass">

                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-light" type="button"
                                                            id="btn_showpass" onclick="showPass()"
                                                            style="border-color: #ced4da;">
                                                            <span class="fa fa-eye" id="ico-mata" aria-hidden="true"
                                                                style="color: grey;"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <small id="pesan_passwordsubs" lang="en" class="redhide">Mininum 8
                                                    character contain Numbers and Letters!</small>
                                                @if($errors->has('password_subs'))
                                                <small class="error_passwordsubs"
                                                    style="color: red;">{{ $errors->first('password_subs')}} Must
                                                    contain numbers and letters
                                                </small>
                                                @endif
                                            </div>


                                        </div> <!-- end-col kiri -->
                                        <div class="col-1"></div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="h6 clight s14" for="community_id" lang="en">Id
                                                    Community</label>
                                                <input type="text" readonly class="form-control-plaintext"
                                                    id="community_id" name="community_id">
                                            </div>

                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="notlp_subs" lang="en">
                                                    Phone Number
                                                </label>

                                                <input id="notlp_subs" type="text"
                                                    class="form-control @error('notlp_subs') is-invalid @enderror"
                                                    name="notlp_subs" value="{{ old('notlp_subs') }}" required>
                                                <small id="pesan_notlpsubs" class="redhide" lang="en">At least 3
                                                    character!</small>

                                                @if($errors->has('notlp_subs'))
                                                <small class="error_notlpsubs" style="color: red;">
                                                    {{ $errors->first('notlp_subs')}}</small>
                                                @endif
                                            </div>

                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="username_subs"
                                                    lang="en">Username</label>

                                                <input id="username_subs" type="text"
                                                    class="form-control @error('username_subs') is-invalid @enderror"
                                                    name="username_subs" value="{{ old('username_subs') }}" required>
                                                <small id="pesan_usernamesubs" class="redhide" lang="en">At least 3
                                                    character!</small>

                                                @if($errors->has('username_subs'))
                                                <small class="error_usernamesubs" style="color: red;">
                                                    {{ $errors->first('username_subs')}}</small>
                                                @endif
                                            </div>

                                            <div class="form-group row">
                                                <label for="passconfirm_subs" class="h6 cgrey s14" lang="en">Confirm
                                                    Password</label>

                                                <input id="passconfirm_subs" type="password"
                                                    value="{{ old('passconfirm_subs') }}"
                                                    class="form-control @error('passconfirm_subs') is-invalid @enderror"
                                                    name="passconfirm_subs" required autocomplete="passconfirm_subs">

                                                <small id="pesan_passconfirmsubs" lang="en" class="redhide">Password &
                                                    Confirm Password didnt match!</small>
                                                @if($errors->has('passconfirm_subs'))
                                                <small class="error_passconfirmsubs"
                                                    style="color: red;">{{ $errors->first('passconfirm_subs')}}</small>
                                                @endif
                                            </div>

                                        </div> <!-- end-col kanan -->
                                    </div> <!-- end-row -->

                                    <div class="form-group row">

                                        <button type="button" class="btn btn-regissubs1" onclick="next_submit();"
                                            id="submit_personalsubs" lang="en">
                                            Next</button>
                                    </div>
                                </div> <!-- end-container -->
                            </div>

                            <div class="tab-pane fade" id="nav-community" role="tabpanel"
                                aria-labelledby="nav-community-tab">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-2" style="text-align: right;">
                                        <small class="clight"><i>Step 2 / 2</i></small>
                                    </div>
                                </div>

                                <div class="container" style="margin-top: 2em;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <img src="" id="icon_comm_subs" class="rounded-circle img-fluid"
                                                    style="width: 70%; height: auto;">
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <h3 class="display-4 s35" id="judul_comm_subs">
                                                Vespa Lovers Malang</h3>
                                            <p class="cgrey" id="deskripsi_comm">
                                                Lorem ipsum dolor sit amet
                                                Consectetur adipiscing elit
                                                Integer molestie lorem at massa
                                                Facilisis in pretium nisl aliquet
                                                Nulla volutpat aliquam velit
                                            </p>
                                        </div>
                                    </div> <!-- end-row -->

                                    <div class="row" style="margin-top: 2em;">
                                        <button type="button" class="btn btn-backregis1" lang="en">Go Back</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn-regissubs1" lang="en">Finish</button>
                                    </div>
                                </div> <!-- end-container -->

                            </div>
                        </form>
                    </div> <!-- tab content -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL LOADING AJAX -->
<div class="modal fade bd-example-modal-sm" id="mdl-loadingajax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content loading">
            <center>
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="h6 iniloading">Loading . . .</p>
                <center>
        </div>
    </div>
</div>
<!-- END-MODAL -->

@section('script')
<script type="text/javascript">
    var server = '{{ env("SERVICE") }}';
    var cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        ses_auth_subs(); //custom-validation.js
    });

    function next_submit() {
        $("#nav-community-tab").trigger("click");
    }

    // SESSION LOGIN SUBSVRIBER
    function ses_auth_subs() {
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
                if (result != "") {
                    $("#community_id").val(result.id);
                    $("#icon_comm_subs").attr("src", cdn + result.logo);
                    $("#judul_comm_subs").html(result.name);

                    $("#klik_login_subs").attr("href", "/subscriber/url/" + result.name);
                    $("#deskripsi_comm").html(result.description);
                    $("#name_community").val(result.name);

                }
            },
            error: function (result) {
                console.log("Cant Reach Session Logged User Dashboard");
            }
        });
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
        var a = document.getElementById("password_subs");
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
