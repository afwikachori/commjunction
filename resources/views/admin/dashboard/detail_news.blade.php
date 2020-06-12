@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Detail News</h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/news_management">News Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail News</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div id="page_detail_news_admin"></div>
    <div class="col-md-8 news-title">
        <h1>{{ $title }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-8 news-body">
        <div class="card" style="min-height: 485px;">

            <div class="card-body">
                <div class="news-middle">
                <form method="POST" action="{{route('send_love_news_admin')}}">
                        {{ csrf_field() }}
                    <input type="hidden" name="news_id" value="{{ $id }}">
                    <button type="submit" class="btn btn-gradient-danger btn-rounded btn-icon btn-loveme">
                        <i class="mdi mdi-heart"></i>
                    </button>
                </form>
                    <img src="{{ env('CDN') }}/{{$image}}" class="img-mid"
                        onerror="this.onerror=null;this.src='/visual/car1.png';">
                </div>

                <div class="row">
                    <div class="col-md-3 news-info">
                        <div><b>Publish Date</b> :<br><small class="cgrey2">
                                <td>{{ date('d-M-y', strtotime($createdAt)) }}
                            </small></div>
                    </div>
                    <div class="col-md-3 news-info">
                        <div><b>Created By</b> :<br>
                            {{ $author_name }}
                        </div>
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
