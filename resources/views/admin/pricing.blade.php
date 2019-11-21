@extends('layout.app')

@section('content')
<button class="btn-round-1" onclick="window.location.href='/admin/register2'"></button>
<div class="container tengahin">
   <center>
<h1 class="judul-pricing">Choose your pricing</h1>
<center>

  <div class="row">
     <div class="col-3">
     </div>
    <div class="col-2">
      <a href="" class="timeharga" id="time-pricing1">
        <b>
        ONE TIME
      </b>
    </a>
    </div>
    <div class="col-2">
      <a href="" class="timeharga" id="time-pricing2">
          <b>
        MONTLY
      </b>
      </a>
    </div>
    <div class="col-2">
      <a href="" class="timeharga" id="time-pricing3">
          <b>
        ANNUAL
      </b>
      </a>
    </div>
      <div class="col-3">
     </div>
  </div>
    <hr>
  
  
</center>
<div class="card-deck price-ajax">
<!-- isi pilihan pricing -->
</div>
</center>
</div> <!-- //container -->
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {
get_pricing();
});
  var id_fitur="";
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

html += '<div class="col-sm-4"><div class="card border-primary mb-3 card-pricing" style="height: auto;"><div class="card-body text-primary"><img src="/pic/project.png" class="rounded-circle img-fluid imgprice"><h3 class="card-title hitam" id="judul_pricing">'+ item.title +'</h3><p class="card-text hitam" id="deskripsi_pricing">'+ item.description +'</p><ul class="list-group list-group-flush"><li class="list-group-item list-pci">Grand Pricing<h4 class="card-title pricing-card-title"> '+ item.grand_pricing +'<small class="text-muted">/ time</small></h4></li></ul><form method="POST" action="{{route('pricingkefitur')}}"> {{ csrf_field() }}<input type="hidden" name="feature_type_id" id="feature_type_id" value="'+id_fitur+'"><button type="submit" class="btn btn-info klik-pricing" style="margin-top: 1em; width: 50%;">Choose</button></form></div></div></div>';
});
 $('.price-ajax').html(html);
  }
});
} //endfunction


</script>
@endsection
