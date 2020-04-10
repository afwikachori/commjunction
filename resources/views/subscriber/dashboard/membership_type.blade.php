@extends('layout.subscriber')
@section('title', 'Membership Type')
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
            <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                data-target="#modal_confirmpay_membership">
                Payment Confirmation</button>
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
                <p class="cgrey2" style="margin-bottom: 0.5em;">Our Community Administrators are on their way to approve
                    your account, please check
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



<!-- MODAL MEMBERSHIP PAY CONFIRMATION -->
<div id="modal_confirmpay_membership" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="modal_confirmpay_membership" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 65%; margin: auto;">
            <form method="POST" id="form_confirm_membership_subs" action="{{route('confirm_pay_membership_subs')}}"
                enctype="multipart/form-data"> {{ csrf_field() }}
                <div class="modal-body" style="min-height: 365px; height: auto; padding-right: 10%; padding-left: 10%;">

                    <img src="/visual/kananatas2.png" class="img_confirm1">
                    <img src="/visual/imgregis.png" class="img_confirm2">

                    <h3 style="margin-top: 1.3em; margin-bottom: 1em; margin-left: -15px;">Confirm your
                        Membership Payment !</h3>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group row">
                                <label class="h6 cgrey">Invoice Number</label>
                                <input id="invoice_number" type="text"
                                    class="form-control @error('invoice_number') is-invalid @enderror"
                                    name="invoice_number" value="{{ old('invoice_number') }}" required
                                    autocomplete="invoice_number" placeholder="Paste Invoice Number"
                                    style="background-color: #e9ecef; border-radius: 6px;">
                                @if($errors->has('invoice_number'))
                                <small style="color: red;">{{ $errors->first('invoice_number')}}</small>
                                @endif
                            </div>
                            <br>
                            <div id="isi_form" style="display: none;">
                                <div class="form-group row">
                                    <label class="h6 cgrey">Image Of Payment</label>
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input form-control @error('fileup') is-invalid @enderror"
                                            name="fileup" value="{{ old('fileup') }}" required autocomplete="fileup"
                                            id="fileup" required>
                                        <label class="custom-file-label" for="fileup" style="text-align: left;">Choose
                                            file</label>

                                        @if($errors->has('fileup'))
                                        <small style="color: red;">Extension is <i>.jpg / .jpeg /
                                                .PDF</i></small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end  col-4 -->
                        <div class="col-1">
                        </div>

                        <div class="col-4" id="detil_pay">
                            <div class="form-group" style="margin-top: 0.5em;">
                                <small class="clight2 mgb-05">Total Payment</small>
                                <h6 class="cgrey1" id="nominal_payment1"></h6>
                            </div>

                            <div class="form-group">
                                <small class="clight2 mgb-05">Account Number</small>
                                <h6 class="cgrey1" id="bank_num"></h6>
                            </div>

                            <div class="form-group">
                                <small class="clight2 mgb-05">Bank Name</small>
                                <h6 class="cgrey1" id="bank_receiver"></h6>
                            </div>

                            <div class="form-group">
                                <small class="clight2 mgb-05">Name Receiver</small>
                                <h6 class="cgrey1" id="name_receiver"></h6>
                            </div>

                            <div class="form-group" id="hidein-img">
                                <small class="clight2 mgb-05">Your Image Payment</small>
                                <br>
                                <img id="show_imgpay" class="img-fluid rounded float-left" src="" data-toggle="tooltip"
                                    data-placement="right" title="Double Click to Preview"
                                    style="width: 20%; margin-top: 0.3em; height: auto;display: none;"
                                    onclick="clickImage(this)">
                            </div>
                        </div> <!-- end detail-pay -->
                    </div> <!-- end row -->
                </div>
                <div class="modal-footer" style="border: none;">
                    <img src="/visual/kiribawah2.png" class="img_confirm3">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                        style="width: 110px;">Close</button> &nbsp;
                    <button type="submit" id="btn_confirmpay" class="btn btn-teal btn-sm"
                        style="width: 110px;">Submit</button>
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
        hidenlah_confirm_member();

        get_pricing_membership();
        get_payment_initial();



    });

    function hidenlah_confirm_member() {
        $("#detil_pay").css("display", "none");
        $("#name_userpay").attr("disabled", 'disabled');
        $("#fileup").attr("disabled", 'disabled');
        $("#btn_confirmpay").css("display", "none");
        $("#hidein-img").css("display", "none");

    }





    $('input#invoice_number').bind("change keyup input", function () {
        var inin = $(this).val();
        get_invoice_num(inin);
    });




    function get_invoice_num(input) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_invoice_num_membership',
            data: {
                "invoice_number": input,
                "transaction_type_id": "3",
                "community_id": $(".id_komunitas").val()
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/admin';
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    $("#isi_form").show();
                    var isi = result[0];
                    $("#detil_pay").fadeIn();
                    $("#name_userpay").removeAttr("disabled", 'disabled');
                    $("#fileup").removeAttr("disabled", 'disabled');
                    $("#btn_confirmpay").fadeIn();
                    var tf = isi.comm_payment_method;
                    $("#nominal_payment1").html("Rp &nbsp;&nbsp;" + rupiah(isi.grand_total));
                    $("#bank_receiver").html(tf.payment_bank_name);
                    $("#name_receiver").html(tf.payment_owner_name);
                    $("#bank_num").html(tf.payment_account);

                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant invoice number");

            }
        });

    }



    var idku = $('#id_pop_payment').val();
    //showfile name upload icon
    $('#fileup').on('change', function () {
        // menampilkan img
        previewImgUpload("show_imgpay", this);
        $("#hidein-img").fadeIn();

        var fileName = $(this).val();
        if (fileName.length > 30) {
            var fileNameFst = fileName.substring(0, 30);
            $(this).next('.custom-file-label').html(fileNameFst + "...");
        } else {
            $(this).next('.custom-file-label').html(fileName);
        }
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
