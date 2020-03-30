@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-briefcase-upload"></i>
    </span>Publish Preparation</h3>

<nav aria-label="breadcrumb">
   <a href="{{ route('setting_publish_comm') }}" type="button" id="btn_publish_now"
   class="btn btn-tosca btn-sm btn-fw">
   Publish Now</a>
</nav>
</div> <!-- end-page header -->

<div class="row" style="padding-top:2%; padding-right:20%; padding-left:20%;">
 <div class="col-12">
  <div class="card">
    <div class="card-body" style="min-height: 420px; height: auto;">
    <div  id="isi_list_setting">

    </div>
    </div>
  </div>
</div>
</div>


@endsection

@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {
  cek_prepare_publish();

});



// $("#btn_publish_now").click(function () {
//   // alert("terklik");
//   window.location.href = "{{url('/admin/setting_publish_comm')}}"
// });




function cek_prepare_publish(){
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/cek_prepare_publish',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
      console.log(result);
      var isinya = '';
      var sready;

      $.each(result, function(i,item){

        if( item.ready == true){
          sready =  '<small class="cgreen">Ready</small>';
        }else{
           sready =  '<small class="cred">Not Ready</small>';
        }

      isinya += '<div class="row" style="margin-bottom:1em;">'+
        '<div class="col-md-6">'+
        '<h6 class="cdgrey judulcomsetup">'+ item.type +'</h6>'+
        '<small class="clight">'+ item.name +'</small>'+
        '</div>'+
        '<div class="col-md-3" style="text-align:right; margin-top:0.5em;">'+
        sready+
        '</div>'+
        '<div class="col-md-3">'+
        '<button type="button" onclick="listsetting'+i+'()" class="btn btn-sm btn-tosca">Setting</button>'+
        '</div>'+
        '</div>';
      });

      $("#isi_list_setting").html(isinya);

      },
      error: function (result) {
        console.log("Cant Data for preparing publish community");
    }
});
}


function listsetting0(){
//   alert("0 ");
window.location = '/admin/settings/loginregis';
}
function listsetting1(){
//   alert("1 ");
  window.location = '/admin/settings/loginregis';
}
function listsetting2(){
//   alert("2 ");
  window.location = '/admin/settings/loginregis';
}
function listsetting3(){
//   alert("3 ");
  window.location = '/admin/settings/membership';
}
function listsetting4(){
//   alert("4 ");
  window.location = '/admin/settings/registrasion_data';
}
function listsetting5(){
//   alert("5 ");
  window.location = '/admin/settings/payment';
}

</script>

@endsection
