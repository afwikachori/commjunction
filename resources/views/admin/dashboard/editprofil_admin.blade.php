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

<form>
<center>
<div class="image-upload">
	<label for="file-input">
    	<img class="rounded-circle img-fluid" id="img_editprofil" src="/img/def-profil.png"/>
    </label>
    <div class="text-imgedit">Edit</div>
    <input id="file-input" name="file-input" type="file"/>
</div>
</center>
<label class="cblue" style="margin-bottom: 3%;">About Community</label>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
		<label for="exampleInputUsername2" class="col-sm-4 col-form-label">Community Name</label>
		<div class="col-sm-8">
		<input type="text" class="form-control" id="exampleInputUsername2">
		</div>
		</div>

		<div class="form-group row">
		<label for="exampleInputUsername2" class="col-sm-4 col-form-label">Address</label>
		<div class="col-sm-8">
		<input type="text" class="form-control" id="exampleInputUsername2">
		</div>
		</div>
	</div> <!-- end-col-md -->

	<div class="col-md-6">
		<div class="form-group row">
		<label for="exampleInputUsername2" class="col-sm-4 col-form-label">Administrator Name</label>
		<div class="col-sm-8">
		<input type="text" class="form-control" id="exampleInputUsername2">
		</div>
		</div>

		<div class="form-group row">
		<label for="exampleInputUsername2" class="col-sm-4 col-form-label">Description</label>
		<div class="col-sm-8">
		<input type="text" class="form-control" id="exampleInputUsername2">
		</div>
		</div>
	</div> <!-- end-col-md -->
</div>

<div style="text-align: right;">
<button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-light btn-rounded btn-sm btn-fw">Cancel</button>
        &nbsp;
<button type="button" onclick="location.href ='/admin/publish'" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Save Editing</button>
</div>

</form>



    </div>
 </div>
 </div>
</div> 


@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {

});

$('#file-input').on('change', function () {
 previewEditImg(this);
 }); //end-onchange img


 function previewEditImg(input) {
 	if (input.files && input.files[0]) {
 	var reader = new FileReader();

 	reader.onload = function (e) { 
 	$('#img_editprofil').show().attr('src', e.target.result);
 	}
 	reader.readAsDataURL(input.files[0]);
  }
}



</script>

@endsection