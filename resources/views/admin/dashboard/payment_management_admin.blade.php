@extends('layout.admin-dashboard')
@section('title', 'Payment Management')
@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Payment Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en">Manage your payment information<label>
    </div>
</div>
<br>

<div class="row">
    <div id="page_payment_management_admin"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                <div class="tabbable-line payment">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab" lang="en" data-lang-token="All">All</a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab" lang="en" data-lang-token="Active">Active</a>
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
                                        <th><b lang="en">ID Payment</b></th>
                                        <th><b lang="en">Payment Title</b></th>
                                        <th><b lang="en">Description</b></th>
                                        <th><b lang="en">Action</b></th>
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
                                        <th><b lang="en">ID Payment</b></th>
                                        <th><b lang="en">Payment Title</b></th>
                                        <th><b lang="en">Description</b></th>
                                        <th><b lang="en">Action</b></th>
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

            <div class="modal-body" style="padding:25px; min-height: 570px; height: auto; padding: 5px 25px 0px 25px;">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="cdarkgrey s20" lang="en">Detail Payment</h4>

                        <div id="infor_pay_admin" style="margin-top: 7%;">
                            <center>
                                <img src="/img/default.png" class="rounded-circle img-fluid" id="img_detail_payment_super"
                                    onerror="this.onerror=null;this.src='/img/default.png';">
                                <br>
                                <small class="cblue" lang="en">Payment Name</small>
                                <h6 class="cgrey tebal" id="detail_judul">-</h6>
                            </center>

                            <div class="div-info-payment">
                                <div class="form-group">
                                    <small class="cblue" lang="en">Payment Type</small>
                                    <p class="cgrey2" id="detail_tipe_pay"> Not Set </p>
                                </div>
                                <div class="form-group">
                                    <small class="cblue" lang="en">Description</small>
                                    <div style="overflow-y: scroll; height: 60px;">
                                        <p class="cgrey2 s14" id="detail_deskripsi">-</p>
                                    </div>
                                </div>
                                <div class="row hideku" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue" lang="en">Price Montly</small>
                                            <p class="cgrey2" id="detail_pricebulan">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue" lang="en">Price Annual</small>
                                            <p class="cgrey2" id="detail_pricetahun">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row hideku" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue" lang="en">Minimum Montly</small><br>
                                            <span class="cgrey2" id="detail_minbulan"> 0 </span>
                                            <small class="clight"> &nbsp; / Month</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <small class="cblue" lang="en">Minimum Annual</small><br>
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
                                <h4 class="cdarkgrey s20" lang="en">Sub Payment</h4>
                            </div>
                            <div class="col-md-6 col-sm-12" style="text-align: right; display: none;"
                                id="hide_btn_aktivasi">
                                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                    data-target="#modal_pay_module" data-dismiss="modal" lang="en">
                                    Activation</button>
                            </div>
                        </div>
                        <br>

                        <table id="tabel_sub_payment_super"
                            class="table table-hover table-sm table-striped dt-responsive" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="cgrey2"><b lang="en">ID</b></th>
                                    <th class="cgrey2"><b lang="en">Title</b></th>
                                    <th class="cgrey2"><b lang="en">Icon</b></th>
                                    <th class="cgrey2"><b lang="en">Bank Name</b></th>
                                    <th class="cgrey2"><b lang="en">Owner Bank</b></th>
                                    <th class="cgrey2"><b lang="en">Status</b></th>
                                    <!-- <th class="cgrey2"><b> Time Limit </b></th>
                                    <th class="cgrey2"><b> Account </b></th>
                                    <th class="cgrey2"><b> Description </b></th> -->
                                    <th class="cgrey2"><b lang="en">Action</b></th>
                                </tr>
                            </thead>
                        </table>
                        <div id="notabel" style="display: none">
                            <center>
                                <br><br><br><br>
                                <h1 class="clight" lang="en">Data Not Found</h1>
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
                <h4 class="modal-title cgrey" lang="en">Detail Sub-Payment</h4>
                <div id="subpay_status" style="text-align: right; margin-top: -1.5em; margin-bottom: 1.5em;"></div>


                <div class="tabbable-line" style="margin-top: -0.5em;">
                    <ul class="nav nav-tabs detailsubpay">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1_subpay" data-toggle="tab" lang="en" data-lang-token="Detail">Detail</a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2_subpay" data-toggle="tab" lang="en" data-lang-token="en">Setting Sub</a>
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
                                        <small class="clight s13" lang="en">Payment Name</small>
                                        <p id="detail_nama_pay"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13" lang="en">Payment Time Limit</small>
                                        <p id="detail_time_limit"></p>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top: -0.5em;">
                                    <div class="form-group">
                                        <small class="clight s13" lang="en">Description</small>
                                        <ul>
                                            <div id="detail_deskripsi_pay"></div>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13" lang="en">Bank Name</small>
                                        <p id="detail_bank_pay"></p>
                                    </div>
                                    <div class="form-group">
                                        <small class="clight s13" lang="en">Rekening Numbers</small>
                                        <p id="detail_rekening"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <small class="clight s13" lang="en">Owner Bank Name</small>
                                        <p id="detail_bankname"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer" style="border: none;">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                    style="border-radius: 10px;">
                                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_default_2_subpay" style="height: auto; min-height: 425px;">
                            <div id="nosetting_pay" style="display: none">
                                <center>
                                    <br><br><br><br>
                                    <h2 class="clight" lang="en">No Setting Payment</h2>
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
                                        <i class="mdi mdi-close"></i><span>Cancel</span>
                                    </button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_setpay"
                                        style="display: none;">
                                        <i class="mdi mdi-check btn-icon-prepend">
                                        </i><span lang="en">Submit</span></button>
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
                                aria-multiselectable="true" style="overflow-y: auto; overflow-x: hidden; height:230px; padding-right: 12px;">

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
