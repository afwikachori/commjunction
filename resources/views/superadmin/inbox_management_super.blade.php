@extends('layout.superadmin')

@section('title', 'Transaction Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-message-text-outline"></i>
        </span>Inbox Management</h3>

    <nav aria-label="breadcrumb">
        <button type="button" class="btn btn-tosca btn-sm"
        data-toggle="modal" data-target="#modal_generate_invoice_trans">
        Generate Invoice</button>
    </nav>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
  <div class="card-body">


</div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        // tabel_tes();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_transaksi_show',
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
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


</script>

@endsection
