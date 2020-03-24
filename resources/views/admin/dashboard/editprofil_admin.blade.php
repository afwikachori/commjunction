@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-table-edit"></i>
    </span>Edit Profile</h3>

 <nav aria-label="breadcrumb">
 	<ol class="breadcrumb">
 		<li class="breadcrumb-item"><a href="/admin/settings">Community Settings</a></li>
 		<li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
</div> <!-- end-page header -->



<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Community Profile</h4>
      <br>

<form method="POST" id="form_edit_community" action="{{route('edit_profil_community')}}" enctype="multipart/form-data">{{ csrf_field() }}
<center>
  <div class="img-upload-profil">
     <div class="circle">
       <img class="profile-pic rounded-circle img-fluid logo_komunitas editcom" id="view_profil_com" src="/img/focus.png">
     </div>
     <div class="p-image editcom">
      <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon" style="width: 30px; height: 30px;">
       <i class="mdi mdi-camera upload-button" id="btn_up_logo_komunitas"></i>
      </button>
        <input class="file-upload file-upload-default" id="file-upload-komunitas" type="file" id="fileup" name="fileup" accept="image/*"/>
     </div>
</div>
</center>

<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
		<label for="" class="col-sm-3 col-form-label">Community Name</label>
		<div class="col-sm-9">
		<input type="text" class="form-control input-abu" id="edit_namacom" name="edit_namacom">
		</div>
		</div>
	</div> <!-- end-col-md -->
</div>


<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
		<label  class="col-sm-3 col-form-label">Description Community</label>
		<div class="col-sm-9">
		<textarea class="form-control input-abu" id="edit_deskripsicom" name="edit_deskripsicom" rows="4"></textarea>
		</div>
		</div>
</div>
</div>

<input type="hidden" class="form-control input-abu" id="edit_idcom" readonly="readonly">
<br>

<div style="text-align: right;">
<button type="button" onclick="location.href ='/admin/settings'" class="btn btn-gradient-light btn-sm btn-fw melengkung8px">Cancel</button>
        &nbsp;
<button type="submit" class="btn btn-tosca btn-sm btn-fw">Save Editing</button>
</div>

</form>



    </div>
 </div>
 </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {
// file_browser_profil();
});




$("#file-upload-komunitas").on('change', function(){
        readURLini(this);
});

$("#btn_up_logo_komunitas").on('click', function() {
       $("#file-upload-komunitas").click();
});

var readURLini = function(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#view_profil_com').attr('src', e.target.result);
    }
  reader.readAsDataURL(input.files[0]);
 }
}

</script>

@endsection
