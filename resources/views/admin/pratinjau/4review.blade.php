 <div class="container">
<div class="row" style="margin-right: 0.5em; margin-left: 0.5em;">

<dl class="row" style="margin-top: 2em; ">
  <dt class="col-sm-4 editk" lang="en">Pricing Time</dt>
  <dd class="col-sm-8 editk">
  	<div id="pricingtime">
  		@if ($dt["payment"]["payment_time"]  === '1')
  		<div lang="en">Onetime</div>
  		@elseif ($dt["payment"]["payment_time"] === '2')
  		<div lang="en">Monthly</div>
  		@else
  		<div lang="en">Annual</div>
  		@endif
  	</div>
  </dd>


  <dt class="col-sm-4 editk" lang="en">Preferred Price</dt>
  <dd class="col-sm-8 editk">
  <p class="cus" id="judulprice"></p>
  <p class="cus" id="deskriprice"></p>
  <span id="hargaprice"></span>
  <small id="satuanwaktu" style="color: #2d99f7;"></small>
  </dd>


  <dt class="col-sm-4 editk" lang="en">Payment Method</dt>
  <dd class="col-sm-8 editk">
    <dl class="row">
      <dt class="col-sm-4" lang="en" style="color: grey;">Title</dt>
      <dd class="col-sm-8">
      	<div id="judulpay"></div>
      </dd>

      <dt class="col-sm-4" lang="en" style="color: grey;">Description</dt>
      <dd class="col-sm-8">
      	<div id="despay"></div>
      </dd>
    </dl>
    <img id="imgpaymentr" style="width: 20%; height: auto; margin-top: -1em;">
  </dd>

</dl>
</div>
</div>