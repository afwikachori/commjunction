@extends('layout.superadmin')

@section('title', 'Report Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-diamond"></i>
        </span> Report Management</h3>

    <nav aria-label="breadcrumb">

    </nav>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="cgrey" style="margin-bottom: -1em;">Report Generated</h4>

                <div class="tabbable-line tabreport">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_trans">
                            <a href="#tab_default_1" data-toggle="tab">
                                Transaction
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_reconsile">
                            <a href="#tab_default_2" data-toggle="tab">
                                Reconsile
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_community">
                            <a href="#tab_default_3" data-toggle="tab">
                                Community
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_module">
                            <a href="#tab_default_4" data-toggle="tab">
                                Module
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">

                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_generate_transaksi" style="margin-bottom: 2em;">
                                Generate Transaction Report</button>
                            <br>
                            <!-- tabel all susbcriber -->
                            <table id="tabel_transaksi_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Transaction Date</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Admin Name</th>
                                        <th>Nominal</th>
                                        <th>Payment Type</th>
                                        <th>Payment Method</th>

                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_reconcile_transaksi" style="margin-bottom: 2em;">
                                Generate Reconcile Report</button>
                            <br>
                            <!-- tabel all susbcriber -->
                            <table id="tabel_concile_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Transaction Date</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Admin Name</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>

                        <div class="tab-pane" id="tab_default_3">
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_komunitas_transaksi" style="margin-bottom: 2em;">
                                Generate Community Report</button>
                            <br>
                            <table id="tabel_komunitas_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th>ID Activity</th>
                                        <th>Module</th>
                                        <th>Activity</th>
                                        <th>Endpoint</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_default_4">
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_module_transaksi" style="margin-bottom: 2em;">
                                Generate Module Report</button>
                            <br>
                            <table id="tabel_module_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th>Community Name</th>
                                        <th>Module</th>
                                        <th>Activity</th>
                                        <th>Endpoint</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- MODAL FILTER TRANSAKSI REPORT SUPER -->
<div class="modal fade" id="modal_generate_transaksi" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <small class="modal-title cdarkgrey">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;">Transaction Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Transaction Type</small>
                                <select class="form-control input-abu listjenistrans" name="jenis_transaksi"
                                    id="jenis_transaksi">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Transaction Status</small>
                                <select class="form-control input-abu" name="status_transaksi" id="status_transaksi">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Pending </option>
                                    <option value="2"> Approved </option>
                                    <option value="3"> Cancel </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community Name</small>
                                <select class="form-control input-abu" name="komuniti_trans" id="komuniti_trans">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="cgrey s13">Transaction Range</small>
                                <div class="row" style="margin-top: 0.5em;">
                                    <div class="col-md-2">
                                        <small class="clight s13"
                                            style="text-align: right; margin-top: 1em;">Minimum</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-abu" id="min_trans"
                                            name="min_trans">
                                    </div>
                                    <div class="col-md-2">
                                        <small class="clight s13"
                                            style="text-align: right; margin-top: 1em;">Maximum</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-abu" id="max_trans"
                                            name="max_trans">
                                    </div>
                                </div>
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
                    <button type="button" id="btn_generate_trans" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL FILTER RECONCILE REPORT SUPER -->
<div class="modal fade" id="modal_reconcile_transaksi" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form id="form_reconcile">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <small class="modal-title cdarkgrey">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;">Reconcile Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Transaction Type</small>
                                <select class="form-control input-abu listjenistrans" name="jenis_transaksi2"
                                    id="jenis_transaksi2">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Month Year</small>
                                <input type="month" id="tahun_concile" name="tahun_concile" value="2020-01"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Name</small>
                                <select class="form-control input-abu" name="komuniti_trans2" id="komuniti_trans2">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_reconcile" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL FILTER COMMUNITY REPORT SUPER -->
<div class="modal fade" id="modal_komunitas_transaksi" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form id="form_komunitas_report">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <small class="modal-title cdarkgrey">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;">Community Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Name</small>
                                <select class="form-control input-abu" name="komuniti_trans3" id="komuniti_trans3">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Month Year</small>
                                <input type="month" id="tahun_komunitas" name="tahun_komunitas" value="2020-01"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_komunitas" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL FILTER MODULE REPORT SUPER -->
<div class="modal fade" id="modal_module_transaksi" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form id="form_komunitas_report">
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <small class="modal-title cdarkgrey">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;">Module Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature Name</small>
                                <select class="form-control input-abu" name="list_fiture" id="list_fiture">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Month Year</small>
                                <input type="month" id="tahun_module" name="tahun_module" value="2020-01"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_module" class="btn btn-teal btn-sm">
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
        get_list_transaction_type_super();
        get_list_komunitas();
        get_list_fitur_super();
    });  //end


    function tabel_tes(bulan, tahun) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_module_report_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "feature_id": $("#list_fiture").val(),
                "month": bulan,
                "year": tahun
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


    $("#btn_generate_trans").click(function () {
        tabel_report_transaksi_super();
    });


    $("#btn_generate_reconcile").click(function () {
        var tglq = $("#tahun_concile").val();
        var tgl = tglq.split('-');
        var bulan = tgl[1];
        var tahun = tgl[0];
        tabel_report_concile_super(bulan, tahun);
    });

    $("#btn_generate_module").click(function () {
        var tglq = $("#tahun_module").val();
        var tgl = tglq.split('-');
        var bulan = tgl[1];
        var tahun = tgl[0];
        // tabel_tes(bulan, tahun);
        tabel_report_module_super(bulan, tahun);
    });



    //tabel generate concile
    function tabel_report_concile_super(bulan, tahun) {
        $('#tabel_concile_report').dataTable().fnClearTable();
        $('#tabel_concile_report').dataTable().fnDestroy();

        $("#modal_reconcile_transaksi").modal('hide');
        $("#tabel_concile_report").show();

        // $('#form_reconcile').removeData();

        var tabel = $('#tabel_concile_report').DataTable({
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
                url: '/superadmin/tabel_concile_report_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "transaction_type_id": $("#jenis_transaksi2").val(),
                    "community_id": $("#komuniti_trans2").val(),
                    "month": bulan,
                    "year": tahun
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_concile_report tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_concile_report tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'invoice_number' },
                { mData: 'transaction_date' },
                {
                    mData: 'transaction_status',
                    render: function (data, type, row, meta) {
                        var ini = '';
                        if (data == 1) {
                            ini = '<small class="badge bg-abu melengkung10px cwhite">Pending</small>';
                        } else if (data == 2) {
                            ini = '<small class="badge bg-abu melengkung10px cwhite">Approved</small>';
                        } else {
                            ini = '<small class="badge bg-merah melengkung10px clight">Cancel</small>';
                        }
                        return ini;
                    }
                },
                { mData: 'transaction_type' },
                { mData: 'name' },
                {
                    mData: 'nominal',
                    render: function (data, type, row, meta) {
                        var rp = 'Rp. ' + rupiah(data);
                        return rp;
                    }
                }

            ],

        });
    }

    $("#btn_generate_komunitas").click(function () {
        var tglq = $("#tahun_komunitas").val();
        var tgl = tglq.split('-');
        var bulan = tgl[1];
        var tahun = tgl[0];
        tabel_report_komunitas_super(bulan, tahun);
    });

    //tabel generate module
    function tabel_report_module_super(bulan, tahun) {
        $('#tabel_module_report').dataTable().fnClearTable();
        $('#tabel_module_report').dataTable().fnDestroy();

        $("#modal_module_transaksi").modal('hide');
        $("#tabel_module_report").show();

        // $('#form_reconcile').removeData();

        var tabel = $('#tabel_module_report').DataTable({
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
                url: '/superadmin/tabel_module_report_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "feature_id": $("#list_fiture").val(),
                    "month": bulan,
                    "year": tahun
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_module_report tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_module_report tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'community_name' },
                { mData: 'module' },
                { mData: 'activity' },
                { mData: 'endpoint' },
                { mData: 'date' },
            ],

        });
    }


    //tabel generate komunitas
    function tabel_report_komunitas_super(bulan, tahun) {
        $('#tabel_komunitas_report').dataTable().fnClearTable();
        $('#tabel_komunitas_report').dataTable().fnDestroy();

        $("#modal_komunitas_transaksi").modal('hide');
        $("#tabel_komunitas_report").show();

        // $('#form_reconcile').removeData();

        var tabel = $('#tabel_komunitas_report').DataTable({
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
                url: '/superadmin/tabel_komunitas_report_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": $("#komuniti_trans3").val(),
                    "month": bulan,
                    "year": tahun
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_komunitas_report tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_komunitas_report tbody').empty().append(nofound);

            },
            columns: [
                { mData: '_id' },
                { mData: 'module' },
                { mData: 'activity' },
                { mData: 'endpoint' },
                { mData: 'date' },
            ],

        });
    }

    //tabel generate transaksi
    function tabel_report_transaksi_super() {
        $('#tabel_transaksi_report').dataTable().fnClearTable();
        $('#tabel_transaksi_report').dataTable().fnDestroy();

        $("#modal_generate_transaksi").modal('hide');
        $("#tabel_transaksi_report").show();

        var tabel = $('#tabel_transaksi_report').DataTable({
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
                url: '/superadmin/tabel_report_transaksi_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "start_date": $("#tanggal_mulai").val(),
                    "end_date": $("#tanggal_selesai").val(),
                    "transaction_type_id": $("#jenis_transaksi").val(),
                    "transaction_status": $("#status_transaksi").val(),
                    "min_transaction": $("#min_trans").val(),
                    "max_transaction": $("#max_trans").val(),
                    "community_id": $("#komuniti_trans").val()

                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_transaksi_report tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_transaksi_report tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'invoice_number' },
                { mData: 'transaction_date' },
                {
                    mData: 'transaction_status',
                    render: function (data, type, row, meta) {
                        var ini = '';
                        if (data == 1) {
                            ini = '<small class="badge bg-abu melengkung10px cwhite">Pending</small>';
                        } else if (data == 2) {
                            ini = '<small class="badge bg-abu melengkung10px cwhite">Approved</small>';
                        } else {
                            ini = '<small class="badge bg-merah melengkung10px clight">Cancel</small>';
                        }
                        return ini;
                    }
                },
                { mData: 'transaction_type' },
                { mData: 'name' },
                {
                    mData: 'nominal',
                    render: function (data, type, row, meta) {
                        var rp = 'Rp. ' + rupiah(data);
                        return rp;
                    }
                },
                { mData: 'payment_type' },
                { mData: 'payment_method' },
            ],

        });

    }






    //dropdown transaction type
    function get_list_transaction_type_super() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_transaction_type_super",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#jenis_transaksi').empty();
                $('#jenis_transaksi').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#jenis_transaksi').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#jenis_transaksi").html($('#jenis_transaksi option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#jenis_transaksi").get(0).selectedIndex = 0;
                // ______________________________________________________________
                $('#jenis_transaksi2').empty();
                $('#jenis_transaksi2').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#jenis_transaksi2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#jenis_transaksi2").html($('#jenis_transaksi2 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#jenis_transaksi2").get(0).selectedIndex = 0;

            }
        });
    } //endfunction



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
                $('#komuniti_trans').empty();
                $('#komuniti_trans').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komuniti_trans").html($('#komuniti_trans option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans").get(0).selectedIndex = 0;
                // _______________________________________________________________

                $('#komuniti_trans2').empty();
                $('#komuniti_trans2').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komuniti_trans2").html($('#komuniti_trans2 option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans2").get(0).selectedIndex = 0;
                // _______________________________________________________________

                $('#komuniti_trans3').empty();
                $('#komuniti_trans3').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans3').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komuniti_trans3").html($('#komuniti_trans3 option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans3").get(0).selectedIndex = 0;
                // _______________________________________________________________

            }
        });
    } //endfunction


    //dropdown fitur list
    function get_list_fitur_super() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_fitur_super",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#list_fiture').empty();
                $('#list_fiture').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_fiture').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#list_fiture").html($('#list_fiture option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#list_fiture").get(0).selectedIndex = 0;


            }
        });
    } //endfunction



</script>

@endsection
