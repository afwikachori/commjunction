@extends('layout.admin-dashboard')
@section('title', 'Forum Member')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Member Forum Module</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your forum and group or members activity<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <small class="cgrey2">ID Group </small>
        <input type="text" id="id_group" value="{{ $id_group }}" readonly>
    </div>
</div>
<br>

<div class="row">
    <div id="page_member_forum_admin"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                <span lang="en">Member</span>
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
                            <div class="row mgb-1">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 kananin">
                                    <button type="button" class="btn btn-teal btn-sm melengkung10px" data-toggle="modal"
                                    data-target="#modal_bc_pesan_member" lang="en">Broadcast
                                    Member</button>
                                    &nbsp; &nbsp;
                                    <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_invite_member"
                                        lang="en">Invite Member</button>
                                </div>
                            </div>
                            <br>

                            <table id="tabel_memberlist_admin"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID User</b></th>
                                        <th><b lang="en">Name</b></th>
                                        <th><b lang="en">Profile</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Admin</b></th>
                                        <th><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <table id="tabel_memberpending_admin"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID User</b></th>
                                        <th><b lang="en">Name</b></th>
                                        <th><b lang="en">Profile</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Admin</b></th>
                                        <th><b lang="en">Approval</b></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL INVITE MEMBER -->
<div class="modal fade" id="modal_invite_member" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h3 class="modal-title" lang="en">Invite Member Group</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="form_invite_member" action="{{route('post.admin.forum-invitemember')}}">
                {{ csrf_field() }}
                <input type="hidden" name="group_id_member" value="{{ $id_group }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="cgrey">List Subscriber</h6>
                            <div class="form-group invit-member" id="isi_memberlist">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer"
                    style="border: none; margin-bottom: 0.5em;
                            display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Add</span></button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- MODAL APPROVAL MEMBER -->
<div class="modal fade" id="modal_approval_member" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%; min-height: 350px;">
            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <center>
                    <img src="/img/check.png" class="img-icon-acc">
                    <h3 class="cgrey" lang="en">Member Approval</h3>
                    <small class="clight" lang="en">Please give your approval to <b><span id="nama_pendingmember">new
                                member</span></b></small>
                </center>
            </div> <!-- end-body -->

            <div class="modal-footer modal-acc">
                <form method="POST" id="form_acc_member_pending" action="{{route('post.admin.forum-accmember')}}">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_group_acc" name="id_group_acc" value="{{ $id_group }}" readonly>
                    <input type="hidden" id="user_id" name="user_id" readonly>

                    <center>
                        <button type="submit" name="status_acc" value="3" class="btn btn-light btn-sm"
                            data-dismiss="modal" style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">Reject</span>
                        </button>
                        &nbsp;
                        <button type="submit" name="status_acc" value="2" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend"></i>
                            <span lang="en">Approve</span>
                        </button>
                    </center>
                </form>
            </div>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>



<!-- MODAL DELETE MEMBER-->
<div class="modal fade" id="modal_delete_member" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%;
        min-height: 350px;">

            <form method="POST" id="form_delete_member" action="{{route('post.admin.forum-deletemember')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <center>
                        <img src="/visual/warning.png" id="img_signout_admin">
                        <h3 class="cgrey" lang="en">Confirmation</h3>
                        <small class="clight" lang="en">Are you sure, you want to delete
                            <span id="nama_del_member" class="tebal">this member</span>
                            from this group ?</small>


                        <input type="hidden" id="user_id_del" name="user_id_del" readonly>
                        <input type="hidden" name="group_id" value="{{ $id_group }}" readonly>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer changepass" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">No, Im Doubt</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-tosca btn-sm" style="border-radius: 10px;">
                            <i class="mdi mdi-check"></i> <span lang="en">Yes, Sure</span>
                        </button>
                    </center>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>


<!-- MODAL SEND MESSAGE-->
<div class="modal fade" id="modal_bc_pesan_member" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_bc_member" action="{{route('post.admin.forum-bcmember')}}">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Broadcast Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 300px;">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight">Subject Title</small>
                                <input type="text" id="judul_pesan" name="judul_pesan"
                                    class="form-control input-abu melengkung10px" required>
                            </div>
                            <div class="form-group">
                                <small class="clight">Message Description</small>
                                <textarea class="form-control input-abu" id="deskripsi_pesan" rows="8"
                                    name="deskripsi_pesan"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="group_id" value="{{ $id_group }}" readonly>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send</button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
