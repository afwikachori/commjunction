@extends('layout.app')

@section('content')
<div class="bg-page-forget">
<img src="/visual/rumput.png" class="rumput-kiri">
<img src="/visual/forgetpass.png" class="forgetbgpic">

<div class="contain-tiga">
	<a href="/admin" style="color: white;">
		<img border="0"  src="/visual/left-arrow.png">
		 &nbsp;&nbsp; Take Me Back
	</a>
</div>


<center>
<div class="card col-5" id="card-forgetadmin">
  <div class="card-body">
    <h4 class="cgrey" lang="en">Forgot Password ?</h4>
    <small class="clight">Enter the email address assosiated with you account</small>
<br>

<form method="POST" id="form_forgetpass_admin" action="{{route('requestOTP')}}">{{ csrf_field() }}
  <div class="form-group" style="text-align: left; margin-top: 1em;">
    <label for="emailforget" class="h6 cgrey2 s15" lang="en">Email address</label>
    <input type="email" class="form-control" id="emailforgetadmin" class="form-control @error('emailforgetadmin') is-invalid @enderror" name="emailforgetadmin" value="{{ old('emailforgetadmin') }}" required autofocus>
  </div>
  <div class="row">
  <div class="col align-self-end" style="text-align: right;">
   <button type="submit" class="btn btn-oren" style="width: 120px;" lang="en">
   Send</button>
    </div>
  </div>
</form>

  </div>
</div>
</center>


</div>

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
