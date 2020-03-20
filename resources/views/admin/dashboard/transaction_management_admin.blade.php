@extends('layout.admin-dashboard')
@section('title', 'Transaction Management')

@section('content')
<div id="div_ignore">
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Transaction Management</h3>

    <nav aria-label="breadcrumb">

    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="accordion" id="tab_transaction_param">
                    <div class="card">
                        <div class="card-header row" id="headingOne" style="background-color: white; border: none;">
                            <div class="col-md-10">
                                <h4 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" role="button"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                        style="color:#0e6f73;">
                                        Choose Parameter First &nbsp;
                                        <i class="mdi mdi-chevron-down cteal"></i>
                                    </a>
                                </h4>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <button type="button" id="reset_tbl_trans" style="width: 25px; height: 25px;"
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
                                                <small class="clight">Community Name</small>
                                                <h5 class="nama_komunitas cgrey2" style="margin-top: 0.5em;"></h5>
                                                <input type="hidden" class="form-control input-abu" name="komunitas"
                                                    id="komunitas">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">Start Date</small>
                                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                                    class="form-control input-abu">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">End Date</small>
                                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                                    class="form-control input-abu">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">Transaction Type</small>
                                                <select class="form-control input-abu" name="tipe_trans"
                                                    id="tipe_trans">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight"> Transaction Status</small>
                                                <select class="form-control input-abu" name="status_trans"
                                                    id="status_trans">
                                                    <option value="null"> Choose </option>
                                                    <option value="1"> Pending </option>
                                                    <option value="2"> Approval </option>
                                                    <option value="3"> Cancel </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group subs_name">
                                                <small class="clight">Subscriber</small>
                                                <select class="form-control input-abu" name="subs_name" id="subs_name">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="text-align: right !important;">
                                        <button type="button" id="btn_showtable_transaksi"
                                            class="btn btn-teal btn-sm melengkung10px" style="margin-top: 2%;">
                                            <i class="mdi mdi-check btn-icon-prepend">
                                            </i> Show
                                        </button>
                                    </div>
                                </form>
                            </div><!-- end-card-body -->
                        </div>
                    </div>
                </div>


                <div class="showin_table_trans" style="display: none;margin-top: 1%;">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" id="btn_filter_trans" class="btn btn-tosca btn-sm"
                                style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                data-target="#modal_trasaksi_filter" data-dismiss="modal">Filter</button>
                        </div>
                        <div class="col-md-4" style="text-align: right;">
                            <button type="button" id="reset_tbl_subsall"
                                class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                <i class="mdi mdi-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <!-- tabel -->
                    <table id="tabel_trans" class="table table-hover table-striped dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Transaction Date</th>
                                <th>Subcriber Name</th>
                                <th>Transaction Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- end tabel  -->
                </div>

            </div>
        </div>
    </div>
</div>

<div id="convert_me_to_pdf">

</div>

</div>



<!-- MODAL DETAIL TRASACTION-->
<div class="modal fade" id="modal_detail_trans" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 900px;">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="text-align: right; margin-right: 5px;">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body" style="padding:25px; min-height: 550px; height: auto; padding: 5px 25px 0px 25px;">
                <div id="for_download">
                <div class="row">
                    <div class="col-md-6 col-sm-12" style="border-right: 1px solid #E0E0E0; height: 100%;">
                        <h4 class="tebal cgrey2">Detail Transaction</h4>

                        <h5 class="cblue" style="margin-bottom: 1em;" id="invoice_trans">-</h5>

                        <small class="clight">Transaction Date</small>
                        <p class="cgrey2" id="date_trans">-</p>

                        <div class="row">
                            <div class="col-md-2" style="padding-right: 1px;">
                                <img src="/img/cam.png" class="rounded-circle img-fluid" style="width: 40px;">
                            </div>
                            <div class="col-md-4" style="padding: 0px;">
                                <small class="clight">Community Name</small>
                                <p class="cgrey2" id="komunitas_trans">-</p>
                            </div>
                            <div class="col-md-2" style="padding-right: 10px; padding-left: 0px; text-align: right;">
                                <img src="/img/def-profil.png" class="rounded-circle img-fluid" style="width: 40px;">
                            </div>
                            <div class="col-md-4" style="padding: 0px;">
                                <small class="clight">Subcriber Name</small>
                                <p class="cgrey2" id="subscriber_trans">-</p>
                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-md-6">
                                <small class="clight">Level Title</small>
                                <p class="cgrey2" id="level_title_trans">-</p>
                            </div>
                            <div class="col-md-6">
                                <small class="clight">Status</small>
                                <p class="cgrey2" id="statusjudul_trans">-</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <small class="clight">Transaction Type</small>
                                <p class="cgrey2" id="jenis_trans">-</p>
                            </div>
                            <div class="col-md-6">
                                <small class="clight">Transaction</small>
                                <p class="cgrey2" id="transaksi_trans">-</p>
                            </div>
                            <div class="col-md-6">
                                <small class="clight">Total Nominal</small>
                                <p class="cgrey2" id="nominal_trans">-</p>
                            </div>
                        </div>


                        <div class="footer_mdl" style="text-align: right; margin-top: 22%;">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                style="border-radius: 10px;">
                                <i class="mdi mdi-close"></i> Cancel
                            </button>
                            &nbsp;
                            <button type="button" class="btn btn-teal btn-sm" id="btn_download_detail" style="display: none;">
                                <i class="mdi mdi-check btn-icon-prepend"></i>
                                Download</button>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12" style="height: 100%;">
                        <div style="text-align: right;">
                            <small class="clight" style="margin-top: 0.5em;">Payment Status</small>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div id="status_color"></div>
                        </div>

                        <br>
                        <h5 class="cgrey tebal">Payment Confirmation</h5>
                        <div class="row" style="padding: 0 5% 0 5%;">
                            <div class="col-md-12"
                                style="height: 115px; background-color: lavender; border-radius: 10px;">
                                <img src="" id="img_pay_confirm" onclick="clickImage(this)"
                                    style="height: 115px; width: 100%;"
                                    onerror="this.onerror=null;this.src='/img/noimg.jpg';">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 0.5em;">
                            <div class="col-md-4">
                                <small class="clight">Account Name</small><br>
                                <small class="cgrey2" id="nama_confirm_trans">-</small>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Bank Name</small><br>
                                <small class="cgrey2" id="bank_confirm_trans">-</small>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Date Confirmation</small><br>
                                <small class="cgrey2" id="date_confirm_trans">-</small>
                            </div>
                        </div>

                        <br>

                        <h5 class="cgrey tebal">Payment Confirmation</h5>
                        <div class="row" style="padding: 0 5% 0 5%;">
                            <div class="col-md-12"
                                style="height: 115px; background-color: lavender; border-radius: 10px;">
                                <img src="" id="img_pay_aprov" onclick="clickImage(this)"
                                    style="height: 115px; width: 100%;"
                                    onerror="this.onerror=null;this.src='/img/noimg.jpg';">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 0.5em;">
                            <div class="col-md-4">
                                <small class="clight">Approver Name</small><br>
                                <small class="cgrey2" id="name_approv_trans">-</s>
                            </div>
                            <div class="col-md-8">
                                <small class="clight">Approved Date</small><br>
                                <small class="cgrey2" id="date_approv_trans">-</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- dl -->
            </div><!-- end-body -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>



<!-- MODAL FILTER TRANSAKSI-->
<div class="modal fade" id="modal_trasaksi_filter" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Filter Transaction</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="clight s13">Transaction Type</small>
                                <select class="form-control input-abu" name="tipe_trans2" id="tipe_trans2">
                                </select>
                            </div>

                        </div> <!-- end-col-md -->


                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="clight s13"> Transaction Status</small>
                                <select class="form-control input-abu" name="status_trans2" id="status_trans2">
                                    <option value="null"> Choose </option>
                                    <option value="1"> Pending </option>
                                    <option value="2"> Approval </option>
                                    <option value="3"> Cancel </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <center>
                                <label class="cgrey2" style="margin-top: 1.5em;">
                                    Community
                                </label>
                            </center>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <h5 class="nama_komunitas cgrey2" style="margin-top: 0.5em;"></h5>
                                <input type="hidden" class="form-control input-abu" name="komunitas2" id="komunitas2">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <center>
                                <label class="cgrey2" style="margin-top: 1.5em;">
                                    Subscriber
                                </label>
                            </center>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <select class="form-control input-abu" name="subs_name2" id="subs_name2">
                                    <option selected disabled> Choose Community First</option>
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
                    <button type="button" id="btn_filter_transaksi" class="btn btn-teal btn-sm">
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
        get_list_transaction_tipe();
        get_list_subscriber_admin();
    });

    $("#reset_tbl_trans").click(function () {
        resetparam_trans();
    });

    function resetparam_trans() {
        $("#komunitas").val("");
        $("#tanggal_mulai").val("");
        $("#tanggal_selesai").val("");
        $("#tipe_trans").val("");
        $("#status_trans").val("");
        $("#subs_name").val("");
    }

    //dropdown tipe_trans list
    function get_list_transaction_tipe() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $.ajax({
            url: "/admin/get_list_transaction_tipe",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#tipe_trans').empty();
                $('#tipe_trans').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#tipe_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#tipe_trans").html($('#tipe_trans option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#tipe_trans").get(0).selectedIndex = 0;

                const OldTipetrans = "{{old('tipe_trans')}}";

                if (OldTipetrans !== '') {
                    $('#tipe_trans').val(OldTipetrans);
                }
                // ___________________________________________________________________
                $('#tipe_trans2').empty();
                $('#tipe_trans2').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#tipe_trans2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#tipe_trans2").html($('#tipe_trans2 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#tipe_trans2").get(0).selectedIndex = 0;

                const OldTipetrans2 = "{{old('tipe_trans2')}}";

                if (OldTipetrans2 !== '') {
                    $('#tipe_trans2').val(OldTipetrans2);
                }
            }
        });
    } //endfunction

    //dropdown subs_name list
    function get_list_subscriber_admin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_list_subcriber_name",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#subs_name').empty();
                $('#subs_name').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#subs_name').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#subs_name").html($('#subs_name option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#subs_name").get(0).selectedIndex = 0; const
                    OldSubs1 = "{{old('subs_name')}}";
                if (OldSubs1 !== '') {
                    $('#subs_name').val(OldSubs1);
                }
                // _______________________________________________________________________________
                $('#subs_name2').empty();
                $('#subs_name2').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#subs_name2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#subs_name2").html($('#subs_name2 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#subs_name2").get(0).selectedIndex = 0; const
                    OldSubs2 = "{{old('subs_name2')}}";
                if (OldSubs2 !== '') { $('#subs_name2').val(OldSubs2); }

            },
            error: function (result) {
                ui.popup.show('Warning', 'Get list community', 'Warning');
            }
        });
    }
    //end list subscriber


    $("#btn_showtable_transaksi").click(function (e) {
        // tabel_tes();
        show_tabel_transaksi();
    });



    function show_tabel_transaksi() {
        $('#tabel_trans').dataTable().fnClearTable();
        $('#tabel_trans').dataTable().fnDestroy();

        $(".showin_table_trans").show();
        $("#tab_transaction_param").hide();

        var tabel = $('#tabel_trans').DataTable({
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
            ajax: {
                url: '/admin/tabel_transaksi_show',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "komunitas": $("#komunitas").val(),
                    "tanggal_mulai": $("#tanggal_mulai").val(),
                    "tanggal_selesai": $("#tanggal_selesai").val(),
                    "tipe_trans": $("#tipe_trans").val(),
                    "status_trans": $("#status_trans").val(),
                    "subs_name": $("#subs_name").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    // $('#tabel_subscriber tbody').;
                    $('#tabel_trans tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                ui.popup.show('error', status, 'Error');
            },
            columns: [
                { mData: 'invoice_number' },
                { mData: 'created_at' },
                { mData: 'name' },
                { mData: 'transaction_type' },
                { mData: 'status_title' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dt = [row.invoice_number, row.payment_level, row.community_id];
                        // console.log(data);
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_transaksi_all(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });
    }


    $("#btn_filter_transaksi").click(function (e) {
        // alert("filter");
        resetparam_trans();
        $('#tabel_trans').dataTable().fnClearTable();
        $('#tabel_trans').dataTable().fnDestroy();

        $(".showin_table_trans").show();
        $("#tab_transaction_param").hide();

        $("#modal_trasaksi_filter").modal("hide");


        var tabel = $('#tabel_trans').DataTable({
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
            ajax: {
                url: '/admin/tabel_transaksi_show',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "komunitas": $("#komunitas2").val(),
                    "tanggal_mulai": $("#tanggal_mulai2").val(),
                    "tanggal_selesai": $("#tanggal_selesai2").val(),
                    "tipe_trans": $("#tipe_trans2").val(),
                    "status_trans": $("#status_trans2").val(),
                    "subs_name": $("#subs_name2").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    // $('#tabel_subscriber tbody').;
                    $('#tabel_trans tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'invoice_number' },
                { mData: 'created_at' },
                { mData: 'name' },
                { mData: 'transaction_type' },
                { mData: 'status_title' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dt = [row.invoice_number, row.payment_level, row.community_id];
                        // console.log(data);
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_transaksi_all(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });
    });



    function detail_transaksi_all(dt_trans) {
        var trans = dt_trans.split(',');
        console.log(trans);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $.ajax({
            url: '/admin/detail_transaksi_superadmin',
            type: 'POST',
            datatype: 'JSON',
            timeout: 20000,
            data: {
                "invoice_number": trans[0],
                "payment_level": trans[1],
                "community_id": trans[2],
            },
            success: function (result) {
                if (result.success == false) {
                    ui.popup.show('error', result.message, 'Error');
                    $("#modal_detail_trans").modal('hide');
                } else {

                    $("#modal_detail_trans").modal('show');
                    console.log(result);
                    $("#invoice_trans").html(result.invoice_number);
                    $("#date_trans").html(result.created_at);
                    $("#komunitas_trans").html(result.community_name);
                    $("#subscriber_trans").html(result.name);
                    $("#level_title_trans").html(result.level_title);
                    $("#nominal_trans").html(result.grand_total);
                    $("#jenis_trans").html(result.transaction_type);
                    $("#statusjudul_trans").html(result.status_title);
                    $("#transaksi_trans").html(result.transaction);

                    var uiku = '';
                    if (result.data_confirmation.file != "") {
                        $("#img_pay_confirm").attr("src", server_cdn + result.data_confirmation.file);
                        $("#nama_confirm_trans").html(result.data_confirmation.created_by);
                        $("#date_confirm_trans").html(result.data_confirmation.created_at);

                        uiku = '<button type="button" class="btn btn-tosca' +
                            'melengkung10px btn-sm"> Paid</button >';
                        $("#status_color").html(uiku);
                    } else {
                        $("#img_pay_confirm").attr("src", "");
                        uiku = '<button type="button" class="btn btn-abu' +
                            'melengkung10px btn-sm"> Not Yet</button >';
                        $("#status_color").html(uiku);
                    }


                    if (result.data_verification.file != "") {
                        $("#img_pay_aprov").attr("src", server_cdn + result.data_verification.file);
                        $("#name_approv_trans").html(result.data_verification.verification_by);
                        $("#date_approv_trans").html(result.data_verification.verification_at);
                    }


                    var doc = new jsPDF();
                    var specialElementHandlers = {
                        '#div_ignore': function (element, renderer) {
                            return true;
                        }
                    };

                    $("#btn_download_detail").click(function () {
                        doc.fromHTML($('#for_download').html(), 15, 15, {
                            'width': 190,
                            'elementHandlers': specialElementHandlers
                        });
                        doc.save('detail transaction.pdf');
                    });


                    // $("#").html(result.);
                    // $("#").html(result.);
                    // $("#").html(result.);
                }

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show Detail");
            }
        });
    }



</script>

@endsection
