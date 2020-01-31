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
                  <li class="breadcrumb-item active" aria-current="page">Registrasion Data</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
    <h4 class="card-title">Setting Registrasion Data</h4>
<br>

    <div class="row borderan">
      <div class="col-md-4">
       <div class="form-group">
        <label>Input Text Box</label>
        <input type="text" class="form-control">
      </div>
      </div>

      <div class="col-md-4">
       <div class="form-group">
        <label>Date Picker</label>
        <input type="date" class="form-control" >
      </div>
      </div>

      <div class="col-md-2">
      <div class="form-group">
        <label>Check Box</label>
          <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input"> Default </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
               <input type="checkbox" class="form-check-input" checked> Checked </label>
          </div>
      </div>
      </div>

      <div class="col-md-2">
         <div class="form-group">  
          <label>Radio Button</label>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value=""> Default </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2" checked> Selected </label>
          </div>
        </div>

      </div>
    </div> <!-- end-borderan -->
<br>
<br>


<h6 style="margin-bottom: 0.6em;">Input Your Data</h6>

<div class="row">
<div class="col-md-5">
 <div class="form-group">
  <label for="aa123">Your Question</label>
  <input type="text" class="form-control" id="aa123">
 </div>
</div>

<div class="col-md-2">
<div class="form-group">
  <label for="exampleSelectGender">Input Type</label>
  <select class="form-control" id="exampleSelectGender">
    <option>Input Text Box</option>
    <option>Date Picker</option>
    <option>Checkbox</option>
    <option>Radiobutton</option>
  </select>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
  <label for="tags2">List Option List</label>
    <textarea class="form-control" placeholder="Enter to make option" id="tags2" name="tags2"></textarea>
 </div> <!-- end-form group -->

</div>
</div> <!-- end-row -->

<div class="row">
<div class="col-md-5">
 <div class="form-group">
  <label for="aa123">Your Question</label>
  <input type="text" class="form-control" id="aa123">
 </div>
</div>

<div class="col-md-2">
<div class="form-group">
  <label for="exampleSelectGender">Input Type</label>
  <select class="form-control" id="exampleSelectGender">
    <option>Input Text Box</option>
    <option>Date Picker</option>
    <option>Checkbox</option>
    <option>Radiobutton</option>
  </select>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
  <label for="tags2">List Option List</label>
    <textarea class="form-control" placeholder="Enter to make option" id="tags2" name="tags2"></textarea>
 </div> <!-- end-form group -->

</div>
</div> <!-- end-row -->

<div class="row">
<div class="col-md-5">
 <div class="form-group">
  <label for="aa123">Your Question</label>
  <input type="text" class="form-control" id="aa123">
 </div>
</div>

<div class="col-md-2">
<div class="form-group">
  <label for="exampleSelectGender">Input Type</label>
  <select class="form-control" id="exampleSelectGender">
    <option>Input Text Box</option>
    <option>Date Picker</option>
    <option>Checkbox</option>
    <option>Radiobutton</option>
  </select>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
  <label for="tags2">List Option List</label>
    <textarea class="form-control" placeholder="Enter to make option" id="tags2" name="tags2"></textarea>
 </div> <!-- end-form group -->

</div>
</div> <!-- end-row -->


<div class="row">
<div class="col-md-5">
 <div class="form-group">
  <label for="aa123">Your Question</label>
  <input type="text" class="form-control" id="aa123">
 </div>
</div>

<div class="col-md-2">
<div class="form-group">
  <label for="exampleSelectGender">Input Type</label>
  <select class="form-control" id="exampleSelectGender">
    <option>Input Text Box</option>
    <option>Date Picker</option>
    <option>Checkbox</option>
    <option>Radiobutton</option>
  </select>
</div>
</div>
<div class="col-md-5">
<div class="form-group">
  <label for="tags2">List Option List</label>
    <textarea class="form-control" placeholder="Enter to make option" id="tags2" name="tags2"></textarea>
 </div> <!-- end-form group -->

</div>
</div> <!-- end-row -->


<div style="text-align: right; margin-top: 2em;">
<button type="button" onclick="location.href ='/admin/editprofil'" class="btn btn-gradient-light btn-rounded btn-sm btn-fw">Cancel</button>
        &nbsp;
<button type="button" onclick="location.href ='/admin/publish'" class="btn btn-gradient-warning btn-rounded btn-sm btn-fw">Save</button>
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

  tagsInput();

});

function tagsInput(){
var input2 = document.querySelector('textarea[name=tags2]'),
tagify2 = new Tagify(input2, {
    enforeWhitelist : true,
    whitelist       : ["Single", "Married", "WNI", "WNA", "Male", "Female"]
});

// toggle Tagify on/off
document.querySelector('input[type=checkbox]').addEventListener('change', function(){
    document.body.classList[this.checked ? 'add' : 'remove']('disabled');
})
}



</script>

@endsection