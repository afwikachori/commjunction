@extends('layout.app')

@section('content')
<div class="bg-full-oren">

<center>
<div class="spinner-grow" role="status" id="loading_adminregis"
  <span class="sr-only">Loading...</span>
</div>
    <img src="/visual/logo2.png" style="margin: 0; padding: 0; margin-top:40vh;  width: 150px; height: 150px;">
</center>
</div>
@endsection

@section('script')
<script type="text/javascript">
$( document ).ready(function() {
    setTimeout(function () {
       window.location.href = "/admin/finish";
    }, 5000); //will call the function after 2 secs.
});


</script>
@endsection
