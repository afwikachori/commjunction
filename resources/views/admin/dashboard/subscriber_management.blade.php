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


        <div class="tabbable-line">
          <ul class="nav nav-tabs ">
            <li class="tab-subs active" id="tab_all">
              <a href="#tab_default_1" data-toggle="tab">
                All
              </a>
            </li>
            <li class="tab-subs" id="tab_pending">
              <a href="#tab_default_2" data-toggle="tab">
                Pending
              </a>
            </li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
<div class="row">
  <div class="col-md-8">
    <button type="button" id="btn-filter-date" class="btn btn-tosca btn-sm" style="min-width: 120px;">Filter</button>
  </div>
  <div class="col-md-4" style="text-align: right;">
    <button type="button" id="reset_tbl_subsall" class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
      <i class="mdi mdi-refresh"></i>
    </button>
  </div>
</div>
      


          <!-- tabel all susbcriber -->  
        <table id="tabel_subscriber" class="table table-hover table-striped dt-responsive nowrap" style="width:100%"> 
          <thead> 
            <tr> 
              <th>ID Subscriber</th>
              <th>Membership</th>
              <th>Subcriber Name</th>
              <th>Status</th>
              <th>Last Login</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
          <!-- end tabel all  -->
          </div>


      <div class="tab-pane" id="tab_default_2">
        <!-- tabel all susbcriber -->  
        <table id="tabel_subs_pending" class="table table-hover table-striped dt-responsive nowrap" style="width:100%"> 
          <thead> 
            <tr> 
              <th>ID Subscriber</th>
              <th>Membership</th>
              <th>Subcriber Name</th>
              <th>Status</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
          <!-- end tabel all  -->
      </div>


          </div>
        </div>
</div>
</div>
</div>
</div>




<!-- MODAL FILTER DATE -->
<div class="modal fade" id="modal_filter_date_subs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #ffffff;">
    <div class="modal-header" style="border: none;">
      <center>
        <h4 class="modal-title cgrey">Filter Data</h4>
      </center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <form>{{ csrf_field() }}
        <div class="modal-body">
      <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" id="subs_datemulai" name="subs_datemulai" class="form-control" id="start_date">
      </div>

      <div class="form-group">
        <label for="start_date">End Date</label>
        <input type="date" id="subs_dateselesai" name="subs_dateselesai" class="form-control" id="end_date">
      </div>

      </div> <!-- end-modal body -->
      <div class="modal-footer" style="border: none;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="button" onclick="tabel_subscriber_all()" class="btn btn-tosca btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Submit </button>
      </div>
  </form>
    </div>
  </div>
</div>




<!-- //MODAL MEMBERSHIP TYPE -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <form>
      <div class="modal-header" style="border: none;">
      <center>
        <h4 class="modal-title cgrey">Filter Data</h4>
      </center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <div class="form-group">
        <label for="membership_tipe">Membership Type</label>
          <select class="form-control" id="membership_tipe">
            <option>a</option>
            <option>b</option>
            <option>c</option>
            <option>d</option>
          </select>
      </div>
    </div>
    <div class="modal-footer">
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

tabel_subscriber_all();
tabel_subscriber_pending();
// tabel_subs();

});


$( "#btn-filter-date" ).click(function() {
  $("#modal_filter_date_subs").modal('show');
});


$( "#reset_tbl_subsall" ).click(function() {
  $("#subs_datemulai").val("");
 $("#subs_dateselesai").val("");
 tabel_subscriber_all();
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
      data: {
            "subs_datemulai": $("#subs_datemulai").val(),
            "subs_dateselesai" : $("#subs_dateselesai").val() 
    },
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Subscriber Management DataTable");
    }
});
}




function tabel_subscriber_all(){
$('#tabel_subscriber').dataTable().fnClearTable();
$('#tabel_subscriber').dataTable().fnDestroy();

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    var tabel = $('#tabel_subscriber').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_subs_management',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
            "subs_datemulai": $("#subs_datemulai").val(),
            "subs_dateselesai" : $("#subs_dateselesai").val() 
            },
            error: function(jqXHR, ajaxOptions, thrownError) {
            var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            // $('#tabel_subscriber tbody').;
            $('#tabel_subscriber tbody').empty().append(nofound);
            },
        },
        error: function(request, status, errorThrown){
          console.log(errorThrown);
        },
        columns: [
            {mData: 'user_id'},
            {mData: 'membership',
            render: function ( data, type, row, meta ) {
              // console.log(data);
              var isiku;
            if(data == null ){
              isiku = '<label style="color:red;">null</label>';
            }else{
              isiku = data.membership;
            }
            return isiku;
          }
            },
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
            {mData: 'created_at',
             render: function ( data, type, row,meta ) {
            return formatDate(data);
            }
            },
            {mData: 'full_name',
            render: function ( data, type, row, meta ) {
          return '<a href="/admin/detail_subscriber/'+meta.row+'" type="button" class="btn btn-gradient-light btn-rounded btn-icon detil_subs">'+
          '<i class="mdi mdi-eye"></i>'+
                '</a>';
              }
            }
        ],

    });
 $("#subs_datemulai").val("");
 $("#subs_dateselesai").val("") 
 $("#modal_filter_date_subs").modal('hide');
}






function tabel_subscriber_pending(){
    var tabel = $('#tabel_subs_pending').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_subs_pending',
            type: 'POST',
            dataSrc :'',
            timeout: 30000,
        },
        columns: [
            {mData: 'status'},
            {mData: 'status'},
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
                isihtml = "Pending";
              }

              var htmlku = '<label class="badge badge-gradient-danger">'+isihtml+'</label>';
              
              return htmlku;
            }
          },
            {mData: 'created_at',
             render: function ( data, type, row,meta ) {
            return formatDate(data);
            }
            },
            {mData: 'status',
            render: function ( data, type, row,meta ) {
          return '<a href="/admin/detail_pendingsubs/'+meta.row+'" type="button" class="btn btn-gradient-light btn-rounded btn-icon detil_subs">'+
          '<i class="mdi mdi-eye"></i>'+
                '</a>';
              }
            }
        ],

    });

}



</script>

@endsection