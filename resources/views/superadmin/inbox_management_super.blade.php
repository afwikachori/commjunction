@extends('layout.superadmin')

@section('title', 'Inbox Management')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inbox Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your message information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" style="min-width: 170px;" data-toggle="modal"
                data-target="#modal_send_inbox_super">
                Broadcast Message</button>
        </nav>
    </div>
</div>

<br>
<div class="row">
    <div id="page_inbox_management_super"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Message List
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_generate_inbox_tabel">
                    Generate Message</button>

                <table id="tabel_inbox_message_super" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th><b> ID </b></th>
                            <th><b> Title Message</b></th>
                            <th><b> Inbox Type</b></th>
                            <th><b> User Type </b></th>
                            <th><b> Community</b></th>
                            <th><b> Status</b></th>
                            <th><b> Date </b></th>
                            <th><b> Action </b></th>
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
                    <h4 class="modal-title cgrey">Generate Inbox</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community</small>
                                <select class="form-control input-abu" name="list_komunitas_inbox"
                                    id="list_komunitas_inbox">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Message Type</small>
                                <select class="form-control input-abu" name="tipe_pesan" id="tipe_pesan">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> System </option>
                                    <option value="2"> Module</option>
                                    <option value="3"> Single Send </option>
                                    <option value="4"> Broadcast</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Filter Title</small>
                                <input type="text" id="filter_judul" name="filter_judul" class="form-control input-abu">
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_inbox_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL ADD SEND MESSAGE INBOX-->
<div class="modal fade" id="modal_send_inbox_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_inbox_super" action="{{route('send_inbox_message_super')}}">
                {{ csrf_field() }}
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Message</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Message Title</small>
                                <input type="text" id="judul_inbox" name="judul_inbox" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User Type</small>
                                <select class="form-control input-abu" name="usertipe_inbox" id="usertipe_inbox">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Commjuction </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Message Description</small>
                                <textarea type="text" id="deksripsi_inbox" name="deksripsi_inbox"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="clight s13">Message Type</small>
                            <select class="form-control input-abu" name="tipe_inbox" id="tipe_inbox">
                                <option selected disabled> Choose </option>
                                <option value="1"> System </option>
                                <option value="2"> Module </option>
                                <option value="3"> Single Send </option>
                                <option value="4"> Broadcast</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community</small>
                                <select class="form-control input-abu" name="komunitas_inbox" id="komunitas_inbox">

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Broadcast Status</small>
                                <select class="form-control input-abu" name="bc_status" id="bc_status">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Single</option>
                                    <option value="2"> Broadcast</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hide_user_notif" style="display: none;">
                                <small class="clight s13">List User</small>
                                <select class="form-control input-abu" name="list_user" id="list_user">
                                    <option selected disabled> Choose Community </option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_send_notif_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Send </button>
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
            <form id="">
                <div class="modal-header" style="border: none; padding-bottom: 0px;
                padding-left: 5%; padding-right: 5%;">
                    <h4 class="modal-title cdarkgrey">Detail Message Inbox</h4>
                    <button type="button" class="btn btn-tosca btn-sm" style="text-align:right;" data-toggle="modal"
                        data-target="#modal_changestatus_inbox" data-dismiss="modal">Change Status</button>
                </div> <!-- end-header -->

                <div class="modal-body" style="height: auto; padding-left: 5%; padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Title</small>
                                <p class="cgrey" id="detail_judul"></p>
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Description</small>
                                <p class="cgrey" id="detail_dekripsi"></p>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 200px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 5%;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Message Type</small>
                                    <p class="cgrey" id="detail_tipepesan"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Community Name</small>
                                    <p class="cgrey" id="detail_komunitas"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">User Type</small>
                                    <p class="cgrey" id="detail_usertipe"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Specific User</small>
                                    <p class="cgrey" id="detail_user"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Created Date</small>
                                    <p class="cgrey s11" id="detail_date"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight">Created By</small>
                                    <p class="cgrey" id="detail_by"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Status Message</small>
                                    <p class="cgrey" id="detail_statuspesan"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Sender Level</small>
                                    <p class="cgrey" id="detail_senderlevel"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-6">
                            <small class="clight s13"><b>Status</b></small>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <b><small class="cblue s13" id="detail_status">-</small></b>
                        </div>
                    </div>
                    <input type="hidden" id="id_message_inbox" name="id_message_inbox">




                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                    display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_delete_message" class="btn btn-oren2 btn-sm">
                        <i class="mdi mdi-delete btn-icon-prepend">
                        </i> Delete </button>
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
                <h4 class="modal-title">Change Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form_change_status_inbox_super"
                action="{{route('change_status_inbox_message_super')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="min-height: 130px;">
                    <div class="row" style="margin-top: 1em;">
                        <div class="col-md-3" style="padding-top: 0.6em;">
                            <small class="clight s13"><b>Status</b></small>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control input-abu" name="list_status" id="list_status">
                                <option selected disabled> Choose </option>
                                <option value="1" class="tipe1" id="id1"> Active </option>
                                <option value="2" class="tipe1" id="id2"> Not Publish </option>
                                <option value="1" class="tipe2" id="id3"> Show </option>
                                <option value="2" class="tipe2" id="id4"> Not Show </option>
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
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_change_status" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Change </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
