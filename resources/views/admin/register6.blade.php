@extends('layout.app')

@section('content')
<div class="container">
<div class="row" style="margin-top: 5%">
    <div class="col-sm-5 hide-judulreview">
    <h1 style="margin-top: 5em;">Review your Registration details</h1>
    </div>
    <div class="col-md-7">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade size-review show active" id="home" role="tabpanel" aria-labelledby="home-tab"><div class="container">.1..</div></div>
  <div class="tab-pane fade size-review" id="profile" role="tabpanel" aria-labelledby="profile-tab"><div class="container">..2.</div></div>
  <div class="tab-pane fade size-review" id="contact" role="tabpanel" aria-labelledby="contact-tab"><div class="container">..3.</div></div>
</div>

<div style="text-align: center; margin-top: 2em;">
	<button type="button" class="btn btn-danger btn-sm" style="border-radius: 10px; margin-bottom: 1em; width: 25%;">Edit Data</button>
	<button type="button" class="btn btn-primary btn-sm" style="border-radius: 10px; margin-bottom: 1em; width: 25%;"  onclick="window.location.href='/admin/loading_creating'">Submit</button>
</div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
   //isi javascript dan jquery 
</script>
@endsection
