@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Community Settings</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Community Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Payment Subscriber</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">

<div class="row">
  <div class="col-md-8">
  <h4 class="card-title">Setting Payment Subscriber</h4>  
  </div>
  <div class="col-md-4" style="text-align: right;">
    <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-rounded btn-fw">Add Button</button>
  </div>
</div>
<br>

<div class="paddig-10" style="padding-right: 10%; padding-left: 10%;">
<small class="cgrey2">Default</small>
<br>
<div class="row borderan-pay" style="margin-top: 0.5em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>

<br><br>

<small class="cgrey2">Other</small>
<br>
<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>


<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>


<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>



</div> <!-- div padding -->
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