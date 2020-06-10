@extends('subscriber.supportpal.layouts.main_subs')

@section('title', 'Support Pal')

@push('css')

@endpush

@section('content')
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Ticket</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="/subscriber/supportpal/">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a href="/subscriber/supportpal/ticket">List</a>
            </li>

            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>

            <li class="nav-item">
                <a>Detail</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                       <div class="col-md-6">
                            <h4>{{$dataDetail['subject']}} #{{$dataDetail['number']}}</h4>
                        </div>

                        <div class="col-md-6 kananin">
                            <a href="/subscriber/supportpal/ticket/ticket-update/{{$dataDetail['id']}}/1" class="btn btn-sm btn-success"
                                type="button">
                                 <i class="fas fa-check-square"></i> &nbsp;
                                Open Ticket
                            </a>

                            <a href="/subscriber/supportpal/ticket/ticket-update/{{$dataDetail['id']}}/2" class="btn btn-sm btn-danger"
                                type="button">
                                <i class="fas fa-window-close"></i> &nbsp;
                                Close Ticket
                            </a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <h4 class="page-title">Basic Ticket Information</h4>

                            <div class="form-group">
                                <label class="control-label">
                                    Ticket Status
                                </label>
                                <p id="ticketStatus" class="form-control-static">{{$dataDetail['status']['name']}}</p>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Department
                                </label>
                                <p class="form-control-static">{{$dataDetail['department']['name']}}</p>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Create Date
                                </label>
                                <p class="form-control-static">{{date("d-m-Y", $dataDetail['created_at'])}}</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <h4 class="page-title">User Information</h4>

                            <div class="form-group">
                                <label class="control-label">
                                    Name
                                </label>
                                <p class="form-control-static">{{$dataDetail['user']['lastname']}}</p>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Email
                                </label>
                                <p class="form-control-static">{{$dataDetail['user']['email']}}</p>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Username
                                </label>
                                <p class="form-control-static">{{$dataDetail['user']['firstname']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Comments area --}}

    <section class="comment-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12">

                    <h4><b>COMMENTS</b></h4>
                    @foreach($data['data'] as $comment)
                    <div class="commnets-area ">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#" style="height: 100%"><img
                                            src="{{ $comment['user']['avatar_url']}}" alt="Profile Image"
                                            style="height: 100%"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{ $comment['user_name']}}</b></a>
                                    <h6 class="date">on {{ date("h:i Y-m-d",$comment['created_at'])}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p>{!! html_entity_decode( $comment['text']) !!}</p>

                            @if(!empty($comment['attachments']))
                            <div class="attachments">
                                <h4 class="attachments-title">Attachment</h4>
                                <img src="{{$comment['attachments'][0]['direct_frontend_url']}}" class="attachments-img"
                                    alt="">
                            </div>
                            @endif

                        </div>

                    </div><!-- commnets-area -->
                    @endforeach

                    <div class="comment-form">

                        <form method="post" action="{{route('post.message.create')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$dataDetail['id']}}" name="ticket_id">
                            <input type="hidden" id="user_id_komen" name="user_id">

                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea id="editor" name="comment" class="text-area-messge form-control"
                                        placeholder="Enter your comment" aria-required="true" aria-invalid="false" required></textarea>
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12 mt-3">
                                    <p class="cekImages"></p>
                                    <label class="file-input button">
                                        <i class="fa fa-paperclip"></i>&nbsp; Add Attachment
                                        <input class="fileupload" type="file" name="file">
                                    </label>

                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12 mt-3">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>Submit</b></button>
                                </div>

                            </div><!-- row -->
                        </form>

                    </div><!-- comment-form -->


                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>

</div>

{{-- modal preview --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img id="imgPreviewModal" src="" alt="">
        </div>
    </div>
</div>
@endsection
