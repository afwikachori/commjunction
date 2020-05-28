@extends('layout.superadmin')

@section('title', 'Verify Community')

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
    <div id="page_verify_community"></div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Project Status</h4>
                <br>
                <table id="tabel_verify_superadmin" class="table table-hover dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th><b>Invoice Number</b></th>
                            <th><b>Nama</b></th>
                            <th><b>Bank</b></th>
                            <th><b>Nominal</b></th>
                            <th><b>Tanggal</b></th>
                            <th><b>Bukti Bayar</b></th>
                            <th><b>Action</b></th>
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
                                    <button class="btn btn-sm btn-light" type="button" onclick="show_pass_verify()"
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
