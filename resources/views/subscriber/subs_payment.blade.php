@extends('layout.app')

@section('content')

  <div class="row">
    <div class="col biruq">
       <img src="/visual/commjuction.png" id="commjuction-regis1">
       <img src="/visual/regis1.png" class="vs-regis">
       <center>
       <h5 class="putih" lang="en" style="margin-left: 1.5em; margin-right: 1.5em; margin-top: 6em;">Some detailed information your community needs</h5>
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
        <nav class="navtab-subscriber">
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

            <a class="nav-item cus-a nav-link disabled" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="false" aria-disabled="disabled" lang="en">Personal Information</a>

            <a class="nav-item cus-a nav-link disabled" id="nav-community-tab" data-toggle="tab" href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="false" aria-disabled="disabled" lang="en">Community Information</a>

             <a class="nav-item cus-a nav-link active" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="true" lang="en">Payment</a>
          </div>
        </nav>

        <div class="container">
        	<h1>ini halaman payment</h1>
        </div>
      
      </div>
    </div>
 </div>
</div>
</div>

@endsection

@section('script')
<script type="text/javascript">


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


</script>


@endsection