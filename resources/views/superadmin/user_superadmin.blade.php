@extends('layout.superadmin')

@section('content')
<div class="page-header">
    <h3 class="page-title">
    	<span class="page-title-icon bg-gradient-primary text-white mr-2">
    		<i class="mdi mdi-account"></i>
        </span> Users </h3>
    
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        	<li class="breadcrumb-item active" aria-current="page">
        		<span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>        
</div>
<div class="row">
 <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Horizontal Two column</h4>

                    <form method="POST" id="form_adduser_superadmin" action="{{route('postAddUser')}}">
                     {{ csrf_field() }}

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="name_superadmin">Full Name</label>
                            <div class="col-sm-8">
                               <input id="name_superadmin" type="text" class="form-control @error('name_superadmin') is-invalid @enderror" name="name_superadmin" value="{{ old('name_superadmin') }}" required>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Division</label>
                            <div class="col-sm-8">
                            <input id="division" type="division" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}" required autocomplete="division">
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                          </div>
                        </div>
                      </div>


                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Priviledge</label>
                            <div class="col-sm-8">
                              <select class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                      </div>

                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>

                    </form>
                  </div>
                </div>
              </div>
          </div>


@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {

});

</script>

@endsection