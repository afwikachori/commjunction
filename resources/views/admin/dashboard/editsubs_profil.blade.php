@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Management</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriber Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Subscriber</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-md-8">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
    <div class="row">
      <div class="col-md-8 cgrey" style="margin-top: 0.5em;">
        Edit Subscriber
      </div>
      <div class="col-sm-4 sisi-kanan" style="text-align: right;">
        <button type="button" class="btn btn-ijo btn-sm">Status</button>
      </div>
    </div>
  </div>

<div class="card-body">
  <div class="img-upload-profil">
     <div class="circle">
       <img class="profile-pic rounded-circle img-fluid" src="/img/focus.png">
     </div>
     <div class="p-image">
      <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon" style="width: 30px; height: 30px;">
       <i class="mdi mdi-camera upload-button"></i>
      </button>
        <input class="file-upload" type="file" accept="image/*"/>
     </div>
</div>

zz
<div class="row">
<div class="col-md">
  <div class="form-group">
    <small class="clight">Fullname</small>
     <input type="text" class="form-control input-abu" id="nama_subs" name="nama_subs" value="{{ $idsubs }} data tester ">
  </div>
  <div class="form-group">
    <small class="clight">Username</small>
     <input type="text" class="form-control input-abu" id="username_subs" name="username_subs" value="sdasd233">
  </div>
</div>
<div class="col-md">
  <div class="form-group">
    <small class="clight">Phone Number</small>
    <input type="text" class="form-control input-abu" id="phone_subs" name="phone_subs" value="0892310983030">
  </div>
  <div class="form-group">
    <small class="clight">Email</small>
    <input type="text" class="form-control input-abu" id="email_subs" name="email_subs" value="tesxnkns@gmail.com">
  </div>
</div>
</div>
</div> <!-- end-body -->

<div class="card-footer putih" style="text-align: right; margin-bottom: 1em;">
  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" onclick="window.location.href = '/admin/detail_subscriber/{{ $idsubs }}'">Cancel
    </button>
    &nbsp;
  <button type="submit" class="btn btn-sm btn-teal">Edit Data</button>
</div>
</form>

  </div>
</div>


 <div class="col-sm-4 col-activity">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
   <div class="row">
        <div class="col-md-6 cgrey" style="margin-top: 0.5em;">
          Last Activity
        </div>
        <div class="col-md-6 sisi-kanan" style="text-align: right;">
          <small class="cgrey2">Updated 10 Hours</small>
        </div>
      </div>
  </div>
    <div class="card-body">
      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
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

file_browser_profil();

});



</script>

@endsection