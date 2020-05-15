@extends('layout.admin-dashboard')

@section('title', 'Dashboard Community')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span><span lang="en">Dashboard</span></h3>

    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="" class="nav-link text-primary" lang="en" data-lang-token="Refresh">Refresh<i
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
                        <small class="clight" lang="en">Total Feature Active</small>
                        <h4 class="cgrey-mid total_fituraktif" lang="en">0 Features</h4>
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
                        <small class="clight" lang="en">Total Subscriber</small>
                        <h4 class="cgrey-mid total_subs" lang="en">0 Subscriber</h4>
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
                        <small class="clight" lang="en">Total Transaction Count</small>
                        <h4 class="cgrey-mid total_transaction_count" lang="en">0 Transaction</h4>
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
                        <small class="clight" lang="en">Total Transaction Number</small>
                        <h4 class="cgrey-mid total_trans_number" lang="en">0 Transaction</h4>
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
                <h4 class="font-weight-normal mb-3" lang="en">Top Subscriber <i
                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                {{-- <h6 class="card-text">Increased by 60%</h6> --}}
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3" lang="en">Weekly Transation <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                {{-- <h6 class="card-text">Decreased by 0%</h6> --}}
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3" lang="en">Pending Subscriber <i
                        class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">0</h2>
                {{-- <h6 class="card-text">Increased by 0%</h6> --}}
            </div>
        </div>
    </div>
</div> <!-- END-ROW 2 -->



<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" lang="en">Community Activity</h4>

                <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" lang="en">Community Transaction</h4>
                <canvas id="myChartTransaction"></canvas>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card" style="height:300px;">
            <div class="card-body">
                <h4 class="card-title" lang="en">Pending Subscriber</h4>
                <div style="margin-top: 0.5em; margin-bottom: 0.5em;">
                    <small class="clight">Total :</small>
                    <span class="cblue" id="isi_total_pendingsubs" lang="en">0 Person</span>
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
                <h4 class="card-title" lang="en">Module Information</h4>
                <div style="margin-top: 0.5em; margin-bottom: 1em;">
                    <small class="clight">Total :</small>
                    <span class="cblue" id="isi_total_module" lang="en">0 Module</span>
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
                <h4 class="card-title" lang="en">Top 5 Subsciber</h4>
                <ul class="list-star" id="top-5-subs">

                </ul>
            </div>
        </div>
    </div>
</div>


<!-- NEWS MODULE DASHBOARD START  -->
<!-- NEWS HEADLINE -->
<div class="row">
    <div class="col-6">
        <h2 class="cgrey" lang="en">HEADLINE NEWS</h2>
    </div>
    <div class="col-6">
        <a href="/admin/news_management" id="other-news" lang="en" data-lang-token="">See Other News</a>
    </div>
</div>
<div class="row" id="hide_nodata_headline" style="display: none;">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" style="text-align: center; height: 250px; margin-top: auto;
        margin-bottom: auto;">
                <br><br>
                <h2 class="clight" lang="en">No Data Available</h2>
            </div>
        </div>
    </div>
</div>
<div id="headline_cont" class="row ">

    <div id="news_headline_cont">

    </div>
</div>

<!-- NEWS INFO -->
<div class="row">

    <!-- LAST NEWS -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title cteal" lang="en">Last News</h4>
                <table id="table_last_news" class="table table-hover dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <center>
                                <th class="bg-greymuda"></th>
                                <th class="bg-greymuda" lang="en">Title</th>
                                <th class="bg-greymuda" lang="en">Date</th>
                            </center>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- TOP VISIT NEWS -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title cteal" lang="en">Top Visited News</h4>
                <table id="table_topvisit_news" class="table table-hover dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <center>
                                <th class="bg-greymuda"></th>
                                <th class="bg-greymuda" lang="en">Title</th>
                                <th class="bg-greymuda" lang="en">Date</th>
                            </center>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
    <!-- TOP VISIT NEWS -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title cteal" lang="en">Top Loved News</h4>
                <table id="table_toploved_news" class="table table-hover dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <center>
                                <th class="bg-greymuda"></th>
                                <th class="bg-greymuda" lang="en">Title</th>
                                <th class="bg-greymuda" lang="en">Date</th>
                            </center>
                        </tr>
                    </thead>
                </table>


            </div>
        </div>
    </div>
</div>



<!-- NEWS MODULE DASHBOARD END  -->




<!-- Modal INITIAL-1-->
<div class="modal fade" id="initial1" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <img src="/visual/hore.png" id="img-initial1">
                    <h3 class="cgrey" style="margin-bottom: 0.5em;" lang="en">Congratulations !!!</h3>
                    <p class="clight s14" lang="en" data-lang-token="initial_selamat">Congratulations ! You’re already
                        succesfull register and you’re already member
                        of community . Let’s look what do you can explore !</p>

                    <button type="button" id="btn-initial1" class="btn btn-teal btn-sm" lang="en">Take a tour</button>
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
                    <h4 class="cgrey" style="margin-bottom: 1em;" lang="en">Features Overiew</h4>
                </center>

                <div class="row modal_initial_fitur">
                    <!-- isi admincom.js / get_initial_feature(); -->
                </div>
            </div> <!-- end-modal body -->
            <center>
                <div class="modal-footer" id="mdl-footer-initialfitur">
                    <button type="button" id="btn-initial2" class="btn btn-teal btn-sm" lang="en">Got it</button>
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
                    <h3 class="cgrey" style="margin-bottom: 0.5em;" lang="en">Ready For Action ?</h3>
                    <p class="clight s14" lang="en" data-lang-token="initial_selamat">Congratulations ! You’re already
                        succesfull register and you’re already member
                        of community . Let’s look what do you can explore !</p>

                    <a href="/admin/community_setting" type="button" id="btn-initial3" class="btn btn-teal btn-sm"
                        lang="en">Finish</a>
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
        get_headline_news(); //data headline news
        get_last_news(); //data Last news
        get_topvisit_news(); //data Top Visit news
        get_toploved_news(); //data Top Loved news

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
                if (result.status == 401) {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized');
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
                $(".total_subs").html(result.total_subscriber + " Subscriber");
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
                ui.popup.show('warning', 'Couldnt get any response for dashboard', 'Timeout');
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



    function get_headline_news() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_headline_news',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                //console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        $("#hide_nodata_headline").show();
                        $("#headline_cont").hide();
                    }
                } else {
                    var isiheadline = '';
                    $.each(result, function (i, item) {
                        var noimg = '/visual/car1.png';
                        $news_id = parseInt(item.id);
                        var $headpic = server_cdn + cekimage_cdn(item.image);
                        isiheadline += '<div class="stretch-card grid-margin news_headline_card">' +
                            '<div class="card sumari">' +
                            '<div class="card-body sumari">' +
                            '<div class="row">' +
                            '<div class="col-12">' +
                            '<div class="news_pic_dash">' +
                            '<img class="news_pic" src="' + $headpic + '" onerror="this.onerror=null;this.src=\'' + noimg + '\';">' +
                            '</div>' +
                            '<small class="clight">' + dateTime(item.createdAt) + '</small>' +
                            '<h4 class="cgrey-mid total_fituraktif">' + item.title + '</h4>' +
                            '<a href="/admin/get_detail_news/' + $news_id + '" class="news_readmore">Read More</a>' +
                            '</div></div></div></div></div>';
                    });

                    $("#news_headline_cont").html(isiheadline);
                }
            },
            error: function (result) {
                console.log(result);
                $("#hide_nodata_headline").show();
                $("#headline_cont").hide();
            }
        });
    }

    function get_last_news() {
        var noimg = '/img/kosong.png';
        var tabel = $('#table_last_news').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'i><'col-sm-12'p>>",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            ajax: {
                url: 'tabel_last_news',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#table_last_news tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'image',
                    render: function (data, type, row) {
                        console.log('lastnews' + data);
                        return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                    }
                },
                {
                    mData: 'title',
                    render: function (data, type, row, meta) {
                        return '<p class="s13 text-wrap width-200">' + data + '</p>';
                    }
                },
                {
                    mData: 'createdAt',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                }
            ],

        });
    }

    function get_topvisit_news() {
        var noimg = '/img/kosong.png';
        var tabel = $('#table_topvisit_news').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'i><'col-sm-12'p>>",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            ajax: {
                url: 'table_topvisit_news',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#table_topvisit_news tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'image',
                    render: function (data, type, row, meta) {
                        console.log('topvisit' + data);
                        return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                    }
                },
                {
                    mData: 'title',
                    render: function (data, type, row, meta) {
                        return '<p class="s13 text-wrap width-200">' + data + '</p>';
                    }
                },
                {
                    mData: 'createdAt',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                }
            ],

        });
    }

    function get_toploved_news() {
        var noimg = '/img/kosong.png';
        var tabel = $('#table_toploved_news').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12'i><'col-sm-12'p>>",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            ajax: {
                url: 'table_toploved_news',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
                error: function (jqXHR, ajaxOptions, thrownError) {
                    var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#table_toploved_news tbody').empty().append(nofound);
                },
            },
            columns: [
                {
                    mData: 'image',
                    render: function (data, type, row, meta) {
                        console.log('toplove' + data);
                        return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                    }
                },
                {
                    mData: 'title',
                    render: function (data, type, row, meta) {
                        return '<p class="s13 text-wrap width-200">' + data + '</p>';
                    }
                },
                {
                    mData: 'createdAt',
                    render: function (data, type, row, meta) {
                        return dateFormat(data);
                    }
                }
            ],

        });
    }


</script>

@endsection
