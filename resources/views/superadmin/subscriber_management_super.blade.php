@extends('layout.superadmin')

@section('title', 'Subscriber Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span> Subscriber Management</h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Subscriber Management</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">Registrasion Data</li> -->
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">


                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="tab-subs active" id="tab_all">
                            <a href="#tab_default_1" data-toggle="tab">
                                All
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_pending">
                            <a href="#tab_default_2" data-toggle="tab">
                                Pending
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                        data-target="#modal_generate_komunitas" data-dismiss="modal">Generate</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable"
                                        onclick="reset_subs_all()">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>


                            <!-- tabel all susbcriber -->
                            <div id="tabel_show_subs_hide" style="display: none;">
                                <table id="tabel_show_subs" class="table table-hover table-striped dt-responsive nowrap"
                                    style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>ID Subscriber</th>
                                            <th>Subscriber Name</th>
                                            <th>Membership</th>
                                            <th>Join Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;" data-toggle="modal"
                                        data-target="#modal_generate_pending" data-dismiss="modal">Generate</button>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <!-- <button type="button" class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable" onclick="reset_subs_all()">
                                        <i class="mdi mdi-refresh"></i>
                                    </button> -->
                                </div>
                            </div>
                            <!-- tabel all susbcriber -->
                            <div id="tabel_subs_pending_hide" style="display: none;">
                                <table id="tabel_subs_pending"
                                    class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
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
                            </div>
                            <!-- end tabel all  -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- MODAL GENERATE  FILTER SUBSCRIBER -->
<div class="modal fade" id="modal_generate_komunitas" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Subcriber Management</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row" style="margin-top: 2em; margin-bottom: 1em;">
                        <div class="col-md-4">
                            <center>
                                <label class="cgrey2" style="margin-top: 1em;">
                                    Community
                                </label>
                            </center>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control input-abu" name="komunitas_list" id="komunitas_list">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    <!-- &nbsp;
                    <button type="button" id="btn_filter_transaksi" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button> -->
                </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->

    </div>
</div>

<!-- MODAL GENERATE  FILTER SUBSCRIBER -->
<div class="modal fade" id="modal_generate_pending" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Generate Subcriber Management</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row" style="margin-top: 2em; margin-bottom: 1em;">
                        <div class="col-md-4">
                            <center>
                                <label class="cgrey2" style="margin-top: 1em;">
                                    Community
                                </label>
                            </center>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control input-abu" name="komunitas_list2" id="komunitas_list2">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    <!-- &nbsp;
                    <button type="button" id="btn_filter_transaksi" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button> -->
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

        get_list_komunitas_superadmin();

    }); //end


    //dropdown komunitas_list list
    function get_list_komunitas_superadmin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_subs_komunitas_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                // console.log(result);
                $('#komunitas_list').empty();
                $('#komunitas_list').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_list').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_list").html($('#komunitas_list option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#komunitas_list").get(0).selectedIndex = 0;
                const OldSubs1 = "{{old('komunitas_list')}}";
                if (OldSubs1 !== '') {
                    $('#komunitas_list').val(OldSubs1);
                }
                // ______________________________
                $('#komunitas_list2').empty();
                $('#komunitas_list2').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_list2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_list2").html($('#komunitas_list2 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#komunitas_list2").get(0).selectedIndex = 0;
                const OldSubs2 = "{{old('komunitas_list2')}}";
                if (OldSubs2 !== '') {
                    $('#komunitas_list2').val(OldSubs2);
                }

            },
            error: function (result) {
                ui.popup.show('Warning', 'Get list community', 'Warning');
            }
        });
    }

    $('#komunitas_list').change(function () {
        var item = $(this);
        var idkom = item.val();
        tabel_subscriber_commjuction(idkom);
    });

    $('#komunitas_list2').change(function () {
        var item = $(this);
        var idkom = item.val();
        tabel_subs_pending_super(idkom);
    });



    function tabel_subscriber_commjuction(idkomunitas) {
        $('#tabel_show_subs_hide').show();
        $('#tabel_show_subs').dataTable().fnClearTable();
        $('#tabel_show_subs').dataTable().fnDestroy();

        var tabel = $('#tabel_show_subs').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_subscriber_comm_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": idkomunitas,
                }, timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_show_subs tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },

            columns: [
                { mData: 'user_id' },
                { mData: 'full_name' },
                {
                    mData: 'membership',
                    render: function (data, type, row, meta) {
                    return data.membership;
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
                        var stat = '';
                        if (data == 0) {
                            var stat = 'Waiting Approval';
                        } else if (data == 1) {
                            stat = 'Approved';
                        } else if (data == 2) {
                            stat = 'Pending Membership';
                        } else if (data == 3) {
                            stat = 'Active';
                        } else {
                            stat = 'Nonactive';
                        }
                        return stat;

                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_subs_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });
        $("#modal_generate_komunitas").modal('hide');

    }

    function reset_subs_all() {
        $('#tabel_show_subs_hide').hide();
        $('#tabel_show_subs').dataTable().fnClearTable();
        $('#tabel_show_subs').dataTable().fnDestroy();
        $("#komunitas_list").val("");
    }


    function tabel_subs_pending_super(idkomunitas) {
        $('#tabel_subs_pending_hide').show();
        $('#tabel_subs_pending').dataTable().fnClearTable();
        $('#tabel_subs_pending').dataTable().fnDestroy();

        var tabel = $('#tabel_subs_pending').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_subs_pending_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "community_id": idkomunitas,
                }, timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_subs_pending tbody').empty().append(nofound);
                },
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
            },

            columns: [
                { mData: 'user_id' },
                {
                    mData: 'membership',
                    render: function (data, type, row, meta) {
                        if (data == null) {
                            var shw = 'Tidak Ada';
                        } else {
                            var shw = data;
                        }
                        return shw;
                    }
                },
                { mData: 'full_name' },
                {
                    mData: 'status',
                    render: function (data, type, row, meta) {
                        var stat = '';
                        if (data == 0) {
                            var stat = 'Waiting Approval';
                        } else if (data == 1) {
                            stat = 'Approved';
                        } else if (data == 2) {
                            stat = 'Pending Membership';
                        } else if (data == 3) {
                            stat = 'Active';
                        } else {
                            stat = 'Nonactive';
                        }
                        return stat;
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_subs_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });
        $("#modal_generate_pending").modal('hide');

    }



</script>

@endsection
