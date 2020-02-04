@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Membership Management</h3>

              <nav aria-label="breadcrumb">
                <button type="button" id="btn-filter-date" class="btn btn-tosca btn-sm">Add Membership</button>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
<h4 class="cgrey" style="margin-bottom: -0.5em;">Membership List</h4>

        <div class="tabbable-line">
          <ul class="nav nav-tabs member">
            <li class="tab-subs member active" id="tab_all">
              <a href="#tab_member_1" data-toggle="tab">
                List Membership
              </a>
            </li>
            <li class="tab-subs member" id="tab_pending">
              <a href="#tab_member_2" data-toggle="tab">
                Membership Request
              </a>
            </li>
          </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab_member_1">
        <div class="row">
          <div id="show_membership" class="card-deck">

            </div>  
        </div><!-- endrow -->
    </div> <!-- end-tab 1  -->


    <div class="tab-pane" id="tab_member_2">  
        <table id="tabel_req_member" class="table table-hover table-striped dt-responsive nowrap" style="width:100%"> 
          <thead> 
            <tr> 
              <th>ID</th>
              <th>Name</th>
              <th>Status</th>
              <th>Membership Type</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
    </div> <!-- end-tab2 -->

  </div> <!-- end-content -->
  </div> <!-- end-tab line -->
</div>
</div>
</div>
</div>



@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {
get_membership_admin();

// tabel_tes();
tabel_req_membership();
});


function tabel_tes(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/tabel_req_subscriber',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant membership req DataTable");
    }
});
}


function get_membership_admin(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/get_list_membership_admin',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        // console.log(result);

      var isimember = '';
      
      $.each(result, function(i,item){
      var logo = server_cdn+item.image;  
      isimember += '<div class="col-md-4 stretch-card grid-margin card-member">'+
                '<div class="card bg-gradient-success card-img-holder text-white member">'+
                  '<div class="card-body member">'+
                  '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />'+
                    '<h4 class="font-weight-normal mb-3">'+item.membership+'<i class="mdi mdi-cube-outline mdi-24px float-right"></i>'+
                    '</h4>'+
                    '<img src="'+logo+'" class="rounded-circle img-fluid logo-membership">'+
                    '<br><small class="card-text">'+item.description+'</small>'+
                  '</div></div></div>';
      });

$("#show_membership").html(isimember);

      },
      error: function (result) {
        console.log("Cant Show Membership List");
    }
});
}




function tabel_req_membership(){
    var tabel = $('#tabel_req_member').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_req_membership',
            type: 'POST',
            dataSrc :'',
            timeout: 30000,
        },
        columns: [
            {mData: 'user_id'},
            {mData: 'full_name'},
            {mData: 'payment_status_title'},
            {mData: 'membership'},
            {mData: 'id',
            render: function ( data, type, row,meta ) {
          return '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detil_subs">'+
          '<i class="mdi mdi-eye"></i>'+
                '</a>';
              }
            }
        ],

    });

}


</script>

@endsection