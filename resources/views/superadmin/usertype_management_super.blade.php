@extends('layout.superadmin')

@section('title', 'User Type Management')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span>User Type Management</h3>

              <nav aria-label="breadcrumb">
                 <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_user">Add User</button>
              </nav>
            </div>


<div class="row">
 <div class="col-md-12">
  <div class="card" style="min-height: 450px;">
  <div class="card-header putih">
  List User Type
  </div>

<div class="card-body">
 <!-- tabel all susbcriber -->
        <table id="tabel_usertype_manage" class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
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







@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {

// tabel_user_management();

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
    var tabel = $('#tabel_usertype_manage').DataTable({
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
          return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"  onclick="detail_user_manage(\'' + data + '\')">'+
          '<i class="mdi mdi-eye"></i>'+
                '</button>';
              }
            }
        ],

    });

}

function detail_user_manage(iduser){
$("#modal_detail_user").modal("show");

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/detail_user_management',
      type: 'POST',
      datatype: 'JSON',
      data: {
      "user_id": iduser
      },
      success: function (result) {

      },
      error: function (result) {
        console.log("Cant Show Detail User");
    }
});
}


</script>

@endsection
