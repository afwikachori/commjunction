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
    <div id="page_pricing_management_super"></div>
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
                                        <th><b>ID</b></th>
                                        <th><b>Pricing Name</b></th>
                                        <th><b>Monthly Price</b></th>
                                        <th><b>Annual Price</b></th>
                                        <th><b>Type</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Total Feature</b></th>
                                        <th><b>Action</b></th>
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
                                <img src="/img/fitur.png" class="rounded-circle img-fluid" id="img_logo_pricing"
                                    onerror="this.onerror=null;this.src='/img/fitur.png';">
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
                                            name="fileup" accept="image/*"/>
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

                                <div id="hide_multi_add"
                                    style="display: none;overflow-y: auto;overflow-x: auto; height:190px;">
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

                <div class="modal-body"
                    style="padding-left: 5%;padding-right: 5%; padding-bottom: 0px; padding-top: 0px;">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control input-abu" id="id_pricing_edit" name="id_pricing_edit"
                                type="hidden">
                            <div class="img-upload-profil" style="margin-top: -1.5em; margin-bottom: 5em;">
                                <div class="circle editpricing">
                                    <img id="view_img_pricing_edit"
                                        class="profile-pic editpricing rounded-circle img-fluid" src="/img/fitur.png"
                                        onerror="this.onerror=null;this.src='/img/fitur.png';">
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
                                <div id="hide_multi_edit"
                                    style="display: none;overflow-y: auto;overflow-x: auto; height:140px;">
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
