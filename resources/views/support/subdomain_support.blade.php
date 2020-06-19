@extends('layout.support-master')
@section('title', 'Subdomain')
@section('content')

<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Subdomain</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your information for Subdomain<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
        </nav>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 450px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <small class="clight s13">Community Status</small>
                        <select class="form-control list-blue" name="status_komunitas" id="status_komunitas" required>
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
                <table id="tabel_komunitas_support" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b>ID</b></th>
                            <th><b>Logo</b></th>
                            <th><b>Community Name</b></th>
                            <th><b>Subdomain</b></th>
                            <th><b>Status Subdomain</b></th>
                            <th><b>Status</b></th>
                            <th><b>Date Created</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div>
        </div>
    </div>
</div> <!-- endrow -->

<!-- MODAL CHANGE STATUS DOMAIN-->
<div class="modal fade" id="modal_change_status_domain" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff; min-height: 250px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                style="text-align: right; margin-right: 5px;">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                <center>
                    <img src="/img/logout.png" id="img_signout_superadmin">
                    <h4 class="cgrey">Change Comfirmation</h4>
                    <small class="clight">Are you sure, you want to delete ?</small>
                </center>
            </div>
            <div class="modal-footer changepass" style="border: none; text-align: center;">
                <center>

                    <form method="POST" id="form_change_status_domain" action="{{route('change_status_subdomain')}}">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_community" name="id_community">

                        <button type="submit" value="false" name="status_domain" class="btn btn-teal btn-sm"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> Reject
                        </button>
                        &nbsp;

                        <button type="submit" value="true" name="status_domain" class="btn btn-tosca btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> Approve </button>
                    </form>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

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

        var thead = '<tr>' +
            '<th><b>ID</b></th>' +
            '<th><b>Logo</b></th>' +
            '<th><b>Community Name</b></th>' +
            '<th><b>Subdomain</b></th>' +
            '<th><b>Status Subdomain</b></th>' +
            '<th><b>Status</b></th>' +
            '<th><b>Date Created</b></th>' +
            '<th><b>Action</b></th>' +
            '</tr>';

        $('#tabel_komunitas_support').html(thead);

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
                    mData: 'subdomain',
                    render: function (data, type, row, meta) {
                        if (data == null || data == "null") {
                            return '<center><span class="s12 text-wrap"> - </span></center>';
                        } else {
                            return '<span class="s12">' + data + '</span>';
                        }

                    }
                },
                {
                    mData: 'status_pending_subdomain_title',
                    render: function (data, type, row, meta) {
                        if (data == "Pending") {
                            return '<label class="badge bg-abu cwhite">' + data + '</label>';
                        } else if (data == "Accept") {
                            return '<label class="badge bg-tosca cwhite"> Accept </label>';
                        } else {
                            return '<label class="badge bg-red cwhite"> Reject </label>';
                        }

                    }
                },
                {
                    mData: 'status_title',
                    render: function (data, type, row, meta) {
                        return '<span class="s13 text-wrap width-100">' + data + '</span>';
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
                            // } else if (data == 1) {
                            //     return '<small class="cgrey s13">First Login</small>';
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

            var data = tabel.row($(this).parents('tr')).data();

            console.log(data);
            $("#id_community").val(data.id);
            $("#modal_change_status_domain").modal("show");
        });

    } //endfunction

</script>

@endsection
