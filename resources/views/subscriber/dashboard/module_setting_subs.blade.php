@extends('layout.subscriber')
@section('title', 'Module Setting')
@section('content')


<div class="row">
    <div class="col-md-2">
        <h3 class="page-title">Dashboard Setting</h3>
    </div>
    <div class="col-md-6">
        <label class="cgrey">Manage your dashboard information<label>
    </div>
    <div class="col-md-4" style="text-align: right;">
        <nav aria-label="breadcrumb">
            <!-- <button type="button" class="btn btn-tosca btn-sm" data-toggle="modal"
                data-target="#modal_confirmpay_membership">
                Payment Confirmation</button> -->
        </nav>
    </div>
</div>

<div class="row" style="padding-left:15%; padding-right: 15%; padding-top: 2%;">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs dashsetting">
                        <li class="tab-subs active" id="tab_personal">
                            <a href="#tab_module_1" data-toggle="tab">
                                Personal
                            </a>
                        </li>
                        <li class="tab-subs" id="tab_modules">
                            <a href="#tab_module_2" data-toggle="tab">
                                Modules
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_module_1">
                            <form>
                            <div class="row" style="margin-top: 0.5em;">
                                <div class="col-md-12">
                                    <h4>Personal Dashboard Setting</h4>
                                    <div id="isi_setting_personal" style="padding: 3% 10% 2% 5%;">

                                    </div>
                                    <div class="div-footer" style="text-align: right; margin-top: 0.5em; padding-right: 2%; display: none;">
                                        <hr>
                                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                            style="border-radius: 6px; text-align: right;">
                                            <i class="mdi mdi-close"></i> Cancel
                                        </button>
                                        &nbsp;
                                        <button type="submit" id="btn_setting_personal" class="btn btn-teal btn-sm"
                                            style="text-align: right;">
                                            <i class="mdi mdi-check btn-icon-prepend">
                                            </i> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div> <!-- end-tab 1  -->


                        <div class="tab-pane" id="tab_module_2">
                            <div class="row" style="margin-top: 0.5em;">
                                <div class="col-md-12">
                                    <h4>Modules Setting</h4>
                                    <div id="isi_setting_modules" style="padding: 3% 10% 2% 5%;">

                                    </div>
                                    <div class="div-footer" style="text-align: right; margin-top: 0.5em; padding-right: 2%; display: none;">
                                        <hr>
                                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal"
                                            style="border-radius: 6px; text-align: right;">
                                            <i class="mdi mdi-close"></i> Cancel
                                        </button>
                                        &nbsp;
                                        <button type="submit" id="btn_setting_personal" class="btn btn-teal btn-sm"
                                            style="text-align: right;">
                                            <i class="mdi mdi-check btn-icon-prepend">
                                            </i> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end-tab2 -->
                    </div>
                </div> <!-- end-tab line -->
            </div>
        </div>
    </div>
</div>





@endsection
@section('script')
<script type="text/javascript">
    var server_cdn = $(".server_cdn").val();
    $(document).ready(function () {
        get_list_setting_module_subs();
    });

    function get_list_setting_module_subs() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/get_list_setting_module_subs',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);

                if (result.success == false) {
                    if (result.status == 401 || result.message == "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/subscriber/url/' + $(".community_name").val();
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    show_setting_personal(result.individual_setting);
                    show_setting_modules(result.module_setting);

                }

            },
            error: function (result) {
                console.log(result);
                ui.popup.show('warning', 'Bad Connection, Try again later', 'Warning');
            }
        });
    }


    function show_setting_personal(individual_setting) {
         var uipersonal = '';
        $.each(individual_setting, function (i, item) {
            var htmltag = '';
            if (item.setting_type == 1) {
                var tipe = 'Input Text';
                htmltag = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                    'class="form-control input-abu param_setting" readonly>';
            } else {
                var tipe = 'Radio Button';
                if (item.value == "true") {
                    htmltag = '<div class="form-group">' +
                        '<div class="form-check set_mod">' +
                        '<label class="form-check-label">' +
                        '<input type="radio" class="form-check-input" name="radio_pilih' + item.id + '" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                        '</div>' +
                        '<div class="form-check set_mod">' +
                        '<label class="form-check-label">' +
                        '<input type="radio" class="form-check-inpu" name="radio_pilih' + item.id + '" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                        '</div>';
                } else {
                    htmltag = '<div class="form-group">' +
                        '<div class="form-check set_mod">' +
                        '<label class="form-check-label">' +
                        '<input type="radio" class="form-check-input" name="radio_pilih' + item.id + '" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                        '</div>' +
                        '<div class="form-check set_mod">' +
                        '<label class="form-check-label">' +
                        '<input type="radio" class="form-check-inpu" name="radio_pilih' + item.id + '" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                        '</div>';
                }
            }

            uipersonal += '<div class="row" style="margin-bottom:0.5em;">' +
                '<div class="col-8"><div class="form-group">' +
                '<h6 class="cgrey1 tebal name_setting">' + item.title +
                '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                '</p>' +
                '<input type="hidden" value="' + item.id + '" name="idsub_' + item.id + '">' +
                '</div>' +
                '</div >' +
                '<div class="col-4">' + htmltag +
                '</div></div></div>';
        });
        $("#isi_setting_personal").html(uipersonal);
    }


    function show_setting_modules(module_setting) {
            var uimod = '';
            $.each(module_setting, function (i, item) {
                var htmlui = '';
                if (item.setting_type == 1) {
                    var tipe = 'Input Text';
                    htmlui = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                        'class="form-control input-abu param_setting">';
                } else {
                    var tipe = 'Radio Button';
                    if (item.value == "true") {
                        htmlui = '<div class="form-group">' +
                            '<div class="form-check set_mod">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="radio_pilih' + item.id + '" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                            '</div>' +
                            '<div class="form-check set_mod">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-inpu" name="radio_pilih' + item.id + '" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                            '</div>';
                    } else {
                        htmlui = '<div class="form-group">' +
                            '<div class="form-check set_mod">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="radio_pilih' + item.id + '" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                            '</div>' +
                            '<div class="form-check set_mod">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-inpu" name="radio_pilih' + item.id + '" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                            '</div>';
                    }
                }

                uimod += '<div class="row" style="margin-bottom:0.5em;">' +
                    '<div class="col-8"><div class="form-group">' +
                    '<h6 class="cgrey1 tebal name_setting">' + item.title +
                    '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                    '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                    '</p>' +
                    '<input type="hidden" value="' + item.id + '" name="idsub_' + item.id + '">' +
                    '</div>' +
                    '</div >' +
                    '<div class="col-4">' + htmlui +
                    '</div></div></div>';
            });
            $("#isi_setting_modules").html(uimod);
        }

</script>



@endsection
