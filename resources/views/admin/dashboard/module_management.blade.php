@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Module Management</h3>

              <nav aria-label="breadcrumb">
                <button type="button" class="btn btn-tosca btn-sm">Add New Module</button>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body memberku">
<h4 class="cgrey" style="margin-bottom: -0.5em;">Module List</h4>

        <div class="tabbable-line memberaku">
          <ul class="nav nav-tabs member">
            <li class="tab-subs member active" id="tab_active">
              <a href="#tab_module_1" data-toggle="tab">
                Active
              </a>
            </li>
            <li class="tab-subs member" id="tab_all">
              <a href="#tab_module_2" data-toggle="tab">
                All
              </a>
            </li>
          </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab_module_1">
        <div class="row">
          <div id="show_module_active" class="card-deck">

             <!--  <div class="col-md-4 stretch-card grid-margin card-member">
                <div class="card bg-gradient-success card-img-holder text-white member">
                  <div class="card-body member">
                  <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <label class="badge label-oren float-right">Active</label>
                    <img src="'+logo+'" class="rounded-circle img-fluid img-card">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Judul Module</h4>
                    </div>
                    <div class="col-md-12" style="text-align: right;">
                      <a href="/admin" class="a_setmodule">
                        <small lang="en" class="txt_detail_fitur h6 s11 cputih"> Setting
                        <i class="mdi mdi-circle" aria-hidden="true"></i>
                      </small></a>
                    </div>
                  </div>
              </div></div></div> -->

            </div>  
        </div><!-- endrow -->
    </div> <!-- end-tab 1  -->


    <div class="tab-pane" id="tab_module_2">  
    <div class="row">
    <div id="show_module_all" class="card-deck">
    
    </div>
  </div>
    </div> <!-- end-tab2 -->
  </div> <!-- end-content -->
  </div> <!-- end-tab line -->
</div>
</div>
</div>
</div>




<!-- MODAL DETAIL MODULE ACTIVE-->
<div class="modal fade" id="mdl_detail_module_active" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
<div class="modal-content" style="background-color: #ffffff; min-height: 350px;">

<div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
Module Active Detail
</div> <!-- end-body -->

  <div class="modal-footer" style="border: none;">
    <center>
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <a href="t" type="button"class="btn btn-teal btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i>Activate</a>
  </center>
  </div>  <!-- end-footer     -->
</div> <!-- END-MDL CONTENT -->
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
get_module_active();
get_module_all();
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


function get_module_active(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/get_active_module_list',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);

      var isiui = '';
      
      $.each(result, function(i,item){
      var logo = server_cdn+item.logo;  
      isiui += '<div class="col-md-4 stretch-card '+
                    'grid-margin card-member">'+
                '<div class="card bg-gradient-success card-img-holder text-white member">'+
                  '<div class="card-body member">'+
                  '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />'+
                  '<label class="badge label-oren float-right">Active</label>'+
                    '<img src="'+logo+'" class="rounded-circle img-fluid img-card">'+
                  '<div class="row">'+
                    '<div class="col-md-12">'+
                      '<h4>'+item.feature_type_title+'</h4>'+
                    '</div>'+
                    '<div class="col-md-12" style="text-align: right;">'+
                      '<a href="" class="a_setmodule"'+
                      'data-toggle="modal" data-target="#mdl_detail_module_active" data-dismiss="modal">'+
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting'+
                        ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>'+
                      '</small></a>'+
                    '</div>'+
                  '</div></div></div></div>';
      });

$("#show_module_active").html(isiui);

      },
      error: function (result) {
        console.log("Cant Show Module List");
    }
});
}




function get_module_all(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/get_all_module_list',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);

      var isiui = '';
      
      $.each(result, function(i,item){
      var logo = server_cdn+item.logo;  
      isiui += '<div class="col-md-4 stretch-card '+
                    'grid-margin card-member">'+
                '<div class="card bg-gradient-success card-img-holder text-white member">'+
                  '<div class="card-body member">'+
                  '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />'+
                  '<label class="badge label-oren float-right">Active</label>'+
                    '<img src="'+logo+'" class="rounded-circle img-fluid img-card">'+
                  '<div class="row">'+
                    '<div class="col-md-12">'+
                      '<h4>'+item.feature_type_title+'</h4>'+
                    '</div>'+
                    '<div class="col-md-12" style="text-align: right;">'+
                      '<a href="" class="a_setmodule"'+
                      'data-toggle="modal" data-target="#mdl_detail_module_active" data-dismiss="modal">'+
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting'+
                        ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>'+
                      '</small></a>'+
                    '</div>'+
                  '</div></div></div></div>';
      });

$("#show_module_all").html(isiui);

      },
      error: function (result) {
        console.log("Cant Show Module List");
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
      $("#invoice_num_acc").val(dt.invoice_number);
      $("#id_subs_acc").val(dt.user_id);
      $("#isi_username").html(dt.full_name);
      $("#isi_paytipe").html(dt.payment_method);
      $("#isi_totalpay").html(rupiah(dt.grand_total));
      $("#isi_paystatus").html(dt.payment_status_title);
      $("#judul_member").html(dt.membership);

      if(dt.picture != "0"){
      $(".logo_komunitas").attr("src", server_cdn+dt.picture);
      }

      if(dt.file_subscriber == null){
       $(".img_file_bayar_subs").attr("src", "/img/noimg.jpg");
      }else{
         $(".img_file_bayar_subs").attr("src", server_cdn+dt.file_subscriber);
        $('.img_file_bayar_subs').attr('onClick','clickImage(this)');
      }

      if(dt.already_paid == true){
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


// function file_browser_profil(){
    

    $("#file_acc_member").on('change', function(){

         if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#view_img_member').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(this.files[0]);
            $('#view_img_member').show();
        }
    });
    
    $("#browse_acc_member").on('click', function() {
       $("#file_acc_member").click();
    });
// }



</script>

@endsection