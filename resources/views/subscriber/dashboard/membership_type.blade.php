@extends('layout.subscriber')

@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Membership Type</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your memberbership type<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
</div>

<div class="row" style="padding-left:8%; padding-right: 8%; padding-top: 5%;">
    <div class="col-12">
        <div class="card">
            <nav class="navbar nav-biru">
            </nav>
            <div class="card-body member">
                <h4 class="tebal">Choose your plan</h4>
                <p class="cgrey2" style="margin-bottom: 0.5em;">Our Community Administrators are on their way to approve your account, please check
                    our
                    email!</p>
                <div class="row justify-content-center" style="text-align: center; padding-left:2%; padding-right: 3%;">
                    <div class="card-deck price_member">

                    </div>
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
                    <h3 class="cgrey" style="margin-bottom: 1.5em; margin-top:1em;">Choose Payment Method</h3>
                    <div class="row" style="margin-bottom: 0.5em;">
                        <div class="col-md-12">
                            <h5 class="h5 clight">Membership Price</h5>
                            <small class="cgrey2">Rp &nbsp;</small>
                            <span class="h6 cblue" id="harga_member"></span>&nbsp;
                            <small class="cgrey2"> ,-</small>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="h6 clight">Choose Payment Method</h6>
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
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = $(".server_cdn").val();
    $(document).ready(function () {
        get_pricing_membership();
        get_payment_initial();
    });

    // function get_pricing_membership() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "/subscriber/get_pricing_membership",
    //         type: "POST",
    //         dataType: "json",
    //         success: function (result) {
    //             // console.log(result);
    //             var html = '';
    //             var noimg = '/img/fitur.png';
    //             $.each(result, function (i, item) {
    //                 // console.log(item);
    //                 var idprice = item.id;

    //                 html += '<div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:0.2em;">' +
    //                     '<div class="card cd-pricing pricing' + idprice + '">' +
    //                     '<div class="card-body">' +
    //                     '<center>' +
    //                     '<h4 class="cgrey2 s20" style="margin-top: 0.7em;">' + item.membership + '</h4>' +
    //                     '<img src="' + server_cdn + item.icon + '"  class="rounded-circle img-fluid imgprice"' +
    //                     'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
    //                     '<div class="hidetime1">' +
    //                     '<sup class="cgrey" style="font-size: 30px;">' +
    //                     '<small class="h6">IDR</small></sup>' +
    //                     '<label class="card-harga cgrey">' +
    //                     '<strong>' + rupiah(item.pricing) + '</strong></label>' +
    //                     '<small class="clight"> /Once</small>' +
    //                     '</div>' +
    //                     '<button type="submit" class="btn clr-blue klik-pricing" style="margin-top: 0.5em;"' +
    //                     'onclick="pilih_payment_initial(\'' + idprice + '<>' + item.pricing + '\')">Get Now</button>' +
    //                     '</center>' +
    //                     '</div></div></div>';
    //             });
    //             $('.price_member').html(html);
    //         }
    //     });
    // }

    // function get_payment_initial() {
    //     $("#btn_submit_paymethod").attr("disabled", "disabled");
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: '/subscriber/get_payment_initial',
    //         type: 'POST',
    //         dataSrc: '',
    //         timeout: 30000,
    //         success: function (result) {
    //             console.log(result);
    //             var text = '';
    //             var isibank = '';

    //             $.each(result, function (i, item) {
    //                 text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value="' + item.id + '"' +
    //                     'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';

    //                 var des = item.comm_payment_type;
    //                 isibank = '<div class="hidenlah">' +
    //                     '<h6 class="cgrey">' + des.payment_title + '</h6>' +
    //                     '<p class="clight">' + des.description + '</p>' +
    //                     '</div>';
    //             });
    //             $(".isi_method_pay").html(text);
    //             $(".isi_show_bank").html(isibank);

    //         },
    //         error: function (result) {
    //             console.log(result);
    //             console.log("Cant Show");
    //         }
    //     });
    // }

    // function pilih_payment_initial(dtmember) {
    //     $("#id_membertype").val("");
    //     var dt = dtmember.split('<>');

    //     if(dt[1] != 0){
    //     $("#modal_pay_initial").modal('show');
    //     $("#harga_member").html(rupiah(dt[1]));
    //     $("#id_membertype").val(dt[0]);
    //       } else {
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             url: '/subscriber/set_initial_membership_pay',
    //             type: 'POST',
    //             dataSrc: '',
    //             timeout: 30000,
    //             data: {
    //                 "id_membertype": dt[0],
    //                 "id_pay_initial": "0",
    //             },
    //             success: function (result) {
    //                 console.log(result);
    //                 if (result.success == false) {
    //                     if (result.status == 401 || result.message == "Unauthorized") {
    //                         ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
    //                         setTimeout(function () {
    //                             location.href = '/admin';
    //                         }, 5000);
    //                     } else {
    //                         ui.popup.show('warning', result.message, 'Warning');
    //                     }
    //                 } else {
    //                     swal("Successfully", "Waiting your membership confirmation from Administrator", "success");
    //                     setTimeout(function () {
    //                         window.location.reload();
    //                     }, 3500);
    //                 }
    //             },
    //             error: function (result) {
    //                 console.log(result);
    //                 console.log("Cant Show");
    //             }
    //         });

    //     }
    // }

    // function pilih_pay_bank(ini) {
    //     console.log(ini.value);
    //     $("#id_pay_initial").val("");
    //     $(".hidendulu").removeClass('dipilih');
    //     $('.btn-blueline').removeClass('active');
    //     $("#" + ini.id).addClass('active');
    //     $(".hidenlah").show();
    //     $("#id_pay_initial").val(ini.value);
    //       if ($("#id_pay_initial").val() != "") {
    //         $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
    //     }
    // }


</script>



@endsection
