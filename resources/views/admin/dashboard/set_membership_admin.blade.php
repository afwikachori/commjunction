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
                  <li class="breadcrumb-item active" aria-current="page">Membership Type</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Setting Membership Type</h4>

    <div id="filter-subs">
      <form>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
           <h6 class="cgrey2 s14">Custom Your Domain</h6>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Free Membership<i class="input-helper"></i>
            </label>
            </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Paid Membership <i class="input-helper"></i>
            </label>
            </div>
      </div>
      </div> <!-- end-col-8 -->
      <div class="col-md-4">
 <!-- <div class="card-footer bg-transparent"> -->
        <div style="text-align: right; margin-top: 4em;">
<button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-light btn-rounded btn-sm btn-fw">Cancel</button>
        &nbsp;
<button type="button" onclick="location.href ='/admin/publish'" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Save Editing</button>
</div>
      <!-- </div> -->
      </div>
    </div>

    </form>
    </div>

    </div>
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