@extends('layout.subscriber')
@section('title', 'Dashboard Subscriber')
@section('content')

<div class="row" style="margin-bottom: 1em;">
    <div class="col-md-2">
        <h3 class="cgrey" lang="en">Dashboard</h3>
    </div>
    <div class="col-md-10">
        <p class="clight" lang="en" data-lang-token="sumary_dashboard">Your Community Overall Information
        <p>
    </div>
</div>

<div class="row">
    <div id="page_dashboard_subscriber"></div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3 cteal" lang="en">Total News<i
                        class="mdi mdi-book-open-page-variant cwhite cwhite mdi-24px float-right"></i>
                </h4>
                <h1 class="total_news"> 0 </h1>
                <span class="mb-5" lang="en" News</span>
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
                    <h4 class="cteal" lang="en">Most Loved News</h4>
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
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card sumari">
            <div class="card-body sumari">
                <div class="row">
                    <div class="col-md-2">
                        <br>
                        <h3 class="cteal" lang="en">Top Friends</h3>
                    </div>
                    <div class="col-md-10">
                        <div id="topfriend_nodata">
                            <center>
                                <h3 class="clight mgt-1half" lang="en">No Available Data</h3>
                            </center>
                        </div>
                        <div class="row mgt-1half" id="isi_top_friends">

                            <!-- <div class="col-md-3">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--
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
</div> --}}




<!-- Modal INITIAL-1-->
<div class="modal fade" id="initial1" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <img src="/visual/hore.png" id="img-initial1">
                    <h3 class="cgrey" style="margin-bottom: 0.5em;" lang="en">Congratulations!</h3>
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
                    <div style="text-align: center; display: none;" id="hide_membertipe">
                        <br><br><br>
                        <h2 class="cligt" lang="en">No Data Available</h2>
                    </div>
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
