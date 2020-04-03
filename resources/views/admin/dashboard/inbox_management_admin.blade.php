@extends('layout.admin-dashboard')
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
                data-target="#modal_send_inbox_admin">
                Broadcast Message</button>
        </nav>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Message List
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_generate_inbox_tabel">
                    Generate Message</button>

                <table id="tabel_inbox_message_admin" class="table table-hover table-striped dt-responsive nowrap"
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
                                <h6 class="cgrey2 nama_komunitas" style="margin-top: 1em;"></h6>
                                <input type="text" id="list_komunitas_inbox" name="list_komunitas_inbox"
                                    class="form-control input-abu id_komunitas_login" readonly style="display: none;">
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
<div class="modal fade" id="modal_send_inbox_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_inbox_super" action="{{route('send_inbox_message_admin')}}">
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
                                <select class="form-control input-abu" name="usertipe_inbox1" id="usertipe_inbox1">
                                    <option selected disabled> Choose </option>
                                    <!-- <option value="1"> Admin Commjuction </option> -->
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
                                <h6 class="cgrey2 nama_komunitas" style="margin-top: 1em;"></h6>
                                <input type="text" id="komunitas_inbox" name="komunitas_inbox"
                                    class="form-control input-abu id_komunitas_login" readonly style="display: none;">
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
            <form>
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
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                    display: flex;align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" data-toggle="modal" data-target="#modal_delete_pesan_inbox"
                        data-dismiss="modal" class="btn btn-oren2 btn-sm">
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
                action="{{route('change_status_inbox_message_admin')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="min-height: 130px; padding: 3%;">


                    <div class="row" style="margin-top: 2em;">
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
                        <h3 class="cgrey">Are you Sure ?</h3>
                        <small class="clight">This message will be deleted permanently from system</small>
                    </center>
                </div> <!-- end-body -->
                <div class="modal-footer deleteinbox" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Submit </button>
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

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_generate_inbox_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas_inbox").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#filter_judul").val(),
                "message_type": $("#tipe_pesan").val(),
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    $("#btn_generate_inbox_super").click(function () {
        tabel_tes();
        tabel_inbox_message_admin();
    });

    function tabel_inbox_message_admin() {
        $('#tabel_inbox_message_admin').dataTable().fnClearTable();
        $('#tabel_inbox_message_admin').dataTable().fnDestroy();
        $('#tabel_inbox_message_admin').show();
        $('#modal_generate_inbox_tabel').modal('hide');

        var tabel = $('#tabel_inbox_message_admin').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_generate_inbox_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas_inbox").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "filter_title": $("#filter_judul").val(),
                    "message_type": $("#tipe_pesan").val(),
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_inbox_message_admin tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'id' },
                { mData: 'title' },
                { mData: 'message_type_title' },
                { mData: 'user_type_title' },
                { mData: 'community_name' },
                { mData: 'status' },
                {
                    mData: 'created_at',
                    render: function (data) {
                        return (dateFormat(data));
                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var inidt = [data, row.level_status, row.community_id, row.status];
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_message_inbox_admin(\'' + inidt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }



    $('#bc_status').change(function () {
        var dipilih = this.value;
        if (dipilih == 1) {
            // $("#hide_user_notif").show();
            $("#hide_user_notif").css("display", "block");
            get_list_subscriber();
        } else {
            // $("#hide_user_notif").hide();
            $("#hide_user_notif").css("display", "none");
        }

    });



    //dropdown subs list
    function get_list_subscriber() {
        var itempilih = $("#komunitas_inbox").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_list_subscriber_inbox_admin",
            type: "POST",
            dataType: "json",
            data: {
                "user_type": $("#usertipe_inbox1").val(),
                "community_id": itempilih,
            },
            success: function (result) {
                // console.log(result);

                $('#list_user').empty();
                $('#list_user').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_user').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_user").html($('#list_user option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_user").get(0).selectedIndex = 0; const
                    OldSubf = "{{old('list_user')}}";
                if (OldSubf !== '') {
                    $('#list_user').val(OldSubf);
                }
            },
            error: function (result) {
                $('#list_user').empty();
                $('#list_user').append("<option disabled value='0'>No Related User</option>");
            }
        });

    } //endfunction


    // DETAIL
    function detail_message_inbox_admin(params) {
        // alert(params);
        var dtnya = params.split(',');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/detail_generate_message_inbox_super_admin',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "message_id": dtnya[0],
                "level_status": dtnya[1],
                "community_id": dtnya[2],
            },
            success: function (result) {
                // console.log(result);
                var res = result;
                $("#modal_detail_message_inbox").modal('show');
                $("#detail_judul ").html(res.title);
                $("#detail_dekripsi ").html(res.description);
                $("#detail_komunitas ").html(res.community_name);
                $("#detail_date ").html(res.created_at);
                $("#detail_user ").html(res.user_title);
                $("#detail_usertipe ").html(res.user_type_title);
                $("#detail_tipepesan ").html(res.message_type_title);
                $("#detail_by ").html(res.created_by_title);
                $("#detail_status ").html(res.status);
                $("#id_message_inbox").val(res.id);
                $("#detail_statuspesan ").html(res.status_message);
                $("#detail_senderlevel").html(res.sender_level_title);
                $("#id_inbox").val(res.id);
                $("#level_status").val(res.level_status);

                if (res.status == "Active" && res.status_message == "Send") {
                    $("#status_tipe").val("1");
                    $(".tipe1").show();
                    $(".tipe2").hide();
                    $('#list_status option[id="id1"]').attr("selected", true);

                } else if (res.status == "Not Publish" && res.status_message == "Send") {
                    $("#status_tipe").val("1");
                    $(".tipe1").show();
                    $(".tipe2").hide();
                    $('#list_status option[id="id2"]').attr("selected", true);
                } else if (res.show_status == "Ditampilkan" && res.status_message == "Receive") {
                    $("#status_tipe").val("2");
                    $(".tipe2").show();
                    $(".tipe1").hide();
                    $('#list_status option[id="id3"]').attr("selected", true);
                } else {
                    $("#status_tipe").val("2");
                    $(".tipe2").show();
                    $(".tipe1").hide();
                    $('#list_status option[id="id4"]').attr("selected", true);
                }
            },
            error: function (result) {
                console.log(result);
            }
        });
    }


</script>

@endsection
