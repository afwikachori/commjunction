@extends('layout.subscriber')
@section('title', 'Friend List')
@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span>Friend Profile</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/subscriber/friend_list">Friend List</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
              </nav>
            </div>


<div class="row">
 <div class="col-md-12">
  <div class="card" style="min-height: 450px;">

<div class="card-body">
<div class="profile-middle">
<img src="{{ env('CDN') }}/{{$picture}}" class="img-profile-friends zoom">
<div><b>{{ $full_name }}</b></div>
</div>

<div class="row">
<div class="col-md-3 news-info">
  <div><b>Username</b> :<br> {{ $user_name }}</div>
</div>
<div class="col-md-3 news-info">
  <div><b>Email</b> :<br> {{ $email }}</div>
</div>
<div class="col-md-3 news-info">
  <div><b>Alamat</b> :<br> {{ $alamat }}</div>
</div>
<div class="row profile-Action">
  <ul class="navbar-nav d-flex align-items-stretch" id="nav_action">
            <li class="nav-item">
        <a class="nav-link" href="#" onclick=send_message("{{ $user_id }}")>
            <i class="mdi mdi-newspaper menu-icon"></i>
            <span class="menu-title" lang="en">Send Message</span>

        </a>
    </li>

           <li class="nav-item">
        <a class="nav-link" href="#"  onclick=send_whatsapp("{{ $user_id }}")>
            <i class="mdi mdi-account-multiple menu-icon"></i>
            <span class="menu-title" lang="en">Chat Whatsapp</span>

        </a>
    </li>

    </ul>
</div>

</div>

    </div> <!-- //body -->
</div>
</div>
</div> <!-- endrow -->






<!-- MODAL SEND MESSAGE-->
<div class="modal fade" id="modal_send_message" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #ffffff;">
<form method="POST" id="form_send_message" action="{{route('friend_send_message')}}">
{{ csrf_field() }}


<div class="modal-header"  style="padding-left: 5%;padding-right: 5%;">
    <h4 class="modal-title cgrey">Send Message</h4>
</div> <!-- end-header -->

<div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


<div class="row">
<div class="col-md">
  <div class="form-group">
    <small class="clight">Subject</small>
    <input type="text" id="subject" name="subject" class="form-control input-abu melengkung10px" required>
  </div>
    <div class="form-group">
    <small class="clight">Message</small>
     <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content" name="message"></textarea>
  </div>
<input type="hidden" id="friend_id" name="friend_id" class="form-control input-abu">
</div>
 </div>
</div> <!-- end-body -->

  <div class="modal-footer" style="border: none;">
    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
      <i class="mdi mdi-close"></i> Cancel
    </button>
    &nbsp;
    <button type="submit" class="btn btn-tosca btn-sm">
    <i class="mdi mdi-check btn-icon-prepend">
        </i> Send Message</button>
  </div>  <!-- end-footer     -->
</form>
</div> <!-- END-MDL CONTENT -->

  </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
 //get_all_news();
//tabel_friend_list();
// tabel_tes();
});
//

function send_message(friend_id){
  $friend_id = friend_id;
      $("#modal_send_message").modal("show");
      $("#friend_id").val($friend_id);
}
function send_whatsapp(friend_id){
  $friend_id = friend_id;
  $phonum = +628123229810;
  $pretext = "Halo, Salam kenal";
  window.open('https://api.whatsapp.com/send?phone=' + $phonum + '&text=' + $pretext + '');

}


</script>

@endsection
