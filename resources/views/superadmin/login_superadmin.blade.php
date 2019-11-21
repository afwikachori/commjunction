@extends('layout.app')

@section('content')
<div class="container login-top2">
<div class="row">
    <div class="col"> <!-- kiri - layout -->
      <!-- 1 of 3 -->
    </div>
    <div class="col-lg-4"><!--  layout  -->
    	<center><img src="/pic/social.jpg" class="rounded-circle ico-superlogin">
<br><small>WELCOME TO</small>  <br>
	<h4 class="judullogin">COMMJUCTION</h4>
	<small>SUPER ADMIN</small>
	<br>
 <form class="form-login-super">
  <div class="form-group">
    <input type="email" class="form-control" id="username_superadmin" placeholder="Username or Email">
  </div>
  <div class="form-group">
  	<div class="row">
    <div class="col-10">
	<input type="password" class="form-control" id="pass_superadmin" placeholder="Password">
    </div>
    <div class="col-2">
    	<button type="button" class="btn btn-outline-secondary">a</button>
    </div>
  </div>
    
  </div>

  <div class="form-group form-check" style="margin-top: -0.5em">
    <input type="checkbox" class="form-check-input" id="showpass_superadmin">
    <label class="form-check-label" for="showpass_superadmin">Show Password</label>
  </div>

  <!-- <div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="customSwitch1">
  <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
</div> -->

  <button type="submit" class="btn btn-primary" id="loginSuper">Sign In</button>
</form>
<hr>
<span class="mgtop-2">didnt have community yet ?</span>
<a href="/superadmin/register">Register Now</a>
<br>
</center>
    </div> 
    <!-- end-tengah -->

    <div class="col"> <!-- kanan layout -->
      <!-- 3 of 3 -->
    </div>
  </div>
</div>



	

@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection
