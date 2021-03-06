@extends('layout.app')
@section('title', 'COMMJUNCTION APP')
@section('content')
<nav class="navbar nav-oren">
</nav>
<img src="/visual/vs-pricing.png" id="shadow-fiturq">
<form method="POST" id="form_idfitur" action="{{route('sendfeature')}}">
    {{ csrf_field() }}

    <a href="/admin/pricing">
        <img border="0" src="/visual/left-arrow.png" class="panahkiri">
    </a><a href="/admin/pricing" class="clight backarrow3" lang="en" data-token-lang="Back to Pricing">Back to Pricing</a>

    <div class="mg-fituradmin">
        <div class="row">
            <div class="col-md-9">
                <h4 class="cgrey h4" id="judul_fiturq" style="margin-bottom: 0.5em;" lang="en">Choose Your Features</h4>

                <input type="hidden" name="idaddfitur" id="idaddfitur" value="">

                <div class="row" id="isi_fitur_regis" style="width: 100%;">
                    <!-- <div class="col-sm-2">
                        <div class="card fiturcard">
                            <div class="card-body" style="padding: 1em !important;">
                                <div class="roundcheck">
                                    <input type="checkbox" class="boxfitur" name="feature_id[]" id="fitur1" value="" />
                                    <label for="fitur1"></label>
                                </div>
                                <center>
                                    <img class="rounded-circle img-fluid" src="/img/fiturs.png"
                                        style="width: 45px; margin-bottom: 0.5em;"
                                        onerror="this.onerror=null;this.src='/img/fiturs.png';">
                                    <h6 class="cgrey mgb-0px">Fitur Test</h6>
                                    <small class="clight s12">This Feature is just test</small>
                                </center>
                                <div class="detail-fiturq">
                                    <a href="/admin/features_detail/1">
                                        <small lang="en" class="txt_detail_fitur h6 s13"> More detail
                                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></small></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div> <!-- end-col 10 -->

            <div class="col-3" id="div_popular" style="padding-left: 5%; display: none;">
                <h4 class="cgrey h4" style="margin-bottom: 0.5em;" lang="en">Popular</h4>
                <div class="row">
                    <div class="col-3">
                        <center>
                            <img src="/visual/img-fitur-default.png" class="rounded-circle img-fluid"
                                style="width: 45px; height: auto;"></center>
                    </div>
                    <div class="col">
                        <h6 class="clight s15" style="margin-top: 0.5em;" lang="en">Name Featured</h6>
                    </div>
                </div>


                <div class="row">
                    <div class="col-3">
                        <center>
                            <img src="/visual/img-fitur-default.png" class="rounded-circle img-fluid"
                                style="width: 45px; height: auto;"></center>
                    </div>
                    <div class="col">
                        <h6 class="clight s15" style="margin-top: 0.5em;" lang="en">Name Featured</h6>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <center>

            <span class="cgrey1 s16">
                <span id="hitungcentang"> 0 </span>
                / <span id="total_fitur"> 0 </span>
            </span>

            <button type="submit" id="next_pilihfitur" class="btn btn-oren s14 btn-md btn-block" lang="en">Next</button>
        </center>
    </div>
</form>

@endsection

@section('script')
<script type="text/javascript">
    var cdn = $("#server_cdn").val();

    $(document).ready(function () {
        get_list_feature_regis();
    });

    var ui = {
    popup: {
        show: function show(type, message, tittle) {
            toastr[type](message, tittle);

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "800",
                "timeOut": 0,
                "onclick": null,
                "onCloseClick": null,
                "extendedTimeOut": 0,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            };
        },

        showLoader: function showLoader() {
            $("#mdl-loadingajax").modal('show');
        },
        hideLoader: function hideLoader() {
            $("#mdl-loadingajax").modal('hide');
        },
    }
};

    function get_list_feature_regis() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/get_list_feature_regis',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            beforeSend: function () {
                 ui.popup.showLoader();
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 5000);
                // $('#mdl-loadingajax').modal('show');
            },
            success: function (result) {
                console.log(result);
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 5000);
                if (result.success == false || result.message == "pricing null") {
                    swal("Pricing is null!", "Choose your pricing first", "error")
                        .then((value) => {
                            window.location.href = "/admin/pricing";
                        });
                } else if(result.success == false || result.message == "Internal Server Error"){
                    get_list_feature_regis();
                }else {
                    var noimg = '/img/fiturs.png';
                    var jum = 0;
                    var uifitur = '';

                    $.each(result, function (i, dtitem) {
                        var item = dtitem.feature;
                        jum++;
                        uifitur += '<div class="col-sm-2">' +
                            '<div class="card fiturcard">' +
                            '<div class="card-body" style="padding: 1em !important;">' +
                            '<div class="roundcheck">' +
                            '<input type="checkbox" class="boxfitur" name="feature_id[]" onclick="hitung_fitur()"' +
                            'id="fitur' + item.id + '" value="' + item.id + '" />' +
                            '<label for="fitur' + item.id + '"></label>' +
                            '</div>' +
                            '<center>' +
                            '<img class="rounded-circle img-fluid" src="' + cdn + cekimage_cdn(item.logo) + '"' +
                            'style="width: 45px; margin-bottom: 0.5em;"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"' +
                            '<br><h6 class="cgrey">' + item.title + '</h6>' +
                            '<small class="clight s12">' + item.description + '</small>' +
                            '</center>' +
                            '<div class="detail-fiturq">' +
                            '<a href="/admin/features_detail/' + item.id + '">' +
                            '<small lang="en" class="txt_detail_fitur h6 s13" lang="en" data-token-lang="More detail">More detail' +
                            '&nbsp;<i class="fa fa-chevron-circle-right"' +
                            'aria-hidden="true"></i></small></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div >';
                    });
                    $("#total_fitur").html(jum);
                    $("#isi_fitur_regis").html(uifitur);
                    get_session_fitur();
                     $('#mdl-loadingajax').modal('hide');
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
                $('#mdl-loadingajax').modal('hide');
            },
            complete: function (result) {
                $('#mdl-loadingajax').modal('hide');
            }
        });
    }

    function get_session_fitur() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/session_fitur',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                var idaddfitur = $("#idaddfitur").val();

                if (idaddfitur != "") {
                    $('#fitur' + idaddfitur).prop('checked', 'checked');
                }

                for (var i = 0; i < result.length; i++) {
                    $('#fitur' + result[i]).prop('checked', 'checked');
                }
                var ceklis = $('input[type="checkbox"]:checked').length;

                if ($(this).is(':checked')) {
                    $("#hitungcentang").text(ceklis);
                    $("#next_pilihfitur").removeAttr("disabled");
                } else {
                    if (ceklis == 0) {
                        $("#next_pilihfitur").attr("disabled", true);
                    }
                    $("#hitungcentang").text(ceklis);
                }
            },
            error: function (result) {
                console.log("Cant Reach Session Pricing");
            }
        });
    }

    function hitung_fitur() {
        var ceklis = $('input[type="checkbox"]:checked').length;

        if ($(this).is(':checked')) {
            $("#hitungcentang").text(ceklis);
            $("#next_pilihfitur").removeAttr("disabled", false);
        } else {
            if (ceklis == 0) {
                $("#next_pilihfitur").attr("disabled", true);
            } else {
                $("#next_pilihfitur").removeAttr("disabled", false);
            }
            $("#hitungcentang").text(ceklis);
        }
    }

</script>
@endsection
