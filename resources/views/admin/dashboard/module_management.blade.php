@extends('layout.admin-dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Module Management</h3>

    <nav aria-label="breadcrumb">
        <!-- <button type="button" class="btn btn-tosca btn-sm">Add New Module</button> -->
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
                                <div id="show_module_active" class="card-deck">

                                    <!--  <div class="col-md-4 stretch-card grid-margin card-member">
                <div class="card bg-gradient-success card-img-holder text-white member">
                  <div class="card-body member">
                  <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <label class="badge label-oren float-right">Active</label>
                    <img src="'+logo+'" class="rounded-circle img-fluid img-card">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Judul Module</h4>
                    </div>
                    <div class="col-md-12" style="text-align: right;">
                      <a href="/admin" class="a_setmodule">
                        <small lang="en" class="txt_detail_fitur h6 s11 cputih"> Setting
                        <i class="mdi mdi-circle" aria-hidden="true"></i>
                      </small></a>
                    </div>
                  </div>
              </div></div></div> -->

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
<div class="modal fade" id="mdl_detail_module_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff; min-height: 350px; padding-left: 3%; padding-right: 3%;">
            <div class="modal-header" style="padding-bottom: 2em !important; border:none;">
                <h3 class="modal-title cgrey">Setting Module</h3>
                <label class="badge melengkung10px btn-tosca cputih" style="min-width:100px;"> Active</label>
            </div> <!-- end-header -->

            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <small class="cgrey1 tebal name_setting">Setting Name</small>
                                <p class="clight s13 deskripsi_setting">
                                    Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie.
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <input type="text" name="param_setting" class="form-control input-abu param_setting">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <small class="cgrey1 tebal name_setting">Setting Name</small>
                                <p class="clight s13 deskripsi_setting">
                                    Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie.
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <input type="text" name="param_setting" class="form-control input-abu param_setting">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <small class="cgrey1 tebal name_setting">Setting Name</small>
                                <p class="clight s13 deskripsi_setting">
                                    Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie.
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <input type="text" name="param_setting" class="form-control input-abu param_setting">
                        </div>
                    </div>


                </form>
            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <a href="t" type="button" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i>Activate</a>
                </center>
            </div> <!-- end-footer     -->
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
                                        <a class="nav-item cus-a nav-link s10 active" id="nav_tab_1" data-toggle="tab" href="#nav_tabisi_1" role="tab"
                                            aria-controls="nav_tab_1" aria-selected="true" lang="en"><small>Onetime</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_2" data-toggle="tab" href="#nav_tabisi_2" role="tab"
                                            aria-controls="nav_tab_2" aria-selected="false" lang="en"><small>Monthly</small></a>
                                        <a class="nav-item cus-a nav-link s10" id="nav_tab_3" data-toggle="tab" href="#nav_tabisi_3" role="tab"
                                            aria-controls="nav_tab_3" aria-selected="false" lang="en"><small>Annual</small></a>
                                    </div>
                                </nav>
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show s12 active" id="nav_tabisi_1" role="tabpanel" aria-labelledby="nav_tab_1">
                                        <div id="harga_grand"></div>
                                    </div>

                                    <div class="tab-pane fade s12" id="nav_tabisi_2" role="tabpanel" aria-labelledby="nav_tab_2">
                                        <div id="harga_bulanan"></div>
                                    </div>

                                    <div class="tab-pane fade s12" id="nav_tabisi_3" role="tabpanel" aria-labelledby="nav_tab_3">
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
                            <div class="card-deck show_subfitur_module" 
                            style="width:100%;">
                                <!-- mulai -->
                                <!-- <div class="col-md-6 stretch-card grid-margin"
                                    style="margin-right: -2em; margin-bottom: 0.5em;">
                                    <div class="card bg-gradient-blue card-img-holder text-white">
                                        <div class="card-body" style="padding: 1rem 0.5rem 1rem 0.5rem !important;">
                                            <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"
                                                alt="circle-image" />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="/img/cam.png" class="rounded-circle img-fluid img-card2">
                                                </div>
                                                <div class="col-md-8">
                                                    <small>Judul Module</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- end -->
                            </div>
                        </div> <!-- end-row deck -->
                    </div>
                    <!-- end -->
                </div>
            </div><!-- end-body -->

            <form method="POST" id="form_aktivasi_module"
            action="{{route('aktifasi_module_admincomm')}}"> {{ csrf_field() }}
                <input type="hidden"  name="id_modulefitur" id="id_modulefitur">
                <input type="hidden" name="payment_time" id="payment_time">
                <input type="hidden" name="payment_method_id" id="payment_method_id">

            <div class="modal-footer" style="border: none;">
                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                    <i class="mdi mdi-check btn-icon-prepend"></i>
                    Activate</button>
                </center>
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
        get_module_active();
        get_module_all();

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

                $.each(result, function (i, item) {
                    var logo = server_cdn + item.logo;
                    isiui +=
                        '<div class="col-md-4 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<button class="btn btn-sm badge btn-oren melengkung10px" style="position:absolute; margin-bottom:-1em; right:5%;"'+
                        'onclick="detail_module_all(\'' + item.feature_id + '\')">'+
                        '<small>Ready</small></button><br>' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid img-card">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<h4>' + item.feature_type_title + '</h4>' +
                        '</div>' +
                        '<div class="col-md-12" style="text-align: right;">' +
                        '<a href="" class="a_setmodule"' +
                        'data-toggle="modal" data-target="#mdl_detail_module_active" data-dismiss="modal">' +
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                        ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                        '</small></a>' +
                        '</div>' +
                        '</div></div></div></div>';
                });

                $("#show_module_active").html(isiui);

            },
            error: function (result) {
                console.log("Cant Show Module List");
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

                var isiui = '';
                var nomer = 0;
                $.each(result, function (i, item) {
                    nomer++;
                    var logo = server_cdn + item.logo;
                    if(item.status == true){
                    isiui +=
                            '<div class="col-md-4 stretch-card ' +
                            'grid-margin card-member' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<label class="badge btn-gradient-ijo melengkung10px float-right">Ready</label>' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid img-card">' +
                            '<div class="row">' +
                            '<div class="col-md-12">' +
                            '<h4>' + item.feature_type_title + '</h4>' +
                            '</div>' +
                            '<div class="col-md-12" style="text-align: right;">' +
                            '<a href="" class="a_setmodule"' +
                            'data-toggle="modal" data-target="#mdl_detail_module_active" data-dismiss="modal">' +
                            '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                            ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                            '</small></a>' +
                            '</div>' +
                            '</div></div></div></div>';
                    }else{
                    isiui += '<div class="col-md-4 stretch-card ' +
                         'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid img-card">' +
                        '<div class="row">' +
                        '<div class="col-md-7">' +
                        '<h4>' + item.feature_type_title + '</h4>' +
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
                console.log("Cant Show Module List");
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
                //form aktivasi
                $("#id_modulefitur").val(dt.feature_id);
                $("#payment_time").val();
                $("#payment_method_id").val();

                $("#logo_fitur_module").attr("src", server_cdn+dt.logo);
                $("#module_name").html(dt.title);
                $("#module_name1").html(dt.title);
                $("#module_deskripsi").html(dt.description);
                $("#module_tipe").html(dt.feature_type_title);

                //status aktif
                var isistatus= '';
                if(dt.status == false){
                isistatus = '<label class="badge melengkung10px bg-abu cputih" '+
                            'style="min-width:100px;"> Not Active</label >';
                }else{
                isistatus = '<label class="badge melengkung10px bg-ijo cputih" ' +
                            'style="min-width:100px;"> Active</label >';
                }
                $(".status_aktif").html(isistatus);

                //pricing
                if (dt.price_annual != 0) {
                    $("#harga_tahunan").html("Rp " + rupiah(dt.price_annual));
                } else {
                    $("#harga_tahunan").html('<center class="tebal cgrey">Free');
                }

                if (dt.price_monthly != 0){
                    $("#harga_bulanan").html("Rp " + rupiah(dt.price_monthly));
                } else {
                    $("#harga_bulanan").html('<center class="tebal cgrey">Free');
                }

                if (dt.grand_pricing != 0) {
                    $("#harga_grand").html("Rp " + rupiah(dt.grand_pricing));
                } else {
                    $("#harga_grand").html('<center class="tebal cgrey">Free');
                }

                var subf = '';
                var jum = 0;
                $.each(dt.subfeature, function (i, item) {
                    // console.log(item);
                    var colum;
                    jum++;

                    subf += '<div class="col-md-6 stretch-card grid-margin' +
                        'data-toggle="tooltip" data-placement="top" title="'+item.description+'"'+
                        'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                        '<div class="card bg-gradient-blue card-img-holder text-white">' +
                        '<div class="card-body" style="padding: 1rem 0.5rem 1rem 0.5rem !important;">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                        'alt="circle-image" /> ' +
                        '<div class="row">' +
                        '<div class="col-md-4">' +
                        '<img src="'+server_cdn+item.logo+'" class="rounded-circle img-fluid img-card2">' +
                        '</div>' +
                        '<div class="col-md-8">' +
                        '<small>'+item.title+'</small>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });
                $(".show_subfitur_module").html(subf);

                $("#md_all_aktifkan_module").modal("show");
            },
            error: function (result) {
                console.log("Cant Show Detail Module");
            }
        });
    }




</script>

@endsection
