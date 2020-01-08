@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="">
<img border="0"  src="/visual/left-arrow.png" id="left-arrowregis">
</a><a href="" class="clight backarrow">Back to Features</a>

<div class="contain-pay">
<h3 class="cgrey" lang="en">Payment Method</h3>

<div class="row">
<div class="col-6">
<h6 class="h6 cgrey1" style="margin-bottom: 1em;">Choose Payment Method</h6>

@foreach(Session::get('pay_type') as $dt)
<button type="button" class="btn btn-orenline col-4 btn-sm" value="{{ $dt['id'] }}" onclick="getmethod_payment(this);">
  <i class="fa fa-exchange "></i> 
&nbsp; {{ $dt['payment_title'] }}</button>
&nbsp;
@endforeach

</div>
<div class="col-5" id="showhide_pay" style="display: none;">
<h6 class="h6 cgrey1" id="txt_paymethod">Bank Transfer</h6>
<br>
<!-- //tes -->

<form method="POST" id="form_pay_admin" action="{{route('ReviewFinal')}}">{{ csrf_field() }}

<div class="collapse-accordion" id="list_paymentmethod" role="tablist" aria-multiselectable="true">
<!-- isi card -->
</div>

<input type="hidden" name="id_pay_method" id="id_pay_method">
<button type="submit" class="btn btn-oren"  id="btn_pay_next" style="width: 150px; margin-top:1em;" lang="en">Finish</button>
</form>

</div>
</div>




<div class="footer-admin">
<div class="row" style="margin-top: 1em;">
  <div class="col">
    <img src="/visual/commjuction.png" id="com_superadminlogin">
    <div class="textfooter-kiri">
    <a href="" class="cgrey"><small>Privacy Police</small></a>
    &nbsp; &nbsp; &nbsp; &nbsp;
    <a href="" class="cgrey"><small>Terms and Condition</small></a>
  </div>
  </div>

  <div class="col textfooter-kanan">
    <a href="" class="cgrey h6 s13">Documentation</a>
    <span class="fa fa-circle" aria-hidden="true" style="color: #D96120;"></span>
    &nbsp; &nbsp; &nbsp; &nbsp;
    <a href="" class="cgrey h6 s13">Support</a>
    <span class="fa fa-question" aria-hidden="true" style="color: #D96120;"></span>
  </div>
</div>
</div>


<!-- MODAL LOADING AJAX -->
<div class="modal fade bd-example-modal-sm" id="mdl-loadingajax" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content loadingq">
    <center>
    <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
    <span class="sr-only">Loading...</span>
  </div>
<p class="h6 iniloading">Loading . . .</p>
  <center>
    </div>
  </div>
</div>
<!-- END-MODAL -->
@endsection


@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
validasi_pay_next();

});

function pilihpay(idpay){
  // alert(idpay);
  $("#id_pay_method").val(idpay);
  $(".border-oren").removeClass("active");
  $("#cardpay"+idpay).addClass("active");
  $("#btn_pay_next").removeAttr("disabled");


}


function getmethod_payment(ini){
$('.btn-orenline').removeClass('active');
$(ini).addClass('active');
var val = ini.value;
$('#mdl-loadingajax').modal('hide');

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      url: '/getpayment_method',
      data: {'payment_type_id': val},
      type: 'POST',
      datatype: 'JSON',
      beforeSend: function(){
        $('#mdl-loadingajax').modal('show');
      },
      success: function (result) {
        $("#showhide_pay").css("display", "block");
        // $('#mdl-loadingajax').modal('hide');
        setTimeout(function() { $('#mdl-loadingajax').modal('hide'); }, 4000);
        validasi_pay_next();


      var html ='';
      var text ='';

        $.each(result.data, function(i,item){
          var isitext ='';

        $.each(item.description, function(x,isides){
          isitext +='<li>'+isides+'</li>';
        });
        // console.log(i , isitext)

        html += 
        '<div class="card border-oren" id="cardpay'+item.id+'">'+
    '<div class="card-header" role="tab">'+
      '<h6 class="mb-0 pdb1">'+
        '<a data-toggle="collapse" data-parent="#list_paymentmethod" href="#collapseOne'+item.id+'" onclick="pilihpay('+item.id+');" aria-expanded="true" aria-controls="collapseOne'+item.id+'">'+
          '<img src="'+server_cdn+item.icon+'" style="width: 10%; height: auto;"> &nbsp; &nbsp;'+ item.payment_title+
          '<span class="float-right">'+
            '<i class="fa fa-chevron-right"></i>'+
          '</span>'+
        '</a></h6></div>'+
    '<div id="collapseOne'+item.id+'" class="collapse" role="tabpanel" aria-labelledby="headingOne2">'+
      '<div class="card-block"><ul>'+ isitext +
      '</ul></div></div></div><br>';

        });

      $('#list_paymentmethod').html(html);

      },
      error: function (result) {
       console.log("Cant get data payment method");
       $('#mdl-loadingajax').modal('hide');
      }, 
      complete: function(result){
         $('#mdl-loadingajax').modal('hide');
      }
      });

}



function validasi_pay_next(){
  $("#id_pay_method").val("");
  var idpay =  $("#id_pay_method").val();
  if( idpay == ""){
  $("#btn_pay_next").attr("disabled", true);
  }else{
  $("#btn_pay_next").removeAttr("disabled");
  }
}

</script>
@endsection
