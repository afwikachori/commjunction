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
    <div id="page_dashboard_super"></div>
    <!-- ROW 1  -->
    <div class="col-md-3 stretch-card grid-margin" style="padding-right: 12px; padding-left: 12px;">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <small class="clight">Total Community</small>
                        <h4 class="cgrey-mid dashone total_komunitas">0 Community</h4>
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
                        <h4 class="cgrey-mid dashone total_subs">0 Person</h4>
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
                        <h4 class="cgrey-mid dashone total_transaction_count">0 Transaction</h4>
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
                        <h4 class="cgrey-mid dashone total_trans_number">0 Transaction</h4>
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
                <h4 class="font-weight-normal mb-3">Top Community <i
                        class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <span id="isi_top_comm"  class="s32"> 0 </span> <small> Subscriber </small>
                <br><br><br>
                <h6 class="card-text" id="isi_nama_top_comm"></h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Top Transation Count <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <span id="isi_top_trans_count" class="s32"> 0 </span> <small> / Count </small>
                <br><br><br>
                <h6 class="card-text" id="isi_top_trans_comm"></h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Pending Registrasion<i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <span id="isi_pending_regis" class="s32"> 0 </span> <small> Community </small>
                <br><br><br>
                <h6 class="card-text">Waiting Payment Confirmation</h6>
            </div>
        </div>
    </div>
</div> <!-- END-ROW 2 -->



<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chart Activity</h4>

                <canvas id="myChartActivity_superadmin"></canvas>

            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chart Transaction</h4>
                <canvas id="myChartTransaction_superadmin"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row" id="row_news_list">
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card sumari" style="border-radius: 35px;">
            <div class="card-header bg-pastel-yellow sumari>
                <div class=" row">
                <div class="col-9">
                    <h4 class="cteal">Top Community</h4>
                </div>
                <div class="col icon-atas">
                    <i class="mdi mdi-newspaper top-ico-right cteal"></i>
                </div>
            </div>

            <div class="card-body sumari">
                <ul class="list-arrow" id="isi_listop_community" style="padding-left: 5px;">

                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6 stretch-card grid-margin">
        <div class="card sumari" style="border-radius: 35px;">
            <div class="card-header bg-pastel-yellow sumari>
                    <div class=" row">
                <div class="col-9">
                    <h4 class="cteal">Top Transaction</h4>
                </div>
                <div class="col icon-atas">
                    <i class="mdi mdi-auto-upload top-ico-right cteal"></i>
                </div>
            </div>

            <div class="card-body sumari">
                <ul class="list-star" id="isi_listop_trans" style="padding-left: 5px;">

                </ul>
            </div>
        </div>
    </div>
</div>


@endsection
