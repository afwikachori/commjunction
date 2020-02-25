@extends('layout.superadmin')

@section('title', 'Users')

@section('content')
<div class="page-header">
    <h3 class="page-title">
    	<span class="page-title-icon bg-gradient-primary text-white mr-2">
    		<i class="mdi mdi-account"></i>
        </span> Users </h3>

    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        	<li class="breadcrumb-item active" aria-current="page">
        		<span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
 <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Admin Commjuction</h4>
                    <br>

                    <form method="POST" id="form_adduser_superadmin" action="{{route('postAddUser')}}">
                     {{ csrf_field() }}

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="name_superadmin">Full Name</label>
                            <div class="col-sm-8">
                               <input id="name_superadmin" type="text" class="form-control @error('name_superadmin') is-invalid @enderror" name="name_superadmin" value="{{ old('name_superadmin') }}" required>
                               <small id="pesan_namesuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                            <input id="phone_super" type="text" class="form-control @error('phone_super') is-invalid @enderror" name="phone_super" value="{{ old('phone_super') }}" required>
                            <small id="pesan_phonesuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                             <input id="email_super" type="email_super" class="form-control @error('email_super') is-invalid @enderror" name="email_super" value="{{ old('email_super') }}" required autocomplete="email_super">
                            <small id="pesan_emailsuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                            <input id="username_super" type="text" class="form-control @error('username_super') is-invalid @enderror" name="username_super" value="{{ old('username_super') }}" required autocomplete="username_super">
                            <small id="pesan_usernamesuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                            <div class="input-group">
                            <input type="password" id="password_super" class="form-control @error('password_super') is-invalid @enderror" name="password_super" value="{{ old('password_super') }}" required autocomplete="password_super">
                            <div class="input-group-append">
                              <button class="btn btn-sm bg-grey" type="button" onclick="showpass()">
                                <i class="mdi mdi-eye"></i>
                              </button>
                            </div>
                            </div>
                            <small id="pesan_passuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                         <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Division</label>
                            <div class="col-sm-8">
                            <input id="division_super" type="division_super" class="form-control @error('division_super') is-invalid @enderror" name="division_super" value="{{ old('division_super') }}" required autocomplete="division_super">
                            <small id="pesan_divisisuper" class="redhide"></small>
                            </div>
                          </div>
                        </div>
                      </div>


                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                            <input id="password_confirm" type="password" class="form-control" name="password_confirm" required value="{{ old('password_confirm') }}" autocomplete="password_confirm">
                            <small id="pesan_cfpass" class="redhide"></small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Priviledge</label>
                        <div class="col-sm-8">
                          <select id="pilih_priv" class="form-control @error('pilih_priv') is-invalid @enderror" name="pilih_priv" data-old="{{ old('pilih_priv') }}" required>
                          </select>
                        </div>
                        </div>
                      </div>
                      </div>

                      <br>
                      <div class="row">
                      <div class="col-md-6"></div>
                      <div class="col-md-6" style="text-align: right;">
                      <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                      <button class="btn btn-light">Cancel</button>
                      </div>
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
// session_logged_dashboard();
get_priviledge();

});



//dropdown payment method
function get_priviledge() {
$('#method_pay').append("<option disabled>Please Choose Payment Type First</option>");

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_priviledge",
    type: "POST",
    dataType: "json",
    success: function (hasil) {
      // console.log(hasil.data);

      $('#pilih_priv').empty();
      $('#pilih_priv').append("<option disabled>Choose Priviledge</option>");

    if (hasil.success == true) {
      var data = hasil.data;

      for (var i = data.length - 1; i >= 0; i--) {
        $('#pilih_priv').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].priviledge, "</option>"));
      }

      //Short Function Ascending//
      $("#pilih_priv").html($('#pilih_priv option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));
      $("#pilih_priv").get(0).selectedIndex = 0;
    }

    const OldValue = '{{old('pilih_priv')}}';
    if(OldValue !== '') {
      $('#pilih_priv').val(OldValue);
    }

    },error: function (error) {
      console.log("Cant Show list Priviledge type"+ error);

    },
});
} //endfunction




function showpass() {
  var a = document.getElementById("password_super");
  if (a.type == "password") {
    a.type = "text";
  } else {
    a.type = "password";
  }
}



</script>

@endsection
