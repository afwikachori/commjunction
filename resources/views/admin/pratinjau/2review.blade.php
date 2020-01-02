<div class="container">

 <div class="row">

 	 <div class="col-sm" style="margin-top: 2em;">
 	 <div class="form-group mb-4">
      <label lang="en" >
      	Administrator Name 
      </label>
      <input class="form-control" type="text" placeholder="{{ $dt['admin']['full_name'] }}" disabled>
  	</div>

     <div class="form-group mb-4">
    <label lang="en">Phone Number</label>
    <input class="form-control" type="text" placeholder="{{ $dt['admin']['notelp'] }}" disabled>
  	</div>
 
    <div class="form-group mb-4">
    <label lang="en">Email Address</label>
   <input class="form-control" type="text" placeholder="{{ $dt['admin']['email'] }}" disabled>
  </div>
    </div>


    <div class="col-sm" style="margin-top: 2em;">
    <div class="form-group mb-4">
    <label lang="en">Address</label>
<input class="form-control" type="text" placeholder="{{ $dt['admin']['alamat'] }}" disabled>
  	</div>

   <div class="form-group mb-4">
      <label lang="en" >Username Login</label>
     <input class="form-control" type="text" placeholder="{{ $dt['admin']['user_name'] }}" disabled>
    </div>

     <div class="form-group mb-4">
    <label lang="en">Password</label>

<div class="input-group">
  <input class="form-control" id="password_admin" type="password"  value="{{ $dt['admin']['password'] }}"  class="form-control"aria-describedby="btn_showpass" disabled>
  <div class="input-group-append">
    <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
    </button>
  </div>
</div>

  	</div>

    </div>
 	
 </div>

  
</div>