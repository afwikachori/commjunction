@extends('layout.app')

@section('content')

<img src="/visual/kananatas.png" class="img_confirm1">
<img src="/visual/imgregis.png" class="img_confirm2">
<img src="/visual/kiribawah.png" class="img_confirm3">

<div class="container">
<h3 style="margin-top: 1.3em; margin-bottom: 1em; margin-left: -15px;">Please Confirm your Regsitrasion !</h3>
<br>
<div class="row">
  <div class="col-4">

  <form method="POST" id="form_registerfirst_admin" action="{{route('adminconfirmpay')}}" enctype="multipart/form-data">{{ csrf_field() }}

    <div class="form-group row">
      <label class="h6 cgrey">Invoice Number</label>
      <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" required autocomplete="invoice_number" placeholder="Invoice Number">
      @if($errors->has('invoice_number'))
      <small style="color: red;">{{ $errors->first('invoice_number')}}</small>
      @endif
    </div>

    <div class="form-group row">
      <label class="h6 cgrey">Full Name</label>
      <input id="name_userpay" type="text" class="form-control @error('name_userpay') is-invalid @enderror" name="name_userpay" value="{{ old('name_userpay') }}" required autocomplete="name_userpay" placeholder="Name">
    @if($errors->has('name_com'))
    <small style="color: red;">{{ $errors->first('name_userpay')}}</small>
    @endif
  </div>

  <div class="form-group row">
    <label class="h6 cgrey">Image Of Payment</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input form-control @error('file_payment') is-invalid @enderror" name="file_payment" value="{{ old('file_payment') }}" required autocomplete="file_payment" id="file_payment" required>
      <label class="custom-file-label" for="file_payment" style="text-align: left;">Choose file</label>

      @if($errors->has('file_payment'))
       <small style="color: red;">Extension is <i>.jpg / .jpeg / .PDF</i></small>
     @endif
   </div>
 </div>

 <button type="submit" id="btn_confirmpay" class="btn btn-oren" style="border-radius: 8px; margin-bottom: 0.5em; margin-top: 1em; margin-left: -15px;">Submit</button>
</form>
</div> <!-- end  col-4 -->
<div class="col-1">
</div>

<div class="col-4" id="detil_pay">
  <br>
<div class="form-group">
    <small class="clight2 mgb-05">Total Payment</small>
    <h6 class="cgrey1" id="nominal_payment1"></h6>
</div>

<div class="form-group">
    <small class="clight2 mgb-05">Bank Name</small>
    <h6 class="cgrey1" id="bank_receiver"></h6>
</div>

<div class="form-group">
    <small class="clight2 mgb-05">Name Receiver</small>
    <h6 class="cgrey1" id="name_receiver"></h6>
</div>

<div class="form-group" id="hidein-img">
    <small class="clight2 mgb-05">Your Image Payment</small>
    <br>
    <img id="show_imgpay" class="img-fluid rounded float-left" src="" style="width: 15%; margin-top: 0.3em; height: auto;display: none; ">
</div>
</div> <!-- end detail-pay -->


</div> <!-- end row -->
</div> <!-- end-container -->


</center>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
  $("#detil_pay").css("display", "none");
  $("#name_userpay").attr("disabled", 'disabled');
  $("#file_payment").attr("disabled", 'disabled');
  $("#btn_confirmpay").css("display", "none");
  $("#hidein-img").css("display", "none");




});






$('input#invoice_number').bind("change keyup input",function() {
  var inin = $(this).val();
    // alert("num invoice = "+inin);
  get_invoice_num(inin);
});




function get_invoice_num(input){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/get_invoice_num',
      data: {'invoice_number': input},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        var isi = result.data;
        // console.log(isi);
        $("#detil_pay").fadeIn();
        // swal(result.message);
        $("#name_userpay").removeAttr("disabled", 'disabled');
        $("#file_payment").removeAttr("disabled", 'disabled');
        $("#btn_confirmpay").fadeIn();

         $("#nominal_payment1").html(rupiah(isi.payment_total));
         $("#bank_receiver").html(isi.payment_bank_name);
         $("#name_receiver").html(isi.payment_owner_name);


      },
      error: function (result) {
        console.log("Cant invoice number");

      }
      });

  }



var idku = $('#id_pop_payment').val();
//showfile name upload icon
$('#file_payment').on('change', function () {
// menampilkan img
previewImgUpload("show_imgpay",this);
$("#hidein-img").fadeIn();

var fileName = $(this).val();
         if ( fileName.length > 30){
           var fileNameFst=fileName.substring(0,30);
           $(this).next('.custom-file-label').html(fileNameFst+"...");
         }else{
          $(this).next('.custom-file-label').html(fileName);
         }
});

</script>
@endsection
