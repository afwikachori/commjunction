@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-briefcase-upload"></i>
    </span>Publish Preparation</h3>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/settings">Community Settings</a></li>
    <li class="breadcrumb-item active" aria-current="page">Publish</li>
  </ol>
</nav>
</div> <!-- end-page header -->

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <div class="row">
      <div class="col-md-9">
      <h4 class="card-title">Publish Preparation</h4>  
      </div> <!-- end-col-9 -->
      <div class="col-md-3" style="text-align: right;">
      <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Publish Now</button>
      </div> <!-- end-col-3 -->
    </div>

      <div class="preper-publish">
        <div class="row">
        <div class="col-md-7">
        <h6 class="cdgrey judulcomsetup">
        Checklist Setting Item</h6>
        <small class="clight">Setting description & information</small>
        </div> 
        <div class="col-md-2">
          <small class="cred">Not Ready</small>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-outline-info btn-sm btn-rounded btn-fw">Setting</button>
        </div>
        </div>
        <br>

        <div class="row">
        <div class="col-md-7">
        <h6 class="cdgrey judulcomsetup">
        Checklist Setting Item</h6>
        <small class="clight">Setting description & information</small>
        </div> 
        <div class="col-md-2">
          <small class="cred">Not Ready</small>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-outline-info btn-sm btn-rounded btn-fw">Setting</button>
        </div>
        </div>
        <br>

        <div class="row">
        <div class="col-md-7">
        <h6 class="cdgrey judulcomsetup">
        Checklist Setting Item</h6>
        <small class="clight">Setting description & information</small>
        </div> 
        <div class="col-md-2">
          <small class="cred">Not Ready</small>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-outline-info btn-sm btn-rounded btn-fw">Setting</button>
        </div>
        </div>
        <br>

        <div class="row">
        <div class="col-md-7">
        <h6 class="cdgrey judulcomsetup">
        Checklist Setting Item</h6>
        <small class="clight">Setting description & information</small>
        </div> 
        <div class="col-md-2">
          <small class="cred">Not Ready</small>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-outline-info btn-sm btn-rounded btn-fw">Setting</button>
        </div>
        </div>
        <br>

      </div> <!-- end preper-publish -->
 
    

    </div>
  </div>
</div>
</div>


@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {
});



</script>

@endsection