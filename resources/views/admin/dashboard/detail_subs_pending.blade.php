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
                  <li class="breadcrumb-item active" aria-current="page">Detail Subscriber</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-md-8">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
    <div class="row">
      <div class="col-md-8 cgrey" style="margin-top: 0.5em;">
        Detail Pending Subscriber
      </div>
      <div class="col-sm-4 sisi-kanan" style="text-align: right;">
        <button type="button" class="btn btn-sm btn-danger" style="border-radius: 6px;">Deactive</button>
      </div>
    </div>
  </div>
    <div class="card-body">
<center>
     <div class="bunder-ring">
       <img class="profile-pic rounded-circle img-fluid" src="/img/cam.png">
     </div>
</center>

<div class="row">
<div class="col-md">
  <div class="form-group">
    <small class="clight">Fullname</small>
    <p class="cgrey1 tebal">{{ $profil_subs }}</p>
  </div>
  <div class="form-group">
    <small class="clight">Username</small>
    <p class="cgrey1 tebal">@afwikachori123</p>
  </div>
</div>
<div class="col-md">
  <div class="form-group">
    <small class="clight">Phone Number</small>
    <p class="cgrey1 tebal">08101010101010</p>
  </div>
  <div class="form-group">
    <small class="clight">email</small>
    <p class="cgrey1 tebal">pikachu@gmail.com</p>
  </div>
</div>
</div>
    </div>
    <div class="card-footer putih" style="text-align: right; margin-bottom: 1em;">
      <button type="button" onclick="give_approval('{{$profil_subs }}');" class="btn btn-sm btn-teal">Approval</button>
    </div>
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




<!-- MODAL FILTER DATE -->
<div class="modal fade" id="modal_approval_pendingsubs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal" style="background-color: #ffffff; width: 80%;">
      <form method="POST" id="" action="">{{ csrf_field() }}
        <div class="modal-body">
      <center>
        <br>
        <h3 class="cgrey">Approval Confirmation</h3>
        <small class="clight">Please verify your approval or disproval reason and comment</small>
      </center>
<br>
      <div class="form-group" style="margin-top: 1em;">
        <input type="hidden" value="" class="form-control" id="id_subspending" name="id_subspending">
         <textarea class="form-control input-abu" id="alasan_approv" rows="5"></textarea>
      </div>

      </div> <!-- end-modal body -->
      <div class="modal-footer" style="border: none; margin-top: 1em; text-align: center;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="submit" class="btn btn-tosca btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Submit </button>
      </div>
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


function give_approval(idq){
// alert(didq);
$("#id_subspending").val(idq);
$("#modal_approval_pendingsubs").modal('show');
}


</script>

@endsection