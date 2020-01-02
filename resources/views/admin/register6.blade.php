@extends('layout.app')

@section('content')
<div class="container">
<div class="row" style="margin-top: 5%">
    <div class="col-sm-5 hide-judulreview">
    <h1 style="margin-top: 5em;" lang="en">Review your Registration details</h1>

    </div>
    <div class="col-md-7">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="commtab" data-toggle="tab" href="#commtab_isi" role="tab" aria-controls="commtab_isi" aria-selected="true" lang="en" data-lang-token="Community">Community</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="admintab" data-toggle="tab" href="#admintab_isi" role="tab" aria-controls="admintab_isi" aria-selected="false" lang="en" data-lang-token="Administrator">Administrator</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="fiturtab" data-toggle="tab" href="#fiturtab_isi" role="tab" aria-controls="fiturtab_isi" aria-selected="false" lang="en" data-lang-token="">Features</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="paymentab" data-toggle="tab" href="#paymentab_isi" role="tab" aria-controls="paymentab_isi" aria-selected="false" lang="en" data-lang-token="Payment">Payment</a>
  </li>
</ul>



<div class="tab-content">
  @foreach($fadmin as $dt)
<!-- {{ $dt['community']['name'] }} -->
  <div class="tab-pane fade size-review show active" id="commtab_isi" role="tabpanel" aria-labelledby="commtab"><div class="container">
   @include('admin.pratinjau.1review')
  </div></div>
  <div class="tab-pane fade size-review" id="admintab_isi" role="tabpanel" aria-labelledby="admintab"><div class="container">
   @include('admin.pratinjau.2review')
  </div></div>
  <div class="tab-pane fade size-review" id="fiturtab_isi" role="tabpanel" aria-labelledby="fiturtab"><div class="container">
   @include('admin.pratinjau.3review')
  </div></div>
  <div class="tab-pane fade size-review" id="paymentab_isi" role="tabpanel" aria-labelledby="paymentab"><div class="container">
  @include('admin.pratinjau.4review')
  </div></div>
  @endforeach
</div>

<div class="row" style="margin-top: 2em;">
  <div class="col" style="text-align: right;">
  <button type="button" class="btn btn-danger btn-sm" style="border-radius: 10px; margin-bottom: 1em; width: 30%;" onclick="window.location.href='/admin/payment'" lang="en">Edit Data</button>
</div>
<div class="col" style="text-align: left;">
 <form method="POST" id="form_finalregisadmin" action="{{route('FinalAdminRegis')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="finalvariabel" value="123ok">
  <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 10px; margin-bottom: 1em; width: 30%;" lang="en">Submit</button>
</form>
</div>
</div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {

get_jenis();
get_selectedfitur();
get_pricenyid();
get_paybyid();

clickImage("myModal","myImg","img01","caption"); 



});

function showPass() {
  var a = document.getElementById("password_admin");
  var b = document.getElementById("ico-mata");
  if (a.type == "password") {
    a.type = "text";
    b.class = "fa fa-eye-slash";
  } else {
    a.type = "password";
    b.class = "fa fa-eye";
  }
}


//dropdown get jenis komunitas
function get_jenis() {   
var a = '{!! $dt["community"]["jenis_comm_id"] !!}';

if (a === '1'){
  $('#etcjenis').show();
  $('#type_com2').hide();
}else{
  $('#etcjenis').hide();
  $('#type_com2').show();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_jenis_com",
    type: "POST",
    dataType: "json",
    success: function (status, code, data) {
    // console.log(status.data);

    if (status.code== '00') {
      var data = status.data; 

      $('#type_com2').empty();
      $('#type_com2').append("<option disabled> --- </option>");

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_com2').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
      } 
      //Short Function Ascending//
      $("#type_com2").html($('#type_com2 option').sort(function (x, y) {
        return $(x).val() < $(y).val() ? -1 : 1;
      }));

      $("#type_com2").get(0).selectedIndex = 0; //e.preventDefault();
    }
     const OldValue = '{{old('type_com2')}}';
    
    if(OldValue !== '') {
      $('#type_com2').val(OldValue);
    }
    var isijenis = '{!! $dt['community']['jenis_comm_id'] !!}';
    var isirange = '{!! $dt['community']['range_member'] !!}';

     $('select[name="type_com2"]').val(isijenis);
     $('select[name="range_member2"]').val(isirange);

     // showfiturpage();
    }
});
 }
} //endfunction



function get_selectedfitur(){
  var val = '{!! json_encode($dt["feature"]) !!}';
  var listfitur = [JSON.parse(val)] ;

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/getSelectedFitur',
      data: {'id': listfitur},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {

var html ="";

 $.each(result.data, function(i,item){
 html +='<div class="col-sm-3" style="padding-bottom: 1em;">'+
'<center>'+
'<div class="card feature-kotak2">'+
  '<div class="card-body">'+
    '<div class="roundcheck2">'+
    '<input type="checkbox" class="boxfitur" name="feature_id[]" value="'+item.id+'" id="'+item.id+'"/>'+
    '<label for="fitur"></label>'+
  '</div>'+
  '<center>'+
    '<img src="http://21.0.0.108:2312'+item.logo+'"  class="rounded-circle img-fluid img-feature" style="margin-top:0.7em;">'+
    '<br><small>'+item.title+'</small>'+
  '</center>'+
  '</div>'+
'</div>'+
'</center>'+
'</div>';

});
 $("#isinyafitur").html(html);
 $(".boxfitur").prop("checked", true);

      },
      error: function (result) {
        console.log("Cant Show selected features!");
      }
      });

  }



function get_pricenyid(){
  var val = '{!! json_encode($dt["payment"]["pricing_id"]) !!}';
  var listfitur = [JSON.parse(val)] ;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/getSelectedPrice',
      data: {'id': listfitur},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        // console.log(result.data);
      $.each(result.data, function(i,item){
        $("#judulprice").html(item.title);
        $("#deskriprice").html(item.description);
        if({!! $dt["payment"]["payment_time"]!!}  == '1'){
          $("#hargaprice").html(item.grand_pricing);
          $("#satuanwaktu").html("  / Once");
        }else if({!! $dt["payment"]["payment_time"]!!}  == '2'){
          $("#hargaprice").html(item.price_monthly);
          $("#satuanwaktu").html("  / Month");
        }else{
           $("#hargaprice").html(item.price_annual);
           $("#satuanwaktu").html(" / Year");
        } 
        
      });
      },

      error: function (result) {
        console.log("Cant Show selected Pricing!");
      }

});

  }



  function get_paybyid(){
  var val = '{!! json_encode($dt["payment"]["payment_id"]) !!}';
  var idpay = [JSON.parse(val)] ;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/getSelectedPayment',
      data: {'id': idpay},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        // console.log(result.data);
      $.each(result.data, function(i,item){
        $("#judulpay").html(item.payment_title);
        $("#despay").html(item.description);
        var payimg = 'http://21.0.0.108:2312'+item.icon;
      $("#imgpaymentr").attr("src", payimg);
      });
      },

      error: function (result) {
        console.log("Cant Show selected Pricing!");
      }

});

  }





</script>
@endsection
