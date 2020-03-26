@extends('layout.subscriber')
@section('title', 'Dashboard Subscriber')
@section('content')

<div class="row" style="margin-bottom: 1em;">
    <div class="col-2">
        <h3 class="cgrey">Dashboard</h3>
    </div>
    <div class="col-10">
        <p class="clight">Summary your apps performance<p>
    </div>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total News<i
                        class="mdi mdi-book-open-page-variant mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5 total_news"></h2>
                <h6 class="card-text">Increased by 0%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
        <div class="card bg-gradient-purple card-img-holder text-white">
            <img src="/visual/dash2.png" id="img-dash2" />
            <img src="/visual/dash1.png" class="card-img-absolute" style="width: 100%; position: absolute;" />
            <div class="card-body">
                <h4 class="mb-3 s21">Get your notification realtime with a new feature</h4>
                <p class="s16 mb-3" style="width: 400px;">You can get notification realtime to your application with a
                    this feature,
                    smart application with low cost .</p>
                <button type="button" id="btn_getnow" class="btn btn-white btn-sm" style="position: relative;">
                    Get Now </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Friends <i
                        class="mdi mdi-human-handsup mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5 total_friend"></h2>
                <h6 class="card-text">Decreased by 0%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card">
            <img src="/img/car1.png" class="card-img-top card-dashsub">
            <div class="card-body card-dashsub">
                <small class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the
                    card's content.
                </small>
            </div>
            <div class="card-footer card-dashsub">
                <div class="row">
                    <div class="col-md-8">
                        <p class="card-text"><small class="text-muted">26/03/2020 19:03</small></p>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <p class="card-text"><small class="text-muted">Otomotif</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card">
            <img src="/img/car2.png" class="card-img-top card-dashsub">
            <div class="card-body card-dashsub">
                <small class="card-text">
                    In addition to styling the content within cards, Bootstrap includes a few options.
                </small>
            </div>
            <div class="card-footer card-dashsub">
                <div class="row">
                    <div class="col-md-8">
                        <p class="card-text"><small class="text-muted">26/03/2020 11:27</small></p>
                    </div>
                    <div class="col-md-4" style="text-align: right;">
                        <p class="card-text"><small class="text-muted">Otomotif</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Event<i class="mdi mdi-theater mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5 total_event"></h2>
                <h6 class="card-text">Increased by 0%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
        <div class="card">
            <div class="card-body color">
                <h3 class="cgrey" style="margin-bottom: 1em; margin-top: 0.5em;">Basic Menu</h3>
                <div class="row">
                    <div class="col-md-4" style="border-right:1px solid #BDBDBD;">
                        <br>
                        <small class="clight">Inbox</small>
                        <h4 class="ctosca menu_inbox">
                            </h5>
                            <br>
                    </div>
                    <div class="col-md-4" style="border-right:1px solid #BDBDBD;">
                        <br>
                        <small class="clight">About Community</small>
                        <h4 class="ctosca menu_about"></h4>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <small class="clight">Help</small>
                        <h4 class="ctosca menu_help"></h4>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <h4 class="cteal">List News</h4>
                        <ul class="list-arrow" id="list_news">

                        </ul>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-package-variant mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <h4 class="cteal">List Friends</h4>
                        <ul class="list-arrow" id="list_friend">

                        </ul>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-shopping mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-9">
                        <h4 class="cteal">List Event</h4>
                        <ul class="list-arrow" id="list_event">

                        </ul>
                    </div>
                    <div class="col">
                        <i class="mdi mdi-puzzle mdi-24px float-right top-ico cteal"></i>
                    </div>
                </div>
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

                <div class="row">
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mgku-1">
                        <div class="media">
                            <img src="/img/default.png" class="align-self-center mr-3 rounded-circle"
                                style="width: 10%; height: auto;">
                            <div class="media-body">
                                <h6 class="s13 cgrey" style="margin-bottom: 0em;">Judul Fitur</h6>
                                <small class="card-text clight s12">Cras sit amet nibh libero, in gravida nulla. Nulla
                                    vel metus scelerisque.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <center>
                    <button type="button" id="btn-initial2" class="btn btn-primary btn-sm">Got it</button>
                </center>
            </div> <!-- end-modal body -->
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

@endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function () {
        get_dashboard_subscriber();

    });

    $("#btn_getnow").click(function () {
        alert("Handler for .click() called.");
    });


    function get_dashboard_subscriber() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_dashboard_subscriber',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                var bsmenu = result.community_base_menu[0];

                var basic = result.basic_menu;
                $(".menu_inbox").html(basic[0].inbox + " Items");
                $(".menu_about").html(basic[1].about_community);
                $(".menu_help").html(basic[2].help);


                var total_news = 0;
                var ui_news = '';
                $.each(bsmenu.news, function (i, item) {
                    total_news++;
                    ui_news += '<li>' + item.news + '</li>';
                });
                $("#list_news").html(ui_news);
                $(".total_news").html(total_news + " News");

                var total_friend = 0;
                var ui_friend = '';
                $.each(bsmenu.friend, function (i, item) {
                    total_friend++;
                    ui_friend += '<li>' + item.news + '</li>';
                });
                $("#list_friend").html(ui_friend);
                $(".total_friend").html(total_friend + " Friends");

                var total_event = 0;
                var ui_event = '';
                $.each(bsmenu.event, function (i, item) {
                    total_event++;
                    ui_event += '<li>' + item.news + '</li>';
                });
                $("#list_event").html(ui_event);
                $(".total_event").html(total_event + " Events");


            },
            error: function (result) {
                console.log("Cant Get Data For Dashboard");
            }
        });
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



</script>

@endsection
