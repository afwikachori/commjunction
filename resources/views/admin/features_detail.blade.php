@extends('layout.app')

@section('content')
<nav class="navbar nav-oren">
</nav>
<img src="/visual/vs-pricing.png" id="shadow-fiturq">

<a href="{{ route('session_backfitur') }}">
    <img border="0" src="/visual/left-arrow.png" id="left-arrowregis">
</a><a href="{{ route('session_backfitur') }}" class="clight backarrow" data-lang-token="backregis">Back to Register</a>

    <div class="mg-detailfitur">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <img src="/visual/ex-detail-fitur.png" id="subfitur_contoh" style="width: 450px;height: auto;">
                </div>
                <div class="col"></div>
                <div class="col-6">
                    <h5 class="cgrey1"></h5>
                    <p class="clight" id="txt_deskripfitur"></p>
                    <input type="hidden" id="idfituradmin" name="idfituradmin" value="{{ $idfitur }}">
                </div>
            </div>

            <h4 class="h4 cgrey" id="txt_subfituradmin">Sub Feature</h4>

            <div class="row">
                @foreach($data as $dt)
                <div class="col-2" style="padding-top: 5px;">
                    <div class="card" style="width: 10.5rem; height: 8rem; border-color: #FF9A44;">
                        <div class="card-body" style="padding: 0.8rem !important; text-align: center;">
                            <img src="{{ env('CDN').$dt['logo'] }}" onerror="this.onerror=null;this.src='/img/fitur.png';"
                            class="img-subfitur rounded-circle img-fluid"><br>
                            <small class="h6 s13 coren"> {{ $dt['title'] }} </small><br>
                            <small class="cgrey2 s12">{{ $dt['description'] }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div> <!-- end-container -->
    </div>

<!-- MODAL LOADING AJAX -->
<div class="modal fade bd-example-modal-sm" id="mdl-loadingajax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content loadingq">
            <center>
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="h6 iniloading">Loading . . .</p>
                <center>
        </div>
    </div>
</div>
<!-- END-MODAL -->

@endsection


@section('script')
<script type="text/javascript">
    var cdn = '{{ env("CDN") }}';
    var server = '{{ env("SERVICE") }}'

    $(document).ready(function () {

        get_info_fitur();

    });  //end-document ready




    function get_info_fitur() {
        var idf = $("#idfituradmin").val().toString();
        var idfitur = [idf];

        if (idfitur != "") {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/getSelectedFitur',
                data: {
                    'id': idfitur
                },
                type: 'POST',
                datatype: 'JSON',
                beforeSend: function () {
                },
                success: function (result) {

                    $.each(result.data, function (i, dt) {
                        $("#txt_judulfitur").html(dt.title);
                        $("#txt_deskripfitur").html(dt.description);
                        $("#img-fiturq").attr("src", cdn + dt.logo);

                    });



                },
                error: function (result) {
                    console.log("Cant get feature information from server");
                },
                complete: function (result) {
                }
            });
        } //endif
    }

</script>
@endsection
