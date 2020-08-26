@extends('layout.app')

@section('content')
<div class="bg-page-finish">
    <img src="/visual/rumput.png" class="rumput-kiri2">
    <img src="/visual/bgselesai.png" class="bgselesai">
    <img src="/visual/oval.png" class="oval-selesai">



    <center>
        <div class="card col-5" id="card-finish">
            <div class="card-body">
                <h4 class="cgrey" lang="en"> Your Registrasion Process Completed</h4>
                <div class="col-8">
                    <small class="clight">Our Community Administrators are on their way to approve your account, please
                        check our email!</small>

                    <a type="button" id="btn_done" class="btn btn-oren s14 btn-md btn-block"
                        style="width: 150px; margin-top: 2em;">Done</a>
                </div>
                <br>


            </div>
        </div>
    </center>


</div>

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
        cek_payment_free_or_not();
    });

    function cek_payment_free_or_not() {
         $('#btn_done').attr("disabled", "disabled");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cek_payment_free_or_not',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);
                if (result != 0) {
                    $('#btn_done').attr("href", "/admin/confirm");
                } else {
                    $('#btn_done').attr("href", '/');
                }
                 $('#btn_done').removeAttr("disabled", "disabled");
            },
            error: function (result) {
                console.log(result);
                console.log("Cant cek");
            }
        });
    }


</script>
@endsection
