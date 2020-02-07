@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span>User Management</h3>

              <nav aria-label="breadcrumb">
                 <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_user">Add User</button>
              </nav>
            </div>


<div class="row">
 <div class="col-md-12">
  <div class="card" style="min-height: 450px;">
  <div class="card-header putih">
  List User
  </div>

<div class="card-body">
 <!-- tabel all susbcriber -->  
        <table id="tabel_user_manage" class="table table-hover table-striped dt-responsive nowrap" style="width:100%"> 
          <thead> 
            <tr> 
              <th>ID User</th>
              <th>Name</th>
              <th>Username</th>
              <th>User Type</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
          <!-- end tabel all  -->
</div> <!-- //body -->
</div>
</div>
</div> <!-- endrow -->






<!-- MODAL ADD USER-->
<div class="modal fade" id="modal_add_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #ffffff;">

<form method="POST" id="form_add_user_manage" action="{{route('add_user_management')}}" enctype="multipart/form-data">
{{ csrf_field() }}

<div class="modal-header"  style="padding-left: 5%;padding-right: 5%;">
    <h4 class="modal-title cgrey">Add User</h4>
</div> <!-- end-header -->

<div class="modal-body" style="padding-left: 5%;padding-right: 5%;">


<div class="row">
<div class="col-md">
  <div class="form-group">
    <small class="clight">Fullname</small>
    <input type="text" id="name_user" name="name_user" class="form-control input-abu" >
  </div>
    <div class="form-group">
    <small class="clight">Phone Number</small>
     <input type="text" id="phone_user" name="phone_user" class="form-control input-abu" >
  </div>

</div>

<div class="col-md">
  <div class="form-group">
    <small class="clight">Email</small>
    <input type="email" id="email_user" name="email_user" class="form-control input-abu" >
  </div>
  <div class="form-group">
     <small class="clight">User Type</small>
    <select class="form-control input-abu" id="user_tipe" name="user_tipe">    
    </select>
  </div>

</div>
</div>

<small class="cgrey tebal">Account Information</small>
<div class="row" style="margin-top: 0.5em;">
  <div class="form-group col-md-6">
    <small class="clight">Username</small>
     <input type="text" id="username_user" name="username_user" class="form-control input-abu" >
  </div>
</div>

<div class="row" style="margin-top: 0.5em;">
  <div class="form-group col-md-12">
    <small class="clight">Address</small>
    <textarea class="form-control input-abu" id="alamat_user" name="alamat_user" rows="2"></textarea>
  </div>
</div>

<div class="row">
<div class="col-md-6">
 <div class="form-group">
    <small class="clight">Password</small>
    <input type="Password" id="pass_user" name="pass_user" class="form-control input-abu" >
  </div>
</div>
<div class="col-md-6">
  
<div class="form-group">
    <small class="clight">Confirm Password</small>
<div class="input-group">
    <input class="form-control input-abu" id="confirmpass_user" type="password" name="confirmpass_user" required="" autocomplete="passadmin" aria-describedby="btn_newshowpass">
    <div class="input-group-append">
<a class="btn btn-outline-light" type="button" id="btn_newshowpass" onclick="showPassword()" style="background-color: #efefef; border-radius: 0px 10px 10px 0px; padding: 14px 10px 0 10px;">
  <span class="mdi mdi-eye" aria-hidden="true" style="color: grey;"></span>
</a>
</div>
</div>
</div>
</div>
</div> <!-- end-row -->

</div> <!-- end-body -->

  <div class="modal-footer" style="border: none;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="submit" id="btn_add_usermanage" class="btn btn-tosca btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Add User </button>
  </div>  <!-- end-footer     -->
</form>
</div> <!-- END-MDL CONTENT -->

  </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
get_user_tipe_manage();
tabel_user_management();
// tabel_tes();
});

function tabel_tes(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/tabel_user_management',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Show");
    }
});
}


function tabel_user_management(){
    var tabel = $('#tabel_user_manage').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_user_management',
            type: 'POST',
            dataSrc :'',
            timeout: 30000,
        },
        columns: [
            {mData: 'user_id'},
            {mData: 'full_name'},
            {mData: 'user_name'},
            {mData: 'user_type'},
            {mData: 'user_id',
            render: function ( data, type, row,meta ) {
          return '<a href="" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"  onclick="detail_user_manage(\'' + data + '\')">'+
          '<i class="mdi mdi-eye matadetail"></i>'+
                '</a>';
              }
            }
        ],

    });

}

function detail_user_manage(iduser){
alert(iduser);
}

 function showPassword() {
  var a = document.getElementById("confirmpass_user");
  if (a.type == "password") {
    a.type = "text";
  } else {
    a.type = "password";
  }
}




//dropdown 
function get_user_tipe_manage() {       
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/admin/get_user_tipe_manage",
    type: "POST",
    dataType: "json",
    success: function (result) {

      $('#user_tipe').empty();
      $('#user_tipe').append("<option disabled> Choose </option>");

      for (var i = result.length - 1; i >= 0; i--) {
        $('#user_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
      } 
      //Short Function Ascending//
      $("#user_tipe").html($('#user_tipe option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));

      $("#user_tipe").get(0).selectedIndex = 0; 

       const OldValue = '{{old('user_tipe')}}';
    
    if(OldValue !== '') {
      $('#user_tipe').val(OldValue);
    }

    }
});
} //endfunction

</script>

@endsection