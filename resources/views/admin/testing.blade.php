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
<button type="button" class="btn btn-orenline active col-4 btn-sm" value="{{ $dt['id'] }}" onclick="getmethod_payment(this.value);">
  <i class="fa fa-exchange "></i> 
&nbsp; {{ $dt['payment_title'] }}</button>
&nbsp;
@endforeach

</div>
<div class="col-5">
<h6 class="h6 cgrey1" id="txt_paymethod">Bank Transfer</h6>
<br>
<!-- //tes -->

<div class="collapse-accordion" id="accordion2" role="tablist" aria-multiselectable="true">

  <div class="card">
    <div class="card-header" role="tab" id="headingOne1">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
          <span class="float-right">Click me</span>

        </a>
      </h5>
    </div>

    <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="headingOne2">
      <div class="card-block">
        1 We have a downloads section and we're trying to track when a user downloads something. The downloads are linked as followed:
      </div>
    </div>
  </div>
  <br>

  <div class="card">
    <div class="card-header" role="tab" id="headingTwo2">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
          Collapsible Group Item #2
                  <span class="float-right">Click me</span>

        </a>
      </h5>
    </div>
    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2">
      <div class="card-block">
        2 We have a downloads section and we're trying to track when a user downloads something. The downloads are linked as followed:
      </div>
    </div>
  </div>
  <br>


  <div class="card">
    <div class="card-header" role="tab" id="headingThree2">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
          Collapsible Group Item #3 
                  <span class="float-right">Click me</span>

        </a>
      </h5>
    </div>
    <div id="collapseThree2" class="collapse" role="tabpanel" aria-labelledby="headingThree2">
      <div class="card-block">
       3 We have a downloads section and we're trying to track when a user downloads something. The downloads are linked as followed:
      </div>
    </div>
  </div>
  <br>

</div>
<!-- //endtes -->

<button type="submit" class="btn btn-oren" style="width: 150px; margin-top:2em;" lang="en">Finish</button>

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

});


function getmethod_payment(val){

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
      console.log(result.data);
      },
      error: function (result) {
       console.log("Cant get data payment method");
      }, 
      complete: function(result){
         $('#mdl-loadingajax').modal('hide');
      }
      });

}

</script>
@endsection
