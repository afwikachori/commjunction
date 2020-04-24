@extends('layout.subscriber')
@section('title', 'Dashboard Subscriber')
@section('content')

<div class="row" style="margin-bottom: 1em;">
    <div class="col-md-2">
        <h3 class="cgrey" lang="en">Dashboard</h3>
    </div>
    <div class="col-md-10">
        <p class="clight" lang="en" data-lang-token="sumary_dashboard">Your Community Overall Information<p>
    </div>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3 cteal" lang="en">Total News<i
                        class="mdi mdi-book-open-page-variant cwhite cwhite mdi-24px float-right"></i>
                </h4>
                <h1 class="total_news"> 0 </h1>
                <span class="mb-5"> News</span>
                <!-- <h6 class="card-text">Decreased by 0%</h6> -->
            </div>
        </div>
    </div>
    <div class="col-md-8 stretch-card grid-margin">
        <div class="card bg-gradient-purple card-img-holder text-white">
            <img src="/visual/dash2.png" id="img-dash2" />
            <img src="/visual/dash1.png" class="card-img-absolute" style="width: 100%; position: absolute;" />
            <div class="card-body setnotifdash">
                <h4 class="mb-3 s21" lang="en">Personalize your Profile</h4>
                <p class="s16 mb-3" style="width: 400px;" lang="en" data-lang-token="dash_takemoment">
                   Take a moment to personalize your profile information for other member to see</p>
                <a href="/subscriber/dashboard_setting" type="button" id="btn_getnow" class="btn btn-white btn-sm"
                    style="position: relative;" lang="en" data-lang-token="Profile Management">Profile Management</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white" style="height: auto; min-height: 217px;">
                    <div class="card-body">
                        <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3 cteal" lang="en">Total Friends <i
                                class="mdi mdi-human-handsup cwhite mdi-24px float-right"></i>
                        </h4>
                        <h1 class="total_friend"> 0 </h1>
                        <span class="mb-5" lang="en"> Person</span>
                        <!-- <h6 class="card-text">Decreased by 0%</h6> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white"
                    style="height: auto; min-height: 217px;">
                    <div class="card-body">
                        <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3 cteal" lang="en">Total Event<i
                                class="mdi mdi-theater cwhite mdi-24px float-right"></i>
                        </h4>
                        <h1 class="total_event"> 0 </h1>
                        <span class="mb-5" lang="en">Event</span>
                        <!-- <h6 class="card-text">Decreased by 0%</h6> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card pas_tengah" id="nodata_dash_artikel" style="height:473px;">
            <h2 class="clight pas_tengah" data-lang-token="nodata_dash_artikel" lang="en">No Data Articles Available
            </h2>
        </div>
        <div class="row" id="idashbord_news" style="display: none;">

        </div>
    </div>
</div>


<div class="divkonco" style="display: none;">
    <h4 class="cgrey" style="margin-bottom: 1em;" lang="en">Friend Suggestion</h4>
    <div id="div_friendsugest">
        <!-- <div class="card konco">
            <div class="card-body color">
                <div class="close_konco">
                    <button type="button" class="close cgrey2" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <center>
                        <img src="/img/kosong.png" class="rounded-circle img-fluid mb-2 konco">
                        <h6 class="cgrey2">Jihane Almira</h6>
                        <input type="hidden" value="" name="frend_suges">
                        <button type="button" class="btn btn-tosca btn-sm konco">
                            <i class="mdi mdi-account-plus"></i> &nbsp; Add
                        </button>
                        <center>
                </form>
            </div>
        </div> -->
    </div>
</div>


<div class="row" id="row_news_list">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari" style="border-radius: 35px;">
            <div class="card-header bg-pastel-red sumari>
                <div class=" row">
                <div class="col-9">
                    <h4 class="cteal" lang="en">Latest News</h4>
                </div>
                <div class="col icon-atas">
                    <i class="mdi mdi-newspaper top-ico-right cteal"></i>
                </div>
            </div>

            <div class="card-body sumari">
                <div class="card pas_tengah" id="nodata_last_news">
                    <h4 class="clight pas_tengah" lang="en">No Data Available</h4>
                </div>
                <ul class="list-arrow" id="isi_last_news" style="padding-left: 5px; display: none;">

                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari" style="border-radius: 35px;">
            <div class="card-header bg-pastel-red sumari>
                        <div class=" row">
                <div class="col-9">
                    <h4 class="cteal" lang="en">Most Love News</h4>
                </div>
                <div class="col icon-atas">
                    <i class="mdi mdi-heart-outline top-ico-right cteal"></i>
                </div>
            </div>

            <div class="card-body sumari">
                <div class="card pas_tengah" id="nodata_love_news">
                    <h4 class="clight pas_tengah" lang="en">No Data Available</h3>
                </div>
                <div id="isi_love_news" style="padding-left: 10px; display: none;">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card sumari" style="border-radius: 35px;">
            <div class="card-header bg-pastel-red sumari>
                    <div class=" row">
                <div class="col-9">
                    <h4 class="cteal" lang="en">Top Visit News</h4>
                </div>
                <div class="col icon-atas">
                    <i class="mdi mdi-auto-upload top-ico-right cteal"></i>
                </div>
            </div>

            <div class="card-body sumari">
                <div class="card pas_tengah" id="nodata_topvisit_news">
                    <h4 class="clight pas_tengah" lang="en">No Data Available</h4>
                </div>
                <ul class="list-star" id="isi_topvisit_news" style="padding-left: 5px; display: none;">

                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row" style="padding: 0rem 20px 0rem 20px;">
    <div class="col-md-6 stretch-card grid-margin">
        <div class="card">
            <div class="row" style="min-height: 150px;">
                <div class="col-2 mpad-0" style="background-color: #b7e778;">
                    <center>
                        <br><br>
                        <i class="mdi mdi-shield cwhite" style="font-size: 35px;"></i>
                    </center>
                </div>
                <div class="col-10">
                    <div class="pad-1em">
                        <h4 class="cteal" lang="en">Top Visit Club</h4>
                        <div id="topclubvisit_nodata">
                            <center>
                                <h3 class="clight mgt-1half" lang="en">No Available Data</h3>
                            </center>
                        </div>
                        <div id="isi_top_visit_club" class="row" style="display: none;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 stretch-card grid-margin" style="padding-right: 0em;">
        <div class="card">
            <div class="row" style="min-height: 150px;">
                <div class="col-2 mpad-0" style="background-color: #7ecfc0;">
                    <center>
                        <br><br>
                        <i class="mdi mdi-human-greeting cwhite" style="font-size: 35px;"></i>
                    </center>
                </div>
                <div class="col-10">
                    <div class="pad-1em">
                        <h4 class="cteal" style="margin-bottom: 1em;" lang="en">Top Visit Player</h4>
                        <div id="topplayer_nodata">
                            <center>
                                <h3 class="clight mgt-1half" lang="en">No Available Data</h3>
                            </center>
                        </div>
                        <div id="isi_top_player" class="row" style="display: none;">

                        </div>
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
                        <h4 class="cteal" lang="en">List News</h4>
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
                        <h4 class="cteal" lang="en">List Friends</h4>
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
                        <h4 class="cteal" lang="en">List Event</h4>
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
                    <h3 class="cgrey" style="margin-bottom: 0.5em;" lang="en">Congratulations !!!</h3>
                    <p class="clight s14" lang="en" data-lang-token="initial_selamat">Congratulations ! You’re already
                        succesfull register and you’re already
                        member of community . Let’s look what do you can explore !</p>
                    <br>
                    <div>
                        <button type="button" id="btn-initial1" class="btn btn-tosca btn-sm" style="width:100px;"
                            lang="en">Take a Tour</button>
                        &nbsp;
                        <button type="button" data-dismiss="modal" class="btn btn-light btn-sm"
                            style="width:100px; margin-top: 1em;" lang="en">Skip</button>
                        <br>
                    </div>
                    <br>
                    <br>
                    <br>
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
                    <h4 class="cgrey" style="margin-bottom: 1em;" lang="en">Features Overview</h4>
                </center>

                <div class="row" style="padding-left: 7%; padding-right:6.6%; margin-bottom:1.5em;">
                    <div id="show_initial_fitur" class="card-deck show_subfitur_module scrollfitur" style="width:100%;">

                    </div>
                </div>
                <center>
                    <button type="button" id="btn-initial2" class="btn btn-tosca btn-sm" style="width:100px;"
                        lang="en">Got it</button>
                    <br>
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
                    <h3 class="cgrey" style="margin-bottom: 0.5em;" lang="en">Ready For Action ?</h3>
                    <p class="clight s14" lang="en" data-lang-token="initial_selamat">Congratulations ! You’re already
                        succesfull register and you’re already
                        member of community . Let’s look what do you can explore !</p>
                    <br>
                    <button type="button" id="btn-initial3" class="btn btn-tosca btn-sm" style="width:100px;"
                        lang="en">Finish</button>
                    <br><br>
                </center>
            </div> <!-- end-modal body -->
        </div>
    </div>
</div>


<!-- MODAL MEMBERSHIP TYPE PAYMENT -->
<div class="modal fade modal_ajax" id="modal_initial_membership" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content membership">
            <div class="modal-body">
                <div class="row justify-content-center" style="text-align: center;">
                    <div class="card-deck price_member" style="padding-left: 6%; padding-right: 3%; width: 100%;">

                    </div>
                    <br>
                </div> <!-- end-row -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL PAYMENT MODULE -->
<div id="modal_pay_initial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_pay_initial"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
            <form method="POST" id="form_initial_member" action="{{route('set_initial_membership_pay')}}">
                {{ csrf_field() }}

                <div class="modal-body" style="min-height: 355px; height: auto; padding-left: 5%; padding-right: 5%;">
                    <h3 class="cgrey" style="margin-bottom: 1.5em; margin-top:1em;" lang="en">Choose Payment Method</h3>
                    <div class="row" style="margin-bottom: 0.5em;">
                        <div class="col-md-12">
                            <h5 class="h5 clight" lang="en">Membership Price</h5>
                            <small class="cgrey2">Rp &nbsp;</small>
                            <span class="h6 cblue" id="harga_member"></span>&nbsp;
                            <small class="cgrey2"> ,-</small>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="h6 clight" lang="en">Choose Payment Method</h6>
                            <div class="row" style="padding-left: 5%; margin-top: -0.3em;">
                                <div class="isi_method_pay">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="isi_show_bank" class="collapse-accordion" role="tablist"
                                aria-multiselectable="true">

                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pay_initial" id="id_pay_initial">
                <input type="hidden" name="id_membertype" id="id_membertype">
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal" lang="en">Close</button>
                    <button type="submit" class="btn btn-teal btn-sm" lang="en">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    var no_data = '';

    $(document).ready(function () {
        get_pricing_membership();
        get_payment_initial();

        get_dashboard_news();
        get_friends_total();
        get_friends_sugestion();
        get_last_news();
        get_love_news();
        get_topvisit_news();

        get_top_player();
        get_top_visit_club(); //no data - ui wait data
    });

    function tabel_tes() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/tabel_generate_inbox_subs',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 4,
            },
            success: function (result) {
                console.log(result);
                if (result.success == false) {
                    ui.popup.show('warning', result.message, 'Warning');
                }
                // $.each(result, function (i, item) {

                // });
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }

    function get_dashboard_news() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_dashboard_news',
            type: 'POST',
            datatype: 'JSON',
            timeout: 30000,
            data: {
                "limit": 4,
            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    $("#nodata_dash_artikel").show();
                    $("#idashbord_news").hide();
                    console.log(result.message);
                } else {
                    var berita = '';
                    $.each(result, function (i, item) {
                        var imge = cekimage_cdn(item.image);
                        var noimgnews = '/img/car1.png';

                        berita += '<div class="col-md-6 stretch-card grid-margin">' +
                            '<div class="card" style="height:217px;">' +
                            '<img src="http://' + server_cdn + imge + '" class="card-img-top card-dashsub"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimgnews + '\';"' +
                            'style="border-radius: 8px 8px 0px 0px;">' +
                            '<div class="card-body card-dashsub">' +
                            '<small class="card-text text-wrap">' + item.title +
                            '</small>' +
                            '</div>' +
                            '<div class="card-footer card-dashsub">' +
                            '<div class="row">' +
                            '<div class="col-md-8">' +
                            '<p class="card-text"><small class="text-muted">' +
                            dateTime(item.createdAt) + '</small></p>' +
                            '</div>' +
                            '<div class="col-md-4" style="text-align: right;">' +
                            '<p class="card-text"><small class="text-muted">' + item.scala + '</small>'+
                            '<a href="/subscriber/detail_news/' + item.id + '" class="btn btn-tosca btn-sm konco2"><small lang="en">See Detail</small></a></p>' +
                            '</div>' +
                            '</div>' +
                            '</div></div></div>';
                    });
                    $("#idashbord_news").html(berita);
                    $("#nodata_dash_artikel").hide();
                    $("#idashbord_news").show();
                }

            },
            error: function (result) {
                $("#nodata_dash_artikel").show();
                $("#idashbord_news").hide();
                console.log("Cant Get Articles News");
            }
        });
    }

    function get_friends_total() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_friends_total',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 4,
            },
            success: function (result) {
                if (result.success == false) {
                    $(".total_friend").html("0");
                    console.log(result);
                } else {
                    $(".total_friend").html(result.total_friend);
                }
            },
            error: function (result) {
                $(".total_friend").html("0");
                // console.log(result);
                console.log("Cant Show");
            }
        });
    }

    function get_friends_sugestion() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_friends_sugestion',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 10,
            },
            success: function (result) {
                console.log(result);
                if (result.success == false) {
                    console.log(result);
                    $(".divkonco").hide();
                } else {
                    var nofoto = '/img/kosong.png';
                    var isiui = '';
                    var jumlah = 0;
                    $.each(result, function (i, item) {
                        jumlah++;
                        isiui += '<div class="card konco" id="' + item.user_id + '">' +
                            '<div class="card-body color">' +
                            '<div class="close_konco">' +
                            '<button type="button" class="close cgrey2" aria-label="Close"' +
                            'onclick="hide_friendsugest(\'' + item.user_id + "<>" + jumlah + '\')">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>' +
                            '<form method="POST" id="form_add_friend" action="{{route('add_friend_suggest_subs')}}">'+
                            '{{ csrf_field() }}'+
                            '<center>' +
                            '<img src="' + server_cdn + cekimage_cdn(item.picture) + '" class="rounded-circle img-fluid mb-2 konco"' +
                            'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';">' +
                            '<h6 class="cgrey2 s13">' + item.full_name + '</h6>' +
                            '<input type="hidden" value="' + item.user_id + '" name="user_id_subs">' +
                            '<button type="submit" class="btn btn-tosca btn-sm konco">' +
                            '<i class="mdi mdi-account-plus"></i> &nbsp; <span lang="en">Add</span>' +
                            '</button>' +
                            '<center>' +
                            '</form>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $(".divkonco").show();
                    $("#div_friendsugest").html(isiui);
                }
            },
            error: function (result) {
                // console.log(result);
                console.log("Cant Show Friend Suggest");
                $(".divkonco").hide();
            }
        });
    }

    function hide_friendsugest(dtcard) {
        var dt = dtcard.split('<>');
        $("#" + dt[0]).hide();
        if (dt[1] == 1) {
            $(".divkonco").fadeOut("slow").hide();
        }
    }

    function get_last_news() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_last_news',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 5,
            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    $("#nodata_last_news").show();
                    $("#isi_last_news").hide();
                    console.log(result);
                }
                var newsui = '';
                $.each(result, function (i, item) {
                    newsui += '<li>' +
                        '<small class="cblue">' + dateTime(item.createdAt) + '</small> &nbsp;&nbsp;&nbsp;' +
                        '<a href="/subscriber/detail_news/' + item.id + '">' +
                        '<small class="clight s13">See Details</small></a><br>' +
                        '<small class="cgrey s13">' + item.title + '</small><br>' +
                        '</li>';
                });
                $("#isi_last_news").html(newsui);
                $("#nodata_last_news").hide();
                $("#isi_last_news").show();

            },
            error: function (result) {
                $("#nodata_last_news").show();
                $("#isi_last_news").hide();
                // console.log(result);
                console.log("Cant Show Latest News");
            }
        });
    }

    function get_love_news() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_love_news',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 5,
            },
            success: function (result) {
                // console.log(result);
                var noimg = '/img/fitur.png';
                if (result.success == false) {
                    $("#nodata_love_news").show();
                    $("#isi_love_news").hide();
                    console.log(result);
                }
                var loveui = '';
                $.each(result, function (i, item) {
                    loveui += '<div class="row" style="margin-bottom:-0.5em;"><div class="col-md-2 pd-5px">' +
                        '<center><img src="http://' + server_cdn + cekimage_cdn(item.image) + '" class="rounded-circle img-fluid mb-2 lovenews"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>' +
                        '</div>' +
                        '<div class="col-md-10 pd-5px">' +
                        '<small class="cblue s12">' + dateTime(item.createdAt) + '</small>&nbsp;&nbsp;' +
                        '<a href="/subscriber/detail_news/' + item.id + '"><small class="clight">See Details</a></small>' +
                        '<br><small class="cgrey2 s12">' + item.title + '</small><br>' +
                        '</div></div>';
                });
                $("#isi_love_news").html(loveui);
                $("#nodata_love_news").hide();
                $("#isi_love_news").show();

            },
            error: function (result) {
                $("#nodata_love_news").show();
                $("#isi_love_news").hide();
                // console.log(result);
                console.log("Cant Show love news");
            }
        });
    }

    function get_topvisit_news() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_topvisit_news',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 5,
            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    $("#nodata_topvisit_news").show();
                    $("#isi_topvisit_news").hide();
                }
                var newsui = '';
                $.each(result, function (i, item) {
                    newsui += '<li>' +
                        '<small class="cblue">' + dateTime(item.createdAt) + '</small> &nbsp;&nbsp; &nbsp;' +
                        '<a href="/subscriber/detail_news/' + item.id + '">' +
                        '<small class="clight s13">See Details</small></a><br>' +
                        '<small class="cgrey mgtop-minus-1em s13>' + item.title + '</small><br>' +
                        '</li>';
                });
                $("#isi_topvisit_news").html(newsui);
                $("#nodata_topvisit_news").hide();
                $("#isi_topvisit_news").show();
            },
            error: function (result) {
                console.log("Cant Show top visit news");
                $("#nodata_topvisit_news").show();
                $("#isi_topvisit_news").hide();
            }
        });
    }

    function get_top_player() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_top_player',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 4,
            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    $("#topplayer_nodata").show();
                    $("#isi_top_player").hide();
                    console.log(result);
                }

                if (result.length == 0) {
                    $("#topplayer_nodata").show();
                    $("#isi_top_player").hide();
                } else {
                    var iuplyr = '';
                    var nopic = '';
                    var gen = '';
                    $.each(result, function (i, item) {
                        if (item.gender == "putri") {
                            nopic = '/img/pl-girl.png';
                            gen = 'Putri';
                        } else {
                            nopic = '/img/pl-boy.png';
                            gen = 'Putra';
                        }
                        iuplyr += '<div class="col-md-6 mgt-half">' +
                            '<div class="row pad-5px">' +
                            '<div class="col-md-2 pad-5px dikanan">' +
                            '<img src="' + server_cdn + item.photo + '" class="rounded-circle img-fluid wd-25px"' +
                            'onerror="this.onerror=null;this.src=\'' + nopic + '\';">' +
                            '</div>' +
                            '<div class="col-md-10 pad-5px">' +
                            '<small class="cgrey2">' + item.name + '</small>' +
                            '<small class="cblue"> &nbsp; (' + gen + ')</small><br>' +
                            '<small class="clight">Club : ' + item.club.name + '</small>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $("#isi_top_player").html(iuplyr);
                    $("#topplayer_nodata").hide();
                    $("#isi_top_player").show();

                }
            },
            error: function (result) {
                $("#topplayer_nodata").show();
                $("#isi_top_player").hide();
                console.log("Cant Show top Player");
            }
        });
    }

    function get_top_visit_club() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_top_visit_club',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "limit": 4,
            },
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    console.log(result);
                    $("#topclubvisit_nodata").show();
                    $("#isi_top_visit_club").hide();
                }

                if (result.length == 0) {
                    $("#topclubvisit_nodata").show();
                    $("#isi_top_visit_club").hide();
                }
                // $.each(result, function (i, item) {

                // });

            },
            error: function (result) {
                $("#topclubvisit_nodata").show();
                $("#isi_top_visit_club").hide();
                console.log("Cant Show Top Club Visit");
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
        $("#modal_initial_membership").modal('show');
    });



</script>

@endsection
