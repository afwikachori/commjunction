@extends('layout.app')

@section('content')
  <button class="btn-round-1" onclick="window.location.href='/admin/register'"></button>
<div class="container register-top">
    <div class="row">
        <div class="col">
           <center>
                <h1 class="text_regis">Tell us more about you</h1>
           </center>
        </div>
        <div class="col-lg">
        <form method="POST" id="form_registersecond_admin" action="{{route('registersecond')}}" style="margin-bottom: 2em;">
            <!-- <form id="form_registersecond_admin"> -->
                {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <!-- kiri label -->
                            </div>

                            <div class="col-md-8">
                        <h3>Let us know who leads
                <br>the pack!</h3>
            </div>
        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-7">
                                <input id="name_admin" type="text" class="form-control @error('name_admin') is-invalid @enderror" name="name_admin" value="{{ old('name_admin') }}" required autocomplete="name_admin" autofocus>
                                <small id="pesan_nameadmin" style="color: red;"></small>
                                @if($errors->has('name_admin'))
                                <small class="error_regis2" style="color: red;">{{ $errors->first('name_admin')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_admin" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-7">
                                <input id="phone_admin" type="text" class="form-control @error('phone_admin') is-invalid @enderror" name="phone_admin" value="{{ old('phone_admin') }}" required autocomplete="phone_admin" autofocus>
                                <small id="pesan_phone" style="color: red;"></small>
                                @if($errors->has('phone_admin'))
                                <small class="error_regis2" style="color: red;">{{ $errors->first('phone_admin')}} </small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_admin" class="col-md-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-7">
                                <input id="email_admin" type="email" class="form-control @error('email') is-invalid @enderror" name="email_admin" value="{{ old('email_admin') }}" required autocomplete="email_admin">
                                <small id="pesan_emailadmin" style="color: red;"></small>
                                @if($errors->has('email_admin'))
                                <small class="error_regis2" style="color: red;">{{ $errors->first('email_admin')}}</small>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat_admin" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-7">
                            <textarea id="alamat_admin" rows="1" class="form-control @error('alamat_admin') is-invalid @enderror" name="alamat_admin" required autocomplete="alamat_admin">{{ old('alamat_admin') }}</textarea>
                            <small id="pesan_alamatadmin" style="color: red;"></small>
                            @if($errors->has('alamat_admin'))
                            <small class="error_regis2" style="color: red;">{{ $errors->first('alamat_admin')}}</small>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username_admin" class="col-md-4 col-form-label text-md-right">Username Login</label>
                            <div class="col-md-7">
                                <input id="username_admin" type="text" class="form-control @error('username_admin') is-invalid @enderror" name="username_admin" value="{{ old('username_admin') }}" required autocomplete="username_admin">
                            <small id="pesan_usernameadmin" style="color: red;"></small>
                            @if($errors->has('username_admin'))
                            <small class="error_regis2" style="color: red;">{{ $errors->first('username_admin')}} At least 6 characters contain Numbers and Letters</small>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_admin" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-7">
                                
<div class="input-group mb-3">
  <input class="form-control" id="password_admin" type="password"  value="{{ old('password_admin') }}"  class="form-control @error('password_admin') is-invalid @enderror" name="password_admin" required autocomplete="password_admin" aria-describedby="btn_showpass">
  <div class="input-group-append">
    <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
    </button>
  </div>
</div>

<small id="pesan_passadmin" style="color: red;"></small>
                            @if($errors->has('password_admin'))
                            <small class="error_regis2" style="color: red;">{{ $errors->first('password_admin')}} Must contain numbers and letters</small>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirm Password </label>
                            <div class="col-md-7">
                                <input id="password_confirm" type="password"  value="{{ old('password_confirm') }}" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" required autocomplete="password_confirm">
                                <small id="pconfirmpass" style="color: red;"></small>
                            @if($errors->has('password_confirm'))
                            <small class="error_regis2" style="color: red;">{{ $errors->first('password_confirm')}}</small>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0" style="margin-top: 1em;">
                            <div class="col-md-7 offset-md-4">
                                <button type="button" onclick="window.location.href='/admin/register'" class="btn btn-secondary">Back</button>
                                <button id="btn_register2" type="submit" class="btn btn-primary">
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


// $(document).ready(function(){


//  $('#form_registersecond_admin').on('submit', function(event){
//   event.preventDefault();
// $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//   });
//    $.ajax({
//     url: '{{ route("registersecond") }}',
//     method:"POST",
//     data:$(this).serialize(),
//     dataType:"json",
//     beforeSend:function()
//     {
//      $('#submit').attr('disabled', 'disabled');
//      $('#submit').val('Submitting...');
//     },
//     success:function(data , errors, message)
//     {
//         console.log(errors);
//      $('#submit').attr('disabled', false);
//      $('#submit').val('Submit');
//      alert(data.success);
//     }
//    });
//  });

// });

</script>


@endsection
