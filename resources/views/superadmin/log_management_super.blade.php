@extends('layout.superadmin')

@section('title', 'Log Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-playlist-check"></i>
        </span>Log Management</h3>


</div>


<div class="row">
    <div id="page_log_management_super"></div>
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                Log Activity
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-tosca btn-sm" style="margin-top: -1em; margin-bottom: 2em;"
                    data-toggle="modal" data-target="#modal_generate_log">
                    Generate Log</button>

                <table id="tabel_log_magement_super" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%; display: none;">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>User Level</th>
                            <th>Module</th>
                            <th>Activity</th>
                            <th>Endpoint</th>
                            <th>Date Log</th>
                            <th>Code</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL FILTER TRANSAKSI-->
<div class="modal fade" id="modal_generate_log" data-backdrop="static" tabindex="-1" role="dialog"
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
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Query Type</small>
                                <select class="form-control input-abu" name="list_userlevel" id="list_userlevel">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Commjuction </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community Activity</small>
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas">
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
                    &nbsp;
                    <button type="button" id="btn_filter_log_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

@endsection
