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


      <div class="pdregis1">
      <div class="textregisinfo">
        <h3 lang="en" style="color: #4F4F4F; margin-right: -0.5em;">Register</h3>
        <label lang="en" class="clight s15" data-lang-token="info-regis1">Let’s us understand more about you, please fill your information to continue,  so you can using our app.</label>
      </div>

        <div class="row">
      <div class="col-xs-12 ">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item cus-a nav-link active" id="nav-community-tab" data-toggle="tab" href="#nav-community" role="tab" aria-controls="nav-community" aria-selected="true" lang="en">Community Information</a>
            <a class="nav-item cus-a nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="false" lang="en">Personal Information</a>
          </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-community" role="tabpanel" aria-labelledby="nav-community-tab">
            @include('admin.register')
          </div>
          <div class="tab-pane fade" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
           @include('admin.register2')
          </div>
        </div>
      
      </div>
    </div>
 </div>
</div>
</div>
<!-- <h1>welcome SSO </h1><br>
<a href="" onclick="signOut();">Sign out</a> -->

@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {

});


</script>

@endsection