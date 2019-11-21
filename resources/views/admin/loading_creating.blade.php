@extends('layout.app')

@section('content')
<div class="container">
<div class="pas-tengah"><center>
	<img src="/pic/loading.gif" class="rounded-circle img-fluid" style="width: 13%; height: auto; margin-bottom: 2em;">
	<h2>Creating Community...</h2>
	</center>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$( document ).ready(function() {
    setTimeout(function () {
       window.location.href = "finish";
    }, 6500); //will call the function after 2 secs.
});

</script>
@endsection
