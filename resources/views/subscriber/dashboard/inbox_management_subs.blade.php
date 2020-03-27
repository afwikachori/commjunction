@extends('layout.subscriber')
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
            <!-- <button type="button" class="btn btn-tosca btn-sm">
                Broadcast Message</button> -->
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

                <table id="tabel_inbox_message_subs" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
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
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
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
                action="{{route('change_status_inbox_message_subs')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="min-height: 130px;">
                    <div class="row" style="margin-top: 1.5em;">
                        <div class="col-md-3" style="padding-top: 0.6em;">
                            <small class="clight s13"><b>Status</b></small>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control input-abu" name="list_status" id="list_status">
                                <option selected disabled> Choose </option>
                                <option value="1"> Active </option>
                                <option value="2"> Not Active </option>
                                <option value="3"> Not Publish </option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="id_inbox" name="id_inbox">
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
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
tabel_inbox_message_subs();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/tabel_generate_inbox_subs',
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



    // $("#btn_generate_inbox").click(function () {
    //     tabel_tes();
    //     tabel_inbox_message_subs();
    // });



    function tabel_inbox_message_subs() {
        $('#tabel_inbox_message_subs').dataTable().fnClearTable();
        $('#tabel_inbox_message_subs').dataTable().fnDestroy();
        $('#tabel_inbox_message_subs').show();
        // $('#modal_generate_inbox_tabel').modal('hide');

        var tabel = $('#tabel_inbox_message_subs').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/subscriber/tabel_generate_inbox_subs',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_inbox_message_subs tbody').empty().append(nofound);
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
                { mData: 'created_at',
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
            url: "/subscriber/get_list_subscriber_inbox",
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


    function detail_message_inbox_admin(params) {
        // alert(params);
        var dtnya = params.split(',');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/detail_inbox_subscriber',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "message_id": dtnya[0],
                "level_status": dtnya[1],
                "community_id": dtnya[2],
            },
            success: function (result) {
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
                $("#id_inbox").val(res.id);

                var nil = res.status;
                if(nil == "Active"){
                    $("#list_status").val("1");
                }else if(nil == "Not Active"){
                     $("#list_status").val("2");
                }else{
                    $("#list_status").val("3");
                }

                $("#detail_statuspesan ").html(res.status_message);
                $("#detail_senderlevel").html(res.sender_level_title);


            },
            error: function (result) {
                console.log(result);
            }
        });
    }


</script>

@endsection
