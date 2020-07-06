@extends('layout.superadmin')

@section('title', 'Subscriber Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Subscriber Management</h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Subscriber Management</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">Registrasion Data</li> -->
        </ol>
    </nav>
</div>

<div class="row">
    <div id="page_subscriber_management"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                All
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                Pending
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                        data-target="#modal_generate_komunitas" data-dismiss="modal">Generate</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable"
                                        onclick="reset_subs_all()">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>


                            <!-- tabel all susbcriber -->
                            <div id="tabel_show_subs_hide" style="display: none;">
                                <table id="tabel_show_subs" class="table table-hover table-striped dt-responsive nowrap"
                                    style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th><b>ID Subscriber</b></th>
                                            <th><b>Subscriber Name</b></th>
                                            <th><b>Membership</b></th>
                                            <th><b>Join Date</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                        data-target="#modal_generate_pending" data-dismiss="modal">Generate</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <!-- <button type="button" class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable" onclick="reset_subs_all()">
                                        <i class="mdi mdi-refresh"></i>
                                    </button> -->
                                </div>
                            </div>
                            <!-- tabel all susbcriber -->
                            <div id="tabel_subs_pending_hide" style="display: none;">
                                <table id="tabel_subs_pending"
                                    class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><b>ID Subscriber</b></th>
                                            <th><b>Membership</b></th>
                                            <th><b>Subcriber Name</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Created Date</b></th>
                                            <th><b>Action</b></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- end tabel all  -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- MODAL GENERATE  FILTER SUBSCRIBER -->
<div class="modal fade" id="modal_generate_komunitas" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Subcriber Management</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row" style="margin-top: 2em; margin-bottom: 1em;">
                        <div class="col-md-4">
                            <center>
                                <label class="cgrey2" style="margin-top: 1em;">
                                    Community
                                </label>
                            </center>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control input-abu" name="komunitas_list" id="komunitas_list">
                                    <option selected disabled> Choose </option>
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
                    <!-- &nbsp;
                    <button type="button" id="btn_filter_transaksi" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button> -->
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL GENERATE  FILTER SUBSCRIBER -->
<div class="modal fade" id="modal_generate_pending" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Subcriber Management</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row" style="margin-top: 2em; margin-bottom: 1em;">
                        <div class="col-md-4">
                            <center>
                                <label class="cgrey2" style="margin-top: 1em;">
                                    Community
                                </label>
                            </center>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control input-abu" name="komunitas_list2" id="komunitas_list2">
                                    <option selected disabled> Choose </option>
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
                    <!-- &nbsp;
                    <button type="button" id="btn_filter_transaksi" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button> -->
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DETAIL SUBS ACTIVE -->
<div class="modal fade" id="modal_detail_subs_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="border: none; padding-bottom: 0px;
                padding-left: 5%; padding-right: 5%;">
                    <h4 class="modal-title cdarkgrey">Detail Subcriber Active</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="height: auto; padding-left: 5%; padding-right: 5%;">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Full Name</small>
                                <p class="cgrey" id="detail_fullname"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User ID</small>
                                <p class="cgrey" id="detail_userid"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Status Subcriber</small>
                                <p class="cgrey" id="detail_status"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Created Date</small>
                                <p class="cgrey" id="detail_date"></p>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 200px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 5%;" id="div_membrship">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13"> Membership Type</small>
                                    <p class="cgrey" id="detail_membership"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing</small>
                                    <p class="cgrey" id="detail_pricing"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">Description</small>
                                    <p class="cgrey" id="detail_deskripsi"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DETAIL SUBS PENDING -->
<div class="modal fade" id="modal_detail_subs_pending" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <form>
                <div class="modal-header" style="border: none; padding-bottom: 0px;
                padding-left: 5%; padding-right: 5%;">
                    <h4 class="modal-title cdarkgrey">Detail Pending Subcriber</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="height: auto; padding-left: 5%; padding-right: 5%;">
                    <br>

                    <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 200px;
                    border-radius: 10px; width: 100%; margin-top: 0.5em;
                    padding: 8%;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">Full Name</small>
                                    <p class="cgrey" id="detail_fullname2"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">User ID</small>
                                    <p class="cgrey" id="detail_userid2"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">Status Subcriber</small>
                                    <p class="cgrey" id="detail_status2"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">Created Date</small>
                                    <p class="cgrey" id="detail_date2"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <small class="clight s13">Membership</small>
                                    <p class="cgrey"> Tidak Ada</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
