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
                            <table id="tabel_komunitas_subs"
                                class="table table-hover table-striped dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID Community</th>
                                        <th>Community Name</th>
                                        <th>Register Date</th>
                                        <th>Range Member</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- end tabel all  -->
                        </div>


                        <div class="tab-pane" id="tab_default_2">
                            <!-- tabel all susbcriber -->
                            <table id="tabel_subs_pending" class="table table-hover table-striped dt-responsive nowrap"
                                style="width:100%">
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
                            <!-- end tabel all  -->
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
        // tabel_tes();
        tabel_subs_komunitas_super();


    $('#tabel_komunitas_subs tbody').on('click', 'tr', function () {
        var table = $('#example').DataTable();
        var data = table.row(this).data();

        console.log(data[0]);
    } );

    });  //end- document ready


        function tabel_tes() {
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
                    console.log(result);
                },
                error: function (result) {
                    console.log(result);
                    console.log("Cant Show");
                }
            });
        }




    function tabel_subs_komunitas_super() {
        var tabel = $('#tabel_komunitas_subs').DataTable({
            responsive: true,
            ajax: {
                url: '/superadmin/tabel_subs_komunitas_super',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                { mData: 'name' },
                { mData: 'created_at' },
                { mData: 'range_member' },
                { mData: 'id',
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-abu btn-sm s9" onclick="tabel_subscriber_commjuction('+data+')">Subscriber</button>';
                    }
                }
            ],

        });

    }


    function tabel_subscriber_commjuction(idkomunitas) {
        alert(idkomunitas);
    }


</script>

@endsection
