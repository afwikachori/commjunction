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

<div class="row" style="padding-left:6%; padding-right: 6%; padding-top: 2%;">
 <div class="col-12">
  <div class="card">
    <nav class="navbar nav-biru">
    </nav>
    <div class="card-body member">
        <h4 class="tebal">Choose your plan</h4>
        <p class="cgrey2">Our Community Administrators are on their way to approve your account, please check our
            email!</p>
        <div class="row justify-content-center" style="text-align: center;">
            <div class="card-deck price_member" style="padding-left: 6%; padding-right: 6%;">

            </div>
        </div> <!-- end-row -->
    </div>
  </div>
</div>
</div>



@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = $(".server_cdn").val();
$(document).ready(function () {
    get_pricing_membership();
});



    function get_pricing_membership() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/subscriber/get_pricing_membership",
            type: "POST",
            dataType: "json",
            success: function (result) {
                console.log(result);
                var html = '';
                var noimg = '/img/fitur.png';
                $.each(result, function (i, item) {
                    // console.log(item);
                    var idprice = item.id;

                    html += '<div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:0.2em;">' +
                        '<div class="card cd-pricing pricing' + idprice + '">' +
                        '<div class="card-body">' +
                        '<center>' +
                        '<h4 class="cgrey2 s20" style="margin-top: 0.7em;">' + item.membership + '</h4>' +
                        '<img src="' + server_cdn + item.icon + '"  class="rounded-circle img-fluid imgprice"'+
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="hidetime1">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong>' + rupiah(item.pricing) + '</strong></label>' +
                        '<small class="clight"> /Once</small>' +
                        '</div>' +
                        '<form style="margin-top:0.3em;">' +
                            '<input type="hidden" name="idprice" value="' + idprice + '">' +
                            '<input type="hidden" name="payment_time" class="isitime" value="">' +
                            '<button type="submit" class="btn clr-blue klik-pricing" style="margin-top: 0.5em;">Get Now</button>' +
                            '</form>' +
                            '</center>' +
                           '</div></div></div>';
                });
                $('.price_member').html(html);
            }
        });
    }

</script>



@endsection
