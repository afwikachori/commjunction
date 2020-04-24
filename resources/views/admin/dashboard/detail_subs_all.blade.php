@extends('layout.admin-dashboard')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Subscriber Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your subscriber information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<br>

<div class="row">
 <div class="col-md">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
    <div class="row">
      <div class="col-md-8 cgrey" style="margin-top: 0.5em;" lang="en">Detail Subscriber</div>
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
    <small class="clight" lang="en">Full Name</small>
    <p class="cgrey1 tebal">{{ $full_name }} </p>
  </div>
  <div class="form-group">
    <small class="clight" lang="en">Status</small>
    <p class="cgrey1 tebal">
      {{ $status }}
    </p>
  </div>
</div>

<div class="col-md">
  <div class="form-group">
    <small class="clight" lang="en">Join at</small>
    <p class="cgrey1 tebal"> {{ $created_at }}</p>
  </div>
  <div class="form-group">
    <small class="clight" lang="en">Membership Type</small>
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


 <div class="col-md-4 col-activity" style="display: none;">
  <div class="card" style="min-height: 485px;">
  <div class="card-header putih">
   <div class="row">
        <div class="col-md-6 cgrey" style="margin-top: 0.5em;" lang="en">Last Activity</div>
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
// request.abort();
//   jqXHR.abort();
});



</script>

@endsection
