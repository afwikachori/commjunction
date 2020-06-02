@extends('layout.subscriber')
@section('title', 'Notification Management')
@section('content')

<!-- <div class="page-header"> -->
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Notification Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey">Manage your notification information<label>
    </div>
    <div class="col-md-5" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <div class="col-md" style="text-align: right;">
                <button type="button" class="btn btn-abu btn-sm" style="min-width: 170px;" data-toggle="modal"
                    data-target="#modal_setting_notification">
                    Setting Notification
                </button>
        </nav>
    </div>
</div>
<!-- </div> -->
<br><br>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-accent btn-sm" style="margin-top: 0.5em; margin-bottom: 2em;" data-toggle="modal"
            data-target="#modal_filter_notif_subs">
            Filter Notification</button>
        </div>
</div>

<div class="row">
    <div id="nodata_card_notif" class="col-md-12" style="margin-right: auto; margin-left: auto; height: 300px;">
        <center>
            <br><br><br><br><br>
            <h1 class="clight" lang="en">No Data Available</h1>
        </center>
    </div>

    <div id="isi_card_notif" class="card-deck" style="width: 100%;">

    </div>
</div>


<!-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body memberku">
                <button type="button" class="btn btn-accent btn-sm" style="margin-top: 0.5em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_filter_notif_subs">
                    Filter Notification</button>

                <table id="tabel_unread_notif" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> ID </b></th>
                            <th><b> Title </b></th>
                            <th><b> Type Notif</b></th>
                            <th><b> User Type </b></th>
                            <th><b> Read Status </b></th>
                            <th><b> Status</b></th>
                            <th><b> Created By </b></th>
                            <th><b> Date </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> -->




<!-- MODAL Filter NOTIFICATION-->
<div class="modal fade" id="modal_filter_notif_subs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Filter Notification</h4>
                </div>

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <br>
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Status Read</small>
                                <br>
                                <select class="form-control input-abu" name="filter_read" id="filter_read">
                                    <option disabled selected> Choose </option>
                                    <option value="1"> Unread </option>
                                    <option value="2"> Read </option>
                                    <option value="3"> Show All </option>
                                </select>
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_notif_admin" class="btn btn-accent btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button>
                </div>
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL NOTIFICATION-->
<div class="modal fade" id="modal_detail_notif" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="border: none; padding-bottom: 0px;">
                    <h4 class="modal-title cgrey">Detail Notification</h4>
                    <small class="cblue" id="status_notif_admin" style="text-align: right;"></small>
                </div> <!-- end-header -->

                <div class="modal-body" style="height: auto;">

                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="/img/notif.png">
                            </center>

                            <h6 class="cgrey">Notification Content</h6>
                            <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 200px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 5%; height: 300px; overflow-y: scroll;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Title</small>
                                            <p class="cgrey" id="detail_judul"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Notification Type</small>
                                            <p class="cgrey" id="detail_tipenotif"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <small class="clight s13">Description</small>
                                            <p class="cgrey" id="detail_dekripsi"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Community Name</small>
                                            <p class="cgrey" id="detail_komunitas"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">User Type</small>
                                            <p class="cgrey" id="detail_usertipe"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Created Date</small>
                                            <p class="cgrey s13" id="detail_tanggal"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Created By</small>
                                            <p class="cgrey s13" id="dibuat_oleh"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="padding-bottom: 0px;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Status Notification</small>
                                            <p class="cgrey s13" id="status_msg" style="margin-bottom: -0.5em;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="clight s13">Specific User</small>
                                            <p class="cgrey s13" id="detail_user" style="margin-bottom: -0.5em;"></p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div> <!-- end-body -->
                <div class="modal-footer" style="border: none; margin-bottom: 0.5em; margin-top: -1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL SETTING  MODULE -->
<div class="modal fade" id="modal_setting_notification" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"
            style="background-color: #ffffff; min-height: 350px; padding-left: 3%; padding-right: 3%;">
            <div class="modal-header" style="padding-bottom: 1.5em !important; border:none;">
                <h3 class="modal-title cgrey">Setting Notification</h3>
                <!-- <label class="badge melengkung10px btn-accent cputih" style="min-width:100px;"> Active</label> -->
            </div> <!-- end-header -->

            <div class="modal-body">
                <form method="POST" id="form_setting_notif_admin" action="{{route('setting_notification_subs')}}">
                    {{ csrf_field() }}
                    <div class="isi_seting_notifadmin">

                    </div>

            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-accent btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i>Setting</button>
                </center>
            </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {

        get_list_setting_notif_subs();
        // tabel_notif_unread();
        show_card_notification();
    });

    function show_card_notification() {
        $('#modal_filter_notif_subs').modal('hide');
        var filter = $("#filter_read").val();

        if (filter != "") {
            var read = filter;
            var limit = 000;
        } else {
            var read = "1";
            var limit = 10;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_list_notif_navbar',
            type: 'POST',
            dataSrc: '',
            data: {
                "read_status": read, //1:notread 2:read
                "limit": limit
            },
            success: function (result) {
                console.log(result);
                if (result.success === false) {
                    $("#isi_card_notif").hide();
                    $("#nodata_card_notif").show();

                } else {
                    if (result.length != 0) {
                        var isiui = '';
                        $.each(result, function (i, item) {
                            var inidt = [item.id, item.level_status, item.community_id];
                            isiui += '<div class="col-md-4 stretch-card grid-margin">' +
                                '<div class="card sumari bg-gradient-kuning">' +
                                '<div class="card-body sumari">' +
                                '<div class="row">' +
                                '<div class="col-9"></div>' +
                                '<div class="col">' +
                                '<i class="mdi mdi-bell-outline mdi-24px float-right top-ico ctosca"></i>' +
                                '</div>' +
                                '</div>' +

                                '<div class="row">' +
                                '<div class="col-md-12">' +
                                '<span class="ctosca s15 tebal" lang="en">' + item.title + '</span>  &nbsp;'+
                                '<span class="cteal s13">(' + item.notification_sub_type_title + ')</span><br>' +
                                '<small class="cgrey2 mt-2">from : </small><br>' +
                                '<small class="cgrey tebal">' + item.sender_level_title + '</small> &nbsp;&nbsp;' +
                                '/ <small class="cgrey2">' + item.created_by_title + '</small><br>' +
                                '<small class="clight mt-2 tebal">' + dateTime(item.created_at) + '</small><br>' +
                                '</div></div>'+
                                '<div class="row mt-3 mb-4">' +
                                '<div class="col-md-7"><small class="cteal">' + item.read_status_title + '</small></div>' +
                                '<div class="col-md-5" style="text-align:right;">' +
                                '<a type="button" class="btn btn-accent btn-sm konco2"' +
                                'onclick="detail_notif_subs(\'' + inidt + '\')">' +
                                '<small class="cwhite" lang="en"><i class="mdi mdi-eye btn-icon-prepend"></i> &nbsp; Detail</small></a>' +
                                '</div>' +
                                '</div>' +

                                '</div>' +
                                '</div>' +
                                '</div>';
                        });
                        $("#isi_card_notif").html(isiui);
                        $("#nodata_card_notif").hide();

                    }
                }
            },
            error: function (result) {
                console.log(result);
                $("#isi_card_notif").hide();
                $("#nodata_card_notif").show();
            }
        });
    }




    $("#btn_generate_notif_admin").click(function () {
        // tabel_notif_unread();
        show_card_notification();
    });



    function tabel_notif_unread() {
        var filter = $("#filter_read").val();

        if (filter != "") {
            var read = filter;
            var limit = 000;
        } else {
            var read = "1";
            var limit = 10;
        }

        var tday = new Date();
        var d = new Date();
        var today = formatDate(d.toLocaleDateString());
        d.setMonth(d.getMonth() - 1);
        var ago = formatDate(d.toLocaleDateString());

        $('#tabel_unread_notif').dataTable().fnClearTable();
        $('#tabel_unread_notif').dataTable().fnDestroy();
        $('#modal_filter_notif_subs').modal('hide');

        var tabel = $('#tabel_unread_notif').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/subscriber/get_list_notif_navbar',
                type: 'POST',
                dataSrc: '',
                data: {
                    "read_status": read, //1:notread 2:read
                    "limit": limit
                },
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_unread_notif tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'id' },
                { mData: 'title' },
                { mData: 'notification_sub_type_title' },
                { mData: 'user_type_title' },
                { mData: 'read_status_title' },
                { mData: 'notification_status' },
                { mData: 'sender_level_title' },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var inidt = [data, row.level_status, row.community_id];
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_notif_subs(\'' + inidt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

        $("#filter_read").val("");

    }



    function get_list_setting_notif_subs() {
        var namakom = $(".community_name").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_list_setting_notif_subs',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/subscriber/url/' + namakom;
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    var uiku = '';
                    var inputipe = '';

                    $.each(result, function (i, item) {

                        if (item.input_type == 1) {
                            inputipe = ' <input type="text" name="param' + item.id + '" value="' + item.value + '" class="form-control input-abu param_setting">';
                        } else if (item.input_type == 2) {
                            if (item.value == 1) {
                                var one = 'checked';
                                var two = '';
                            } else if (item.value == 2) {
                                var one = '';
                                var two = 'checked';
                            } else {
                                var one = '';
                                var two = '';
                            }

                            inputipe = '<div class="form-group">' +
                                '<div class="form-check set_mod" >' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiotrue' + item.id + '" value="1" ' + one + '>' +
                                'True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiofalse' + item.id + '" value="2" ' + two + '>' +
                                'False <i class="input-helper"></i></label>' +
                                '</div>' +
                                '</div>';
                        }

                        uiku += ' <div class="row style="margin-bottom:1.5em;">' +
                            '<div class="col-6">' +
                            '<div class="form-group">' +
                            '<small class="cgrey1 tebal name_setting">' + item.title + '</small>' +
                            '<p class="clight s13 deskripsi_setting">' + item.description +
                            '</p>' +
                            '</div>' +
                            '</div >' +
                            '<div class="col-6">' + inputipe +
                            '<input type="hidden" id="id_set' + item.id + '" name="id_set' + item.id + '" value="' + item.id + '">' +
                            '</div>' +
                            '</div>';
                    });
                    $(".isi_seting_notifadmin").html(uiku);
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    function cek_param_list_user() {
        var comm = $("#komunitas_notif").val();
        var usertipe = $("#usertipe_notif").val();
        if (comm == null || usertipe == null) {
            $("#status_notif").attr("disabled", "disabled");
            swal("Cant Null", "User Type and Community cant be null", "warning");
        } else {
            $("#status_notif").removeAttr("disabled", "disabled");
        }
    }




    var switchStatus = false;
    $("#status_notif").on('change', function () {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
            $("#hide_user_notif").fadeIn('fast');
            cek_param_list_user();
            $("#idstatus_notif").val("1");
        }
        else {
            switchStatus = $(this).is(':checked');
            $("#hide_user_notif").fadeOut('fast');
            cek_param_list_user();
            $("#idstatus_notif").val("2");
        }
    });

    function detail_notif_subs(dtku) {
        // alert(dtku);
        var dtnya = dtku.split(',');
        //   console.log(dtnya);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/detail_notif_subs',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "notification_id": dtnya[0],
                "level_status": dtnya[1],
                "community_id": dtnya[2],
            },
            success: function (result) {
                console.log(result);
                var res = result;
                $("#modal_detail_notif").modal('show');
                $("#detail_judul").html(res.title);
                $("#detail_dekripsi").html(res.description);
                $("#detail_komunitas").html(res.community_name);
                $("#detail_tanggal").html(dateFormat(res.created_at));
                $("#detail_user").html(res.user_title);
                $("#detail_usertipe").html(res.user_type_title);
                $("#detail_tipenotif").html(res.message_type_title);
                $("#dibuat_oleh").html(res.created_by_title);
                $("#status_notif_admin").html(res.status);
                $("#status_msg").html(res.status_message);


            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show Detail");
            }
        });
    }


    $('#tipenotif').change(function () {
        var ipilih = this.value;
        if (ipilih == "1") {
            $("#hide_urlnotif").fadeIn('fast');
        } else {
            $("#hide_urlnotif").fadeOut('fast');
        }
    });


    $('#usertipe_notif').change(function () {
        get_list_user_notif();
    });



</script>

@endsection
