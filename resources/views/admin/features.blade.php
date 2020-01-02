@extends('layout.app')

@section('content')
<nav class="navbar nav-oren">
</nav>
<img src="/visual/vs-pricing.png" id="shadow-fiturq">
 <form method="POST" id="form_idfitur" action="{{route('sendfeature')}}">{{ csrf_field() }}

<a href="/admin/pricing">
<img border="0"  src="/visual/left-arrow.png" id="left-arrowregis">
</a><a href="/admin/pricing" class="clight backarrow">Back to Pricing</a>

<div class="mg-pricing">
<!-- @if (Session::has('datafitur')) -->
<div class="row">
  <div class="col-9">
    <h4 class="cgrey h4" style="margin-bottom: 0.5em;">Choose Your Features</h4>
@if (Session::has('idaddfitur'))
<input type="hidden" name="idaddfitur" id="idaddfitur" value="{{ Session::get('idaddfitur') }}">
@endif

<div class="row">
 @foreach(Session::get('datafitur') as $newdata)
<div class="col-3">
    <div class="card" style="width: 10rem; height: 10.5rem; margin-top: 1em;">
  <div class="card-body" style="padding: 1em !important;">
  <div class="roundcheck">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur{{ $newdata['id'] }}"  value=" {{ $newdata['id'] }}"/>
    <label for="fitur{{ $newdata['id'] }}"></label>
  </div>
  <center>
    <img class="rounded-circle img-fluid" src="{{ env('CDN').$newdata['logo'] }}" style="width: 45px; margin-bottom: 0.5em;">
    <h6 class="cgrey">{{ $newdata['title'] }}</h6>
    <small class="clight">{{ $newdata['description'] }}</small>
  </center>
  <div class="detail-fiturq">
  <a href="/admin/features_detail/{{ $newdata['id'] }}">
    <small lang="en" class="txt_detail_fitur h6 s13"> More detail
   <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
 </div>
  </div>
</div>
</div>
@endforeach



</div> <!-- end-row -->


  </div> <!-- end-col 10 -->

  <div class="col-3">
    <h4 class="cgrey h4" style="margin-bottom: 0.5em;">Popular</h4>
    <div class="row">
      <div class="col-3">
        <center>
        <img src="/visual/img-fitur-default.png" class="rounded-circle img-fluid"  style="width: 45px; height: auto;"></center>
      </div>
      <div class="col">
        <h6 class="clight s15" style="margin-top: 0.5em;">Name Featured</h6>
      </div>
    </div>


    <div class="row">
      <div class="col-3">
        <center>
        <img src="/visual/img-fitur-default.png" class="rounded-circle img-fluid"  style="width: 45px; height: auto;"></center>
      </div>
      <div class="col">
        <h6 class="clight s15" style="margin-top: 0.5em;">Name Featured</h6>
      </div>
    </div>
  </div>
</div>
<br>
<!-- <div class="row"> -->
<center>

 <span class="cgrey1 s16">
 <span id="hitungcentang"> 0 </span>
  / {{count($newdata)}} &nbsp; Feature Selected </span>

<button type="submit" id="next_pilihfitur" class="btn btn-oren s14 btn-md btn-block">Next</button>
</center>

<!-- @endif -->
</div>
</form>

@endsection

@section('script')
<script type="text/javascript">
var cdn = '{{env("CDN")}}';  

$(document).ready(function () {
get_session_fitur();

});



function get_session_fitur(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_fitur',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
var idaddfitur = $("#idaddfitur").val();

if(idaddfitur != ""){
$('#fitur'+idaddfitur).prop('checked', 'checked');
}

        for(var i=0; i<result.length; i++){
  $('#fitur'+result[i]).prop('checked', 'checked');
}
 var ceklis = $('input[type="checkbox"]:checked').length;

      if($(this).is(':checked')){
        $("#hitungcentang").text(ceklis);
        $("#next_pilihfitur").removeAttr("disabled");
      }else{
        if(ceklis == 0){
          $("#next_pilihfitur").attr("disabled", true);
        }
         $("#hitungcentang").text(ceklis);
      }
      },
      error: function (result) {
        console.log("Cant Reach Session Pricing");
    }
});
}



$('.boxfitur').click(function(){  
 var ceklis = $('input[type="checkbox"]:checked').length;

      if($(this).is(':checked')){
        $("#hitungcentang").text(ceklis);
        $("#next_pilihfitur").removeAttr("disabled");
      }else{
        if(ceklis == 0){
          $("#next_pilihfitur").attr("disabled", true);
        }
         $("#hitungcentang").text(ceklis);
      }
    });

</script>
@endsection
