@extends('layout.admin-dashboard')
@section('title', 'Report Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Report Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en">Manage your report information<label>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="cgrey" style="margin-bottom: -1em;" lang="en">Report Generated</h4>

                <div class="tabbable-line tabreport">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_trans">
                            <a href="#tab_default_1" data-toggle="tab" lang="en">
                                <span lang="en">Transaction</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_reconsile">
                            <a href="#tab_default_2" data-toggle="tab" lang="en">
                                <span lang="en">Reconsile</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_subscriber">
                            <a href="#tab_default_3" data-toggle="tab" lang="en">
                                <span lang="en">Subscriber</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <button type="button" id="btn_generate_filter" class="btn btn-tosca btn-sm"
                                data-toggle="modal" data-target="#modal_generate_transaksi"
                                style="margin-bottom: 2em; display: none;" lang="en">Generate
                                Transaction Report</button>

                            <div class="accordion" id="tab_transaction_param">
                                <div class="card">
                                    <div class="card-header row" id="headingOne"
                                        style="background-color: white; border: none;">
                                        <div class="col-md-10">
                                            <h4 class="mb-0">
                                                <a data-toggle="collapse" href="#collapseOne" role="button"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne" style="color:#0e6f73;" lang="en"
                                                    data-lang-token="Choose Parameter First">
                                                    Choose Parameter First &nbsp;
                                                    <i class="mdi mdi-chevron-down cteal"></i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="col-md-2" style="text-align: right;">
                                            <button type="button" id="reset_tbl_trans"
                                                style="width: 25px; height: 25px;"
                                                class="btn btn-abu btn-icon btn-sm melengkung10px">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#tab_transaction_param">
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">Start Date</small>
                                                            <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                                                class="form-control input-abu">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">Transaction Type</small>
                                                            <select class="form-control input-abu listjenistrans"
                                                                name="jenis_transaksi3" id="jenis_transaksi3">
                                                                <option selected disabled lang="en">Choose </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">Minimum</small>
                                                            <input type="text" class="form-control input-abu"
                                                                id="min_trans2" name="min_trans2">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">End Date</small>
                                                            <input type="date" id="tanggal_selesai2"
                                                                name="tanggal_selesai2" class="form-control input-abu">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">Transaction
                                                                Status</small>
                                                            <select class="form-control input-abu"
                                                                name="status_transaksi2" id="status_transaksi2">
                                                                <option selected disabled lang="en">Choose</option>
                                                                <option value="1" lang="en">Pending</option>
                                                                <option value="2" lang="en">Approved</option>
                                                                <option value="3" lang="en">Cancel</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <small class="clight s13" lang="en">Maximum</small>
                                                            <input type="text" class="form-control input-abu"
                                                                id="max_trans2" name="max_trans2">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="text-align: right !important;">
                                                    <button type="button" id="btn_showtable_report"
                                                        class="btn btn-teal btn-sm melengkung10px"
                                                        style="margin-top: 2%;">
                                                        <i class="mdi mdi-check btn-icon-prepend" lang="en">
                                                        </i> <span lang="en">Show</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div><!-- end-card-body -->
                                    </div>
                                </div>
                            </div>



                            <!-- tabel all susbcriber -->
                            <table id="tabel_transaksi_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th><b lang="en">Invoice Number</b></th>
                                        <th><b lang="en">Date</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Type</b></th>
                                        <th><b lang="en">Admin Name</b></th>
                                        <th><b lang="en">Nominal</b></th>
                                        <th><b lang="en">Payment Type</b></th>
                                        <th><b lang="en">Payment Method</b></th>

                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_reconcile_transaksi" style="margin-bottom: 2em;" lang="en">
                                Generate Reconcile Report</button>
                            <br>
                            <!-- tabel all susbcriber -->
                            <table id="tabel_concile_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th><b lang="en">Invoice Number</b></th>
                                        <th><b lang="en">Transaction Date</b></th>
                                        <th><b lang="en">Status</b></th>
                                        <th><b lang="en">Type</b></th>
                                        <th><b lang="en">Admin Name</b></th>
                                        <th><b lang="en">Nominal</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>

                        <div class="tab-pane" id="tab_default_3">
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_subscriber_report" style="margin-bottom: 2em;" lang="en">Generate
                                Subscriber Report</button>
                            <br>
                            <table id="tabel_subscriber_report" class="table table-hover table-striped dt-responsive "
                                style="width:100% ; display: none;">
                                <thead>
                                    <tr>
                                        <th><b lang="en">ID Subscriber</b></th>
                                        <th><b lang="en">Name</b></th>
                                        <th><b lang="en">Activity</b></th>
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
                    <small class="modal-title cdarkgrey" lang="en">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;" lang="en">Transaction Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Start Date</small>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13" lang="en">Transaction Type</small>
                                <select class="form-control input-abu listjenistrans" name="jenis_transaksi"
                                    id="jenis_transaksi">
                                    <option selected disabled lang="en">Choose </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">End Date</small>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13" lang="en">Transaction Status</small>
                                <select class="form-control input-abu" name="status_transaksi" id="status_transaksi">
                                    <option selected disabled lang="en">Choose</option>
                                    <option value="1" lang="en">Pending</option>
                                    <option value="2" lang="en">Approved</option>
                                    <option value="3" lang="en">Cancel</option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small class="cgrey s13" lang="en">Transaction Range</small>
                                <div class="row" style="margin-top: 0.5em;">
                                    <div class="col-md-2">
                                        <small class="clight s13" style="text-align: right; margin-top: 1em;"
                                            lang="en">Minimum</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-abu" id="min_trans"
                                            name="min_trans">
                                    </div>
                                    <div class="col-md-2">
                                        <small class="clight s13" style="text-align: right; margin-top: 1em;"
                                            lang="en">Maximum</small>
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
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_trans" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Generate</span> </button>
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
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; min-height: 350px; height: auto;">
                    <small class="modal-title cdarkgrey" lang="en">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;" lang="en">Reconcile Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Transaction Type</small>
                                <select class="form-control input-abu listjenistrans" name="jenis_transaksi2"
                                    id="jenis_transaksi2">
                                    <option selected disabled lang="en"> Choose </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Month Year</small>
                                <input type="month" id="tahun_concile" name="tahun_concile" value="2020-01"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close">"</i><span lang="en">Cancel </>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_reconcile" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Generate </span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL FILTER TRANSAKSI REPORT SUPER -->
<div class="modal fade" id="modal_subscriber_report" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <small class="modal-title cdarkgrey" lang="en">Generate Report</small>
                    <h4 class="cblue" style="margin-bottom: 1.5em;" lang="en">Subscriber Report</h4>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Start Date</small>
                                <input type="date" id="tanggal_mulai_subs" name="tanggal_mulai_subs"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">End Date</small>
                                <input type="date" id="tanggal_selesai_subs" name="tanggal_selesai_subs"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Subscriber</small>
                                <select class="form-control input-abu" name="list_pengikut" id="list_pengikut">

                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_subscriber" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Generate</span></button>
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
        get_list_subscriber_report();
    });  //end


    $("#btn_generate_trans").click(function () {
        tabel_report_transaksi_admin();
    });


    $("#reset_tbl_trans").click(function () {
        $("#tanggal_mulai2").val("");
        $("#tanggal_selesai2").val("");
        $("#jenis_transaksi3").val("");
        $("#status_transaksi2").val("");
        $("#min_trans2").val("");
        $("#max_trans2").val("");
    });




    $("#btn_showtable_report").click(function () {
        $('#tabel_transaksi_report').dataTable().fnClearTable();
        $('#tabel_transaksi_report').dataTable().fnDestroy();

        $("#modal_generate_transaksi").modal('hide');
        $("#tabel_transaksi_report").show();
        $("#btn_generate_filter").show();
        $("#tab_transaction_param").hide();

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
                url: '/admin/tabel_report_transaksi_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "start_date": $("#tanggal_mulai2").val(),
                    "end_date": $("#tanggal_selesai2").val(),
                    "transaction_type_id": $("#jenis_transaksi3").val(),
                    "transaction_status": $("#status_transaksi2").val(),
                    "min_transaction": $("#min_trans2").val(),
                    "max_transaction": $("#max_trans2").val(),

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
                {
                    mData: 'transaction_date',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
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

    });

    $("#btn_generate_reconcile").click(function () {
        var tglq = $("#tahun_concile").val();
        var tgl = tglq.split('-');
        var bulan = tgl[1];
        var tahun = tgl[0];
        tabel_report_concile_super(bulan, tahun);
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
                url: '/admin/tabel_concile_report_admin',
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
                            ini = '<small class="badge bg-merah melengkung10px cgrey">Cancel</small>';
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


    //tabel generate transaksi
    function tabel_report_transaksi_admin() {
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
                url: '/admin/tabel_report_transaksi_admin',
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
                {
                    mData: 'transaction_date',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
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
            url: "/admin/get_list_transaction_type_admin",
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
                // ______________________________________________________________
                $('#jenis_transaksi3').empty();
                $('#jenis_transaksi3').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#jenis_transaksi3').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#jenis_transaksi3").html($('#jenis_transaksi3 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#jenis_transaksi3").get(0).selectedIndex = 0;

            }
        });
    } //endfunction




    //dropdown subscriber
    function get_list_subscriber_report() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_list_subscriber_report",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#list_pengikut').empty();
                $('#list_pengikut').append('<option value=""> Choose</option>');

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_pengikut').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_pengikut").html($('#list_pengikut option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_pengikut").get(0).selectedIndex = 0;


            }
        });
    } //endfunction


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_report_subscriber_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "start_date": $("#tanggal_mulai_subs").val(),
                "end_date": $("#tanggal_selesai_subs").val(),
                "subscriber_id": $("#list_pengikut").val()

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


    $("#btn_generate_subscriber").click(function () {
        tabel_tes();
        tabel_report_subscriber_admin();

    });

    //tabel generate transaksi
    function tabel_report_subscriber_admin() {
        $('#tabel_subscriber_report').dataTable().fnClearTable();
        $('#tabel_subscriber_report').dataTable().fnDestroy();

        $("#modal_subscriber_report").modal('hide');
        $("#tabel_subscriber_report").show();

        var tabel = $('#tabel_subscriber_report').DataTable({
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
                url: '/admin/tabel_report_subscriber_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "start_date": $("#tanggal_mulai_subs").val(),
                    "end_date": $("#tanggal_selesai_subs").val(),
                    "subscriber_id": $("#list_pengikut").val()

                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_subscriber_report tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_subscriber_report tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {
                        return "<div class='text-wrap width-250'>" + data + "</div>";
                    },
                },
                { mData: 'name' },
                {
                    mData: 'activity',
                    render: function (data, type, row, meta) {
                        console.log(data[0]);
                        var result = data[0];



                        var isshow = '';
                        var isshow2 = '';
                        $.each(result, function (i, isi) {
                            var tgl = dateFormatReport(isi.date);
                            isshow2 += '<li>' + isi.module + '&nbsp; <span class="cgrey">|</span> &nbsp; <small class="cteal2">' + tgl + '</small>' +
                                '<br>' +
                                '<label class="cgrey2">' + isi.endpoint + '</label>' +
                                '</li>';

                            isshow += '<div class="card"> ' +
                                '<div class="card-header" id="heading' + i + '" >' +
                                '<h2 class="mb-0">' +
                                '<button class="btn btn-link" type="button" data-toggle="collapse"' +
                                'data-target="#collapse' + i + '" aria-expanded="true"' +
                                'aria-controls="collapse' + i + '">' +
                                '<i class="mdi mdi-chevron-down"></i> &nbsp;' +
                                '<span class="cgrey s16">' + isi.module + '</span> &nbsp;<span' +
                                'class="cteal">' + tgl + '</span>' +
                                '</button>' +
                                '</h2>' +
                                '</div >' +
                                '<div id="collapse' + i + '" class="collapse" aria-labelledby="heading' + i + '"' +
                                'data-parent="#accordion_reportsubs">' +
                                '<div class="card-body s14 clight">' +
                                '<div class="row" style="margin-left: 0.5em;">' +
                                '<div class="col-12">' +
                                'ID : <div class="mb-1 cgrey2"> ' + isi._id + '</div>' +
                                'Date : <div class="mb-1 cgrey2">' + tgl + '</div>' +
                                'Endpoint : <div class="mb-1 cgrey2">' + isi.endpoint + '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div > ';

                        });
                        var layot = '<div class="text-wrap width-500"><div class="accordion" id="accordion_reportsubs">' + isshow + '</div></div>';
                        return layot;
                    }
                },
            ],

        });

    }

    function dateFormatReport(tgl) {
        var d = new Date(tgl);

        dformat = [d.getDate(), d.getMonth() + 1,
        d.getFullYear()].join('/') + ' &nbsp;  ' +
            [d.getHours(),
            d.getMinutes(),
            d.getSeconds()].join(':');

        return dformat;
    }

</script>

@endsection
