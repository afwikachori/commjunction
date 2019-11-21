@extends('layout.app')

@section('content')
<div class="container">
<div style="margin-top: 10%"><center>
	<img src="/pic/sukses.png" class="rounded-circle img-fluid" style="width: 15%; height: auto; margin-bottom: 1.5em;">
	<h2>Your Community Has been<br>
		created !
	</h2>
	<span>
		Our administrators are going to approve your community <br>
		Continue to log-in into your community dashboard and<br> 
		tune it to your hearts content!
	</span>
	<br>
	<button type="button" class="btn btn-primary btn-sm" style="border-radius: 10px; margin-bottom: 1em; margin-top: 2em; width: 15%;"  onclick="window.location.href='/admin'">Login Now</button>
	</center>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection
