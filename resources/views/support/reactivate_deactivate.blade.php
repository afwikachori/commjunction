@extends('layout.support-master')
@section('title', 'Reactivate/Deactivate ')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Reactive or Deactive</h3>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_com">
                            <a href="#tab_default_1" data-toggle="tab">
                                Community
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_subs">
                            <a href="#tab_default_2" data-toggle="tab">
                                Subscriber
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <small class="clight s13">Community Status</small>
                                    <select class="form-control list-blue" name="status_komunitas" id="status_komunitas"
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
                            </div>
                            <br>

                            <!-- tabel all susbcriber -->
                            <table id="tabel_komunitas_support"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b>ID</b></th>
                                        <th><b>Logo</b></th>
                                        <th><b>Community Name</b></th>
                                        <th><b>Description</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Date Created</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <small class="clight s13">Choose Community</small>
                                    <select class="form-control list-blue" name="list_komunitas" id="list_komunitas"
                                        required>
                                        <option selected disabled> Loading ... </option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <!-- tabel all susbcriber -->
                            <table id="tabel_subscriber" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th><b>ID Subscriber</b></th>
                                        <th><b>Photo</b></th>
                                        <th><b>Subcriber Name</b></th>
                                        <th><b>username</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Created Date</b></th>
                                        <th><b>Membership</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- MODAL REACTIVE KOMUNITAS-->
<div class="modal fade" id="modal_update_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div style="padding-left: 15%; padding-top: 5%;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Reactive or Deactive</small>
                <br>
                <h4 class=" cblue">Community</h4>
            </div>

            <form method="POST" id="form_acc_req_membership" action="{{route('change_status_reactive')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body detail_member">
                    <center>
                        <div class="up_acc_file">
                            <img id="view_img_member" class="profile-pic img-fluid accmember" onclick="clickImage(this)"
                                src="">
                            <br>
                            <small class="clight">Please upload file for confirmation</small>
                            <br>
                            <div class="p-image accmember">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="accmember" style="width: 38px; height: 38px;">
                                    <i id="browse_acc_member" class="mdi mdi-camera upload-button accmember"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                                <input id="file_acc_member" class="file-upload file-upload-default accmember"
                                    type="file" name="fileup" accept="image/*" />
                            </div>

                        </div>
                    </center>
                    <div class="form-group">
                        <small class="clight">Active Status</small><br>
                        <div class="custom-control custom-switch toggle-switch">
                            <input type="checkbox" class="custom-control-input" id="status_active" name="status_active">
                            <label class="custom-control-label " for="status_active"></label>
                        </div>
                        <small class="cgrey tebal" id="stat_deactive_kom" style="display: none;"> Deactive </small>
                        <span id="status_label_kom"></span>
                    </div>
                    <div class="form-group">
                        <small class="clight">Confirmation Comment</small>
                        <textarea class="form-control input-abu" id="acc_komen" name="acc_komen" rows="2"></textarea>
                    </div>
                    <input type="hidden" name="id_komunitas" id="id_komunitas">
                    <input type="hidden" id="status_komunitas">

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_change_status" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Update </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>

<!-- MODAL REACTIVE SUBS-->
<div class="modal fade" id="modal_reactive_subscriber" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div style="padding-left: 15%; padding-top: 5%;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Reactive or Deactive</small>
                <br>
                <h4 class=" cblue">Subscriber</h4>
            </div>

            <form method="POST" id="form_reactive_subs" action="{{route('change_reactive_subscriber')}}"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-body detail_member">
                    <center>
                        <div class="up_acc_file">
                            <img id="view_img_subs" class="profile-pic img-fluid accmember" onclick="clickImage(this)"
                                src="">
                            <br>
                            <small class="clight">Please upload file for confirmation</small>
                            <br>
                            <div class="p-image accmember">
                                <button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon"
                                    value="accmember" style="width: 38px; height: 38px;">
                                    <i id="browse_acc_subs" class="mdi mdi-camera upload-button accmember"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                                <input id="file_acc_subs" class="file-upload file-upload-default accmember" type="file"
                                    name="fileup" accept="image/*" />
                            </div>

                        </div>
                    </center>
                    <div class="form-group">
                        <small class="clight">Active Status</small><br>
                        <div class="custom-control custom-switch toggle-switch">
                            <input type="checkbox" class="custom-control-input" id="status_active_subs"
                                name="status_active_subs">
                            <label class="custom-control-label" for="status_active_subs"></label>
                        </div>
                        <small class="cgrey tebal" id="stat_deactive_subs" style="display: none;"> Deactive </small>
                        <span id="status_label_subs" style="display: none;"></span>
                    </div>
                    <div class="form-group">
                        <small class="clight">Confirmation Comment</small>
                        <textarea class="form-control input-abu" id="acc_komen_subs" name="acc_komen_subs"
                            rows="2"></textarea>
                    </div>
                    <input type="hidden" name="id_komunitas_subs" id="id_komunitas_subs">
                    <input type="hidden" name="id_subs" id="id_subs">
                    <input type="hidden" id="status_subs">

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none;padding-right: 30%; padding-bottom:5%; padding-top: 0px;">
                    <img src="/visual/kiribawah2.png" class="img-mdl-bottom">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Update </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {


        if ($('#status_komunitas').val() == "all") {
            get_list_komunitas_support("all");
        }


    });

    $('#status_komunitas').change(function () {
        var item = $(this);
        var id_status = item.val();

        get_list_komunitas_support(id_status);
    });


    function get_list_komunitas_support(id_status) {
         get_dropdownlist_komunitas_support();

        $('#tabel_komunitas_support').DataTable().clear().destroy();
        $('#tabel_komunitas_support').empty();

        var heads = '<thead>' +
                    '<tr>' +
                    '<th><b>ID</b></th>' +
                    '<th><b>Logo</b></th>' +
                    '<th><b>Community Name</b></th>' +
                    '<th><b>Description</b></th>' +
                    '<th><b>Status</b></th>' +
                    '<th><b>Date Created</b></th>' +
                    '<th><b>Action</b></th>' +
                    '</tr>' +
                    '</thead>';

        $('#tabel_komunitas_support').html(heads);

        var tabel = $('#tabel_komunitas_support').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', {
                    text: 'JSON',
                    action: function (e, dt, button, config) {
                        var data = dt.buttons.exportData();

                        $.fn.dataTable.fileSave(
                            new Blob([JSON.stringify(data)]),
                            'Export.json'
                        );
                    }
                }
            ],
            responsive: true,
            paging: false,
            fixedHeader: {
                header: true,
            },
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: "/support/get_list_komunitas_support",
                type: "POST",
                dataSrc: '',
                data: {
                    "community_status": id_status
                },
                //   success: function (result) {
                //     console.log('tabel com ');
                //     console.log(result);
                // },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_komunitas_support tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_komunitas_support tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    mData: 'logo',
                    render: function (data, type, row, meta) {
                        var noimg = '/img/kosong.png'
                        var pic = server_cdn + cekimage_cdn(data);
                        return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                    }
                },
                {
                    mData: 'name',
                    render: function (data, type, row, meta) {
                        return data;
                    }
                },
                {
                    mData: 'description',
                    render: function (data, type, row, meta) {
                        return '<span class="s12 text-wrap">' + data + '</span>';
                    }
                },
                {
                    mData: 'status_title',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-300">' + data + '</span>';
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
                {
                    mData: 'status',
                    render: function (data, type, row, meta) {
                        if (data == 0) {
                            return '<small class="cgrey s13">Newly</small>';
                        } else if (data == 1) {
                            return '<small class="cgrey s13">First Login</small>';
                        } else {
                            return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                                '<i class="mdi mdi-lead-pencil"></i>' +
                                '</button>';
                        }

                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-lead-pencil"></i></button>',
                        "targets": -1
                    }
                ],

        });


        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_komunitas_support tbody').on('click', 'button', function () {
            $("#status_komunitas").val("");
            $("#status_label_kom").html("");
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            var stat = data.status;
            var uistat = '';
            if (stat == 4) {
                $('#status_active').attr("checked", false);
                uistat = '<small class="cgrey tebal"> Deactive </small>';
            } else {
                if (stat == 2) {
                    uistat = '<small class="cblue tebal"> Active </small>';
                } else if (stat == 3) {
                    uistat = '<small class="cblue tebal"> Published </small>';
                }
                $('#status_active').attr("checked", true);
            }
            $("#status_label_kom").html(uistat);

            $("#modal_update_active").modal('show');
            $("#id_komunitas").val(data.id);
        });


        $("#status_active").on('change', function () {
            if ($(this).is(':checked')) {
                $("#status_label_kom").show();
                $("#stat_deactive_kom").hide();
            }
            else {
                $("#stat_deactive_kom").show();
                $("#status_label_kom").hide();
            }
        });

    } //endfunction



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


    function get_dropdownlist_komunitas_support() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/support/get_list_komunitas_support",
            type: "POST",
            dataType: "json",
            data: {
                "community_status": "all"
            },
            success: function (result) {
                console.log(result);

                $('#list_komunitas').empty();
                if (result.success == false && result.code == "CMQ01") {
                    $('#list_komunitas').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_komunitas').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_komunitas").get(0).selectedIndex = 0;
                }
            }
        });
    } //endfunction



    $('#list_komunitas').change(function () {
        var item = $(this);
        var id_kom = item.val();

        get_list_subscriber_support(id_kom);
    });




    function get_list_subscriber_support(id_kom) {

        $('#tabel_subscriber').DataTable().clear().destroy();
        $('#tabel_subscriber').empty();

        var heads = '<thead><tr>' +
                    '<th><b>ID Subscriber</b></th>' +
                    '<th><b>Photo</b></th>' +
                    '<th><b>Subcriber Name</b></th>' +
                    '<th><b>username</b></th>' +
                    '<th><b>Status</b></th>' +
                    '<th><b>Date Created</b></th>' +
                    '<th><b>Membership</b></th>'+
                    '<th><b>Action</b></th>' +
                    '</tr></thead>';

        $('#tabel_subscriber').html(heads);


        var tabel = $('#tabel_subscriber').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', {
                    text: 'JSON',
                    action: function (e, dt, button, config) {
                        var data = dt.buttons.exportData();

                        $.fn.dataTable.fileSave(
                            new Blob([JSON.stringify(data)]),
                            'Export.json'
                        );
                    }
                }
            ],
            responsive: true,
            paging: false,
            fixedHeader: {
                header: true,
            },
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: "/support/get_list_subscriber_support",
                type: "POST",
                dataSrc: '',
                data: {
                    "community_id": id_kom
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_subscriber tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_subscriber tbody').empty().append(nofound);

            },
            columns: [
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-300">' + data + '</span>';
                    }
                },
                {
                    mData: 'sso_picture',
                    render: function (data, type, row, meta) {
                        var noimg = '/img/kosong.png';
                        var pic = server_cdn + cekimage_cdn(data);
                        return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgsprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                    }
                },
                {
                    mData: 'full_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13  text-wrap width-100">' + data + '</span>';
                    }
                },
                {
                    mData: 'user_name',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + data + '</span>';
                    }
                },
                {
                    mData: 'status',
                    render: function (data, type, row, meta) {
                        if (data == 0) {
                            return '<small class="cgrey s13 text-wrap width-100">Newly</small>';
                        } else if (data == 1) {
                            return '<small class="cgrey s13 text-wrap width-100">First Login</small>';
                        } else if (data == 2) {
                            return '<small class="cgrey s13 text-wrap width-100">Pending Membership</small>';
                        } else if (data == 3) {
                            return '<small class="cgrey s13 text-wrap width-100">Active</small>';
                        } else {
                            return '<small class="cgrey s13 text-wrap width-100">Deactive</small>';
                        }

                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return '<span class="s13">' + dateFormat(data) + '</span>';
                    }
                },
                {
                    mData: 'membership',
                    render: function (data, type, row, meta) {
                        if (data != null) {
                            return '<small class="cgrey s13">' + data.membership + '</small>';
                        } else {
                            return '<small class="cgrey s13"> - </small>';
                        }

                    }
                },
                {
                    mData: 'status',
                    render: function (data, type, row, meta) {
                        if (data == 0) {
                            return '<small class="cgrey s13">Newly</small>';
                        } else if (data == 1) {
                            return '<small class="cgrey s13">First Login</small>';
                        } else if (data == 2) {
                            return '<small class="cgrey s13">Pending Membership</small>';
                        } else {
                            return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                                '<i class="mdi mdi-lead-pencil"></i>' +
                                '</button>';
                        }

                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-lead-pencil"></i></button>',
                        "targets": -1
                    }
                ],

        });


        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_subscriber tbody').on('click', 'button', function () {
            $("#status_subs").val("");
            $("#status_label_subs").html("");
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);

            var stat = data.status;
            var uistat = '';
            if (stat == 4) {
                $('#status_active_subs').attr("checked", false);
                uistat = '<small class="cgrey tebal"> Deactive </small>';
            } else {
                uistat = '<small class="cblue tebal"> Active </small>';
                $('#status_active_subs').attr("checked", true);
            }
            $("#status_label_subs").html(uistat).show();

            $("#modal_reactive_subscriber").modal('show');
            $("#id_komunitas_subs").val(id_kom);
            $("#id_subs").val(data.user_id);
            $("#status_subs").val(data.status);
        });

        $("#status_active_subs").on('change', function () {
            if ($(this).is(':checked')) {
                $("#status_label_subs").show();
                $("#stat_deactive_subs").hide();
            }
            else {
                $("#stat_deactive_subs").show();
                $("#status_label_subs").hide();
            }
        });

    } //endfunction



    $("#file_acc_subs").on('change', function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#view_img_subs').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#view_img_subs').show();
        }
    });

    $("#browse_acc_subs").on('click', function () {
        $("#file_acc_subs").click();
    });



</script>

@endsection
