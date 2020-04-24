@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<img src="/visual/vs-pricing.png" id="shadow-pricing">
<a href="/admin/register2">
    <img border="0" src="/visual/left-arrow.png" class="panah-pricing">
</a><a href="/admin/register2" class="clight back-pricing" lang="en">Back to Register</a>

<div class="container-fluid mg-pricing">
    <div class="row">
        <div class="col-md-5">
            <h4 class="cgrey" lang="en" lang="en">Choose your plan</h4>
            <p class="cgrey2 s15" lang="en">Select our pricing plan that fits your Community Business</p>
        </div>

        <div class="col-sm"></div>

        <div class="col-md-5" style="text-align: right;">
            <div class="btn-group btn-group-lg btn_time_pricingq" role="group">
                <button type="button" class="btn btn-oren1 timeprice active" onclick="setIdTimePricing(this.value)"
                    id="time-pricing1" value="1" lang="en">Onetime</button>

                <button type="button" class="btn btn-oren2 timeprice" onclick="setIdTimePricing(this.value)"
                    id="time-pricing2" value="2" lang="en">Monthly</button>

                <button type="button" class="btn btn-oren3 timeprice" onclick="setIdTimePricing(this.value)"
                    id="time-pricing3" value="3" lang="en">Annual</button>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" style="text-align: center; margin-top: 1em;">
        <div class="card-deck price-ajax" style="padding-left: 9%; padding-right: 9%;">

        </div>
    </div> <!-- end-row -->



    <!-- <div class="row price-ajax" id="tempat-price">


</div> -->
</div>


@endsection


@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {
        get_pricing();
    });

    var id_fitur = "";
    var isi = "";
    // $("#time-pricing1" ).click(function() {
    //   $( "#tampung_idtime").value(this.value);
    // });

    function cekawalpricing() {
        var tampung = $(".isitime").val();

        if (tampung === "") {
            $(".price-ajax").hide();
            $("#time-pricing1").removeClass("active");
            $("#time-pricing2").removeClass("active");
            $("#time-pricing3").removeClass("active");
            $(".hidetime1").hide();
            $(".hidetime2").hide();
            $(".hidetime3").hide();
        }

    }


    function setIdTimePricing(idtime) {
        $(".price-ajax").fadeIn(900);
        $(".isitime").val(idtime);
        idtime1 = idtime;

        if (idtime === "1") {
            $("#time-pricing1").addClass("active");
            $("#time-pricing2").removeClass("active");
            $("#time-pricing3").removeClass("active");
            $(".hidetime1").fadeIn(500);
            $(".hidetime2").hide();
            $(".hidetime3").hide();
        } else if (idtime === "2") {
            $("#time-pricing1").removeClass("active");
            $("#time-pricing2").addClass("active");
            $("#time-pricing3").removeClass("active");
            $(".hidetime1").hide();
            $(".hidetime2").fadeIn(500);
            $(".hidetime3").hide();
        } else {
            $("#time-pricing1").removeClass("active");
            $("#time-pricing2").removeClass("active");
            $("#time-pricing3").addClass("active");
            $(".hidetime1").hide();
            $(".hidetime2").hide();
            $(".hidetime3").fadeIn(500);
        }
    }

    //dropdown get jenis komunitas
    function get_pricing() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/get_pricing_com",
            type: "POST",
            dataType: "json",
             beforeSend: function () {
                $('#mdl-loadingajax').modal('show');
            },
            success: function (status, code, data) {
                console.log(status.data);
                var html = '';
                var noimg = '/img/fiturs.png';

                $.each(status.data, function (i, item) {
                    var idprice = item.id;
                    var subfitur = '';
                    $.each(item.pricing_features, function (i, subitem) {
                        subfitur += '<li class="cgrey2">' + subitem.feature.title + '</li>';
                    });

                    html += '<div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:1em;">' +
                        '<div class="card cd-pricing pricing' + idprice + '">' +
                        '<div class="card-body pricing">' +
                        '<center>' +
                        '<h5 class="card-title">' + item.title + '</h5>' +
                        '<img src="' + server_cdn + item.icon + '"  class="rounded-circle img-fluid imgprice"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="hidetime1">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6" lang="en">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong>' + rupiah(item.grand_pricing) + '</strong></label>' +
                        '<small class="clight" lang="en"> /Once</small>' +
                        '</div>' +
                        '<div class="hidetime2">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6" lang="en">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong> ' + rupiah(item.price_monthly) + '</strong></label>' +
                        '<small class="clight" lang="en"> /Month</small>' +
                        '</div>' +
                        '<div class="hidetime3">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6" lang="en">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong>' + rupiah(item.price_annual) + '</strong></label>' +
                        '<small class="clight" lang="en"> /Year</small>' +
                        '</div>' +
                        '<label class="coren s14" lang="en">or choose another pricing time</label>' +
                        '<form method="POST" action="{{route('pricingkefitur')}}"> {{ csrf_field() }}' +
                            '<input type="hidden" name="idprice" value="' + idprice + '">' +
                            '<input type="hidden" name="harganya" value="' + item.grand_pricing + '">' +
                            '<input type="hidden" name="payment_time" class="isitime" value="">' +
                            '<button type="submit" class="btn btn-sm clr-oren klik-pricing" style="margin-bottom: 0.5em;" lang="en">Get Now</button>' +
                            '</form>' +
                            '</center>' +
                            '<h6 class="cgrey" style="margin-top:0.6em;" lang="en">Package Include</h6>' +
                            '<div class="row" style="padding-left:25%;"><small style="text-align:left;">' + subfitur + '</small></div></div></div></div>';
                });
                $('.price-ajax').html(html);
                  setTimeout(function () {
                    $('#mdl-loadingajax').modal('hide');
                }, 4000);
                cekawalpricing();
                get_session_pricing();
                $("#time-pricing1").click();
            },
             error: function (result) {
                console.log("Cant Show All Data Regis");
            },
        });
    }



    function get_session_pricing() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/session_pricing',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                if (result != "") {
                    var idtime = result.payment_time;
                    $(".price-ajax").fadeIn(900);
                    $("#time-pricing" + idtime).css('font-weight', 'bold');
                     $("#time-pricing" + idtime).css('background', 'linear-gradient(to right, rgb(251, 248, 234) 0%, rgb(251, 255, 199) 51%, rgb(255, 249, 225) 100%)');
                    $("#time-pricing" + idtime).css('color', '#2b4690');
                    // $(".pricing" + result.pricing_id).css("box-shadow", "0 0 20px yellow");
                    $(".cd-pricing").css("opacity", "0.6");
                    $(".pricing" + result.pricing_id).css("opacity", "1");
                    $(".pricing" + result.pricing_id).addClass("active");
                    $(".isitime").val(idtime);

                    if (idtime === "1") {
                        $("#time-pricing1").addClass("active");
                        $("#time-pricing2").removeClass("active");
                        $("#time-pricing3").removeClass("active");
                        $(".hidetime1").fadeIn();
                        $(".hidetime2").hide();
                        $(".hidetime3").hide();
                    } else if (idtime === "2") {
                        $("#time-pricing1").removeClass("active");
                        $("#time-pricing2").addClass("active");
                        $("#time-pricing3").removeClass("active");
                        $(".hidetime1").hide();
                        $(".hidetime2").fadeIn();
                        $(".hidetime3").hide();
                    } else {
                        $("#time-pricing1").removeClass("active");
                        $("#time-pricing2").removeClass("active");
                        $("#time-pricing3").addClass("active");
                        $(".hidetime1").hide();
                        $(".hidetime2").hide();
                        $(".hidetime3").fadeIn();
                    }
                }
            },
            error: function (result) {
                console.log("Cant Reach Session Pricing");
            }
        });
    }
</script>
@endsection
