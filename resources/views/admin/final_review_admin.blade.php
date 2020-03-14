@extends('layout.app')

@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="{{route('isi_payment')}}">
    <img border="0" src="/visual/left-arrow.png" id="left_backpay">
</a><a href="{{route('isi_payment')}}" class="clight backarrow1">Back to Payment</a>

<div class="contain-pay">
    <div class="row">

        @foreach(Session::get('fadmin') as $dt)

        <div class="col-md">
            <h3 class="cgrey" lang="en" id="judul_finalregis">Verify</h3>
            <small class="clight" data-lang-token="reviewadmin">Here we are, that is the last step you have seen. Please
                verify the data that
                have you complete.
            </small>
            <br>
            <!-- <h6 style="margin-top: 1em; margin-bottom: 1em;" class="cgrey"> Personal Information</h6> -->

            <div class="row" style="margin-top: 1em;">

                <div class="col-7">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Full Name</small>
                        <h6 class="cgrey1">{{ $dt['admin']['full_name'] }}</h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Address</small>
                        <h6 class="cgrey1">{{ $dt['admin']['alamat'] }}</h6>
                    </div>
                </div>

                <div class="col-5">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Phone Number</small>
                        <h6 class="cgrey1">{{ $dt['admin']['notelp'] }}</h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Username</small>
                        <h6 class="cgrey1">{{ $dt['admin']['user_name'] }}</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Email</small>
                        <h6 class="cgrey1">{{ $dt['admin']['email'] }}</h6>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Password</small>
                        <div class="row">
                            <div class="col-7">
                                <input type="password" id="password_admin_review" readonly
                                    class="form-control-plaintext cgrey1 h6" value="{{ $dt['admin']['password'] }}">
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
                        <small class="clight2 mgb-05">Community Name</small>
                        <h6 class="cgrey1">{{ $dt['community']['name'] }}</h6>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Community Type</small>
                        <h6 class="cgrey1" id="etcjenis" style="display: none;">
                            {{ $dt['community']['cust_jenis_comm'] }}</h6>
                        <select id="jeniscom2" class="form-control s13" name="jeniscom2" disabled
                            style="display: none;">
                        </select>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-10">
                    <small class="clight2 mgb-05">Description Community</small>
                    <h6 class="cgrey1 s13">
                        {{ $dt['community']['description'] }}</h6>
                </div>
            </div>

        </div>
        <div class="col-md">
            <div class="row">
                <div class="col">
                    <h5 class="cgrey">Selected Feature</h5>
                </div>
                <div class="col" style="text-align: right;">
                    <h6 class="clight2 s14"><span id="hitungcentangq">0</span> Features Selected</h6>
                </div>
            </div>

            <div class="scrollmenu">
                <div class="row" id="isinyafitur">


                </div> <!-- end-row -->
            </div> <!-- end-scrollmenu -->

            <h6 style="margin-top: 1.5em; margin-bottom: 1em;" class="cgrey"> Payment Information</h6>

            <div class="row" style="margin-top: 1em;">
                <div class="col-6">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Pricing Time</small>
                        <h6 class="cgrey1" id="pricingtime">
                            @if ($dt["payment"]["payment_time"] === '1')
                            <div lang="en">Onetime</div>
                            @elseif ($dt["payment"]["payment_time"] === '2')
                            <div lang="en">Monthly</div>
                            @else
                            <div lang="en">Annual</div>
                            @endif
                        </h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Preffered Price</small><br>
                        <span class="cgrey1 h6" id="hargaprice"></span>
                        <small id="satuanwaktu" style="color: #2d99f7;"></small>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Payment Method</small>
                        <h6 class="cgrey1" id="judulpay"></h6>
                    </div>

                    <button type="button" onclick="window.location='/FinalAdminRegis'" class="btn btn-oren btn-sm"
                        lang="en" style="width: 100px; margin-top: 1em;">Finish</button>

                </div> <!-- end col-6 -->

                <div class="col-md-6">
                    <div class="form-group">
                        <small class="clight2 mgb-05">Package Title</small>
                        <h6 class="cgrey1" id="judulprice"></h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Package Description</small>
                        <h6 class="cgrey1" id="deskriprice s13"></h6>
                    </div>

                    <div class="form-group">
                        <small class="clight2 mgb-05">Bank Name</small>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="cgrey1" id="bankname"></h6>
                            </div>
                            <div class="col">
                                <img src="/img/loading.gif" id="imgpaymentr"
                                    onerror="this.onerror=null;this.src='/img/fitur.png';">
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- //end pay -->
        </div> <!-- end-col kanan -->
        @endforeach
    </div> <!-- end-row -->
</div> <!-- end-contain -->


<div class="footer-admin">
    <div class="row" style="margin-top: 1em;">
        <div class="col">
            <img src="/visual/commjuction.png" id="com_superadminlogin">
            <div class="textfooter-kiri">
                <a href="" class="cgrey"><small>Privacy Police</small></a>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a href="" class="cgrey"><small>Terms and Condition</small></a>
            </div>
        </div>

        <div class="col textfooter-kanan">
            <a href="" class="cgrey h6 s13">Documentation</a>
            <span class="fa fa-circle" aria-hidden="true" style="color: #D96120;"></span>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="" class="cgrey h6 s13">Support</a>
            <span class="fa fa-question" aria-hidden="true" style="color: #D96120;"></span>
        </div>
    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';

    $(document).ready(function () {

        get_jenis();
        get_selectedfitur();
        get_pricenyid();
        get_paybyid();

    });

    function showPass() {
        var a = document.getElementById("password_admin_review");
        if (a.type == "password") {
            a.type = "text";
        } else {
            a.type = "password";
        }
    }


    //dropdown get jenis komunitas
    function get_jenis() {
        var a = '{!! $dt["community"]["jenis_comm_id"] !!}';

        if (a === '1') {
            $('#etcjenis').show();
            $('#jeniscom2').hide();
        } else {
            $('#etcjenis').hide();
            $('#jeniscom2').show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/get_jenis_com",
                type: "POST",
                dataType: "json",
                success: function (status, code, data) {
                    // console.log(status.data);

                    if (status.success == true) {
                        var data = status.data;

                        $('#jeniscom2').empty();
                        $('#jeniscom2').append("<option disabled> --- </option>");

                        for (var i = data.length - 1; i >= 0; i--) {
                            $('#jeniscom2').append("<option value=\"".concat(data[i].id, "\">").concat(data[i].jenis_comm, "</option>"));
                        }
                        //Short Function Ascending//
                        $("#jeniscom2").html($('#jeniscom2 option').sort(function (x, y) {
                            return $(x).val() < $(y).val() ? -1 : 1;
                        }));

                        $("#jeniscom2").get(0).selectedIndex = 0; //e.preventDefault();
                    }
                    const OldValue = '{{old("jeniscom2")}}';

                    if (OldValue !== '') {
                        $('#jeniscom2').val(OldValue);
                    }
                    var isijenis = "{!! $dt['community']['jenis_comm_id'] !!}";
                    var isirange = "{!! $dt['community']['range_member'] !!}";

                    $('select[name="jeniscom2"]').val(isijenis);
                    $('select[name="range_member2"]').val(isirange);

                }
            });
        }
    } //endfunction



    function get_selectedfitur() {
        var val = '{!! json_encode($dt["feature"]) !!}';
        var listfitur = JSON.parse(val);
        // alert(val);
        // console.log("fitur dipilih : "+listfitur);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedFitur',
            data: { 'id': listfitur },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                var html = "";

                $.each(result.data, function (i, item) {
                    html += '<div class="col-3">' +
                        '<div class="card cardku" style="width: 6.5rem; height: 6.5rem;">' +
                        '<div class="card-body" style="padding: 0.5em !important;">' +
                        '<div class="roundcheck2">' +
                        '<input type="checkbox" disabled class="boxfitur" name="feature_id[]" value="' + item.id + '" id="fitur' + item.id + '"/>' +
                        '<label for="fitur' + item.id + '"></label>' +
                        '</div><center>' +
                        '<img class="rounded-circle img-fluid" src="' + server_cdn + item.logo + '" style="width: 35px;'+
                        'height:auto; margin-bottom:0.5em; margin-top:0.6em;"'+
                        'onerror="errorImg()">' +
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

    //ON ERROR IMAGE
    function errorImg() {
        $('.rounded-circle').attr('src', '/img/fitur.png');
    }


    function get_pricenyid() {
        var val = '{!! json_encode($dt["payment"]["pricing_id"]) !!}';
        var listfitur = [JSON.parse(val)];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedPrice',
            data: { 'id': listfitur },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result.data);
                $.each(result.data, function (i, item) {
                    $("#judulprice").html(item.title);
                    $("#deskriprice").html(item.description);
    if ({!! $dt["payment"]["payment_time"]!!} == '1'){
                    $("#hargaprice").html(rupiah(item.grand_pricing));
                    $("#satuanwaktu").html("  / Once");
                }else if({!!$dt["payment"]["payment_time"]!!} == '2'){
            $("#hargaprice").html(item.price_monthly);
            $("#satuanwaktu").html("  / Month");
        }else {
            $("#hargaprice").html(item.price_annual);
            $("#satuanwaktu").html(" / Year");
        }

    });
      },

    error: function (result) {
        console.log("Cant Show selected Pricing!");
    }

});

  }



    function get_paybyid() {
        var val = '{!! json_encode($dt["payment"]["payment_id"]) !!}';
        var idpay = [JSON.parse(val)];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/getSelectedPayment',
            data: { 'id': idpay },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result.data);
                $.each(result.data, function (i, item) {
                    $("#judulpay").html(item.payment_title);
                    $("#bankname").html(item.payment_bank_name);
                    var payimg = server_cdn + item.icon;
                    $("#imgpaymentr").attr("src", payimg);
                });
            },

            error: function (result) {
                console.log("Cant Show selected Pricing!");
            }

        });

    }





</script>
@endsection
