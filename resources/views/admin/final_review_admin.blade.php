@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="">
<img border="0"  src="/visual/left-arrow.png" id="left_backpay">
</a><a href="" class="clight backarrow">Back to Payment</a>

<div class="contain-pay">
<div class="row">
<div class="col">
<h3 class="cgrey" lang="en">Verify</h3>
<small class="clight" data-lang-token="reviewadmin">Here we are, that is the last step you have seen. Please verify the data that 
have you complete.
</small>

<h5 style="margin-top: 1em;"> Personal Information</h5>

</div>
<div class="col">
  
</div>
</div>
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


</script>
@endsection
