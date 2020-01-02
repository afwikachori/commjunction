@extends('layout.app')

@section('content')
<div class="container">
	<center>
		<h1 style="margin-top: 1.3em; margin-bottom: 1em;">Please Confirm your Regsitrasion !</h1>

     <button type="button" class="btn btn-primary btn-lg" style="border-radius: 7px;margin-top: 0.5em;"  data-toggle="modal" data-target="#mdl-confrim-payment">Choose</button>

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
       	<p style="font-size: 20px;">payment title</p>

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
       </center>
     </div>
      </div>
    </div>
  </div>
</div>

</center>
</div>

@endsection

@section('script')
<script type="text/javascript">
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

//https://appdividend.com/2018/03/13/laravel-bootstrap-modal-form-validation-tutorial/
// 
// $(document).ready(function(){
//             $('#submit'+idku).click(function(){
//               alert('klik');
//                $.ajaxSetup({
//                   headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                   }
//               });
//                jQuery.ajax({
//                   url: "{{ url('adminconfirmpay') }}",
//                   method: 'post',
//                   data: {
//                      name_userpay: $('#name_userpay').val(),
//                      invoice_number: $('#invoice_number').val(),
//                      payment_method: $('#payment_method').val(),
//                      bank_receiver: $('#bank_receiver').val(),
//                      name_receiver: $('#name_receiver').val(),
//                      nominal_payment: $('#nominal_payment').val(),
//                      id_pop_payment: $('#id_pop_payment').val(),          
//                   },
//                   success: function(result){
//                     if(result.errors)
//                     {
//                       alert('error validation');
//                        $('#mdl-confrim-payment'+idku).modal('show');
//                     }
//                     else
//                     {
//                      alert('bener');
//                     }
//                   }});
//                });
//             });
</script>
@endsection
