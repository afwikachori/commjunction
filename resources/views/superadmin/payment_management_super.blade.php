@extends('layout.superadmin')

@section('title', 'Payment Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-credit-card"></i>
        </span> Payment Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
            data-target="#modal_add_new_payment_super">
            Add Payment</button>
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
                                Active
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- <button type="button" id="btn-filter-subs" class="btn btn-tosca btn-sm"
                                        style="min-width: 120px; margin-bottom: 1em;">Filter</button> -->
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <button type="button" id="reset_tbl_subsall"
                                        class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- tabel all -->
                            <table id="tabel_payment_all_super"
                                class="table table-hover table-striped dt-responsive wrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Payment</th>
                                        <th>Payment Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->


                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <!-- tabel active -->
                            <table id="tabel_payment_active_super"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Payment</th>
                                        <th>Payment Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel active  -->


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- MODAL FILTER RECONCILE REPORT SUPER -->
<div class="modal fade" id="modal_add_new_payment_super" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header" style="padding-left: 5%;padding-right: 5%; border: none;">
                <h4 class="modal-title cgrey">Add Payment</h4>
            </div> <!-- end-header -->
            <form method="POST" id="form_add_payment_super" action="{{route('add_payment_management_super')}}">
                {{ csrf_field() }}
                <div class="modal-body" style="padding-left: 5%;padding-right: 5%;">

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Payment Name</small>
                                <input type="text" id="nama_pay" name="nama_pay" class="form-control input-abu">
                            </div>

                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Payment Type</small>
                                <select class="form-control input-abu" name="tipe_pay" id="tipe_pay">
                                    <option selected disabled> Choose </option>
                                </select>
                            </div>

                        </div> <!-- end-col-md -->
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="cdarkgrey s13 tebal" style="margin-bottom: 0.5em;">Payment Information</h6>
                            <div class="form-group">
                                <small class="clight s13">Payment Description</small>
                                <textarea type="text" id="deskripsi_pay" name="deskripsi_pay"
                                    class="form-control input-abu" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Montly</small>
                                <input type="text" id="harga_bulanan_pay" name="harga_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Price Annual</small>
                                <input type="text" id="harga_tahunan_pay" name="harga_tahunan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>


                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Montly</small>
                                <input type="text" id="min_bulanan_pay" name="min_bulanan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->

                        <div class="col-md">
                            <div class="form-group">
                                <small class="clight s13">Minimum Annual</small>
                                <input type="text" id="min_tahunan_pay" name="min_tahunan_pay"
                                    class="form-control input-abu">
                            </div>
                        </div> <!-- end-col-md -->
                    </div>

                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-bottom: 1em;">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i> Cancel
                    </button>
                    &nbsp;
                    <button type="submit" id="btn_add_payment_super" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Add </button>
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
        tabel_payment_all_super();
        tabel_payment_active_super();
    });  //end


    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_payment_all_super',
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




    function tabel_payment_all_super() {
        var tabel = $('#tabel_payment_all_super').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_payment_all_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_all_super tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_all_super tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                {
                    mData: 'description', width: 100,
                    render: function (data, type, row, meta) {
                         return "<div class='text-wrap width-450'>" + data + "</div>";
                    },
                    targets: 3
                },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
        });

    }


    function detail_payment_all_super(idpay) {
        alert(idpay);
    }


    function tabel_payment_active_super() {
        var tabel = $('#tabel_payment_active_super').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/superadmin/tabel_payment_active_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_payment_active_super tbody').empty().append(nofound);
                },
            },
            success: function (result) {
                console.log(result);
            },
            error: function (request, status, errorThrown) {
                console.log(errorThrown);
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_active_super tbody').empty().append(nofound);

            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                { mData: 'description' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_payment_active_super(\'' + data + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

        });

    }


    function detail_payment_active_super(idpay) {
        alert(idpay);
    }


</script>

@endsection
