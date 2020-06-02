@extends('layout.subscriber')
@section('title', 'Friend List')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Friend List</h3>

    <nav aria-label="breadcrumb">
        <div class="dropdown">
            <button class="btn btn-secondary btn-tosca btn-sm" type="button" id="find_friend" data-toggle="modal"
                data-target="#find_friend_modal">
                Find Friends
            </button>
        </div>

    </nav>
</div>


<div class="row">
    <div id="page_friends_subs"></div>
    <div class="col-md-12">
        <div class="divkonco pagefriend">
            <div id="suggestion_list" class="suggestionlist">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                <span lang="en">Added</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                <span lang="en">Pending</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">

                            <!-- tabel all susbcriber -->
                            <table id="tabel_friend_manage" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">Profile</b></th>
                                        <th><b lang="en">Friend Name</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <!-- tabel all susbcriber -->
                            <table id="tabel_friend_manage" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><b>Name</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>
                    </div>
                </div>



            </div> <!-- //body -->
        </div>
    </div>
</div> <!-- endrow -->






<!-- MODAL SEND MESSAGE-->
<div class="modal fade" id="modal_send_message_subs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>


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
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content2"
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
            <form method="POST" id="form_send_message" action="{{route('friend_send_message')}}">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Find Friend</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject</small>
                                <input type="text" id="subject1" name="subject1"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message</small>
                                <textarea class="form-control input-abu" label="Konten" req="" id="news_add_content1"
                                    name="message"></textarea>
                            </div>
                            <input type="hidden" id="friend_id_subs" name="friend_id_subs"
                                class="form-control input-abu">
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
