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
    <div class="col-md-8">
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
                    <span lang="en" class="h6 cteal" lang="en">Already member?</span>
                    <a href="" class="h6" id="klik_login_subs" lang="en" data-lang-token="registernow">&nbsp;Sign In</a>
                </div>
            </div>
        </div>


        <div class="pdregis2">
            <div class="col-9 inforegis_subs">
                <h2 lang="en" style="color: #4F4F4F;" lang="en">Register</h3>
                    <label lang="en" class="clight2 s15" data-lang-token="info-regis1">Let’s us understand more about
                        you, please fill your information to continue, so you can using our app.</label>
            </div>

            <form method="POST" id="form_regispersonal_subs" action="{{route('registerSubscriber')}}">{{ csrf_field() }}
                <div class="row" id="form_regis_subs">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                <a class="nav-item cus-a nav-link active" id="nav-personal-tab" data-toggle="tab"
                                    href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true"
                                    lang="en" data-lang-token="Personal Information">Personal Information</a>

                                <a class="nav-item cus-a nav-link" id="nav-spesific-tab" data-toggle="tab"
                                    href="#nav-spesific" role="tab" aria-controls="nav-spesific" aria-selected="false"
                                    lang="en" data-lang-token="Spesific Information">Spesific Information</a>

                                <a class="nav-item cus-a nav-link" id="nav-community-tab" data-toggle="tab"
                                    href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="false"
                                    lang="en" data-lang-token="Community Information">Community Information</a>

                            </div>
                        </nav>

                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show registersubs active" id="nav-personal" role="tabpanel"
                                aria-labelledby="nav-personal-tab">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-2" style="text-align: right;">
                                        <small class="clight"><i lang="en">Step 1 / 2</i></small>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="fullname_subs" lang="en">
                                                    Full Name</label>

                                                <input id="fullname_subs" type="text"
                                                    class="form-control @error('fullname_subs') is-invalid @enderror"
                                                    name="fullname_subs" value="{{ old('fullname_subs') }}" required>
                                                <small lang="en" id="pesan_fullname" class="redhide">At least 3
                                                    character and Only Letters!</small>

                                                @if($errors->has('fullname_subs'))
                                                <small class="error_fullname" style="color: red;">
                                                    {{ $errors->first('fullname_subs')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="notlp_subs" lang="en">
                                                    Phone Number
                                                </label>

                                                <input id="notlp_subs" type="text"
                                                    class="form-control @error('notlp_subs') is-invalid @enderror"
                                                    name="notlp_subs" value="{{ old('notlp_subs') }}" required>
                                                <small id="pesan_phoneformat" class="redhide" lang="en">At least
                                                    contains 10 Numbers!</small>
                                                <small id="pesan_phone" class="redhide" lang="en">Number phone has
                                                    registered! Try another</small>
                                                @if($errors->has('notlp_subs'))
                                                <small class="error_phone" style="color: red;">
                                                    {{ $errors->first('notlp_subs')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="email_subs" class="h6 cgrey s14" lang="en">
                                                    Email Address</label>
                                                <input id="email_subs" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email_subs" value="{{ old('email_subs') }}" required
                                                    autocomplete="email_subs">
                                                <small id="pesan_formatemail" class="redhide" lang="en">Include '@' in
                                                    format email address!</small>
                                                <small id="pesan_email" class="redhide" lang="en">Email has been
                                                    registered! Try another</small>

                                                @if($errors->has('email_subs'))
                                                <small class="error_email"
                                                    style="color: red;">{{ $errors->first('email_subs')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="h6 cgrey s14" for="username_subs"
                                                    lang="en">Username</label>
                                                <input id="username_subs" type="text"
                                                    class="form-control @error('username_subs') is-invalid @enderror"
                                                    name="username_subs" value="{{ old('username_subs') }}" required>
                                                <small id="pesan_usernameformat" lang="en" class="redhide">Mininum 6
                                                    character contain Numbers and Letters!</small>
                                                <small id="pesan_username" lang="en" class="redhide">Username already
                                                    taken! Try another!</small>
                                                @if($errors->has('username_subs'))
                                                <small class="error_username" style="color: red;">
                                                    {{ $errors->first('username_subs')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
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
                                                <small id="pesan_passformat" lang="en" class="redhide">Mininum 8
                                                    character contain Numbers and Letters!</small>

                                                @if($errors->has('password_subs'))
                                                <small class="error_password"
                                                    style="color: red;">{{ $errors->first('password_subs')}}
                                                    Must
                                                    contain numbers and letters
                                                </small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="passconfirm_subs" class="h6 cgrey s14" lang="en">Confirm
                                                    Password</label>

                                                <input id="passconfirm_subs" type="password"
                                                    value="{{ old('passconfirm_subs') }}"
                                                    class="form-control @error('passconfirm_subs') is-invalid @enderror"
                                                    name="passconfirm_subs" required autocomplete="passconfirm_subs">
                                                <small id="pesan_passconfirm" lang="en" class="redhide">Password &
                                                    Confirm Password didnt match!</small>

                                                @if($errors->has('passconfirm_subs'))
                                                <small class="error_passconfirm"
                                                    style="color: red;">{{ $errors->first('passconfirm_subs')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display: none;">
                                        <div class="col">
                                            <input type="hidden" class="form-control" name="name_community"
                                                id="name_community">
                                            <div class="form-group row" style="display: none;">
                                                <label lang="en" class="h6 cgrey s14">Connect With</label>
                                                <br>
                                                <div id="my-signin3"></div>
                                                <input type="hidden" id="sso_type" name="sso_type" value="1">
                                                <input type="hidden" id="sso_token" name="sso_token">
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col">
                                            <div>
                                                <div class="form-group row" style="display: none;">
                                                    <label class="h6 clight s14" for="community_id">Id
                                                        Community</label>
                                                    <input type="hidden" readonly class="form-control-plaintext"
                                                        id="community_id" name="community_id">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <button type="button" class="btn btn-regissubs1" onclick="next_spesifik();"
                                            id="submit_personalsubs" lang="en">
                                            Next</button>
                                    </div>
                                </div> <!-- end-container -->
                            </div>

                            <div class="tab-pane fade" id="nav-spesific" role="tabpanel"
                                aria-labelledby="nav-spesific-tab">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-2" style="text-align: right;">
                                        <small class="clight"><i>Step 2 / 3</i></small>
                                    </div>
                                </div>

                                <div class="container" style="margin-top: 0.5em;">
                                    <div class="row" id="custom_input_regis">

                                    </div>
                                    <div class="row" style="margin-top: 1em;">
                                        <button type="button" class="btn btn-backregis1" lang="en"
                                            onclick="back_pesonal()">Go Back</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-regissubs1" lang="en"
                                            onclick="next_submit();">Next</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-community" role="tabpanel"
                                aria-labelledby="nav-community-tab">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-2" style="text-align: right;">
                                        <small class="clight"><i>Step 3 / 3</i></small>
                                    </div>
                                </div>

                                <div class="container" style="margin-top: 2em;">
                                    <div class="row">
                                        <div class="col-4">
                                            <center>
                                                <img src="/img/loading1.gif" id="icon_comm_subs"
                                                    class="rounded-circle img-fluid" style="width: 50%; height: auto;"
                                                    onerror="this.onerror=null;this.src='/visual/logo2.png';">
                                            </center>
                                        </div>

                                        <div class="col-8">
                                            <h3 class="display-4 s35" id="judul_comm_subs">-</h3>
                                            <p class="cgrey" id="deskripsi_comm">-</p>
                                        </div>
                                    </div> <!-- end-row -->

                                    <div class="row" style="margin-top: 2em;">
                                        <button type="button" class="btn btn-backregis1" lang="en"
                                            onclick="next_spesifik()">Go Back</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-regissubs1" lang="en"
                                            id="btn_ke_review">Next</button>
                                    </div>
                                </div> <!-- end-container -->

                            </div>
                        </div> <!-- tab content -->

                    </div>
                </div>

                <div id="review_regis_subs" style="display: none; margin-top: 1em;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Full Name</small>
                                <p class="cgrey2 tebal s13" id="review_fullname"></p>
                            </div>
                            <div class="form-group">
                                <small class="clight s13" lang="en">Email</small>
                                <p class="cgrey2 tebal s13" id="review_email"></p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Phone Number</small>
                                <p class="cgrey2 tebal s13" id="review_phone"></p>
                            </div>
                            <div class="form-group">
                                <small class="clight s13" lang="en">Username</small>
                                <p class="cgrey2 tebal s13" id="review_username"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Password</small>
                                <div class="row">
                                    <div class="col-7">
                                        <input type="password" id="review_password" readonly
                                            class="form-control-plaintext cgrey1 s13">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" id="btn_showpass_regis" onclick="showPassReview()">
                                            <span class="fa fa-eye" id="ico-mata" aria-hidden="true"
                                                style="color: grey;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="isi_review_custominput">

                    </div>



                    <div class="row" style="margin-top: 2em;">
                        <button type="button" class="btn btn-backregis1" lang="en" onclick="back_show_form()">Go
                            Back</button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-regissubs1" lang="en" id="btn_ke_submit">Finish</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL LOADING AJAX -->
<div class="modal fade modal_ajax" id="modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content loading">
            <div id="comjuction_loading">
                @include('loading')
            </div>
        </div>
    </div>
</div>

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


    function next_spesifik() {
        $("#nav-spesific-tab").trigger("click");
    }


    function back_pesonal() {
        $("#nav-personal-tab").trigger("click");
    }

    function back_show_form() {
        $("#review_regis_subs").hide();
        $("#nav-community-tab").trigger("click");
        $("#form_regis_subs").show();
    }

    $("#btn_ke_review").click(function () {
        $("#form_regis_subs").hide();
        $("#review_regis_subs").show();

        var fullname = $("#fullname_subs").val();
        var email = $("#email_subs").val();
        var username = $("#username_subs").val();
        var phone = $("#notlp_subs").val();
        var pass = $("#password_subs").val();

        $("#review_fullname").html(fullname);
        $("#review_email").html(email);
        $("#review_username").html(username);
        $("#review_phone").html(phone);
        $("#review_password").val(pass);


        var idinput = localStorage.getItem('idinput_custom');
        var parse = JSON.parse(idinput);
        var idcus = parse.split(',');


        $.each(idcus, function (i, item) {
            var li = '';
            var ceklah = item.substring(0, item.length - 1);
            if (ceklah == "radio") {
                var val = $("input[name='" + item + "']:checked").val();
            } else if (ceklah == "checkbox") {
                $("input[name='" + item + "[]']:checked").each(function (index, obj) {
                    li += '<li>' + $(this).val() + '</li>';
                });
                val = li;
            } else {
                var val = $("#" + item).val();
            }

            $("." + item).html(val);
        });


    });


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
                var result = result[0];
                console.log(result);
                if (result != "") {
                    $("#community_id").val(result.id);
                    $("#icon_comm_subs").attr("src", cdn + cekimage_cdn(result.logo));
                    $("#judul_comm_subs").html(result.name);

                    $("#klik_login_subs").attr("href", "/subscriber/url/" + result.name);
                    $("#deskripsi_comm").html(result.description);
                    $("#name_community").val(result.name);

                    if (result.registration_data.length != 0) {
                        get_custom_regis(result.registration_data);
                    } else {

                        $("#custom_input_regis").html('<center><br><br><br><h2 class="clight">No data custom input</h2></center>');
                        $("#isi_review_custominput").hide();

                    }

                }
            },
            error: function (result) {
                console.log("Cant Reach Session Logged User Dashboard");
            }
        });
    }




    function get_custom_regis(params) {
        var uihtml = '';
        var uireview = '';
        var idinput = '';

        $.each(params, function (no, des) {
            // console.log(des);
            var item = des.param_form_array;
            var inputipe = des.custom_input;

            var cusinput = '';
            var klasinput;

            if (inputipe.id == 1) {
                var pilihan = item.splice(3);
                var radio = '';
                $.each(pilihan, function (i, item) {
                    cusinput += '<div class="col-md-6">' +
                        '<div class="form-check">' +
                        '<small class="form-check-label">' +
                        '<input type="radio" class="form-check-input" name="radio' + no + '" id="radio' + no + i + '" value="' + item + '"> ' +
                        item + '<i class="input-helper"></i></small>' +
                        '</div></div>';
                });
                klasinput = "radio" + no;
            } else if (inputipe.id == 2) {
                cusinput = '<input id="number' + no + '" type="text"' +
                    'class="form-control" name="number' + no + '"' +
                    'onkeypress="return isNumberKey(event)"' +
                    'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';
                klasinput = "number" + no;
            } else if (inputipe.id == 3) {
                cusinput = '<input id="text' + no + '" type="text"' +
                    'class="form-control" name="text' + no + '"' +
                    'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';
                klasinput = "text" + no;
            } else if (inputipe.id == 4) {
                cusinput = '<textarea id="textarea' + no + '" rows="2"' +
                    'class="form-control" name="textarea' + no + '"></textarea >';
                klasinput = "textarea" + no;
            } else if (inputipe.id == 5) {
                cusinput = '<input id="date' + no + '" type="date"' +
                    'class="form-control" name="date' + no + '"' +
                    'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';
                klasinput = "date" + no;
            }
            else if (inputipe.id == 6) {
                var list = item.splice(3);
                $.each(list, function (i, item) {
                    cusinput += '<div class="form-check col-md-6">' +
                        '<input class="form-check-input" type="checkbox" name="checkbox' + no + '[]" value="' + item + '" id="checkbox' + i + '">' +
                        '<small class="form-check-label" for="checkbox' + no + '">' + item +
                        '</small>' +
                        '</div>';
                });
                klasinput = "checkbox" + no;
            } else if (inputipe.id == 7) {
                var pilihan = item.splice(2);
                var dropdown = '';
                $.each(pilihan, function (i, item) {
                    dropdown += '<option value="' + item + '">' + item + '</option>';
                });
                cusinput = '<select class="form-control fullwidth" name="dropdown' + no + '" id="dropdown' + no + '">' + dropdown + '</select>';
                klasinput = "dropdown" + no;
            }

            idinput += klasinput + ',';

            uihtml += '<div class="col-md-5">' +
                '<div class="form-group row">' +
                '<input type="hidden" name="id_' + no + '" value="' + des.id + '">' +
                '<label class="h6 cgrey s14" for="input' + no + '" lang="en">' + item[0] + '</label>' +
                '&nbsp; &nbsp;<small class="ctosca"> (' + inputipe.title + ') &nbsp; </small><br>' +
                '<small class="clight">' + des.description + '</small><br>' +
                cusinput +
                '</div>' +
                '</div>' +
                '<div class="col-1"></div>';

            uireview += '<div class="col-md-4">' +
                '<div class="form-group">' +
                '<span class="clight s13" lang="en">' + des.title + '</span> &nbsp; <br> ' +
                '<span class="cgrey2 tebal s13 ' + klasinput + '"></span>' +
                '</div>' +
                '</div>';

        });


        idinput = JSON.stringify(idinput.substring(0, idinput.length - 1));
        localStorage.setItem('idinput_custom', idinput);


        $("#custom_input_regis").html(uihtml);
        $("#isi_review_custominput").html(uireview);

    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }


    // function onSignIn(googleUser) {
    //     var profile = googleUser.getBasicProfile();
    //     var id_token = googleUser.getAuthResponse().id_token;

    //     // console.log('ID: ' + profile.getId());
    //     // console.log('Name: ' + profile.getName());
    //     // console.log('Image URL: ' + profile.getImageUrl());
    //     // console.log('Email: ' + profile.getEmail());
    //     // console.log('id_token: '+id_token);


    //     var isinama = profile.getName();
    //     var isiemail = profile.getEmail();

    //     $("#fullname_subs").val(isinama);
    //     $("#email_subs").val(isiemail);
    //     $("#sso_type").val(2);
    //     $("#sso_token").val(id_token);
    // }

    // function onSuccess(googleUser) {
    //     console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    //     onSignIn(googleUser);
    // }

    // function onFailure(error) {
    //     console.log(error);
    // }

    // function renderButton() {
    //     gapi.signin2.render('my-signin3', {
    //         'scope': 'profile email',
    //         'width': 150,
    //         'height': 38,
    //         'longtitle': true,
    //         'theme': 'dark',
    //         'onsuccess': onSuccess,
    //         'onfailure': onFailure
    //     });
    // }

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

    function showPassReview() {
        var a = document.getElementById("review_password");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }

    $('#fullname_subs').on('keyup', function () {
        var letters = /^[a-zA-Z\s]*$/;
        if (this.value == "") {
            $("#fullname_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_fullname").hide();
            $(".error_fullname").hide();
        } else if (this.value.match(letters) && this.value.length >= 3) {
            $("#fullname_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_fullname").hide();
            $(".error_fullname").hide();
        } else {
            $("#pesan_fullname").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_fullname").show();
            $(".error_fullname").hide();
        }
    });

    $('#email_subs').on('keyup', function () {
        if (this.value == "") {
            $("#email_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_formatemail").hide();
            $("#pesan_email").hide();
            $(".error_email").hide();
        } else if (IsEmail(this.value)) {
            $("#email_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_formatemail").hide();
            $("#pesan_email").hide();
            $(".error_email").hide();
            cek_valid_email_subs(this.value); //cek ajax to backend
        } else { //if tidak seseuai format email
            $("#email_subs").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_formatemail").show();
            $("#pesan_email").hide();
            $(".error_email").hide();
        }
    });

    function cek_valid_email_subs(input) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cek_valid_email_subs',
            data: {
                'email': input,
                'community_id': $("#community_id").val()
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result.success == false) {
                    $("#email_subs").removeClass("is-valid").addClass("is-invalid");
                    $("#pesan_formatemail").hide();
                    $("#pesan_email").show();
                    $(".error_email").hide();

                } else {
                    $("#email_subs").removeClass("is-invalid").addClass("is-valid");
                    $("#pesan_formatemail").hide();
                    $("#pesan_email").hide();
                    $(".error_email").hide();
                }
            },
            error: function (result) {
                console.log("Cant Get Check Email");
                console.log(result);
            }
        });

    }

    $('#notlp_subs').on('keyup', function () {

        if (this.value == "") {
            $("#notlp_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_phoneformat").hide();
            $("#pesan_phone").hide();
            $(".error_phone").hide();
        } else if (!isNaN(this.value) && this.value.length >= 10) {
            $("#notlp_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_phoneformat").hide();
            $("#pesan_phone").hide();
            $(".error_phone").hide();
            cek_valid_phone_subs(this.value); //cek ajax to backend
        } else {
            $("#notlp_subs").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_phoneformat").show();
            $("#pesan_phone").hide();
            $(".error_phone").hide();
        }
    });

    function cek_valid_phone_subs(input) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cek_valid_phone_subs',
            data: {
                'notelp': input,
                'community_id': $("#community_id").val()
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    $("#notlp_subs").removeClass("is-invalid").addClass("is-valid");
                    $("#pesan_phoneformat").hide();
                    $("#pesan_phone").hide();
                    $(".error_phone").hide();
                } else {
                    $("#notlp_subs").removeClass("is-valid").addClass("is-invalid");
                    $("#pesan_phoneformat").hide();
                    $("#pesan_phone").show();
                    $(".error_phone").hide();
                }
            },
            error: function (result) {
                console.log("Cant Check Phone Number");
                console.log(result);
            }
        });

    }

    $('#username_subs').on('keyup', function () {
        var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/;
        if (this.value == "") {
            $("#username_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_usernameformat").hide();
            $("#pesan_username").hide();
            $(".error_username").hide();
        } else if (this.value.match(alpanumeric) && this.value.length >= 6) {
            $("#username_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_usernameformat").hide();
            $("#pesan_username").hide();
            $(".error_username").hide();
            cek_valid_username_subs(this.value); //cek ajax to backend
        } else {
            $("#username_subs").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_usernameformat").show();
            $("#pesan_username").hide();
            $(".error_username").hide();
        }
    });

    function cek_valid_username_subs(input) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cek_valid_username_subs',
            data: {
                'user_name': input,
                'community_id': $("#community_id").val()
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    $("#username_subs").removeClass("is-invalid").addClass("is-valid");
                    $("#pesan_usernameformat").hide();
                    $("#pesan_username").hide();
                    $(".error_username").hide();
                } else {
                    $("#username_subs").removeClass("is-valid").addClass("is-invalid");
                    $("#pesan_usernameformat").hide();
                    $("#pesan_username").show();
                    $(".error_username").hide();
                }
            },
            error: function (result) {
                console.log("Cant not check unique username");

            }
        });

    }


    $('#password_subs').on('keyup', function () {
        var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
        if (this.value == "") {
            $("#password_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_passformat").hide();
            $(".error_password").hide();
        } else if (this.value.match(alpanumeric) && this.value.length >= 8) {
            $("#password_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_passformat").hide();
            $(".error_password").hide();
        } else {
            $("#password_subs").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_passformat").show();
            $(".error_password").hide();
        }
    });


    $('#passconfirm_subs').on('keyup', function () {
        var pass = $('#password_subs').val();
        if (this.value == "") {
            $("#passconfirm_subs").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_passconfirm").hide();
            $(".error_passconfirm").hide();
        } else if (this.value == pass) {
            $("#passconfirm_subs").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_passconfirm").hide();
            $(".error_passconfirm").hide();
        } else {
            $("#passconfirm_subs").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_passconfirm").show();
            $(".error_passconfirm").hide();
        }
    });


    let currForm1 = document.getElementById('form_regispersonal_subs');
    currForm1.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener(('input'), () => {
            if (input.checkValidity()) {
                input.classList.remove('is-invalid')
                input.classList.add('is-valid');
                $("#submit_personalsubs").attr("disabled", false);
            } else {
                input.classList.remove('is-valid')
                input.classList.add('is-invalid');
            }
            // var is_valid = $('.form-control').length === $('.form-control.is-valid').length;
            var is_valid = 6 === $('.form-control.is-valid').length;
            $("#submit_personalsubs").attr("disabled", !is_valid);
            // console.log($('.form-control.is-valid').length +" ___________ "+  $('.form-control').length);
        });
    });

</script>
@endsection
