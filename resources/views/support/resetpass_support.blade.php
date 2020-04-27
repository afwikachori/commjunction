@extends('layout.support-master')
@section('title', 'Reset Password')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Reset Password</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Force Reset Password for User<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
        </nav>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                    data-target="#modal_generate_user">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_user_resetpass" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> ID User </b></th>
                            <th><b> Photo </b></th>
                            <th><b> Full Name </b></th>
                            <th><b> Username </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE USER RESET PASSWORD -->
<div class="modal fade" id="modal_generate_user" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Generate User</small>
                <br>
                <h4 class=" cblue">Force Reset Password</h4>
            </div>

            <form>
                <div class="modal-body body250">


                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Status</small>
                                <select class="form-control input-abu" name="status_komunitas" id="status_komunitas"
                                    required>
                                    <option selected disabled> Choose </option>
                                    <option value="all" selected> All </option>
                                    <option value="0"> Newly </option>
                                    <option value="1"> First Login </option>
                                    <option value="2"> Active </option>
                                    <option value="3"> Published </option>
                                    <option value="4"> Deactive </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" id="hide_status_kom" style="display: nones;">
                                <small class="clight s13">Community List</small>
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas"
                                    required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>



                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">User Type</small>
                                <select class="form-control input-abu" name="user_type" id="user_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Community </option>
                                    <option value="2"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                        </div> <!-- end-col-md -->
                    </div>
                </div> <!-- end-body -->
                    <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">
                        <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="submit" id="btn_generate_user" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Generate </button>
                    </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>





@endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        if ($('#status_komunitas').val() == "all") {
            get_list_komunitas_support("all");
        }

        random_otp();
    });

    // $("#btn_generate_specific").click(function () {
    //     tabel_user_resetpass();
    // });

    function random_otp() {
        var random = Math.floor(100000 + Math.random() * 900000);
        $("#text_OTP").val(random);
    }


    function tabel_user_resetpass(tipe) {
        if (tipe == 1) {
            var url_user = "/support/get_list_admin_support";
        } else if (tipe == 2) {
            var url_user = "/support/get_list_subscriber_support";
        }
        $('#tabel_user_resetpass').DataTable().clear().destroy();
        $('#tabel_user_resetpass').empty();


        $("#modal_generate_user").modal('hide');
        $("#tabel_user_resetpass").show();

        var tabel = $('#tabel_user_resetpass').DataTable({
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
                url: url_user,
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_user_resetpass tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_user_resetpass tbody').empty().append(nofound);

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

        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_user_resetpass tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            $("#id_komunitas").val("");
            $("#user_tipe").val("");
            $("#user_id").val("");

            $("#detail_iduser").html(data.user_id);
            $("#detail_fullname").html(data.full_name);
            $("#detail_username").html(data.user_name);
            if (data.sso_picture != null && data.sso_picture != undefined) {
                $("#imgsprev").attr("src", server_cdn + cekimage_cdn(data.sso_picture));
            }
            var idkom = $("#list_komunitas").val();
            var tipeusr = $("#user_type").val();

            $("#id_komunitas").val(idkom);
            $("#user_tipe").val(tipeusr);
            $("#user_id").val(data.user_id);

            $("#modal_detail_user_reset").modal('show');
        });

    }

    $('#status_komunitas').change(function () {
        var item = $(this);
        var id_status = item.val();

        get_list_komunitas_support(id_status);
    });


    function get_list_komunitas_support(id_status) {
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
                "community_status": id_status
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


    $('#user_type').change(function () {
        var item = $(this);
        var usertipe = item.val();
        tabel_user_resetpass(usertipe);
    });


</script>

@endsection
