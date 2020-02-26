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
            style="min-width: 120px; margin-bottom: 1em;">Add Pricing</button>
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


<!-- MODAL FILTER TRANSAKSI-->
<div class="modal fade" id="modal_detail_pricing_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">

            <form>
                <div class="modal-header" style="padding-left: 5%;padding-right: 5%;">
                    <h4 class="modal-title cgrey">Filter Transaction</h4>
                </div> <!-- end-header -->

                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Community Activity</small>
                                <select class="form-control input-abu" name="list_komunitas" id="list_komunitas">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">User Level</small>
                                <select class="form-control input-abu" name="list_userlevel" id="list_userlevel">
                                    <option selected disabled> Choose </option>
                                    <option value="1"> Admin Commjuction </option>
                                    <option value="2"> Admin Community </option>
                                    <option value="3"> Subscriber</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Start Date</small>
                                <input type="date" id="tanggal_mulai2" name="tanggal_mulai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">End Date</small>
                                <input type="date" id="tanggal_selesai2" name="tanggal_selesai2"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight s13">Feature</small>
                                <select class="form-control input-abu" name="list_fitur" id="list_fitur">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="showin_subfitur">
                                <small class="clight s13">Sub-Feature</small>
                                <select class="form-control input-abu" name="list_subfitur" id="list_subfitur">

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
                    &nbsp;
                    <button type="button" id="btn_filter_log_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Filter </button>
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
        tabel_tes();
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
                        var isine= '';
                        if(dt == 0){
                            isine = '<label class="badge bg-abu melengkung10px cwhite">Deactive</label>';
                        }else if(dt == 1){
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
                            return '<center>'+totalfitur+'</center>';
                        } else if (totalfitur == 1) {
                            return '<center>'+totalfitur + '  Feature </center>';
                        } else {
                            return '<center>'+totalfitur + '  Features </center>';
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
        alert(idku);

    }

</script>

@endsection
