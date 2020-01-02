@extends('layout.app')

@section('content')
<div class="container">
	<center>
		<h1 style="margin-top: 1.3em; margin-bottom: 1em;" lang="en">Choose payment method !</h1>


@foreach($dt_payment as $dt)
<div class="card" style="margin-bottom: 1em; width: 40%; border-radius: 20px;">
  <div class="card-body sespay{{ $dt['id'] }}" style="padding: 0.5rem;">
    <form method="POST" id="form_pay_admin" action="{{route('ReviewFinal')}}">
      {{ csrf_field() }}
  <div class="row">
    <div class="col-sm-4" style="text-align: center;">
     <img src="http://21.0.0.108:2312{{ $dt['icon'] }}"  class="rounded-circle img-fluid img-feature-pay">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="id_pay_method" id="id_pay_method" value="{{ $dt['id'] }}">
   </div>
    <div class="col-sm-2">
       <button type="button" class="btn btn-light btn-sm" value="{{ $dt['id'] }}" onclick="get_iddetail(this.value)" style="border-radius: 7px;margin-top: 0.5em;" data-toggle="modal" data-target="#mdl-detail-payment{{ $dt['id'] }}" lang="en">Details</button>
    </div>
    <div class="col-sm-3" style="text-align: center;">
     <button type="submit" id="pilihpay" class="btn btn-primary btn-sm" style="border-radius: 7px;margin-top: 0.5em;" lang="en">Choose</button>
    </div>
  </div>
</form>
  </div>
</div>

<!-- /// modal detail payment /// -->
<div class="modal fade mdl mdl-dtlpay" id="mdl-detail-payment{{ $dt['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm mdl-dtlpay" role="document">
    <div class="modal-content" style="width: 70%;">
    <div class="modal-header customwika" style="margin-bottom: -30px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <center>
        <img src="http://21.0.0.108:2312{{ $dt['icon'] }}" class="rounded-circle img-fluid img-feature-pay"" class="rounded-circle img-fluid" style="width: 38%; height: auto;">
        <p style="font-size: 20px;" id="judul_pay{{ $dt['id'] }}"></p>
        <div class ="rcorners">
          <span id="nama_bankpay{{ $dt['id'] }}"></span>
          <br>
           <span id="nama_ownerpay{{ $dt['id'] }}"></span>
            <span></span>
        </div>
        <button type="button" value="{{ $dt['id'] }}" onclick="pilihpayment(this)" class="btn btn-success btn-sm" style="border-radius: 8px; margin-bottom: 1em;" lang="en">Choose</button>
       </center>
      </div>
    </div>
  </div>
</div>
@endforeach




<button type="button" class="btn btn-light" style="margin-top: 1.5em;" onclick="window.location.href='/admin/pricing'" lang="en">back</button>

<p style="margin-top: 3em; margin-bottom: 2em;">
  <span lang="en">
	For further information please read our </span><a href="" lang="en" data-lang-token="terms">terms & agreement</a>
</p>
</center>
</div>

@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function() {
get_session_pay();
  });


function pilihpayment(id_payment) { 
  var idp = id_payment.value;
   $("#form_pay_admin").submit();
  
}

  function get_iddetail(id_detail){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/getDetailPay',
      data: {'payment_id': id_detail},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {

      var html ='';
    
 $.each(result.data, function(i,item){
 $("#tes1").html(item.payment_account);
  $("#judul_pay"+id_detail).html(item.payment_account);
  $("#nama_bankpay"+id_detail).html(item.payment_bank_name);
  $("#nama_ownerpay"+id_detail).html(item.payment_owner_name);

   $("#mdl-detail-payment"+id_detail).show();
});

      },
      error: function (result) {
        console.log("Cant Reach Data Id Detail Payment");
      }
      });

  }


  function get_session_pay(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_payadmin',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);

        $(".sespay"+result).css("box-shadow", "0 0 15px yellow");
        $(".sespay"+result).css('border-radius', '20px');
        },
      error: function (result) {
        console.log("Cant Reach Session Payment");
    }
});
}

</script>
@endsection
