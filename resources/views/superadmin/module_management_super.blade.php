@extends('layout.superadmin')

@section('title', 'Module Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Module Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_create_new_module"
            data-dismiss="modal">Add New Module</button>
        <button type="button" class="btn btn-abu btn-sm" data-toggle="modal" data-target="#modal_add_endpoint_module"
            data-dismiss="modal">Add Endpoint</button>
    </nav>
</div>

<div class="row">
    <div id="page_module_management"></div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body memberku">
                <div class="row" style="margin-bottom: 1em;">
                    <div class="col-lg-10 col-md-8 col-sm-6">
                        <h4 class="cgrey" style="margin-bottom: -0.5em;">Module List</h4>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6" style="margin-top: 0.5em;">
                        <small class="text-muted"> Total : </small>
                        <h4 class="card-title text-success" id="total_module"> 0 </h4>

                    </div>
                </div>

                <div id="show_module_all_super" class="card-deck">

                </div>

            </div>
        </div>
    </div>
</div>






<!-- MODAL ALL -detail-->
<div class="modal fade" id="md_all_aktifkan_module" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0em !important; border:none;">
                <h4 class="modal-title cgrey">Detail Module</h4>
                <div class="status_aktif"></div>
            </div> <!-- end-header -->

            <div class="modal-body" style="padding:30px;">
                <div class="row">
                    <div class="col-md-12 stretch-card grid-margin">
                        <div class="card bg-gradient-blue card-img-holder text-white">
                            <div class="card-body" style="padding: 1rem 1rem !important;">
                                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <div class="row">
                                    <div class="col-md-5 kanan" style="padding-right: 1px;padding-left: 1.5em;">
                                        <img src="/img/cam.png" id="logo_fitur_module"
                                            class="rounded-circle img-fluid img-fitur-module" alt=""
                                            onerror = "this.onerror=null;this.src='/img/fitur.png';">
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
                        <small class="clight">Module Features</small>
                        <div class="row">
                            <div class="card-deck show_subfitur_module" style="width:100%;overflow-y: scroll; overflow-x: hidden; height:250px;">

                            </div>
                        </div> <!-- end-row deck -->
                    </div>
                    <!-- end -->
                </div>
            </div><!-- end-body -->

            <div class="modal-footer" style="border: none; padding:35px">
                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                </center>
            </div> <!-- end-footer     -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>




<!-- -- ADD CREATE MODULE ADMIN COMMUCTION -- -->
<div class="modal fade" id="modal_create_new_module" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: auto; max-width:900px;">
        <div class="modal-content">

            <form method="POST" id="form_create_new_module" action="{{route('add_create_new_module')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body" style="padding: 3%;">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <h4 class="cdarkgrey tebal">Add New Module</h4>
                            <div class="row" style="margin-bottom: 3em;">
                                <div class="col-md-6 col-sm-12">
                                    <br>
                                    <div class="img-upload-profil">
                                        <div class="circle module">
                                            <img id="view_img_module" class="profile-pic rounded-circle img-fluid"
                                                src="/img/focus.png">
                                        </div>
                                        <div class="p-image module">
                                            <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                                value="editprofil" style="width: 30px; height: 30px;">
                                                <i id="browse_img_module" class="mdi mdi-camera upload-button"></i>
                                            </button>
                                            <input id="file_img_module" class="file-upload file-upload-default"
                                                type="file" name="fileup" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="text-align: right;">
                                    <br>
                                    <br>
                                    <small class="clight">Click to edit</small>
                                    <h6 class="tebal s12">Max File Size 2Mb</h6>
                                </div>
                            </div>

                            <div class="form-group">
                                <small class="cgrey">Title</small>
                                <input type="text" id="judul_modul" name="judul_modul" class="form-control input-abu">
                            </div>

                            <div class="form-group">
                                <small class="cgrey">Description</small>
                                <textarea class="form-control input-abu" id="dekripsi_modul" name="dekripsi_modul"
                                    rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <small class="cgrey">Feature Type</small>
                                <select class="form-control input-abu" id="fitur_tipe" name="fitur_tipe">
                                    <option selected disabled>Choose</option>
                                    <option value="1">Mandatory</option>
                                    <option value="1">Basic</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-md-8 col-sm-12">
                            <h4 class="cdarkgrey tebal">Add Sub Module</h4>


                            <small class="cgrey">Input for sub-module</small>

                            <div class="row form-group">
                                <div class="col-md-5 col-sm-12">
                                    <input type="text" name="sub1[]" class="form-control input-abu" placeholder="Title">
                                </div>
                                <div class="col-md-7 col-sm-12" style="padding-left:0px;">
                                    <input type="text" name="sub1[]" class="form-control input-abu"
                                        placeholder="Description">
                                </div>
                            </div>

                            <div id="isi_newrow">

                            </div>

                            <center>
                                <button type="button" class="btn btn-icon-text" id="addnewrow">
                                    <i class="mdi mdi-plus-circle" style="color: #50C9C3;"></i>
                                    <small>Add New Row</small> </button>
                            </center>

                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding:3%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Submit </button>
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>





<!-- MODAL ENDPOINT-->
<div class="modal fade" id="modal_add_endpoint_module" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <form method="POST" id="form_add_usertype" action="{{route('add_endpoint_module')}}">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border:none;">
                    <h4 class="modal-title cdarkgrey">New Endpoint Module</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding-left: 5%;padding-right: 5; min-height: 300px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="cgrey">Endpoint</small>
                                <input type="text" id="endpoint" name="endpoint" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Directory</small>
                                <input type="text" id="directory" name="directory" value="/module/example/controllers/"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Function</small>
                                <input type="text" id="function" name="function" value="delete"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Subfeature ID</small>
                                <input type="text" id="subfiturid" name="subfiturid" value="154"
                                    class="form-control input-abu">
                            </div>
                        </div> <!--  end-6 -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="cgrey">Method</small>
                                <select class="form-control input-abu" id="method" name="method">
                                    <option selected disabled>Choose</option>
                                    <option value="POST">POST</option>
                                    <option value="GET">GET</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Controller</small>
                                <input type="text" id="controller" name="controller" value="example"
                                    class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Auth</small>
                                <input type="text" id="auth" name="auth" value="1" class="form-control input-abu">
                            </div>
                            <div class="form-group">
                                <small class="cgrey">Body</small>
                                <input type="text" id="bodyku" name="bodyku" value="1" class="form-control input-abu">
                            </div>
                        </div>
                    </div>


                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; padding-left: 5%;padding-right: 5%; margin-bottom: 2%;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Add </button>
                </div>
            </div>
        </div>
    </form>
</div>






@endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function () {



    });




</script>

@endsection
