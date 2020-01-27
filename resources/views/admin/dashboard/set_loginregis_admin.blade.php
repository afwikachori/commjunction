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

    <form>
    <!--   <div class="form-group">
        <label for="exampleInputName1">Name</label>
          <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
      </div> -->

      <div class="form-group"><label for="exampleSelectGender">Login Type</label>
        <select class="form-control" id="exampleSelectGender">
          <option>Username & Password</option>
          <option>Email & Password</option>
          <option>No.Tlp & Password</option>
        </select>
      </div>

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