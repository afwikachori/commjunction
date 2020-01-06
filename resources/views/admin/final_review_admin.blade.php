@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="">
<img border="0"  src="/visual/left-arrow.png" id="left_backpay">
</a><a href="" class="clight backarrow1">Back to Payment</a>

<div class="contain-pay">
<div class="row">
<div class="col">
<h3 class="cgrey" lang="en">Verify</h3>
<small class="clight" data-lang-token="reviewadmin">Here we are, that is the last step you have seen. Please verify the data that 
have you complete.
</small>
<br>
<!-- <h6 style="margin-top: 1em; margin-bottom: 1em;" class="cgrey"> Personal Information</h6> -->

<div class="row" style="margin-top: 1em;">
<div class="col-5">
  <div class="form-group">
    <small class="clight2 mgb-05">Full Name</small>
    <h6 class="cgrey1">Afwika Chori</h6>
  </div>

  <div class="form-group">
    <small class="clight2 mgb-05">Address</small>
    <h6 class="cgrey1">Jl/ Singosari Batu malang </h6>
  </div>

  <div class="form-group">
    <small class="clight2 mgb-05">Email</small>
    <h6 class="cgrey1">afwikachori@gmail.com</h6>
  </div>
  
</div>
<div class="col-5">
<div class="form-group">
    <small class="clight2 mgb-05">Phone Number</small>
    <h6 class="cgrey1">0812312412444</h6>
</div>

<div class="form-group">
    <small class="clight2 mgb-05">Username</small>
    <h6 class="cgrey1">@afwika123</h6>
</div>

<div class="form-group">
  <small class="clight2 mgb-05">Password</small>
  <div class="row">
  <div class="col-9">
    <input type="password" id="password_admin_review" readonly class="form-control-plaintext cgrey1 h6" value="email@example.com">
  </div>
  <div class="col-2">
    <button type="button" id="btn_showpass_review" onclick="showPass()">
    <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
    </button>
  </div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-5">
 <div class="form-group">
    <small class="clight2 mgb-05">Community Name</small>
    <h6 class="cgrey1">Vespa Malang</h6>
</div>
 
</div>
<div class="col-5">
   <div class="form-group">
    <small class="clight2 mgb-05">Community Type</small>
    <h6 class="cgrey1">Otomotif</h6>
  </div>

</div>
</div>

<div class="row">
<div class="form-group col-10">
    <small class="clight2 mgb-05">Description Community</small>
    <h6 class="cgrey1 s13">How to change the text of a label using JavaScript ? Create a label element and assign an id to that element. Define a button that is used to call a function. It acts as a switch to change the text in the label element. Define a javaScript function, that will update the label text. Use the innerHTML property to change</h6>
</div>
</div>

</div>
<div class="col">
  <div class="row">
  <div class="col">
    <h5 class="cgrey">Selected Feature</h5>
  </div>
  <div class="col" style="text-align: right;">
    <h6 class="clight2 s14">3 Features Selected</h6>
  </div>
</div>
  
  <div class="scrollmenu">
    <div class="row">

<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>


<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>

<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>


<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>


<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>


<div class="col-3">
    <div class="card cardku" style="width: 7rem; height: 7.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 0.5em !important;">
  <div class="roundcheck2">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur"  value=""/>
    <label for="fitur"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="/visual/img-fitur-default.png" style="width: 40px;">
    <h6 class="cgrey"></h6>
    <small class="clight s11">dfgdfg</small>
  </center>
  <div style="text-align: center;">
  <a href="/admin/features_detail/">
    <small lang="en" class="txt_detail_fitur h6 s11"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>
</div> <!-- end-row -->
</div> <!-- end-scrollmenu -->

<h6 style="margin-top: 2.5em; margin-bottom: 1em;" class="cgrey"> Payment Information</h6>

<div class="row" style="margin-top: 1em;">
<div class="col-5">
  <div class="form-group">
    <small class="clight2 mgb-05">Payment Method</small>
    <h6 class="cgrey1">Bank Transfer</h6>
  </div>

  <div class="form-group">
    <small class="clight2 mgb-05">Pricing Time</small>
    <h6 class="cgrey1">Monthly</h6>
  </div>

   <div class="form-group">
    <small class="clight2 mgb-05">Preffered Price</small>
    <h6 class="cgrey1">20000000 / month</h6>
  </div>

  
</div>
<div class="col-5">
   <div class="form-group">
    <small class="clight2 mgb-05">Bank Name</small>
    <h6 class="cgrey1">BNI</h6>
  </div>

  <div class="form-group">
    <small class="clight2 mgb-05">Package</small>
    <h6 class="cgrey1">Premium</h6>
  </div>

  <div class="form-group">
    <small class="clight2 mgb-05">Package Description</small>
    <h6 class="cgrey1">Premium with cool features</h6>
  </div>
</div>
</div>


</div> <!-- end-col kanan -->
</div> <!-- end-contain -->


<div class="footer-admin">
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


});

function showPass() {
  var a = document.getElementById("password_admin_review");
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
