@extends('layout.subscriber')
@section('title', 'Transaction Management')
@section('content')

<div id="div_ignore">
    <div class="row">
        <div class="col-md-2">
            <h3 class="page-title" lang="en">Transaction Management</h3>
        </div>
        <div class="col-md-6">
            <label class="cgrey" lang="en">Manage your transaction<label>
        </div>
    </div>
    <br>


    <div class="row">
        <div id="page_transaction_management_subs"></div>
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
                                            style="color:#0e6f73;" lang="en"
                                            data-lang-token="Select filter options">Select filter options &nbsp;
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
                                                    <small class="clight" lang="en">Community Name</small>
                                                    <h5 class="nama_komunitas cgrey2" style="margin-top: 0.5em;"></h5>
                                                    <input type="hidden" class="form-control input-abu" name="komunitas"
                                                        id="komunitas">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <small class="clight" lang="en">Start Date</small>
                                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                                        class="form-control input-abu">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <small class="clight" lang="en">End Date</small>
                                                    <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                                        class="form-control input-abu">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <small class="clight" lang="en">Transaction Type</small>
                                                    <select class="form-control input-abu" name="tipe_trans"
                                                        id="tipe_trans">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <small class="clight" lang="en">Transaction Status</small>
                                                    <select class="form-control input-abu" name="status_trans"
                                                        id="status_trans">
                                                        <option value="null" lang="en">Choose</option>
                                                        <option value="1" lang="en">Pending</option>
                                                        <option value="2" lang="en">Approval</option>
                                                        <option value="3" lang="en">Cancel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <!-- <small class="clight" lang="en">Subscriber</small> -->
                                                    <input type="hidden" id="id_user_subs_trans"
                                                        name="id_user_subs_trans">
                                                    <!-- <select class="form-control input-abu" name="subs_name"
                                                        id="subs_name">

                                                    </select> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div style="text-align: right !important;">
                                            <button type="button" id="btn_showtable_transaksi"
                                                class="btn btn-accent btn-sm melengkung10px" style="margin-top: 2%;">
                                                <i class="mdi mdi-check btn-icon-prepend">
                                                </i> <span lang="en">Show</span>
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
                                <button type="button" id="btn_filter_trans" class="btn btn-accent btn-sm melengkung10px"
                                    style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                    data-target="#modal_trasaksi_filter" data-dismiss="modal"><span
                                        lang="en">Filter</span></button>
                            </div>
                            <div class="col-md-4" style="text-align: right;">
                                <button type="button" id="reset_card_filtertrans"
                                    class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div id="show_card_transaksi" class="card-deck" style="margin-top: 2em; width: 100%;">

                            </div>
                        </div><!-- endrow -->

                        <!-- tabel -->
                        <table id="tabel_trans" class="table table-hover table-striped dt-responsive nowrap"
                            style="width:100%; display: none;">
                            <thead>
                                <tr>
                                    <th><b lang="en">Invoice</b></th>
                                    <th><b lang="en">Transaction Date</b></th>
                                    <th><b lang="en">Subcriber Name</b></th>
                                    <th><b lang="en">Transaction Type</b></th>
                                    <th><b lang="en">Status</b></th>
                                    <th><b lang="en">Action</b></th>
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
                            <h4 class="tebal cgrey2" lang="en">Detail Transaction</h4>

                            <h5 class="cblue" style="margin-bottom: 1em;" id="invoice_trans">-</h5>

                            <small class="clight" lang="en">Transaction Date</small>
                            <p class="cgrey2" id="date_trans">-</p>

                            <div class="row">
                                <div class="col-md-2" style="padding-right: 1px;">
                                    <img src="/img/cam.png" class="rounded-circle img-fluid" style="width: 40px;">
                                </div>
                                <div class="col-md-4" style="padding: 0px;">
                                    <small class="clight" lang="en">Community Name</small>
                                    <p class="cgrey2" id="komunitas_trans">-</p>
                                </div>
                                <div class="col-md-2"
                                    style="padding-right: 10px; padding-left: 0px; text-align: right;">
                                    <img src="/img/def-profil.png" class="rounded-circle img-fluid"
                                        style="width: 40px;">
                                </div>
                                <div class="col-md-4" style="padding: 0px;">
                                    <small class="clight" lang="en">Subcriber Name</small>
                                    <p class="cgrey2" id="subscriber_trans">-</p>
                                </div>
                            </div>

                            <br><br>

                            <div class="row">
                                <div class="col-md-6">
                                    <small class="clight" lang="en">Level Title</small>
                                    <p class="cgrey2" id="level_title_trans">-</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="clight" lang="en">Status</small>
                                    <p class="cgrey2" id="statusjudul_trans">-</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <small class="clight" lang="en">Transaction Type</small>
                                    <p class="cgrey2" id="jenis_trans">-</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="clight" lang="en">Transaction</small>
                                    <p class="cgrey2" id="transaksi_trans">-</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="clight" lang="en">Total Nominal</small>
                                    <p class="cgrey2" id="nominal_trans">-</p>
                                </div>
                            </div>


                            <div class="footer_mdl" style="text-align: right; margin-top: 22%;">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                    style="border-radius: 10px;">
                                    <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                                </button>
                                &nbsp;
                                <button type="button" class="btn btn-accent btn-sm" id="btn_download_detail"
                                    style="display: none;">
                                    <i class="mdi mdi-check btn-icon-prepend"></i><span
                                        lang="en">Download</span></button>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12" style="height: 100%;">
                            <div style="text-align: right;">
                                <small class="clight" style="margin-top: 0.5em;" lang="en">Payment Status</small>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <div id="status_color"></div>
                            </div>

                            <br>
                            <h5 class="cgrey tebal" lang="en">Payment Confirmation</h5>
                            <div class="row" style="padding: 0 5% 0 5%;">
                                <img src="/img/noimg2.jpg" id="img_pay_confirm" onclick="clickImage(this)"
                                    style="height: 115px; width: 100%; border-radius: 10px;" data-toggle="tooltip"
                                    data-placement="right" title="Double Click to Preview Image"
                                    onerror="this.onerror=null;this.src='/img/noimg2.jpg';">
                            </div>
                            <div class="row" style="margin-top: 0.5em;">
                                <div class="col-md-4">
                                    <small class="clight" lang="en">Account Name</small><br>
                                    <small class="cgrey2" id="nama_confirm_trans">-</small>
                                </div>
                                <div class="col-md-4">
                                    <small class="clight" lang="en">Bank Name</small><br>
                                    <small class="cgrey2" id="bank_confirm_trans">-</small>
                                </div>
                                <div class="col-md-4">
                                    <small class="clight" lang="en">Date Confirmation</small><br>
                                    <small class="cgrey2" id="date_confirm_trans">-</small>
                                </div>
                            </div>

                            <br>

                            <h5 class="cgrey tebal" lang="en">Payment Verification</h5>
                            <div class="row" style="padding: 0 5% 0 5%;">
                                <img src="/img/noimg2.jpg" id="img_pay_aprov" onclick="clickImage(this)"
                                    style="height: 115px; width: 100%; border-radius: 10px;" data-toggle="tooltip"
                                    data-placement="right" title="Double Click to Preview Image"
                                    onerror="this.onerror=null;this.src='/img/noimg2.jpg';">
                            </div>
                            <div class="row" style="margin-top: 0.5em;">
                                <div class="col-md-4">
                                    <small class="clight" lang="en">Approver Name</small><br>
                                    <small class="cgrey2" id="name_approv_trans">-</small>
                                </div>
                                <div class="col-md-8">
                                    <small class="clight" lang="en">Approved Date</small><br>
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
                    <h4 class="modal-title cgrey" lang="en">Filter Transaction</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="clight s13" lang="en">Transaction Type</small>
                                <select class="form-control input-abu" name="tipe_trans2" id="tipe_trans2">
                                </select>
                            </div>

                        </div> <!-- end-col-md -->


                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13" lang="en">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="clight s13" lang="en">Transaction Status</small>
                                <select class="form-control input-abu" name="status_trans2" id="status_trans2">
                                    <option value="null" lang="en">Choose</option>
                                    <option value="1" lang="en">Pending</option>
                                    <option value="2" lang="en"> Approval </option>
                                    <option value="3" lang="en"> Cancel </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="cgrey2" style="margin-top: 1.5em;" lang="en">Community</label>
                            <h5 class="nama_komunitas cteal" style="margin-top: 0.5em;"></h5>
                            <input type="hidden" class="form-control input-abu" name="komunitas2" id="komunitas2">
                        </div>
                    </div>
                    <input type="hidden" id="subs_id_trans" name="subs_id_trans">

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_filter_transaksi" class="btn btn-accent btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Filter</span></button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



@endsection
