@extends('layout.app')

@section('content')
<div class="bg-page-forget">
<img src="/visual/rumput.png" class="rumput-kiri">
<img src="/visual/oval.png" class="oval-kanan">
<img src="/visual/otp_admin.png" class="otpimgbg">

<div class="contain-tiga">
	<a href="/admin/forgetpass_admin" style="color: white;">
		<img border="0"  src="/visual/left-arrow.png">
		 &nbsp;&nbsp; Take Me Back
	</a>
</div>


<center>
<div class="card col-6" id="card-forgetadmin2">
  <div class="card-body">
    <h4 class="cgrey" lang="en">OTP Verification</h4>


<form method="POST" id="form-otp-fogetpass" style="margin-top: 1em;" action="{{route('NewPass_admin')}}">
    {{ csrf_field() }}
 <small class="cgrey2" lang="en">Enter OTP Code Bellow</small>
<div class="digit-group" data-group-name="digits" style="margin-top: 0.5em;">
  <input type="text" id="digit-1" name="digit-1" data-next="digit-2" class="inputotp" autocomplete="off"/>
  <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" class="inputotp" autocomplete="off"/>
  <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" class="inputotp" autocomplete="off"/>
  <span class="splitter">&ndash;</span>
  <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" class="inputotp" autocomplete="off"/>
  <input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" class="inputotp" autocomplete="off"/>
  <input type="text" id="digit-6" name="digit-6" data-previous="digit-5" class="inputotp" autocomplete="off"/>
</div>

<div class="row" style="margin-top: 1.5em;">
<div class="col">
<div class="form-group" style="text-align: left;">
    <label for="newpass_admin" class="h6 cgrey2 s15" lang="en">New Password</label>
    <div class="input-group">
      <input class="form-control" id="newpass_admin" type="password" class="form-control @error('newpass_admin') is-invalid @enderror"
       name="newpass_admin" required aria-describedby="btn_showpaswot" autocomplete="off">
      <div class="input-group-append">
        <button class="btn btn-outline-light" type="button" id="btn_showpaswot" onclick="showPass()" style="border-color: #ced4da;">
      <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
        </button>
      </div>
    </div>
      <small id="pesan_passformat" lang="en" class="redhide">
          Mininum 8 character contain Numbers and Letters!</small>
  </div>
</div>

<div class="col">
 <div class="form-group" style="text-align: left;">
  <label for="confirm_newpass" class="h6 cgrey2 s15" lang="en">Confirm Password</label>
  <input type="password" class="form-control" id="confirm_newpass" class="form-control @error('confirm_newpass') is-invalid @enderror" name="confirm_newpass" required autocomplete="off">
<small id="pesan_passconfirm" lang="en" class="redhide">
         Password & Confirm Password didnt match!</small>
</div>
</div>
</div>



  <div class="row">
  <div class="col-8" style="text-align: left;">
    <h6 class="clight s15" style="margin-top: 1em;"><span lang="en">Didn't receive OTP code?</span>
    <a href="{{ url('/session_resendotp') }}" class="cteal2 h6 s15" lang="en">Resend OTP</a></h6>
  </div>

  <div class="col" style="text-align: right;">
   <button type="submit" class="btn btn-blue" style="width: 120px;" lang="en">
   Send</button>
    </div>
  </div>
</form>
  </div>
</div>
</center>


</div>

<div class="footer-admin">
<div class="row">
  <div class="col">
    <img src="/visual/commjuction.png" id="com_superadminlogin">
    <div class="textfooter-kiri">
    <a class="cgrey"><small>Privacy Police</small></a>
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


});


    $('#newpass_admin').on('keyup', function () {
        var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
        if (this.value == "") {
            $("#newpass_admin").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_passformat").hide();
        } else if (this.value.match(alpanumeric) && this.value.length >= 8) {
            $("#newpass_admin").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_passformat").hide();
        } else {
            $("#newpass_admin").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_passformat").show();
        }
    });


    $('#confirm_newpass').on('keyup', function () {
        var pass = $('#newpass_admin').val();
        if (this.value == "") {
            $("#confirm_newpass").removeClass("is-valid").removeClass("is-invalid");
            $("#pesan_passconfirm").hide();
        } else if (this.value == pass) {
            $("#confirm_newpass").removeClass("is-invalid").addClass("is-valid");
            $("#pesan_passconfirm").hide();
        } else {
            $("#confirm_newpass").removeClass("is-valid").addClass("is-invalid");
            $("#pesan_passconfirm").show();
        }
    });







 function showPass() {
  var a = document.getElementById("newpass_admin");
  var b = document.getElementById("ico-mata");
  if (a.type == "password") {
    a.type = "text";
    b.class = "fa fa-eye-slash";
  } else {
    a.type = "password";
    b.class = "fa fa-eye";
  }
}


$('.digit-group').find('input').each(function() {
  $(this).attr('maxlength', 1);
  $(this).on('keyup', function(e) {
    var parent = $($(this).parent());

    if(e.keyCode === 8 || e.keyCode === 37) {
      var prev = parent.find('input#' + $(this).data('previous'));

      if(prev.length) {
        $(prev).select();
      }
    } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
      var next = parent.find('input#' + $(this).data('next'));

      if(next.length) {
        $(next).select();
      } else {
        if(parent.data('autosubmit')) {
          parent.submit();
        }
      }
    }

    console.log($(this).val());
  });
});

</script>
@endsection
