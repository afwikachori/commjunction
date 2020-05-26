@extends('layout.admin-dashboard')
@section('title', 'Inbox Management')
@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Inbox Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your message information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<br>
<div class="row">
    <div id="page_inbox_management_admin"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih" lang="en">
                <div class="row">
                <span class="col-md" lang="en">Message List</span>
                <div class="col-md" style="text-align: right;">
                   <button type="button" class="btn btn-tosca2 btn-sm" style="min-width: 170px;" data-toggle="modal"
                data-target="#modal_send_inbox_admin" lang="en" data-lang-token="Broadcast Message">Broadcast Message</button>
                </div>
            </div>
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_generate_inbox_tabel" lang="en" data-lang-token="Generate Message">Generate Message</button>

                <table id="tabel_inbox_message_admin" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th><b lang="en">ID</b></th>
                            <th><b lang="en">Title Message</b></th>
                            <th><b lang="en">Inbox Type</b></th>
                            <th><b lang="en">User Type</b></th>
                            <th><b lang="en">Community</b></th>
                            <th><b lang="en">Status</b></th>
                            <th><b lang="en">Date</b></th>
                            <th><b lang="en">Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->

<!-- MODAL GENERATED Message-->
<div class="modal fade" id="modal_generate_inbox_tabel" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form id="form_generate_tabel_inbox">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Generate Inbox</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Community</small>
                                <h6 class="cgrey2 nama_komunitas" style="margin-top: 1em;"></h6>
                                <input type="text" id="list_komunitas_inbox" name="list_komunitas_inbox"
                                    class="form-control input-abu id_komunitas_login" readonly style="display: none;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Message Type</small>
                                <select class="form-control input-abu" name="tipe_pesan" id="tipe_pesan">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">System</option>
                                    <option value="2" lang="en">Module</option>
                                    <option value="3" lang="en">Single Send</option>
                                    <option value="4" lang="en">Broadcast</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Filter Title</small>
                                <input type="text" id="filter_judul" name="filter_judul" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_inbox_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Generate</span></button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL ADD SEND MESSAGE INBOX-->
<div class="modal fade" id="modal_send_inbox_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_inbox_super" action="{{route('send_inbox_message_admin')}}">
                {{ csrf_field() }}
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey" lang="en">Send Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Message Title</small>
                                <input type="text" id="judul_inbox" name="judul_inbox" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">User Type</small>
                                <select class="form-control input-abu" name="usertipe_inbox1" id="usertipe_inbox1">
                                    <option selected disabled lang="en">Choose</option>
                                    <!-- <option value="1"> Admin Commjuction </option> -->
                                    <option value="2" lang="en">Admin Community</option>
                                    <option value="3" lang="en">Subscriber</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Message Description</small>
                                <textarea type="text" id="deksripsi_inbox" name="deksripsi_inbox"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="clight s13" lang="en">Message Type</small>
                            <select class="form-control input-abu" name="tipe_inbox" id="tipe_inbox">
                                <option selected disabled lang="en">Choose</option>
                                <option value="1" lang="en">System</option>
                                <option value="2" lang="en">Module</option>
                                <option value="3" lang="en">Single Send</option>
                                <option value="4" lang="en">Broadcast</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Community</small>
                                <h6 class="cgrey2 nama_komunitas" style="margin-top: 1em;"></h6>
                                <input type="text" id="komunitas_inbox" name="komunitas_inbox"
                                    class="form-control input-abu id_komunitas_login" readonly style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Broadcast Status</small>
                                <select class="form-control input-abu" name="bc_status" id="bc_status">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">Single</option>
                                    <option value="2" lang="en">Broadcast</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hide_user_notif" style="display: none;">
                                <small class="clight s13" lang="en">List User</small>
                                <select class="form-control input-abu" name="list_user" id="list_user">

                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_send_notif_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Send</span></button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL DETAIL INBOX MESSAGE -->
<div class="modal fade" id="modal_detail_message_inbox" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="border: none; padding-bottom: 0px;
                padding-left: 5%; padding-right: 5%;">
                    <h4 class="modal-title cdarkgrey" lang="en">Detail Message Inbox</h4>
                    <button type="button" class="btn btn-tosca btn-sm" style="text-align:right;" data-toggle="modal"
                        data-target="#modal_changestatus_inbox" data-dismiss="modal" lang="en">Change Status</button>
                </div> <!-- end-header -->

                <div class="modal-body" style="height: auto; padding-left: 5%; padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Title</small>
                                <p class="cgrey" id="detail_judul"></p>
                            </div>
                            <div class="form-group">
                                <small class="clight s13" lang="en">Description</small>
                                <div style="width: 100%; height: 50px; overflow-y: scroll;">
                                    <p class="cgrey" id="detail_dekripsi"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 200px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 5%; padding-bottom: 0;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Message Type</small>
                                    <p class="cgrey" id="detail_tipepesan"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Community Name</small>
                                    <p class="cgrey" id="detail_komunitas"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">User Type</small>
                                    <p class="cgrey" id="detail_usertipe"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Specific User</small>
                                    <p class="cgrey" id="detail_user"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Created Date</small>
                                    <p class="cgrey s11" id="detail_date"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight" lang="en">Created By</small>
                                    <p class="cgrey" id="detail_by"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Status Message</small>
                                    <p class="cgrey" id="detail_statuspesan"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13" lang="en">Sender Level</small>
                                    <p class="cgrey" id="detail_senderlevel"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-6">
                            <small class="clight s13"><b lang="en">Status</b></small>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <b><small class="cblue s13" id="detail_status">-</small></b>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                    display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" data-toggle="modal" data-target="#modal_delete_pesan_inbox"
                        data-dismiss="modal" class="btn btn-oren2 btn-sm">
                        <i class="mdi mdi-delete btn-icon-prepend">
                        </i><span lang="en">Delete</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL CHANGE STATUS  -->
<div class="modal fade" id="modal_changestatus_inbox" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="border: none;">
                <h4 class="modal-title" lang="en">Change Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form_change_status_inbox_super"
                action="{{route('change_status_inbox_message_admin')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="min-height: 130px; padding: 3%;">


                    <div class="row" style="margin-top: 2em;">
                        <div class="col-md-3" style="padding-top: 0.6em;">
                            <small class="clight s13"><b lang="en">Status</b></small>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control input-abu" name="list_status" id="list_status">
                                <option selected disabled lang="en">Choose</option>
                                <option value="1" class="tipe1" id="id1" lang="en">Active</option>
                                <option value="2" class="tipe1" id="id2" lang="en">Not Publish</option>
                                <option value="1" class="tipe2" id="id3" lang="en">Show</option>
                                <option value="2" class="tipe2" id="id4" lang="en">Not Show</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control input-abu" name="status_tipe" id="status_tipe">
                    <input type="hidden" id="id_inbox" name="id_inbox">
                    <input type="hidden" id="level_status" name="level_status">
                </div>
                <div class="modal-footer"
                    style="border: none; margin-bottom: 0.5em;
                            display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_change_status" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Change</span></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL DELETE INBOX-->
<div class="modal fade" id="modal_delete_pesan_inbox" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; width: 80%;
    min-height: 350px;">
            <form method="POST" id="form_delete_inbox_admin" action="{{route('delete_message_inbox_admin')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <input type="hidden" id="id_message_inbox" name="id_message_inbox">
                    <center>
                        <img src="/visual/warning.png" class="img_mdl_centerin">
                        <h3 class="cgrey" lang="en">Are you Sure ?</h3>
                        <small class="clight" lang="en">This message will be deleted permanently from system</small>
                    </center>
                </div> <!-- end-body -->
                <div class="modal-footer deleteinbox" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i><span lang="en">Submit</span></button>
                    </center>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {

    });



</script>

@endsection
