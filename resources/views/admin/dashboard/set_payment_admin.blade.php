@extends('layout.admin-dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h3 class="page-title s22 cgrey" style="font-weight: bold;" lang="en">Community Setting</h3>
    </div>
    <div class="col-md-9">
        <label class="cgrey" lang="en">Publish Community to Live<label>
    </div>
</div>
<br>
<div class="row" style="margin-top: 1em;">
    <div class="col-12">
        <div class="card">
            <div class="card-header putih">
                <div class="row">
                    <div class="col-md-8" style="margin-top: 0.5em;">
                        <h4 class="cgrey tebal" lang="en">Subscriber Payment</h4>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <button type="button" id="btn_add_payment" class="btn btn-tosca btn-sm"
                            style="margin-top: 0.5em;" lang="en">Add Payment</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- tabel all susbcriber -->
                <table id="tabel_paysubs" class="table table-hover table-striped dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th><b lang="en">ID Pay</b></th>
                            <th><b lang="en">Payment Title</b></th>
                            <th><b lang="en">Bank Name</b></th>
                            <th><b lang="en">Status</b></th>
                            <th><b lang="en">Action</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- end tabel all  -->
            </div>
        </div>
    </div>



    <!-- MODAL ADD PAYMENT-->
    <div class="modal fade" id="modal_add_payment" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #ffffff;">

                <div class="modal-header" style="border: none;">
                    <center>
                        <h4 class="modal-title cgrey" lang="en">Add Payment Type</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="form_add_payment_subs" action="{{route('add_payment_subs')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Name</label>
                                    <input type="text" id="payment_name" name="payment_name"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Type</label>
                                    <select class="form-control input-abu" id="payment_tipe" name="payment_tipe">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Account Holder Name</label>
                                    <input type="text" id="rekening_name" name="rekening_name"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Rekening Number</label>
                                    <input type="text" id="rekening_number" name="rekening_number"
                                        class="form-control input-abu">
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <small lang="en">Description</small>
                                <textarea class="form-control input-abu" id="deskripsi_paysubs" name="deskripsi_paysubs"
                                    rows="2"></textarea>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Bank Name</label>
                                    <select class="form-control input-abu" id="bank_name" name="bank_name">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label lang="en">Payment Time Limit</label>
                                    <select class="form-control input-abu" id="pay_time_limit" name="pay_time_limit"
                                        value="{{old('pay_time_limit')}}">
                                        <option selected disabled lang="en">Choose</option>
                                        <option value="1" lang="en">1 Day</option>
                                        <option value="2" lang="en">2 Days</option>
                                        <option value="3" lang="en">3 Days</option>
                                        <option value="4" lang="en">4 Days</option>
                                        <option value="5" lang="en">5 Days</option>
                                        <option value="6" lang="en">6 Days</option>
                                        <option value="7" lang="en">7 Days</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Status</label>
                                    <select class="form-control input-abu" id="payment_status" name="payment_status"
                                        value="{{old('payment_status')}}">
                                        <option selected disabled lang="en">Choose</option>
                                        <option value="1" lang="en">Active</option>
                                        <option value="0" lang="en">Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end-body -->
                    <div class="modal-footer" style="border: none; margin-top: -1.5em;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" id="btn_add_paysubs" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> <span lang="en">Add</span> </button>
                    </div> <!-- end-footer     -->
                </form>
            </div> <!-- END-MDL CONTENT -->
        </div>
    </div>

    <!-- MODAL DETAIL PAYMENT SUBS  -->
    <div class="modal fade" id="modal_detail_paymentsubs" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal" style="background-color: #ffffff;">

                <div class="modal-header" style="border-bottom: none;">
                    <h4 class="modal-title cgrey" lang="en">Detail Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="height: auto; min-height: 300px; padding-left: 5%; padding-right: 5%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Payment Name</small>
                                <p class="cgrey2" id="detail_nama_pay"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Payment Type</small>
                                <p class="cgrey2" id="detail_tipe_pay"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Account Holder Name</small>
                                <p class="cgrey2" id="detail_owner"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Rekening Number</small>
                                <p class="cgrey2" id="detail_no_rekening"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <small class="clight" lang="en">Description</small>
                            <p class="cgrey2" id="detail_deskripsi"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Bank Name</small>
                                <p class="cgrey2" id="detail_bank"></p>
                            </div>
                            <div class="form-group">
                                <small class="clight" lang="en">Payment Time Limit</small>
                                <p class="cgrey2" id="detail_timelimit"></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="clight" lang="en">Payment Status</small>
                                <p class="cgrey2" id="detail_status"></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end-body -->

                <div class="modal-footer" style="border: none; margin-top: -1em; margin-bottom: 0.5em;">
                    <form method="POST" id="form_delete_paysubs" action="{{route('delete_payment_subs')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_paymentsubs" id="id_paymentsubs">
                        <button type="submit" class="btn bg-merah melengkung10px btn-sm"
                            style="text-align: right; width: 100px;">
                            <i class="mdi mdi-delete btn-icon-prepend">
                            </i> <span lang="en">Delete</span> </button>
                    </form>
                    &nbsp;
                    <button class="btn btn-tosca btn-sm" style="width: 100px;" data-toggle="modal"
                        data-target="#modal_edit_payment" data-dismiss="modal">
                        <i class="mdi mdi-lead-pencil">
                        </i> <span lang="en">Edit</span></button>
                </div> <!-- end-footer     -->
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PAYMENT-->
    <div class="modal fade" id="modal_edit_payment" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #ffffff;">

                <div class="modal-header" style="border: none;">
                    <center>
                        <h4 class="modal-title cgrey" lang="en">Edit Payment Type</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="form_edit_payment_subs" action="{{route('edit_payment_subs')}}">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control input-abu" id="id_subs_payment" name="id_subs_payment">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Name</label>
                                    <input type="text" id="edit_payment_name" name="edit_payment_name"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Type</label>
                                    <select class="form-control input-abu" id="edit_payment_tipe"
                                        name="edit_payment_tipe">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Account Holder Name</label>
                                    <input type="text" id="edit_rekening_name" name="edit_rekening_name"
                                        class="form-control input-abu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Rekening Number</label>
                                    <input type="text" id="edit_rekening_number" name="edit_rekening_number"
                                        class="form-control input-abu">
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <small lang="en">Description</small>
                                <textarea class="form-control input-abu" id="edit_deskripsi_paysubs"
                                    name="edit_deskripsi_paysubs" rows="2"></textarea>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Bank Name</label>
                                    <select class="form-control input-abu" id="edit_bank_name" name="edit_bank_name">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label lang="en">Payment Time Limit</label>
                                    <div class="row">
                                        <div class="col-6" style="padding-right: 2px;">
                                            <input type="text" class="form-control input-abu" id="edit_pay_time_limit"
                                                name="edit_pay_time_limit" value="{{old('edit_pay_time_limit')}}">
                                        </div>
                                        <div class="col-6" style="text-align: left; padding-top: 10px;">
                                            <small class="clight"
                                                style="margin-top: 1em; margin-left: -1em;" lang="en">Days</small>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label lang="en">Payment Status</label>
                                    <select class="form-control input-abu" id="edit_payment_status"
                                        name="edit_payment_status" value="{{old('edit_payment_status')}}">
                                        <option selected disabled lang="en">Choose</option>
                                        <option value="1" lang="en">Active</option>
                                        <option value="0" lang="en">Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end-body -->
                    <div class="modal-footer" style="border: none; margin-top: -1.5em;">
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-close"></i> <span lang="en">Cancel</span>
                        </button>
                        &nbsp;
                        <button type="submit" id="btn_edit_paysubs" class="btn btn-teal btn-sm">
                            <i class="mdi mdi-check btn-icon-prepend">
                            </i> <span lang="en">Edit</span> </button>
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
            get_result_setup_comsetting();
            tabel_payment_community();
            // tabel_tes();
            get_payment_tipe();
            get_bank_pay();
        });

        function tabel_tes() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/tabel_payment_community',
                type: 'POST',
                datatype: 'JSON',
                success: function (result) {
                    console.log(result);
                },
                error: function (result) {
                    console.log("Cant Show DataTable");
                }
            });
        }


        $("#btn_add_payment").click(function (e) {
            $("#modal_add_payment").modal("show");
        });



        function tabel_payment_community() {
            var tabel = $('#tabel_paysubs').DataTable({
                responsive: true,
                language: {
                    paginate: {
                        next: '<i class="mdi mdi-chevron-right"></i>',
                        previous: '<i class="mdi mdi-chevron-left">'
                    }
                },
                ajax: {
                    url: '/admin/tabel_payment_community',
                    type: 'POST',
                    dataSrc: '',
                    timeout: 30000,
                },
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_paysubs tbody').empty().append(nofound);
                },
                columns: [
                    { mData: 'id' },
                    { mData: 'payment_title' },
                    { mData: 'payment_bank_name' },
                    {
                        mData: 'status',
                        render: function (data, type, row, meta) {
                            var ket = '';
                            if (data == 0) {
                                ket = '<label class="badge bg-abu round-label">Deactive</label>';
                            } else {
                                ket = '<label class="badge bg-tosca round-label">Active</label>';
                            }
                            return ket;
                        }
                    },
                    {
                        mData: null,
                        render: function (data, type, row, meta) {
                            return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                                '<i class="mdi mdi-eye"></i>' +
                                '</button>';
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
            $('#tabel_paysubs tbody').on('click', 'button', function () {
                var dt = tabel.row($(this).parents('tr')).data();
                console.log(dt);
                $("#id_paymentsubs").val(dt.id);

                var pay = dt.comm_payment_type;

                $("#detail_nama_pay").html(dt.payment_title);
                $("#detail_tipe_pay").html(pay.payment_title);
                $("#detail_owner").html(dt.payment_owner_name);
                $("#detail_no_rekening").html(dt.payment_account);
                $("#detail_deskripsi").html(dt.description[0]);
                $("#detail_bank").html(dt.payment_bank_name);
                $("#detail_timelimit").html(dt.payment_time_limit + " Days");
                if (dt.status == 0) {
                    var isista = "Deactive";
                } else {
                    var isista = "Active";
                }
                $("#detail_status").html(isista);
                $("#modal_detail_paymentsubs").modal("show");
                // _________EDIT__________
                $("#id_subs_payment").val(dt.id);
                $("#edit_payment_name").val(dt.payment_title);
                $("#edit_rekening_number").val(dt.payment_account);
                $("#edit_rekening_name").val(dt.payment_owner_name);
                $("#edit_bank_name").val(dt.payment_bank_name);
                // $("#edit_payment_tipe").text(pay.payment_title);
                $("#edit_payment_tipe option").each(function () {
                    if ($(this).text() == pay.payment_title) {
                        $(this).attr('selected', 'selected');
                    }
                });
                // alert(pay.payment_title);
                $("#edit_payment_status").val(dt.status).attr("selected", "selected");
                $("#edit_pay_time_limit").val(dt.payment_time_limit);
                $("#edit_deskripsi_paysubs").text(dt.description[0]);

            });

        }



        //dropdown
        function get_payment_tipe() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/get_payment_tipe",
                type: "POST",
                dataType: "json",
                success: function (result) {
                    $('#payment_tipe').empty();
                    $('#payment_tipe').append("<option disabled> Choose </option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#payment_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].payment_title, "</option>"));
                    }

                    $("#payment_tipe").html($('#payment_tipe option').sort(function (x, y) {
                        return $(y).val() < $(x).val() ? -1 : 1;
                    }));

                    $("#payment_tipe").get(0).selectedIndex = 0;
                    // ______________________________________________________________________________
                    $('#edit_payment_tipe').empty();
                    $('#edit_payment_tipe').append("<option disabled> Choose </option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#edit_payment_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].payment_title, "</option>"));
                    }

                    $("#edit_payment_tipe").html($('#edit_payment_tipe option').sort(function (x, y) {
                        return $(y).val() < $(x).val() ? -1 : 1;
                    }));

                    $("#edit_payment_tipe").get(0).selectedIndex = 0;
                }
            });
        } //endfunction




        //dropdown bank
        function get_bank_pay() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/get_bank_pay",
                type: "POST",
                dataType: "json",
                success: function (result) {
                    $('#bank_name').empty();
                    $('#bank_name').append("<option disabled> Choose </option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#bank_name').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#bank_name").html($('#bank_name option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#bank_name").get(0).selectedIndex = 0;
                    // ____________________________________________________________________
                    $('#edit_bank_name').empty();
                    $('#edit_bank_name').append("<option disabled selected> Choose </option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#edit_bank_name').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#edit_bank_name").html($('#edit_bank_name option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#edit_bank_name").get(0).selectedIndex = 0;
                }
            });
        } //endfunction






    </script>

    @endsection
