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
            data-target="#modal_add_new_payment_super" data-dismiss="modal">
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
                            <div class="form-group" style="display: none;">
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
                                    <form method="POST" id="form_edit_payment_super"
                                        action="{{route('edit_payment_management_super')}}">
                                        {{ csrf_field() }}
                                        <div>
                                            <h5 class="cteal">Edit Payment</h5>

                                            <input type="hidden" id="edit_idpay" name="edit_idpay">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <small class="clight s13">Payment Name</small>
                                                        <input type="text" id="edit_nama_pay" name="edit_nama_pay"
                                                            class="form-control input-abu">
                                                    </div>

                                                </div> <!-- end-col-md -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <small class="clight s13">Payment Description</small>
                                                        <textarea type="text" id="edit_deskripsi_pay"
                                                            name="edit_deskripsi_pay" class="form-control input-abu"
                                                            rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <small class="clight s13">Price Montly</small>
                                                        <input type="text" id="edit_harga_bulanan_pay"
                                                            name="edit_harga_bulanan_pay"
                                                            class="form-control input-abu">
                                                    </div>
                                                </div> <!-- end-col-md -->

                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <small class="clight s13">Price Annual</small>
                                                        <input type="text" id="edit_harga_tahunan_pay"
                                                            name="edit_harga_tahunan_pay"
                                                            class="form-control input-abu">
                                                    </div>
                                                </div> <!-- end-col-md -->
                                            </div>


                                            <div class="row">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <small class="clight s13">Minimum Montly</small>
                                                        <input type="text" id="edit_min_bulanan_pay"
                                                            name="edit_min_bulanan_pay" class="form-control input-abu">
                                                    </div>
                                                </div> <!-- end-col-md -->

                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <small class="clight s13">Minimum Annual</small>
                                                        <input type="text" id="edit_min_tahunan_pay"
                                                            name="edit_min_tahunan_pay" class="form-control input-abu">
                                                    </div>
                                                </div> <!-- end-col-md -->
                                            </div>

                                        </div> <!-- end-body -->

                                        <div class="footer-button" style="text-align: right; margin-top: 10%;">
                                            <button type="submit" id="btn_edit_payment_super"
                                                class="btn btn-teal btn-sm">
                                                <i class="mdi mdi-check btn-icon-prepend">
                                                </i> Edit </button>
                                        </div>
                                    </form>

                                    <!-- <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                        data-target="#modal_edit_payment_super" data-dismiss="modal"
                                        style="margin-top: 0.5em;">
                                        Edit Payment</button> -->
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
                                    data-target="#modal_add_subpayment_super" data-dismiss="modal">
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
                                    <th class="cgrey2"><b> Icon </b></th>
                                    <th class="cgrey2"><b> Bank Name </b></th>
                                    <th class="cgrey2"><b> Owner Bank </b></th>
                                    <th class="cgrey2"><b> Status </b></th>
                                    <th class="cgrey2"><b> Time Limit </b></th>
                                    <th class="cgrey2"><b> Account </b></th>
                                    <th class="cgrey2"><b> Description </b></th>
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


<!-- MODAL ADD SUB-PAYMENT MANAGEMENT-->
<div class="modal fade" id="modal_add_subpayment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div id="tampil_detail_pricing">
                <form method="POST" id="form_add_pricing" action="{{route('add_subpayment_super')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                        <h4 class="modal-title cgrey">Add Sub-Payment</h4>
                        <div class="pricing_status" style="text-align: right;"></div>

                    </div> <!-- end-header -->

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="img-upload-profil" style="margin-top: -1.5em; margin-bottom: 5em;">
                                    <div class="circle">
                                        <img id="view_img_subpay" class="profile-pic rounded-circle img-fluid"
                                            src="/img/focus.png">
                                    </div>
                                    <div class="p-image">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i id="browse_img_subpay" class="mdi mdi-camera upload-button"></i>
                                        </button>
                                        <input id="file_img_subpay" class="file-upload file-upload-default" type="file"
                                            name="fileup" accept="image/*" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" id="subid_payment" name="subid_payment">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Name</small>
                                    <input type="text" id="sub_namapay" name="sub_namapay"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Payment Time Limit</small>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" id="sub_timelimit" name="sub_timelimit"
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
                                    <textarea class="form-control input-abu" id="sub_deskripsi" name="sub_deskripsi"
                                        rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13"> Bank Name</small>
                                    <select class="form-control input-abu" name="sub_nama_bank" id="sub_nama_bank">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13"> Rekening Numbers</small>
                                    <input type="text" id="sub_rekening" name="sub_rekening"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13"> Owner Bank Name</small>
                                    <input type="text" id="sub_owner_bank" name="sub_owner_bank"
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
                        <button type="submit" id="btn_add_pricing" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Add </button>
                    </div> <!-- end-footer     -->
                </form>
            </div>
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
                                    <div class="circle" style="position: relative; margin-bottom: 1em;">
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
                            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                                data-target="#modul_add_settings_subpay" data-dismiss="modal">
                                Add Settings</button>
                                <br>

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
        tabel_payment_all_super();
        get_list_bank_name_subpay();
        addRowDinamic();
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



    function addRowDinamic() {
        // Add row
        var row = 1;
        var id = 2;

        $(document).on("click", "#addnewrow", function () {
            var new_row = '<div class="row form-group newly" id="row' + row + '">' +
                '<div class="col-md-3" style="margin-top: 1em;">' +
                '<label class="cgrey">Choose Input</label>' +
                '</div>' +
                '<div class="col-md-7">' +
                '<input type="text" class="form-control input-abu" name="pilihan_input' + id + '">' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>';

            var row_baru = '<div class="newly"  id="row' + row + '">' +
                '<hr>' +
                '<div class="row">' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<small class="clight s13">Title</small>' +
                '<input type="text"  name="set_judul' + id + '" class="form-control input-abu">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<div class="form-group">' +
                '<small class="clight s13">Setting Type</small>' +
                '<select class="form-control input-abu" name="set_tipe' + id + '">' +
                '<option selected disabled> Choose </option>' +
                '<option value="1"> Radio Button </option>' +
                '<option value="2"> Inputan </option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-5">' +
                '<div class="form-group">' +
                '<small class="clight s13">Description</small>' +
                '<textarea type="text" name="set_deskripsi' + id + '" ' +
                'class="form-control input-abu" rows="1"></textarea>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<div class=" form-group">' +
                '<small class="clight s13">Value</small>' +
                '<input type="text"  name="set_value' + id + '" class="form-control input-abu" required>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md" style="margin-top: 0.5em;">' +
                '<small class="clight s13">Tag Html</small>' +
                '</div>' +
                '<div class="col-md-10">' +
                '<input type="text" name="set_tag_html' + id + '"' +
                'class="form-control input-abu"></input> ' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '<br></div>';

            $('#isi_newrow').append(row_baru);
            row++;
            id++;
            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-row", function () {
            //  alert("deleting row#"+row);
            if (row > 1) {
                $(this).closest('div .newly').remove();
                row--;
            }
            return false;
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

                $("#edit_idpay").val("");
                $("#edit_idpay").val(param[0]);
                $("#subid_payment").val(param[0]);
                $("#edit_nama_pay").val(res.payment_title);
                $("#edit_deskripsi_pay").text(res.description);
                $("#edit_harga_bulanan_pay").val(res.price_monthly);
                $("#edit_harga_tahunan_pay").val(res.price_annual);
                $("#edit_min_bulanan_pay").val(res.minimum_monthly_subscription);
                $("#edit_min_tahunan_pay").val(res.minimum_annual_subscription);


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
                        {
                            mData: 'payment_time_limit',
                            render: function (data, type, row, meta) {
                                var inin = '';
                                if (data == 0) {
                                    inin = data;
                                } else if (data == 1) {
                                    inin = '<small class="clight"> ' + data + '  Day</small>';
                                } else {
                                    inin = '<small class="clight"> ' + data + '  Days</small>';
                                }
                                return inin;
                            }
                        },
                        { mData: 'payment_account' },
                        {
                            mData: 'description',
                            render: function (data, type, row, meta) {
                                var uiku = '';
                                $.each(data, function (i, item) {
                                    uiku += '<li>' + item + '</li>';
                                });
                                return "<div class='text-wrap width-300'><ul>" + uiku + "</ul></div>";
                            },
                        },
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
        $("#modal_detail_payment_all_super").modal("hide");
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

        var icn = isi.icon;
        var cekimg = icn.slice(0, 1);

        if (cekimg == "/") {
            var isiimg = icn.slice(1);
        } else {
            var isiimg = isi.icon;
        }
        var imglogo = server_cdn + isiimg;

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

        //SET DATA EDIT SUB-PAYMENT
        $("#payment_method_id").val(isi.id);
        $("#edit_sub_namapay ").val(isi.payment_title);
        $("#edit_sub_timelimit ").val(isi.payment_time_limit);
        $('select[name="edit_sub_nama_bank"]').val(isi.payment_bank_name);
        $("#view_img_subpay_edit").attr('src', imglogo);
        $("#edit_sub_deskripsi ").text(isi.description);
        $("#edit_sub_nama_bank ").val(isi.payment_bank_name);
        $("#edit_sub_owner_bank ").val(isi.payment_owner_name);
        $("#edit_sub_rekening ").val(isi.payment_account);

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



    //dropdown list bank
    function get_list_bank_name_subpay() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_bank_name_subpay",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#sub_nama_bank').empty();
                $('#sub_nama_bank').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#sub_nama_bank').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
                }
                //Short Function Ascending//
                $("#sub_nama_bank").html($('#sub_nama_bank option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));
                $("#sub_nama_bank").get(0).selectedIndex = 0;
                // ______________________________________________________________________________

                $('#edit_sub_nama_bank').empty();
                $('#edit_sub_nama_bank').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#edit_sub_nama_bank').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
                }
                //Short Function Ascending//
                $("#edit_sub_nama_bank").html($('#edit_sub_nama_bank option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#edit_sub_nama_bank").get(0).selectedIndex = 0;
            }
        });
    } //endfunction

    var readURLpay = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_subpay').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file_img_subpay").on('change', function () {
        readURLpay(this);
    });
    $("#browse_img_subpay").on('click', function () {
        $("#file_img_subpay").click();
    });


    var readURLpayEdit = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_subpay_edit').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file_img_subpay_edit").on('change', function () {
        readURLpayEdit(this);
    });
    $("#browse_img_subpay_edit").on('click', function () {
        $("#file_img_subpay_edit").click();
    });


</script>

@endsection
