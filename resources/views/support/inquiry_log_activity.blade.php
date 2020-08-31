@extends('layout.support-master')
@section('title', 'Inquiry Log')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inquiry Log Activity</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your information for Inquiry<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <!-- <button type="button" class="btn btn-tosca btn-sm">
                Broadcast Message</button> -->
        </nav>
    </div>
</div>

<br>
<div id="page_support_inquirylog"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                    data-target="#modal_generate_log_activity">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_inquiry_log_activity" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> Endpoint </b></th>
                            <th><b> Activity </b></th>
                            <th><b> Username</b></th>
                            <th><b> User Level </b></th>
                            <th><b> Date </b></th>
                            <th><b> Log Status </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE INQUIRY LOG ACTIViTY -->
<div class="modal fade" id="modal_generate_log_activity" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Generate Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
            </div>

            <form>
                <div class="modal-body body250">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                    class="form-control input-abu" required>
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                    class="form-control input-abu" required>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row" style="margin-top: 0.5em;">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Community Status</small>
                                <select class="form-control input-abu" name="status_komunitas" id="status_komunitas"
                                    required>
                                    <option selected disabled> Choose </option>
                                    <option value="all" selected> All </option>
                                    <option value="0"> Newly </option>
                                    <option value="1"> First Login </option>
                                    <option value="2"> Active </option>
                                    <option value="3"> Published </option>
                                    <option value="4"> Deactive </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" id="hide_status_kom" style="display: nones;">
                                <small class="clight s13">Community List</small>
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas"
                                    required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="list_feature" id="list_feature" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subfitur">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="list_subfeature" id="list_subfeature"
                                    required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_endpoint">
                                <small class="clight s13">Endpoint List</small>
                                <select class="form-control input-abu" name="list_endpoint" id="list_endpoint" required>
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_aktivitastipe">
                                <small class="clight s13">Activity Type</small>
                                <select class="form-control input-abu" name="activity_type" id="activity_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Community </option>
                                    <option value="2"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                    </div>


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subscriber">
                                <small class="clight s13">Subscriber List</small>
                                <select class="form-control input-abu" name="list_subscriber" id="list_subscriber">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">

                        </div> <!-- end-col-md -->
                    </div>


                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em; margin-top: 0.5em;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="btn_generate_log_activity" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



<!-- MODAL DETAIL INQUIRY LOG ACTIVITY-->
<div class="modal fade" id="modal_detail_log_activity" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="mod-header pad-5persen">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
            </div>

            <div class="modal-body" style="height: auto; padding: 5%;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Title</small>
                            <p class="cgrey" id="detail_judul">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Module</small>
                            <p class="cgrey" id="detail_module">-</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Endpoint</small>
                            <p class="cgrey s12" id="detail_endpoint"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Ip Address</small>
                            <p class="cgrey" id="detail_ip"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Status Request</small>
                            <p class="cgrey" id="detail_status"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Log Status</small>
                            <p class="cgrey" id="detail_log_status"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Username</small>
                            <p class="cgrey" id="detail_username"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">User Id</small>
                            <p class="cgrey s12" id="detail_userid"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">User Level</small>
                            <p class="cgrey" id="detail_level"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Elapsed Time</small>
                            <p class="cgrey" id="detail_elapsed"></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight s13">Created Date</small>
                            <p class="cgrey s13" id="detail_date"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <small class="clight">Time</small>
                            <p class="cgrey" id="detail_time"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <small class="clight s13">Request</small>
                            <p class="cgrey s11" id="detail_request"></p>
                        </div>
                    </div>
                </div>

                <small class="clight s13">Response Log</small>
                <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 130px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 1%;">
                    <div class="cgrey s11 jjson" id="detail_response"></div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>


@endsection
