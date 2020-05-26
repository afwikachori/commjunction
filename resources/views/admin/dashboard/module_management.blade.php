@extends('layout.admin-dashboard')
@section('title', 'Module Management')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span lang="en">Module Management</h3>

    <nav aria-label="breadcrumb">
        <!-- <button type="button" id="btn_show_payment" class="btn btn-teal btn-sm" data-toggle="modal"
            data-target="#modal_pay_module" data-dismiss="modal">
            <i class="mdi mdi-check btn-icon-prepend">
            </i> Pay </button> -->
    </nav>
</div>

<div class="row">
    <div id="page_module_management"></div>
    <div class="col-12">
        <div class="card">
            <div class="card-body memberku">
                <h4 class="cgrey" style="margin-bottom: -0.5em;" lang="en">Module List</h4>

                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="tab-subs active" id="tab_active">
                            <a href="#tab_module_1" data-toggle="tab">
                                <span lang="en">Active</span>
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_all">
                            <a href="#tab_module_2" data-toggle="tab">
                                <span lang="en">All</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_module_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <small class="text-muted" lang="en">Total : </small> &nbsp;
                                    <h4 class="card-title text-success" id="total_module_active"> 0 </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div id="nodata_module_active"
                                    style="display: none; min-height: 230px; margin-left: auto; margin-right: auto;">
                                    <br><br><br>
                                    <center>
                                        <h1 class="clight" lang="en">No Data Available</h1>
                                    </center>
                                </div>
                                <div id="show_module_active" class="card-deck">

                                </div>
                            </div><!-- endrow -->
                        </div> <!-- end-tab 1  -->


                        <div class="tab-pane" id="tab_module_2">

                            <small class="text-muted" lang="en"> Total : </small>
                            <h4 class="card-title text-success" id="total_module"> 0 </h4>


                            <div class="row" style="margin-top: 1.5em;">
                                <div id="nodata_module_all"
                                    style="display: none; min-height: 230px; margin-left: auto; margin-right: auto;">
                                    <br><br><br>
                                    <center>
                                        <h1 class="clight" lang="en">No Data Available</h1>
                                    </center>
                                </div>
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
                <h3 class="modal-title cgrey" lang="en">Setting Module</h3>
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
                            <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i><span lang="en">Submit</span></button>
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
                <h4 class="modal-title cgrey" lang="en">Detail Module</h4>
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
                                        <h4 class="cwhite" style="margin-top: 0.5em;" id="module_name1" lang="en">Module
                                            Title</h4>
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
                                    <small class="clight" lang="en">Module Name</small>
                                    <p class="cgrey1 tebal s13" id="module_name">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <small class="clight" lang="en">Module Type</small>
                                    <p class="cgrey1 tebal s13" id="module_tipe">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small class="clight" lang="en">Description</small>
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
                                            aria-selected="true" lang="en"><small lang="en">Onetime</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_2" data-toggle="tab"
                                            href="#nav_tabisi_2" role="tab" aria-controls="nav_tab_2"
                                            aria-selected="false" lang="en"><small lang="en">Monthly</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_3" data-toggle="tab"
                                            href="#nav_tabisi_3" role="tab" aria-controls="nav_tab_3"
                                            aria-selected="false" lang="en"><small lang="en">Annual</small></a>
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
                        <small class="clight" lang="en">Module Sub-Features</small>
                        <div id="nosubfitur"
                            style="display: none; position: absolute; margin-left: auto; margin-right: auto; left: 0; right: 0;">
                            <h2 class="clight" style="text-align: center; margin-top: 3em;" lang="en">No Subfeature</h2>
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
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <button type="button" id="btn_aktivasi_showhide" onclick="cek_pay_module(this)" data-dismiss="modal"
                        class="btn btn-teal btn-sm" style="display: none;">
                        <i class="mdi mdi-check btn-icon-prepend"></i><span lang="en">Activate</span></button>
                </center>
            </div> <!-- end-footer     -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


<!-- MODAL PAYMENT MODULE -->
<div id="modal_pay_module" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_pay_module"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
            <form method="POST" id="form_aktivasi_module" action="{{route('aktifasi_module_admincomm')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id_modulefitur" id="id_modulefitur">

                <div class="modal-body" style="min-height: 400px; height: auto; padding-left: 5%; padding-right: 5%;">
                    <h3 class="cgrey" style="margin-bottom: 1em;" lang="en">Choose Payment</h3>
                    <div class="row" style="margin-bottom: 0.5em;">
                        <div class="col-md-4">
                            <h6 class="h6 clight" lang="en">Choose Payment Time</h6>
                            <select id="payment_time_module" class="form-control input-abu" name="payment_time_module"
                                required>
                                <option disabled selected lang="en">Choose</option>
                                <option value="1" lang="en">Onetime</option>
                                <option value="2" lang="en">Monthly</option>
                                <option value="3" lang="en">Annual</option>
                            </select>
                        </div>
                        <div class="col-md-8" style="margin-top: auto; margin-bottom: auto;">
                            <span class="h5 cblue" id="text_sekali" style="display: none;"> </span>
                            <span class="h5 cblue" id="text_bulanan" style="display: none;"> </span>
                            <span class="h5 cblue" id="text_tahunan" style="display: none;"> </span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="h6 clight" lang="en">Choose Payment Method</h6>
                            <div class="row" style="padding-left: 5%; margin-top: -0.3em;">
                                <div id="isi_method_pay">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h6 class="h6 clight" style="margin-bottom:1em;" lang="en">Bank Transfer</h6>
                            <div id="isi_show_bank" class="collapse-accordion" role="tablist"
                                aria-multiselectable="true"
                                style="overflow-y: auto; overflow-x: hidden; height:230px; padding-right: 12px;">

                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pay_method_module" id="id_pay_method_module">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" lang="en">Close</button>
                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod"
                        lang="en">Submit</button>
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

    });




</script>

@endsection
