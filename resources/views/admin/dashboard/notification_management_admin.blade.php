@extends('layout.admin-dashboard')

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
            <div class="row">
                <div class="col-md" style="text-align: right;">
                    <button type="button" class="btn btn-abu btn-sm" style="min-width: 170px;" data-toggle="modal"
                        data-target="#modal_setting_notification">
                        Setting Notification</button>
                </div>
                <div class="col-md">
                    <button type="button" class="btn btn-tosca btn-sm" style="min-width: 170px;" data-toggle="modal"
                        data-target="#modal_send_notif_super">
                        Broadcast Notification</button>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- </div> -->
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Notification List

            </div>

            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_filter_notif_admin">
                    Generate Notification</button>

                <table id="tabel_generate_notif_admin" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th><b> ID </b></th>
                            <th><b> Title </b></th>
                            <th><b> Type Notif</b></th>
                            <th><b> User Type </b></th>
                            <th><b> Community Type </b></th>
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
</div> <!-- endrow -->


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
                                <input class="form-control input-abu" name="list_komunitas_notif"
                                    id="list_komunitas_notif" value="104" readonly>
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

<!-- MODAL ADD SEND NOTIFICATION-->
<div class="modal fade" id="modal_send_notif_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form method="POST" id="form_send_notification_super" action="{{route('send_notification_admin')}}">
                {{ csrf_field() }}<div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Send Notification</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Notification Title</small>
                                <input type="text" id="judul_notif" name="judul_notif" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User Type</small>
                                <select class="form-control input-abu" name="usertipe_notif" id="usertipe_notif">
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
                                <small class="clight s13">Notification Description</small>
                                <textarea type="text" id="deksripsi_notif" name="deksripsi_notif"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="clight s13">Notification Sub-Type</small>
                            <select class="form-control input-abu" name="subtipe_notif" id="subtipe_notif">
                                <option selected disabled> Choose </option>
                                <option value="1"> System </option>
                                <option value="2"> Module </option>
                                <option value="3"> Single </option>
                                <option value="4"> Broadcast </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community</small>
                                <input name="komunitas_notif" id="komunitas_notif" class="form-control input-abu"
                                    value="104" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Notification Type</small>
                                <select class="form-control input-abu" name="tipenotif" id="tipenotif">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Push Notification </option>
                                    <option value="2"> Mail Notification </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hide_urlnotif" style="display: none;">
                                <small class="clight s13">Notification URL</small>
                                <input type="text" id="url_notif" name="url_notif" placeholder="http://xxx/xxx/..."
                                    class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Broadcast Status</small>
                                <div class="custom-control custom-switch" style="margin-top: 1em;">
                                    <input type="checkbox" class="custom-control-input" id="status_notif">
                                    <label class="custom-control-label" for="status_notif">
                                        Add Spesific User</label>
                                </div>
                                <input type="hidden" id="idstatus_notif" name="idstatus_notif" value="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hide_user_notif" style="display: none;">
                                <small class="clight s13">List User</small>
                                <select class="form-control input-abu" name="user_notif" id="user_notif">

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
                    &nbsp;
                    <button type="button" id="btn_list_setting_notif" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> List Setting </button>
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
            <div class="modal-header" style="padding-bottom: 2em !important; border:none;">
                <h3 class="modal-title cgrey">Setting Notification</h3>
                <!-- <label class="badge melengkung10px btn-tosca cputih" style="min-width:100px;"> Active</label> -->
            </div> <!-- end-header -->

            <div class="modal-body">
                <form method="POST" id="form_setting_notif_admin" action="{{route('setting_notification_admin')}}">
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
        get_list_setting_notif_admin();
    });


    function get_list_setting_notif_admin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_list_setting_notif_admin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);

                var uiku = '';
                var inputipe = '';

                $.each(result, function (i, item) {

                    if (item.input_type == 1) {
                        inputipe = ' <input type="text" name="param' + item.id + '" value="'+item.value+'" class="form-control input-abu param_setting">';
                    } else if (item.input_type == 2) {
                        inputipe = '<div class="form-group">' +
                            '< div class="form-check" >' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiotrue' + item.id + '" value="1">' +
                            'True <i class="input-helper"></i></label>' +
                            '</div>' +
                            '<div class="form-check">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiofalse' + item.id + '" value="2">' +
                            'False <i class="input-helper"></i></label>' +
                            '</div>' +
                            '</div>';
                    }

                    uiku += ' <div class="row">' +
                        '<div class="col-7">' +
                        '<div class="form-group">' +
                        '<small class="cgrey1 tebal name_setting">' + item.title + '</small>' +
                        '<p class="clight s13 deskripsi_setting">' + item.description +
                        '</p>' +
                        '</div>' +
                        '</div >' +
                        '<div class="col-5">' + inputipe +
                        '<input type="hidden" id="id_set' + item.id + '" name="id_set' + item.id + '" value="' + item.id + '">' +
                        '</div>' +
                        '</div>';
                });
                $(".isi_seting_notifadmin").html(uiku);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }





    $("#btn_generate_notif_admin").click(function () {
        tabel_generate_notif_admin();
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


    function tabel_generate_notif_admin() {
        $('#tabel_generate_notif_admin').dataTable().fnClearTable();
        $('#tabel_generate_notif_admin').dataTable().fnDestroy();
        $('#tabel_generate_notif_admin').show();
        $('#modal_filter_notif_admin').modal('hide');

        var tabel = $('#tabel_generate_notif_admin').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_generate_notification_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas_notif").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "filter_title": $("#list_judul_notif").val(),
                    "notification_sub_type": $("#tipe_notif").val(),
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_generate_notif_admin tbody').empty().append(nofound);
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
                { mData: 'community_name' },
                { mData: 'notification_status' },
                { mData: 'sender_level_title' },
                { mData: 'created_at' },
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
                // console.log(result);
                var res = result;
                $("#modal_detail_notif").modal('show');
                $("#detail_judul ").html(res.title);
                $("#detail_dekripsi ").html(res.description);
                $("#detail_komunitas ").html(res.community_name);
                $("#detail_tanggal ").html(res.created_at);
                $("#detail_user").html(res.user_title);
                $("#detail_usertipe ").html(res.user_type_title);
                $("#detail_tipenotif ").html(res.message_type_title);
                $("#dibuat_oleh ").html(res.created_by_title);
                $("#status_notif_admin").html(res.status);
                $("#status_msg").html(res.status_message);


            },
            error: function (result) {
                console.log("Cant Show");
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

    //dropdown subs_name list
    $('#komunitas_notif').change(function () {
        var itempilih = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_user_notif_super",
            type: "POST",
            dataType: "json",
            data: {
                "user_type": $("#usertipe_notif").val(),
                "community_id": itempilih,
            },
            success: function (result) {
                console.log(result);
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



            },
            error: function (result) {
                $('#hide_user_notif').fadeOut("fast");
                $('#user_notif').empty();
                $('#user_notif').append("<option disabled value='0'>No Related User</option>");
            }
        });
    });
    //end list subscriber


</script>

@endsection
