@extends('layout.admin-dashboard')
@section('title', 'Module Management')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Module Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" id="btn_show_payment" class="btn btn-teal btn-sm" data-toggle="modal"
            data-target="#modal_pay_module" data-dismiss="modal">
            <i class="mdi mdi-check btn-icon-prepend">
            </i> Pay </button>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body memberku">
                <h4 class="cgrey" style="margin-bottom: -0.5em;">Module List</h4>

                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="tab-subs active" id="tab_active">
                            <a href="#tab_module_1" data-toggle="tab">
                                Active
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_all">
                            <a href="#tab_module_2" data-toggle="tab">
                                All
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_module_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted"> Total : </small> &nbsp;
                                    <h4 class="card-title text-success" id="total_module_active"> 0 </h4>
                                </div>
                            </div>
                            <div class="row">

                                <div id="show_module_active" class="card-deck">

                                </div>
                            </div><!-- endrow -->
                        </div> <!-- end-tab 1  -->


                        <div class="tab-pane" id="tab_module_2">

                            <small class="text-muted"> Total : </small>
                            <h4 class="card-title text-success" id="total_module"> 0 </h4>


                            <div class="row" style="margin-top: 1.5em;">
                                <div id="show_module_all" class="card-deck">

                                </div>
                            </div>
                        </div> <!-- end-tab2 -->
                    </div> <!-- end-content -->
                </div> <!-- end-tab line -->
            </div>
        </div>
    </div>
</div>



<!-- MODAL SETTING  MODULE -->
<div class="modal fade" id="mdl_setting_module_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"
            style="background-color: #ffffff; min-height: 350px; padding-left: 3%; padding-right: 3%;">
            <div class="modal-header" style="padding-bottom: 2em !important; border:none;">
                <h3 class="modal-title cgrey">Setting Module</h3>
            </div> <!-- end-header -->
            <form id="form_setting_module_admin" method="POST" action="{{route('send_setting_module_admin')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="isi_setting_module">
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                </div> <!-- end-body -->

                <div class="modal-footer kananbawah">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i>Submit</button>
                    </center>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>

<!-- MODAL ALL - aktifkan dan Detail-->
<div class="modal fade" id="md_all_aktifkan_module" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0em !important; border:none;">
                <h4 class="modal-title cgrey">Detail Module</h4>
                <div class="status_aktif"></div>
            </div> <!-- end-header -->

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 stretch-card grid-margin">
                        <div class="card bg-gradient-blue card-img-holder text-white">
                            <div class="card-body" style="padding: 1rem 1rem !important;">
                                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <div class="row">
                                    <div class="col-md-5 kanan" style="padding-right: 1px;padding-left: 1.5em;">
                                        <img src="/img/cam.png" id="logo_fitur_module"
                                            class="rounded-circle img-fluid img-fitur-module" alt="">
                                    </div>
                                    <div class="col-md-7 kiri">
                                        <h4 class="cwhite" style="margin-top: 0.5em;" id="module_name1">
                                            Module Title
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight">Module Name</small>
                                    <p class="cgrey1 tebal s13" id="module_name">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight">Module Type</small>
                                    <p class="cgrey1 tebal s13" id="module_tipe">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="clight">Description</small>
                                <p class="cgrey1 tebal s13" id="module_deskripsi">-</p>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 1em;">
                            <div class="col-md-8">
                                <!-- tab -->
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item cus-a nav-link s10 active" id="nav_tab_1" data-toggle="tab"
                                            href="#nav_tabisi_1" role="tab" aria-controls="nav_tab_1"
                                            aria-selected="true" lang="en"><small>Onetime</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_2" data-toggle="tab"
                                            href="#nav_tabisi_2" role="tab" aria-controls="nav_tab_2"
                                            aria-selected="false" lang="en"><small>Monthly</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_3" data-toggle="tab"
                                            href="#nav_tabisi_3" role="tab" aria-controls="nav_tab_3"
                                            aria-selected="false" lang="en"><small>Annual</small></a>
                                    </div>
                                </nav>
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show s12 active" id="nav_tabisi_1" role="tabpanel"
                                        aria-labelledby="nav_tab_1">
                                        <div id="harga_grand"></div>
                                    </div>

                                    <div class="tab-pane fade s12" id="nav_tabisi_2" role="tabpanel"
                                        aria-labelledby="nav_tab_2">
                                        <div id="harga_bulanan"></div>
                                    </div>

                                    <div class="tab-pane fade s12" id="nav_tabisi_3" role="tabpanel"
                                        aria-labelledby="nav_tab_3">
                                        <div id="harga_tahunan"></div>
                                    </div>

                                </div>
                                <!-- end-tab -->
                            </div>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <small class="clight">Module Sub-Features</small>
                        <div id="nosubfitur"
                            style="display: none; position: absolute; margin-left: auto; margin-right: auto; left: 0; right: 0;">
                            <h2 class="clight" style="text-align: center;">No Subfeature</h2>
                        </div>
                        <br>

                        <div class="row" style="margin-top:0.5em;">
                            <div class="card-deck show_subfitur_module scrollfitur" style="width:100%;">

                            </div>
                        </div> <!-- end-row deck -->
                    </div>
                    <!-- end -->
                </div>
            </div><!-- end-body -->


                <div class="modal-footer" style="border: none;">
                    <center>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="button" id="btn_aktivasi_showhide" class="btn btn-teal btn-sm"
                            style="display: none;">
                            <i class="mdi mdi-check btn-icon-prepend"></i>
                            Activate</button>
                    </center>
                </div> <!-- end-footer     -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL PAYMENT M\ODULE -->
<div id="modal_pay_module" class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
    aria-labelledby="modal_pay_module" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
<form method="POST" id="form_aktivasi_module" action="{{route('aktifasi_module_admincomm')}}">
    {{ csrf_field() }}
    <input type="hidden" name="id_modulefitur" id="id_modulefitur">

            <div class="modal-body" style="min-height: 400px; height: auto; padding-left: 5%; padding-right: 5%;">
                <h3 class="cgrey" style="margin-bottom: 1em;">Choose Payment</h3>
                <div class="row">
                    <div class="col-md-4">
<h6 class="h6 clight">Choose Payment Time</h6>
                        <select id="payment_time_module" class="form-control input-abu" name="payment_time_module" required>
                            <option disabled selected>Choose</option>
                            <option value="1">Onetime</option>
                            <option value="2">Monthly</option>
                            <option value="3">Annual</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <div id="isi_pay_time"></div>
                    </div>
                </div>
<br>
                <div class="row">
                    <div class="col-md-7">
                        <h6 class="h6 clight" style="margin-bottom:0.5em;">Choose Payment Method</h6>
                        <div class="row" style="padding-left: 5%;">
                            <div id="isi_method_pay">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                    <h6 class="h6 clight" style="margin-bottom:1em;">Bank Transfer</h6>
                        <div id="isi_show_bank" class="collapse-accordion" role="tablist" aria-multiselectable="true">

                        </div>
                    </div>
                </div>
            </div>

                <input type="text" name="id_pay_method_module" id="id_pay_method_module">
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        get_module_active();
        get_module_all();
        get_payment_module();
    });


    function get_module_active() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_active_module_list',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);

                var isiui = '';
                var num = 0;
                $.each(result, function (i, item) {
                    // console.log(item);
                    num++;
                    var noimg = '/img/fitur.png';
                    var logo = server_cdn + item.logo;
                    isiui +=
                        '<div class="col-md-4 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                        'style="padding: 0.3rem 0.5rem;"' +
                        'onclick="detail_module_all(\'' + item.feature_id + '\')">Ready</button>' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<small class="cteal">' + item.feature_type_title + '</small>' +
                        '<h4>' + item.title + '</h4>' +
                        '</div>' +
                        '<div class="col-md-12" style="text-align: right;">' +
                        '<button type="button" class="a_setmodule" style="border: none; background: #ffffff00;"' +
                        'onclick="get_list_setting_module(' + item.feature_id + ')">' +
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                        ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                        '</small></button>' +
                        '</div>' +
                        '</div></div></div></div>';
                });

                $("#show_module_active").html(isiui);
                $("#total_module_active").html(num + " Modules");

            },
            error: function (result) {
                console.log("Cant Show Module List");
            }
        });
    }

    function get_list_setting_module(idmod) {
        // alert(idmod);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_list_setting_module_admin',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "feature_id": idmod
            },
            success: function (result) {
                console.log(result);
                if (result.success == false) {
                    swal('No Setting', 'The setting does not exist in this module', 'warning');
                } else {
                    var uiku = '';
                    $.each(result, function (i, item) {
                        var htmltag = '';
                        if (item.setting_type == 1) {
                            var tipe = 'Input Text';
                            htmltag = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                                'class="form-control input-abu param_setting">';
                        } else {
                            var tipe = 'Radio Button';
                            if (item.value == "true") {
                                htmltag = '<div class="form-group">' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                                    '</div>' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                                    '</div>';
                            } else {
                                htmltag = '<div class="form-group">' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                                    '</div>' +
                                    '<div class="form-check set_mod">' +
                                    '<label class="form-check-label">' +
                                    '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                                    '</div>';
                            }
                        }

                        uiku += '<div class="row" style="margin-bottom:0.5em;">' +
                            '<div class="col-8"><div class="form-group">' +
                            '<h6 class="cgrey1 tebal name_setting">' + item.title +
                            '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                            '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                            '</p>' +
                            '<input type="hidden" value="' + item.id + '" name="idsub_' + item.id + '">' +
                            '</div>' +
                            '</div >' +
                            '<div class="col-4">' + htmltag +
                            '</div></div></div>';
                    });
                    $("#isi_setting_module").html(uiku);
                    $("#mdl_setting_module_active").modal('show');
                }

            },
            error: function (result) {
                console.log(result);
                ui.popup.show('warning', 'Bad Connection, Try again later', 'Warning');
            }
        });
    }

    function get_module_all() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_all_module_list',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                var isiui = '';
                var nomer = 0;
                $.each(result, function (i, item) {
                    var noimg = '/img/fitur.png';
                    nomer++;
                    var logo = server_cdn + item.logo;
                    if (item.status == true) {
                        isiui +=
                            '<div class="col-md-4 stretch-card ' +
                            'grid-margin card-member' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                            'style="padding: 0.3rem 0.5rem;"' +
                            'onclick="detail_module_all(\'' + item.feature_id + '\')">Ready</button>' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                            '<div class="row">' +
                            '<div class="col-md-12">' +
                            '<small class="cteal">' + item.feature_type_title + '</small>' +
                            '<h4>' + item.title + '</h4>' +
                            '</div>' +
                            '<div class="col-md-12" style="text-align: right;">' +
                            '<button type="button" class="a_setmodule" style="border: none; background: #ffffff00;"' +
                            'onclick="get_list_setting_module(' + item.feature_id + ')">' +
                            '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                            ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                            '</small></button>' +
                            '</div>' +
                            '</div></div></div></div>';
                    } else {
                        isiui += '<div class="col-md-4 stretch-card ' +
                            'grid-margin card-member' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                            '<div class="row">' +
                            '<div class="col-md-7">' +
                            '<small class="cteal">' + item.feature_type_title + '</small>' +
                            '<h4>' + item.title + '</h4>' +
                            '</div>' +
                            '<div class="col-md-5" style="text-align: right;">' +
                            '<button class="btn btn-sm btn-ready-card"' +
                            'onclick="detail_module_all(\'' + item.feature_id + '\')">Active</button>' +
                            '</div>' +
                            '</div></div></div></div>';
                    }

                });
                $("#total_module").html(nomer + " Modules");
                $("#show_module_all").html(isiui);

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show Module List All");
            }
        });
    }

    function detail_module_all(idsubfitur) {
        // alert(idsubfitur);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/detail_module_all',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "feature_id": idsubfitur
            },
            success: function (result) {
                var dt = result[0];
                console.log(dt);

                if (result.success == false) {
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    //form aktivasi
                    $("#id_modulefitur").val(dt.feature_id);
                    $("#payment_time").val();
                    $("#payment_method_id").val();

                    $("#logo_fitur_module").attr("src", server_cdn + dt.logo);
                    $("#module_name").html(dt.title);
                    $("#module_name1").html(dt.title);
                    $("#module_deskripsi").html(dt.description);
                    $("#module_tipe").html(dt.feature_type_title);

                    //status aktif
                    var isistatus = '';
                    if (dt.status == false) {
                        isistatus = '<label class="badge melengkung10px bg-abu cputih" ' +
                            'style="min-width:100px;"> Not Active</label >';
                        $("#btn_aktivasi_showhide").show();
                    } else {
                        isistatus = '<label class="badge melengkung10px bg-ijo cputih" ' +
                            'style="min-width:100px;"> Active</label >';
                        $("#btn_aktivasi_showhide").hide();
                    }
                    $(".status_aktif").html(isistatus);

                    //pricing
                    if (dt.price_annual != 0) {
                        $("#harga_tahunan").html("Rp " + rupiah(dt.price_annual));
                    } else {
                        $("#harga_tahunan").html('<center class="tebal cgrey">Free');
                    }

                    if (dt.price_monthly != 0) {
                        $("#harga_bulanan").html("Rp " + rupiah(dt.price_monthly));
                    } else {
                        $("#harga_bulanan").html('<center class="tebal cgrey">Free');
                    }

                    if (dt.grand_pricing != 0) {
                        $("#harga_grand").html("Rp " + rupiah(dt.grand_pricing));
                    } else {
                        $("#harga_grand").html('<center class="tebal cgrey">Free');
                    }

                    if (dt.subfeature == 0) {
                        $("#nosubfitur").show();
                    } else {
                        $("#nosubfitur").hide();
                    }
                    var subf = '';
                    var jum = 0;
                    $.each(dt.subfeature, function (i, item) {
                        // console.log(item);
                        var colum;
                        jum++;

                        subf += '<div class="col-md-6 stretch-card grid-margin" style="height:85px; padding-left: 5px; padding-bottom:10px;"' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                            'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                            '<div class="card bg-gradient-blue card-img-holder text-white">' +
                            '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                            'alt="circle-image" /> ' +
                            '<div class="row">' +
                            '<div class="col-md-3" style="padding-right:4px;">' +
                            '<img src="' + server_cdn + item.logo + '" class="rounded-circle img-fluid img-card3"' +
                            'onerror = "this.onerror=null;this.src=\' /img/fitur.png \';">' +
                            '</div>' +
                            '<div class="col-md-9" style="padding-left:5px;">' +
                            '<b><small>' + item.title + '</small></b>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $(".show_subfitur_module").html(subf);
                    $("#md_all_aktifkan_module").modal("show");

                }
            },
            error: function (result) {
                console.log(result);
            }
        });
    }

    function get_payment_module() {
        $("#btn_submit_paymethod").attr("disabled", "disabled");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_payment_module',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);
                var text = '';
                var isibank = '';

                var noimg = '/img/fitur.png';

                $.each(result, function (i, item) {
                    text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value=""' +
                        'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';
                    var deskrip = '';
                    $.each(item.payment_methods, function (i, itm) {
                        $.each(itm.description, function (x, isides) {
                            deskrip += '<li sytle="background-color:#fff;">' + isides + '</li>';
                        });
                        isibank +=
                            '<div class="card border-oren hidendulu method' + item.id + '" id="cardpay' + itm.id + '">' +
                            '<div class="card-header" role="tab" sytle="background-color:#fff;">' +
                            '<h6 class="mb-0 pdb1">' +
                            '<a data-toggle="collapse" data-parent="#isi_show_bank" href="#collapseOne' + itm.id + '" ' +
                            'id="idpayq' + itm.id + '" onclick="pilihpay(' + itm.id + ');" aria-expanded="true"' +
                            'aria-controls="collapseOne' + itm.id + '">' +
                            '<img src="' + server_cdn + itm.icon + '" class="imgepay" style="width: 10%; height: auto;"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + itm.payment_title +
                            '<span class="float-right">' +
                            '<i class="fa fa-chevron-right"></i>' +
                            '</span>' +
                            '</a></h6></div>' +
                            '<div id="collapseOne' + itm.id + '" class="collapse" role="tabpanel">' +
                            '<div class="card-block"><ul>' + deskrip +
                            '</ul></div></div></div>';
                    });
                });
                $("#isi_method_pay").html(text);
                $("#isi_show_bank").html(isibank);

            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    function pilih_pay_bank(ini) {
        $("#btn_submit_paymethod").attr("disabled", "disabled");
        $(".hidendulu").removeClass('dipilih');
        $('.btn-blueline').removeClass('active');
        $("#" + ini.id).addClass('active');
        $("." + ini.id).addClass('dipilih');
        $("." + ini.id).removeClass('active');
    }


    function pilihpay(idpay) {
        $("#id_pay_method_module").val(idpay);
        $(".border-oren").removeClass("active");
        $("#cardpay" + idpay).addClass("active");
        $("#btn_pay_next").removeAttr("disabled");
        $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
    }


    $('#payment_time_module').change(function () {
        var dipilih = this.value;
        var showin = '';
        if(dipilih == 1){
            showin = '<span class="h6 cblue">Rp 25.500 </span> &nbsp; <small class="clight"> / Once</small>';
        }else if(dipilih == 2){
            showin = '<span class="h6 cblue">Rp 3.000 </span> &nbsp; <small class="clight"> / Once</small>';
        }else{
            showin = '<span class="h6 cblue">Rp 17.500 </span> &nbsp; <small class="clight"> / Once</small>';
        }
        $("#isi_pay_time").html(showin);
    });



</script>

@endsection
