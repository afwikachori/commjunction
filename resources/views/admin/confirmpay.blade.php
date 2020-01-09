@extends('layout.app')

@section('content')
<div class="container">
	<center>
		<h1 style="margin-top: 1.3em; margin-bottom: 1em;">Please Confirm your Regsitrasion !</h1>

<br>
<div class="row">
  <div class="col-4">
     <form method="POST" id="form_registerfirst_admin" action="{{route('adminconfirmpay')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group row">
                        <input id="name_userpay" type="text" class="form-control @error('name_userpay') is-invalid @enderror" name="name_userpay" value="{{ old('name_userpay') }}" required autocomplete="name_userpay" placeholder="Name">
                        @if($errors->has('name_com'))
                        <small style="color: red;">{{ $errors->first('name_userpay')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" required autocomplete="invoice_number" placeholder="Invoice Number">
                        @if($errors->has('invoice_number'))
                        <small style="color: red;">{{ $errors->first('invoice_number')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                <select id="type_pay" class="form-control @error('type_pay') is-invalid @enderror" name="type_pay" data-old="{{ old('type_pay') }}" required>
                </select>

              @if($errors->has('type_pay'))
              <small class="error_register1" style="color: red;">{{ $errors->first('type_pay')}}
              </small>
              @endif
              </div>


              <div class="form-group row">
                <select id="method_pay" class="form-control @error('method_pay') is-invalid @enderror" name="method_pay" data-old="{{ old('method_pay') }}" required>
                </select>

              @if($errors->has('method_pay'))
              <small class="error_register1" style="color: red;">{{ $errors->first('method_pay')}}
              </small>
              @endif
              </div>

              <div class="form-group row">
                        <input id="bank_receiver" type="text" class="form-control @error('bank_receiver') is-invalid @enderror" name="bank_receiver" value="{{ old('bank_receiver') }}" required autocomplete="bank_receiver" placeholder="Bank Receivers">
                        @if($errors->has('bank_receiver'))
                        <small style="color: red;">{{ $errors->first('bank_receiver')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="name_receiver" type="text" class="form-control @error('name_receiver') is-invalid @enderror" name="name_receiver" value="{{ old('name_receiver') }}" required autocomplete="name_receiver" placeholder="Name Receivers">
                        @if($errors->has('name_receiver'))
                        <small style="color: red;">{{ $errors->first('name_receiver')}}</small>
                        @endif
              </div>

                <div class="form-group row">
                        <input id="nominal_payment1" type="text" class="form-control @error('nominal_payment1') is-invalid @enderror" value="{{ old('nominal_payment1') }}" required autocomplete="nominal_payment1" placeholder="Nominal Payment">

                        <input id="nominal_payment" type="text" class="form-control @error('nominal_payment') is-invalid @enderror" name="nominal_payment" value="{{ old('nominal_payment') }}" required autocomplete="nominal_payment" placeholder="Nominal Payment">
                        @if($errors->has('nominal_payment'))
                        <small style="color: red;">{{ $errors->first('nominal_payment')}}</small>
                        @endif
              </div>

               <div class="form-group row">
               <div class="custom-file">
                            <input type="file" class="custom-file-input form-control @error('file_payment') is-invalid @enderror" name="file_payment" value="{{ old('file_payment') }}" required autocomplete="file_payment" id="file_payment" required>
                            <label class="custom-file-label" for="file_payment" style="text-align: left;">Choose file</label>
                            @if($errors->has('file_payment'))
                           
                            <small style="color: red;">Extension is <i>.jpg / .jpeg / .PDF</i></small>
                            @endif
              </div>
            </div>

        <button type="submit" id="submit" class="btn btn-success" style="border-radius: 8px; margin-bottom: 0.5em; margin-top: 0.5em">Choose</button>
       </form>
    </div>
  </div>

  <!--    <button type="button" class="btn btn-primary btn-lg" style="border-radius: 7px;margin-top: 0.5em;"  data-toggle="modal" data-target="#mdl-confrim-payment">Choose</button>

<div class="modal fade" id="mdl-confrim-payment" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content" style="width: 95%;">
    <div class="modal-header customwika" style="margin-bottom: -30px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
       <center>
       	<img src="" class="rounded-circle img-fluid" style="width: 38%; height: auto;">
       	<h4 style="font-size: 20px;">Payment title</h4>
        <br>
         <form method="POST" id="form_registerfirst_admin" action="{{route('adminconfirmpay')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group row">
                        <input id="name_userpay" type="text" class="form-control @error('name_userpay') is-invalid @enderror" name="name_userpay" value="{{ old('name_userpay') }}" required autocomplete="name_userpay" placeholder="Name">
                        @if($errors->has('name_com'))
                        <small style="color: red;">{{ $errors->first('name_userpay')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" required autocomplete="invoice_number" placeholder="Invoice Number">
                        @if($errors->has('invoice_number'))
                        <small style="color: red;">{{ $errors->first('invoice_number')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                <select id="type_pay" class="form-control @error('type_pay') is-invalid @enderror" name="type_pay" data-old="{{ old('type_pay') }}" required>
                </select>

                        <input id="payment_method" type="text" class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" value="{{ old('payment_method') }}" required autocomplete="payment_method" placeholder="Payment Method">
                        @if($errors->has('payment_method'))
                        <small style="color: red;">{{ $errors->first('payment_method')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="bank_receiver" type="text" class="form-control @error('bank_receiver') is-invalid @enderror" name="bank_receiver" value="{{ old('bank_receiver') }}" required autocomplete="bank_receiver" placeholder="Bank Receivers">
                        @if($errors->has('bank_receiver'))
                        <small style="color: red;">{{ $errors->first('bank_receiver')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="name_receiver" type="text" class="form-control @error('name_receiver') is-invalid @enderror" name="name_receiver" value="{{ old('name_receiver') }}" required autocomplete="name_receiver" placeholder="Name Receivers">
                        @if($errors->has('name_receiver'))
                        <small style="color: red;">{{ $errors->first('name_receiver')}}</small>
                        @endif
              </div>

                <div class="form-group row">
                        <input id="nominal_payment1" type="text" class="form-control @error('nominal_payment1') is-invalid @enderror" name="nominal_payment1" value="{{ old('nominal_payment1') }}" required autocomplete="nominal_payment1" placeholder="Nominal Payment">
                        @if($errors->has('nominal_payment1'))
                        <small style="color: red;">{{ $errors->first('nominal_payment1')}}</small>
                        @endif
              </div>

               <div class="form-group row">
               <div class="custom-file">
                            <input type="file" class="custom-file-input form-control @error('file_payment') is-invalid @enderror" name="file_payment" value="{{ old('file_payment') }}" required autocomplete="file_payment" id="file_payment" required>
                            <label class="custom-file-label" for="file_payment" style="text-align: left;">Choose file</label>
                            @if($errors->has('file_payment'))
                           
                            <small style="color: red;">Extension is <i>.jpg / .jpeg / .PDF</i></small>
                            @endif
              </div>
            </div>

       	<button type="submit" id="submit" class="btn btn-success" style="border-radius: 8px; margin-bottom: 0.5em; margin-top: 0.5em">Choose</button>
       </form>
       </center>
     </div>
      </div>
    </div>
  </div>
</div> -->

</center>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
get_tipepay();

});

var nominal = document.getElementById('nominal_payment1');
nominal.addEventListener('keyup', function(e){ 
  nominal.value = formatRupiah(this.value, 'Rp ');
});



$('#type_pay').change(function() {    
    var itempilih = this.value;
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_carapay",
    type: "POST",
    data:{
    "id": itempilih,
    },
    dataType: "json",
    success: function (hasil) {
      // console.log(hasil);
      $('#method_pay').empty();
      $('#method_pay').append("<option disabled> Choose Payment Method</option>");
      

    if (hasil.success == true) {
      var data = hasil.data; 

      for (var i = data.length - 1; i >= 0; i--) {
        $('#method_pay').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].payment_title, "</option>"));
      } 

      //Short Function Ascending//
      $("#method_pay").html($('#method_pay option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));

      $("#method_pay").get(0).selectedIndex = 0; 
    }

     const OldValue = '{{old('method_pay')}}';
    
    if(OldValue !== '') {
      $('#method_pay').val(OldValue);
    }

    },error: function (error) {
      console.log("Cant Show list payment method"+ error);

    },
});
  });


//dropdown payment method
function get_tipepay() {  
$('#method_pay').append("<option disabled>Please Choose Payment Type First</option>");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_tipepay",
    type: "POST",
    dataType: "json",
    success: function (hasil) {
      // console.log(hasil.data);

      $('#type_pay').empty();
      $('#type_pay').append("<option disabled>Choose Payment Type</option>");

    if (hasil.success == true) {
      var data = hasil.data; 

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_pay').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].payment_title, "</option>"));
      } 

      //Short Function Ascending//
      $("#type_pay").html($('#type_pay option').sort(function (x, y) {
        return $(y).val() < $(x).val() ? -1 : 1;
      }));

      $("#type_pay").get(0).selectedIndex = 0; 
    }

     const OldValue = '{{old('type_pay')}}';
    
    if(OldValue !== '') {
      $('#type_pay').val(OldValue);
    }

    },error: function (error) {
      console.log("Cant Show list payment type"+ error);

    },
});
} //endfunction



var idku = $('#id_pop_payment').val();
//showfile name upload icon
$('#file_payment').on('change', function () {
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
