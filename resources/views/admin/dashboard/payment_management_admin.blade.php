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
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;">Filter</button> -->
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" id="reset_tbl_subsall"
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
                                    onerror="this.onerror=null;this.src='/img/noimg.jpg';">
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
                                    <p class="cgrey2 s14" id="detail_deskripsi">-</p>
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
                            <div class="col-md-12 col-sm-12">
                                <h4 class="cdarkgrey s20">Sub Payment</h4>
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
                    </div>
                </div>


            </div><!-- end-body -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL SUB-PAYMENT MANAGEMENT-->
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
                        <div class="tab-pane active" id="tab_default_1_subpay" style="height: auto; min-height: 455px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="circle" style="position: relative; margin-bottom: 1em; top: 0px;">
                                        <img src="" id="img_subpay" class="profile-pic rounded-circle img-fluid">
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
                                &nbsp;
                                <button type="submit" id="klik_edit_subpay" class="btn btn-teal btn-sm"
                                    data-toggle="modal" data-target="#modal_edit_subpayment_super" data-dismiss="modal">
                                    <i class="mdi mdi-check btn-icon-prepend">
                                    </i> Edit Subpayment </button>
                            </div> <!-- end-footer     -->

                        </div>
                        <!-- {{-- endtab --}} -->

                        <div class="tab-pane" id="tab_default_2_subpay" style="height: auto; min-height: 455px;">
                            isis list setting

                            <div class="isi_setting_subpay" style="margin-top: 1.5em;">
                            </div>
                        </div>
                        <!-- {{-- endtab --}} -->
                    </div>
                </div>
            </div> <!-- end-body -->


        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL EDIT SUB-PAYMENT MANAGEMENT-->
<div class="modal fade" id="modal_edit_subpayment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div id="tampil_detail_pricing">
                <form method="POST" id="form_edit_pricing" action="{{route('edit_subpayment_super')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                        <h4 class="modal-title cgrey">Edit Sub-Payment</h4>
                        <div class="pricing_status" style="text-align: right;"></div>

                    </div> <!-- end-header -->

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px;">
                        <input type="hidden" id="payment_method_id" name="payment_method_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="img-upload-profil" style="margin-top: -1.5em; margin-bottom: 5em;">
                                    <div class="circle">
                                        <img id="view_img_subpay_edit" class="profile-pic rounded-circle img-fluid"
                                            src="/img/focus.png">
                                    </div>
                                    <div class="p-image">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i id="browse_img_subpay_edit" class="mdi mdi-camera upload-button"></i>
                                        </button>
                                        <input id="file_img_subpay_edit" class="file-upload file-upload-default"
                                            type="file" name="fileup" accept="image/*" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Name</small>
                                    <input type="text" id="edit_sub_namapay" name="edit_sub_namapay"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Payment Time Limit</small>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" id="edit_sub_timelimit" name="edit_sub_timelimit"
                                                class="form-control input-abu" required>
                                        </div>
                                        <div class="col-4" style="padding-left: 0px !important;">
                                            <small class="cgrey" style="margin-top: 0.5em;"> Days </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: -0.5em;">
                                <div class="form-group">
                                    <small class="clight s13">Description</small>
                                    <textarea class="form-control input-abu" id="edit_sub_deskripsi"
                                        name="edit_sub_deskripsi" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13"> Bank Name</small>
                                    <select class="form-control input-abu" name="edit_sub_nama_bank"
                                        id="edit_sub_nama_bank">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13"> Rekening Numbers</small>
                                    <input type="text" id="edit_sub_rekening" name="edit_sub_rekening"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13"> Owner Bank Name</small>
                                    <input type="text" id="edit_sub_owner_bank" name="edit_sub_owner_bank"
                                        class="form-control input-abu" required>
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
                        <button type="submit" id="edit_subpayment_super" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Edit </button>
                    </div> <!-- end-footer     -->
                </form>
            </div>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL SETTING  MODULE -->
<div class="modal fade" id="modul_add_settings_subpay" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="POST" id="form_add_settings_subpay" action="{{route('add_setting_sub_payment')}}">
        {{ csrf_field() }}
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content"
                style="background-color: #ffffff; min-height: 350px; padding-left: 3%; padding-right: 3%;">
                <div class="modal-header" style="padding-bottom: 0.5em !important; border:none;">
                    <h3 class="modal-title cgrey">Add Setting Sub-Payment</h3>
                    <!-- <label class="badge melengkung10px btn-tosca cputih" style="min-width:100px;"> Active</label>  -->
                </div> <!-- end-header -->

                <div class="modal-body">
                    <div class="row-input">
                        <input type="hidden" class="set_id_paymethod" name="set_id_paymethod">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <small class="clight s13">Title</small>
                                    <input type="text" id="set_judul" name="set_judul" class="form-control input-abu"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <small class="clight s13">Setting Type</small>
                                    <select class="form-control input-abu" name="set_tipe" id="set_tipe">
                                        <option selected disabled> Choose </option>
                                        <option value="1"> Radio Button </option>
                                        <option value="2"> Inputan </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <small class="clight s13">Description</small>
                                <textarea type="text" id="set_deskripsi" name="set_deskripsi"
                                    class="form-control input-abu" rows="1"></textarea>
                            </div>
                            <div class="col-md-2">
                                <div class=" form-group">
                                    <small class="clight s13">Value</small>
                                    <input type="text" id="set_value" name="set_value" class="form-control input-abu"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md" style="margin-top: 0.5em;">
                                <small class="clight s13">Tag Html</small>
                            </div>
                            <div class="col-md-11">
                                <input type="text" id="set_tag_html" name="set_tag_html"
                                    class="form-control input-abu"></input>
                            </div>

                        </div>
                    </div>

                    <div id="isi_newrow"></div>

                    <center>
                        <button type="button" class="btn btn-icon-text" id="addnewrow">
                            <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                            <small>Add New Input</small> </button>
                    </center>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">Add Settings</button>
                    </center>
                </div> <!-- end-footer     -->
            </div> <!-- END-MDL CONTENT -->
        </div>
    </form>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        tabel_payment_all_admin();
        tabel_payment_active_admin();
    });  //end


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_payment_all_admin',
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
                },
            },
            success: function (result) {
                console.log(result);
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
                        var dt = data + "<>" + row.payment_title;
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
            success: function (result) {
                console.log(result);
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
                        var dt = data + "<>" + row.payment_title;
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_all_admin(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

    }


    function detail_payment_all_admin(dtpay) {
        var param = dtpay.split('<>');
        // console.log(param);

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
                "payment_id": param[0],
                "payment_title": param[1]
            },
            success: function (result) {
                // console.log(result);
                $("#modal_detail_payment_all_admin").modal('show');
                var res = result[0];
                $('#tabel_sub_payment_super').dataTable().fnClearTable();
                $('#tabel_sub_payment_super').dataTable().fnDestroy();

                $("#detail_judul").html(res.payment_title);
                $("#detail_deskripsi").html(res.description);
                if (res.price_monthly != null) {
                    $("#detail_pricebulan").html("Rp " + rupiah(res.price_monthly));
                    $("#detail_pricetahun").html("Rp " + rupiah(res.price_annual));
                    $("#detail_minbulan").html(res.minimum_monthly_subscription);
                    $("#detail_mintahun").html(res.minimum_annual_subscription);
                    $(".hideku").fadeIn("fast");
                } else {
                    $(".hideku").fadeOut("fast");
                }

                if (res.comm_payment_methods != "") {
                    var jsnDt = res.comm_payment_methods;
                    $('#tabel_sub_payment_super').dataTable({
                        responsive: true,
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
                                    return '<img src="' + dtimg + '" style="width:30px; height:30px;" id="imgsubpay_' + row + '" class="rounded-circle img-fluid" onclick="clickImage(this)" onerror="errorImg()">';
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
                                    }
                                    return isine;
                                }
                            },
                            // {
                            //     mData: 'payment_time_limit',
                            //     render: function (data, type, row, meta) {
                            //         var inin = '';
                            //         if (data == 0) {
                            //             inin = data;
                            //         } else if (data == 1) {
                            //             inin = '<small class="clight"> ' + data + '  Day</small>';
                            //         } else {
                            //             inin = '<small class="clight"> ' + data + '  Days</small>';
                            //         }
                            //         return inin;
                            //     }
                            // },
                            // { mData: 'payment_account' },
                            // {
                            //     mData: 'description',
                            //     render: function (data, type, row, meta) {
                            //         var uiku = '';
                            //         $.each(data, function (i, item) {
                            //             uiku += '<li>' + item + '</li>';
                            //         });
                            //         return "<div class='text-wrap width-300'><ul>" + uiku + "</ul></div>";
                            //     },
                            // },
                            {
                                mData: 'id',
                                render: function (data, type, row, meta) {
                                    var datasubpay = {
                                        "id": row.id,
                                        "payment_title": row.payment_title,
                                        "icon": row.icon,
                                        "payment_bank_name": row.payment_bank_name,
                                        "payment_owner_name": row.payment_owner_name,
                                        "payment_time_limit": row.payment_time_limit,
                                        "payment_account": row.payment_account,
                                        "status": row.status,
                                        "description": row.description,
                                    };
                                    var ini = JSON.stringify(datasubpay);
                                    localStorage.setItem("data_subpay", ini);

                                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                                        'onclick="mdl_detail_subpayment_all(\'' + data + '\')">' +
                                        '<i class="mdi mdi-eye"></i>' +
                                        '</button>';
                                }
                            }
                        ],
                    }); //end-datatable
                } else {
                        var nofound = '<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                        $('#tabel_sub_payment_super tbody').empty().append(nofound);
                }

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });

    }



    //MODAL DETAIL SUB_PAYMENT
    function mdl_detail_subpayment_all(params) {
        sessionStorage.removeItem('data_subpay');
        $("#modal_detail_payment_all_admin").modal("hide");
        $("#modal_detail_subpayment_super").modal("show");

        var dtk = localStorage.getItem("data_subpay");
        var isi = JSON.parse(dtk);
        console.log("id payment method = " + isi.id);
        get_setting_subpayment_super(isi.id);

        var statusui = '';
        if (isi.status == 0) {
            statusui = '<small class="badge bg-abu melengkung10px cwhite" style="width :100px">Deactive</small>';
        } else {
            statusui = '<small class="badge bg-biru melengkung10px cdarkgrey" style="width :100px">Active</small>';
        }
        $("#subpay_status").html(statusui);
        var imglogo;
        if (isi.icon == null) {
            imglogo = "/img/noimg.jpg";
        } else {
            var icn = isi.icon;
            var cekimg = icn.slice(0, 1);

            if (cekimg == "/") {
                var isiimg = icn.slice(1);
            } else {
                var isiimg = isi.icon;
            }
            imglogo = server_cdn + isiimg;
        }



        $('#img_subpay').attr('src', imglogo);
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

    }




    function get_setting_subpayment_super(idnya) {
        $(".set_id_paymethod").val(idnya);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/get_setting_subpayment_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "payment_method_id": idnya,
            },
            success: function (result) {
                console.log(result);
                var uiku = '';
                $.each(result, function (i, item) {
                    if (item.setting_type == 1) {
                        var tipe = 'Input Text';
                    } else {
                        var tipe = 'Radio Button';
                    }
                    uiku += '<div class="row" style="margin-bottom:0.5em;">' +
                        '<div class="col-9"><div class="form-group">' +
                        '<h6 class="cgrey1 tebal name_setting">' + item.title +
                        '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                        '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                        '</p>' +
                        '</div>' +
                        '</div >' +
                        '<div class="col-3">' +
                        '<input type="text" value="' + item.value + '"' +
                        'class="form-control input-abu param_setting" disabled>' +
                        '</div></div></div>';
                });
                $(".isi_setting_subpay").html(uiku);
            },
            error: function (result) {
                if (result == '404') {
                    console.log('data not found');
                }
            }
        });
    }



</script>

@endsection
