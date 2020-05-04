@extends('layout.superadmin')

@section('title', 'Payment')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h2 class="page-title">Verify Payment Registrasion</h2>
    </div>
    <div class="col-md-4">
        <label class="cgrey">Manage verification payment by registrasion community<label>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Project Status</h4>
                <br>
                <table id="tabel_verify_superadmin" class="table table-hover dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Nama</th>
                            <th>Bank</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Bukti Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- MODAL VERIFY -->
<div class="modal fade" id="modal_verify_admincom" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #ffffff;">
            <div class="modal-header">
                <h5 class="modal-title">Verify Payment New Admin Community</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form_verify_admincom" action="{{route('verify_admincom')}}"
                enctype="multipart/form-data">{{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="invoice_num">Invoice Number</label>
                        <div class="col-sm-8">
                            <input id="invoice_num" type="text"
                                class="form-control input-abu @error('invoice_num') is-invalid @enderror"
                                name="invoice_num" required>
                            <small id="pesan_invnum" class="redhide"></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="file">File</label>
                        <div class="col-sm-8">
                            <input type="file" id="fileup" name="fileup" class="file-upload-default">
                            <div class="input-group col-xs-12 input-abu">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image" style="border: none; outline: none;">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-light" type="button">Browse</button>
                                </span>
                            </div>
                            <small id="pesan_fileup" class="redhide"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Cancel Description</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <textarea class="form-control input-abu" id="alasan" name="alasan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <div class="input-group input-abu">
                                <input type="password" id="pass_super"
                                    class="form-control @error('pass_super') is-invalid @enderror" name="pass_super"
                                    style="border-radius: 10px 0px 0px 10px; !important" value="{{ old('pass_super') }}"
                                    required autocomplete="pass_super">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-light" type="button" onclick="showpass()"
                                        style="    border-radius: 0px 10px 10px 0px !important;">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small id="pesan_paswotsuper" class="redhide"></small>
                        </div>
                    </div>
                </div> <!-- end-modal body -->
                <div class="modal-footer"
                    tyle="border: none; text-align: center; padding-right: 25%; padding-bottom: 5%;">
                    <button class="btn btn-light btn-sm" type="submit" name="approval" value="3"
                        style="border-radius: 6px;">
                        <i class="mdi mdi-close"></i> Reject
                    </button>
                    &nbsp;
                    <button type="submit" name="approval" value="2" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> Approve </button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('script')
<script type="text/javascript">
    var cdn = $("#server_cdn").val();
    $(document).ready(function () {

        // session_logged_superadmin();
        tabel_req_verify(); //datables

        tabel_tes();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/list_req_admincomm',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant tabel tes");
            }
        });
    }

    function tabel_req_verify() {
        var tabel = $('#tabel_verify_superadmin').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/list_req_admincomm',
                type: 'POST',
                dataSrc: '',
                timeout: 30000
            },
            columns: [
                { mData: 'invoice_number' },
                { mData: 'nama' },
                { mData: 'payment_bank_name' },
                {
                    mData: 'nominal',
                    render: function (data, type, row, meta) {
                        return "Rp " + rupiah(data);
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                },
                {
                    mData: 'file_customer',
                    render: function (data, type, row, meta) {
                        var noimg = '/img/noimg.jpg'
                        var pic = cdn + cekimage_cdn(data);
                        return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';
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
        $('#tabel_verify_superadmin tbody').on('click', 'button', function () {
            var data = tabel.row($(this).parents('tr')).data();
            // console.log(data);

            $('input[name="invoice_num"]').val(data.invoice_number);
            $("#modal_verify_admincom").modal('show');
            $("#btn_verifyreq").attr("disabled", true);

        });

    }


    function verify_reqadmin(invoice_num) {
        alert(invoice_num);
        // $("#invoice_num").val(invoice_num);
        $('input[name="invoice_num"]').val(invoice_num);
        $("#modal_verify_admincom").modal('show');
        $("#btn_verifyreq").attr("disabled", true);


    }


    function list_req_admincomm() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/list_req_admincomm',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Reach List Request Admin Community");
            }
        });
    }


    function showpass() {
        var a = document.getElementById("pass_super");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }



</script>

@endsection
