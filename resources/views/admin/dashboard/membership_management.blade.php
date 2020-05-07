@extends('layout.admin-dashboard')
@section('title', 'Membership Management')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Membership Management</h3>
    </div>
    <div class="col-md-5">
        <label class="cgrey" lang="en">Manage your membership type<label>
    </div>
    <div class="col-md-5" style="text-align: right;">
            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_create_membership" lang="en">Create Membership</button>
    </div>
</div>
<br>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body memberku">
                <h4 class="cgrey" style="margin-bottom: -0.5em;" lang="en">Membership List</h4>

                <div class="tabbable-line memberaku">
                    <ul class="nav nav-tabs member">
                        <li class="tab-subs member active" id="tab_all">
                            <a href="#tab_member_1" data-toggle="tab" lang="en" data-lang-token="List Membership">
                                List Membership
                            </a>
                        </li>
                        <li class="tab-subs member" id="tab_pending">
                            <a href="#tab_member_2" data-toggle="tab" lang="en" data-lang-token="Membership Request">
                                Membership Request
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_member_1">
                            <div class="row">
                                <div id="div_nomembership" style="display: none; text-align: center; margin: auto;">
                                    <center>
                                        <br><br><br><br>
                                        <h2 class="clight" lang="en">No Membership Available</h2>
                                    </center>
                                </div>
                                <div id="show_membership" class="card-deck" style="width: 100%;">

                                </div>
                            </div><!-- endrow -->
                        </div> <!-- end-tab 1  -->


                        <div class="tab-pane" id="tab_member_2">
                            <table id="tabel_req_member" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="th-center"><b lang="en">ID Subscriber</b></th>
                                        <th class="th-center"><b lang="en">Name</b></th>
                                        <th class="th-center"><b lang="en">Status</b></th>
                                        <th class="th-center"><b lang="en">Payment Method</b></th>
                                        <th class="th-center"><b lang="en">Membership Type</b></th>
                                        <th class="th-center"><b lang="en">Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                        </div> <!-- end-tab2 -->
                    </div> <!-- end-content -->
                </div> <!-- end-tab line -->
            </div>
        </div>
    </div>
</div>



<!-- MODAL ADD CREATE MEMBERSHIP-->
<div class="modal fade" id="modal_add_create_membership" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form method="POST" id="form_add_membership" action="{{route('add_create_membership_admin')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header" style="padding-bottom: 0em !important;">
                    <h4 class="modal-title cgrey" lang="en">Create Membership</h4>
                </div>

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="img-upload-profil editprofil">
                        <div class="circle editprofil">
                            <img id="view_img_membership" class="profile-pic rounded-circle img-fluid editprofil"
                                src="/img/loading.gif" onerror="this.onerror=null;this.src='/img/default.png';">
                        </div>
                        <div class="p-image editprofil">
                            <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                value="editprofil" style="width: 30px; height: 30px;">
                                <i id="browse_membership_admin" class="mdi mdi-camera upload-button editprofil"></i>
                            </button>
                            <input id="file_img_membership" class="file-upload file-upload-default editprofil"
                                type="file" name="fileup" accept="image/*" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Membership Title</small>
                                <input type="text" id="judul_member" name="judul_member" class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input_pricemember">
                                <small class="clight" lang="en">Pricing</small>
                                <input type="text" id="harga_member" name="harga_member" class="form-control input-abu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <small class="clight" lang="en">Description</small>
                            <textarea class="form-control input-abu" id="deskripsi_member" name="deskripsi_member"
                                rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small class="clight" lang="en">Features</small>
                        </div>
                        <div class="col-12">
                            <div id="isi_membership_admin">
                                <!-- isi fitur  -->
                            </div>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-top: -1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_add_membership" class="btn btn-tosca btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Create</span></button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL DETAIL REQ MEMBERSHIP-->
<div class="modal fade" id="modal_detail_req_member" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-bottom: 0em !important;">
                <h4 class="modal-title cgrey" lang="en">Detail Request Membership Type</h4>

                <label class="badge badge-secondary melengkung10px" id="status_member"
                    style="text-align: right; min" lang="en">Requested</label>
            </div> <!-- end-header -->

            <div class="modal-body detail_member">
                <div class="row">
                    <div class="col-6" style="text-align:right;">
                        <div class="bunder-ring2">
                            <img class="profile-pic rounded-circle img-fluid" src="/img/kosong.png" id="foto_subs"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-top: 5%;">
                            <small class="clight" lang="en">Username</small>
                            <p class="cgrey1 tebal" id="isi_username">-</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 stretch-card grid-margin" style="margin-bottom: 1rem !important;">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body" style="padding: 1rem 1rem !important;">
                                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image">
                                <div class="row">
                                    <div class="col-md-4" style="text-align: right;">
                                        <img src="/img/fitur.png" class="rounded-circle img-fluid icon-req-member"
                                            id="icon_member" onerror="this.onerror=null;this.src='/img/fitur.png';">
                                    </div>
                                    <div class="col-md-8">
                                        <h4 id="judul_member" style="margin-top: 1em;">Starter</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 5%;">
                            <small class="clight" lang="en">Request Date</small>
                            <p class="cgrey1 tebal" id="isi_date">-</p>
                        </div>

                        <div class="form-group" style="margin-top: 5%;">
                            <small class="clight" lang="en">Invoice Number</small>
                            <p class="cgrey1 tebal" id="isi_invoice">-</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 5%;">
                            <small class="clight" lang="en">Payment Type</small>
                            <p class="cgrey1 tebal" id="isi_paytipe">-</p>
                        </div>

                        <div class="form-group" style="margin-top: 5%;">
                            <small class="clight" lang="en">Payment Status</small>
                            <p class="cgrey1 tebal" id="isi_paystatus">-</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <div class="form-group" style="margin-bottom: 1em;">
                                <small class="clight" style="margin-bottom: 2%;" lang="en">Payment Detail</small><br>
                                <a href="" class="cfblue s16 tebal" data-toggle="modal"
                                    data-target="#modal_detail_pay_membership" data-dismiss="modal">
                                    <i lang="en">View Detail Payment</i></a>
                            </div>
                        </center>
                    </div>
                </div>

            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%;">

                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="" class="btn btn-teal btn-sm melengkung10px" data-toggle="modal"
                        data-target="#modal_confirm_membership" data-dismiss="modal">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Approve</span></button>
                </center>

            </div> <!-- end-footer     -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL PAYMENT MEMBERSHIP-->
<div class="modal fade" id="modal_detail_pay_membership" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-bottom: 0em !important;">
                <h4 class="modal-title cgrey">Detail Payment</h4>

                <button type="button" id="btn_paymentmember_confirm" class="btn btn-tosca btn-sm"
                    style="margin-bottom: 1em;" data-toggle="modal" data-target="#modal_confirm_membership"
                    data-dismiss="modal">Payment Confirm</button>
            </div> <!-- end-header -->

            <div class="modal-body detail_member">
                <center>
                    <img src="/img/noimg.jpg" class="img_file_bayar_subs" onclick="clickImage(this)"
                        onerror="this.onerror=null;this.src='/img/noimg.jpg';">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-top: 5%;">
                                <small class="clight">Total Payment</small>
                                <p class="cgrey1 tebal" id="isi_totalpay">-</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="margin-top: 5%;">
                                <small class="clight">Paid</small>
                                <p id="isi_paid">-</p>
                            </div>
                        </div>
                    </div>
                </center>

            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%;">

                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="button" id="" class="btn btn-teal btn-sm melengkung10px" data-toggle="modal"
                        data-target="#modal_confirm_membership" data-dismiss="modal">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Approve </button>
                </center>

            </div> <!-- end-footer     -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>



<!-- MODAL MEMBERSHIP PAYMENT CONFIRM-->
<div class="modal fade" id="modal_confirm_membership" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="border: none;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="form_acc_req_membership" action="{{route('approval_req_membership')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body detail_member">
                    <center>
                        <h4 class="cgrey" style="margin-top: -1em;">Approval Confirmation</h4>
                        <small class="cgrey2">Please verify your approval / disproval reason and comment</small>

                        <div class="up_acc_file">
                            <img id="view_img_member" class="profile-pic img-fluid accmember" onclick="clickImage(this)"
                                src="">

                            <div class="p-image accmember">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="accmember" style="width: 38px; height: 38px;">
                                    <i id="browse_acc_member" class="mdi mdi-camera upload-button accmember"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                                <input id="file_acc_member" class="file-upload file-upload-default accmember"
                                    type="file" name="fileup" accept="image/*" />
                            </div>
                            <small class="clight s11">Upload payment proof here or choose file</small>
                            <br>
                        </div>

                        <div class="form-group">
                            <small class="cgrey2">Confirmation Comment</small>
                            <textarea class="form-control input-abu" id="acc_komen" name="acc_komen"
                                rows="2"></textarea>
                        </div>
                        <input type="hidden" name="invoice_num_acc" id="invoice_num_acc">
                        <input type="hidden" name="id_subs_acc" id="id_subs_acc">

                    </center>
                    <div class="row form-group" style="margin-bottom: 0em !important;">
                        <div class="col-md-3" style="padding-top: 0.5em;">
                            <small class="cgrey2">Password</small>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="acc_password" type="password"
                                        name="acc_password" required aria-describedby="btn_showpass_accmember"
                                        style="background-color: #efefef; border-radius: 10px 0px 0px 10px;">
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-light" type="button" id="btn_showpass_accmember"
                                            onclick="showPassText('acc_password')">
                                            <span class="mdi mdi-eye s16" aria-hidden="true"
                                                style="color: grey;"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">

                    <center>
                        <button type="submit" name="action" value="reject" class="btn btn-light btn-sm"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Reject
                        </button>
                        &nbsp;
                        <button type="submit" name="action" value="approve" id="btn_acc_membership"
                            class="btn btn-teal btn-sm melengkung10px">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Approve </button>
                    </center>

                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL DETAIL MEMBERSHIP ALL CARD -->
<div class="modal fade" id="modal_detail_membership_card" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                <h4 class="modal-title cgrey">Detail Membership</h4>
            </div> <!-- end-header -->

            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <div class="bunder-ring" id="img_detail_member">
                    <img class="profile-pic rounded-circle img-fluid" id="foto_membership" src="/img/loading.gif"
                        onerror="this.onerror=null;this.src='/img/kosong.png';">
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight">Membership Title</small>
                            <p class="cgrey1 tebal" id="detail_judul_member"></p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <small class="clight">Membership Pricing</small>
                            <p class="cgrey1 tebal" id="detail_harga_member"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <small class="clight">Description</small>
                        <p class="cgrey1 tebal s13" id="detail_deskripsi_member"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small class="clight">Features : </small> &nbsp;
                        <small class="ctosca s15" id="total_fitur_member"> 0</small>
                    </div>
                </div>
                <div class="card-deck" id="show_feature_member"
                    style="margin-top: 0.5em; width: 100%; overflow-y: auto; overflow-x: hidden; height:170px;">

                </div>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 10px;">
                    <i class="mdi mdi-close"></i> Cancel
                </button>
            </div> <!-- end-footer     -->
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        get_membership_admin();
        tabel_req_membership();
        get_list_fitur_membership_admin();
        // tabel_tes();
    });



    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_req_membership',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show Tes");
            }
        });
    }


    function get_list_fitur_membership_admin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function error(event, jxqhr, status, _error) {
                ui.popup.show('error', status, 'Error');
            },
        });
        $.ajax({
            url: '/admin/get_list_fitur_membership_admin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);

                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    var parent_ui = '';
                    $.each(result, function (i, item) {
                        var child_ui = '';
                        var parent = item.title;
                        var jum = 0;
                        var idfitur = '';
                        idfitur = item.id;
                        $.each(item.sub_features, function (i, subitem) {

                            child_ui += '<li class="">' +
                                '<input type="checkbox" name="fitur_member[]"' +
                                'id="subfitur_' + subitem.id + '"' +
                                'value="' + subitem.id + '">' +
                                '<label>' + subitem.title + '</label>' +
                                '</li>';
                            jum++;
                        });

                        if (jum == 0) {
                            parent_ui += '<ul class="tree member">' +
                                '<li class="has">' +
                                '<input type="checkbox" name="fitur_id[]" value="0" id="id_' + item.id + '">' +
                                '<label>' + parent + ' &nbsp;' +
                                '</label>' +
                                '</li>' +
                                '</ul>';
                        } else {
                            parent_ui += '<ul class="tree member">' +
                                '<li class="has">' +
                                '<input type="checkbox" name="fitur_id[]"  value="' + idfitur + '">' +
                                '<label>' + parent + ' &nbsp;' +
                                '<small class="total"> &nbsp; (' + jum + ') </small>' +
                                '<i class="mdi mdi-chevron-down clight"></i>' +
                                '</label>' +
                                '<ul>' + child_ui + '</ul>' +
                                '</li>' +
                                '</ul>';
                        }
                    });

                    $("#isi_membership_admin").html(parent_ui);
                }
            },
            error: function (result) {
                ui.popup.show('error', result.message, 'Failed');
                console.log(result);
            }
        });
    }


    function get_membership_admin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_list_membership_admin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        $("#div_nomembership").show();
                        $("#show_membership").hide();
                        // ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    $("#div_nomembership").hide();
                    $("#show_membership").show();
                    var isimember = '';
                    $.each(result, function (i, item) {
                        var logo = server_cdn + cekimage_cdn(item.image);
                        var noimg = '/img/fitur.png';
                        isimember += '<div class="col-md-4 stretch-card grid-margin card-member">' +
                            '<div class="card bg-gradient-success card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<h4 class="font-weight-normal mb-3">' + item.membership + '<i class="mdi mdi-cube-outline mdi-24px float-right"></i>' +
                            '</h4>' +
                            '<div class="row">' +
                            '<div class="col-7">' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid logo-membership" onerror="this.onerror=null;this.src=\'' + noimg + '\';" >' +
                            '</div>' +
                            '<div class="col-5" style="text-align:right;">' +
                            '<button type="button" class="membershipbtn" onclick="detail_membership_card(' + i + ')">' +
                            '<b><small class="cteal s12"><i class="mdi mdi-checkbox-blank-circle"></i>' +
                            'Detail</small></b></button>' +
                            '</div></div>' +
                            '<small class="card-text">' + item.description + '</small>' +
                            '</div></div></div>';
                    });

                    $("#show_membership").html(isimember);
                }
            },
            error: function (result) {
                ui.popup.show('error', 'Cant Get Membership Features', 'Failed');
                console.log(result);
            }
        });
    }


    function detail_membership_card(dtnya) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_list_membership_admin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);

                var result = result[dtnya];
                $("#detail_judul_member").html(result.membership);
                $("#detail_harga_member").html("Rp  "+rupiah(result.pricing));
                $("#detail_deskripsi_member").html(result.description);
                $("#foto_membership").attr("src", server_cdn + cekimage_cdn(result.image));
                $("#modal_detail_membership_card").modal('show');

                var subf = '';
                var jum = 0;
                var noimg = '/img/fitur.png';

                $.each(result.feature, function (i, item) {
                    var sub_ui = '';
                    $.each(item.sub_features, function (i, subitem) {
                        sub_ui +=
                            '<li><small class="clight">' + subitem.title + '</small></li>';
                    });
                    jum++;
                    subf += '<div class="row" style="margin-bottom:0.5em;">'+
                    '<div class="col-md-6"' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                        'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                        '<div class="card bg-gradient-blue card-img-holder text-white submember">' +
                        '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                        'alt="circle-image" /> ' +
                        '<div class="row">' +
                        '<div class="col-md-3" style="padding-right:4px;">' +
                        '<img src="' + server_cdn + cekimage_cdn(item.logo) + '" class="rounded-circle img-fluid img-card2"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '</div>' +
                        '<div class="col-md-9">' +
                        '<b><small>' + item.title + '</small></b><br>' +
                        '<small class="cblue"> <b>'+ jum +'</b> Subfeature</small>'+
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'+
                        '<div class="col-md-6 padsubmember">' +
                        '<small class="cgrey2 s13">' + item.title + '</small>'+
                        '<ul class="submember">' + sub_ui+'</ul>' +
                        '</div></div>';
                });
                $("#show_feature_member").html(subf);
                $("#total_fitur_member").html(jum);
            },
            error: function (result) {
                console.log(result);
                $("#modal_detail_membership_card").modal('hide');
                ui.popup.show('error', "Cant load detail", 'Internal Server Error');
            }
        });

    }


    function tabel_req_membership() {
        var tabel = $('#tabel_req_member').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_req_membership',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_req_member tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'user_id' },
                { mData: 'full_name' },
                { mData: 'payment_status_title' },
                { mData: 'payment_method' },
                { mData: 'membership' },
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {

                        return '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_req_membership(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye matadetail"></i>' +
                            '</a>';
                    }
                }
            ],

        });

    }


    function detail_req_membership(id_subs) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_detail_membership_req',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "user_id": id_subs
            },
            success: function (result) {
                var isipaid = '';
                console.log(result);
                var dt = result[0];
                $("#isi_date").html(formatDate(dt.request_date));
                $("#isi_invoice").html(dt.invoice_number);
                $("#invoice_num_acc").val(dt.invoice_number);
                $("#id_subs_acc").val(dt.user_id);
                $("#isi_username").html(dt.full_name);
                $("#isi_paytipe").html(dt.payment_method);
                $("#isi_totalpay").html("Rp " + rupiah(dt.grand_total));
                $("#isi_paystatus").html(dt.payment_status_title);
                $("#judul_member").html(dt.membership);

                if (dt.picture != undefined && dt.picture != null && dt.picture != "" && dt.picture != "0") {
                    $("#foto_subs").attr("src", server_cdn + cekimage_cdn(dt.picture));
                }

                // if (dt.picture != "0") {
                //     $(".logo_komunitas").attr("src", server_cdn + cekimage_cdn(dt.picture));
                // }

                if (dt.file_subscriber == null) {
                    $(".img_file_bayar_subs").attr("src", "/img/noimg.jpg");
                } else {
                    $(".img_file_bayar_subs").attr("src", server_cdn + cekimage_cdn(dt.file_subscriber));
                }

                if (dt.already_paid == true) {
                    isipaid = '<h6 style="color: #9de43e;">ALREADY PAID</h6';
                } else {
                    isipaid = '<h6 style="color: #ff4d4d;">NOT YET</h6';
                }
                $("#isi_paid").html(isipaid);

                $("#modal_detail_req_member").modal("show");
            },
            error: function (result) {
                console.log("Cant Show Detail Membership Request");
            }
        });
    }


    // function file_browser_profil(){


    $("#file_acc_member").on('change', function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#view_img_member').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#view_img_member').show();
        }
    });

    $("#browse_acc_member").on('click', function () {
        $("#file_acc_member").click();
    });
    // }

    // function file_browser_profil(){

    var readURLuser = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_membership').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#file_img_membership").on('change', function () {
        readURLuser(this);
    });

    $("#browse_membership_admin").on('click', function () {
        $("#file_img_membership").click();
    });
// }

</script>

@endsection
