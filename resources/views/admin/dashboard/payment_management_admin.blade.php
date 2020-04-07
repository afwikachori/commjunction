@extends('layout.admin-dashboard')
@section('title', 'Payment Management')
@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Payment Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey">Manage your payment information<label>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                <div class="tabbable-line payment">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                All
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                Active
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row" style="margin-bottom: 0.5em;">
                                <div class="col-md-8">
                                    <!-- <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;">Filter</button> -->
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" id="reset_tbl_payment_all"
                                        class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- tabel all -->
                            <table id="tabel_payment_all_admin"
                                class="table table-hover table-striped dt-responsive wrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Payment</th>
                                        <th>Payment Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>

                        <div class="tab-pane" id="tab_default_2">
                            <table id="tabel_payment_active_admin"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Payment</th>
                                        <th>Payment Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
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




<!-- MODAL DETAIL PAYMENT-->
<div class="modal fade" id="modal_detail_payment_all_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%;max-width: 950px;">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="text-align: right; margin-right: 5px;">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body" style="padding:25px; min-height: 550px; height: auto; padding: 5px 25px 0px 25px;">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="cdarkgrey s20">Detail Payment</h4>

                        <div id="infor_pay_admin" style="margin-top: 7%;">
                            <center>
                                <img src="" class="rounded-circle img-fluid" id="img_detail_payment_super"
                                    onerror="this.onerror=null;this.src='/img/default.png';">
                                <br>
                                <small class="cblue">Payment Name</small>
                                <h6 class="cgrey tebal" id="detail_judul">-</h6>
                            </center>

                            <div class="div-info-payment">
                                <div class="form-group">
                                    <small class="cblue">Payment Type</small>
                                    <p class="cgrey2" id="detail_tipe_pay"> Not Set </p>
                                </div>
                                <div class="form-group">
                                    <small class="cblue">Description</small>
                                    <div style="overflow-y: scroll; height: 60px;">
                                        <p class="cgrey2 s14" id="detail_deskripsi">-</p>
                                    </div>
                                </div>
                                <div class="row hideku" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue">Price Montly</small>
                                            <p class="cgrey2" id="detail_pricebulan">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue">Price Annual</small>
                                            <p class="cgrey2" id="detail_pricetahun">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row hideku" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue">Minimum Montly</small><br>
                                            <span class="cgrey2" id="detail_minbulan"> 0 </span>
                                            <small class="clight"> &nbsp; / Month</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue">Minimum Annual</small><br>
                                            <spam class="cgrey2" id="detail_mintahun"> 0 </spam>
                                            <small class="clight"> &nbsp; / Year</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end-tab1 -->

                    </div>

                    <div class="col-md-8" style="padding-left: 25px;">

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h4 class="cdarkgrey s20">Sub Payment</h4>
                            </div>
                            <div class="col-md-6 col-sm-12" style="text-align: right; display: none;"
                                id="hide_btn_aktivasi">
                                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                    data-target="#modal_pay_module" data-dismiss="modal">
                                    Activation</button>
                            </div>
                        </div>
                        <br>

                        <table id="tabel_sub_payment_super"
                            class="table table-hover table-sm table-striped dt-responsive" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="cgrey2"><b> ID </b></th>
                                    <th class="cgrey2"><b> Title </b></th>
                                    <th class="cgrey2"><b> Icon </b></th>
                                    <th class="cgrey2"><b> Bank Name </b></th>
                                    <th class="cgrey2"><b> Owner Bank </b></th>
                                    <th class="cgrey2"><b> Status </b></th>
                                    <!-- <th class="cgrey2"><b> Time Limit </b></th>
                                    <th class="cgrey2"><b> Account </b></th>
                                    <th class="cgrey2"><b> Description </b></th> -->
                                    <th class="cgrey2"><b> Action </b></th>
                                </tr>
                            </thead>
                        </table>
                        <div id="notabel" style="display: none">
                            <center>
                                <br><br><br><br>
                                <h1 class="clight">Data Not Found</h1>
                            </center>
                        </div>
                    </div>
                </div>


            </div><!-- end-body -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL SUB-PAYMENT MANAGEMENT & SETTTING PAYMENT-->
<div class="modal fade" id="modal_detail_subpayment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px;">
                <h4 class="modal-title cgrey">Detail Sub-Payment</h4>
                <div id="subpay_status" style="text-align: right; margin-top: -1.5em; margin-bottom: 1.5em;"></div>


                <div class="tabbable-line" style="margin-top: -0.5em;">
                    <ul class="nav nav-tabs detailsubpay">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1_subpay" data-toggle="tab">
                                Detail
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2_subpay" data-toggle="tab">
                                Setting Sub
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1_subpay" style="height: auto; min-height: 425px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="circle" style="position: relative; margin-bottom: 1em; top: 0px;">
                                        <img src="/img/kosong.png" id="img_subpay"
                                            class="profile-pic rounded-circle img-fluid"
                                            onerror="this.onerror=null;this.src='/img/kosong.png';">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Payment Name</small>
                                        <p id="detail_nama_pay"> </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13">Payment Time Limit</small>
                                        <p id="detail_time_limit"></p>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: -0.5em;">
                                    <div class="form-group">
                                        <small class="clight s13">Description</small>
                                        <ul>
                                            <div id="detail_deskripsi_pay"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13"> Bank Name</small>
                                        <p id="detail_bank_pay"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13"> Rekening Numbers</small>
                                        <p id="detail_rekening"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13"> Owner Bank Name</small>
                                        <p id="detail_bankname"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer" style="border: none;">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                    style="border-radius: 10px;">
                                    <i class="mdi mdi-close"></i> Cancel
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_default_2_subpay" style="height: auto; min-height: 425px;">
                            <div id="nosetting_pay" style="display: none">
                                <center>
                                    <br><br><br><br>
                                    <h2 class="clight">No Setting Payment</h2>
                                </center>
                            </div>
                            <form method="POST" id="form_setting_subpayment"
                                action="{{route('setting_subpayment_admin')}}">
                                {{ csrf_field() }}
                                <!-- <input type="hidden" id="id_sub_metod" name="id_sub_metod"> -->
                                <div class="isi_setting_subpay" style="margin-top: 1.5em;">
                                </div>
                                <div class="modal-footer kananbawah">
                                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                        style="border-radius: 10px;">
                                        <i class="mdi mdi-close"></i> Cancel
                                    </button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_setpay"
                                        style="display: none;">
                                        <i class="mdi mdi-check btn-icon-prepend">
                                        </i>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- MODAL AKTIVASI PAYMENT MODULE -->
<div id="modal_pay_module" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_pay_module"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
            <form method="POST" id="form_aktivasi_payment_admin" action="{{route('aktivasi_payment_admin')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id_modulefitur" id="id_modulefitur">

                <div class="modal-body" style="min-height: 400px; height: auto; padding-left: 5%; padding-right: 5%;">
                    <h3 class="cgrey" style="margin-bottom :0em;">Activation Payment</h3>
                    <small class="clight">
                        This feature is paid, to activate please choose the payment method below
                    </small>
                    <br>
                    <br>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-4">
                            <h6 class="h6 cgrey2">Choose Payment Time</h6>
                            <select id="payment_time_module" class="form-control input-abu" name="payment_time_module"
                                required>
                                <option disabled selected>Choose</option>
                                <option value="1">Monthly</option>
                                <option value="2">Annual</option>
                            </select>
                        </div>
                        <div class="col-md-8" style="margin-top: auto; margin-bottom: auto;">
                            <input class="form-control input-abu" type="hidden" id="aktif_id_payment"
                                name="aktif_id_payment">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="h6 cgrey2">Choose Payment Method</h6>
                            <div class="row" style="padding-left: 5%; margin-top: -0.3em;">
                                <div id="isi_method_pay">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h6 class="h6 cgrey2" style="margin-bottom:1em;">Bank Transfer</h6>
                            <div id="isi_show_bank" class="collapse-accordion" role="tablist"
                                aria-multiselectable="true">

                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pay_method_module" id="id_pay_method_module">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        tabel_payment_all_admin();
        tabel_payment_active_admin();
        get_payment_module();
        tabel_tes();
    });  //end ready


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_payment_active_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    function tabel_payment_all_admin() {
        $('#tabel_payment_all_admin').dataTable().fnClearTable();
        $('#tabel_payment_all_admin').dataTable().fnDestroy();

        var tabel = $('#tabel_payment_all_admin').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_payment_all_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_all_admin tbody').empty().append(nofound);
                    ui.popup.show('error', "Internal Server Error", 'Error');
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_all_admin tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                {
                    mData: 'description', width: 100,
                    render: function (data, type, row, meta) {
                        return "<div class='text-wrap width-450'>" + data + "</div>";
                    },
                    targets: 3
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dt = data + "<>" + row.level_status + "<>" + row.status;
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_all_admin(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

    }


    function tabel_payment_active_admin() {
        var tabel = $('#tabel_payment_active_admin').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_payment_active_admin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_active_admin tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_active_admin tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                {
                    mData: 'description', width: 100,
                    render: function (data, type, row, meta) {
                        return "<div class='text-wrap width-450'>" + data + "</div>";
                    },
                    targets: 3
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dtaktif = data + "<>" + row.level_status + "<>" + row.status;
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_all_admin(\'' + dtaktif + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

    }


    function detail_payment_all_admin(dtpay) {
        var split = dtpay.split('<>');
        // console.log(split);
        $("#aktif_id_payment").val(split[0]);
        // $("#notabel").hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/detail_payment_all_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "payment_id": split[0],
                "level_status": split[1],
                "status": split[2]

            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    var res = result[0];
                    if (res.status === false) {
                        $("#hide_btn_aktivasi").show();
                    } else {
                        $("#hide_btn_aktivasi").hide();

                    }

                    if (res.payment_title != null) {
                        $("#detail_judul").html(res.payment_title);
                    }
                    if (res.description != null) {
                        $("#detail_deskripsi").html(res.description);
                    }

                    if (res.price_monthly != null) {
                        $("#detail_pricebulan").html("Rp " + rupiah(res.price_monthly));
                        $("#detail_pricetahun").html("Rp " + rupiah(res.price_annual));
                        $("#detail_minbulan").html(res.minimum_monthly_subscription);
                        $("#detail_mintahun").html(res.minimum_annual_subscription);
                        $(".hideku").fadeIn("fast");
                    } else {
                        $(".hideku").fadeOut("fast");
                    }

                    if (res.payment_methods != "") {
                        var jsnDt = res.payment_methods;

                        $('#tabel_sub_payment_super').DataTable().clear();
                        $('#tabel_sub_payment_super').DataTable().destroy();
                        $('#tabel_sub_payment_super tbody').empty();
                        // $("#notabel").hide();
                        $('#tabel_sub_payment_super').show();

                        var tabelku = $('#tabel_sub_payment_super').DataTable({
                            responsive: true,
                            emptyTable: "No Data Available",
                            language: {
                                paginate: {
                                    next: '<i class="mdi mdi-chevron-right"></i>',
                                    previous: '<i class="mdi mdi-chevron-left">'
                                }
                            },
                            data: jsnDt,
                            columns: [
                                { mData: 'id' },
                                { mData: 'payment_title' },
                                {
                                    mData: 'icon',
                                    render: function (data, type, row, meta) {
                                        var dtimg = server_cdn + data;
                                        var noimg = '/img/fitur.png';
                                        return '<img src="' + dtimg + '" style="width:30px; height:30px;" id="imgsubpay_' + row + '" class="rounded-circle img-fluid zoom" onclick="clickImage(this)" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"">';
                                    }
                                },
                                { mData: 'payment_bank_name' },
                                { mData: 'payment_owner_name' },
                                {
                                    mData: 'status',
                                    render: function (data, type, row, meta) {
                                        var isine = '';
                                        if (data == 0) {
                                            isine = '<small class="badge bg-abu melengkung10px cwhite">Deactive</small>';
                                        } else if (data == 1) {
                                            isine = '<small class="badge bg-biru melengkung10px cdarkgrey">Active</small>';
                                        } else if (data == 2) {
                                            isine = '<small class="badge bg-kuning melengkung10px cdarkgrey">Unpaid</small>';
                                        }
                                        return isine;
                                    }
                                },
                                {
                                    mData: 'id',
                                    render: function (data, type, row, meta) {
                                        var dtaktif = data + "<>" + res.level_status + "<>" + res.status;
                                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                                            'onclick="detail_subpayment(\'' + dtaktif + '\')">' +
                                            '<i class="mdi mdi-eye"></i>' +
                                            '</button>';
                                    }
                                }
                            ],
                        }); //end-datatable

                    } else {
                        var nofound = '<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                        $('#tabel_sub_payment_super tbody').html(nofound);
                        // $("#tabel_sub_payment_super").hide();
                        // $("#notabel").show();
                    }
                    $("#modal_detail_payment_all_admin").modal('show');
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });



    }

    function detail_subpayment(subdata) {
        var split = subdata.split('<>');
        // alert(subdata);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/detail_tabel_subpayment',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "subpayment_id": split[0],
                "level_status": split[1],
                "status": split[2]
            },
            success: function (result) {
                console.log(result);
                var isi = result[0];
                // $("#id_sub_metod").val(isi.id);
                $("#aktif_id_subpayment").val(isi.id);

                var statusui = '';
                if (isi.status == 0) {
                    statusui = '<small class="badge bg-abu melengkung10px cwhite" style="width :100px">Deactive</small>';
                } else {
                    statusui = '<small class="badge bg-biru melengkung10px cdarkgrey" style="width :100px">Active</small>';
                }
                $("#subpay_status").html(statusui);

                if (isi.icon != null) {
                    var icn = isi.icon;
                    var cekimg = icn.slice(0, 1);

                    if (cekimg == "/") {
                        var isiimg = icn.slice(1);
                    } else {
                        var isiimg = isi.icon;
                    }
                    imglogo = server_cdn + isiimg;
                    $('#img_subpay').attr('src', imglogo);
                }

                $("#detail_nama_pay").html(isi.payment_title);
                $("#detail_time_limit").html(isi.payment_time_limit + "  Day");

                var uiku2 = '';
                $.each(isi.description, function (i, item) {
                    uiku2 += '<li style="background-color: #ffffff !important;">' + item + '</li>';
                });
                $("#detail_deskripsi_pay").html(uiku2);

                $("#detail_bank_pay").html(isi.payment_bank_name);
                $("#detail_rekening").html(isi.payment_account);
                $("#detail_bankname").html(isi.payment_owner_name);

                if(isi.level_status != 2 ){
                    $(".isi_setting_subpay").html('<center><br><br><br><h4 class=clight>To setting up, Please Activate this payment first or see Active Payment Table</h4></center');
                }else{
                     get_setting_subpayment_admin(isi.id);
                }

                $("#modal_detail_payment_all_admin").modal("hide");
                $("#modal_detail_subpayment_super").modal("show");
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });

    }

    function get_setting_subpayment_admin(idnya) {
        // alert(idnya);
        $(".isi_setting_subpay").html("");
        $(".set_id_paymethod").val(idnya);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_setting_subpayment_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "payment_method_id": idnya,
            },
            success: function (result) {
                console.log(result);

                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        if (result.message === "Data Tidak ditemukan" || result.code === "PLQ97") {
                            $("#nosetting_pay").show();
                            $(".isi_setting_subpay").hide();
                            $("#btn_submit_setpay").hide();
                        } else {
                            ui.popup.show('warning', result.message, 'Warning');
                        }
                    }
                } else {
                    var uiku = '';
                    $.each(result, function (i, item) {
                        var htmltag = '';
                        if (item.setting_type == 1) {
                            var tipe = 'Input Text';
                            htmltag = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                                'class="form-control input-abu param_setting">';
                        } else {
                            var tipe = 'Radio Button';
                            if (item.value == "true") {
                                htmltag = '<div class="form-group">' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                                    '</div>' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                                    '</div>';
                            } else {
                                htmltag = '<div class="form-group">' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                                    '</div>' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                                    '</div>';
                            }
                        }

                        uiku += '<div class="row" style="margin-bottom:0.5em;">' +
                            '<div class="col-8"><div class="form-group">' +
                            '<h6 class="cgrey1 tebal name_setting">' + item.title +
                            '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                            '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                            '</p>' +
                            '<input type="hidden" value="' + item.id + '" name="idsub_' + item.id + '">' +
                            '</div>' +
                            '</div >' +
                            '<div class="col-4">' + htmltag +
                            '</div></div></div>';
                    });
                    $("#nosetting_pay").hide();
                    $("#btn_submit_setpay").show();
                    $(".isi_setting_subpay").html(uiku);
                }
            },
            error: function (result) {
                console.log(result);
                console.log('data not found');
            }
        });
    }


    $("#reset_tbl_payment_all").click(function () {
        tabel_payment_all_admin();
    });


    function get_payment_module() {
        // $("#btn_submit_paymethod").attr("disabled", "disabled");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_payment_module',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                // console.log(result);
                var text = '';
                var isibank = '';

                var noimg = '/img/fitur.png';

                $.each(result, function (i, item) {
                    text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value=""' +
                        'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';
                    var deskrip = '';
                    $.each(item.payment_methods, function (i, itm) {
                        $.each(itm.description, function (x, isides) {
                            deskrip += '<li sytle="background-color:#fff;">' + isides + '</li>';
                        });
                        isibank +=
                            '<div class="card border-oren hidendulu method' + item.id + '" id="cardpay' + itm.id + '">' +
                            '<div class="card-header" role="tab" sytle="background-color:#fff;">' +
                            '<h6 class="mb-0 pdb1">' +
                            '<a data-toggle="collapse" data-parent="#isi_show_bank" href="#collapseOne' + itm.id + '" ' +
                            'id="idpayq' + itm.id + '" onclick="pilihpay(' + itm.id + ');" aria-expanded="true"' +
                            'aria-controls="collapseOne' + itm.id + '">' +
                            '<img src="' + server_cdn + itm.icon + '" class="imgepay" style="width: 10%; height: auto;"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + itm.payment_title +
                            '<span class="float-right">' +
                            '<i class="fa fa-chevron-right"></i>' +
                            '</span>' +
                            '</a></h6></div>' +
                            '<div id="collapseOne' + itm.id + '" class="collapse" role="tabpanel">' +
                            '<div class="card-block"><ul>' + deskrip +
                            '</ul></div></div></div>';
                    });
                });
                $("#isi_method_pay").html(text);
                $("#isi_show_bank").html(isibank);

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }

    function pilih_pay_bank(ini) {
        $(".hidendulu").removeClass('dipilih');
        $('.btn-blueline').removeClass('active');
        $("#" + ini.id).addClass('active');
        $("." + ini.id).addClass('dipilih');
        $("." + ini.id).removeClass('active');
    }


    function pilihpay(idpay) {
        $("#id_pay_method_module").val(idpay);
        $(".border-oren").removeClass("active");
        $("#cardpay" + idpay).addClass("active");
        $("#btn_pay_next").removeAttr("disabled");
        if($("#payment_time_module").val() !=""){
            $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
        }
    }


</script>

@endsection
