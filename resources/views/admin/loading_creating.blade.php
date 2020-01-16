@extends('layout.app')

@section('content')
<div class="loadingq">

<center>
<div class="spinner-grow" role="status" style="position: absolute; top: 200px; width: 255px; height: 255px; top: 180px; left: 550px;">
  <span class="sr-only">Loading...</span>
</div>
	<img src="/visual/logo2.png" id="logo-loading">
</center>
</div>
@endsection

@section('script')
<script type="text/javascript">
$( document ).ready(function() {
    setTimeout(function () {
       window.location.href = "finish";
    }, 5000); //will call the function after 2 secs.
});

</script>
@endsection
