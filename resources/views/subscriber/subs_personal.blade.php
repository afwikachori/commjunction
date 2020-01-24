@extends('layout.app')

@section('content')
  <div class="row">
    <div class="col biruq">
       <img src="/visual/commjuction.png" id="commjuction-regis1">
       <img src="/visual/loginadmin.png" class="vs-regis1">
       <center>
       <h5 class="putih" lang="en" style="margin-left: 1.5em; margin-right: 1.5em; margin-top: 6em;">Let us understand more about you</h5>
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
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

            <a class="nav-item cus-a nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true" lang="en">Personal Information</a>

            <a class="nav-item cus-a nav-link" id="nav-community-tab" data-toggle="tab" href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="false" lang="en">Community Information</a>

          </div>
        </nav>

      <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
           @include('subscriber.isi_subs_personal')
        </div>
        
        <div class="tab-pane fade" id="nav-community" role="tabpanel" aria-labelledby="nav-community-tab">
            @include('subscriber.isi_subs_community')
        </div>
          
        </div>
      
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
var server = '{{ env('SERVICE') }}';

$(document).ready(function () {
  // swal(server);
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



$('#auth_url').keypress(function(event){
  var isi = $('#auth_url').val();
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
  $("#submit_personalsubs").attr("disabled", true);
  auth_url_subs(isi);
  
  }

});



function auth_url_subs(val){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      url: '/url_subscriber',
      data: {'name': val},
      type: 'POST',
      datatype: 'JSON',
      beforeSend: function(){
        $('#mdl-loadingajax').modal('show');
      },
      success: function (result) {
      var dt = result.data;

      $("#community_id").val(dt.id);
      $("#judul_comm_subs").html(dt.name);
      $("#deskrip_com_subs").text(dt.description);
      $("#icon_comm_subs").attr("src", server+dt.logo);

      },
      error: function (result) {
       console.log("Cant get data from url subscriber");
      }, 
      complete: function(result){
         $('#mdl-loadingajax').modal('hide');
         $("#submit_personalsubs").removeAttr("disabled");
      }
      });

}


</script>
@endsection