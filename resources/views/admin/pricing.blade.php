@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>
<img src="/visual/vs-pricing.png" id="shadow-pricing">
<a href="/admin/register2">
<img border="0"  src="/visual/left-arrow.png" id="left-arrowregis">
</a><a href="/admin/register2" class="clight backarrow">Back to Register</a>

<div class="container mg-pricing">
<div class="row">
  <div class="col-5">
  <h4 class="cgrey" lang="en">Choose your plan</h4>
  <p class="cgrey2" lang="en">Our Community Administrators are on their way to approve your account, please check our email!</p>
  </div>

  <div class="col"></div>

  <div class="col-5" style="padding-left: 3em;">
    <div class="btn-group btn-group-lg btn_time_pricingq" role="group">
      <button type="button" class="btn btn-oren1 timeprice active"  onclick="setIdTimePricing(this.value)" id="time-pricing1" value="1" lang="en">Onetime</button>

      <button type="button" class="btn btn-oren2 timeprice"  onclick="setIdTimePricing(this.value)" id="time-pricing2" value="2" lang="en">Monthly</button>

      <button type="button" class="btn btn-oren3 timeprice"  onclick="setIdTimePricing(this.value)" id="time-pricing3" value="3" lang="en">Annual</button>
    </div>
</div>
</div>

<div class="row price-ajax" id="tempat-price">


</div>
</div>


@endsection


@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
get_pricing();
});

var id_fitur="";
var isi =""; 
// $("#time-pricing1" ).click(function() {
//   $( "#tampung_idtime").value(this.value);
// });

function cekawalpricing(){
  var tampung =  $(".isitime").val();

if(tampung === ""){
 $(".price-ajax").hide();
 $("#time-pricing1").removeClass( "active" );
 $("#time-pricing2").removeClass( "active" );
 $("#time-pricing3").removeClass( "active" );
 $(".hidetime1").hide();
 $(".hidetime2").hide();
 $(".hidetime3").hide();
}

}


function setIdTimePricing(idtime) {
  $(".price-ajax").fadeIn(900);
  $( ".isitime").val(idtime);
  idtime1 = idtime;

 if(idtime === "1"){
 $("#time-pricing1").addClass( "active" );
 $("#time-pricing2").removeClass( "active" );
 $("#time-pricing3").removeClass( "active" );
 $(".hidetime1").fadeIn(500);
 $(".hidetime2").hide();
 $(".hidetime3").hide();
  }else if(idtime === "2"){
 $("#time-pricing1").removeClass( "active" );
 $("#time-pricing2").addClass( "active" );
 $("#time-pricing3").removeClass( "active" );
 $(".hidetime1").hide();
 $(".hidetime2").fadeIn(500);
 $(".hidetime3").hide();
  }else{
  $("#time-pricing1").removeClass( "active" );
 $("#time-pricing2").removeClass( "active" );
 $("#time-pricing3").addClass( "active" );
 $(".hidetime1").hide();
 $(".hidetime2").hide();
 $(".hidetime3").fadeIn(500);
  }
}

//dropdown get jenis komunitas
function get_pricing() {     
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_pricing_com",
    type: "POST",
    dataType: "json",
    success: function (status, code, data) {
    // console.log(status.data);
    var html ='';
    
 $.each(status.data, function(i,item){
  var id_fitur = item.feature_type.id;
  var idprice = item.id;

html += '<div class="col-sm-4">'+
        '<div class="card cd-pricing pricing'+idprice+'">'+
          '<div class="card-body">'+
          '<center>'+
          '<h4 class="card-title h4" style="margin-top: 0.5em;">'+ item.title +'</h4>'+
          '<img src="'+server_cdn+item.icon+'"  class="rounded-circle img-fluid imgprice">'+
        '<div class="hidetime1">'+
          '<sup class="cgrey" style="font-size: 30px;">'+
            '<small class="h6">IDR</small></sup>'+
          '<label class="card-harga cgrey">'+
            '<strong>'+ rupiah(item.grand_pricing) +'</strong></label>'+
          '<small class="clight"> /Once</small>'+
        '</div>'+
        '<div class="hidetime2">'+
          '<sup class="cgrey" style="font-size: 30px;">'+
            '<small class="h6">IDR</small></sup>'+
          '<label class="card-harga cgrey">'+
            '<strong> '+ rupiah(item.price_monthly) +'</strong></label>'+
          '<small class="clight"> /Month</small>'+
        '</div>'+
        '<div class="hidetime3">'+
          '<sup class="cgrey" style="font-size: 30px;">'+
            '<small class="h6">IDR</small></sup>'+
          '<label class="card-harga cgrey">'+
            '<strong>'+ rupiah(item.price_annual) +'</strong></label>'+
          '<small class="clight"> /Year</small>'+
        '</div>'+
      '<label class="coren s15 ">or choose another pricing time</label>'+
      '<form method="POST" action="{{route('pricingkefitur')}}"> {{ csrf_field() }}<input type="hidden" name="idprice" value="'+idprice+'">'+
        '<input type="hidden" name="feature_type_id" value="'+id_fitur+'">'+
        '<input type="hidden" name="payment_time" class="isitime" value="">'+
      '<button type="submit" class="btn clr-oren klik-pricing" style="margin-top: 0.5em;">Get Now</button>'+
      '</form>'+
      '</center>'+
      '<h6 class="cgrey" style="margin-top:0.6em;">Package Include</h6>'+
      '<small>'+
        '<li class="cgrey2">Feature Untitle 1</li>'+
        '<li class="cgrey2">Feature Untitle 2</li>'+
        '<li class="cgrey2">Feature Untitle 3</li>'+
      '</small></div></div></div>';
});
 $('.price-ajax').html(html);
 cekawalpricing();
 get_session_pricing();
  }
});
} 



function get_session_pricing(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_pricing',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
        if(result != ""){
        var idtime = result.payment_time;
$(".price-ajax").fadeIn(900); 
$("#time-pricing"+idtime).css('font-weight', 'bold');
$("#time-pricing"+idtime).css('color', '#2b4690');
$(".pricing"+result.pricing_id).css("box-shadow", "0 0 20px yellow");
$(".isitime").val(idtime);

 if(idtime === "1"){
 $("#time-pricing1").addClass( "active" );
 $("#time-pricing2").removeClass( "active" );
 $("#time-pricing3").removeClass( "active" );
 $(".hidetime1").fadeIn();
 $(".hidetime2").hide();
 $(".hidetime3").hide();
  }else if(idtime === "2"){
 $("#time-pricing1").removeClass( "active" );
 $("#time-pricing2").addClass( "active" );
 $("#time-pricing3").removeClass( "active" );
 $(".hidetime1").hide();
 $(".hidetime2").fadeIn();
 $(".hidetime3").hide();
  }else{
  $("#time-pricing1").removeClass( "active" );
 $("#time-pricing2").removeClass( "active" );
 $("#time-pricing3").addClass( "active" );
 $(".hidetime1").hide();
 $(".hidetime2").hide();
 $(".hidetime3").fadeIn();
  }
}
        },
      error: function (result) {
        console.log("Cant Reach Session Pricing");
    }
});
}
</script>
@endsection
