@extends('layout.subscriber')

@section('content')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Detail News</h3>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/subscriber/news_list">News Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail News</li>
                </ol>
              </nav>
            </div>
<div class="row">
  <div class="col-md-8 news-title">
    <h1>{{ $title }}</h1>
  </div>
</div>
<div class="row">
 <div class="col-md-8 news-body">
  <div class="card" style="min-height: 485px;">
  
<div class="card-body">
<div class="news-middle">
<img src="{{' + server_cdn + $image '}}" class="img-mid" onerror = "this.onerror=null;this.src='/img/noimg2.jpg'">
</div>

<div class="row">
<div class="col-md-3 news-info">
  <div><b>Publish Date</b> :<br> {{ $createdAt }}</div>
</div>
<div class="col-md-3 news-info">
  <div><b>Created By</b> :<br> {{ $author_name }}</div>
</div>
<div class="col-md-3 news-info">
  <div><i class="mdi mdi-heart-outline"></i>{{ $like }}</div>
</div>
<div class="col-md-3 news-info">
  <div><i class="mdi mdi-eye"></i>{{ $visit }}</div>
</div>
</div>
<div class="row">
  <div class="greyline"></div>
</div>
<div class="row news-content">
  {!! $content !!}
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
   $("#modal_ajax").modal('hide');
});



</script>

@endsection