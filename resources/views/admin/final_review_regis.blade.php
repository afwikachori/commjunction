@extends('layout.app')
@section('title', 'COMMJUNCTION APP')
@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="/admin/payment" class="review_back">
    <img border="0" src="/visual/left-arrow.png" id="left_backpay">
</a><a href="/admin/payment" class="clight backarrow1 review_back" lang="en">Back to Previous</a>

<div class="contain-pay">
    <div class="row">
        <div class="col-md">
            <h3 class="cgrey" lang="en" id="judul_finalregis" lang="en">Verify Your Information</h3>
            <small class="clight" data-lang-token="reviewadmin">Final step for your Community Registration, please verify information details you already submitted</small>
            <br>
            <!-- <h6 style="margin-top: 1em; margin-bottom: 1em;" class="cgrey"> Personal Information</h6> -->

            <div class="row" style="margin-top: 1em;">

                <div class="col-7">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Full Name</small>
                        <h6 class="cgrey1" id="fullname">-</h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Address</small>
                        <h6 class="cgrey1" id="alamat">-</h6>
                    </div>
                </div>

                <div class="col-5">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Phone Number</small>
                        <h6 class="cgrey1" id="phone">-</h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Username</small>
                        <h6 class="cgrey1" id="username">-</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Email</small>
                        <h6 class="cgrey1" id="email">-</h6>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Password</small>
                        <div class="row">
                            <div class="col-7">
                                <input type="password" id="password_admin_review" readonly
                                    class="form-control-plaintext cgrey1 h6" value="">
                            </div>
                            <div class="col-2">
                                <button type="button" id="btn_showpass_review" onclick="showPass()">
                                    <span class="fa fa-eye" id="ico-mata" aria-hidden="true"
                                        style="color: grey;"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: -0.5em;">
                <div class="col-md-7">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Community Name</small>
                        <h6 class="cgrey1" id="komunitas_name">-</h6>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="form-group" style="width: 185px;">
                        <small class="clight2 mgb-05" lang="en">Community Type</small>
                        <h6 class="cgrey1" id="etcjenis" style="display: none;">
                            -</h6>
                            <h6 class="cgrey1" id="jenis_kom2">-</h6>
                        <select id="jenis_kom" class="form-control s13 review" name="jenis_kom" style="display: none;"
                            disabled>
                        </select>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-10">
                    <small class="clight2 mgb-05" lang="en">Description Community</small>
                    <h6 class="cgrey1 s13" id="deskripsi_kom">
                        -
                </div>
            </div>

        </div>
        <div class="col-md">
            <div class="row">
                <div class="col">
                    <h5 class="cgrey" lang="en">Feature</h5>
                </div>
                <div class="col" style="text-align: right;">
                    <h6 class="clight2 s14"><span id="hitungcentangq">0</span> &nbsp; <span lang="en">Features Selected</span></h6>
                </div>
            </div>

            <div class="scrollmenu">
                <div class="row" id="isinyafitur">


                </div> <!-- end-row -->
            </div> <!-- end-scrollmenu -->

            <h6 style="margin-top: 1.5em; margin-bottom: 1em;" class="cgrey" lang="en">Payment Information</h6>

            <div class="row" style="margin-top: 1em;">
                <div class="col-6">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Pricing Time</small>
                        <h6 class="cgrey1" id="pricingtime">-
                        </h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Price</small><br>
                        <span class="cgrey1 h6" id="hargaprice"></span>
                        <small id="satuanwaktu" style="color: #2d99f7;"></small>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05 hidepayment" lang="en">Payment Method</small>
                        <h6 class="cgrey1" id="judulpay"></h6>
                    </div>

                    <form method="POST" id="form_create_community" action="{{route('FinalAdminRegis')}}">
                        {{ csrf_field() }}
                        <button type="submit" name="btn_finish_createcom" value="finish" class="btn btn-oren btn-sm"
                            lang="en" style="width: 100px; margin-top: 1em;" lang="en">Finish</button>
                    </form>


                </div> <!-- end col-6 -->

                <div class="col-md-6">
                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Package Title</small>
                        <h6 class="cgrey1" id="judulprice"></h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05" lang="en">Package Description</small>
                        <h6 class="cgrey1" id="deskriprice"></h6>
                    </div>

                    <div class="form-group hidepayment">
                        <small class="clight2 mgb-05" lang="en">Bank Name</small>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="cgrey1" id="bankname"></h6>
                            </div>
                            <div class="col">
                                <img src="/img/loading.gif" id="imgpaymentr"
                                    onerror="this.onerror=null;this.src='/img/money.png';">
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- //end pay -->
        </div> <!-- end-col kanan -->
    </div> <!-- end-row -->
</div> <!-- end-contain -->


<div class="footer-admin">
    <div class="row">
        <div class="col">
            <img src="/visual/commjuction.png" id="com_superadminlogin">
            <div class="textfooter-kiri">
                <a href="" class="cgrey"><small lang="en">Privacy Police</small></a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="" class="cgrey"><small lang="en">Terms and Condition</small></a>
            </div>
        </div>

        <div class="col textfooter-kanan">
            <a href="" class="cgrey h6 s13" lang="en">Documentation</a>
            <span class="fa fa-circle" aria-hidden="true" style="color: #D96120;"></span>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="" class="cgrey h6 s13" lang="en">Support</a>
            <span class="fa fa-question" aria-hidden="true" style="color: #D96120;"></span>
        </div>
    </div>
</div>


@endsection



@section('script')
<script type="text/javascript">
    var server_cdn = $("#server_cdn").val();
    var noimg = '/img/fiturs.png';

    $(document).ready(function () {
        GetAllDataRegisAdmin();

    });


    function GetAllDataRegisAdmin() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/GetAllDataRegisAdmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            beforeSend: function () {
                $('#mdl-loadingajax').modal('show');
            },
            success: function (result) {
                console.log(result);

                var komunitas = result.community;
                $("#komunitas_name").html(komunitas.name);
                $("#deskripsi_kom").html(komunitas.description);

                var admin = result.admin;
                $("#fullname").html(admin.full_name);
                $("#alamat").html(admin.alamat);
                $("#email").html(admin.email);
                $("#phone").html(admin.notelp);
                $("#username").html(admin.user_name);
                $("#password_admin_review").val(admin.password);

                if (komunitas.cust_jenis_comm != null) {
                    $("#etcjenis").html(komunitas.cust_jenis_comm);
                    $('#etcjenis').show();
                    $('#jenis_kom2').hide();
                } else {
                    var idjenis = komunitas.jenis_comm_id;
                    get_jenis(idjenis);
                    $('#etcjenis').hide();
                    $('#jenis_kom2').show();
                }
                var idpricing = result.payment.pricing_id;
                var timepricing = result.payment.payment_time;
                get_pricing_selected(idpricing, timepricing);
                get_selectedfitur(result.feature);

                setTimeout(function () {
                    $('#mdl-loadingajax').modal('hide');
                }, 4000);

                if (result.free == "0") {
                    $(".hidepayment").hide();
                    $(".review_back").attr("href", "/admin/features");
                } else {
                    $(".review_back").attr("href", "/admin/payment");
                    get_payment_selected(result.payment.payment_id);
                }


            },
            error: function (result) {
                console.log("Cant Show All Data Regis");
                $('#mdl-loadingajax').modal('hide');
            },
            complete: function (result) {
                $('#mdl-loadingajax').modal('hide');
            }
        });
    }

    function get_jenis(idjenis) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/get_jenis_com",
            type: "POST",
            dataType: "json",
            success: function (result) {
                var data = result;

                $('#jenis_kom').empty();
                $('#jenis_kom').append("<option disabled> --- </option>");

                for (var i = data.length - 1; i >= 0; i--) {
                    $('#jenis_kom').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
                }
                //Short Function Ascending//
                $("#jenis_kom").html($('#jenis_kom option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#jenis_kom").get(0).selectedIndex = 0; //e.preventDefault();
                // }
                const OldValue = '{{old("' + idjenis + '")}}';

                if (OldValue !== '') {
                    $('#jenis_kom').val(idjenis);
                }

                $('#jenis_kom').val(idjenis);
                $('select[name="jenis_kom"]').val(idjenis);
                 var set = $("#jenis_kom option:selected").text();
                 $("#jenis_kom2").html(set);


            }
        });
    } //endfunction

    function get_selectedfitur(idfitur) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedFitur',
            data: { 'id': idfitur },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                var html = "";

                $.each(result.data, function (i, item) {
                    html += '<div class="col-3">' +
                        '<div class="card cardku" style="width: 6.5rem; height: 6.5rem; border-radius:10px;">' +
                        '<div class="card-body" style="padding: 0.5em !important;">' +
                        '<div class="roundcheck2">' +
                        '<input type="checkbox" disabled class="boxfitur" name="feature_id[]" value="' + item.id + '" id="fitur' + item.id + '"/>' +
                        '<label for="fitur' + item.id + '"></label>' +
                        '</div><center>' +
                        '<img class="rounded-circle img-fluid" src="' + server_cdn + cekimage_cdn(item.logo) + '" style="width: 35px;' +
                        'height:auto; margin-bottom:0.5em; margin-top:0.6em;"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<h6 class="clight s13 text-wrap width-90">' + item.title + '</h6>' +
                        '</center></div></div></div>';

                });
                $("#isinyafitur").html(html);
                $(".boxfitur").prop("checked", true);

                var ceklis = $('input[type="checkbox"]:checked').length;
                $("#hitungcentangq").text(ceklis);

            },
            error: function (result) {
                console.log("Cant Show selected features!");
            }
        });

    }

    function get_pricing_selected(idpricing, pricingtime) {
        // swal(idpricing);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedPrice',
            data: { 'id': idpricing },
            type: 'POST',
            datatype: 'JSON',
            beforeSend: function () {
                $('#mdl-loadingajax').modal('show');
            },
            success: function (result) {
                // console.log(result.data);
                $.each(result.data, function (i, item) {
                    $("#judulprice").html(item.title);
                    $("#deskriprice").html(item.description);
                    if (pricingtime == '1') {
                        $("#hargaprice").html(rupiah(item.grand_pricing));
                        $("#satuanwaktu").html("  / Once");
                        $("#pricingtime").html("Onetime");
                    } else if (pricingtime == '2') {
                        $("#hargaprice").html(item.price_monthly);
                        $("#satuanwaktu").html("  / Monthly");
                        $("#pricingtime").html("Month");
                    } else {
                        $("#hargaprice").html(item.price_annual);
                        $("#satuanwaktu").html(" / Year");
                        $("#pricingtime").html("Annual");
                    }

                });
            },

            error: function (result) {
                console.log("Cant Show selected Pricing!");
            },

        });
    }

    function get_payment_selected(id_pay) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedPayment',
            data: { 'id': id_pay },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result.data);
                $.each(result.data, function (i, item) {
                    $("#judulpay").html(item.payment_title);
                    $("#bankname").html(item.payment_bank_name);
                    var payimg = server_cdn + cekimage_cdn(item.icon);
                    $("#imgpaymentr").attr("src", payimg);
                });
                 $(".hidepayment").show();
                $('#mdl-loadingajax').modal('hide');
            },
            error: function (result) {
                console.log("Cant Show selected Pricing!");
                $('#mdl-loadingajax').modal('hide');
            }

        });

    }


    function showPass() {
        var a = document.getElementById("password_admin_review");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }





</script>
@endsection
