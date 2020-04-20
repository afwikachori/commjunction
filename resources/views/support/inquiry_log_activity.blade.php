@extends('layout.support-master')
@section('title', 'Inquiry Log')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inquiry Log Activity</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your information for Inquiry<label>
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
                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                    data-target="#modal_generate_log_activity">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_inquiry_log_activity" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> Endpoint </b></th>
                            <th><b> Activity </b></th>
                            <th><b> Username</b></th>
                            <th><b> User Level </b></th>
                            <th><b> Date </b></th>
                            <th><b> Log Status </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE INQUIRY LOG ACTIViTY -->
<div class="modal fade" id="modal_generate_log_activity" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Generate Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
            </div>

            <form>
                <div class="modal-body body250">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="form-control input-abu" required>
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Status</small>
                                <select class="form-control input-abu" name="status_komunitas" id="status_komunitas" required>
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
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="list_feature" id="list_feature" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subfitur">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="list_subfeature" id="list_subfeature" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_endpoint">
                                <small class="clight s13">Endpoint List</small>
                                <select class="form-control input-abu" name="list_endpoint" id="list_endpoint" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_aktivitastipe">
                                <small class="clight s13">Activity Type</small>
                                <select class="form-control input-abu" name="activity_type" id="activity_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Community </option>
                                    <option value="2"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subscriber">
                                <small class="clight s13">Subscriber List</small>
                                <select class="form-control input-abu" name="list_subscriber" id="list_subscriber">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">

                        </div> <!-- end-col-md -->
                    </div>


                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em; margin-top: 0.5em;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_log_activity" class="btn btn-teal btn-sm">
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
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {


        if ($('#status_komunitas').val() == "all") {
            get_list_komunitas_support("all");
        }
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/support/tabel_inquiry_log_activity',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "start_date": $("#tanggal_mulai").val(),
                "end_date": $("#tanggal_selesai").val(),
                "endpoint": $("#list_endpoint").val(),
                "activity_type": $("#activity_type").val(),
                "subscriber_id": $("#list_subscriber").val(),
            },
            success: function (result) {
                console.log('tabel log ');
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show tabel log");
            }
        });
    }


    $("#btn_generate_log_activity").click(function () {
        tabel_inquiry_log_activity();
        tabel_tes();
    });


    function tabel_inquiry_log_activity() {
        $('#tabel_inquiry_log_activity').dataTable().fnClearTable();
        $('#tabel_inquiry_log_activity').dataTable().fnDestroy();

        $("#modal_generate_log_activity").modal('hide');
        $("#tabel_inquiry_log_activity").show();

        var tabel = $('#tabel_inquiry_log_activity').DataTable({
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
                url: '/support/tabel_inquiry_log_activity',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "start_date": $("#tanggal_mulai").val(),
                    "end_date": $("#tanggal_selesai").val(),
                    "endpoint": $("#list_endpoint").val(),
                    "activity_type": $("#activity_type").val(),
                    "subscriber_id": $("#list_subscriber").val(),
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_inquiry_log_activity tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_inquiry_log_activity tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'endpoint' ,
                    render: function (data, type, row, meta) {
                       return '<span class="s13">' + data + '</span>';
                    }
                },
                { mData: 'activity',
                    render: function (data, type, row, meta) {
                        return '<span class="s12 text-wrap width-250">' + data + '</span>';
                    }
                 },
                { mData: 'user_name' ,
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'user_level',
                    render: function (data, type, row, meta) {
                        var ini = '';
                        if (data == 1) {
                            ini = '<span class="s13">Admin Commjuction</span>';
                        } else if (data == 2) {
                            ini = '<span class="s13">Admin Community</span>';
                        } else {
                            ini = '<span class="s13">Subscriber</span>';
                        }
                        return ini;
                    }
                },
                {
                    mData: 'date',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">'+dateFormat(data)+'</span>';
                    }
                },
                { mData: 'log_status',
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
        $('#tabel_inquiry_log_activity tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            // alert(data.endpoint);

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
                get_list_feature_support();

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
    });

    function get_list_feature_support() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_feature_support",
            type: "POST",
            dataType: "json",
            success: function (result) {
                console.log(result);

                $('#list_feature').empty();
                $('#list_feature').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_feature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }

                $("#list_feature").html($('#list_feature option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_feature").get(0).selectedIndex = 0;

            }
        });
    } //endfunction


    $('#list_feature').change(function () {
        var item = $(this);
        var id_fitur = item.val();

        get_list_subfeature_support(id_fitur);
    });

    function get_list_subfeature_support(feature_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_subfeature_support",
            type: "POST",
            dataType: "json",
            data: {
                "feature_id": feature_id
            },
            success: function (result) {
                console.log(result);

                $("#hide_subfitur").show();
                $('#list_subfeature').empty();
                if (result.success == false || result.code == "CMQ01") {
                    $('#list_subfeature').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_subfeature').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_subfeature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_subfeature").html($('#list_subfeature option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_subfeature").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction

    $('#list_subfeature').change(function () {
        var item = $(this);
        var id_subfitur = item.val();

        get_list_endpoint_support(id_subfitur);
    });


    function get_list_endpoint_support(id_subfitur) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_endpoint_support",
            type: "POST",
            dataType: "json",
            data: {
                "subfeature_id": id_subfitur
            },
            success: function (result) {
                console.log(result);

                $("#hide_endpoint").show();
                $("#hide_aktivitastipe").show();
                $('#list_endpoint').empty();
                if (result.success == false && result.code == "CMQ01") {
                    $('#list_endpoint').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_endpoint').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_endpoint').append("<option value=\"".concat(result[i].endpoint, "\">").concat(result[i].endpoint, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_endpoint").html($('#list_endpoint option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_endpoint").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction


    $('#activity_type').change(function () {
        var item = $(this);
        var id_tipe = item.val();

        if (id_tipe == "2") {
            $("#hide_subscriber").show();
        } else {
             $("#list_subscriber").val(null);
            $("#hide_subscriber").hide();
        }

    });


    function get_list_subscriber_support(id_kom) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_subscriber_support",
            type: "POST",
            dataType: "json",
            data: {
                "community_id": id_kom
            },
            success: function (result) {
                console.log(result);

                $('#list_subscriber').empty();
                if (result.success == false || result.code == "CMQ01") {
                    $('#list_subscriber').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_subscriber').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_subscriber').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_subscriber").html($('#list_subscriber option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_subscriber").get(0).selectedIndex = 0;
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show Subcriber");
            }
        });
    } //endfunction





</script>

@endsection
