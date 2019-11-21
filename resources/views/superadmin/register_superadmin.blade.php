@extends('layout.app')

@section('content')
  <button class="btn-round-2" onclick="window.location.href='login'"></button>
<div class="container register-top">
    <div class="row">
        <div class="col">
           <center>
                <h1 style="padding-top: 35%;">Let's Get Started !</h1>
           </center>
        </div>
        <div class="col-md">
        <form method="POST" id="form_register_superadmin" action="{{route('superregister')}}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-4">
                                <!-- kiri label -->
                            </div>

                            <div class="col-md-8">
                        <h1 style="color: #f9b500;">Fill this form</h1>
            </div>
        </div>

                        <div class="form-group row">
                            <label for="name_superadmin" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name_superadmin" type="text" class="form-control @error('name_superadmin') is-invalid @enderror" name="name_superadmin" value="{{ old('name_superadmin') }}" required autocomplete="name_superadmin" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">Division</label>

                            <div class="col-md-6">
                                <input id="division" type="division" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}" required autocomplete="division">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="priviledge" class="col-md-4 col-form-label text-md-right">Priviledge</label>

                            <div class="col-md-6">
                                <div class="form-group" id="list_priviledge">
                                    <select id="list_priviledge" name="priviledge" class="form-control">
                                    <option disabled selected> -- Select an Priviledge -- </option>
                                        @foreach ($priviledge as $data)
                                        <option value="{{$data->id}}" style="color: black;">{{ $data->name_priviledge }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn_register" type="submit" class="btn btn-primary">
                                    Register
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

//    $( "#btn_register" ).click(function() {
//  alert( "Handler for .click() called." );
//});

$('#list_priviledge').on('change', function() {
  var a = $('#list_priviledge :selected').val();
  alert(a);
});
</script>
@endsection
