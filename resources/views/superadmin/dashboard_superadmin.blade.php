@extends('layout.superadmin')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard</h3>

    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="" class="nav-link text-primary"> Refresh <i
                        class="mdi mdi-refresh icon-sm text-primary align-middle"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <!-- ROW 1  -->
    <div class="col-md-3 stretch-card grid-margin" style="padding-right: 12px; padding-left: 12px;">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <small class="clight">Total Feature Active</small>
                        <h4 class="cgrey-mid total_fituraktif">0 Features</h4>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-chart-bubble mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 stretch-card grid-margin" style="padding-right: 12px; padding-left: 12px;">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <small class="clight">Total Subscriber</small>
                        <h4 class="cgrey-mid total_subs">0 Person</h4>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-human-handsup mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 stretch-card grid-margin" style="padding-right: 12px; padding-left: 12px;">

        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <small class="clight">
                            Total Transaction Count</small>
                        <h4 class="cgrey-mid total_transaction_count">0 Transaction</h4>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-cart mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 stretch-card grid-margin" style="padding-right: 12px; padding-left: 12px;">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <small class="clight"> Total Transaction Number</small>
                        <h4 class="cgrey-mid total_trans_number">0 Transaction</h4>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-shopping mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- END-ROW 1 -->




<div class="row">
    <!-- ROW 2  -->
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Top Subscriber <i
                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                <h6 class="card-text">Increased by 60%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Transation <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                <h6 class="card-text">Decreased by 0%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                <h6 class="card-text">Increased by 0%</h6>
            </div>
        </div>
    </div>
</div> <!-- END-ROW 2 -->



<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chart Activity</h4>

                <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chart Transaction</h4>
                <canvas id="myChartTransaction"></canvas>
            </div>
        </div>
    </div>
</div>


<!-- MODAL LOADING AJAX -->
<div class="modal fade bd-example-modal-sm" id="mdl-loadingajax_admin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content loading">
            <center>
                <div class="spinner-border text-light" style="width: 5rem; height: 5rem; margin-bottom: 1em;"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="h6 iniloading">Loading . . .</p>
                <center>
        </div>
    </div>
</div>
<!-- END-MODAL -->

@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        session_logged_superadmin();
        get_dashboard_superadmin();

    });



    $("#btn-initial1").click(function () {
        $("#initial1").modal('hide');
        $("#initial2").modal('show');
        $("#initial3").modal('hide');
    });

    $("#btn-initial2").click(function () {
        $("#initial1").modal('hide');
        $("#initial2").modal('hide');
        $("#initial3").modal('show');
    });

    $("#btn-initial3").click(function () {
        $("#initial1").modal('hide');
        $("#initial2").modal('hide');
        $("#initial3").modal('hide');
    });

    function chart_activity(data) {
        var dt = data[0];
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [dt.x],
                datasets: [{
                    label: dt.x,
                    backgroundColor: 'rgb(255, 255, 230)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [dt.y]
                }]
            },

            // Configuration options go here
            options: {}
        });
    }

    function chart_activity(data) {
        var dt = data[0];
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [dt.x],
                datasets: [{
                    label: dt.x,
                    backgroundColor: 'rgb(255, 255, 230)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [dt.y]
                }]
            },

            // Configuration options go here
            options: {}
        });
    }

    function chart_transaction(data) {
        var dt = data[0];
        var ctx = document.getElementById('myChartTransaction').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: [dt.x],
                datasets: [{
                    label: dt.x,
                    backgroundColor: 'rgb(255, 255, 230)',
                    borderColor: 'rgb(0, 184, 230)',
                    data: [dt.y]
                }]
            },

            // Configuration options go here
            options: {}
        });
    }




    function get_dashboard_superadmin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/superadmin/get_dashboard_superadmin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                // console.log("subs" +pending_subs);
                chart_activity(result.chart_activity);
                chart_transaction(result.chart_transaction);

                $(".total_fituraktif").html(result.total_feature_active + " Features");
                $(".total_subs").html(result.total_subscriber + " Person");
                $(".total_transaction_count").html(result.total_transaction_count + " Transaction");
                $(".total_trans_number").html(result.total_transaction_number + " Transaction");



            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }




</script>

@endsection
