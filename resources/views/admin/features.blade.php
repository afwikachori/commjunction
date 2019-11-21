@extends('layout.app')

@section('content')
<div class="container" style="margin-top: 1em;">
  <form method="POST" id="form_idfitur" action="{{route('sendfeature')}}">{{ csrf_field() }}

  <div class="row">
    <div class="col-2-md">
     <button type="button" class="btn btn-outline-light" onclick="window.location.href = '/admin/pricing'">
     	<span style="color: black; font-size: 19px;">Back</span>
     </button>
    </div>
    <div class="col" style="text-align: right;">
     <span style="font-size: 19px;">Feature Selected &nbsp; <span id="hitungcentang"> 0 </span> / {{count($data)}} </span> 
    </div>
    <div class="col-2-md">
    	<button type="submit" id="next_pilihfitur" class="btn btn-primary btn-md btn-block">Next</button>
    </div>
  </div>
  <!-- ---- -->
 <div class="row">
    <div class="col-sm">
      
    </div>
    <div class="col-md-10">
  <h1 style="margin-top: 0.7em; margin-bottom: 0.7em;">Choose your Feature</h1>

   @foreach($data as $newdata)
    <!-- {{ $newdata['id'] }}
    {{ $newdata['logo'] }}
    {{ $newdata['title'] }}
    {{ $newdata['description'] }} -->
   @endforeach

  <div class="card-deck">

 @foreach($data as $newdata)
   <div class="col-sm-3" style="padding-bottom: 1em;">
    <center>
<div class="card feature-kotak">
  <div class="card-body">
    <div class="roundcheck">
    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur{{ $newdata['id'] }}"  value=" {{ $newdata['id'] }}"/>
    <label for="fitur{{ $newdata['id'] }}"></label>
  </div>
    <img src="http://21.0.0.108:2312{{ $newdata['logo'] }}" class="rounded-circle img-fluid img-feature">
    <h4 class="card-text judul-fitur"> {{ $newdata['title'] }}</h4>
    <a href="#" class="btn btn-primary btn-sm btn-detail-feature" data-toggle="modal" data-target="#mdl_detail_fitur{{ $newdata['id'] }}">Details</a>
  </div>
</div>
</center>
</div>
<br>
@endforeach

</div>
    </div>
    <div class="col-sm">
      
    </div>
  </div>
</form>
</div> <!-- ///end-container -->

 @foreach($data as $dt)
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="mdl_detail_fitur{{ $dt['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="height: 60%;">
      <div class="modal-header customwika">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row" style="margin-top: -25px;">
  <div class="col">
    <center class="popku"><img src="http://21.0.0.108:2312{{ $dt['logo'] }}" class="rounded-circle img-fluid img-feature"></center>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    </div>
  </div>
  <div class="col-md-9 kasihwarna">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">1...</div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">.2..</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">.3..</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">..4.</div>
    </div>
  </div>
</div>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {


});

$('.boxfitur').click(function(){  
  var ceklis = $('input[type="checkbox"]:checked').length;
      if($(this).is(':checked')){
        $("#hitungcentang").text(ceklis);
      }else{
         $("#hitungcentang").text(ceklis);
      }
    });


      $('#next_pilihfitur').click(function(){


        // // alert("klik");
        // var val = [];
        // $(':checkbox:checked').each(function(i){
        //   val[i] = $(this).val();
        //   var myJsonString = JSON.stringify(val[i]);

        //   console.log(myJsonString );
        });
     

// function kirim_idfitur(){
//   $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $.ajax({
//     url: "/get_pricing_com",
//     type: "POST",
//     dataType: "json",
//     success: function (status, code, data) {
//     // console.log(status.data);
   
// });

// }

</script>
@endsection
