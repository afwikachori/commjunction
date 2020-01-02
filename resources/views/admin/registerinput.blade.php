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
    <a class="nav-item nav-link homeq active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Community Information</a>
    <a class="nav-item nav-link profileq" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Personal Information</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">@include('admin.register')
  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  @include('admin.register2')
</div>
</div>

    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
$(document).ready(function () {

get_jenis();
});

function backregis(){
  // alert('kilk tab');
$("#nav-home-tab").trigger('click');
$("#nav-profile-tab").removeClass("active");
$("#nav-home-tab").addClass("active");

}



function get_session1(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_regisOne',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
    $("#name_com").val(result.name); 
    $("#descrip_com").val(result.description); 
    $('select[name="type_com"]').val(result.jenis_comm_id);
    $('#range_member').val(result.range_member).attr("selected", "selected");
    if(result.name != undefined){
    $("#iconcom_view").attr('src','http://21.0.0.108:2312'+result.logo).show();
    $(".custom-file-label").html("YOUR ICON COMMUNITY");
    }
    
    $("#icon_com").removeAttr( 'required' );

    if(result.jenis_comm_id == 1){
        $("#other_type_com").val(result.cust_jenis_comm); 
        $('.other_type_com').show();
        $('#type_com').hide();
    }else{
        $('.other_type_com').hide();
        $('#type_com').show();
    }
      },
      error: function (result) {
        console.log("Cant Reach Session Register One");
    }
});
}



var _URL = window.URL || window.webkitURL; // image dimension

// other - dropdown jenis community 
    $("#type_com").change(function () {
        var pilih = $('#type_com :selected').val();

        if (pilih == "1") {
            $('.other_type_com').show();
            $('#type_com').hide();
        } else {
            $('.other_type_com').hide();
            $('#type_com').show();
        }
    });

// end- other dropdown jenis community


//dropdown get jenis komunitas
function get_jenis() {       
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_jenis_com",
    type: "POST",
    dataType: "json",
    success: function (status, code, data) {
    // console.log(status.data);

    if (status.code== '00') {
      var data = status.data; 

      $('#type_com').empty();
      $('#type_com').append("<option disabled> --- </option>");

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_com').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
      } 
      //Short Function Ascending//
      $("#type_com").html($('#type_com option').sort(function (x, y) {
        return $(x).val() < $(y).val() ? -1 : 1;
      }));

      $("#type_com").get(0).selectedIndex = 0; //e.preventDefault();
    }
     const OldValue = '{{old('type_com')}}';
    
    if(OldValue !== '') {
      $('#type_com').val(OldValue);
    }

    // sess_regis1(); //session-back
    get_session1();
    }
});
} //endfunction


$('#icon_com').on('change', function () {
// cari function custom-validation.js
filenameImg(this);
previewImg(this);
dimensionImg(this);

 }) //end-onchange img


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