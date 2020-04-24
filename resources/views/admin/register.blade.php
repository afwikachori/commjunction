@extends('layout.app')

@section('content')
<div class="row">
    <div class="col orenq">
       <img src="/visual/commjuction.png" id="commjuction-regis1">
       <img src="/visual/regis1.png" class="vs-regis">
       <center>
       <h5 class="putih" lang="en" style="margin-left: 1.5em; margin-right: 1.5em; margin-top: 6em;">"Don't Know, then don't love" - Indonesian Proverb</h5>
       </center>
    </div>
    <div class="col-8">
    <div class="row">
        <div class="col langimgq">
          <a href="" onclick="window.lang.change('en'); return false;">
          <img border="0" src="/img/en.png" width="30" height="30">
          </a>
          <a href="" onclick="window.lang.change('id'); return false;">
          <img border="0" src="/img/id.png" width="30" height="30">
          </a>
        </div>
        <div class="col">
        <div class="sigin">
          <span lang="en" class="h6 cteal">Already member?</span>
          <a href="/admin" class="h6" id="klikregister" lang="en" data-lang-token="registernow">&nbsp;Sign In</a>
        </div>
        </div>
      </div>

      <div class="pdregis1">
        <h3 lang="en" style="color: #4F4F4F; margin-right: -0.5em;" lang="en">Community Registration</h3>
        <label lang="en" class="clight s15" data-lang-token="info-regis1">We would like to know more about your Community</label>


<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link homeq active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Community Information</a>

    <a class="nav-item nav-link profileq disabled" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" aria-disabled="disabled">Personal Information</a>
  </div>
</nav>



<form method="POST" id="form_registerfirst_admin" action="{{route('registerfirst')}}" class="kontenregsiter mgtop-1" enctype="multipart/form-data">
{{ csrf_field() }}


<div class="container">
<div class="row" style="margin-top: 5%;">

<div class="col">
    <div class="form-group row">
        <label class="h6 cgrey s14" for="name_com" lang="en">Community Name</label>

        <input id="name_com" type="text" class="form-control @error('name_com') is-invalid @enderror" name="name_com" value="{{ old('name_com') }}" required>
        <small id="pesan_namecom" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('name_com'))
        <small class="error_register1" style="color: red;">
        {{ $errors->first('name_com')}}</small>
        @endif
    </div>
</div>

<div class="col-1"></div>

<div class="col">
<div class="form-group row">
    <label for="icon_com" lang="en" class="h6 cgrey s14">Community Icon</label>

    <div class="custom-file">
        <input type="file" class="custom-file-input form-control @error('icon_com') is-invalid @enderror" name="icon_com" value="{{ old('icon_com') }}" required id="icon_com" required>
        <label class="custom-file-label" for="icon_com" lang="en">Choose file</label>
        <small id="pesan_icon" class="redhide" lang="en">Maximum dimension is 300 X 300 Pixels !</small>

        @if($errors->has('icon_com'))
        <small class="error_register1" style="color: red;" lang="en">Maximum dimension image is <b lang="en">300 x 300 pixels</b></small>
        @endif
    </div>

    <img id="iconcom_view" class="img-fluid rounded float-left" src="" onclick="clickImageView()"
    style="width: 15%; margin-top: 0.5em; height: auto;display: none; ">
        <small style="color: grey; display: none;" id="text_dimensi" lang="en">Your Image</small>
        <small id="pixelicon" style="color: grey;"></small>
</div>
</div>
</div> <!-- end-row -->


<div class="form-group row">
    <label for="descrip_com" class="h6 cgrey s14" lang="en">Community Description</label>

    <textarea id="descrip_com" rows="2" class="form-control @error('descrip_com') is-invalid @enderror" name="descrip_com" required>{{ old('descrip_com') }}</textarea>
    <small id="pesan_deskrpsi" style="color: red;"></small>

    @if($errors->has('descrip_com'))
    <small class="error_register1" style="color: red;">{{ $errors->first('descrip_com')}}</small>
    @endif
</div>
</div> <!-- end-container -->

<div class="row">
<div class="col">
<div class="form-group">
        <label for="type_com" class="h6 cgrey s14" lang="en">Community Type</label>

        <select id="type_com" class="form-control @error('type_com') is-invalid @enderror" name="type_com" data-old="{{ old('type_com') }}" required>
        </select>

        <div class="row other_type_com" style="display: none;">
            <div class="col">
                <input type="text"  class="form-control @error('other_type_com') is-invalid @enderror" name="other_type_com" value="{{ old('other_type_com') }}" id="other_type_com" placeholder="Input Community Type" >
            </div>
            <div class="col-1">
            <button type="button" id="close_other" class="close" aria-label="Close">&times;
                <span aria-hidden="true"></span>
            </button>
            </div>
        </div>

        <small id="pesan_typeother" style="color: red;"></small>
        @if($errors->has('type_com'))
        <small class="error_register1" style="color: red;">{{ $errors->first('type_com')}}</small>
    @endif
</div>
</div>
    <div class="col-1"></div>
    <div class="col">
    <div class="form-group">
        <label for="email" class="h6 cgrey s14">Total Member</label>
        <select id="range_member" class="form-control @error('range_member') is-invalid @enderror" name="range_member" data-old="{{ old('range_member') }}" required>
            <option disabled selected> --- </option>
            <option value="10 - 50" {{ old('range_member') == 1 ? 'selected' : '' }}>10 - 50</option>
            <option value="50 - 100" {{ old('range_member') == 2 ? 'selected' : '' }}>50 - 100</option>
            <option value="100 - 1000" {{ old('range_member') == 3 ? 'selected' : '' }}> 100 - 1000</option>
            <option value="> 1000" {{ old('range_member') == 4 ? 'selected' : '' }}> > 1000 </option>
        </select>
        @if($errors->has('range_member'))
            <small class="error_register1" style="color: red;">{{ $errors->first('range_member')}}</small>
        @endif
    </div>
    </div>
</div>
 <button id="btn_register" type="submit" class="btn btn-primary btnnextadmin" lang="en">Next</button>

</form>

    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';
$(document).ready(function () {
get_jenis();
});



function get_session1(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_regisOne',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
    if (result != ""){
    $("#name_com").val(result.name);
    $("#descrip_com").val(result.description);
    $('select[name="type_com"]').val(result.jenis_comm_id);
    $('#range_member').val(result.range_member).attr("selected", "selected");
    if(result.name != undefined){
    $("#iconcom_view").attr('src', server_cdn+result.logo).show();
    $(".custom-file-label").html("YOUR ICON COMMUNITY");
    }

    $("#icon_com").removeAttr( 'required' );

    if(result.jenis_comm_id == 1){
        $("#other_type_com").val(result.cust_jenis_comm);
        $('.other_type_com').show();
        $('#type_com').hide();
    }else{
        $('.other_type_com').hide();
        $('#type_com').show();
    }
  }
      },
      error: function (result) {
        console.log("Cant Reach Session Register One");
    }
});
}



var _URL = window.URL || window.webkitURL; // image dimension

// other - dropdown jenis community
    $("#type_com").change(function () {
        var pilih = $('#type_com :selected').val();

        if (pilih == "1") {
            $('.other_type_com').show();
            $('#type_com').hide();
        } else {
            $('.other_type_com').hide();
            $('#type_com').show();
        }
    });

// end- other dropdown jenis community


//dropdown get jenis komunitas
function get_jenis() {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: "/get_jenis_com",
    type: "POST",
    dataType: "json",
    success: function (result) {
      var data = result;
      console.log(data);

      $('#type_com').empty();
      $('#type_com').append("<option disabled> --- </option>");

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_com').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
      }
      //Short Function Ascending//
      $("#type_com").html($('#type_com option').sort(function (x, y) {
        return $(x).val() < $(y).val() ? -1 : 1;
      }));

      $("#type_com").get(0).selectedIndex = 0; //e.preventDefault();

     const OldValue = '{{old('type_com')}}';

    if(OldValue !== '') {
      $('#type_com').val(OldValue);
    }

    get_session1();
    }
});
} //endfunction


$('#icon_com').on('change', function () {
// cari function custom-validation.js
filenameImg(this);
previewImg(this);
dimensionImg(this);

 }); //end-onchange img

</script>
@endsection
