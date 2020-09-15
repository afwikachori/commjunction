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
            <a href="#" class="nav-link text-primary"  data-toggle="modal" data-target="#modal_setting_dashboard_admin">
                <span lang="en">Dashboard Setting</span>
            </a>
        </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div id="page_dashboard_admin"></div>
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


<!-- MODAL SETTING  DASHBOARD ADMIN -->
<div class="modal fade" id="modal_setting_dashboard_admin" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"
            style="background-color: #ffffff; min-height: 350px; padding-left: 3%; padding-right: 3%;">
            <div class="modal-header" style="padding-bottom: 2em !important; border:none;">
                <h4 class="modal-title cgrey" lang="en">Setting Dashboard</h4>
            </div> <!-- end-header -->

            <div class="modal-body">
                <form>
                <!-- <form method="POST" id="form_setting_notif_admin" action="{{route('setting_notification_admin')}}">
                    {{ csrf_field() }} -->
                    <div id="isi_seting_dashadmin" class="div-setting-dash">

                    </div>

            </div> <!-- end-body -->

            <div class="modal-footer" style="border: none;">
                <center>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="border-radius: 10px;">
                        <i class="mdi mdi-close"></i><span lang="en">Cancel</span>
                    </button>
                    &nbsp;
                    <!-- <button type="submit" class="btn btn-teal btn-sm">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i><span lang="en">Setting</span></button> -->
                </center>
            </div> <!-- end-footer     -->
            </form>
        </div> <!-- END-MDL CONTENT -->
    </div>
</div>


@endsection
