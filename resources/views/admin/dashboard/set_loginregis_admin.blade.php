<br>
<small class="clight1 s14" lang="en">Set up your Community Login Page & Registration Customization</small>

<div class="row" style="padding-bottom: 0; margin-top: 1em;">
    <div class="col-12">

        <div class="card">
            <form method="POST" id="form_setting_loginregis" action="{{route('setting_loginresgis_comm')}}"
                enctype="multipart/form-data">{{ csrf_field() }}

                <div class="card-body">
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Headline Text</h6>
                            <small class="clight" lang="en">Headline text will be show on subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="headline" id="headline" class="form-control input-abu">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Description Text Login</h6>
                            <small class="clight" lang="en">Descripe anything and will appeare on subscriber
                                login</small>
                        </div>
                        <div class="col-md-5">
                            <textarea class="form-control input-abu" id="description_custom" name="description_custom"
                                rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Image Login Portal</h6>
                            <small class="clight" lang="en">This image will be show for subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <img src="/img/kosong.png" class="img_portal rounded-circle img-fluid zoom"
                                id="img_portal_admin" style="display: none; width: 50px; height:50px;"
                                onclick="clickImage(this)" data-toggle="tooltip" data-placement="right"
                                title="Double Click to View Image"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                            <div class="form-group" id="up_img_portal">
                                <input type="file" id="fileup" name="fileup" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image"
                                        style="border-radius: 10px 0px 0px 10px; background-color: #efefef;">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-light" type="button"
                                            style="padding: 0.5rem 1rem !important; border-radius: 0px 10px 10px 0px;">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Logo Login Portal</h6>
                            <small class="clight" lang="en">This logo will be the icon for subscriber login
                                portal</small>
                        </div>
                        <div class="col-md-5">
                            <img src="/img/kosong.png" class="logo_portal img-fluid zoom" id="img_logo_portal"
                                style="display: none; width: auto; height:40px;" onclick="clickImage(this)"
                                data-toggle="tooltip" data-placement="right" title="Double Click to View Image"
                                onerror="this.onerror=null;this.src='/img/kosong.png';">
                            <div class="form-group" id="up_logo_portal">
                                <input type="file" id="fileup_logo" name="fileup_logo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image"
                                        style="border-radius: 10px 0px 0px 10px; background-color: #efefef;">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-light" type="button"
                                            style="padding: 0.5rem 1rem !important; border-radius: 0px 10px 10px 0px;">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Font Headline</h6>
                            <small class="clight" lang="en">Font Headline text will be show on subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <select id="font_headline" name="font_headline" class="form-control input-abu">
                                <option value="Arial" style="font-family: Arial;">Arial</option>
                                <option value="Verdana" style="font-family: Verdana;">Verdana </option>
                                <option value="Impact" style="font-family: Impact;">Impact </option>
                                <option value="Comic Sans MS" style="font-family: Comic Sans MS;">Comic Sans MS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Font Link</h6>
                            <small class="clight" lang="en">Font link show on link or URL</small>
                        </div>
                        <div class="col-md-5">
                            <select id="font_link" name="font_link" class="form-control input-abu">
                                <option value="Arial" style="font-family: Arial;">Arial</option>
                                <option value="Verdana" style="font-family: Verdana;">Verdana </option>
                                <option value="Impact" style="font-family: Impact;">Impact </option>
                                <option value="Comic Sans MS" style="font-family: Comic Sans MS;">Comic Sans MS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Base Color</h6>
                            <small class="clight" lang="en">Base color will appeare in your dashbboard and subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour' onchange="getcolour(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color" class="clight">#ffbc42</p>
                                </div>
                                <input type="hidden" id="color_base" name="color_base">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Accent Color</h6>
                            <small class="clight" lang="en">Accent color will appeare in your dashbboard and subscriber
                                interface</small>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-right: 0px;">
                                    <span id="color_front2" data-toggle="tooltip" data-placement="top"
                                        title="Click to choose color"></span>
                                    <input type='color' class='bar' id='colour2' onchange="getcolour_accent(this)">
                                </div>
                                <div class="col-md-8" style="margin-top: auto; margin-bottom: auto; text-align: left;">
                                    <p id="output-color2" class="clight">#80d7e0</p>
                                </div>
                                <input type="hidden" id="color_accent" name="color_accent">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Subscriber Login</h6>
                            <small class="clight" lang="en">Choose form type for subscriber login</small>
                        </div>
                        <div class="col-md-5">
                            <select class="form-control input-abu" name="form_tipe" id="form_tipe">
                                <option selected disabled lang="en">Choose</option>
                                <option value="1" lang="en">Username & Password</option>
                                <option value="2" lang="en">Phone Number & Password</option>
                                <option value="3" lang="en">Email & Password</option>
                            </select>
                            <input type="text" id="showtipeform" class="form-control input-abu" style="display: none;"
                                disabled>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 1em;">
                        <div class="col-md-7">
                            <h6 class="cgrey2 judulcomsetup" lang="en">Custom Domain</h6>
                            <small class="ctosca"><i lang="en">yourdomain</i>
                                <b class="clight">@smartcomm.id</b></small>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="subdomain" id="subdomain" class="form-control input-abu">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; text-align: right; padding: 5%; padding-bottom: 0px;">
                    <button type="submit" id="btn_commset_login" class="btn btn-teal btn-sm melengkung10px">
                        <i class="mdi mdi-check btn-icon-prepend">
                        </i> <span lang="en">Submit</span> </button>
                </div> <!-- end-footer     -->
            </form>
        </div>
    </div>
</div>


@section('script')
<script type="text/javascript">
    var server_cdn = '{{ env("CDN") }}';
    $(document).ready(function () {
        setTimeout(function () {
            ui.popup.hideLoader();
        }, 8000);
        $(".sidebar .nav .nav-item").removeClass("active");

        get_result_setup_comsetting();
        tabel_list_regisdata();
        get_list_custum_inputipe();
        addRowRegisData();

        tabel_payment_community();
        get_status_com_publish();

        get_payment_tipe();
    });


    //COMMUNITY SETTING DATA
    function get_result_setup_comsetting() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_result_setup_comsetting',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            success: function (result) {
                console.log(result);

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
                    var tipeform = result[0];
                    if (tipeform != null || tipeform != "" || tipeform != 0) {
                        $('#form_tipe').val(tipeform.data).attr("selected", "selected");

                        if (tipeform.ready == true) {
                            $('#form_tipe').hide();
                            var tip = '';
                            if (tipeform.data == 1) {
                                tip = 'Username & Password';
                            } else if (tipeform.data == 2) {
                                tip = 'Phone Number & Password';
                            } else {
                                tip = 'Email & Password';
                            }
                            $("#showtipeform").val(tip).show();
                        }
                    }


                    var portal = result[1];
                    if (portal.data.headline_text != null && portal.data.headline_text != "" && portal.data.headline_text != undefined) {
                        $("#headline").val(portal.data.headline_text);
                        $("#description_custom").val(portal.data.description);
                        $("#font_headline").val(portal.data.font_headline);
                        $("#font_headline").css('font-family', portal.data.font_headline);

                        $("#font_link").val(portal.data.font_link);
                        $("#font_link").css('font-family', portal.data.font_link);

                        $("#color_base").val(portal.data.base_color);
                        $("#color_accent").val(portal.data.accent_color);

                        $("#colour").val(portal.data.base_color);
                        $("#colour2").val(portal.data.accent_color);

                        $("#output-color").html(portal.data.base_color);
                        $("#output-color2").html(portal.data.accent_color);

                        $("#color_front").css('background-color', portal.data.base_color);
                        $("#color_front2").css('background-color', portal.data.accent_color);

                    }

                    if (portal.data.image != undefined || portal.data.image != null || portal.data.image != 0) {
                        $("#img_portal_admin").attr("src", server_cdn + cekimage_cdn(portal.data.image));
                    }

                    if (portal.data.icon != undefined || portal.data.icon != null || portal.data.icon != 0) {
                        $("#img_logo_portal").attr("src", server_cdn + cekimage_cdn(portal.data.icon));
                    }

                    if (portal.ready == true) {
                        $('#headline').attr("disabled", "disabled");
                        $('#description_custom').attr("disabled", "disabled");

                        $("#colour").attr("disabled", "disabled");
                        $("#colour2").attr("disabled", "disabled");

                        $("#font_headline").attr("disabled", "disabled");
                        $("#font_link").attr("disabled", "disabled");

                        $("#up_img_portal").hide();
                        $(".img_portal").show();

                        $("#up_logo_portal").hide();
                        $(".logo_portal").show();
                    }

                    var domain = result[2];
                    if (domain.data.subdomain != null || domain.data.subdomain == "") {
                        $('#subdomain').val(domain.data.subdomain);
                        if (domain.ready == true && domain.data.subdomain != "") {
                            $('#subdomain').attr("disabled", "disabled");
                        }
                    }


                    if (tipeform.ready == true && portal.ready == true && domain.ready == true) {
                        $("#btn_commset_login").attr("disabled", "disabled");
                        $("#btn_commset_login").hide();
                    }

                    var membership = result[3];
                    $('#membership').val(membership.data).attr("selected", "selected");
                    if (membership.ready == true) {
                        $("#membership").attr("disabled", "disabled");
                        $("#btn_submit_memberset").hide();
                    } else {
                        $("#btn_submit_memberset").show();
                    }
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });
    }


    $("#colour").change(function (event) {
        // console.log($(this).val());
        $("#color_front").css('background-color', $(this).val());
    });

    $("#color_front").click(function (event) {
        $("#colour").click();
    });

    $("#colour2").change(function (event) {
        // console.log($(this).val());
        $("#color_front2").css('background-color', $(this).val());
    });

    $("#color_front2").click(function (event) {
        $("#colour2").click();
    });



    var input = document.getElementById('colour');
    input.addEventListener('change', getcolour);
    function getcolour(colr) {
        var colr = this.value;
        $("#output-color").html(colr);
        $("#color_base").val(colr);
    }


    var input = document.getElementById('colour2');
    input.addEventListener('change', getcolour_accent);
    function getcolour_accent(colr) {
        var colr = this.value;
        $("#output-color2").html(colr);
        $("#color_accent").val(colr);
    }


    $('#font_headline').change(function () {
        $("#font_headline").css('font-family', this.value);
    });

    $('#font_link').change(function () {
        $("#font_link").css('font-family', this.value);
    });


    //REGIS DATA COMMUNITY SETTINGS
    $("#tipedata_regis").change(function () {
        var val = this.value;
        // console.log(val);
        if (val == 1 || val == 6 || val == 7) {
            $("#input_pilihan").fadeIn("slow").show();
        } else {
            $("#input_pilihan").fadeOut("slow").hide();
        }
    });

    $("#edit_tipedata").change(function () {
        var val = this.value;
        // console.log(val);
        if (val == 1 || val == 6 || val == 7) {
            $("#edit_input_pilihan").fadeIn("slow").show();
        } else {
            $("#edit_input_pilihan").fadeOut("slow").hide();
        }
    });

    function tagsInput() {
        var input2 = document.querySelector('textarea[name=tags2]'),
            tagify2 = new Tagify(input2, {
                enforeWhitelist: true,
                whitelist: ["Single", "Married", "WNI", "WNA", "Male", "Female"]
            });

        // toggle Tagify on/off
        document.querySelector('input[type=checkbox]').addEventListener('change', function () {
            document.body.classList[this.checked ? 'add' : 'remove']('disabled');
        })
    }

    function tabel_cek() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/tabel_list_regisdata',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                console.log(result);
                // console.log(result[0].param_form_array[0]);

                $.each(result, function (i, item) {
                    var judul = item.param_form_array[0];
                    var tipedata = item.param_form_array[1];

                });
            },
            error: function (result) {
                console.log("Cant Show");
            }
        });
    }

    function tabel_list_regisdata() {
        var tabel = $('#tabel_list_regisdata').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_list_regisdata',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            columns: [
                { mData: 'id' },
                {
                    mData: 'param_form_array',
                    render: function (data, type, row, meta) {
                        var judul = data[0];
                        return judul;
                    }
                },
                {
                    mData: 'param_form_array',
                    render: function (data, type, row, meta) {
                        var tipedata = data[1];
                        var tp = '';
                        if (tipedata == 1) {
                            tp = 'Input Text';
                        } else if (tipedata == 2) {
                            tp = 'Date Picker';
                        } else if (tipedata == 3) {
                            tp = 'Checkbox';
                        } else {
                            tp = 'Radiobutton';
                        }
                        return tp;
                    }
                },
                {
                    mData: 'created_at',
                    render: function (data, type, row, meta) {
                        var tgl = dateFormat(data);
                        return tgl;
                    }
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-eye"></i></button>',
                        "targets": -1
                    }
                ],
        });

        //DETAIL QUESTIONs FROM DATATABLE
        $('#tabel_list_regisdata tbody').on('click', 'button', function () {
            var pilih = tabel.row($(this).parents('tr')).data();
            console.log(pilih);

            $("#edit_question").val(pilih.title);
            $("#edit_deskripsi_regis").val(pilih.description);
            $("#id_question").val(pilih.id);
            var isi = pilih.param_form_array;

            $("#edit_tipedata").val(isi[1]).attr("selected", "selected");

            if (isi[1] == 1 || isi[1] == 6 || isi[1] == 7) {
                $("#edit_input_pilihan").fadeIn("slow").show();
            } else {
                $("#edit_input_pilihan").fadeOut("slow").hide();
            }

            var len = isi.length;
            var cek = isi.slice(2, len);
            var len_2 = cek.length;
            addRowRegisData_edit(len_2);
            var new_row2 = '';
            $.each(cek, function (i, item) {
                new_row2 += '<div class="row form-group newly2" id="row' + i + '">' +
                    '<div class="col-md-3" style="margin-top: 1em;">' +
                    '<label class="cgrey">Choose Input</label>' +
                    '</div>' +
                    '<div class="col-md-7">' +
                    '<input type="text" class="form-control input-abu" value="' + item + '" name="value' + i + '">' +
                    '</div>' +
                    '<div class="col-md">' +
                    '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row2" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                    '<i class="mdi mdi-delete"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>';
            });

            $('#isi_newrow_edit').html(new_row2 + '<div id="isi_newrow_edit_new"></div>');
            $("#modal_edit_question").modal('show');
        });
    }

    function get_list_custum_inputipe() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_list_custum_inputipe",
            type: "POST",
            dataType: "json",
            success: function (result) {
                // console.log(result);
                $('#tipedata_regis').empty();
                $('#tipedata_regis').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#tipedata_regis').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#tipedata_regis").html($('#tipedata_regis option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#tipedata_regis").get(0).selectedIndex = 0; const
                    OldSubf = "{{old('tipedata_regis')}}";
                if (OldSubf !== '') {
                    $('#tipedata_regis').val(OldSubf);
                }
                // _____________________________________________________

                $('#edit_tipedata').empty();
                $('#edit_tipedata').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#edit_tipedata').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#edit_tipedata").html($('#edit_tipedata option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#edit_tipedata").get(0).selectedIndex = 0; const
                    OldSubf2 = "{{old('edit_tipedata')}}";
                if (OldSubf2 !== '') {
                    $('#edit_tipedata').val(OldSubf2);
                }

            },
            error: function (result) {
                console.log(result);
            }
        });
    }


    function addRowRegisData() {
        // Add row
        var row = 1;
        var id = 3;

        $(document).on("click", "#addnewrow", function () {
            var new_row = '<div class="row form-group newly" id="row' + row + '">' +
                '<div class="col-md-3" style="margin-top: 1em;">' +
                '<label class="cgrey">Choose Input</label>' +
                '</div>' +
                '<div class="col-md-7">' +
                '<input type="text" class="form-control input-abu" name="pilihan_input' + id + '">' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>';

            $('#isi_newrow').append(new_row);
            row++;
            id++;
            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-row", function () {
            //  alert("deleting row#"+row);
            if (row > 1) {
                $(this).closest('div .newly').remove();
                row--;
            }
            return false;
        });

    }

    function addRowRegisData_edit(last_id) {

        $(document).on("click", "#addnewrow_edit", function () {
            var new_row = '<div class="row form-group newly2" id="row' + last_id + '">' +
                '<div class="col-md-3" style="margin-top: 1em;">' +
                '<label class="cgrey">Choose Input</label>' +
                '</div>' +
                '<div class="col-md-7">' +
                '<input type="text" class="form-control input-abu" name="value' + last_id + '">' +
                '</div>' +
                '<div class="col-md">' +
                '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row2" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
                '<i class="mdi mdi-delete"></i>' +
                '</button>' +
                '</div>' +
                '</div>';
            last_id++;
            $('#isi_newrow_edit_new').append(new_row);

            return false;
        });

        // Remove criterion
        $(document).on("click", ".delete-row2", function () {
            //  alert("deleting row#"+row);
            // if (row > 1) {
            $(this).closest('div .newly2').remove();
            //     row--;
            // }
            return false;
        });

    }


    function get_status_com_publish() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/get_status_com_publish',
            type: 'POST',
            datatype: 'JSON',
            success: function (result) {
                // console.log(result);
                if (result.status == 3 || result.status == 4) {
                    $("#btn_ke_commset_publish").hide();
                    $("#btn_ke_commset_publish").css("display", "none");
                }else{
                      $("#btn_ke_commset_publish").show();
                    $("#btn_ke_commset_publish").css("display", "block");
                }

                if (result.status == 0) {
                    $(".statuscomm").html('Newly');
                    $(".statuscomm").addClass('bg-abu');
                } else if (result.status == 1) {
                    $(".statuscomm").html('Newly');
                    $(".statuscomm").addClass('bg-abu');
                } else if (result.status == 2) {
                    $(".statuscomm").html('Active');
                    $(".statuscomm").addClass('bg-hijau');
                } else if (result.status == 3) {
                    $(".statuscomm").html('Published');
                    $(".statuscomm").addClass('bg-biru');
                } else if (result.status == 4) {
                    $(".statuscomm").html('Deactive');
                    $(".statuscomm").addClass('bg-merah');
                }
            },
            error: function (result) {
                console.log("Cant Show status publish com");
            }
        });
    }



    function tabel_payment_community() {
        var tabel = $('#tabel_paysubs').DataTable({
            responsive: true,
            language: {
                paginate: {
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    previous: '<i class="mdi mdi-chevron-left">'
                }
            },
            ajax: {
                url: '/admin/tabel_payment_community',
                type: 'POST',
                dataSrc: '',
                timeout: 30000,
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_paysubs tbody').empty().append(nofound);
            },
            columns: [
                { mData: 'id' },
                { mData: 'payment_title' },
                { mData: 'payment_owner_name' },
                { mData: 'payment_bank_name' },
                {
                    mData: 'status',
                    render: function (data, type, row, meta) {
                        var ket = '';
                        if (data == 0) {
                            ket = '<label class="badge bg-abu round-label">Deactive</label>';
                        } else {
                            ket = '<label class="badge bg-tosca round-label">Active</label>';
                        }
                        return ket;
                    }
                },
                {
                    mData: null,
                    render: function (data, type, row, meta) {
                        return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnedit">' +
                            '<i class="mdi mdi-eye"></i>' +
                            '</button>';
                    }
                }
            ],
            columnDefs:
                [
                    {
                        "data": null,
                        "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"><i class="mdi mdi-eye"></i></button>',
                        "targets": -1
                    }
                ],
        });


        //DETAIL USERTYPE FROM DATATABLE
        $('#tabel_paysubs tbody').on('click', 'button', function () {
            var dt = tabel.row($(this).parents('tr')).data();
            console.log(dt);
            $("#id_paymentsubs").val(dt.id);

            var pay = dt.comm_payment_type;

            $("#detail_nama_pay").html(dt.payment_title);
            $("#detail_tipe_pay").html(pay.payment_title);
            $("#detail_owner").html(dt.payment_owner_name);
            $("#detail_no_rekening").html(dt.payment_account);

            var desui = '';
            $.each(dt.description, function (i, item) {
                desui += '<li>' + item + '</li>';
            });
            $("#detail_deskripsi").html('<ul>' + desui + '</ul>');

            $("#detail_bank").html(dt.payment_bank_name);
            $("#detail_timelimit").html(dt.payment_time_limit + " Days");
            if (dt.status == 0) {
                var isista = "Deactive";
            } else {
                var isista = "Active";
            }
            $("#detail_status").html(isista);
            $("#modal_detail_paymentsubs").modal("show");
            // _________EDIT__________
            $("#id_subs_payment").val(dt.id);

            $("#edit_rekening_number").val(dt.payment_account);
            $("#edit_rekening_name").val(dt.payment_owner_name);

        });

    }



    //dropdown
    function get_payment_tipe() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_payment_tipe",
            type: "POST",
            dataType: "json",
            success: function (result) {
                $('#payment_tipe').empty();
                $('#payment_tipe').append("<option disabled> Choose </option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#payment_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].payment_title, "</option>"));
                }

                $("#payment_tipe").html($('#payment_tipe option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#payment_tipe").get(0).selectedIndex = 0;

            }
        });
    } //endfunction

    $("#payment_tipe").change(function (event) {
        var val = $(this).val();
        get_bank_pay(val);

    });


    //dropdown bank
    function get_bank_pay(id_paytipe) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/get_bank_pay",
            type: "POST",
            dataType: "json",
            data: {
                "payment_type_id": id_paytipe
            },
            success: function (result) {
                console.log(result);
                $('#bank_name').empty();
                $('#bank_name').append("<option disabled> Choose </option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#bank_name').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].payment_title, "</option>"));
                }
                //Short Function Ascending//
                $("#bank_name").html($('#bank_name option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#bank_name").get(0).selectedIndex = 0;
            }
        });
    } //endfunction






</script>

@endsection
