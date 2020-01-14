@extends('layout.app')

@section('content')
<div class="container">
	<center>
		<h1 style="margin-top: 1.3em; margin-bottom: 1em;">Please Confirm your Regsitrasion !</h1>
</center>
<br>
<div class="row">
  <div class="col-4">

 <div id="in_num">
  <label class="h6 cgrey">INVOICE NUMBER</label>
  <input id="invoice_number" class="form-control" type="text"  name="invoice_number" value="{{ old('invoice_number') }}" required>

<button class="btn btn-oren" onclick="get_invoice_num($('#invoice_number').val())" style="text-align: left;margin-top: 0.5em;">Cek</button>  
</div>

     <form method="POST" id="form_registerfirst_admin" action="{{route('adminconfirmpay')}}" enctype="multipart/form-data">
                {{ csrf_field() }}


              <div class="form-group row">
                        <input id="name_userpay" type="text" class="form-control @error('name_userpay') is-invalid @enderror" name="name_userpay" value="{{ old('name_userpay') }}" required autocomplete="name_userpay" placeholder="Name">
                        @if($errors->has('name_com'))
                        <small style="color: red;">{{ $errors->first('name_userpay')}}</small>
                        @endif
              </div>

             

              <div class="form-group row">
                <select disabled id="type_pay" class="form-control @error('type_pay') is-invalid @enderror" name="type_pay" data-old="{{ old('type_pay') }}" required>
                </select>

              @if($errors->has('type_pay'))
              <small class="error_register1" style="color: red;">{{ $errors->first('type_pay')}}
              </small>
              @endif
              </div>


              <div class="form-group row">
                <select disabled id="method_pay" class="form-control @error('method_pay') is-invalid @enderror" name="method_pay" data-old="{{ old('method_pay') }}" required>
                </select>

              @if($errors->has('method_pay'))
              <small class="error_register1" style="color: red;">{{ $errors->first('method_pay')}}
              </small>
              @endif
              </div>

              <div class="form-group row">
                        <input id="bank_receiver" type="text" class="form-control @error('bank_receiver') is-invalid @enderror" name="bank_receiver" value="{{ old('bank_receiver') }}" required disabled autocomplete="bank_receiver" placeholder="Bank Receivers">
                        @if($errors->has('bank_receiver'))
                        <small style="color: red;">{{ $errors->first('bank_receiver')}}</small>
                        @endif
              </div>

              <div class="form-group row">
                        <input id="name_receiver" type="text" class="form-control @error('name_receiver') is-invalid @enderror" name="name_receiver" value="{{ old('name_receiver') }}" required disabled autocomplete="name_receiver" placeholder="Name Receivers">
                        @if($errors->has('name_receiver'))
                        <small style="color: red;">{{ $errors->first('name_receiver')}}</small>
                        @endif
              </div>

                <div class="form-group row">
                        <input id="nominal_payment1" type="text" class="form-control @error('nominal_payment1') is-invalid @enderror" value="{{ old('nominal_payment1') }}" required disabled autocomplete="nominal_payment1" placeholder="Nominal Payment">

                        <input id="nominal_payment" type="hidden" class="form-control @error('nominal_payment') is-invalid @enderror" name="nominal_payment" value="{{ old('nominal_payment') }}" required disabled autocomplete="nominal_payment" placeholder="Nominal Payment">
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
  </div>


</center>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
  $("#form_registerfirst_admin").css("display", "none");


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
        $("#form_registerfirst_admin").css("display", "block");
        $("#in_num").hide();
        console.log(isi);
         swal(result.message);

         get_tipepay(isi.payment_type_id);
         get_carapay(isi.payment_type_id, isi.payment_method_id);

         $("#nominal_payment1").val(rupiah(isi.payment_total));
         $("#nominal_payment").val(isi.payment_total);
         $("#bank_receiver").val(isi.payment_bank_name);
         $("#name_receiver").val(isi.payment_owner_name);

      
      },
      error: function (result) {
        console.log("Cant invoice number");
      
      }
      });

  }




var nominal = document.getElementById('nominal_payment1');
nominal.addEventListener('keyup', function(e){ 
  nominal.value = formatRupiah(this.value, 'Rp ');
});


function get_carapay(idku,set){
// $('#type_pay').change(function() {    
//     var idku = this.value;
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_carapay",
    type: "POST",
    data:{
    "id": idku,
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
    $('select[name="method_pay"]').val(set);

    },error: function (error) {
      console.log("Cant Show list payment method"+ error);

    },
});
  // });
}


//dropdown payment method
function get_tipepay(id) {  
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

    $('select[name="type_pay"]').val(id);

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
