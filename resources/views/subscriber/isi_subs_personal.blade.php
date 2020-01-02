<div class="row">
    <div class="col"></div>
    <div class="col-2" style="text-align: right;">
        <small class="clight"><i>Step 1 / 2</i></small>
    </div>
</div>

<form method="POST" id="form_regispersonal_subs" action="{{route('registerSubs')}}">{{ csrf_field() }}

<div class="container">
<div class="row">
    <div class="col">

    <div class="form-group row">
        <label lang="en" class="h6 cgrey s14">Connect With</label>
        <div id="my-signin3"></div> 
        <input type="hidden" id="sso_type" name="sso_type" value="1">
        <input type="hidden" id="sso_token" name="sso_token">
    </div>

     <div class="form-group row">
        <label class="h6 cgrey s14" for="fullname_subs" lang="en">Full Name</label>

        <input id="fullname_subs" type="text" class="form-control @error('fullname_subs') is-invalid @enderror" name="fullname_subs" value="{{ old('fullname_subs') }}" required>
        <small id="pesan_name1" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('fullname_subs'))
        <small class="error_name1" style="color: red;">
        {{ $errors->first('fullname_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label for="email_subs" class="h6 cgrey s14" lang="en">Email Address</label>
        <input id="email_subs" type="email" class="form-control @error('email') is-invalid @enderror" name="email_subs" value="{{ old('email_subs') }}" required autocomplete="email_subs"><small id="pesan_emailadmin" class="redhide" lang="en">Include '@' in format email address!</small>
        <small id="pesan_emailsubs" class="redhide" lang="en">Email has been registered! Try another</small>
        @if($errors->has('email_subs'))
        <small class="error_emailsubs" style="color: red;">{{ $errors->first('email_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
    <label for="password_subs" class="h6 cgrey s14" lang="en">Password</label>
    <div class="input-group">
        <input class="form-control" id="password_subs" type="password"  value="{{ old('password_subs') }}"  class="form-control @error('password_subs') is-invalid @enderror" name="password_subs" required autocomplete="password_subs" aria-describedby="btn_showpass">

        <div class="input-group-append">
        <button class="btn btn-outline-light" type="button" id="btn_showpass" onclick="showPass()" style="border-color: #ced4da;">
         <span class="fa fa-eye" id="ico-mata" aria-hidden="true" style="color: grey;"></span>
        </button>
        </div>
    </div>
        <small id="pesan_passwordsubs" lang="en" class="redhide">Mininum 8 character contain Numbers and Letters!</small>
        @if($errors->has('password_subs'))
        <small class="error_passwordsubs" style="color: red;">{{ $errors->first('password_subs')}} Must contain numbers and letters
        </small>
        @endif
    </div>


    </div> <!-- end-col kiri -->
    <div class="col-1"></div>
    <div class="col">
        <div class="form-group row"> 
        <label class="h6 clight s14" for="community_id" lang="en">Id Community</label>
        <div class="row">
          <div class="col">
            <input type="text"  readonly class="form-control-plaintext" id="community_id" name="community_id">
          </div>
          <div class="col-8">
            <input type="text" name="auth_url" id="auth_url" value="" class="form-control">
          </div>
        </div>
       
            
        </div>

      <div class="form-group row">
        <label class="h6 cgrey s14" for="notlp_subs" lang="en">
        Phone Number
        </label>

        <input id="notlp_subs" type="text" class="form-control @error('notlp_subs') is-invalid @enderror" name="notlp_subs" value="{{ old('notlp_subs') }}" required>
        <small id="pesan_notlpsubs" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('notlp_subs'))
        <small class="error_notlpsubs" style="color: red;">
        {{ $errors->first('notlp_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label class="h6 cgrey s14" for="username_subs" lang="en">Username</label>

        <input id="username_subs" type="text" class="form-control @error('username_subs') is-invalid @enderror" name="username_subs" value="{{ old('username_subs') }}" required>
        <small id="pesan_usernamesubs" class="redhide" lang="en">At least 3 character!</small>

        @if($errors->has('username_subs'))
        <small class="error_usernamesubs" style="color: red;">
        {{ $errors->first('username_subs')}}</small>
        @endif
    </div>

    <div class="form-group row">
        <label for="passconfirm_subs" class="h6 cgrey s14" lang="en">Confirm Password</label>

        <input id="passconfirm_subs" type="password"  value="{{ old('passconfirm_subs') }}" class="form-control @error('passconfirm_subs') is-invalid @enderror" name="passconfirm_subs" required autocomplete="passconfirm_subs">

        <small id="pesan_passconfirmsubs" lang="en" class="redhide">Password & Confirm Password didnt match!</small>
        @if($errors->has('passconfirm_subs'))
        <small class="error_passconfirmsubs" style="color: red;">{{ $errors->first('passconfirm_subs')}}</small>
         @endif
    </div>

    </div> <!-- end-col kanan -->
  </div> <!-- end-row -->

<div class="form-group row">

    <button type="submit" class="btn btn-regissubs1" id="submit_personalsubs" lang="en">
    <div class="display-loading" style="display: none;">
    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> &nbsp;Loading...</div>
    Next</button>
  </div>
</div> <!-- end-container -->

</form>