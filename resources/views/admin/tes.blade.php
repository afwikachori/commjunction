@extends('layout.app')

<!-- @section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection -->

@section('content')

<div class="container">
<h1>halo</h1>

<br>

  <select id="type_com" class="form-control @error('type_com') is-invalid @enderror" name="type_com" data-old="{{ old('type_com') }}" required autocomplete="type_com">

 </select>


</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
get_jenis();
});

function get_jenis() {       
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
	url: "/getGuzzle",
	type: "POST",
	dataType: "json",
	success: function (status, code, data) {
	console.log(status.data);
	if (status.code== '00') {
      var data = status.data; //console.log(data);

      $('#type_com').empty();
      $('#type_com').append("<option disabled selected> -- Select Community Type -- </option>");

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_com').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].priviledge, "</option>"));
      } //Short Function Ascending//


      $("#type_com").get(0).selectedIndex = 0; //e.preventDefault();
    }
	}
});
} //endfunction

</script>
@endsection