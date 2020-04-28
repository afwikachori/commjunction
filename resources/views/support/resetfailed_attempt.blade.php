@extends('layout.support-master')
@section('title', 'Reactivate/Deactivate ')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Reset Failed Attempt</h3>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3 form-group">
                        <small class="clight s13">Choose Community</small>
                        <select class="form-control list-blue" name="list_komunitas" id="list_komunitas" required>
                            <option selected disabled> Loading ... </option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="tabbable-line" style="margin-top: -2.2em;">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_com">
                            <a href="#tab_default_1" data-toggle="tab">
                                Admin
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_subs">
                            <a href="#tab_default_2" data-toggle="tab">
                                Subscriber
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">


                            <!-- tabel all susbcriber -->
                            <table id="tabel_admin_komunitas"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b>ID User</b></th>
                                        <th><b>Photo</b></th>
                                        <th><b>Full Name</b></th>
                                        <th><b>username</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Reset Attempt</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">


                            <!-- tabel all susbcriber -->
                            <table id="tabel_subscriber" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b>ID User</b></th>
                                        <th><b>Photo</b></th>
                                        <th><b>Full Name</b></th>
                                        <th><b>username</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Reset Attempt</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- MODAL REACTIVE KOMUNITAS-->
<div class="modal fade" id="modal_update_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div style="padding-left: 15%; padding-top: 5%;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Reactive or Deactive</small>
                <br>
                <h4 class=" cblue">Community</h4>
            </div>

            <form method="POST" id="form_acc_req_membership" action="{{route('change_status_reactive')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body detail_member">
                    <center>
                        <div class="up_acc_file">
                            <img id="view_img_member" class="profile-pic img-fluid accmember" onclick="clickImage(this)"
                                src="">
                            <br>
                            <small class="clight">Please upload file for confirmation</small>
                            <br>
                            <div class="p-image accmember">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="accmember" style="width: 38px; height: 38px;">
                                    <i id="browse_acc_member" class="mdi mdi-camera upload-button accmember"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                                <input id="file_acc_member" class="file-upload file-upload-default accmember"
                                    type="file" name="fileup" accept="image/*" />
                            </div>

                        </div>
                    </center>
                    <div class="form-group">
                        <small class="clight">Active Status</small><br>
                        <div class="custom-control custom-switch toggle-switch">
                            <input type="checkbox" class="custom-control-input" id="status_active" name="status_active">
                            <label class="custom-control-label " for="status_active"></label>
                        </div>
                        <small class="cgrey tebal" id="stat_deactive_kom" style="display: none;"> Deactive </small>
                        <span id="status_label_kom"></span>
                    </div>
                    <div class="form-group">
                        <small class="clight">Confirmation Comment</small>
                        <textarea class="form-control input-abu" id="acc_komen" name="acc_komen" rows="2"></textarea>
                    </div>
                    <input type="hidden" name="id_komunitas" id="id_komunitas">
                    <input type="hidden" id="status_komunitas">

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_change_status" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Update </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>

<!-- MODAL REACTIVE SUBS-->
<div class="modal fade" id="modal_reactive_subscriber" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div style="padding-left: 15%; padding-top: 5%;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Reactive or Deactive</small>
                <br>
                <h4 class=" cblue">Subscriber</h4>
            </div>

            <form method="POST" id="form_reactive_subs" action="{{route('change_reactive_subscriber')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body detail_member">
                    <center>
                        <div class="up_acc_file">
                            <img id="view_img_subs" class="profile-pic img-fluid accmember" onclick="clickImage(this)"
                                src="">
                            <br>
                            <small class="clight">Please upload file for confirmation</small>
                            <br>
                            <div class="p-image accmember">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="accmember" style="width: 38px; height: 38px;">
                                    <i id="browse_acc_subs" class="mdi mdi-camera upload-button accmember"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                                <input id="file_acc_subs" class="file-upload file-upload-default accmember" type="file"
                                    name="fileup" accept="image/*" />
                            </div>

                        </div>
                    </center>
                    <div class="form-group">
                        <small class="clight">Active Status</small><br>
                        <div class="custom-control custom-switch toggle-switch">
                            <input type="checkbox" class="custom-control-input" id="status_active_subs"
                                name="status_active_subs">
                            <label class="custom-control-label" for="status_active_subs"></label>
                        </div>
                        <small class="cgrey tebal" id="stat_deactive_subs" style="display: none;"> Deactive </small>
                        <span id="status_label_subs" style="display: none;"></span>
                    </div>
                    <div class="form-group">
                        <small class="clight">Confirmation Comment</small>
                        <textarea class="form-control input-abu" id="acc_komen_subs" name="acc_komen_subs"
                            rows="2"></textarea>
                    </div>
                    <input type="hidden" name="id_komunitas_subs" id="id_komunitas_subs">
                    <input type="hidden" name="id_subs" id="id_subs">
                    <input type="hidden" id="status_subs">

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Update </button>
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
        get_list_komunitas_support();
    });

    function get_list_komunitas_support() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_komunitas_support",
            type: "POST",
            dataType: "json",
            data: {
                "community_status": "all"
            },
            success: function (result) {
                console.log(result);

                $("#hide_status_kom").show();
                $('#list_komunitas').empty();
                if (result.success == false && result.code == "CMQ01") {
                    $('#list_komunitas').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_komunitas').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_komunitas").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction


    $('#list_komunitas').change(function () {
        var item = $(this);
        var id_kom = item.val();

        get_list_subscriber_support(id_kom);
        tabel_admin_komunitas(id_kom);
    });


    function get_list_subscriber_support(id_kom) {
        $('#tabel_subscriber').DataTable().clear().destroy();
        $('#tabel_subscriber').empty();


        var tabel = $('#tabel_subscriber').DataTable({
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
                url: "/support/get_list_subscriber_support",
                type: "POST",
                dataSrc: '',
                data: {
                    "community_id": id_kom
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_subscriber tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_subscriber tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-300">' + data + '</span>';
                    }
                },
                {
                    mData: 'sso_picture',
                    render: function (data, type, row, meta) {
                        var noimg = '/img/kosong.png';
                        var pic = server_cdn + cekimage_cdn(data);
                        return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgsprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                    }
                },
                {
                    mData: 'full_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13  text-wrap width-100">' + data + '</span>';
                    }
                },
                {
                    mData: 'user_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'email',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-abu btn-sm btn_reset_otp_subs">' +
                            '<small>OTP</small></button> &nbsp;&nbsp; <button type="button" class="btn btn-tosca btn-sm btn_reset_login_subs">' +
                            '<small>Login</small></button>';
                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-lead-pencil"></i></button>',
                        "targets": -1
                    }
                ],

        });

        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_subscriber tbody').on('click', 'button.btn_reset_otp_subs', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/support/reset_attempt_otp',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "email": data.email
                },
                success: function (result) {
                    console.log(result);
                    if (result.success == true) {
                        swal("Reset OTP", "Successfully reset otp number for subscriber", "success");
                    } else {
                        swal("Failed", result.message, "error");
                    }

                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show detail otp");
                }
            });
        });

        $('#tabel_subscriber tbody').on('click', 'button.btn_reset_login_subs', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/support/reset_attempt_login',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "user_id": data.user_id,
                    "user_type": "3"

                },
                success: function (result) {
                    console.log(result);
                    if (result.success == true) {
                        swal("Reset Login Attempt", "Successfully reset login attempt for subscriber", "success");
                    } else {
                        swal("Failed", result.message, "error");
                    }

                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show detail login");
                }
            });
        });
    } //endfunction


    function tabel_admin_komunitas(id_kom) {
        $('#tabel_admin_komunitas').DataTable().clear().destroy();
        $('#tabel_admin_komunitas').empty();


        $("#modal_generate_user").modal('hide');
        $("#tabel_admin_komunitas").show();

        var tabel = $('#tabel_admin_komunitas').DataTable({
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
                url: "/support/get_list_admin_support",
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": id_kom
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_admin_komunitas tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_admin_komunitas tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'sso_picture',
                    render: function (data, type, row, meta) {
                        var noimg = '/img/kosong.png';
                        var pic = server_cdn + cekimage_cdn(data);
                        return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgsprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                    }
                },
                {
                    mData: 'full_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'user_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'email',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-abu btn-sm btn_reset_otp">' +
                            '<small>OTP</small></button> &nbsp;&nbsp; <button type="button" class="btn btn-tosca btn-sm btn_reset_login">' +
                            '<small>Login</small></button>';
                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-eye"></i></button>',
                        "targets": -1
                    }
                ],

        });

        //DETAIL FROM DATATABLE
        $('#tabel_admin_komunitas tbody').on('click', 'button.btn_reset_otp', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/support/reset_attempt_otp',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "email": data.email
                },
                success: function (result) {
                    console.log(result);
                    if (result.success == true) {
                        swal("Reset OTP", "Successfully reset otp number", "success");
                    } else {
                        swal("Failed", result.message, "error");
                    }

                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show detail otp");
                }
            });
        });

        $('#tabel_admin_komunitas tbody').on('click', 'button.btn_reset_login', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/support/reset_attempt_login',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "user_id": data.user_id,
                    "user_type": "2"

                },
                success: function (result) {
                    console.log(result);
                    if (result.success == true) {
                        swal("Reset Login Attempt", "Successfully reset login attempt", "success");
                    } else {
                        swal("Failed", result.message, "error");
                    }

                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show detail login");
                }
            });
        });
    }



</script>

@endsection
