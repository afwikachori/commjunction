@extends('layout.support-master')
@section('title', 'Reactivate/Deactivate ')
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Subscriber Management</h3>

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
                            </div>
                            <br>

                            <!-- tabel all susbcriber -->
                            <table id="tabel_komunitas_support"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Logo</th>
                                        <th>Community Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 150px; margin-bottom: 1em;">Choose Community</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" id="reset_tbl_subsall"
                                        class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- tabel all susbcriber -->
                            <table id="tabel_subs_pending" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Subscriber</th>
                                        <th>Membership</th>
                                        <th>Subcriber Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
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


<!-- MODAL REACTIVE-->
<div class="modal fade" id="modal_update_active" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">


            <div style="padding-left: 15%; padding-top: 5%;">
                <img src="/visual/kananatas2.png" class="img-mdl-top">
                <small class="modal-title cgrey2">Detail Inquiry</small>
                <br>
                <h4 class=" cblue">Activity Log</h4>
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

        $('#tabel_komunitas_support').DataTable().clear().destroy();
         $('#tabel_komunitas_support').empty();

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
                        if(data == 0 ){
                              return '<small class="cgrey s13">Newly</small>';
                        }else if(data == 1){
                             return '<small class="cgrey s13">First Login</small>';
                        }else{
                            return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                        }

                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-eye"></i></button>',
                        "targets": -1
                    }
                ],

        });

        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_komunitas_support tbody').on('click', 'button', function () {
            $(status_komunitas).val("");
            var data = tabel.row($(this).parents('tr')).data();
            console.log(data);
            console.log(data.status);

            var stat = data.status;
            if(stat == 4){
                 $('#status_active').attr("checked", false);
            }else{
             $('#status_active').attr("checked", true);
            }

            $("#modal_update_active").modal('show');
            $("#id_komunitas").val(data.id);
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
</script>

@endsection
