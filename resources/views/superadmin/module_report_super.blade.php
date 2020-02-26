@extends('layout.superadmin')

@section('title', 'Module Report')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-book-open-variant"></i>
        </span>Module Report</h3>


</div>


<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">

            <div class="card-header putih">
                Module Activity
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                            data-toggle="modal" data-target="#modal_generate_module_activity">
                            Generate Activity</button>
                    </div>
                    <div class="col-4" style="text-align: right;">
                        <button type="button" id="reset_tabel_modulereport" style="width: 25px; height: 25px;"
                            class="btn btn-gradient-light btn-icon btn-sm melengkung10px">
                            <i class="mdi mdi-refresh"></i>
                        </button>
                    </div>
                </div>


                <table id="tabel_module_report_superadmin" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Sub-Feature</th>
                            <th>Module</th>
                            <th>Usertype</th>
                            <th>Endpoint</th>
                            <th>Date Actibity</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL FILTER TRANSAKSI-->
<div class="modal fade" id="modal_generate_module_activity" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Filter Transaction</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community Activity</small>
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User Level</small>
                                <select class="form-control input-abu" name="list_userlevel" id="list_userlevel">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Commjuction </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber</option>
                                </select>
                            </div>
                        </div>
                    </div>

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
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="list_fitur" id="list_fitur">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="showin_subfitur">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="list_subfitur" id="list_subfitur">

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
                    <button type="button" id="btn_filter_log_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button>
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
        get_list_community_modulereport();
        get_list_fitur_modulereport();
        // tabel_tes();
        // tabel_module_report_superadmin();
        $("#showin_subfitur").hide();

    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_module_report_superadmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "user_level": $("#list_userlevel").val(),
                "feature_id": $("#list_fitur").val(),
                "sub_feature_id": $("#list_subfitur").val()
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }


    $("#btn_filter_log_super").click(function () {
        tabel_module_report_superadmin();
        tabel_tes();
    });


    $("#reset_tabel_modulereport").click(function () {
        $("#list_komunitas").val("");
        $("#tanggal_mulai2").val("");
        $("#tanggal_selesai2").val("");
        $("#list_userlevel").val("");
        $("#list_fitur").val("");
        $("#list_subfitur").val("");
        $('#tabel_module_report_superadmin').hide();
        // $('#modal_generate_module_activity').modal('show');
        $('#tabel_module_report_superadmin').dataTable().fnClearTable();
        $('#tabel_module_report_superadmin').dataTable().fnDestroy();
    });



    function tabel_module_report_superadmin() {
        $('#tabel_module_report_superadmin').dataTable().fnClearTable();
        $('#tabel_module_report_superadmin').dataTable().fnDestroy();

        $('#tabel_module_report_superadmin').show();
        $('#modal_generate_module_activity').modal('hide');

        var tabel = $('#tabel_module_report_superadmin').DataTable({
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
                },
            },
            ajax: {
                url: '/superadmin/tabel_module_report_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#list_komunitas").val(),
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "user_level": $("#list_userlevel").val(),
                    "feature_id": $("#list_fitur").val(),
                    "sub_feature_id": $("#list_subfitur").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_module_report_superadmin tbody').empty().append(nofound);
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



    //dropdown komunitas list
    function get_list_community_modulereport() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_community_modulereport",
            type: "POST",
            dataType: "json",
            success: function (result) {
                $('#list_komunitas').empty();
                $('#list_komunitas').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#list_komunitas").get(0).selectedIndex = 0;

                const OldKomunitas = "{{old('list_komunitas')}}";

                if (OldKomunitas !== '') {
                    $('#list_komunitas').val(OldKomunitas);
                }

            }
        });
    } //endfunction


    //dropdown list fitur
    function get_list_fitur_modulereport() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_fitur_modulereport",
            type: "POST",
            dataType: "json",
            success: function (result) {
                $('#list_fitur').empty();
                $('#list_fitur').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_fitur').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#list_fitur").html($('#list_fitur option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#list_fitur").get(0).selectedIndex = 0;

                const Oldfitur = "{{old('list_fitur')}}";

                if (Oldfitur !== '') {
                    $('#list_fitur').val(Oldfitur);
                }

            }
        });
    } //endfunction





    //dropdown subs_name list
    $('#list_fitur').change(function () {
        var itempilih = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_subfitur_modulereport",
            type: "POST",
            dataType: "json",
            data: {
                "feature_id": itempilih,
            },
            success: function (result) {
                // console.log(result);
                $('#showin_subfitur').fadeIn("fast");
                $('#list_subfitur').empty();
                $('#list_subfitur').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_subfitur').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#list_subfitur").html($('#list_subfitur option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#list_subfitur").get(0).selectedIndex = 0; const
                    OldSubf = "{{old('list_subfitur')}}";
                if (OldSubf !== '') {
                    $('#list_subfitur').val(OldSubf);
                }



            },
            error: function (result) {
                $('#showin_subfitur').fadeOut("fast");
            }
        });
    });
    //end list subscriber

</script>

@endsection
