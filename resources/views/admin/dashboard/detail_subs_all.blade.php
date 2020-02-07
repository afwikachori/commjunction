@extends('layout.admin-dashboard')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Management</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Subscriber Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Subscriber</li>
                </ol>
              </nav>
            </div>

<div class="row">
 <div class="col-md-8">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
    <div class="row">
      <div class="col-md-8 cgrey" style="margin-top: 0.5em;">
        Detail Subscriber
      </div>
      <div class="col-sm-4 sisi-kanan" style="text-align: right;">
        <form  method="POST" id="formedit_status_subs" action="{{route('nonaktif_status_subs')}}">
          {{ csrf_field() }}
          <input type="hidden" name="idsubs" value="{{$user_id}}">
        @if($status_id == 3)
         <button type="submit" class="btn btn-ijo btn-sm">{{ $status }}</button>
         @else
         <button type="submit" class="btn btn-danger melengkung10px btn-sm">{{ $status }}</button>
        @endif
       
      </form>
      </div>
    </div>
  </div>
    <div class="card-body">


<div class="bunder-ring">
  @if ($sso_picture == 0)
<img class="profile-pic rounded-circle img-fluid" src="/img/focus.png">
  @else
<img class="profile-pic rounded-circle img-fluid" src="{{ $sso_picture }}">
  @endif
       
</div>

<div class="row">
<div class="col-md">
  <div class="form-group">
    <small class="clight">Fullname</small>
    <p class="cgrey1 tebal">{{ $full_name }} </p>
  </div>
  <div class="form-group">
    <small class="clight">Status</small>
    <p class="cgrey1 tebal">
      {{ $status }}
    </p>
  </div>
</div>

<div class="col-md">
  <div class="form-group">
    <small class="clight">Join at</small>
    <p class="cgrey1 tebal"> {{ $created_at }}</p>
  </div>
  <div class="form-group">
    <small class="clight">Membership Type</small>
    <p class="cgrey1 tebal">
@if($membership_id == 1)
Free
@else
Paid
@endif
</p>
  </div>
</div>
</div>
    </div>
  </div>
</div>


 <div class="col-sm-4 col-activity">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
   <div class="row">
        <div class="col-md-6 cgrey" style="margin-top: 0.5em;">
          Last Activity
        </div>
        <div class="col-md-6 sisi-kanan" style="text-align: right;">
          <small class="cgrey2">Updated 10 Hours</small>
        </div>
      </div>
  </div>
    <div class="card-body">
      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
      </div>

      <div class="form-group mb-1half">
        <label class="cgrey1 tebal">Activiyt Satu </label>
        <br>
        <small class="clight">Lorem ipsum notifikasi test lorem ipsum lorem lorem ipsum notif</small> 
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
});



</script>

@endsection