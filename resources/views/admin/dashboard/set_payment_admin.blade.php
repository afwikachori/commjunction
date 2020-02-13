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
      <!-- tabel all susbcriber -->  
        <table id="tabel_paysubs" class="table table-hover table-striped dt-responsive nowrap" style="width:100%"> 
          <thead> 
            <tr> 
              <th>ID Pay</th>
              <th>Payment Title</th>
              <th>Bank Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
      <!-- end tabel all  -->
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

<form method="POST" id="form_add_payment_subs" action="{{route('add_payment_subs')}}">
{{ csrf_field() }}
<div class="modal-body">
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
       <label>Payment Name</label>
        <input type="text" id="payment_name" name="payment_name" class="form-control input-abu">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
   <label>Payment Type</label>
    <select class="form-control input-abu" id="payment_tipe" name="payment_tipe">
    </select>
  </div>
  </div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
   <label>Nama Pemilik Rekening</label>
    <input type="text" id="rekening_name" name="rekening_name" class="form-control input-abu">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label>Nomer Rekening</label>
    <input type="text" id="rekening_number" name="rekening_number" class="form-control input-abu">
  </div>
</div>

<div class="col-md-12 form-group">
    <small>Dekripsi</small>
    <textarea class="form-control input-abu" id="deskripsi_paysubs" name="deskripsi_paysubs" rows="2"></textarea>
  </div>

<div class="col-md-6">
  <div class="form-group">
   <label>Bank Name</label>
    <select class="form-control input-abu" id="bank_name" name="bank_name">
    </select>
  </div>
  <div class="form-group">
<label for="">Payment Time Limit</label>
<select class="form-control input-abu" id="pay_time_limit" name="pay_time_limit" value="{{old('pay_time_limit')}}">
  <option selected disabled> Choose </option>
  <option value="1"> 1 Day </option>
  <option value="2"> 2 Days </option>
  <option value="3"> 3 Days </option>
  <option value="4"> 4 Days </option>
  <option value="5"> 5 Days </option>
  <option value="6"> 6 Days </option>
  <option value="7"> 7 Days </option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="">Payment Status</label>
<select class="form-control input-abu" id="payment_status" name="payment_status" value="{{old('payment_status')}}">
  <option selected disabled> Choose </option>
  <option value="1"> Active </option>
  <option value="0"> Deactive </option>
</select>
</div>
</div>
</div>

          
</div> <!-- end-body -->
    <div class="modal-footer" style="border: none; margin-top: -1.5em;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="submit" id="btn_add_paysubs" class="btn btn-teal btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Add </button>
    </div>  <!-- end-footer     -->
  </form>
    </div> <!-- END-MDL CONTENT -->
  </div>
</div>




<!-- MODAL DETAIL PAYMENT SUBS  -->
<div class="modal fade" id="modal_detail_paymentsubs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content modal" style="background-color: #ffffff;">

    <div class="modal-header" style="border-bottom: none;"> 
      <h4 class="modal-title cgrey">Detail Payment</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

  <div class="modal-body" style="margin-top: -1.5em; min-height: 300px;">

<form method="POST" id="form_delete_paysubs" action="{{route('delete_payment_subs')}}">
{{ csrf_field() }}
<input type="hidden" name="id_paymentsubs" id="id_paymentsubs">
 <button type="submit" class="btn bg-merah melengkung10px btn-sm">
    <i class="mdi mdi-delete btn-icon-prepend">
    </i> Delete </button>
</form>


   </div> <!-- end-modal body -->
    
  <div class="modal-footer" style="border: none; margin-top: 1em; text-align: center; padding-right: 25%; padding-bottom: 5%;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button class="btn btn-teal btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Approve </button>
  </div>

    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {
tabel_payment_community();
tabel_tes();
get_payment_tipe();
get_bank_pay();
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
    var tabel = $('#tabel_paysubs').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/tabel_payment_community',
            type: 'POST',
            dataSrc :'',
            timeout: 30000,
        },
        columns: [
            {mData: 'id'},
            {mData: 'payment_title'},
            {mData: 'payment_bank_name'},
            {mData: 'status',
            render: function ( data, type, row,meta ) {
            var ket ='';
            if(data == 0){ 
              ket = '<label class="badge bg-abu round-label">Deactive</label>';
            }else{
               ket = '<label class="badge bg-tosca round-label">Active</label>';
            }
            return ket;
            }
            },
            {mData: 'id',
            render: function ( data, type, row,meta ) {
          return '<button type="button" class="btn btn-gradient-light btn-sm btn-rounded btn-icon" style="width:28px; height:28px; "  onclick="detail_subspay(\'' + data + '\')">'+
          '<i class="mdi mdi-eye"></i>'+
                '</button>';
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
      // console.log(result);
      $('#payment_tipe').empty();
      $('#payment_tipe').append("<option disabled> Choose </option>");

      for (var i = result.length - 1; i >= 0; i--) {
        $('#payment_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].payment_title, "</option>"));
      } 
      //Short Function Ascending//
      $("#payment_tipe").html($('#payment_tipe option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));

      $("#payment_tipe").get(0).selectedIndex = 0; 

    }
});
} //endfunction




//dropdown bank
function get_bank_pay() {       
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/admin/get_bank_pay",
    type: "POST",
    dataType: "json",
    success: function (result) {
      $('#bank_name').empty();
      $('#bank_name').append("<option disabled> Choose </option>");

      for (var i = result.length - 1; i >= 0; i--) {
        $('#bank_name').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
      } 
      //Short Function Ascending//
      $("#bank_name").html($('#bank_name option').sort(function (x, y) {
        return $(x).text() < $(y).text() ? -1 : 1;
      }));

      $("#bank_name").get(0).selectedIndex = 0; 

       const OldValue2 = '{{old('bank_name')}}';
    
    if(OldValue2 !== '') {
      $('#bank_name').val(OldValue2);
    }
    }
});
} //endfunction




function detail_subspay(idpay){
// alert(idpay);
$("#id_paymentsubs").val(idpay);
$("#modal_detail_paymentsubs").modal("show");
}


</script>

@endsection