@extends('layout.support-master')
@section('title', 'Inquiry Specific')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inquiry Specific Community</h3>
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
                    data-target="#modal_generate_spesific_com">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_inquiry_spesific_com" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> Endpoint </b></th>
                            <th><b> Activity </b></th>
                            <th><b> IP Address </b></th>
                            <th><b> Date </b></th>
                            <th><b> Time </b></th>
                            <th><b> User Level </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE INQUIRY LOG ACTIViTY -->
<div class="modal fade" id="modal_generate_spesific_com" data-backdrop="static" tabindex="-1" role="dialog"
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
                            <div class="form-group" style="display: none;" id="hide_aktivitastipe">
                                <small class="clight s13">Activity Type</small>
                                <select class="form-control input-abu" name="activity_type" id="activity_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Community </option>
                                    <option value="2"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subscriber">
                                <small class="clight s13">Subscriber List</small>
                                <select class="form-control input-abu" name="list_subscriber" id="list_subscriber">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
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
                    <button type="button" id="btn_generate_specific" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



<!-- MODAL DETAIL INQUIRY LOG ACTIVITY-->
<div class="modal fade" id="modal_detail_spesific_inquiry" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 700px;">
        <div class="modal-content" style="background-color: #ffffff;">
            <div style="padding: 4%; padding-bottom: 0% !important;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
            </div>

            <div class="modal-body detaillog" style="height: auto; padding: 4% !important;">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Activity</small>
                            <p class="cgrey s13" id="activity"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s12">Endpoint</small>
                            <p class="cgrey s13" id="endpoint"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Module</small>
                            <p class="cgrey s13" id="module"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Module Endpoint Id</small>
                            <p class="cgrey s13" id="module_endpoint_id"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Feature Id</small>
                            <p class="cgrey s13" id="feature_id"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Subfeature Id</small>
                            <p class="cgrey s12" id="subfeature_id"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Username</small>
                            <p class="cgrey s13" id="user_name"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">User Id</small>
                            <p class="cgrey s13" id="user_id"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Userlevel</small>
                            <p class="cgrey s13" id="user_level"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Date</small>
                            <p class="cgrey s13" id="date"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Time</small>
                            <p class="cgrey s13" id="time"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Elapsed Time</small>
                            <p class="cgrey s13" id="elapsed_time"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">IP Address</small>
                            <p class="cgrey s13" id="ip"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Request</small>
                            <p class="cgrey s13" id="request"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Status Request</small>
                            <p class="cgrey s13" id="status"></p>
                        </div>
                    </div>
                </div>

                <small class="clight s13">Response</small>
                <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 125px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 1%;">
                    <div class="cgrey s11 jjson" id="detail_response"></div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">

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
            url: '/support/tabel_inquiry_spesific_com',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
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


    $("#btn_generate_specific").click(function () {
        tabel_inquiry_spesific_com();
    });


    function tabel_inquiry_spesific_com() {
        $('#tabel_inquiry_spesific_com').dataTable().fnClearTable();
        $('#tabel_inquiry_spesific_com').dataTable().fnDestroy();

        $("#modal_generate_spesific_com").modal('hide');
        $("#tabel_inquiry_spesific_com").show();

        var tabel = $('#tabel_inquiry_spesific_com').DataTable({
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
                url: '/support/tabel_inquiry_spesific_com',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "activity_type": $("#activity_type").val(),
                    "subscriber_id": $("#list_subscriber").val(),
                },
                // success: function (result) {
                //     console.log('tabel com ');
                //     console.log(result);
                // },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_inquiry_spesific_com tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_inquiry_spesific_com tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'endpoint',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'activity',
                    render: function (data, type, row, meta) {
                        return '<span class="s12 text-wrap width-250">' + data + '</span>';
                    }
                },
                {
                    mData: 'ip',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'date',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + dateFormat(data) + '</span>';
                    }
                },

                {
                    mData: 'time',
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
        $('#tabel_inquiry_spesific_com tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
            $("#modal_detail_spesific_inquiry").modal('show');


            // < !--activity: "Top Love News" -- >
            // < !--date: "2020-04-20T16:27:13.583Z" -- >
            // < !--elapsed_time: "14" -- >
            // < !--endpoint: "/api/module/news/toplovenews" -- >
            // < !--feature_id: "14" -- >
            // < !--ip: "4.6.6.126" -- >
            // < !--module: "News Module" -- >
            // < !--module_endpoint_id: "707" -- >
            // < !--request: "{"limit":"5"}" -- >
            // < !--status: "200" -- >
            // < !--subfeature_id: "197" -- >
            // < !--time: "23:27:13" -- >
            // < !--user_id: "SUBS-147428681295867620200323"
            //             user_level: 3
            //             user_name: "febri_12345" -- >
            var userlv = '';
            if (data.user_level == 1) {
                userlv = 'Admin Commjunction';
            } else if (data.user_level == 2) {
                userlv = 'Admin Community';
            } else {
                userlv = 'Subscriber';
            }

            $("#detail_response").jJsonViewer(data.response);

            $("#activity").html(data.activity);
            $("#date").html(dateTime(data.date));
            $("#elapsed_time").html(data.elapsed_time);
            $("#endpoint").html(data.endpoint);
            $("#feature_id").html(data.feature_id);
            $("#ip").html(data.ip);
            $("#module").html(data.module);
            $("#module_endpoint_id").html(data.module_endpoint_id);
            $("#request").html(data.request);
            $("#status").html(data.status);
            $("#subfeature_id").html(data.subfeature_id);
            $("#time").html(data.time);
            $("#user_id").html(data.user_id);
            $("#user_level").html(userlv);
            $("#user_name").html(data.user_name);


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

    $('#list_komunitas').change(function () {
        var item = $(this);
        var id_kom = item.val();

        get_list_subscriber_support(id_kom);
        if (id_kom != null && id_kom != "") {
            $("#hide_aktivitastipe").show();
        } else {
            $("#hide_aktivitastipe").hide();
        }
    });



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
