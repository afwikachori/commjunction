@extends('layout.app')
@section('title', 'Payment')
@section('content')
<nav class="navbar navbar-light nav-oren">
</nav>

<a href="/admin/features">
    <img border="0" src="/visual/left-arrow.png" id="panah_pay">
</a><a href="/admin/pricing" class="clight backarrow-pay" lang="en" data-lang-token="Back to Features">Back to Features</a>

<div class="contain-pay">
    <h3 class="cgrey" lang="en" id="pay_judul" style="margin-top: 0.5em; margin-bottom: 0.5em;" lang="en">Payment Method</h3>

    <div class="row">
        <div class="col-md-6">
            <h6 class="h6 cgrey1" id="judul_pilihpay" lang="en">Click Payment Type Below</h6>

            <div id="isi_tipe_payment">

            </div>


        </div>
        <div class="col-md-5" id="showhide_pay" style="display: none;">
            <h6 class="h6 cgrey1" id="txt_paymethod" style="margin-bottom: 1em;" lang="en">Choose Payment Method</h6>

            <form method="POST" id="form_pay_admin" action="{{route('ReviewFinal')}}">
                {{ csrf_field() }}

                <div class="collapse-accordion" id="list_paymentmethod" role="tablist" aria-multiselectable="true">
                    <!-- isi card -->
                </div>
                <input type="hidden" name="id_pay_type" id="id_pay_type">
                <input type="hidden" name="id_pay_method" id="id_pay_method">
                <button type="submit" class="btn btn-oren btn-fluid" id="btn_pay_next" lang="en">Finish</button>
            </form>

        </div>
    </div>




    <div class="footer-admin">
        <div class="row" style="margin-top: 0em;">
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
        var server_cdn = '{{ env("CDN") }}';
        var noimg = '/img/fiturs.png';

        $(document).ready(function () {
            get_payment_method_regis();

        });

        function get_payment_method_regis() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/get_payment_method_regis',
                type: 'POST',
                datatype: 'JSON',
                success: function (result) {
                    // console.log(result);
                    var uipay = '';
                    $.each(result, function (i, item) {
                        uipay += '<button type="button" id="tipe' + item.id + '" class="btn btn-orenline col-md-5 btn-sm btn-fluid"' +
                            'value="' + item.id + '" onclick="getmethod_payment(this);"' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<i class="fa fa-exchange"></i> &nbsp; ' + item.payment_title + ' </button>&nbsp;&nbsp;';
                    });
                    $("#isi_tipe_payment").html(uipay);
                    get_session_payadmin();
                },
                error: function (result) {
                    console.log("Cant Reach Payment Method");
                }
            });
        }

        function pilihpay(idpay) {
            $("#id_pay_method").val(idpay);
            $(".border-oren").removeClass("active");
            $("#cardpay" + idpay).addClass("active");
            $("#btn_pay_next").removeAttr("disabled");
        }


        function getmethod_payment(ini) {
            $('.btn-orenline').removeClass('active');
            $(ini).addClass('active');
            var val = ini.value;
            $('#mdl-loadingajax').modal('hide');
            $("#id_pay_type").val(val);
            $("#btn_pay_next").attr("disabled", true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/getpayment_method',
                data: { 'payment_type_id': val },
                type: 'POST',
                datatype: 'JSON',
                beforeSend: function () {
                    $('#mdl-loadingajax').modal('show');
                },
                success: function (result) {
                    // console.log(result);
                    $("#showhide_pay").css("display", "block");
                    setTimeout(function () { $('#mdl-loadingajax').modal('hide'); }, 4000);
                    validasi_pay_next();

                    var html = '';
                    var text = '';

                    $.each(result.data, function (i, item) {
                        var isitext = '';
                        $.each(item.description, function (x, isides) {
                            isitext += '<li class="cgrey2">' + isides + '</li>';
                        });

                        html += '<div class="card border-oren" id="cardpay' + item.id + '">' +
                            '<div class="card-header payregis cardpay' + item.id + '" role="tab">' +
                            '<h6 class="mb-0 pdb1">' +
                            '<a class="payregis" data-toggle="collapse" data-parent="#list_paymentmethod" href="#collapseOne' + item.id + '" ' +
                            'id="idpayq' + item.id + '" onclick="pilihpay(' + item.id + ');" aria-expanded="true"' +
                            'aria-controls="collapseOne' + item.id + '">' +
                            '<img src="' + server_cdn + cekimage_cdn(item.icon) + '" class="imgepay" style="width: 10%; height: auto;"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + item.payment_title +
                            '<span class="float-right">' +
                            '<i class="fa fa-chevron-right simbol-payregis"></i>' +
                            '</span>' +
                            '</a></h6></div>' +
                            '<div id="collapseOne' + item.id + '" class="collapse" role="tabpanel" aria-labelledby="headingOne2">' +
                            '<div class="card-block payregis"><ul>' + isitext +
                            '</ul></div></div></div><br>';
                    });
                    $('#list_paymentmethod').html(html);
                },
                error: function (result) {
                    console.log("Cant get data payment method");
                    $('#mdl-loadingajax').modal('hide');
                },
                complete: function (result) {
                    $('#mdl-loadingajax').modal('hide');
                }
            });

        }



        function validasi_pay_next() {
            // $("#id_pay_method").val("");
            var idpay = $("#id_pay_method").val();
            if (idpay == "") {
                $("#btn_pay_next").attr("disabled", true);
            } else {
                $("#btn_pay_next").removeAttr("disabled");
            }
        }



        function get_session_payadmin() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/session_payadmin',
                type: 'POST',
                datatype: 'JSON',
                success: function (result) {
                    console.log(result);
                    if (result.id_tipe != "") {
                        $("#tipe" + result.id_tipe).trigger('click');
                        $("#id_pay_type").val(result.id_tipe);
                    }
                    if (result.id_pay != "") {
                        $("#id_pay_method").val(result.id_pay);
                        setTimeout(function () {
                            pilihpay(result.id_pay);
                        }, 3000);
                    }
                },
                error: function (result) {
                    console.log("Cant Reach Session Payment");
                }
            });
        }


    </script>
    @endsection
