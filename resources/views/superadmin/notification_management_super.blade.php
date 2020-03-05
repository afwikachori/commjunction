@extends('layout.superadmin')

@section('title', 'Notification Management')

@section('content')
<!-- <div class="page-header"> -->
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Notification Management</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your notification information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <button type="button" class="btn btn-tosca btn-sm" style="min-width: 170px;" data-toggle="modal"
                data-target="#modal_send_notif_super">
                Broadcast Notification</button>
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
                    data-toggle="modal" data-target="#modal_filter_notif_super">
                    Generate Notification</button>
                <button type="button" class="btn btn-abu btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_detail_notif">
                    detail ex</button>


                <table id="tabel_log_magement_super" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> ID </b></th>
                            <th><b> Type Notif</b></th>
                            <th><b> User Type </b></th>
                            <th><b> Notification Title </b></th>
                            <th><b> Content</b></th>
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
<div class="modal fade" id="modal_filter_notif_super" data-backdrop="static" tabindex="-1" role="dialog"
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
                                <select class="form-control input-abu" name="list_komunitas_notif"
                                    id="list_komunitas_notif">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Notification Type</small>
                                <select class="form-control input-abu" name="tipe_notif" id="tipe_notif">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Push Notification </option>
                                    <option value="2"> Mail Notification </option>
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
                    <button type="button" id="btn_generate_notif_super" class="btn btn-teal btn-sm">
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
            <form method="POST" id="form_send_notification_super"
            action="{{route('send_notification_super')}}">
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
                                <select class="form-control input-abu" name="komunitas_notif" id="komunitas_notif">

                                </select>
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
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Detail Notification</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <i class="mdi mdi-bell-ring icon-lg text-success"
                                    style="font-size: 6em; margin-top: 1em;"></i>
                                <br>
                            </center>

                            <small class="clight">Notification Content</small>

                            <div
                                style="background-color: #d1d1d1; width: 50px; height: 50px; border-radius: 10px; width: 100%; height: 200px; margin-top: 0.5em;">
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
                    <button type="button" id="btn_list_setting_notif" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> List Setting </button>
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
        get_list_komunitas();

    });


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_generate_notification_super',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "community_id": $("#list_komunitas_notif").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#list_judul_notif").val(),
                "notification_sub_type": $("#tipe_notif").val(),
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }





    $("#btn_generate_notif_super").click(function () {
        // tabel_log_magement_super();
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



    function tabel_log_magement_super() {
        $('#tabel_log_magement_super').dataTable().fnClearTable();
        $('#tabel_log_magement_super').dataTable().fnDestroy();

        $('#tabel_log_magement_super').show();
        $('#modal_filter_notif_super').modal('hide');

        var tabel = $('#tabel_log_magement_super').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', {
                    text: 'JSON',
                    action: function (e, dt, button, config) {
                        var data = dt.buttons.exportData();

                        $.fn.dataTable.fileSave(
                            new Blob([JSON.stringify(data)]),
                            'Export.json'
                        );
                    }
                }
            ],
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_log_management_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "user_level": $("#list_userlevel").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_log_magement_super tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'user_name' },
                { mData: 'user_level' },
                { mData: 'module' },
                { mData: 'activity' },
                { mData: 'endpoint' },
                { mData: 'date' },
                { mData: 'code_response' },
                {
                    mData: 'code_response',
                    render: function (data, type, row, meta) {
                        var dt = [row.response];

                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_log_super(\'' + data + '\')">' +
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


    //dropdown komunitas list
    function get_list_komunitas() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/list_komunitas_log",
            type: "POST",
            dataType: "json",
            success: function (result) {
                $('#list_komunitas_notif').empty();
                $('#list_komunitas_notif').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas_notif').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_komunitas_notif").html($('#list_komunitas_notif option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_komunitas_notif").get(0).selectedIndex = 0;
                // _________________________________________________________________________

                $('#komunitas_notif').empty();
                $('#komunitas_notif').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_notif').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_notif").html($('#komunitas_notif option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komunitas_notif").get(0).selectedIndex = 0;
                    Olddt = "{{old('usekomunitas_notifr_notif')}}";
                if (Olddt !== '') {
                    $('#komunitas_notif').val(Olddt);
                }

            }
        });
    } //endfunction

    function detail_log_super(resp) {
        console.log(resp);
    }


     $('#tipenotif').change(function () {
         var ipilih = this.value;
         if(ipilih == "1"){
            $("#hide_urlnotif").fadeIn('fast');
         }else{
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
