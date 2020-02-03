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
                  <li class="breadcrumb-item active" aria-current="page">Login & Registrasion</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Setting Login & Registrasion</h4>

    <br><br>
    <form method="POST" id="form_setting_loginregis" action="{{route('setting_loginresgis_comm')}}" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
      <!-- <h6 class="cgrey2">Login Type for Subscriber</h6> -->
           <h6 class="cgrey2 s14">Form Type Subscriber Login</h6>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="" value="1"> Username & Password <i class="input-helper"></i>
            </label>
            </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="" value="2"> Phone Number & Password <i class="input-helper"></i>
            </label>
            </div>

        <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="" value="3"> Email & Password <i class="input-helper"></i>
            </label>
            </div>
      </div>

     <hr style="margin-top: 2em;">
      <h6 class="text-primary"><i>yourdomain</i>
        &nbsp;
        <b class="cgrey">@smartcomm.id</b></h6>
      <br>
      <div class="row">
        <div class="col-md-8 form-group" style="padding-right: 3px;">
         <h6 class="s14" style="color: #fff;">Custom Your Domain</h6>
          <input type="text" name="subdomain" class="form-control">
        </div>
        <div class="col-md-4" style="margin-top: 2em; padding-left: 0px !important;">
          <small><i class="cgrey tebal">smartcomm.id</i></small>
        </div>
      </div>
  
    </div> <!-- end-col-6 -->

      <div class="col-md-7">
       <div class="form-group">
        <h6 class="cgrey2">

      <div class="form-group">
        <label for="">Headline Text Login Portal</label>
          <input type="text" name="headline" class="form-control">
      </div>

      <div class="form-group">
        <label for="">Description Text Login Portal</label>
        <textarea class="form-control" id="" name="description_custom" rows="4"></textarea>
        </div>
       <div class="form-group">
        <label>Image Portal Login</label>
         <input type="file" id="fileup" name="fileup" class="file-upload-default">
                <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                <button class="file-upload-browse btn btn-light" type="button">Browse</button>
                </span>
      </div>
    </div>
      </div>
    </div>
    <div>
      <!-- <div class="card-footer bg-transparent"> -->
        <div style="text-align: right; margin-top: 2em;">
<button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-light btn-rounded btn-sm btn-fw">Cancel</button>
        &nbsp;
<button type="submit" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Save Editing</button>
</div>
      <!-- </div> -->
  </form>
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