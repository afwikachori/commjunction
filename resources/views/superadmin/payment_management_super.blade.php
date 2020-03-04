@extends('layout.superadmin')

@section('title', 'Payment Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-credit-card"></i>
        </span> Payment Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
            data-target="#modal_add_new_payment_super">
            Add Payment</button>
    </nav>
</div>

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
                        <!-- <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                Active
                            </a>
                        </li> -->

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
                            <table id="tabel_payment_all_super"
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

                        <!-- <div class="tab-pane" id="tab_default_2">
                            <table id="tabel_payment_active_super"
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
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL ADD PAYMENT SUPER -->
<div class="modal fade" id="modal_add_new_payment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                <h4 class="modal-title cgrey">Add Payment</h4>
            </div> <!-- end-header -->
            <form method="POST" id="form_add_payment_super" action="{{route('add_payment_management_super')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Payment Name</small>
                                <input type="text" id="nama_pay" name="nama_pay" class="form-control input-abu">
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group"  style="display: none;">
                                <small class="clight s13">Payment Type</small>
                                <select class="form-control input-abu" name="tipe_pay" id="tipe_pay">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="cdarkgrey s13 tebal" style="margin-bottom: 0.5em;">Payment Information</h6>
                            <div class="form-group">
                                <small class="clight s13">Payment Description</small>
                                <textarea type="text" id="deskripsi_pay" name="deskripsi_pay"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Montly</small>
                                <input type="text" id="harga_bulanan_pay" name="harga_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Annual</small>
                                <input type="text" id="harga_tahunan_pay" name="harga_tahunan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Montly</small>
                                <input type="text" id="min_bulanan_pay" name="min_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Annual</small>
                                <input type="text" id="min_tahunan_pay" name="min_tahunan_pay"
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
                    <button type="submit" id="btn_add_payment_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Add </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL EDIT PAYMENT SUPER -->
<div class="modal fade" id="modal_edit_payment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                <h4 class="modal-title cgrey">Edit Payment</h4>
            </div> <!-- end-header -->
            <form method="POST" id="form_edit_payment_super" action="{{route('edit_payment_management_super')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <input type="hidden" id="edit_idpay" name="edit_idpay">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Payment Name</small>
                                <input type="text" id="edit_nama_pay" name="edit_nama_pay"
                                    class="form-control input-abu">
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;">
                                <small class="clight s13">Payment Type</small>
                                <select class="form-control input-abu" name="edit_tipe_pay" id="edit_tipe_pay">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="cdarkgrey s13 tebal" style="margin-bottom: 0.5em;">Payment Information</h6>
                            <div class="form-group">
                                <small class="clight s13">Payment Description</small>
                                <textarea type="text" id="edit_deskripsi_pay" name="edit_deskripsi_pay"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Montly</small>
                                <input type="text" id="edit_harga_bulanan_pay" name="edit_harga_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Annual</small>
                                <input type="text" id="edit_harga_tahunan_pay" name="edit_harga_tahunan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Montly</small>
                                <input type="text" id="edit_min_bulanan_pay" name="edit_min_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Annual</small>
                                <input type="text" id="edit_min_tahunan_pay" name="edit_min_tahunan_pay"
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
                    <button type="submit" id="btn_edit_payment_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Edit </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL PAYMENT-->
<div class="modal fade" id="modal_detail_payment_all_super" data-backdrop="static" tabindex="-1" role="dialog"
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

                        <div class="tabbable-line sub_pay_super">
                            <ul class="nav nav-tabs sub_pay_super">
                                <li class="tab-subs active" id="tab_all">
                                    <a href="#tab_default_1a" data-toggle="tab">
                                        <small class="s13 cgrey2">Info</small>
                                    </a>
                                </li>
                                <li class="tab-subs" id="tab_pending">
                                    <a href="#tab_default_2a" data-toggle="tab">
                                        <small class="s13 cgrey2">Setting</small>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1a">
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
                                        <div class="row">
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
                                        <div class="row">
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


                                <div class="tab-pane" id="tab_default_2a">
                                <br>
                                <small class="cgrey">Click to edit</small>
                                <br>
                                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modal_edit_payment_super" data-dismiss="modal" style="margin-top: 0.5em;">
                                    Edit Payment</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-8" style="padding-left: 25px;">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h4 class="cdarkgrey s20">Sub Payment</h4>
                            </div>
                            <div class="col-md-6 col-sm-12" style="text-align: right;">
                                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                    data-target="">
                                    Add SubPayment</button>
                            </div>
                        </div>
                        <br>
                        <table id="tabel_sub_payment_super"
                            class="table table-hover table-sm table-striped dt-responsive wrap" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="cgrey2"><b> ID </b></th>
                                    <th class="cgrey2"><b> Title </b></th>
                                    <th class="cgrey2"><b> Bank Name </b></th>
                                    <th class="cgrey2"><b> Owner Bank </b></th>
                                    <th class="cgrey2"><b> Status </b></th>
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


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        tabel_payment_all_super();
        tabel_payment_active_super();
    });  //end


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_payment_all_super',
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




    function tabel_payment_all_super() {
        var tabel = $('#tabel_payment_all_super').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_payment_all_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_all_super tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_all_super tbody').empty().append(nofound);

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
                            'onclick="detail_payment_all_super(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

    }


    function detail_payment_all_super(dtpay) {
        var param = dtpay.split('<>');
        $("#modal_detail_payment_all_super").modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/detail_payment_all_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "payment_id": param[0],
                "payment_title": param[1]
            },
            success: function (result) {
                // console.log(result[0]);
                var res = result[0];
                $('#tabel_sub_payment_super').dataTable().fnClearTable();
                $('#tabel_sub_payment_super').dataTable().fnDestroy();

                $("#detail_judul").html(res.payment_title);
                $("#detail_deskripsi").html(res.description);
                $("#detail_pricebulan").html("Rp " + rupiah(res.price_monthly));
                $("#detail_pricetahun").html("Rp " + rupiah(res.price_annual));
                $("#detail_minbulan").html(res.minimum_monthly_subscription);
                $("#detail_mintahun").html(res.minimum_annual_subscription);

                $("#edit_idpay").val(param[0]);
                $("#edit_nama_pay").val(res.payment_title);
                $("#edit_deskripsi_pay").text(res.description);
                $("#edit_harga_bulanan_pay").val(res.price_monthly);
                $("#edit_harga_tahunan_pay").val(res.price_annual);
                $("#edit_min_bulanan_pay").val(res.minimum_monthly_subscription);
                $("#edit_min_tahunan_pay").val(res.minimum_annual_subscription);



                get_setting_subpayment_super(param[0]);

                var jsnDt = res.payment_methods;

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
                        { mData: 'payment_bank_name' },
                        { mData: 'payment_owner_name' },
                        { mData: 'status' },
                        {
                            mData: 'id',
                            render: function (data, type, row, meta) {
                                return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                                    'onclick="detail_subpayment_all(\'' + data + '\')">' +
                                    '<i class="mdi mdi-eye"></i>' +
                                    '</button>';
                            }
                        }
                    ],
                }); //end-datatable


            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });

    }



    function get_setting_subpayment_super(idnya) {
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
                "payment_id": idnya,
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


    function tabel_payment_active_super() {
        var tabel = $('#tabel_payment_active_super').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_payment_active_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_active_super tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_active_super tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                { mData: 'description' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_active_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }


    function detail_payment_active_super(idpay) {
        alert(idpay);

    }


</script>

@endsection
