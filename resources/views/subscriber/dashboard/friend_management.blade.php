@extends('layout.subscriber')
@section('title', 'Friend List')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Friend List</h3>

    <nav aria-label="breadcrumb">
        <button class="btn btn-secondary btn-tosca btn-sm" type="button" id="find_friend" data-toggle="modal"
            data-target="#find_friend_modal">
            Find Friends
        </button>

        <button class="btn btn-accent btn-sm" type="button" data-toggle="modal" data-target="#modal_setting_friend">
            Setting
        </button>
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
                                <span lang="en">Friend</span>
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

                            <small class="clight">Friends Total : </small>
                            <span class="clr-accent-color s20" id="text_total_friends"> 0 </span>
                            <br><br>
                            <!-- tabel all susbcriber -->
                            <table id="tabel_friend_manage" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%;">
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
                            <table id="tabel_friend_pending"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">Profile</b></th>
                                        <th><b lang="en">Name</b></th>
                                        <th><b lang="en">Action</b></th>
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








<!-- MODAL FIND FRIEND -->
<div class="modal fade" id="find_friend_modal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <h4 class="modal-title cgrey" lang="en">Find Friend</h4>
            </div>
            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight" lang="en">Name of Username</small>
                            <input type="text" id="name_friend" name="name_friend" class="form-control input-abu"
                                required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
                &nbsp;
                <button type="button" id="btn_find_filter_friend" class="btn btn-tosca btn-sm">
                    <i class="mdi mdi-check btn-icon-prepend">
                    </i> Find </button>
            </div>
        </div>
    </div>
</div>


<!-- MODAL SERTTING MODULE FRIEND -->
<div class="modal fade" id="modal_setting_friend" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_setting_friends" action="{{route('setting_module_friend')}}">
                {{ csrf_field() }}


                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Setting Friends Module</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">
                    <div class="isi_seting_module_friend">

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
                        </i> Setting Module</button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



<!-- MODAL CONFRIM FRIENDS-->
<div class="modal fade" id="modal_confirm_new_friend" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%; min-height: 350px;">
            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <center>
                    <img src="/img/check.png" class="img-modal-teman">
                    <h3 class="cgrey" lang="en">Friend Confirmation</h3>
                    <small class="clight" lang="en">Please give your Confirmation</small>
                </center>
            </div> <!-- end-body -->

            <div class="modal-footer changepass" style="border: none;">
                <form method="POST" id="form_confirm_new_friend" action="{{route('confirm_new_friend')}}">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_new_friend" name="id_new_friend">
                    <center>
                        <button type="submit" name="status_acc" value="3" class="btn btn-light btn-sm"
                            data-dismiss="modal" style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">Reject</span>
                        </button>
                        &nbsp;
                        <button type="submit" name="status_acc" value="2" class="btn btn-accent btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend"></i>
                            <span lang="en">Approve</span>
                        </button>

                    </center>
                </form>
            </div> <!-- end-footer     -->
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>




@endsection
