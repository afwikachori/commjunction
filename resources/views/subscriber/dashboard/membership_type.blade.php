@extends('layout.subscriber')
@section('title', 'Membership Type')
@section('content')
<div class="row">
    <div class="col-md-2">
        <h3 class="page-title" lang="en">Membership Type</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey" lang="en">Manage your membership type<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            {{-- <button type="button" class="btn btn-tosca btn-sm"
            style="min-width: 175px;"
            data-toggle="modal"
            data-target="#modal_confirmpay_membership" lang="en">Payment Confirmation</button> --}}
            <input type="hidden" id="membership_id">
        </nav>
    </div>
</div>

<div style="text-align: center; display: none;" id="hide_membertipe">
    <br><br><br><br><br><br>
    <h1 class="clight" lang="en">No Data Available</h1>
</div>

<div class="row hideisimember" style="padding-left:8%; padding-right: 8%; padding-top: 5%;">
    <div class="col-12">
        <div class="card" style="background-color: #ffffff00 !important;">
            <h4 class="tebal" lang="en">Choose your Membership Plan</h4>
            <p class="cgrey2" style="margin-bottom: 0.5em;" lang="en"
                data-lang-token="please_choose_membership">Please
                choose one of the membership options provided by your Community</p>

            <div class="row justify-content-center" style="text-align: center; padding-left:2%; padding-right: 3%;">

                <div class="card-deck price_member" style="width: 100%;">

                </div>
            </div> <!-- end-row -->
        </div>
    </div>
</div>


<div class="row" id="show_mymember" style="display: none;">
    <div class="col-md-5" style="padding-left: 10%; padding-top: 4%;">

        <div class="card-deck" id="isi_show_mymember" style="width: 100%; margin: auto;">

        </div>
    </div>
    <div class="col-md-7">
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                     <h6 class="ctosca s13 tebal" lang="en">Title</h6>
                    <p class="cgrey s14" id="member_judul2"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                     <h6 class="ctosca s13 tebal" lang="en">Pricing</h6>
                    <p class="cgrey s14" id="member_harga2"></p>
                </div>
            </div>
        </div>

        <div class="form-group">
             <h6 class="ctosca s13 tebal" lang="en">Description</h6>
            <p class="cgrey s14" id="member_deskripsi2"></p>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                     <small class="ctosca s13 tebal">Features : </small> &nbsp;
                    <small class="ctosca s15" id="total_fitur_member2"> 0</small>
                </div>
            </div>
            <div class="card-deck" id="show_feature_member2"
                style="margin-top: 0.5em; width: 100%; overflow-y: auto; overflow-x: hidden; height:245px;">

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
                    <button type="submit" class="btn btn-teal btn-sm" id="btn_submit_paymethod"
                        lang="en">Submit</button>
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
        // get_pricing_membership();

    });



    // function hidenlah_confirm_member() {
    //     $("#detil_pay").css("display", "none");
    //     $("#name_userpay").attr("disabled", 'disabled');
    //     $("#fileup").attr("disabled", 'disabled');
    //     $("#btn_confirmpay").css("display", "none");
    //     $("#hidein-img").css("display", "none");

    // }





    // $('input#invoice_number').bind("change keyup input", function () {
    //     var inin = $(this).val();
    //     get_invoice_num(inin);
    // });




    // function get_invoice_num(input) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: '/subscriber/get_invoice_num_membership',
    //         data: {
    //             "invoice_number": input,
    //             "transaction_type_id": "3",
    //             "community_id": $(".id_komunitas").val()
    //         },
    //         type: 'POST',
    //         datatype: 'JSON',
    //         success: function (result) {
    //             // console.log(result);
    //             if (result.success == false) {
    //                 if (result.status == 401 || result.message == "Unauthorized") {
    //                     ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
    //                     setTimeout(function () {
    //                         location.href = '/admin';
    //                     }, 5000);
    //                 } else {
    //                     ui.popup.show('warning', result.message, 'Warning');
    //                 }
    //             } else {
    //                 $("#isi_form").show();
    //                 var isi = result[0];
    //                 $("#detil_pay").fadeIn();
    //                 $("#name_userpay").removeAttr("disabled", 'disabled');
    //                 $("#fileup").removeAttr("disabled", 'disabled');
    //                 $("#btn_confirmpay").fadeIn();
    //                 var tf = isi.comm_payment_method;
    //                 $("#nominal_payment1").html("Rp &nbsp;&nbsp;" + rupiah(isi.grand_total));
    //                 $("#bank_receiver").html(tf.payment_bank_name);
    //                 $("#name_receiver").html(tf.payment_owner_name);
    //                 $("#bank_num").html(tf.payment_account);

    //             }
    //         },
    //         error: function (result) {
    //             console.log(result);
    //             console.log("Cant invoice number");

    //         }
    //     });

    // }



    // var idku = $('#id_pop_payment').val();
    // //showfile name upload icon
    // $('#fileup').on('change', function () {
    //     // menampilkan img
    //     previewImgUpload("show_imgpay", this);
    //     $("#hidein-img").fadeIn();

    //     var fileName = $(this).val();
    //     if (fileName.length > 30) {
    //         var fileNameFst = fileName.substring(0, 30);
    //         $(this).next('.custom-file-label').html(fileNameFst + "...");
    //     } else {
    //         $(this).next('.custom-file-label').html(fileName);
    //     }
    // });




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
