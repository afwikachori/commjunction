@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Community Settings</h3>

              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Community Settings <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-md-8">
        <h4 class="card-title">Community Profile</h4>
        </div>
        <div class="col-md-4" style="text-align: right;">
        <span>Community Status</span> &nbsp; &nbsp;
        <span class="badge statuscomm">Status</span>
        </div>
      </div>

      <div class="divbutton">
        <button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-danger btn-rounded btn-sm btn-fw">Edit</button>
        &nbsp;
        <button type="button" onclick="location.href ='/admin/publish'" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Publish</button>
      </div>

      <div class="row">
      <div class="col-md-3">
      <div class="form-group">
        <small class="clight2 mgb-1">Community Icon</small><br>
      <img src="/img/default.png" class="rounded-circle img-fluid logo_komunitas" id="profil_admin_dash">
      </div>

      </div> <!-- end-col-md -->
      <div class="col-md-4">
      <div class="form-group">
        <small class="clight2 mgb-05">Community Name</small>
        <p class="cgrey1 judul_komunitas">Title</p>
      </div>
      <div class="form-group">
        <small class="clight2 mgb-05">Address</small>
        <p class="cgrey1 alamat_admin_komunitas">-</p>
      </div>
       <div class="form-group">
        <small class="clight2 mgb-05">Administrator Name</small>
        <p class="cgrey1 user_admin_logged">-</p>
      </div>

      </div> <!-- end col-md -->
      <div class="col-md-5">
      <div class="form-group">
        <small class="clight2 mgb-05">Themes</small>
        <p class="cgrey1">-</p>
      </div>
      <div class="form-group">
        <small class="clight2 mgb-05">Jenis Community</small>
        <p class="cgrey1">-</p>
      </div>
      <div class="form-group">
        <small class="clight2 mgb-05">Tanggal Pendaftaran</small>
        <p class="cgrey1 tanggalregis_komunitas">-</p>
      </div>
      </div><!-- end col-md -->
      </div> <!-- end-row -->

      <div class="row" style="margin-top: -1%;">
      <div class="col-md-12">
      <div class="form-group">
        <small class="clight2 mgb-05">Community Description</small>
        <p class="cgrey1 deskripsi_komunitas">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.</p>
      </div>
      </div>
    </div>  <!-- end-cardbody -->
  </div>
</div>

<br>

<div class="card">
  <div class="card-body">
    <h5 class="card-title" style="margin-bottom: 4%;">Community Setup</h5>

    <div class="row">
    <div class="col-md-8">
    <h6 class="cdgrey judulcomsetup">
    Login & Registrasion</h6>
    <small class="clight">Setting description & information</small>
    </div>
    <div class="col-md-4">
    <button type="button" onclick="location.href ='/admin/settings/loginregis'" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Go Setting</button>
    </div>
    </div>
    <br>

    <div class="row">
    <div class="col-md-8">
    <h6 class="cdgrey judulcomsetup">
    Membership Type</h6>
    <small class="clight">Setting description & information</small>
    </div>
    <div class="col-md-4">
    <button type="button" onclick="location.href ='/admin/settings/membership'" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Go Setting</button>
    </div>
    </div>
    <br>

    <div class="row">
    <div class="col-md-8">
    <h6 class="cdgrey judulcomsetup">
    Registrasion Data</h6>
    <small class="clight">Setting description & information</small>
    </div>
    <div class="col-md-4">
    <button type="button" onclick="location.href ='/admin/settings/registrasion_data'" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Go Setting</button>
    </div>
    </div>
    <br>

    <div class="row">
    <div class="col-md-8">
    <h6 class="cdgrey judulcomsetup">
    Subscriber Payment</h6>
    <small class="clight">Setting description & information</small>
    </div>
    <div class="col-md-4">
    <button type="button" onclick="location.href ='/admin/settings/payment'" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Go Setting</button>
    </div>
    </div>
    <br>



  </div>
</div>



</div> <!-- end-col-12 -->


@endsection

@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {

});



</script>

@endsection
