@extends('layout.admin-dashboard')

@section('title', 'Dashboard Community')

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




<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="height:300px;">
            <div class="card-body">
                <h4 class="card-title">Pending Subscriber</h4>
                <div style="margin-top: 0.5em; margin-bottom: 0.5em;">
                    <small class="clight">Total :</small>
                    <span class="cblue" id="isi_total_pendingsubs">0 Person</span>
                </div>

                <div style="width: 100%; height: 150px; overflow-y: scroll;">
                    <ul>
                        <div id="pending_subs_dash">

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="height:300px;">
            <div class="card-body">
                <h4 class="card-title">Module Information</h4>
                <div style="margin-top: 0.5em; margin-bottom: 1em;">
                    <small class="clight">Total :</small>
                    <span class="cblue" id="isi_total_module">0 Module</span>
                </div>
                <div style="width: 100%; height: 150px; overflow-y: scroll;">
                    <div id="module_info_dash">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="height:300px;">
            <div class="card-body">
                <h4 class="card-title">Top 5 Subsciber</h4>
                <ul class="list-star" id="top-5-subs">

                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal INITIAL-1-->
<div class="modal fade" id="initial1" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <img src="/visual/hore.png" id="img-initial1">
                    <h3 class="cgrey" style="margin-bottom: 0.5em;">Congratulations !!!</h3>
                    <p class="clight s14">Congratulations ! You’re already succesfull register and you’re already member
                        of community . Let’s look what do you can explore !</p>

                    <button type="button" id="btn-initial1" class="btn btn-primary btn-sm">Take a tour</button>
                </center>
            </div> <!-- end-modal body -->
        </div>
    </div>
</div>


<!-- Modal INITIAL-2-->
<div class="modal fade" id="initial2" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <img src="/visual/init-fitur.png" id="img-initial2">
                    <h4 class="cgrey" style="margin-bottom: 1em;">Features Overiew</h4>
                </center>

                <div class="row modal_initial_fitur">
                    <!-- isi admincom.js / get_initial_feature(); -->
                </div>
            </div> <!-- end-modal body -->
            <center>
                <div class="modal-footer" id="mdl-footer-initialfitur">
                    <button type="button" id="btn-initial2" class="btn btn-primary btn-sm">Got it</button>
                </div>
            </center>
        </div>
    </div>
</div> <!-- end-modal INITIAL2 -->



<!-- Modal INITIAL-3-->
<div class="modal fade" id="initial3" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <img src="/visual/init3.png" id="img-initial3">
                    <h3 class="cgrey" style="margin-bottom: 0.5em;">Ready For Action ?</h3>
                    <p class="clight s14">Congratulations ! You’re already succesfull register and you’re already member
                        of community . Let’s look what do you can explore !</p>

                    <button type="button" id="btn-initial3" class="btn btn-primary btn-sm">Finish</button>
                </center>
            </div> <!-- end-modal body -->
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
    var server_cdn = $(".server_cdn").val();
    $(document).ready(function () {

        get_dashboard_admin(); //data dashboard

    });

    function get_dashboard_admin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $.ajax({
            url: '/admin/get_dashboard_admin',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result.status == 401 || result.message) {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 6000);
                }
                var pending_subs = result.pending_subscriber[0];

                tabel_pending_subscriber(pending_subs);
                get_module_info(result.module_info[0]);
                chart_activity(result.chart_activity);
                chart_transaction(result.chart_transaction);

                $(".total_fituraktif").html(result.total_feature_active + " Features");
                $(".total_subs").html(result.total_subscriber + " Person");
                $(".total_transaction_count").html(result.total_transaction_count + " Transaction");
                $(".total_trans_number").html(result.total_transaction_number + " Transaction");

                if (result.top_subscriber[0] != "") {
                    var top5 = '';
                    $.each(result.top_subscriber[0], function (i, item) {
                        top5 += ' <li>' + item.full_name + '</li>';
                    });
                    $('#top-5-subs').html(top5);
                } else {
                    $('#top-5-subs').html('<center><br><br><br><br><h2 class="display-3" style="color: #c5c5c5;">No Data</h1></center>');
                }


            },
            error: function (result) {
                ui.popup.show('warning', 'Couldnt get any respond for dashboard', 'Timeout');
                console.log(result);
            }
        });
    }



    function tabel_pending_subscriber(data_subs) {
        var isitabel = '';
        var total_pending = 0;

        $.each(data_subs, function (i, item) {
            total_pending++;
            isitabel += '<li><small class="cgrey2">' + item.full_name + '</small></li>';

        });
        $('#isi_total_pendingsubs').html(total_pending + " Person");
        $('#pending_subs_dash').html(isitabel);
    }



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

    function get_module_info(dtmodule) {
        var subf = '';
        var jum = 0;
        $.each(dtmodule, function (i, item) {
            jum++;
            subf += '<div class="col-md-12 stretch-card grid-margin" style="height:75px; padding-left: 5px; padding-bottom:0px; margin-bottom:0.5em;"' +
                'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                '<div class="card bg-gradient-yellow card-img-holder text-white">' +
                '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
                '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                'alt="circle-image" /> ' +
                '<div class="row">' +
                '<div class="col-md-3" style="padding-right:4px;">' +
                '<img src="' + server_cdn + item.logo + '" class="rounded-circle img-fluid img-card3"' +
                'onerror = "this.onerror=null;this.src=\' /img/fitur.png \';">' +
                '</div>' +
                '<div class="col-md-9" style="padding-left:5px;">' +
                '<b><small>' + item.title + '</small></b>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        });
        $("#module_info_dash").html(subf);
        $("#isi_total_module").html(jum + "  Modules");
    }



</script>

@endsection
