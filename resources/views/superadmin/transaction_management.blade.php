@extends('layout.superadmin')

@section('title', 'Transaction Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-settings"></i>
        </span>Transaction Management</h3>

    <nav aria-label="breadcrumb">
        <!-- <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal" data-target="#modal_add_usertype">Add
            Transaction List</button> -->
    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="accordion" id="tab_transaction_param">
                    <div class="card">
                        <div class="card-header row" id="headingOne" style="background-color: white; border: none;">
                            <div class="col-md-10">
                                <h4 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" role="button"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                        style="color:#0e6f73;">
                                        Choose Parameter First &nbsp;
                                        <i class="mdi mdi-chevron-down cteal"></i>
                                    </a>
                                </h4>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <button type="button" id="reset_tbl_trans" style="width: 25px; height: 25px;"
                                    class="btn btn-abu btn-icon btn-sm melengkung10px" data-toggle="modal"
                                    data-target="#modal_detail_trans" data-dismiss="modal">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#tab_transaction_param">
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">Community Name</small>
                                                <select class="form-control input-abu" name="komunitas" id="komunitas">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">Start Date</small>
                                                <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                                    class="form-control input-abu">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">End Date</small>
                                                <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                                    class="form-control input-abu">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight">Transaction Type</small>
                                                <select class="form-control input-abu" name="tipe_trans"
                                                    id="tipe_trans">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <small class="clight"> Transaction Status</small>
                                                <select class="form-control input-abu" name="status_trans"
                                                    id="status_trans">
                                                    <option value="null"> Choose </option>
                                                    <option value="1"> Pending </option>
                                                    <option value="2"> Approval </option>
                                                    <option value="3"> Cancel </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group subs_name">
                                                <small class="clight">Subscriber</small>
                                                <select class="form-control input-abu" name="subs_name" id="subs_name">
                                                    <option selected disabled> Choose Community First</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="text-align: right !important;">
                                        <button type="button" onclick="tabel_tes()"
                                            class="btn btn-teal btn-tosca btn-sm melengkung10px"
                                            style="margin-top: 2%;">
                                            <i class="mdi mdi-check btn-icon-prepend">
                                            </i> Show
                                        </button>
                                    </div>
                                </form>
                            </div><!-- end-card-body -->
                        </div>
                    </div>
                </div>

                <div class="showin_table_trans" style="display: none;">
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" id="btn_filter_trans" class="btn btn-tosca btn-sm"
                                style="min-width: 120px; margin-bottom: 1em;">Filter</button>
                        </div>
                        <div class="col-md-4" style="text-align: right;">
                            <button type="button" id="reset_tbl_subsall"
                                class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                                <i class="mdi mdi-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <!-- tabel -->
                    <table id="tabel_trans" class="table table-hover table-striped dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Transaction Date</th>
                                <th>Subcriber Name</th>
                                <th>Community Name</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- end tabel  -->
                </div>

            </div>
        </div>
    </div>
</div>



<!-- MODAL DETAIL TRASACTION-->
<div class="modal fade" id="modal_detail_trans" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%; max-width: 900px;">
        <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="text-align: right; margin-right: 5px;">
            <span aria-hidden="true">&times;</span>
        </button>

            <div class="modal-body" style="padding:25px; min-height: 550px; height: auto; padding: 5px 25px 0px 25px;">
                <div class="row">
                    <div class="col-md-6 col-sm-12" style="border-right: 1px solid #E0E0E0; height: 100%;">
                        <h4 class="tebal cgrey2">Detail Transaction</h4>

                        <h5 class="cblue" style="margin-bottom: 1em;">INV3414223131231232</h5>

                        <small class="clight">Transaction Date</small>
                        <p class="cgrey2">2020-02-28</p>

                        <div class="row">
                            <div class="col-md-2" style="padding-right: 1px;">
                                <img src="/img/cam.png" class="rounded-circle img-fluid" style="width: 40px;">
                            </div>
                            <div class="col-md-4" style="padding: 0px;">
                                <small class="clight">Community Name</small>
                                <p class="cgrey2">Brian Community</p>
                            </div>
                            <div class="col-md-2" style="padding-right: 10px; padding-left: 0px; text-align: right;">
                                <img src="/img/def-profil.png" class="rounded-circle img-fluid" style="width: 40px;">
                            </div>
                            <div class="col-md-4" style="padding: 0px;">
                                <small class="clight">Subcriber Name</small>
                                <p class="cgrey2">Bpk Anggriawan</p>
                            </div>
                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Param Name</small>
                                <p class="cgrey2">Content or value</p>
                            </div>
                        </div>

                        <div class="footer_mdl" style="text-align: right; margin-top: 22%;">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                style="border-radius: 10px;">
                                <i class="mdi mdi-close"></i> Cancel
                            </button>
                            &nbsp;
                            <button type="button" class="btn btn-teal btn-sm">
                                <i class="mdi mdi-check btn-icon-prepend"></i>
                                Download</button>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-12" style="height: 100%;">
                        <div style="text-align: right;">
                            <small class="clight" style="margin-top: 0.5em;">Payment Status</small> &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-tosca melengkung10px btn-sm">
                            Paid</button>
                        </div>

                        <br>
                        <h5 class="cgrey tebal">Payment Confirmation</h5>
                        <div class="row" style="padding: 0 5% 0 5%;">
                            <div class="col-md-12" style="height: 115px; background-color: lavender; border-radius: 10px;">

                            </div>
                        </div>
                        <div class="row" style="margin-top: 0.5em;">
                            <div class="col-md-4">
                                <small class="clight">Account Name</small>
                                <p class="cgrey2">Lala Marion Jola</p>
                            </div>
                            <div class="col-md-4">
                                 <small class="clight">Account Number</small>
                                <p class="cgrey2">0822414121</p>
                            </div>
                            <div class="col-md-4">
                                <small class="clight">Bank Name</small>
                                <p class="cgrey2">Bank BCA</p>
                            </div>
                        </div>

                        <br>

                        <h5 class="cgrey tebal">Payment Confirmation</h5>
                        <div class="row" style="padding: 0 5% 0 5%;">
                            <div class="col-md-12" style="height: 115px; background-color: lavender; border-radius: 10px;">

                            </div>
                        </div>
                        <div class="row" style="margin-top: 0.5em;">
                            <div class="col-md-6">
                                <small class="clight">Approver Name</small>
                                <p class="cgrey2">Lia Safitri</p>
                            </div>
                            <div class="col-md-6">
                                <small class="clight">Approved Date</small>
                                <p class="cgrey2">20-02-2020</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- end-body -->

        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        session_logged_superadmin();

        get_list_komunitas();
        get_list_transaction_tipe();

        // tabel_tes();
    });

    function tabel_tes() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/show_tabel_transaksi',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "komunitas": $("#komunitas").val(),
                "tanggal_mulai": $("#tanggal_mulai").val(),
                "tanggal_selesai": $("#tanggal_selesai").val(),
                "tipe_trans": $("#tipe_trans").val(),
                "status_trans": $("#status_trans").val(),
                "subs_name": $("#subs_name").val()
            },
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }




    function detail_usertype_manage(idini) {
        alert(idini);
        // $("#modal_edit_usertype").modal("show");

        // $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //       url: '/admin/detail_user_management',
        //       type: 'POST',
        //       datatype: 'JSON',
        //       data: {
        //       "user_id": iduser
        //       },
        //       success: function (result) {

        //       },
        //       error: function (result) {
        //         console.log("Cant Show Detail User");
        //     }
        // });
    }



    //dropdown komunitas list
    function get_list_komunitas() {
        // SUBSCRIBER DROPDOWN HIDE
        $('.subs_name').hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_komunitas",
            type: "POST",
            dataType: "json",
            success: function (result) {


                $('#komunitas').empty();
                $('#komunitas').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas").html($('#komunitas option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komunitas").get(0).selectedIndex = 0;

                const OldKomunitas = "{{old('komunitas')}}";

                if (OldKomunitas !== '') {
                    $('#komunitas').val(OldKomunitas);
                }
            }
        });
    } //endfunction




    //dropdown tipe_trans list
    function get_list_transaction_tipe() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_transaction_tipe",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#tipe_trans').empty();
                $('#tipe_trans').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#tipe_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#tipe_trans").html($('#tipe_trans option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#tipe_trans").get(0).selectedIndex = 0;

                const OldTipetrans = "{{old('tipe_trans')}}";

                if (OldTipetrans !== '') {
                    $('#tipe_trans').val(OldTipetrans);
                }
            }
        });
    } //endfunction





    //dropdown subs_name list
    $('#komunitas').change(function () {
        var itempilih = this.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/superadmin/get_list_subcriber_name",
            type: "POST",
            dataType: "json",
            data: {
                "community_id": itempilih,
            },
            success: function (result) {
                // console.log(result);
                $('.subs_name').fadeIn("fast");
                $('#subs_name').empty();
                $('#subs_name').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#subs_name').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#subs_name").html($('#subs_name option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#subs_name").get(0).selectedIndex = 0; const
                    OldSubs = "{{old('subs_name')}}"; if (OldSubs !== '') { $('#subs_name').val(OldSubs); }
            },
            error: function (result) {
                $('.subs_name').fadeOut("fast");
            }
        });
    });
    //end list subscriber


    function show_tabel_transaksi() {
        // $('#tabel_subscriber').dataTable().fnClearTable();
        // $('#tabel_subscriber').dataTable().fnDestroy();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tabel = $('#tabel_trans').DataTable({
            responsive: true,
            ajax: {
                url: '/superadmin/show_tabel_transaksi',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                data: {
                    "subs_datemulai": $("#subs_datemulai").val(),
                    "komunitas": $("#komunitas").val(),
                    "tanggal_mulai": $("#tanggal_mulai").val(),
                    "tanggal_selesai": $("#tanggal_selesai").val(),
                    "tipe_trans": $("#tipe_trans").val(),
                    "status_trans": $("#status_trans").val(),
                    "subs_name": $("#subs_name").val()
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    // $('#tabel_subscriber tbody').;
                    $('#tabel_subscriber tbody').empty().append(nofound);
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
                        // console.log(data);
                        var isiku;
                        if (data == null) {
                            isiku = '<label style="color:red;">null</label>';
                        } else {
                            isiku = data.membership;
                        }
                        return isiku;
                    }
                },
                { mData: 'full_name' },
                {
                    mData: 'status',
                    render: function (data, type, row) {
                        // console.log(data);
                        var isihtml;
                        if (data == 1) { //first-login
                            isihtml = '<label class="badge badge-gradient-info">Newly</label>';
                        } else if (data == 2) {
                            isihtml = '<label class="badge badge-gradient-warning">Pending Membership</label>';
                        }
                        else if (data == 3) {
                            isihtml = '<label class="badge badge-gradient-success">Active</label>';
                        }
                        else if (data == 4) {
                            isihtml = '<label class="badge badge-gradient-secondary">Deactive</label>';
                        } else {
                            isihtml = '<label class="badge badge-gradient-danger">Pending</label>';
                        }

                        return isihtml;
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return formatDate(data);
                    }
                },
                {
                    mData: 'user_id',
                    render: function (data, type, row, meta) {
                        // console.log(data);
                        return '<a href="/admin/detail_subscriber/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                            '<i class="mdi mdi-eye matadetail"></i>' +
                            '</a>';
                    }
                }
            ],

        });
        $("#subs_datemulai").val("");
        $("#subs_dateselesai").val("")
        $("#modal_filter_date_subs").modal('hide');
    }


</script>

@endsection
