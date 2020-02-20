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
<div class="tabbable-line">
    <ul class="nav nav-tabs ">
        <li class="tab-subs active" id="tab_all">
            <a href="#tab_default_1" data-toggle="tab">
                History
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
                        style="min-width: 120px; margin-bottom: 1em;">Filter</button>
                </div>
                <div class="col-md-4" style="text-align: right;">
                    <button type="button" id="reset_tbl_subsall"
                        class="btn btn-inverse-light btn-icon btn-sm btn_reset_dtable">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                </div>
            </div>
            <!-- tabel all susbcriber -->
            <table id="tabel_subscriber" class="table table-hover table-striped dt-responsive nowrap"
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
            <!-- end tabel all  -->
        </div>


        <div class="tab-pane" id="tab_default_2">
           <h1>ini tab 2</h1>
        </div>


    </div>
</div>
</div>
</div>
</div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        session_logged_superadmin();
tabel_tes();
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/tabel_transaksi_all_super',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }


    function tabel_transaksi_all_super() {
        var tabel = $('#tabel_usertype_manage').DataTable({
            responsive: true,
            ajax: {
                url: '/superadmin/tabel_transaksi_all_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                { mData: 'title' },
                { mData: 'description' },
                {
                    mData: 'id',
                    render: function (data, type, row, meta) {
                        var dt = [row.id, row.title, row.description];

                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                            'onclick="detail_usertype_manage(\'' + dt + '\')">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],

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


</script>

@endsection
