@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Subscriber Management</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriber Management</a></li>
                  <!-- <li class="breadcrumb-item active" aria-current="page">Registrasion Data</li> -->
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">

       <table id="tabel_subscriber" class="table table-hover dt-responsive nowrap" style="width:100%"> <thead> 
            <tr> 
                <th>No</th>
                <th>ID Subscriber</th>
                <th>Subcriber Name</th>
                <th>Status</th>
                <th>Last Login</th>
                <th>Action</th>
            </tr>
            </thead> 
        </table>

</div>
</div>
</div>
</div>


@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {

tabel_subscriber_management();

// tabel_subs();

});

function tabel_subs(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/tabel_subs_management',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Subscriber Management DataTable");
    }
});
}



function tabel_subscriber_management(){
    var tabel = $('#tabel_subscriber').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_subs_management',
            type: 'POST',
            dataSrc :'',
            timeout: 30000
        },
        columns: [
            {mData: ''},
            {mData: ''},
            {mData: 'full_name'},
            {mData: 'status',
            render: function ( data, type, row ) {
              // console.log(data);
              var isihtml;
              if(data == 1){ //first-login
              isihtml = "First Login";
              }else if(data == 2){
              isihtml = "Active"
              }else if(data == 3){
                isihtml = "Published";
              }else{
                isihtml = "Deactive";
              }

              var htmlisi = '<label class="badge badge-gradient-info">'+isihtml+'</label>';
              
              return htmlisi;
            }
          },
            {mData: 'created_at'},
            {mData: 'action',
            render: function ( data, type, row ) {
          return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detil_subs">'+
                '<i class="mdi mdi-eye"></i>'+
                '</button>';
              }
            }
        ],

    });

}


</script>

@endsection