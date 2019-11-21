@extends('layout.app')

@section('content')
<button class="btn-round-1" onclick="window.location.href = '/admin'"></button>
<div class="container register-top">
    <div class="row">
        <div class="col">
            <center>
                <h1 class="text_regis">Let's Get Started !</h1>
            </center>
        </div>
        <div class="col-md">
            <form method="POST" id="form_registerfirst_admin" action="{{route('registerfirst')}}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group row">
                    <div class="col-md-4">
                        <!-- kiri label -->
                    </div>

                    <div class="col-md-8">
                        <h3>Let us understand more about
                            <br>your community</h3>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name_com" class="col-md-4 col-form-label text-md-right">Community Name</label>

                    <div class="col-md-7">
                        <input id="name_com" type="text" class="form-control @error('name_com') is-invalid @enderror" name="name_com" value="{{ old('name_com') }}" required autocomplete="name_com">
                        <small id="pesan_namecom" style="color: red;"></small>
                        @if($errors->has('name_com'))
                        <small class="error_register1" style="color: red;">{{ $errors->first('name_com')}}</small>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon_com" class="col-md-4 col-form-label text-md-right">Community Icon</label>

                    <div class="col-md-7">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input form-control @error('icon_com') is-invalid @enderror" name="icon_com" value="{{ old('icon_com') }}" required autocomplete="icon_com" id="icon_com" required>
                            <label class="custom-file-label" for="icon_com">Choose file</label>
                            <small id="pesan_icon" style="color: red;"></small>
                            @if($errors->has('icon_com'))
                           
                            <small class="error_register1" style="color: red;">Maximum dimension image is <b>300 x 300 pixels</b></small>
                            @endif
                        </div>
                         <img id="iconcom_view" class="img-fluid" src="" style="width: 30%; height: auto; margin-top: 0.7em; display: none; ">
                        <small style="color: grey;" id="text_dimensi"></small>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="descrip_com" class="col-md-4 col-form-label text-md-right">Community Description</label>
                    <div class="col-md-7">
                        <textarea id="descrip_com" rows="2" class="form-control @error('descrip_com') is-invalid @enderror" name="descrip_com" required autocomplete="descrip_com">{{ old('descrip_com') }}</textarea>
                        <small id="pesan_deskrpsi" style="color: red;"></small>
                        @if($errors->has('descrip_com'))
                        <small class="error_register1" style="color: red;">{{ $errors->first('descrip_com')}}</small>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="type_com" class="col-md-4 col-form-label text-md-right">Community Type</label>

                    <div class="col-md-7">
                    <select id="type_com" class="form-control @error('type_com') is-invalid @enderror" name="type_com" data-old="{{ old('type_com') }}" required autocomplete="type_com">
                    </select>

                        <div class="row other_type_com" style="display: none;">
                            <div class="col-10">
                                <input type="text"  class="form-control @error('other_type_com') is-invalid @enderror" name="other_type_com" value="{{ old('other_type_com') }}"  autocomplete="other_type_com" id="other_type_com" placeholder="Input Community Type" >       
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
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Total Member</label>

                    <div class="col-md-7">
                        <select id="range_member" class="form-control @error('range_member') is-invalid @enderror" name="range_member" data-old="{{ old('range_member') }}" required autocomplete="range_member">
                            <option disabled selected> -- Select Range -- </option>
                            <option value="1" {{ old('range_member') == 1 ? 'selected' : '' }}>10 - 50</option>
                            <option value="2" {{ old('range_member') == 2 ? 'selected' : '' }}>50 - 100</option>
                            <option value="3" {{ old('range_member') == 3 ? 'selected' : '' }}> 100 - 1000</option>
                            <option value="4" {{ old('range_member') == 4 ? 'selected' : '' }}> > 1000 </option>
                        </select>

                    @if($errors->has('range_member'))
                        <small class="error_register1" style="color: red;">{{ $errors->first('range_member')}}</small>
                    @endif

                    </div>
                </div>
                <div class="form-group row mb-0 btn-regis">
                    <div class="col-md-6 offset-md-4">
                        <button id="btn_register" type="submit" class="btn btn-primary">
                            Next
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
get_jenis();
});
var _URL = window.URL || window.webkitURL; //untuk file image dimension

// other - dropdown jenis community 
    $('#list_priviledge').on('change', function () {
        var a = $('#list_priviledge :selected').val();
        alert(a);
    });

    $("#type_com").change(function () {
        var pilih = $('#type_com :selected').val();

        if (pilih == "0") {
            $('.other_type_com').show();
            $('#type_com').hide();
        } else {
            $('.other_type_com').hide();
            $('#type_com').show();
        }
    });

    $("#close_other").click(function () {
        $('.other_type_com').hide();
        $('#type_com').show();

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
    success: function (status, code, data) {
    // console.log(status.data);

    if (status.code== '00') {
      var data = status.data; 

      $('#type_com').empty();
      $('#type_com').append("<option disabled> -- Select Community Type -- </option>");

      for (var i = data.length - 1; i >= 0; i--) {
        $('#type_com').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
      } 
      //Short Function Ascending//
      $("#type_com").html($('#type_com option').sort(function (x, y) {
        return $(x).val() < $(y).val() ? -1 : 1;
      }));

      $("#type_com").get(0).selectedIndex = 0; //e.preventDefault();
    }
     const OldValue = '{{ old('type_com') }}';
    
    if(OldValue !== '') {
      $('#type_com').val(OldValue);
    }
    }
});
} //endfunction


$('#icon_com').on('change', function () {
// cari function custom-validation.js
filenameImg(this);
previewImg(this);
dimensionImg(this);
 }) //end-onchange img


</script>
@endsection
