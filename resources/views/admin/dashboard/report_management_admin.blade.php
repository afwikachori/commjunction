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
    <div id="page_report_management_admin"></div>
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
