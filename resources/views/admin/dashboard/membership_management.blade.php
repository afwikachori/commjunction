@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Membership Management</h3>

              <nav aria-label="breadcrumb">
                <button type="button" class="btn btn-tosca btn-sm">Add Membership</button>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body memberku">
<h4 class="cgrey" style="margin-bottom: -0.5em;">Membership List</h4>

        <div class="tabbable-line memberaku">
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
              <th class="th-center"> ID Subscriber</th>
              <th class="th-center"> Name</th>
              <th class="th-center"> Status</th>
              <th class="th-center"> Membership Type</th>
              <th class="th-center"> Action</th>
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





<!-- MODAL DETAIL REQ MEMBERSHIP-->
<div class="modal fade" id="modal_detail_req_member" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #ffffff;">

  <div class="modal-header" style="padding-bottom: 0em !important;">
    <h4 class="modal-title cgrey">Add Payment Type</h4>
   
    <label class="badge badge-secondary melengkung10px" id="status_member" style="text-align: right; min">Requested</label>
</div> <!-- end-header -->

<div class="modal-body detail_member">
  <div class="row">
    <div class="col-6" style="text-align: right;">
      <div class="bunder-ring2">
<img class="profile-pic rounded-circle img-fluid" src="/img/focus.png" id="foto_subs">     
</div>
    </div>
    <div class="col-6">
    <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Username</small>
    <p class="cgrey1 tebal" id="isi_username">-</p>
  </div>
    </div>
  </div>

  <div class="row">
<div class="col-md-12 stretch-card grid-margin" style="margin-bottom: 1rem !important;">
  <div class="card bg-gradient-success card-img-holder text-white">
    <div class="card-body" style="padding: 1rem 1rem !important;">
      <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
    <div class="row">
      <div class="col-md-4" style="text-align: right;">
        <img src="/img/cam.png" class="rounded-circle img-fluid icon-req-member" id="icon_member">
      </div>
      <div class="col-md-8">
        <h4 id="judul_member" style="margin-top: 1em;">Starter</h4>
      </div>
    </div>
    </div>
  </div>
</div>
</div> 

<div class="row">
  <div class="col-md-6">
    <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Request Date</small>
    <p class="cgrey1 tebal" id="isi_date">-</p>
  </div>

  <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Invoice Number</small>
    <p class="cgrey1 tebal" id="isi_invoice">-</p>
  </div>

 
  <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Payment Status</small>
    <p class="cgrey1 tebal" id="isi_paystatus">-</p>
  </div>
  </div>

  <div class="col-md-6">
    <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Payment Type</small>
    <p class="cgrey1 tebal" id="isi_paytipe">-</p>
  </div>

  <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Total Payment</small>
    <p class="cgrey1 tebal" id="isi_totalpay">-</p>
  </div>

   <div class="form-group" style="margin-top: 5%;">
    <small class="clight">Paid</small>
    <p id="isi_paid">-</p>
  </div>

  </div>
</div>
</div> <!-- end-body -->

  <div class="modal-footer" style="border: none;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="button" id="" class="btn btn-tosca btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Submit </button>
  </div>  <!-- end-footer     -->
</div> <!-- END-MDL CONTENT -->
  </div>
</div>





@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
get_membership_admin();
tabel_req_membership();
// tabel_tes();

});


function tabel_tes(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/tabel_req_membership',
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
            {mData: 'invoice_number',
            render: function ( data, type, row,meta ) {
            
          return '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick="detail_req_membership(\'' + data + '\')">'+
          '<i class="mdi mdi-eye matadetail"></i>'+
                '</a>';
              }
            }
        ],

    });

}


function detail_req_membership(inv_num){
  // alert(inv_num);
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
      url: '/admin/get_detail_membership_req',
      type: 'POST',
      datatype: 'JSON',
      data: {
      "invoice_number": inv_num
      },
      success: function (result) {
      var isipaid = '';
        console.log(result[0]);
      var dt = result[0];
      $("#isi_date").html(formatDate(dt.request_date));
      $("#isi_invoice").html(dt.invoice_number);
      $("#isi_username").html(dt.full_name);
      $("#isi_paytipe").html(dt.payment_method);
      $("#isi_totalpay").html(rupiah(dt.grand_total));
      $("#isi_paystatus").html(dt.payment_status_title);
      $("#judul_member").html(dt.membership);

      if(dt.picture != "0"){
      $(".logo_komunitas").attr("src", server_cdn+dt.picture);
      }

      if(dt.already_paid === true){
        isipaid = '<h6 style="color: #9de43e;">ALREADY PAID</h6';
      }else{
        isipaid = '<h6 style="color: #ff4d4d;">NOT YET</h6';
      }
      $("#isi_paid").html(isipaid);

      $("#modal_detail_req_member").modal("show");
      },
      error: function (result) {
        console.log("Cant Show Detail Membership Request");
    }
});
}


</script>

@endsection