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
    <div id="page_report_management"></div>
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

