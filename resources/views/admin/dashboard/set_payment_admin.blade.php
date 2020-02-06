@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Community Settings</h3>

              <nav aria-label="breadcrumb">
              <button type="button" id="btn_add_payment" class="btn btn-tosca btn-sm" style="margin-top: 0.5em;">Add Payment</button>
              </nav>
            </div>

<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">

<div class="row">
  <div class="col-md-8">
  <h4 class="card-title">Setting Payment Subscriber</h4>  
  </div>
  <div class="col-md-4" style="text-align: right;">
    <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-rounded btn-fw">Add Button</button>
  </div>
</div>
<br>

<div class="paddig-10" style="padding-right: 10%; padding-left: 10%;">
<small class="cgrey2">Default</small>
<br>
<div class="row borderan-pay" style="margin-top: 0.5em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>

<br><br>

<small class="cgrey2">Other</small>
<br>
<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>


<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>


<div class="row borderan-pay" style="margin-top: 0.5em; margin-bottom: 1em;">
<div class="col-md">
<img src="/img/default.png" class="rounded-circle img-fluid" style="width: 35px; height: 35px;">
</div>
<div class="col-md-6">
<h6 class="cgrey">Payment Name</h6>
  
</div>
<div class="col-md-4" style="text-align: right;">
  <small style="color: red; margin-top: 0.5em;">Not Active</small> &nbsp;&nbsp;
  <button type="button" onclick="location.href =''" class="btn btn-gradient-warning btn-sm btn-rounded btn-fw">Detail</button>
</div>
</div>

</div> <!-- div padding -->
  </div>
</div>
</div>



<!-- MODAL -->
<div class="modal fade" id="modal_add_payment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #ffffff;">

    <div class="modal-header" style="border: none;">
      <center>
        <h4 class="modal-title cgrey">Add Payment Type</h4>
      </center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

<div class="modal-body">
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
        <label for="">Payment Name</label>
        <input type="text" id="payment_name" name="payment_name" class="form-control input-abu">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
    <label for="">Payment Type</label>
    <select class="form-control input-abu" id="payment_tipe" name="payment_tipe">
    </select>
  </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
  <div class="form-group">
    <label for="">Nama Pemilik Rekening</label>
    <input type="text" id="rekening_name" name="rekening_name" class="form-control input-abu">
  </div>
  <div class="form-group">
    <label for="">Nomer Rekening</label>
    <input type="text" id="rekening_number" name="rekening_number" class="form-control input-abu">
  </div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="">Payment Status</label>
<select class="form-control input-abu" id="payment_status" name="payment_status">
  <option selected disabled> Choose </option>
  <option value="1"> Active </option>
  <option value="2"> Deactive </option>
</select>
</div>
</div>
</div>

          
</div> <!-- end-body -->
    <div class="modal-footer" style="border: none;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="button" id="btn_filter_membership" class="btn btn-tosca btn-sm">
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

tabel_tes();
get_payment_tipe();
});

function tabel_tes(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/tabel_payment_community',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
        console.log("Cant Show DataTable");
    }
});
}


$("#btn_add_payment" ).click(function(e) {
$("#modal_add_payment").modal("show");
});



function tabel_payment_community(){
    var tabel = $('#tabel_req_member').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_payment_community',
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



//dropdown 
function get_payment_tipe() {       
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/admin/get_payment_tipe",
    type: "POST",
    dataType: "json",
    success: function (result) {
      console.log(result);
      $('#payment_tipe').empty();
      $('#payment_tipe').append("<option disabled> Choose </option>");

      for (var i = result.length - 1; i >= 0; i--) {
        $('#payment_tipe').append("<option value=\"".concat(i, "\">").concat(result[i].payment_title, "</option>"));
      } 
      //Short Function Ascending//
      $("#payment_tipe").html($('#payment_tipe option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));

      $("#payment_tipe").get(0).selectedIndex = 0; 

    }
});
} //endfunction

</script>

@endsection