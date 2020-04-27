@extends('layout.superadmin')

@section('title', 'Pricing Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-diamond"></i>
        </span> Pricing Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" id="btn_add_pricing_super" class="btn btn-tosca btn-sm"
            style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal" data-target="#modal_add_pricing_super"
            data-dismiss="modal">Add Pricing</button>
    </nav>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="cgrey" style="margin-bottom: -1em;">Pricing List</h4>

                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                All
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                Active
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <br>

                            <!-- tabel all susbcriber -->
                            <table id="tabel_all_pricing_super" class="table table-hover table-striped dt-responsive "
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pricing Name</th>
                                        <th>Monthly Price</th>
                                        <th>Annual Price</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Total Feature</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <br>
                            belum di set
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL DETAIL PRICING-->
<div class="modal fade" id="modal_detail_pricing_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div id="tampil_detail_pricing">
                <form>
                    <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                        <h4 class="modal-title cgrey">Detail Pricing</h4>
                        <div class="pricing_status" style="text-align: right;"></div>

                    </div> <!-- end-header -->

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="/img/kosong.png" class="rounded-circle img-fluid" id="img_logo_pricing"
                                    onerror="this.onerror=null;this.src='/img/kosong.png';">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Name</small>
                                    <p class="cgrey2" id="pricing_name">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Type</small>
                                    <p class="cgrey2" id="pricing_type">-</p>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: -0.5em;">
                                <div class="form-group">
                                    <small class="clight s13">Description Pricing</small>
                                    <p class="cgrey2" id="pricing_deskripsi">-</p>
                                </div>
                            </div>
                        </div>

                        <h5 class="cgrey tebal" style="margin-top: 1em;">Pricing Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Onetime Price</small>
                                    <p class="cgrey2" id="pricing_sekali">-</p>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13">Monthly Price</small>
                                    <p class="cgrey2" id="pricing_bulanan">-</p>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13">Annual Price</small>
                                    <p class="cgrey2" id="pricing_tahunan">-</p>
                                </div>
                            </div>
                            <div class="col-md-6" style="border-left: 1px solid rgb(216, 216, 216);">
                                <span class="cteal2 s19" id="total_fiturpricing" style="margin-bottom: 1em;"></span>
                                <ul>
                                    <div id="fitur_pricing"></div>
                                </ul>
                            </div>
                        </div>


                    </div> <!-- end-body -->

                    <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Cancel
                        </button>
                        &nbsp;
                        <button type="button" id="btn_go_editpricing" class="btn btn-teal btn-sm" data-toggle="modal"
                            data-target="#modal_edit_pricing_super" data-dismiss="modal">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Edit Pricing </button>
                    </div> <!-- end-footer     -->
                </form>
            </div>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>


<!-- MODAL ADD PRICING MANAGEMENT-->
<div class="modal fade" id="modal_add_pricing_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div id="tampil_detail_pricing">
                <form method="POST" id="form_add_pricing" action="{{route('add_pricing_super')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                        <h4 class="modal-title cgrey">Add Pricing</h4>
                        <div class="pricing_status" style="text-align: right;"></div>

                    </div> <!-- end-header -->

                    <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="img-upload-profil" style="margin-top: -1.5em; margin-bottom: 5em;">
                                    <div class="circle editpricing">
                                        <img id="view_img_pricing"
                                            class="profile-pic editpricing rounded-circle img-fluid"
                                            src="/img/focus.png">
                                    </div>
                                    <div class="p-image editpricing">
                                        <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                            style="width: 30px; height: 30px;">
                                            <i id="browse_img_pricing" class="mdi mdi-camera upload-button"></i>
                                        </button>
                                        <input id="file_img_pricing" class="file-upload file-upload-default" type="file"
                                            name="fileup" accept="image/*" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Name</small>
                                    <input type="text" id="add_nama_pricing" name="add_nama_pricing"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Pricing Type</small>
                                    <select class="form-control input-abu" name="add_tipepricing" id="add_tipepricing"
                                        required>
                                        <option disabled selected> Choose</option>
                                        <option value="1"> Registrasion </option>
                                        <option value="2"> Feature</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: -0.5em;">
                                <div class="form-group">
                                    <small class="clight s13">Description Pricing</small>
                                    <textarea class="form-control input-abu" id="add_deskripsi_pricing"
                                        name="add_deskripsi_pricing" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <h5 class="cgrey tebal" style="margin-top: 1em;">Pricing Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight s13">Onetime Price</small>
                                    <input type="text" id="add_sekali" name="add_sekali" class="form-control input-abu"
                                        required>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13">Monthly Price</small>
                                    <input type="text" id="add_bulanan" name="add_bulanan"
                                        class="form-control input-abu" required>
                                </div>
                                <div class="form-group">
                                    <small class="clight s13">Annual Price</small>
                                    <input type="text" id="add_tahunan" name="add_tahunan"
                                        class="form-control input-abu" required>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none;" id="hide_fitur_add">
                                <small class="clight s13">Feature</small>

                                <div id="hide_multi_add" style="display: none;overflow-y: auto;overflow-x: auto; height:190px;">
                                    <div class="form-group" id="show_ceklist_fitur">


                                    </div>
                                    <!-- <select id="multi_fiturpricing" name="multi_fiturpricing[]"
                                        class="form-control input-abu" multiple="multiple">

                                    </select> -->
                                </div>

                                <select id="fiturpricing" name="multi_fiturpricing" class="form-control input-abu">

                                </select>
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
                            </i> Add Pricing </button>
                    </div> <!-- end-footer     -->
                </form>
            </div>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>



<!-- MODAL EDIT PRICING MANAGEMENT-->
<div class="modal fade" id="modal_edit_pricing_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff; margin-top: -1em;">
            <form method="POST" id="form_edit_pricing_super" action="{{route('edit_pricing_super')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header"
                    style="padding-left: 5%;padding-right: 5%; border: none; padding-bottom: 0px;">
                    <h4 class="modal-title cgrey">Edit Pricing</h4>
                    <div class="pricing_status" style="text-align: right;"></div>

                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px; padding-top: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control input-abu" id="id_pricing_edit" name="id_pricing_edit"
                                type="hidden">
                            <div class="img-upload-profil" style="margin-top: -1.5em; margin-bottom: 5em;">
                                <div class="circle editpricing">
                                    <img id="view_img_pricing_edit"
                                        class="profile-pic editpricing rounded-circle img-fluid" src="/img/focus.png"
                                        onerror="this.onerror=null;this.src='/img/kosong.png';">
                                </div>
                                <div class="p-image editpricing">
                                    <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                        style="width: 30px; height: 30px;">
                                        <i id="browse_img_pricing_edit" class="mdi mdi-camera upload-button"></i>
                                    </button>
                                    <input id="file_img_pricing_edit" class="file-upload file-upload-default"
                                        type="file" name="fileup" accept="image/*" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Pricing Name</small>
                                <input type="text" id="edit_nama_pricing" name="edit_nama_pricing"
                                    class="form-control input-abu">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Pricing Type</small>
                                <select class="form-control input-abu" name="edit_tipepricing" id="edit_tipepricing">
                                    <option disabled selected> Choose</option>
                                    <option value="1"> Registrasion </option>
                                    <option value="2"> Feature</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: -0.5em;">
                            <div class="form-group">
                                <small class="clight s13">Description Pricing</small>
                                <textarea class="form-control input-abu" id="edit_deskripsi_pricing"
                                    name="edit_deskripsi_pricing" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <h6 class="cgrey tebal" style="margin-top: 0.5em;">Pricing Information</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Onetime Price</small>
                                <input type="text" id="edit_sekali" name="edit_sekali" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Monthly Price</small>
                                <input type="text" id="edit_bulanan" name="edit_bulanan" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="clight s13">Annual Price</small>
                                <input type="text" id="edit_tahunan" name="edit_tahunan" class="form-control input-abu">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <small class="clight s13">Feature</small>
                            <select id="edit_multi_fiturpricing" name="edit_multi_fiturpricing[]"
                                class="form-control input-abu" multiple="multiple" style="display: none;" required>
                            </select>
                        </div> -->

                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 1.75em;">
                                <small class="clight s13">Status Activation</small>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="edit_status_pricing"
                                        name="edit_status_pricing">
                                    <label class="custom-control-label" for="edit_status_pricing"></label>
                                </div>
                            </div>
                            <div style="display: none;" id="hide_fitur_edit">
                                <small class="clight s13">Feature</small>
                                <div id="hide_multi_edit" style="display: none;overflow-y: auto;overflow-x: auto; height:140px;">
                                        <div class="form-group" id="edit_show_ceklist_fitur">


                                        </div>
                                    <!-- <select id="edit_multi_fiturpricing" name="edit_multi_fiturpricing[]"
                                        class="form-control input-abu" multiple="multiple">

                                    </select> -->
                                </div>
                                <select id="fiturpricing_edit" name="edit_multi_fiturpricing"
                                    class="form-control input-abu">
                                </select>
                            </div>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 0.5em; margin-top: -0.5em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_edit_pricing" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Edit </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        tabel_all_pricing_super();

        get_list_fitur_pricing();

        // tabel_tes();
    });  //end- document ready


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_pricing_management_superadmin',
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


    var switchStatus = false;
    $("#edit_status_pricing").on('change', function () {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
            // alert(switchStatus);// To verify
        }
        else {
            switchStatus = $(this).is(':checked');
            // alert(switchStatus);// To verify
        }
    });

    function tabel_all_pricing_super() {
        var tabel = $('#tabel_all_pricing_super').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                },
            },
            ajax: {
                url: '/superadmin/tabel_pricing_management_superadmin',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_module_report_superadmin tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },
            columns: [
                { mData: 'id' },
                {
                    mData: 'title',
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 3
                },
                {
                    mData: 'price_monthly',
                    render: function (data, type, row, meta) {
                        var bulanan = 'Rp. ' + rupiah(data);
                        return bulanan;
                    }
                },
                {
                    mData: 'price_annual',
                    render: function (data, type, row, meta) {
                        var tahunan = 'Rp. ' + rupiah(data);
                        return tahunan;
                    }
                },
                { mData: 'pricing_type_title' },
                {
                    mData: 'status_title',
                    render: function (data, type, row, meta) {
                        var dt = row.status;
                        var isine = '';
                        if (dt == 0) {
                            isine = '<label class="badge bg-abu melengkung10px cwhite">Deactive</label>';
                        } else if (dt == 1) {
                            isine = '<label class="badge bg-tosca melengkung10px cwhite">Active</label>';
                        }
                        return isine;
                    }
                },
                {
                    mData: 'pricing_feature',
                    render: function (data, type, row, meta) {
                        var totalfitur = data.length;
                        if (totalfitur == 0) {
                            return '<center>' + totalfitur + '</center>';
                        } else if (totalfitur == 1) {
                            return '<center>' + totalfitur + '  <small>Feature </small></center>';
                        } else {
                            return '<center>' + totalfitur + '   <small>Features </small></center>';
                        }
                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_pricing_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }


    function detail_pricing_super(idku) {
        $('#modal_detail_pricing_super').modal('show');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/detail_pricing_super',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "pricing_id": idku
            },
            success: function (result) {
                console.log(result);
                $(".rmpricing").removeAttr("checked", "checked");

                if (result.length == 0) {
                    var res = result;
                } else {
                    var res = result[0];
                }

                var isitatus = '';
                if (res.status == 0) {
                    isitatus = '<label class="badge bg-abu melengkung10px cwhite">Deactive</label>';
                } else if (res.status == 1) {
                    isitatus = '<label class="badge bg-tosca melengkung10px cwhite">Active</label>';
                }

                if (res.icon != null) {
                    $("#img_logo_pricing").attr("src", server_cdn + cekimage_cdn(res.icon));
                    $("#view_img_pricing_edit").attr("src", server_cdn + cekimage_cdn(res.icon));
                }

                var arf = [];
                var len = res.pricing_feature.length;
                $.each(res.pricing_feature, function (i, item) {
                    //  console.log(item.feature_id);
                    arf.push(item.feature_id);
                });
                var fiturs = arf.toString();


                //edit
                $("#edit_nama_pricing").val(res.title);
                $("#edit_deskripsi_pricing").text(res.description);
                $("#edit_tipepricing").val(res.pricing_type);
                $("#edit_sekali").val(res.grand_pricing);
                $("#edit_bulanan").val(res.price_monthly);
                $("#edit_tahunan").val(res.price_annual);
                $("#id_pricing_edit").val(idku);
                if (res.status == 1) {
                    $("#edit_status_pricing").attr("checked", true);
                } else {
                    $("#edit_status_pricing").attr("checked", false);
                }
                // $("edit_status_pricing").val();

                if (res.pricing_type == 1) {
                    $("#hide_fitur_edit").show(); //div colum
                    $("#hide_multi_edit").show();
                    $("#fiturpricing_edit").hide();
                } else {
                    $("#hide_fitur_edit").show(); //div colum
                    $("#hide_multi_edit").hide();
                    $("#fiturpricing_edit").show();
                }

                // console.log(fiturs);
                // console.log(arf);
                $.each(fiturs.split(","), function (i, e) {
                    console.log(e);
                    if (result.pricing_type == 2) {
                         $("#fiturpricing_edit").val(e);
                        //    $('select[name="fiturpricing_edit"]').val(e);
                        // $("#fiturpricing_edit").val(e).attr("selected", "selected");
                    } else {
                        $("#edit_fitur_"+e).attr("checked", "checked");
                        // $("#edit_multi_fiturpricing").val(e).attr("selected", "selected");

                    }
                });
                //end-edit



                $("#pricing_status").html(isitatus);
                $("#foto_user").attr("src", server_cdn + res.icon);
                $("#pricing_name").html(res.title);
                $("#pricing_type").html(res.pricing_type_title);
                $("#pricing_deskripsi").html(res.description);
                $("#pricing_tahunan").html('Rp ' + rupiah(res.price_annual));
                $("#pricing_bulanan").html('Rp ' + rupiah(res.price_monthly));
                $("#pricing_sekali").html('Rp ' + rupiah(res.grand_pricing));

                var fiturnya = '';
                var jum = 0;
                $.each(res.pricing_feature, function (i, item) {
                    jum++;
                    fiturnya += '<li><small class="cgreyblue s14">' + item.feature_title + '</small></li>';
                });
                console.log(jum);
                if (jum != 0) {
                    $("#total_fiturpricing").html(jum + ' Features');
                    $("#fitur_pricing").html(fiturnya);
                } else {
                    $("#total_fiturpricing").html(' No Features Avaliable');
                }



            },
            error: function (result) {
                console.log("Cant Show Detail User");
            }
        });

    }


    var readURLuser = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_pricing').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



    $("#file_img_pricing").on('change', function () {
        readURLuser(this);
    });

    $("#browse_img_pricing").on('click', function () {
        $("#file_img_pricing").click();
    });


    $("#file_img_pricing_edit").on('change', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_pricing_edit').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#browse_img_pricing_edit").on('click', function () {
        $("#file_img_pricing_edit").click();
    });


    //dropdown fitur add
    $('#add_tipepricing').change(function () {
        var itempilih = this.value;
        if (itempilih == 1) {
            $("#hide_fitur_add").show(); //div colum
            $("#hide_multi_add").show();
            $("#fiturpricing").hide();
        } else {
            $("#hide_fitur_add").show(); //div colum
            $("#hide_multi_add").hide();
            $("#fiturpricing").show();
        }
    });







    //dropdown list fitur
    function get_list_fitur_pricing() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_fitur_pricing",
            type: "POST",
            dataType: "json",
            success: function (result) {
                console.log(result);

                var listfitur = '';

                $.each(result, function (i, item) {
                    listfitur += '<div class="form-check pricing">' +
                        '<small class="form-check-label cgrey" data-toggle="tooltip" data-placement="top" title="'+item.description+'">' +
                        '<input type="checkbox" class="form-check-input" id="fiturcek_'+item.id+'" name="multi_fiturpricing[]" value="' + item.id +'">' +
                        item.title +'<i class="input-helper"></i></small></div >';
                });
                $("#show_ceklist_fitur").html(listfitur);

                // __________________________________________

                // $('#multi_fiturpricing').empty();
                // $('#multi_fiturpricing').append("<option disabled> Choose</option>");
                // for (var i = result.length - 1; i >= 0; i--) {
                //     $('#multi_fiturpricing').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                // }
                // //Short Function Ascending//
                // $("#multi_fiturpricing").html($('#multi_fiturpricing option').sort(function (x, y) {
                //     return $(x).text() < $(y).text() ? -1 : 1;
                // }));

                // $("#multi_fiturpricing").get(0).selectedIndex = 0;
                // // $("#multi_fiturpricing").bsMultiSelect();  //multiselect

                // const Oldfitur = "{{old('multi_fiturpricing')}}";

                // if (Oldfitur !== '') {
                //     $('#multi_fiturpricing').val(Oldfitur);
                // }
                // _____________________________________________________________

                $('#fiturpricing').empty();
                $('#fiturpricing').append("<option disabled> Choose</option>");
                for (var i = result.length - 1; i >= 0; i--) {
                    $('#fiturpricing').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#fiturpricing").html($('#fiturpricing option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#fiturpricing").get(0).selectedIndex = 0;

                const Oldfiturq = "{{old('fiturpricing')}}";

                if (Oldfiturq !== '') {
                    $('#fiturpricing').val(Oldfiturq);
                }
                // _____________________________________________________________

                  var editfitur = '';

                $.each(result, function (i, item) {
                    editfitur += '<div class="form-check pricing">' +
                        '<small class="form-check-label cgrey" data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<input type="checkbox" class="form-check-input rmpricing" id="edit_fitur_' + item.id + '" name="edit_multi_fiturpricing[]" value="' + item.id + '">' +
                        item.title + '<i class="input-helper"></i></small></div >';
                });
                $("#edit_show_ceklist_fitur").html(editfitur);

                // $('#edit_multi_fiturpricing').empty();
                // $('#edit_multi_fiturpricing').append("<option disabled selected> Choose</option>");
                // for (var i = result.length - 1; i >= 0; i--) {
                //     $('#edit_multi_fiturpricing').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                // }
                // //Short Function Ascending//
                // $("#edit_multi_fiturpricing").html($('#edit_multi_fiturpricing option').sort(function (x, y) {
                //     return $(x).text() < $(y).text() ? -1 : 1;
                // }));

                // $("#edit_multi_fiturpricing").get(0).selectedIndex = 0;
                // // $("#edit_multi_fiturpricing").bsMultiSelect();  //multiselect

                // const Oldfitur2 = "{{old('edit_multi_fiturpricing')}}";

                // if (Oldfitur2 !== '') {
                //     $('#edit_multi_fiturpricing').val(Oldfitur);
                // }
                // _____________________________________________________________

                $('#fiturpricing_edit').empty();
                $('#fiturpricing_edit').append("<option disabled> Choose</option>");
                for (var i = result.length - 1; i >= 0; i--) {
                    $('#fiturpricing_edit').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#fiturpricing_edit").html($('#fiturpricing_edit option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#fiturpricing_edit").get(0).selectedIndex = 0;

                const Oldfiturqedit = "{{old('fiturpricing_edit')}}";

                if (Oldfiturqedit !== '') {
                    $('#fiturpricing_edit').val(Oldfiturqedit);
                }

            }
        });
    } //endfunction




</script>

@endsection
