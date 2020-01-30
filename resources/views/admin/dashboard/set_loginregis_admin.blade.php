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
    <form>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
      <!-- <h6 class="cgrey2">Login Type for Subscriber</h6> -->
           <h6 class="cgrey2 s14">Custom Your Domain</h6>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Username & Password <i class="input-helper"></i>
            </label>
            </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Phone Number & Password <i class="input-helper"></i>
            </label>
            </div>

        <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Email & Password <i class="input-helper"></i>
            </label>
            </div>
      </div>

     <hr style="margin-top: 2em;">
      <h6 class="text-primary"><i>yourdomain</i>
        &nbsp;
        <b class="cgrey">@smartcomm.id</b></h6>
      <br>
      <div class="form-group">
         <h6 class="cgrey2 s14">Custom Your Domain</h6>
          <input type="text" class="form-control">
      </div>

    </div> <!-- end-col-6 -->

      <div class="col-md-8">
       <div class="form-group">
        <h6 class="cgrey2">

      <div class="form-group">
        <label for="exampleTextarea1">Headline Text Login Portal</label>
          <input type="text" class="form-control">
      </div>

      <div class="form-group">
        <label for="exampleTextarea1">Custom Descripyion Text Login Portal</label>
        <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
        </div>
       <div class="form-group">
        <label>Image Portal Login</label>
        <input type="file" name="img[]" class="file-upload-default">
        <div class="input-group col-xs-12">
          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
          <span class="input-group-append">
            <button class="file-upload-browse btn btn-gradient-light" type="button">Upload</button>
          </span>
        </div>
      </div>
    </div>
      </div>
    </div>
    <div>
      <!-- <div class="card-footer bg-transparent"> -->
        <div style="text-align: right; margin-top: 2em;">
<button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-light btn-rounded btn-sm btn-fw">Cancel</button>
        &nbsp;
<button type="button" onclick="location.href ='/admin/publish'" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Save Editing</button>
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