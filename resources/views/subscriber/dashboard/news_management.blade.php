@extends('layout.subscriber')
@section('title', 'News List')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>News List</h3>

    <nav aria-label="breadcrumb">
        <div class="dropdown">
            <!-- <button class="btn btn-secondary btn-tosca btn-sm" type="button" id="find_friend" data-toggle="modal" data-target="#find_friend_modal">
                    Filter News
                  </button> -->
        </div>

    </nav>
</div>


<div class="row">
    <div id="page_news_management_subs"></div>
    <div class="col-md-12">
        <div id="headline" class="suggestionlist">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div style="min-height: 450px;">

            <div class="card-body">
                <div id="nodata_news" style="display: none; min-height: 300px; margin-left: auto; margin-right: auto;">
                    <br><br><br><br><br>
                    <center>
                        <h1 class="clight" lang="en">No Data Available</h1>
                    </center>
                </div>
                <div id="news_container">


                </div>
                <!-- end tabel all  -->
            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL SEND MESSAGE-->
<div class="modal fade" id="modal_send_message" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_message" action="{{route('friend_send_message')}}">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject</small>
                                <input type="text" id="subject" name="subject"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content"
                                    name="message"></textarea>
                            </div>
                            <input type="hidden" id="friend_id" name="friend_id" class="form-control input-abu">
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send Message</button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL FIND FRIEND -->
<div class="modal fade" id="find_friend_modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_find_friend">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Find Friend</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject</small>
                                <input type="text" id="subject2" name="subject2"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message</small>
                                <textarea class="form-control input-abu" label="Konten2" req="" id="news_add_content2"
                                    name="message"></textarea>
                            </div>
                            <input type="hidden" id="friend_id2" name="friend_id2" class="form-control input-abu">
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send Message</button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


@endsection
