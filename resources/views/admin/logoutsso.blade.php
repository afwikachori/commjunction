@extends('layout.app')

@section('content')
<h1>welcome SSO <br>
<a href="" onclick="signOut();">Sign out</a></h1><br>
@endsection

@section('script')
<script type="text/javascript">

$(document).ready(function () {
onLoad();
});  

function onLoad() {
	gapi.load('auth2', function() {
    gapi.auth2.init();
    });
 }

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      alert('Your Account already logout!');
        window.location.href = "/admin";
    });
  }

  

</script>

@endsection