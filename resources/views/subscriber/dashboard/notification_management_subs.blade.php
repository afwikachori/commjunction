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
<br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body memberku">
                    <h4 class="cgrey" style="margin-bottom: -0.5em;">Module List</h4>

                    <div class="tabbable-line">
                        <ul class="nav nav-tabs">
                            <li class="tab-subs" id="tab_generate">
                                <a href="#tab_module_1" data-toggle="tab">
                                    Filter
                                </a>
                            </li>
                            <li class="tab-subs active" id="tab_unread">
                                <a href="#tab_module_2" data-toggle="tab">
                                    Unread
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="tab_module_1">
                                <button type="button" class="btn btn-tosca btn-sm"
                                    style="margin-top: 0.5em; margin-bottom: 2em;" data-toggle="modal"
                                    data-target="#modal_filter_notif_admin">
                                    Filter Notification</button>

                                <table id="tabel_generate_notif"
                                    class="table table-hover table-striped dt-responsive nowrap" style="width:100%;">
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
                            </div> <!-- end-tab 1  -->


                            <div class="tab-pane active" id="tab_module_2">
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
                            </div> <!-- end-tab2 -->
                        </div> <!-- end-content -->
                    </div> <!-- end-tab line -->
                </div>
            </div>
        </div>
    </div>


<!-- MODAL GENERATED NOTIFICATION-->
<div class="modal fade" id="modal_filter_notif_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Notification</h4>
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
                                <h5 class="nama_komunitas cgrey2" style="margin-top: 1em;"></h5>
                                <input type="hidden" class="form-control input-abu id_komunitas" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Notification Sub Type</small>
                                <select class="form-control input-abu" name="tipe_notif" id="tipe_notif">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> System </option>
                                    <option value="2"> Module </option>
                                    <option value="3"> Single </option>
                                    <option value="4"> Broadcast </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="clight s13">Notification Title</small>
                                <input type="text" id="list_judul_notif" name="list_judul_notif"
                                    class="form-control input-abu">
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
                    <button type="button" id="btn_generate_notif_admin" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
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
                            padding: 5%;">
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
                <!-- <label class="badge melengkung10px btn-tosca cputih" style="min-width:100px;"> Active</label> -->
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
                    <button type="submit" class="btn btn-teal btn-sm">
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
        tabel_notif_unread();
    });


       function tabel_tes() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/subscriber/tabel_generate_notification_subs',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $(".id_komunitas").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "filter_title": $("#list_judul_notif").val(),
                    "notification_sub_type": $("#tipe_notif").val(),
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


    function tabel_notif_unread() {
        var tday = new Date();
        var d = new Date();
        var today = formatDate(d.toLocaleDateString());
        d.setMonth(d.getMonth() - 1);
        var ago = formatDate(d.toLocaleDateString());

        $('#tabel_unread_notif').dataTable().fnClearTable();
        $('#tabel_unread_notif').dataTable().fnDestroy();
        // $('#modal_generate_inbox_tabel').modal('hide');

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
                    "community_id": $(".id_komunitas").val(),
                    "start_date": ago,
                    "end_date": today,
                    "read_status": "1", //1:notread 2:read
                    "notification_status": "receive", //send/receive
                    "limit": 10
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
                            'onclick="detail_notif_admin(\'' + inidt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

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
                console.log(result);
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
                            if(item.value == 1){
                                var one = 'checked';
                                var two = '';
                            }else if(item.value == 2){
                                  var one = '';
                                var two = 'checked';
                            }else{
                                   var one = '';
                                var two = '';
                            }

                            inputipe = '<div class="form-group">' +
                                '<div class="form-check set_mod" >' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiotrue' + item.id + '" value="1" '+one+'>' +
                                'True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiofalse' + item.id + '" value="2" '+two+'>' +
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


    $("#btn_generate_notif_admin").click(function () {
        // tabel_generate_notif();
        tabel_tes();
    });


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


    function tabel_generate_notif() {
        $('#tabel_generate_notif').dataTable().fnClearTable();
        $('#tabel_generate_notif').dataTable().fnDestroy();
        $('#tabel_generate_notif').show();
        $('#modal_filter_notif_admin').modal('hide');

        var tabel = $('#tabel_generate_notif').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/subscriber/tabel_generate_notification_subs',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $(".id_komunitas").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "filter_title": $("#list_judul_notif").val(),
                    "notification_sub_type": $("#tipe_notif").val(),
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_generate_notif tbody').empty().append(nofound);
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
                            'onclick="detail_notif_admin(\'' + inidt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

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

    function detail_notif_admin(dtku) {
        var dtnya = dtku.split(',');
        //   console.log(dtnya);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/detail_generate_notif_admin',
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


    //dropdown subs_name list
    function get_list_user_notif() {
        var itempilih = $('#komunitas_notif').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_list_user_notif_super",
            type: "POST",
            dataType: "json",
            data: {
                "user_type": $("#usertipe_notif").val(),
                "community_id": itempilih,
            },
            success: function (result) {
                console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    $('#user_notif').empty();
                    $('#user_notif').append("<option disabled value='0'> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#user_notif').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#user_notif").html($('#user_notif option').sort(function (x, y) {
                        return $(x).val() < $(y).val() ? -1 : 1;
                    }));

                    $("#user_notif").get(0).selectedIndex = 0; const
                        OldSubf = "{{old('user_notif')}}";
                    if (OldSubf !== '') {
                        $('#user_notif').val(OldSubf);
                    }
                }
            },
            error: function (result) {
                $('#hide_user_notif').fadeOut("fast");
                $('#user_notif').empty();
                $('#user_notif').append("<option disabled value='0'>No Related User</option>");
            }
        });
    }
    //end list subscriber


</script>

@endsection
