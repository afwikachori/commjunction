@extends('layout.support-master')
@section('title', 'Resend Mail')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Resend Mail</h3>

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

                <div class="tabbable-line" style="margin-top: -2.2em; display: none;">
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
                                        <th><b>Action</b></th>
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
                                        <th><b>Action</b></th>
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


<!-- MODAL DETAIL USER -->
<div class="modal fade" id="modal_detail_user_resendmail" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail User</small>
                <br>
                <h4 class=" cblue">Resent Mail</h4>
                <nav aria-label="breadcrumb">

                </nav>
            </div>
            <br>
            <form>
                <input type="hidden" id="id_komunitas" name="id_komunitas">
                <input type="hidden" id="email_user" name="email_user">


                <div class="modal-body body250" style="padding-left: 1.5em;">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/img/kosong.png" onclick="clickImage(this)" id="imgsprev"
                                class="img zoom rounded-circle"
                                style="margin-left: auto; margin-right: auto; width: 100%;"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <small class="clight s13">ID User</small>
                                <p class="cgrey s13" id="detail_iduser"></p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Full Name</small>
                                        <p class="cgrey s13" id="detail_fullname"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13">Email</small>
                                        <p class="cgrey s13" id="detail_email"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Username</small>
                                        <p class="cgrey s13" id="detail_username"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13">User Type</small>
                                        <p class="cgrey s13" id="detail_usertipe"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <center><small class="clight">Resend Mail Action</small></center>
                    <div class="row" id="action_mail_admin" style="padding: 5%; display: none;">
                        <div class="col-md-6">
                            <button type="button" id="btn_mail_otp" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Resend Mail OTP Number</button>

                            <button type="button" id="btn_inv_payment" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Invoice Activation Payment </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btn_inv_regis" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Invoice Registration </button>

                            <button type="button" id="btn_inv_module" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Invoice Activation Module </button>
                        </div>
                    </div>

                    <div class="row" id="action_mail_subscriber" style="padding: 5%; display: none;">
                        <div class="col-md-6">
                            <button type="button" id="btn_inv_membership" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Invoice Membership</button>

                            <button type="button" id="btn_subs_approv" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Subscriber Approval </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btn_membership_approv"
                                class="btn btn-tosca btn-block btn-sm mgb-1">
                                Membership Approval</button>

                            <button type="button" id="btn_subs_nonaktif" class="btn btn-tosca btn-block btn-sm mgb-1">
                                Subscriber Non-active</button>
                        </div>
                    </div>
                    <br>
                </div> <!-- end-body -->
                <div class="modal-footer" style="border: none;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
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
        $(".tabbable-line").show();
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
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
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
        $('#tabel_subscriber tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            $("#id_komunitas").val("");
            $("#email_user").val("");

            $("#detail_iduser").html(data.user_id);
            $("#detail_fullname").html(data.full_name);
            $("#detail_username").html(data.user_name);
            $("#detail_email").html(data.email);
            $("#detail_usertipe").html('Subscriber');

            if (data.sso_picture != null && data.sso_picture != undefined) {
                $("#imgsprev").attr("src", server_cdn + cekimage_cdn(data.sso_picture));
            }
            var idkom = $("#list_komunitas").val();

            $("#id_komunitas").val(idkom);
            $("#email_user").val(data.email);

            $("#action_mail_subscriber").show();
            $("#action_mail_admin").hide();
            $("#modal_detail_user_resendmail").modal('show');

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
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
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
        $('#tabel_admin_komunitas tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            $("#id_komunitas").val("");
            $("#email_user").val("");

            $("#detail_iduser").html(data.user_id);
            $("#detail_fullname").html(data.full_name);
            $("#detail_username").html(data.user_name);
            $("#detail_email").html(data.email);
            $("#detail_usertipe").html('Admin Community');

            if (data.sso_picture != null && data.sso_picture != undefined) {
                $("#imgsprev").attr("src", server_cdn + cekimage_cdn(data.sso_picture));
            }
            var idkom = $("#list_komunitas").val();

            $("#id_komunitas").val(idkom);
            $("#email_user").val(data.email);

            $("#action_mail_subscriber").hide();
            $("#action_mail_admin").show();
            $("#modal_detail_user_resendmail").modal('show');

        });

    }


    $("#btn_mail_otp").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_mail_otp_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_inv_payment").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_invoice_payment_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_inv_regis").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_invoice_regis_community',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_inv_module").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_invoice_module_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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




    $("#btn_inv_membership").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_invoice_membership_subs',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
                "community_id": $("#id_komunitas").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_membership_approv").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_membership_approv_subs',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
                "community_id": $("#id_komunitas").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_subs_approv").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_mail_subs_approv',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
                "community_id": $("#id_komunitas").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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


    $("#btn_subs_nonaktif").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/resend_mail_subs_nonaktif',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "email": $("#email_user").val(),
                "community_id": $("#id_komunitas").val(),
            },
            success: function (result) {
                console.log(result);
                if (result.success == true) {
                    swal("Mail Sent", "Successfully resend otp number for admin community", "success");
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



</script>

@endsection
