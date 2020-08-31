@extends('layout.support-master')
@section('title', 'Inquiry Specific')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Inquiry Specific Community</h3>
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
<div id="page_support_inquiry_spesific"></div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-header putih">
                <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                    data-target="#modal_generate_spesific_com">
                    Generate Log</button>
            </div>

            <div class="card-body">

                <table id="tabel_inquiry_spesific_com" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th><b> Endpoint </b></th>
                            <th><b> Activity </b></th>
                            <th><b> IP Address </b></th>
                            <th><b> Date </b></th>
                            <th><b> Time </b></th>
                            <th><b> User Level </b></th>
                            <th><b> Action </b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- endrow -->


<!-- MODAL GENERATE INQUIRY LOG ACTIViTY -->
<div class="modal fade" id="modal_generate_spesific_com" data-backdrop="static" tabindex="-1" role="dialog"
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
                            <div class="form-group" style="display: none;" id="hide_aktivitastipe">
                                <small class="clight s13">Activity Type</small>
                                <select class="form-control input-abu" name="activity_type" id="activity_type" required>
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Community </option>
                                    <option value="2"> Subscriber </option>
                                </select>
                            </div>
                        </div> <!-- end-col-md -->
                        <div class="col-md">
                            <div class="form-group" style="display: none;" id="hide_subscriber">
                                <small class="clight s13">Subscriber List</small>
                                <select class="form-control input-abu" name="list_subscriber" id="list_subscriber">
                                    <option selected disabled> Loading ... </option>
                                </select>
                            </div>
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
                    <button type="button" id="btn_generate_specific" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Generate </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>



<!-- MODAL DETAIL INQUIRY LOG ACTIVITY-->
<div class="modal fade" id="modal_detail_spesific_inquiry" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 700px;">
        <div class="modal-content" style="background-color: #ffffff;">
            <div style="padding: 4%; padding-bottom: 0% !important;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
            </div>

            <div class="modal-body detaillog" style="height: auto; padding-left: 4% !important;
            padding-right: 4% !important; padding-top:2%;">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Activity</small>
                            <p class="cgrey s13" id="activity"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s12">Endpoint</small>
                            <p class="cgrey s13" id="endpoint"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Module</small>
                            <p class="cgrey s13" id="module"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Module Endpoint Id</small>
                            <p class="cgrey s13" id="module_endpoint_id"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Feature Id</small>
                            <p class="cgrey s13" id="feature_id"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Subfeature Id</small>
                            <p class="cgrey s12" id="subfeature_id"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Username</small>
                            <p class="cgrey s13" id="user_name"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">User Id</small>
                            <p class="cgrey s13" id="user_id"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Userlevel</small>
                            <p class="cgrey s13" id="user_level"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">Date</small>
                            <p class="cgrey s13" id="date"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Time</small>
                            <p class="cgrey s13" id="time"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Elapsed Time</small>
                            <p class="cgrey s13" id="elapsed_time"></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <small class="clight s13">IP Address</small>
                            <p class="cgrey s13" id="ip"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight s13">Request</small>
                            <p class="cgrey s13" id="request"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <small class="clight s13">Status Request</small>
                            <p class="cgrey s13" id="status"></p>
                        </div>
                    </div>
                </div>

                <small class="clight s13">Response</small>
                <div style="background-color: #f7f7f7; width: 50px; height: auto; min-height: 125px;
                             border-radius: 10px; width: 100%; margin-top: 0.5em;
                            padding: 1%;">
                    <div class="cgrey s11 jjson" id="detail_response"></div>
                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none; margin-bottom: 0.5em;
                   padding-left: 5%; padding-right: 5%;">
                <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
