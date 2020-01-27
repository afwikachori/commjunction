@extends('layout.app')

@section('content')
<div class="bg-full-oren">

<center>
<div class="spinner-grow" role="status" style="position: absolute; top: 35%; width: 255px; height: 255px; top: 190px; left: 660px; color: white;">
  <span class="sr-only">Loading...</span>
</div>
	<img src="/visual/logo2.png" id="logo-loading-2">
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
