
var server_cdn = '';
// LANG -EN-ID
var lang = new Lang();
lang.dynamic('id', '/js/langpack/id.json');
lang.init({
    defaultLang: 'en'
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
            $("#modal_ajax").modal('show');
        },
        hideLoader: function hideLoader() {
            $("#modal_ajax").modal('hide');
        },
    }
};

$(document).ready(function () {
    server_cdn = $("#server_cdn").val();
    session_admin_logged();
    init_ready();
});


function session_admin_logged() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend(jxqhr) {
            ui.popup.showLoader();
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 10000);
        },
        timeout: 20000,
        error: function error(event, jxqhr, status, _error) {
            console.log();
            ui.popup.show('error', status, 'Error');
            ui.popup.hideLoader();
        },
        complete: function complete() {
            ui.popup.hideLoader();
        }
    });
    $.ajax({
        url: '/admin/session_admin_logged',
        type: 'POST',
        datatype: 'JSON',
        timeout: 20000,
        success: function (result) {
            console.log(result);
            console.log("admin komunitas = " + result.access_token);
            console.log("cdn : " + server_cdn);

            setTimeout(function () {
                ui.popup.hideLoader();
            }, 8000);

            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    console.log('session login admin');
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {

                var user = result.user;
                get_list_notif_navbar(user.community_id);

                if (result != "") {
                    $(".username_komunitas").html(user.user_name);
                    $(".phone_komunitas").html(user.notelp);
                    $(".email_komunitas").html(user.email);

                    if (user.community_logo != undefined || user.community_logo != null) {

                        $(".logo_komunitas").attr("src", server_cdn + cekimage_cdn(user.community_logo));
                    }

                    if (user.picture != undefined || user.picture != null) {
                        $(".foto_profil_admin").attr("src", server_cdn + cekimage_cdn(user.picture));
                        $("#view_edit_user").attr("src", server_cdn + cekimage_cdn(user.picture));
                    }

                    $(".user_admin_logged").html(user.full_name);
                    $(".jenis_komunitas_adminloged").html(user.community_type);
                    $(".judul_komunitas").html(user.community_name);
                    $(".deskripsi_komunitas").html(user.community_description);
                    $(".alamat_admin_komunitas").html(user.alamat);
                    $(".tanggalregis_komunitas").html(formatDate(user.community_created));

                    //edit profile admin
                    $("#name_admin").val(user.full_name);
                    $("#username_admin").val(user.user_name);
                    $("#phone_admin").val(user.notelp);
                    $("#email_admin").val(user.email);
                    $("#alamat_admin").val(user.alamat);

                    //transaction managemeng : id community (filter)
                    $(".id_komunitas_login").val(user.community_id);
                    $("#komunitas").val(user.community_id);
                    $("#komunitas2").val(user.community_id);
                    $("#list_komunitas_notif").val(user.community_id);
                    $(".nama_komunitas").html(user.community_name);

                    //Notif management
                    $("#komunitas_notif").val(user.community_id);

                    //edit-profil comm
                    $("#edit_namacom").val(user.community_name);
                    $("#edit_deskripsicom").val(user.community_description);
                    $("#edit_idcom").val(user.user_id);

                    $(".logo_komunitas").attr("src", server_cdn + cekimage_cdn(user.community_logo));

                    //initial login
                    if (user.status == 0) {
                        $("#comm_status_admin").html("Newly");
                    } else if (user.status == 1) { //first-login
                        get_initial_feature(result.my_feature); //isi data
                        $("#initial1").modal('show');
                        $("#comm_status_admin").html("Newly");
                    } else if (user.status == 2) {
                        $("#comm_status_admin").html("Community Active");
                    } else if (user.status == 3) { //status=0 belum aktif
                        $("#btn_ke_commset_publish").hide();
                        $("#comm_status_admin").html("Published");
                    } else {
                        $("#btn_ke_commset_publish").hide();
                        swal("Your account not verified, please wait system or call Commjuction's Administrator", "Inactive", "error");
                        window.location.href = "/admin";
                    }

                    //cek membership pricing free or not
                    if (user.community_membership_type == 1) {
                        // alert('free');
                        $(".input_pricemember").hide();
                        $("#harga_member").val(0);
                    } else {
                        // alert('paid');
                        $(".input_pricemember").show();
                    }

                    //PUBLISH COMMUNITY CEK
                    if (user.status_publish != undefined) {
                        $("#btn_ke_commset_publish").hide();
                        $("#btn_ke_commset_publish").css("display", "none");
                    }


                }
            }
        },
        error: function (result) {
            console.log("Cant Reach Session Logged Admin Community Dashboard");
        }
    });
}



//GET LAST NOTIFICATION
function get_list_notif_navbar(idkom) {
    // alert(idkom);
    var tday = new Date();
    var d = new Date();
    var today = formatDate(d.toLocaleDateString());
    // console.log(today);
    d.setMonth(d.getMonth() - 1);
    var ago = formatDate(d.toLocaleDateString());
    // console.log(ago);

    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_list_notif_navbar',
        type: 'POST',
        dataSrc: '',
        data: {
            "community_id": idkom,
            "start_date": ago,
            "end_date": today,
            "read_status": "1", //1:notread 2:read
            "notification_status": "receive", //send/receive
            "limit": 5,
            "_token": token
        },
        timeout: 30000,
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    var nonotif = '<center><br><h3 class="clight">No Notification</h3><br></center>';
                    $("#isi_notif_navbar").html(nonotif);
                    $("#ada_notif").hide();
                }
            } else {

                var isiku = '';
                $.each(result, function (i, item) {

                    var d = new Date(item.created_at);
                    dformat = [d.getDate(), d.getMonth() + 1,
                    d.getFullYear()].join('/') + ' ' +
                        [d.getHours(),
                        d.getMinutes(),
                        d.getSeconds()].join(':');

                    var textArray = [
                        'bg-success',
                        'bg-info',
                        'bg-danger',
                        'bg-warning'
                    ];
                    var acak = Math.floor(Math.random() * textArray.length);


                    isiku += '<a class="dropdown-item preview-item notif">' +
                        '<div class="preview-thumbnail medium">' +
                        '<div class="preview-icon ' + textArray[acak] + '">' +
                        '<i class="mdi mdi-bell-outline"></i>' +
                        '</div>' +
                        '</div>' +
                        '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center"> ' +
                        '<label class="preview-subject font-weight-normal mb-1 s14">' + item.created_by_title +
                        '</label> ' +
                        '<small class="text-gray ellipsis mb-1"> ' + item.title + '</small > ' +
                        '<small class="cbiru  mb-0">' + dformat + '</small > ' +
                        '</div> ' +
                        '</a> ' +
                        '<div class="dropdown-divider"></div>';
                });
                $("#isi_notif_navbar").html(isiku);
                $("#ada_notif").show();
            }
        },
        error: function (result) {
            var nonotif = '<center><br><h3 class="clight">No Notification</h3><br></center>';
            $("#isi_notif_navbar").html(nonotif);
            $("#ada_notif").hide();
            console.log("Cant Show Navbar Notif");
        }
    });
}

function LogoutAdmin() {
    // $("#btn_logout_all").click(function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend(jxqhr) {
            $(".hide_load_log").show();
            $("#text_logout").hide();
        },
        timeout: 20000,
    });
    $.ajax({
        url: '/admin/LogoutAdmin',
        type: 'POST',
        dataSrc: '',
        data: {
            "_token": token,
        },
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
                if (result == "sukses") {
                    location.href = '/admin';
                }
            }
        },
        error: function (result) {
            ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');

            setTimeout(function () {
                location.href = '/admin';
            }, 6000);
        }
    });
    // });
}



function errorImg() {
    $('.rounded-circle').attr('src', '/img/noimg.jpg');
}

function dateFormat(tgl) {
    var d = new Date(tgl);

    dformat = [d.getDate(), d.getMonth() + 1,
    d.getFullYear()].join('/') + '<br>' +
        [d.getHours(),
        d.getMinutes(),
        d.getSeconds()].join(':');

    return dformat;
}


function get_initial_feature(datafitur) {

    var html = '';
    $.each(datafitur, function (i, item) {
        // console.log(item.title);
        var imgk = cekimage_cdn(item.logo);
        var noimg = '/img/fitur.png';
        html +=
            '<div class="col-md-6 mgku-1">' +
            '<div class="media">' +
            '<img src="' + imgk + '" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;"' +
            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
            '<div class="media-body">' +
            '<h6 class="s13 cgrey" style="margin-bottom: 0em;">' +
            item.title + '</h6>' +
            '<small class="card-text clight s12">' +
            item.description + '</small>' +
            '</div>' +
            '</div>' +
            '</div>';
    });
    $('.modal_initial_fitur').html(html);
}



// function logout_admin_community() {
//     gapi.load('auth2', function () {
//         gapi.auth2.init();
//     });

//     var auth2 = gapi.auth2.getAuthInstance();
//     auth2.signOut().then(function () {
//         window.location.href = "/admin/logout";
//     });

// }




//validasi format email
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}//end-valid email


function clickImage(img) {
    if (img != null && img != undefined) {
        var modal = document.getElementById("mdl-img-click");
        var img = document.getElementById(img.id);
        var modalImg = document.getElementById("mdl-img-view");

        img.onclick = function () {
            $('#mdl-img-click').modal('show');
            modalImg.src = this.src;
        }
    }
}

function rupiah(val) {
    var bilangan = val;
    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');

    return ribuan;
}


function formatDate(date) {
    if (date != undefined) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

}


//TAB MENU LINE

$(".tabbable-line li a").click(function () {
    $(".tabbable-line li").removeClass('active');
    $(this).parent().addClass('active');
});

//ON ERROR IMAGE
function errorImg() {
    $('.rounded-circle').attr('src', '/img/default.png');
}

// function file_browser_profil(){
var readURLuser = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#view_edit_user').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$("#file_edit_profil_user").on('change', function () {
    readURLuser(this);
});

$("#browse_user_admin").on('click', function () {
    $("#file_edit_profil_user").click();
});
// }

function showPassNew() {
    var a = document.getElementById("new_pass_admin");
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}

function showPassText(ini) {
    var a = document.getElementById(ini);
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}


function cekimage_cdn(img) {
    if (img != undefined && img != null) {
        var cekone = img.slice(0, 1);
        var foto = '';
        if (cekone != "/") {
            foto = "/" + img;
        } else {
            foto = img;
        }
    } else {
        foto = '';
    }

    return foto;
}

function dateTime(tgl) {
    var d = new Date(tgl);

    dformat = [d.getDate(), d.getMonth() + 1,
    d.getFullYear()].join('/') + ' &nbsp; ' +
        [d.getHours(),
        d.getMinutes(),
        d.getSeconds()].join(':');

    return dformat;
}


//tree list
$(document).on('click', '.tree label', function (e) {
    $(this).next('ul').fadeToggle();
    e.stopPropagation();
});


$(document).on('change', '.tree input[type=checkbox]', function (e) {
    $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
    $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
    e.stopPropagation();
});



//CEK PUPBLISH COMMUNITY SETTING

function cek_prepare_publish() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/cek_prepare_publish',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                $("#isi_list_setting").html('<center><br><br><h2 class="clight">No Data Publish</h2></center>');
                ui.popup.show('warning', result.message, 'Warning');
            } else {
                var isinya = '';
                var sready;

                $.each(result, function (i, item) {

                    if (item.ready == true) {
                        sready = '<small class="cgreen">Ready</small>';
                    } else {
                        sready = '<small class="cred">Not Ready</small>';
                    }

                    isinya += '<div class="row" style="margin-bottom:1em;">' +
                        '<div class="col-md-6">' +
                        '<h6 class="cdgrey judulcomsetup">' + item.type + '</h6>' +
                        '<small class="clight">' + item.name + '</small>' +
                        '</div>' +
                        '<div class="col-md-3" style="text-align:right; margin-top:0.5em;">' +
                        sready +
                        '</div>' +
                        '<div class="col-md-3">' +
                        '<button type="button" onclick="listsetting()" class="btn btn-sm btn-tosca">Setting</button>' +
                        '</div>' +
                        '</div>';
                });

                $("#isi_list_setting").html(isinya);
            }
        },
        error: function (result) {
            $("#isi_list_setting").html('<center><h2 class="clight">No Data Publish</h2></center>');
            console.log(result);
        }
    });
}


function listsetting() {
    window.location = '/admin/community_setting';
}


function init_ready() {
    if ($("#page_dashboard_admin").length != 0) {
        get_dashboard_admin(); //data dashboard
        get_headline_news(); //data headline news
        get_last_news(); //data Last news
        get_topvisit_news(); //data Top Visit news
        get_toploved_news(); //data Top Loved news
    }


    if ($("#page_news_management_admin").length != 0) {
        $('#toggle-headline').attr("disabled");
        $('#toggle-status').attr("disabled");
        //get_all_news();
        tabel_news_management();
        tabel_cek_news();
    }


    if ($("#page_community_setting").length != 0) {
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
        color_and_font();
    }


    if ($("#page_edit_subs_management").length != 0) {
        file_browser_profil();
    }

    if ($("#edit_profil_komunitas").length != 0) {
        choose_file_komunitas();
    }

    if ($("#page_subs_management").length != 0) {
        get_membership_subs();
        tabel_subscriber_all();
        tabel_subscriber_pending();
    }

    if ($("#page_membership_management").length != 0) {
        get_membership_admin();
        tabel_req_membership();
        get_list_fitur_membership_admin();

        file_browse_membership(); //open file
    }

    if ($("#page_user_management").length != 0) {
        get_user_tipe_manage();
        tabel_user_management();
    }

    if ($("#page_module_management").length != 0) {
        get_module_active();
        get_module_all();
        get_payment_module();
        func_pay_module();
    }

    if ($("#page_usertype_management").length != 0) {
        tabel_usertype_management_admin();
        get_listfitur_usertype_ceklist();
        cek_error_usertype();
    }

    if ($("#page_transaction_management_admin").length != 0) {
        get_list_transaction_tipe();
        get_list_subscriber_admin();

        $("#reset_tbl_trans").click(function () {
            resetparam_trans();
        });

        $("#btn_showtable_transaksi").click(function (e) {
            show_tabel_transaksi();
        });
    }

    if ($("#page_report_management_admin").length != 0) {
        get_list_transaction_type_admin();
        get_list_subscriber_report();
    }

    if ($("#page_payment_management_admin").length != 0) {
        tabel_payment_all_admin();
        tabel_payment_active_admin();
        get_payment_module();

        $("#reset_tbl_payment_all").click(function () {
            tabel_payment_all_admin();
        });

        function pilih_pay_bank(ini) {
            $(".hidendulu").removeClass('dipilih');
            $('.btn-blueline').removeClass('active');
            $("#" + ini.id).addClass('active');
            $("." + ini.id).addClass('dipilih');
            $("." + ini.id).removeClass('active');
        }

        function pilihpay(idpay) {
            $("#id_pay_method_module").val(idpay);
            $(".border-oren").removeClass("active");
            $("#cardpay" + idpay).addClass("active");
            $("#btn_pay_next").removeAttr("disabled");

            if ($("#payment_time_module").val() != "") {

                $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
            }
        }
    }

    if ($("#page_notif_management_admin").length != 0) {
        var err_notif = $(".err_notif").val();
        if (err_notif != "" && err_notif != undefined) {
            swal("Cant Null !", "Please Fill and Check All Fields", "error").then((value) => {
                $("#modal_send_notif_super").modal('show');
            });
        }
        get_list_setting_notif_admin();

        $("#btn_generate_notif_admin").click(function () {
            tabel_generate_notif_admin();
        });

        var switchStatus = false;
        $("#status_notif").on('change', function () {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                $("#hide_user_notif").fadeIn('fast');
                cek_param_list_user();
                $("#idstatus_notif").val("1");
            }
            else {
                switchStatus = $(this).is(':checked');
                $("#hide_user_notif").fadeOut('fast');
                cek_param_list_user();
                $("#idstatus_notif").val("2");
            }
        });

        $('#tipenotif').change(function () {
            var ipilih = this.value;
            if (ipilih == "1") {
                $("#hide_urlnotif").fadeIn('fast');
            } else {
                $("#hide_urlnotif").fadeOut('fast');
            }
        });


        $('#usertipe_notif').change(function () {
            get_list_user_notif();
        });
    }

    if ($("#page_inbox_management_admin").length != 0) {
        $("#btn_generate_inbox_super").click(function () {
            tabel_inbox_message_admin();
        });

        $('#bc_status').change(function () {
            var dipilih = this.value;
            if (dipilih == 1) {
                $("#hide_user_notif").css("display", "block");
                get_list_subscriber();
            } else {
                $("#hide_user_notif").css("display", "none");
            }
        });

    }


    if ($("#page_publish_commset_admin").length != 0) {
        cek_prepare_publish();
    }

    if ($("#page_detail_news_admin").length != 0) {
        $("#modal_ajax").modal('hide');
    }

    if ($("#page_event_module_admin").length != 0) {
        tabel_event_list_admin();
        addRow_create_tiket();
        get_list_event_admin(0);
        get_list_event_admin("_filter");

    }

}



// ----------------------------  DASHBOARD  -------------------------------
function get_dashboard_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: '/admin/get_dashboard_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token,
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 401) {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 6000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                var pending_subs = result.pending_subscriber[0];

                tabel_pending_subscriber(pending_subs);
                get_module_info(result.module_info[0]);
                chart_activity(result.chart_activity);
                chart_transaction(result.chart_transaction);

                $(".total_fituraktif").html(result.total_feature_active + " Features");
                $(".total_subs").html(result.total_subscriber + " Subscriber");
                $(".total_transaction_count").html(result.total_transaction_count + " Transaction");
                $(".total_trans_number").html(result.total_transaction_number + " Transaction");

                if (result.top_subscriber[0] != "") {
                    var top5 = '';
                    $.each(result.top_subscriber[0], function (i, item) {
                        top5 += ' <li>' + item.full_name + '</li>';
                    });
                    $('#top-5-subs').html(top5);
                } else {
                    $('#top-5-subs').html('<center><br><br><br><br><h2 class="display-3" style="color: #c5c5c5;">No Data</h1></center>');
                }
            }
        },
        error: function (result) {
            ui.popup.show('warning', 'Couldnt get any response for dashboard', 'Timeout');
            console.log(result);
        }
    });
}



function tabel_pending_subscriber(data_subs) {
    var isitabel = '';
    var total_pending = 0;

    $.each(data_subs, function (i, item) {
        total_pending++;
        isitabel += '<li><small class="cgrey2">' + item.full_name + '</small></li>';

    });
    $('#isi_total_pendingsubs').html(total_pending + " Person");
    $('#pending_subs_dash').html(isitabel);
}



$("#btn-initial1").click(function () {
    $("#initial1").modal('hide');
    $("#initial2").modal('show');
    $("#initial3").modal('hide');
});

$("#btn-initial2").click(function () {
    $("#initial1").modal('hide');
    $("#initial2").modal('hide');
    $("#initial3").modal('show');
});

$("#btn-initial3").click(function () {
    $("#initial1").modal('hide');
    $("#initial2").modal('hide');
    $("#initial3").modal('hide');
});

function chart_activity(data) {
    var dt = data[0];
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [dt.x],
            datasets: [{
                label: dt.x,
                backgroundColor: 'rgb(255, 255, 230)',
                borderColor: 'rgb(255, 99, 132)',
                data: [dt.y]
            }]
        },

        // Configuration options go here
        options: {}
    });
}

function chart_activity(data) {
    var dt = data[0];
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [dt.x],
            datasets: [{
                label: dt.x,
                backgroundColor: 'rgb(255, 255, 230)',
                borderColor: 'rgb(255, 99, 132)',
                data: [dt.y]
            }]
        },

        // Configuration options go here
        options: {}
    });
}

function chart_transaction(data) {
    var dt = data[0];
    var ctx = document.getElementById('myChartTransaction').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [dt.x],
            datasets: [{
                label: dt.x,
                backgroundColor: 'rgb(255, 255, 230)',
                borderColor: 'rgb(0, 184, 230)',
                data: [dt.y]
            }]
        },
        options: {}
    });
}

function get_module_info(dtmodule) {
    var subf = '';
    var jum = 0;
    $.each(dtmodule, function (i, item) {
        jum++;
        subf += '<div class="col-md-12 stretch-card grid-margin" style="height:75px; padding-left: 5px; padding-bottom:0px; margin-bottom:0.5em;"' +
            'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
            'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
            '<div class="card bg-gradient-yellow card-img-holder text-white">' +
            '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
            'alt="circle-image" /> ' +
            '<div class="row">' +
            '<div class="col-md-3" style="padding-right:4px;">' +
            '<img src="' + server_cdn + item.logo + '" class="rounded-circle img-fluid img-card3"' +
            'onerror = "this.onerror=null;this.src=\' /img/fitur.png \';">' +
            '</div>' +
            '<div class="col-md-9" style="padding-left:5px;">' +
            '<b><small>' + item.title + '</small></b>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
    });
    $("#module_info_dash").html(subf);
    $("#isi_total_module").html(jum + "  Modules");
}

function get_headline_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_headline_news',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    $("#hide_nodata_headline").show();
                    $("#headline_cont").hide();
                }
            } else {
                var isiheadline = '';
                $.each(result, function (i, item) {
                    var noimg = '/visual/car1.png';
                    $news_id = parseInt(item.id);
                    var $headpic = server_cdn + cekimage_cdn(item.image);
                    isiheadline += '<div class="stretch-card grid-margin news_headline_card">' +
                        '<div class="card sumari">' +
                        '<div class="card-body sumari">' +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        '<div class="news_pic_dash">' +
                        '<img class="news_pic" src="' + $headpic + '" onerror="this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '</div>' +
                        '<small class="clight">' + dateTime(item.createdAt) + '</small>' +
                        '<h4 class="cgrey-mid total_fituraktif">' + item.title + '</h4>' +
                        '<a href="/admin/get_detail_news/' + $news_id + '" class="news_readmore">Read More</a>' +
                        '</div></div></div></div></div>';
                });

                $("#news_headline_cont").html(isiheadline);
            }
        },
        error: function (result) {
            console.log(result);
            $("#hide_nodata_headline").show();
            $("#headline_cont").hide();
        }
    });
}

function get_last_news() {
    var token = $('meta[name="csrf-token"]').attr('content');

    var noimg = '/img/kosong.png';
    var tabel = $('#table_last_news').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12'i><'col-sm-12'p>>",
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        ajax: {
            url: 'tabel_last_news',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                $('#table_last_news tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'image',
                render: function (data, type, row) {
                    // console.log('lastnews' + data);
                    return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                }
            },
            {
                mData: 'title',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-200">' + data + '</p>';
                }
            },
            {
                mData: 'createdAt',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            }
        ],

    });
}

function get_topvisit_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var noimg = '/img/kosong.png';
    var tabel = $('#table_topvisit_news').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12'i><'col-sm-12'p>>",
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        ajax: {
            url: 'table_topvisit_news',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                $('#table_topvisit_news tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'image',
                render: function (data, type, row, meta) {
                    // console.log('topvisit' + data);
                    return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                }
            },
            {
                mData: 'title',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-200">' + data + '</p>';
                }
            },
            {
                mData: 'createdAt',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            }
        ],

    });
}

function get_toploved_news() {
    var token = $('meta[name="csrf-token"]').attr('content');

    var noimg = '/img/kosong.png';
    var tabel = $('#table_toploved_news').DataTable({
        responsive: true,
        dom: "<'row'<'col-sm-12'l><'col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12'i><'col-sm-12'p>>",
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        ajax: {
            url: 'table_toploved_news',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                $('#table_toploved_news tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'image',
                render: function (data, type, row, meta) {
                    console.log('toplove' + data);
                    return '<img src=' + server_cdn + data + '  class="news-list-box zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                }
            },
            {
                mData: 'title',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-200">' + data + '</p>';
                }
            },
            {
                mData: 'createdAt',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            }
        ],

    });
}
// ---- END-DASHBOARD ------



// ------ NEWS MANAGEMENT ---------

$("#file-upload-komunitas").on('change', function () {
    readURLini(this);
});

$("#btn_up_logo_komunitas").on('click', function () {
    $("#file-upload-komunitas").click();
});

var readURLini = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#news_picture').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#file-upload-komunitas2").on('change', function () {
    readURLini2(this);
});

$("#btn_up_logo_komunitas2").on('click', function () {
    $("#file-upload-komunitas2").click();
});

var readURLini2 = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#news_picture2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}



$("#btn_add_news").on('click', function () {
    var editor = new nicEditor({ iconsPath: '/img//nicEditorIcons.gif' }).panelInstance('news_add_content');
    $('.nicEdit-panelContain').parent().width('100%');
    $('.nicEdit-main').parent().width('98%');
    $('.nicEdit-main').width('98%');
    $('.nicEdit-main').height('200px');

});


$('#toggle-status').change(function () {
    $id = $('#toggle-status').attr('value');
    change_status($id);
});

$('#toggle-headline').change(function () {
    $id = $('#toggle-headline').attr('value');
    change_headline($id);
});

function change_status(id) {
    var token = $('meta[name="csrf-token"]').attr('content');

    $id = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/publish_news',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "news_id": id,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            $msg = result.status;
            // // alert($msg);
            // if ($msg == 1) {
            //     swal("News Successfully Published");
            // } else {
            //     swal("News Successfully Disabled");
            // }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function change_headline(id) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $id = id;
    //alert('Toggle: '+ $id + $('#toggle-status').prop('checked'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/publish_headline',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "news_id": id,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            $msg = result.status;
            //alert($msg);
            // if ($msg == true) {
            //     swal("News Set as Headline");
            // } else {
            //     swal("News Headline Disabled");
            // }
        },
        error: function (result) {
            console.log(result);
        }
    });
}


function tabel_cek_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/tabel_news_management',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.status === 401 || result.message === "Unauthorized") {
                ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                setTimeout(function () {
                    location.href = '/subscriber/url/' + $(".community_name").val();
                }, 5000);
            } else {
                ui.popup.show('warning', result.message, 'Warning');
            }
        },
        error: function (result) {
            console.log("Cant Show");
        }
    });
}

function tabel_news_management() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_news_manage').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_news_management',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_news_manage tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'image',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    var noimg = '/img/kosong.png';
                    return '<img src=' + server_cdn + cekimage_cdn(data) + ' class="news-list-box zoom"  onclick="clickImage(this)" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">';
                }
            },
            {
                mData: 'title',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-200">' + data + '</p>';
                }
            },
            { mData: 'author_name' },
            {
                mData: 'createdAt',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'publish',
                render: function (data, type, row, meta) {
                    if (data == 0) {
                        return '<div class="label-off">Unpublish</div>';
                    } else {
                        return '<div class="label-on">Published</div>';
                    }
                }
            },
            {
                mData: 'headline',
                render: function (data, type, row, meta) {
                    if (data == false) {
                        return '<div class="headline-off">Normal</div>';
                    } else {
                        return '<div class="headline-on">Headline</div>';
                    }
                }
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return '<a href="/admin/get_detail_news/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i></a>' +
                        '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=edit_news_management(' + data + ')>' +
                        '<i class="mdi mdi-pencil matadetail"></i></i></a>';
                }
            }
        ],

    });
}



function showPassword() {
    var a = document.getElementById("confirmpass_user");
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}

function edit_news_management(news_id) {
    $('#toggle-headline').removeAttr("disabled");
    $('#toggle-status').removeAttr("disabled");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_data_edit',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "news_id": news_id
        },
        success: function (res) {
            $publish_stat = res.publish;
            $headline_stat = res.headline;


            if ($publish_stat == 1) {
                $('#toggle-status').bootstrapToggle('on');
            } else {
                $('#toggle-status').bootstrapToggle('off');
            }

            if ($headline_stat == true) {
                $('#toggle-headline').bootstrapToggle('on')
            } else {

                $('#toggle-headline').bootstrapToggle('off')
            }


            $("#modal_edit_news").modal("show");
            var editor = new nicEditor({ iconsPath: '/img//nicEditorIcons.gif' }).panelInstance('news_edit_content');
            $('.nicEdit-panelContain').parent().width('100%');
            $('.nicEdit-main').parent().width('98%');
            $('.nicEdit-main').width('98%');
            $('.nicEdit-main').height('200px');

            var content = nicEditors.findEditor('news_edit_content');
            content.setContent(res.content);
            $('textarea[name=news_edit_content]').val(res.content);

            $("#news_picture").attr("src", server_cdn + res.image);
            $("#edit_title").val(res.title);
            $("#id_news").val(res.id);
            $("#toggle-status").val(res.id);
            $("#toggle-headline").val(res.id);





        },
        error: function (result) {
            console.log("Cant Show Detail User");
        }
    });
}
// -------- END NEWS MANAGEMENT ----------



// --------------------------------- COMMUNITY SETTING -----------------------------------

//COMMUNITY SETTING DATA
function get_result_setup_comsetting() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_result_setup_comsetting',
        type: 'POST',
        dataSrc: '',
        data: {
            "_token": token
        },
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
                if (tipeform.data != undefined && tipeform != null || tipeform != "" || tipeform != 0) {
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

                $("#cek_form_subdomain").val(tipeform.ready);


                var portal = result[1];
                if (portal.data != undefined) {
                    if (portal.data.headline_text != null && portal.data.headline_text != "" && portal.data.headline_text != undefined) {
                        $("#headline").val(portal.data.headline_text);
                        $("#description_custom").val(portal.data.description);
                        $("#font_headline").val(portal.data.font_headline);
                        $("#font_headline").css('font-family', portal.data.font_headline);

                        $("#font_link").val(portal.data.font_link);
                        $("#font_link").css('font-family', portal.data.font_link);

                        $("#color_base").val(portal.data.base_color);
                        $("#color_accent").val(portal.data.accent_color);
                        $("#color_bgcolor").val(portal.data.background_color);
                        $("#color_navbar").val(portal.data.navbar_color);

                        $("#colour").val(portal.data.base_color);
                        $("#colour2").val(portal.data.accent_color);
                        $("#colour3").val(portal.data.background_color);
                        $("#colour4").val(portal.data.navbar_color);

                        $("#output-color").html(portal.data.base_color);
                        $("#output-color2").html(portal.data.accent_color);
                        $("#output-color3").html(portal.data.background_color);
                        $("#output-color4").html(portal.data.navbar_color);

                        $("#color_front").css('background-color', portal.data.base_color);
                        $("#color_front2").css('background-color', portal.data.accent_color);
                        $("#color_front3").css('background-color', portal.data.background_color);
                        $("#color_front4").css('background-color', portal.data.navbar_color);
                    }



                    if (portal.data.image != undefined || portal.data.image != null || portal.data.image != 0) {
                        $("#img_portal_admin").attr("src", server_cdn + cekimage_cdn(portal.data.image));
                    }

                    if (portal.data.icon != undefined || portal.data.icon != null || portal.data.icon != 0) {
                        $("#img_logo_portal").attr("src", server_cdn + cekimage_cdn(portal.data.icon));
                    }

                    if (portal.ready == true) {
                        // $('#headline').attr("disabled", "disabled");
                        // $('#description_custom').attr("disabled", "disabled");

                        // $("#colour").attr("disabled", "disabled");
                        // $("#colour2").attr("disabled", "disabled");

                        // $("#font_headline").attr("disabled", "disabled");
                        // $("#font_link").attr("disabled", "disabled");

                        $("#up_img_portal").hide();
                        $(".img_portal").show();

                        $("#up_logo_portal").hide();
                        $(".logo_portal").show();
                    }

                    $("#edit_img_portal").click(function (event) {
                        $("#up_img_portal").show();
                        $(".img_portal").hide();
                        $("#cancel_img_portal").show();
                        $("#edit_img_portal").hide();
                    });

                    $("#cancel_img_portal").click(function (event) {
                        $("#up_img_portal").hide();
                        $(".img_portal").show();
                        $("#edit_img_portal").hide();
                    });


                    $("#edit_icon_portal").click(function (event) {
                        $("#up_logo_portal").show();
                        $(".logo_portal").hide();
                        $("#cancel_icon_portal").show();
                        $("#edit_icon_portal").hide();
                    });
                    $("#cancel_icon_portal").click(function (event) {
                        $("#up_logo_portal").hide();
                        $(".logo_portal").show();
                        $("#edit_icon_portal").hide();
                    });
                }

                var domain = result[2];
                if (domain.data != undefined) {
                    if (domain.data.subdomain != null || domain.data.subdomain == "") {
                        $('#subdomain').val(domain.data.subdomain);
                        // if (domain.ready == true && domain.data.subdomain != "") {
                        //     $('#subdomain').attr("disabled", "disabled");
                        // }
                    }
                }


                // if (tipeform.ready == true && portal.ready == true && domain.ready == true) {
                //     $("#btn_commset_login").attr("disabled", "disabled");
                //     $("#btn_commset_login").hide();
                // }

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

function color_and_font() {
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


    $("#colour3").change(function (event) {
        // console.log($(this).val());
        $("#color_front3").css('background-color', $(this).val());
    });

    $("#color_front3").click(function (event) {
        $("#colour3").click();
    });


    $("#colour4").change(function (event) {
        // console.log($(this).val());
        $("#color_front4").css('background-color', $(this).val());
    });

    $("#color_front4").click(function (event) {
        $("#colour4").click();
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

    var input = document.getElementById('colour3');
    input.addEventListener('change', getcolour_bgcolor);
    function getcolour_bgcolor(colr) {
        var colr = this.value;
        $("#output-color3").html(colr);
        $("#color_bgcolor").val(colr);
    }

    var input = document.getElementById('colour4');
    input.addEventListener('change', getcolour_navbar);
    function getcolour_navbar(colr) {
        var colr = this.value;
        $("#output-color4").html(colr);
        $("#color_navbar").val(colr);
    }


    $('#font_headline').change(function () {
        $("#font_headline").css('font-family', this.value);
    });

    $('#font_link').change(function () {
        $("#font_link").css('font-family', this.value);
    });
}

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
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/tabel_list_regisdata',
        type: 'POST',
        data: {
            "_token": token
        },
        datatype: 'JSON',
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status === 401 || result.message === "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                $.each(result, function (i, item) {
                    var judul = item.param_form_array[0];
                    var tipedata = item.param_form_array[1];

                });
            }
        },
        error: function (result) {
            console.log("Cant Show");
        }
    });
}

function tabel_list_regisdata() {
    var token = $('meta[name="csrf-token"]').attr('content');
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
            data: {
                "_token": token
            },
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
                        tp = 'Radio Button';
                    } else if (tipedata == 2) {
                        tp = 'Input Number';
                    } else if (tipedata == 3) {
                        tp = 'Input Text';

                    } else if (tipedata == 4) {
                        tp = 'Textarea';

                    } else if (tipedata == 5) {
                        tp = 'Input Date';

                    } else if (tipedata == 6) {
                        tp = 'Checkbox';

                    } else {
                        tp = 'Dropdown';
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


        $("#edit_deskripsi_regis").val(pilih.description);
        $("#id_question").val(pilih.id);
        var isi = pilih.param_form_array;

        $("#edit_question").val(isi[0]);
        $("#edit_tipedata").val(isi[1]).attr("selected", "selected");

        if (isi[1] == 1 || isi[1] == 6 || isi[1] == 7) {
            $("#edit_input_pilihan").fadeIn("slow").show();
        } else {
            $("#edit_input_pilihan").fadeOut("slow").hide();
        }


        var len = isi.length;
        if (isi[2] != pilih.description) {
            var cek = isi.slice(2, len);
        } else {
            var cek = isi.slice(3, len);
        }

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
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_custum_inputipe",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
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
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_status_com_publish',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.status == 3 || result.status == 4) {
                $("#btn_ke_commset_publish").hide();
                $("#btn_ke_commset_publish").css("display", "none");
            } else {
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
    var token = $('meta[name="csrf-token"]').attr('content');
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
            data: {
                "_token": token
            },
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
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_payment_tipe",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
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
}

$("#payment_tipe").change(function (event) {
    var val = $(this).val();
    get_bank_pay(val);

});

//dropdown bank
function get_bank_pay(id_paytipe) {
    var token = $('meta[name="csrf-token"]').attr('content');
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
            "payment_type_id": id_paytipe,
            "_token": token
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
}

// --------------------------------END COMMUNITY SETTING ---------------------------------


//  ---------------- EDIT PROFIL COMMUNITY  -------------------------
function choose_file_komunitas() {

    $("#file-upload-profil-kom").on('change', function () {
        readURLprofil(this);
    });

    $("#btn_up_profil-kom").on('click', function () {
        $("#file-upload-profil-kom").click();
    });

    var readURLprofil = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_profil_kom').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}
// ----------------- END EDIT PROFIL COMMUNITY ----------------------



// ------------------- SUBSCRIBER MANAGEMENT -----------------------

$("#btn-filter-subs").click(function () {
    $("#modal_filter_date_subs").modal('show');
});

$("#reset_tbl_subsall").click(function () {
    $("#subs_datemulai").val("");
    $("#subs_dateselesai").val("");
    $("#membership_tipe").val("");
    tabel_subscriber_all();
});

$("#btn_filter_date").click(function (e) {
    $('#membership_tipe').val("");
    tabel_subscriber_all();
});

$("#btn_filter_membership").click(function (e) {
    $("#subs_datemulai").val("");
    $("#subs_dateselesai").val("");
    filter_membership_subs();
});


function tabel_subscriber_all() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_subscriber').dataTable().fnClearTable();
    $('#tabel_subscriber').dataTable().fnDestroy();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tabel = $('#tabel_subscriber').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_subs_management',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "subs_datemulai": $("#subs_datemulai").val(),
                "subs_dateselesai": $("#subs_dateselesai").val(),
                "membership": $("#membership_tipe").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                // $('#tabel_subscriber tbody').;
                $('#tabel_subscriber tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'user_id' },
            {
                mData: 'membership',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    var isiku;
                    if (data == null) {
                        isiku = '<label style="color:red;">null</label>';
                    } else {
                        isiku = data.membership;
                    }
                    return isiku;
                }
            },
            { mData: 'full_name' },
            {
                mData: 'status',
                render: function (data, type, row) {
                    // console.log(data);
                    var isihtml;
                    if (data == 1) { //first-login
                        isihtml = '<label class="badge badge-gradient-info">Newly</label>';
                    } else if (data == 2) {
                        isihtml = '<label class="badge badge-gradient-warning">Pending Membership</label>';
                    }
                    else if (data == 3) {
                        isihtml = '<label class="badge badge-gradient-success">Active</label>';
                    }
                    else if (data == 4) {
                        isihtml = '<label class="badge badge-gradient-secondary">Deactive</label>';
                    } else {
                        isihtml = '<label class="badge badge-gradient-danger">Pending</label>';
                    }

                    return isihtml;
                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return formatDate(data);
                }
            },
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    return '<a href="/admin/detail_subscriber/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i>' +
                        '</a>';
                }
            }
        ],

    });
    $("#subs_datemulai").val("");
    $("#subs_dateselesai").val("")
    $("#modal_filter_date_subs").modal('hide');
}

function tabel_subscriber_pending() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_subs_pending').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_subs_pending',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
        },
        columns: [
            { mData: 'user_id' },
            {
                mData: 'membership',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    var isiku;
                    if (data == null) {
                        isiku = '<label style="color:red;">null</label>';
                    } else {
                        isiku = data.membership;
                    }
                    return isiku;
                }
            },
            { mData: 'full_name' },
            {
                mData: 'status',
                render: function (data, type, row) {
                    // console.log(data);
                    var isihtml;
                    if (data == 1) { //first-login
                        isihtml = "First Login";
                    } else if (data == 2) {
                        isihtml = "Active"
                    } else if (data == 3) {
                        isihtml = "Published";
                    } else {
                        isihtml = "Pending";
                    }

                    var htmlku = '<label class="badge badge-gradient-danger">' + isihtml + '</label>';

                    return htmlku;
                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return formatDate(data);
                }
            },
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {
                    return '<a href="/admin/detail_pendingsubs/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i>' +
                        '</a>';
                }
            }
        ],

    });

}

//dropdown
function get_membership_subs() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_membership_subs",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                $('#membership_tipe').empty();
                $('#membership_tipe').append("<option disabled lang='en'>No Data</option>");
            } else {
                $('#membership_tipe').empty();
                $('#membership_tipe').append("<option disabled> Choose </option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#membership_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].membership, "</option>"));
                }
                //Short Function Ascending//
                $("#membership_tipe").html($('#membership_tipe option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#membership_tipe").get(0).selectedIndex = 0;
            }

        },
        error: function (result) {
            console.log(result);
        }
    });
} //endfunction


function filter_membership_subs() {
    $('#tabel_subscriber').dataTable().fnClearTable();
    $('#tabel_subscriber').dataTable().fnDestroy();

    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tabel = $('#tabel_subscriber').DataTable({
        responsive: true,
        ajax: {
            url: '/admin/filter_membership_subs',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "membership": $("#membership_tipe").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                // $('#tabel_subscriber tbody').;
                $('#tabel_subscriber tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'user_id' },
            {
                mData: 'membership',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    var isiku;
                    if (data == null) {
                        isiku = '<label style="color:red;">null</label>';
                    } else {
                        isiku = data.membership;
                    }
                    return isiku;
                }
            },
            { mData: 'full_name' },
            {
                mData: 'status',
                render: function (data, type, row) {
                    // console.log(data);
                    var isihtml;
                    if (data == 1) { //first-login
                        isihtml = '<label class="badge badge-gradient-info">Newly</label>';
                    } else if (data == 2) {
                        isihtml = '<label class="badge badge-gradient-success">Active</label>';
                    } else if (data == 3) {
                        isihtml = '<label class="badge badge-gradient-warning">Waiting</label>';
                    } else {
                        isihtml = '<label class="badge badge-gradient-danger">Pending</label>';
                    }

                    return isihtml;
                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return formatDate(data);
                }
            },
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    return '<a href="/admin/detail_subscriber/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detil_subs">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</a>';
                }
            }
        ],

    });
    $("#subs_datemulai").val("");
    $("#subs_dateselesai").val("")
    $("#modal_filter_date_subs").modal('hide');
}
// ------------------  END SUBSCRIBER MANAGEMENT -------------------




// --------------------- MEMBERSHIP MANAGEMENT -----------------------
function get_list_fitur_membership_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function error(event, jxqhr, status, _error) {
            ui.popup.show('error', status, 'Error');
        },
    });
    $.ajax({
        url: '/admin/get_list_fitur_membership_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {

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
                var parent_ui = '';
                $.each(result, function (i, item) {
                    var child_ui = '';
                    var parent = item.title;
                    var jum = 0;
                    var idfitur = '';
                    idfitur = item.id;
                    $.each(item.sub_features, function (i, subitem) {

                        child_ui += '<li class="">' +
                            '<input type="checkbox" name="fitur_member[]"' +
                            'id="subfitur_' + subitem.id + '"' +
                            'value="' + subitem.id + '">' +
                            '<label>' + subitem.title + '</label>' +
                            '</li>';
                        jum++;
                    });

                    if (jum == 0) {
                        parent_ui += '<ul class="tree member">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]" value="0" id="id_' + item.id + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {
                        parent_ui += '<ul class="tree member">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]"  value="' + idfitur + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '<small class="total"> &nbsp; (' + jum + ') </small>' +
                            '<i class="mdi mdi-chevron-down clight"></i>' +
                            '</label>' +
                            '<ul>' + child_ui + '</ul>' +
                            '</li>' +
                            '</ul>';
                    }
                });
                $("#isi_membership_admin").html(parent_ui);
            }
        },
        error: function (result) {
            ui.popup.show('error', result.message, 'Failed');
            console.log(result);
        }
    });
}


function get_membership_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_list_membership_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    $("#div_nomembership").show();
                    $("#show_membership").hide();
                }
            } else {
                $("#div_nomembership").hide();
                $("#show_membership").show();
                var isimember = '';
                $.each(result, function (i, item) {
                    var logo = server_cdn + cekimage_cdn(item.image);
                    var noimg = '/img/fitur.png';
                    isimember += '<div class="col-md-4 stretch-card grid-margin card-member">' +
                        '<div class="card bg-gradient-success card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<h4 class="font-weight-normal mb-3">' + item.membership + '<i class="mdi mdi-cube-outline mdi-24px float-right"></i>' +
                        '</h4>' +
                        '<div class="row">' +
                        '<div class="col-7">' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid logo-membership" onerror="this.onerror=null;this.src=\'' + noimg + '\';" >' +
                        '</div>' +
                        '<div class="col-5" style="text-align:right;">' +
                        '<button type="button" class="membershipbtn" onclick="detail_membership_card(' + i + ')">' +
                        '<b><small class="cteal s12"><i class="mdi mdi-checkbox-blank-circle"></i>' +
                        'Detail</small></b></button>' +
                        '</div></div>' +
                        '<small class="card-text">' + item.description + '</small>' +
                        '</div></div></div>';
                });
                $("#show_membership").html(isimember);
            }
        },
        error: function (result) {
            ui.popup.show('error', 'Cant Get Membership Features', 'Failed');
            console.log(result);
        }
    });
}


function detail_membership_card(dtnya) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_list_membership_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            var result = result[dtnya];
            $("#detail_judul_member").html(result.membership);
            $("#detail_harga_member").html("Rp  " + rupiah(result.pricing));
            $("#detail_deskripsi_member").html(result.description);
            $("#foto_membership").attr("src", server_cdn + cekimage_cdn(result.image));
            $("#modal_detail_membership_card").modal('show');

            var subf = '';
            var jum = 0;
            var noimg = '/img/fitur.png';

            $.each(result.feature, function (i, item) {
                var sub_ui = '';
                $.each(item.sub_features, function (i, subitem) {
                    sub_ui +=
                        '<li><small class="clight">' + subitem.title + '</small></li>';
                });
                jum++;
                subf += '<div class="row" style="margin-bottom:0.5em;">' +
                    '<div class="col-md-6"' +
                    'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                    'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                    '<div class="card bg-gradient-blue card-img-holder text-white submember">' +
                    '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
                    '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                    'alt="circle-image" /> ' +
                    '<div class="row">' +
                    '<div class="col-md-3" style="padding-right:4px;">' +
                    '<img src="' + server_cdn + cekimage_cdn(item.logo) + '" class="rounded-circle img-fluid img-card2"' +
                    'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                    '</div>' +
                    '<div class="col-md-9">' +
                    '<b><small>' + item.title + '</small></b><br>' +
                    '<small class="cblue"> <b>' + jum + '</b> Subfeature</small>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-6 padsubmember">' +
                    '<small class="cgrey2 s13">' + item.title + '</small>' +
                    '<ul class="submember">' + sub_ui + '</ul>' +
                    '</div></div>';
            });
            $("#show_feature_member").html(subf);
            $("#total_fitur_member").html(jum);
        },
        error: function (result) {
            console.log(result);
            $("#modal_detail_membership_card").modal('hide');
            ui.popup.show('error', "Cant load detail", 'Internal Server Error');
        }
    });

}


function tabel_req_membership() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_req_member').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_req_membership',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_req_member tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'user_id' },
            { mData: 'full_name' },
            { mData: 'payment_status_title' },
            { mData: 'payment_method' },
            { mData: 'membership' },
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {

                    return '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_req_membership(\'' + data + '\')">' +
                        '<i class="mdi mdi-eye matadetail"></i>' +
                        '</a>';
                }
            }
        ],

    });

}


function detail_req_membership(id_subs) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_detail_membership_req',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "user_id": id_subs,
            "_token": token
        },
        success: function (result) {
            var isipaid = '';
            console.log(result);
            var dt = result[0];
            $("#isi_date").html(formatDate(dt.request_date));
            $("#isi_invoice").html(dt.invoice_number);
            $("#invoice_num_acc").val(dt.invoice_number);
            $("#id_subs_acc").val(dt.user_id);
            $("#isi_username").html(dt.full_name);
            $("#isi_paytipe").html(dt.payment_method);
            $("#isi_totalpay").html("Rp " + rupiah(dt.grand_total));
            $("#isi_paystatus").html(dt.payment_status_title);
            $("#judul_member").html(dt.membership);

            if (dt.picture != undefined && dt.picture != null && dt.picture != "" && dt.picture != "0") {
                $("#foto_subs").attr("src", server_cdn + cekimage_cdn(dt.picture));
            }

            if (dt.file_subscriber == null) {
                $(".img_file_bayar_subs").attr("src", "/img/noimg.jpg");
            } else {
                $(".img_file_bayar_subs").attr("src", server_cdn + cekimage_cdn(dt.file_subscriber));
            }

            if (dt.already_paid == true) {
                isipaid = '<h6 style="color: #9de43e;">ALREADY PAID</h6';
            } else {
                isipaid = '<h6 style="color: #ff4d4d;">NOT YET</h6';
            }
            $("#isi_paid").html(isipaid);

            $("#modal_detail_req_member").modal("show");
        },
        error: function (result) {
            console.log("Cant Show Detail Membership Request");
        }
    });
}

function file_browse_membership() {
    $("#file_acc_member").on('change', function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#view_img_member').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            $('#view_img_member').show();
        }
    });

    $("#browse_acc_member").on('click', function () {
        $("#file_acc_member").click();
    });

    var readURLuser = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_img_membership').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file_img_membership").on('change', function () {
        readURLuser(this);
    });

    $("#browse_membership_admin").on('click', function () {
        $("#file_img_membership").click();
    });

}
//-------------------- END MEMBERSHIP MANAGEMENY -----------------------



// -----------------------  USER MANAGEMENT ------------------------
function tabel_user_management() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_user_manage').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_user_management',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
        },
        columns: [
            { mData: 'user_id' },
            { mData: 'full_name' },
            { mData: 'user_name' },
            { mData: 'user_type' },
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"  onclick="detail_user_manage(\'' + data + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
    });
}

function detail_user_manage(iduser) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_user_management',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "user_id": iduser,
            "_token": token
        },
        success: function (result) {
            console.log(result[0]);
            var res = result[0];
            $("#modal_detail_user").modal("show");
            // $("#foto_user").attr("src", server_cdn+res.foto);
            $("#detail_nama").html(res.full_name);
            $("#detail_username").html(res.user_name);
            $("#detail_email").html(res.email);
            $("#detail_hp").html(res.notelp);
            $("#detail_alamat").html(res.alamat);
            $("#detail_usertipe").html(res.user_type);

            $("#edit_nama").val(res.full_name);
            $("#edit_email").val(res.email);
            $("#edit_phone").val(res.notelp);
            $("#idnya_user").val(res.user_id);
            $('select[name="user_tipe_edit"]').val(res.user_type_id);

        },
        error: function (result) {
            console.log("Cant Show Detail User");
        }
    });
}

function showPassword() {
    var a = document.getElementById("pass_user");
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}


function get_user_tipe_manage() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_user_tipe_manage",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#user_tipe').empty();
            $('#user_tipe').append("<option disabled> Choose </option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#user_tipe').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            $("#user_tipe").html($('#user_tipe option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#user_tipe").get(0).selectedIndex = 0;
            const OldValue = "{{old('user_tipe')}}";
            if (OldValue !== '') {
                $('#user_tipe').val(OldValue);
            }
            // ______________________________________________
            $('#user_tipe_edit').empty();
            $('#user_tipe_edit').append("<option disabled> Choose </option>");
            for (var i = result.length - 1; i >= 0; i--) {
                $('#user_tipe_edit').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            $("#user_tipe_edit").html($('#user_tipe_edit option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));
            $("#user_tipe_edit").get(0).selectedIndex = 0;
            const OldValue2 = "{{old('user_tipe_edit')}}";
            if (OldValue2 !== '') {
                $('#user_tipe_edit').val(OldValue2);
            }
        }
    });
}
// --------------------- END USER MANAGEMENT -----------------------


// --------------------  MODULE MANAGEMENT ----------------------
function get_module_active() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_active_module_list',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success === false) {
                $("#nodata_module_active").show();
                $("#show_module_active").hide();
            } else {
                var isiui = '';
                var num = 0;
                $.each(result, function (i, item) {
                    num++;
                    var noimg = '/img/fitur.png';
                    var logo = server_cdn + item.logo;
                    isiui +=
                        '<div class="col-md-4 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                        'style="padding: 0.3rem 0.5rem;"' +
                        'onclick="detail_module_all(\'' + item.feature_id + '\')">Ready</button>' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<small class="cteal">' + item.feature_type_title + '</small>' +
                        '<h4>' + item.title + '</h4>' +
                        '</div>' +
                        '<div class="col-md-12" style="text-align: right;">' +
                        '<button type="button" class="a_setmodule" style="border: none; background: #ffffff00;"' +
                        'onclick="get_list_setting_module(' + item.feature_id + ')">' +
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                        ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                        '</small></button>' +
                        '</div>' +
                        '</div></div></div></div>';
                });
                $("#nodata_module_active").hide();
                $("#show_module_active").html(isiui);
                $("#total_module_active").html(num + " Modules");
            }
        },
        error: function (result) {
            console.log("Cant Show Module List");
        }
    });
}

function get_list_setting_module(idmod) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_list_setting_module_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "feature_id": idmod,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                swal('No Setting', 'The setting does not exist in this module', 'warning');
            } else {
                var uiku = '';
                $.each(result, function (i, item) {
                    var htmltag = '';
                    if (item.setting_type == 1) {
                        var tipe = 'Input Text';
                        htmltag = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                            'class="form-control input-abu param_setting">';
                    } else {
                        var tipe = 'Radio Button';
                        if (item.value == "true") {
                            htmltag = '<div class="form-group">' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                                '</div>';
                        } else {
                            htmltag = '<div class="form-group">' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                                '</div>';
                        }
                    }

                    uiku += '<div class="row" style="margin-bottom:0.5em;">' +
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
                $("#isi_setting_module").html(uiku);
                $("#mdl_setting_module_active").modal('show');
            }

        },
        error: function (result) {
            console.log(result);
            ui.popup.show('warning', 'Bad Connection, Try again later', 'Warning');
        }
    });
}

function get_module_all() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_all_module_list',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success === false) {
                $("#nodata_module_all").show();
                $("#show_module_all").hide();
            } else {
                var isiui = '';
                var nomer = 0;
                $.each(result, function (i, item) {
                    var noimg = '/img/fitur.png';
                    nomer++;
                    var logo = server_cdn + item.logo;
                    if (item.status == true) {
                        isiui +=
                            '<div class="col-md-4 stretch-card ' +
                            'grid-margin card-member' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                            'style="padding: 0.3rem 0.5rem;"' +
                            'onclick="detail_module_all(\'' + item.feature_id + '\')">Ready</button>' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                            '<div class="row">' +
                            '<div class="col-md-12">' +
                            '<small class="cteal">' + item.feature_type_title + '</small>' +
                            '<h4>' + item.title + '</h4>' +
                            '</div>' +
                            '<div class="col-md-12" style="text-align: right;">' +
                            '<button type="button" class="a_setmodule" style="border: none; background: #ffffff00;"' +
                            'onclick="get_list_setting_module(' + item.feature_id + ')">' +
                            '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Setting' +
                            ' &nbsp;<i class="mdi mdi-circle" aria-hidden="true"></i>' +
                            '</small></button>' +
                            '</div>' +
                            '</div></div></div></div>';
                    } else {
                        isiui += '<div class="col-md-4 stretch-card ' +
                            'grid-margin card-member' +
                            'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                            '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                            '<div class="card-body member">' +
                            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                            '<img src="' + logo + '" class="rounded-circle img-fluid img-card" onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                            '<div class="row">' +
                            '<div class="col-md-7">' +
                            '<small class="cteal">' + item.feature_type_title + '</small>' +
                            '<h4>' + item.title + '</h4>' +
                            '</div>' +
                            '<div class="col-md-5" style="text-align: right;">' +
                            '<button class="btn btn-sm btn-ready-card"' +
                            'onclick="detail_module_all(\'' + item.feature_id + '\')">Active</button>' +
                            '</div>' +
                            '</div></div></div></div>';
                    }
                });
                $("#nodata_module_all").hide();
                $("#total_module").html(nomer + " Modules");
                $("#show_module_all").html(isiui);
            }

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Module List All");
        }
    });
}

function detail_module_all(idsubfitur) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_module_all',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "feature_id": idsubfitur,
            "_token": token
        },
        success: function (result) {
            var dt = result[0];
            console.log(dt);

            if (result.success == false) {
                ui.popup.show('warning', result.message, 'Warning');
            } else {
                //form aktivasi
                $("#id_modulefitur").val(dt.feature_id);
                $("#payment_time").val();
                $("#payment_method_id").val();

                $("#logo_fitur_module").attr("src", server_cdn + dt.logo);
                $("#module_name").html(dt.title);
                $("#module_name1").html(dt.title);
                $("#module_deskripsi").html(dt.description);
                $("#module_tipe").html(dt.feature_type_title);

                //status aktif
                var isistatus = '';
                if (dt.status == false) {
                    isistatus = '<label class="badge melengkung10px bg-abu cputih" ' +
                        'style="min-width:100px;"> Not Active</label >';
                    $("#btn_aktivasi_showhide").show();
                } else {
                    isistatus = '<label class="badge melengkung10px bg-ijo cputih" ' +
                        'style="min-width:100px;"> Active</label >';
                    $("#btn_aktivasi_showhide").hide();
                }
                $(".status_aktif").html(isistatus);

                //pricing
                $("#btn_aktivasi_showhide").val(dt.price_annual);
                if (dt.price_annual != 0) {
                    $("#harga_tahunan").html("Rp " + rupiah(dt.price_annual));
                    $("#text_tahunan").html(rupiah(dt.price_annual) + '&nbsp; <small class="clight"> / Year</small>');
                } else {
                    $("#harga_tahunan").html('<center class="tebal cgrey">Free');
                }

                if (dt.price_monthly != 0) {
                    $("#harga_bulanan").html("Rp " + rupiah(dt.price_monthly));
                    $("#text_bulanan").html(rupiah(dt.price_monthly) + '&nbsp; <small class="clight"> / Month</small>');
                } else {
                    $("#harga_bulanan").html('<center class="tebal cgrey">Free');
                }

                if (dt.grand_pricing != 0) {
                    $("#harga_grand").html("Rp " + rupiah(dt.grand_pricing));
                    $("#text_sekali").html(rupiah(dt.grand_pricing) + '&nbsp; <small class="clight"> / Once</small>');
                } else {
                    $("#harga_grand").html('<center class="tebal cgrey">Free');
                }

                if (dt.subfeature == 0) {
                    $("#nosubfitur").show();
                } else {
                    $("#nosubfitur").hide();
                }
                var subf = '';
                var jum = 0;
                $.each(dt.subfeature, function (i, item) {
                    // console.log(item);
                    var colum;
                    jum++;

                    subf += '<div class="col-md-6 stretch-card grid-margin" style="height:85px; padding-left: 5px; padding-bottom:10px;"' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                        'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                        '<div class="card bg-gradient-blue card-img-holder text-white">' +
                        '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                        'alt="circle-image" /> ' +
                        '<div class="row">' +
                        '<div class="col-md-3" style="padding-right:4px;">' +
                        '<img src="' + server_cdn + item.logo + '" class="rounded-circle img-fluid img-card3"' +
                        'onerror = "this.onerror=null;this.src=\' /img/fitur.png \';">' +
                        '</div>' +
                        '<div class="col-md-9" style="padding-left:5px;">' +
                        '<b><small>' + item.title + '</small></b>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });
                $(".show_subfitur_module").html(subf);
                $("#md_all_aktifkan_module").modal("show");

            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function get_payment_module() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $("#btn_submit_paymethod").attr("disabled", "disabled");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_payment_module',
        type: 'POST',
        dataSrc: '',
        data: {
            "_token": token
        },
        timeout: 30000,
        success: function (result) {
            console.log(result);

            var text = '';
            var isibank = '';

            var noimg = '/img/fitur.png';

            $.each(result, function (i, item) {
                text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value=""' +
                    'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';
                var deskrip = '';
                $.each(item.payment_methods, function (i, itm) {
                    $.each(itm.description, function (x, isides) {
                        deskrip += '<li sytle="background-color:#fff;">' + isides + '</li>';
                    });
                    isibank +=
                        '<div class="card border-oren hidendulu method' + item.id + '" id="cardpay' + itm.id + '">' +
                        '<div class="card-header" role="tab" sytle="background-color:#fff;">' +
                        '<h6 class="mb-0 pdb1">' +
                        '<a data-toggle="collapse" data-parent="#isi_show_bank" href="#collapseOne' + itm.id + '" ' +
                        'id="idpayq' + itm.id + '" onclick="pilihpay(' + itm.id + ');" aria-expanded="true"' +
                        'aria-controls="collapseOne' + itm.id + '">' +
                        '<img src="' + server_cdn + itm.icon + '" class="imgepay" style="width: 10%; height: auto;"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + itm.payment_title +
                        '<span class="float-right">' +
                        '<i class="fa fa-chevron-right"></i>' +
                        '</span>' +
                        '</a></h6></div>' +
                        '<div id="collapseOne' + itm.id + '" class="collapse" role="tabpanel">' +
                        '<div class="card-block"><ul>' + deskrip +
                        '</ul></div></div></div>';
                });
            });
            $("#isi_method_pay").html(text);
            $("#isi_show_bank").html(isibank);

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}

function cek_pay_module(hrg) {
    if (hrg.value != 0) {
        $("#modal_pay_module").modal('show');
    } else {
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/aktifasi_module_admincomm',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "id_modulefitur": $("#id_modulefitur").val(),
                "payment_time_module": "0",
                "id_pay_method_module": "0",
                "_token": token
            },
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
                    swal("Activated Free Module!", "Successfully Add Module Feature", "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });

    }
}

function func_pay_module(params) {
    function pilih_pay_bank(ini) {
        $("#btn_submit_paymethod").attr("disabled", "disabled");
        $(".hidendulu").removeClass('dipilih');
        $('.btn-blueline').removeClass('active');
        $("#" + ini.id).addClass('active');
        $("." + ini.id).addClass('dipilih');
        $("." + ini.id).removeClass('active');
    }


    function pilihpay(idpay) {
        $("#id_pay_method_module").val(idpay);
        $(".border-oren").removeClass("active");
        $("#cardpay" + idpay).addClass("active");
        $("#btn_pay_next").removeAttr("disabled");
        $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
    }


    $('#payment_time_module').change(function () {
        var dipilih = this.value;
        if (dipilih == 1) {
            $("#text_sekali").show();
            $("#text_bulanan").hide();
            $("#text_tahunan").hide();
        } else if (dipilih == 2) {
            $("#text_sekali").hide();
            $("#text_bulanan").show();
            $("#text_tahunan").hide();
        } else {
            $("#text_sekali").hide();
            $("#text_bulanan").hide();
            $("#text_tahunan").show();
        }
    });
}
// --------------------- END MODULE MANAGEMENT -------------------



// --------------------- USER TYPE MANAGEMENT ----------------------
function cek_error_usertype() {
    var err_add = $("#error_priv").val();
    if (err_add != "" && err_add != undefined) {
        swal("Cant Null !", "Please Fill and Check All Fields", "error").then((value) => {
            $("#modal_add_usertype").modal('show');
        });
    }

    var err_edit = $("#error_priv2").val();
    if (err_edit != "" && err_edit != undefined) {
        swal("Cant Null !", "Please Fill and Check All Fields", "error").then((value) => {
            $("#modal_edit_usertype").modal('show');
        });
    }
}

function tabel_usertype_management_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_usertype_manage_admin').dataTable().fnClearTable();
    $('#tabel_usertype_manage_admin').dataTable().fnDestroy();
    var tabel = $('#tabel_usertype_manage_admin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_usertype_admin',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_usertype_manage_admin tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-50'>" + data + "</div>";
                },
            },
            { mData: 'title' },
            {
                mData: 'description',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-400'>" + data + "</div>";
                },
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
    $('#tabel_usertype_manage_admin tbody').on('click', 'button', function () {
        var data = tabel.row($(this).parents('tr')).data();
        // console.log(data);
        $("#modal_edit_usertype").modal("show");
        $("#idfitur_usertype").val(data.id);
        $("#nama_usertipe_edit").val(data.title);
        $("#dekripsi_usertipe_edit").text(data.description);
        var subfitur = data.subfeature;
        var arr = [];
        $.each(subfitur, function (i, item) {
            console.log(item);
            $('#edit_fitur_id' + item.feature_id).prop('checked', true);
            $('#edit_subfitur_' + item.subfeature_id).prop('checked', true);
        });
    });
}


function get_listfitur_usertype_ceklist() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend(jxqhr) {
            $(".loading_tree").show();
            $(".btnsubmit").attr("disabled", "disabled");
        },
        complete: function complete() {
            $(".btnsubmit").removeAttr("disabled", "disabled");
        }
    });
    $.ajax({
        url: '/admin/get_listfitur_usertype_ceklist',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            $(".btnsubmit").removeAttr("disabled", "disabled");
            $(".loading_tree").hide();

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
                var parent_ui = '';
                $.each(result, function (i, item) {
                    // console.log(item);
                    var child_ui = '';
                    var parent = item.title;
                    var jum = 0;
                    var idfitur = '';
                    $.each(item.sub_features, function (i, item) {
                        // console.log(item);
                        idfitur = item.feature_id;
                        child_ui += '<li class="">' +
                            '<input type="checkbox" name="subfitur[]"' +
                            'id="subfitur_' + item.subfeature_id + '"' +
                            'value="' + item.subfeature_id + '">' +
                            '<label>' + item.sub_feature_title + '</label>' +
                            '</li>';
                        jum++;
                    });

                    if (jum == 0) {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]" value="0" onclick="cek_nofitur(' + item.feature_id + ')" id="id_' + item.feature_id + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {
                        parent_ui += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="fitur_id[]"  value="' + idfitur + '">' +
                            '<label>' + parent + ' &nbsp;' +
                            '<small class="total"> &nbsp; (' + jum + ') </small>' +
                            '<i class="mdi mdi-chevron-down clight"></i>' +
                            '</label>' +
                            '<ul>' + child_ui + '</ul>' +
                            '</li>' +
                            '</ul>';
                    }
                });
                $(".isi_cek_priviledge").html(parent_ui);
                // __________________________________
                var parent_ui2 = '';
                $.each(result, function (i, item) {
                    var child_ui2 = '';
                    var parent2 = item.title;
                    var jum2 = 0;
                    var idfitur_edit = '';

                    $.each(item.sub_features, function (i, item) {
                        idfitur_edit = item.feature_id;
                        child_ui2 += '<li class="">' +
                            '<input type="checkbox" name="edit_subfitur[]"' +
                            'id="edit_subfitur_' + item.subfeature_id + '"' +
                            'value="' + item.subfeature_id + '"> ' +
                            '<label>' + item.sub_feature_title + '</label>' +
                            '</li>';
                        jum2++;
                    });

                    if (jum2 == 0) {
                        var idno = 111 + item.feature_id;
                        parent_ui2 += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="edit_fitur_id[]" value="0" onclick="cek_nofitur(' + idno + ')" id="id_' + idno + '">' +
                            '<label>' + parent2 + ' &nbsp;' +
                            '</label>' +
                            '</li>' +
                            '</ul>';
                    } else {

                        parent_ui2 += '<ul class="tree">' +
                            '<li class="has">' +
                            '<input type="checkbox" name="edit_fitur_id[]" value="' + idfitur_edit + '" id="edit_fitur_id' + idfitur_edit + '">' +
                            '<label>' + parent2 + ' &nbsp;' +
                            '<small class="total"> &nbsp; (' + jum2 + ') </small>' +
                            '<i class="mdi mdi-chevron-down clight"></i>' +
                            '</label>' +
                            '<ul>' + child_ui2 + '</ul>' +
                            '</li>' +
                            '</ul>';
                    }
                });
                $(".isi_cek_priviledge_edit").html(parent_ui2);
            }
        },
        error: function (result) {
            // console.log(result);
            $(".loading_tree").hide();
            $(".btnsubmit").attr("disabled", "disabled");
            ui.popup.show('warning', 'Cant get any response', 'Timeout');
        }
    });
}

function cek_nofitur(idf) {
    var checkid = $('#id_' + idf);
    checkid.prop("checked", false);
    checkid.attr("disabled", "disabled");
    ui.popup.show('error', 'Cant Choose this feature', 'No Access');
}

$(document).on('click', 'button', function (e) {
    switch ($(this).text()) {
        case 'Collepsed':
            $('.tree ul').fadeOut();
            break;
        case 'Expanded':
            $('.tree ul').fadeIn();
            break;
        case 'Checked All':
            $(".tree input[type='checkbox']").prop('checked', true);
            break;
        case 'Unchek All':
            $(".tree input[type='checkbox']").prop('checked', false);
            break;
        default:
    }
});
// ------------------- END USER TYPE MANAGEMENT ----------------------




// ---------------------  TRANSACTION MANAGEMENT ------------------------
function resetparam_trans() {
    $("#komunitas").val("");
    $("#tanggal_mulai").val("");
    $("#tanggal_selesai").val("");
    $("#tipe_trans").val("");
    $("#status_trans").val("");
    $("#subs_name").val("");
}


function get_list_transaction_tipe() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: "/admin/get_list_transaction_tipe",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#tipe_trans').empty();
            $('#tipe_trans').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#tipe_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            //Short Function Ascending//
            $("#tipe_trans").html($('#tipe_trans option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#tipe_trans").get(0).selectedIndex = 0;

            const OldTipetrans = "{{old('tipe_trans')}}";

            if (OldTipetrans !== '') {
                $('#tipe_trans').val(OldTipetrans);
            }
            // ___________________________________________________________________
            $('#tipe_trans2').empty();
            $('#tipe_trans2').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#tipe_trans2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            //Short Function Ascending//
            $("#tipe_trans2").html($('#tipe_trans2 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#tipe_trans2").get(0).selectedIndex = 0;

            const OldTipetrans2 = "{{old('tipe_trans2')}}";

            if (OldTipetrans2 !== '') {
                $('#tipe_trans2').val(OldTipetrans2);
            }
        }
    });
}


function get_list_subscriber_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_subcriber_name",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            $('#subs_name').empty();
            $('#subs_name').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#subs_name').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
            }
            $("#subs_name").html($('#subs_name option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#subs_name").get(0).selectedIndex = 0; const
                OldSubs1 = "{{old('subs_name')}}";
            if (OldSubs1 !== '') {
                $('#subs_name').val(OldSubs1);
            }
            // _______________________________________________________________________________
            $('#subs_name2').empty();
            $('#subs_name2').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#subs_name2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
            }
            //Short Function Ascending//
            $("#subs_name2").html($('#subs_name2 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#subs_name2").get(0).selectedIndex = 0; const
                OldSubs2 = "{{old('subs_name2')}}";
            if (OldSubs2 !== '') { $('#subs_name2').val(OldSubs2); }

        },
        error: function (result) {
            ui.popup.show('Warning', 'Get list community', 'Warning');
        }
    });
}


function show_tabel_transaksi() {
    $('#tabel_trans').dataTable().fnClearTable();
    $('#tabel_trans').dataTable().fnDestroy();

    $(".showin_table_trans").show();
    $("#tab_transaction_param").hide();

    var token = $('meta[name="csrf-token"]').attr('content');

    var tabel = $('#tabel_trans').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_transaksi_show',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "komunitas": $("#komunitas").val(),
                "tanggal_mulai": $("#tanggal_mulai").val(),
                "tanggal_selesai": $("#tanggal_selesai").val(),
                "tipe_trans": $("#tipe_trans").val(),
                "status_trans": $("#status_trans").val(),
                "subs_name": $("#subs_name").val(),
                "_token": token,
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_trans tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            ui.popup.show('error', status, 'Error');
        },
        columns: [
            { mData: 'invoice_number' },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            { mData: 'name' },
            { mData: 'transaction_type' },
            { mData: 'status_title' },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var dt = [row.invoice_number, row.payment_level, row.community_id];
                    // console.log(data);
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_transaksi_all(\'' + dt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });
}


$("#btn_filter_transaksi").click(function (e) {
    resetparam_trans();
    $('#tabel_trans').dataTable().fnClearTable();
    $('#tabel_trans').dataTable().fnDestroy();

    $(".showin_table_trans").show();
    $("#tab_transaction_param").hide();

    $("#modal_trasaksi_filter").modal("hide");

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_trans').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        ajax: {
            url: '/admin/tabel_transaksi_show',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "komunitas": $("#komunitas2").val(),
                "tanggal_mulai": $("#tanggal_mulai2").val(),
                "tanggal_selesai": $("#tanggal_selesai2").val(),
                "tipe_trans": $("#tipe_trans2").val(),
                "status_trans": $("#status_trans2").val(),
                "subs_name": $("#subs_name2").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                // $('#tabel_subscriber tbody').;
                $('#tabel_trans tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'invoice_number' },
            { mData: 'created_at' },
            { mData: 'name' },
            { mData: 'transaction_type' },
            { mData: 'status_title' },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var dt = [row.invoice_number, row.payment_level, row.community_id];
                    // console.log(data);
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_transaksi_all(\'' + dt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });
});

function detail_transaksi_all(dt_trans) {
    var trans = dt_trans.split(',');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: '/admin/detail_transaksi_superadmin',
        type: 'POST',
        datatype: 'JSON',
        timeout: 20000,
        data: {
            "invoice_number": trans[0],
            "payment_level": trans[1],
            "community_id": trans[2],
            "_token": token,
        },
        success: function (result) {
            if (result.success == false) {
                ui.popup.show('error', result.message, 'Error');
                $("#modal_detail_trans").modal('hide');
            } else {

                $("#modal_detail_trans").modal('show');
                console.log(result);
                $("#invoice_trans").html(result.invoice_number);
                $("#date_trans").html(dateTime(result.created_at));
                $("#komunitas_trans").html(result.community_name);
                $("#subscriber_trans").html(result.name);
                $("#level_title_trans").html(result.level_title);
                $("#nominal_trans").html(rupiah(result.grand_total));
                $("#jenis_trans").html(result.transaction_type);
                $("#statusjudul_trans").html(result.status_title);
                $("#transaksi_trans").html(result.transaction);

                var uiku = '';
                if (result.data_confirmation.file != "") {
                    $("#img_pay_confirm").attr("src", server_cdn + result.data_confirmation.file);
                    $("#nama_confirm_trans").html(result.data_confirmation.created_by);
                    $("#date_confirm_trans").html(result.data_confirmation.created_at);

                    if (result.data_confirmation.created_at != "") {
                        // uiku = '<button type="button" class="btn btn-tosca' +
                        //     'melengkung10px btn-sm"> Paid</button >';
                        uiku = '<label class="badge bg-tosca cwhite melengkung6px sttrans">Paid</label>';
                        $("#status_color").html(uiku);
                    } else {
                        $("#img_pay_confirm").attr("src", "");
                        // uiku = '<button type="button" class="btn btn-abu' +
                        //     'melengkung10px btn-sm"> Not Yet</button >';
                        uiku = '<label class="badge bg-abu cwhite melengkung6px sttrans">Not Yet</label>';
                        $("#status_color").html(uiku);
                    }
                }


                if (result.data_verification.file != "") {
                    $("#img_pay_aprov").attr("src", server_cdn + result.data_verification.file);
                    $("#name_approv_trans").html(result.data_verification.verification_by);
                    $("#date_approv_trans").html(result.data_verification.verification_at);
                }


                // var doc = new jsPDF();
                // var specialElementHandlers = {
                //     '#div_ignore': function (element, renderer) {
                //         return true;
                //     }
                // };

                // $("#btn_download_detail").click(function () {
                //     doc.fromHTML($('#for_download').html(), 15, 15, {
                //         'width': 190,
                //         'elementHandlers': specialElementHandlers
                //     });
                //     doc.save('detail transaction.pdf');
                // });
                // $("#").html(result.);
                // $("#").html(result.);
                // $("#").html(result.);
            }

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Detail");
        }
    });
}

// --------------------- END  TRANSACTION MANAGEMENT ------------------------




// ---------------------- REPORT MANAGEMENT ADMIN ----------------------------

$("#btn_generate_trans").click(function () {
    tabel_report_transaksi_admin();
});


$("#reset_tbl_trans").click(function () {
    $("#tanggal_mulai2").val("");
    $("#tanggal_selesai2").val("");
    $("#jenis_transaksi3").val("");
    $("#status_transaksi2").val("");
    $("#min_trans2").val("");
    $("#max_trans2").val("");
});


$("#btn_showtable_report").click(function () {
    $('#tabel_transaksi_report').dataTable().fnClearTable();
    $('#tabel_transaksi_report').dataTable().fnDestroy();

    $("#modal_generate_transaksi").modal('hide');
    $("#tabel_transaksi_report").show();
    $("#btn_generate_filter").show();
    $("#tab_transaction_param").hide();

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_transaksi_report').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_report_transaksi_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "transaction_type_id": $("#jenis_transaksi3").val(),
                "transaction_status": $("#status_transaksi2").val(),
                "min_transaction": $("#min_trans2").val(),
                "max_transaction": $("#max_trans2").val(),
                "_token": token

            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_transaksi_report tbody').empty().append(nofound);
            },
        },
        success: function (result) {
            console.log(result);
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_transaksi_report tbody').empty().append(nofound);

        },
        columns: [
            { mData: 'invoice_number' },
            {
                mData: 'transaction_date',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'transaction_status',
                render: function (data, type, row, meta) {
                    var ini = '';
                    if (data == 1) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Pending</small>';
                    } else if (data == 2) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Approved</small>';
                    } else {
                        ini = '<small class="badge bg-merah melengkung10px clight">Cancel</small>';
                    }
                    return ini;
                }
            },
            { mData: 'transaction_type' },
            { mData: 'name' },
            {
                mData: 'nominal',
                render: function (data, type, row, meta) {
                    var rp = 'Rp. ' + rupiah(data);
                    return rp;
                }
            },
            { mData: 'payment_type' },
            { mData: 'payment_method' },
        ],

    });

});

$("#btn_generate_reconcile").click(function () {
    var tglq = $("#tahun_concile").val();
    var tgl = tglq.split('-');
    var bulan = tgl[1];
    var tahun = tgl[0];
    tabel_report_concile_super(bulan, tahun);
});



function tabel_report_concile_super(bulan, tahun) {
    $('#tabel_concile_report').dataTable().fnClearTable();
    $('#tabel_concile_report').dataTable().fnDestroy();

    $("#modal_reconcile_transaksi").modal('hide');
    $("#tabel_concile_report").show();

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_concile_report').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_concile_report_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "transaction_type_id": $("#jenis_transaksi2").val(),
                "community_id": $("#komuniti_trans2").val(),
                "month": bulan,
                "year": tahun,
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_concile_report tbody').empty().append(nofound);
            },
        },
        success: function (result) {
            console.log(result);
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_concile_report tbody').empty().append(nofound);

        },
        columns: [
            { mData: 'invoice_number' },
            { mData: 'transaction_date' },
            {
                mData: 'transaction_status',
                render: function (data, type, row, meta) {
                    var ini = '';
                    if (data == 1) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Pending</small>';
                    } else if (data == 2) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Approved</small>';
                    } else {
                        ini = '<small class="badge bg-merah melengkung10px cgrey">Cancel</small>';
                    }
                    return ini;
                }
            },
            { mData: 'transaction_type' },
            { mData: 'name' },
            {
                mData: 'nominal',
                render: function (data, type, row, meta) {
                    var rp = 'Rp. ' + rupiah(data);
                    return rp;
                }
            }

        ],

    });
}


function tabel_report_transaksi_admin() {
    $('#tabel_transaksi_report').dataTable().fnClearTable();
    $('#tabel_transaksi_report').dataTable().fnDestroy();

    $("#modal_generate_transaksi").modal('hide');
    $("#tabel_transaksi_report").show();

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_transaksi_report').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_report_transaksi_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "start_date": $("#tanggal_mulai").val(),
                "end_date": $("#tanggal_selesai").val(),
                "transaction_type_id": $("#jenis_transaksi").val(),
                "transaction_status": $("#status_transaksi").val(),
                "min_transaction": $("#min_trans").val(),
                "max_transaction": $("#max_trans").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_transaksi_report tbody').empty().append(nofound);
            },
        },
        success: function (result) {
            console.log(result);
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_transaksi_report tbody').empty().append(nofound);

        },
        columns: [
            { mData: 'invoice_number' },
            {
                mData: 'transaction_date',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'transaction_status',
                render: function (data, type, row, meta) {
                    var ini = '';
                    if (data == 1) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Pending</small>';
                    } else if (data == 2) {
                        ini = '<small class="badge bg-abu melengkung10px cwhite">Approved</small>';
                    } else {
                        ini = '<small class="badge bg-merah melengkung10px clight">Cancel</small>';
                    }
                    return ini;
                }
            },
            { mData: 'transaction_type' },
            { mData: 'name' },
            {
                mData: 'nominal',
                render: function (data, type, row, meta) {
                    var rp = 'Rp. ' + rupiah(data);
                    return rp;
                }
            },
            { mData: 'payment_type' },
            { mData: 'payment_method' },
        ],

    });

}


function get_list_transaction_type_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_transaction_type_admin",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#jenis_transaksi').empty();
            $('#jenis_transaksi').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#jenis_transaksi').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            $("#jenis_transaksi").html($('#jenis_transaksi option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#jenis_transaksi").get(0).selectedIndex = 0;
            // ______________________________________________________________
            $('#jenis_transaksi2').empty();
            $('#jenis_transaksi2').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#jenis_transaksi2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            $("#jenis_transaksi2").html($('#jenis_transaksi2 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#jenis_transaksi2").get(0).selectedIndex = 0;
            // ______________________________________________________________
            $('#jenis_transaksi3').empty();
            $('#jenis_transaksi3').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#jenis_transaksi3').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            $("#jenis_transaksi3").html($('#jenis_transaksi3 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#jenis_transaksi3").get(0).selectedIndex = 0;

        }
    });
}


function get_list_subscriber_report() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_subscriber_report",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#list_pengikut').empty();
            $('#list_pengikut').append('<option value=""> Choose</option>');

            for (var i = result.length - 1; i >= 0; i--) {
                $('#list_pengikut').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
            }
            //Short Function Ascending//
            $("#list_pengikut").html($('#list_pengikut option').sort(function (x, y) {
                return $(x).val() < $(y).val() ? -1 : 1;
            }));

            $("#list_pengikut").get(0).selectedIndex = 0;


        }
    });
}


$("#btn_generate_subscriber").click(function () {
    tabel_report_subscriber_admin();
});


function tabel_report_subscriber_admin() {
    $('#tabel_subscriber_report').dataTable().fnClearTable();
    $('#tabel_subscriber_report').dataTable().fnDestroy();

    $("#modal_subscriber_report").modal('hide');
    $("#tabel_subscriber_report").show();

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_subscriber_report').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print', {
                text: 'JSON',
                action: function (e, dt, button, config) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob([JSON.stringify(data)]),
                        'Export.json'
                    );
                }
            }
        ],
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_report_subscriber_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "start_date": $("#tanggal_mulai_subs").val(),
                "end_date": $("#tanggal_selesai_subs").val(),
                "subscriber_id": $("#list_pengikut").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_subscriber_report tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_subscriber_report tbody').empty().append(nofound);

        },
        columns: [
            {
                mData: 'user_id',
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-250'>" + data + "</div>";
                },
            },
            { mData: 'name' },
            {
                mData: 'activity',
                render: function (data, type, row, meta) {
                    console.log(data[0]);
                    var result = data[0];



                    var isshow = '';
                    var isshow2 = '';
                    $.each(result, function (i, isi) {
                        var tgl = dateFormatReport(isi.date);
                        isshow2 += '<li>' + isi.module + '&nbsp; <span class="cgrey">|</span> &nbsp; <small class="cteal2">' + tgl + '</small>' +
                            '<br>' +
                            '<label class="cgrey2">' + isi.endpoint + '</label>' +
                            '</li>';

                        isshow += '<div class="card"> ' +
                            '<div class="card-header" id="heading' + i + '" >' +
                            '<h2 class="mb-0">' +
                            '<button class="btn btn-link" type="button" data-toggle="collapse"' +
                            'data-target="#collapse' + i + '" aria-expanded="true"' +
                            'aria-controls="collapse' + i + '">' +
                            '<i class="mdi mdi-chevron-down"></i> &nbsp;' +
                            '<span class="cgrey s16">' + isi.module + '</span> &nbsp;<span' +
                            'class="cteal">' + tgl + '</span>' +
                            '</button>' +
                            '</h2>' +
                            '</div >' +
                            '<div id="collapse' + i + '" class="collapse" aria-labelledby="heading' + i + '"' +
                            'data-parent="#accordion_reportsubs">' +
                            '<div class="card-body s14 clight">' +
                            '<div class="row" style="margin-left: 0.5em;">' +
                            '<div class="col-12">' +
                            'ID : <div class="mb-1 cgrey2"> ' + isi._id + '</div>' +
                            'Date : <div class="mb-1 cgrey2">' + tgl + '</div>' +
                            'Endpoint : <div class="mb-1 cgrey2">' + isi.endpoint + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div > ';

                    });
                    var layot = '<div class="text-wrap width-500"><div class="accordion" id="accordion_reportsubs">' + isshow + '</div></div>';
                    return layot;
                }
            },
        ],

    });

}

function dateFormatReport(tgl) {
    var d = new Date(tgl);

    dformat = [d.getDate(), d.getMonth() + 1,
    d.getFullYear()].join('/') + ' &nbsp;  ' +
        [d.getHours(),
        d.getMinutes(),
        d.getSeconds()].join(':');

    return dformat;
}
// ---------------------- END REPORT MANAGEMENT -------------------------------


// ----------------------  PAYMENT MANAGEMENT ------------------------------
function tabel_payment_all_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_payment_all_admin').dataTable().fnClearTable();
    $('#tabel_payment_all_admin').dataTable().fnDestroy();

    var tabel = $('#tabel_payment_all_admin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_payment_all_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_all_admin tbody').empty().append(nofound);
                ui.popup.show('error', "Internal Server Error", 'Error');
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_payment_all_admin tbody').empty().append(nofound);

        },
        columns: [
            { mData: 'id' },
            { mData: 'payment_title' },
            {
                mData: 'description', width: 100,
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-450'>" + data + "</div>";
                },
                targets: 3
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var dt = data + "<>" + row.level_status + "<>" + row.status;
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_payment_all_admin(\'' + dt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
    });

}

function tabel_payment_active_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_payment_active_admin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_payment_active_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_payment_active_admin tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_payment_active_admin tbody').empty().append(nofound);

        },
        columns: [
            { mData: 'id' },
            { mData: 'payment_title' },
            {
                mData: 'description', width: 100,
                render: function (data, type, row, meta) {
                    return "<div class='text-wrap width-450'>" + data + "</div>";
                },
                targets: 3
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var dtaktif = data + "<>" + row.level_status + "<>" + row.status;
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_payment_all_admin(\'' + dtaktif + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
    });

}

function detail_payment_all_admin(dtpay) {
    var split = dtpay.split('<>');
    $("#aktif_id_payment").val(split[0]);
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_payment_all_admin',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "payment_id": split[0],
            "level_status": split[1],
            "status": split[2],
            "_token": token
        },
        success: function (result) {
            console.log(split);
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
                var res = result[0];
                if (res.status === false) {
                    $("#hide_btn_aktivasi").show();
                } else {
                    $("#hide_btn_aktivasi").hide();

                }

                if (res.payment_title != null) {
                    $("#detail_judul").html(res.payment_title);
                }
                if (res.description != null) {
                    $("#detail_deskripsi").html(res.description);
                }

                if (res.price_monthly != null) {
                    $("#detail_pricebulan").html("Rp " + rupiah(res.price_monthly));
                    $("#detail_pricetahun").html("Rp " + rupiah(res.price_annual));
                    $("#detail_minbulan").html(res.minimum_monthly_subscription);
                    $("#detail_mintahun").html(res.minimum_annual_subscription);
                    $(".hideku").fadeIn("fast");
                } else {
                    $(".hideku").fadeOut("fast");
                }

                if (res.payment_methods != "") {
                    var jsnDt = res.payment_methods;

                    $('#tabel_sub_payment_super').DataTable().clear();
                    $('#tabel_sub_payment_super').DataTable().destroy();
                    $('#tabel_sub_payment_super tbody').empty();
                    // $("#notabel").hide();
                    $('#tabel_sub_payment_super').show();

                    var tabelku = $('#tabel_sub_payment_super').DataTable({
                        responsive: true,
                        emptyTable: "No Data Available",
                        language: {
                            paginate: {
                                next: '<i class="mdi mdi-chevron-right"></i>',
                                previous: '<i class="mdi mdi-chevron-left">'
                            }
                        },
                        data: jsnDt,
                        columns: [
                            { mData: 'id' },
                            { mData: 'payment_title' },
                            {
                                mData: 'icon',
                                render: function (data, type, row, meta) {
                                    var dtimg = server_cdn + cekimage_cdn(data);
                                    var noimg = '/img/fitur.png';
                                    return '<img src="' + dtimg + '" style="width:30px; height:30px;" id="imgsubpay_' + row + '" class="rounded-circle img-fluid zoom" onclick="clickImage(this)" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"">';
                                }
                            },
                            { mData: 'payment_bank_name' },
                            { mData: 'payment_owner_name' },
                            {
                                mData: 'status',
                                render: function (data, type, row, meta) {
                                    var isine = '';
                                    if (data == 0) {
                                        isine = '<small class="badge bg-abu melengkung10px cwhite">Deactive</small>';
                                    } else if (data == 1) {
                                        isine = '<small class="badge bg-biru melengkung10px cdarkgrey">Active</small>';
                                    } else if (data == 2) {
                                        isine = '<small class="badge bg-kuning melengkung10px cdarkgrey">Unpaid</small>';
                                    }
                                    return isine;
                                }
                            },
                            {
                                mData: 'id',
                                render: function (data, type, row, meta) {
                                    var dtaktif = data + "<>" + res.level_status + "<>" + res.status;
                                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                                        'onclick="detail_subpayment(\'' + dtaktif + '\')">' +
                                        '<i class="mdi mdi-eye"></i>' +
                                        '</button>';
                                }
                            }
                        ],
                    }); //end-datatable

                } else {
                    var nofound = '<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                    $('#tabel_sub_payment_super tbody').html(nofound);
                }
                $("#modal_detail_payment_all_admin").modal('show');
            }
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}

function detail_subpayment(subdata) {
    var split = subdata.split('<>');

    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_tabel_subpayment',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "subpayment_id": split[0],
            "level_status": split[1],
            "status": split[2],
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            var isi = result[0];
            $("#aktif_id_subpayment").val(isi.id);

            var statusui = '';
            if (isi.status == 0) {
                statusui = '<small class="badge bg-abu melengkung10px cwhite" style="width :100px">Deactive</small>';
            } else {
                statusui = '<small class="badge bg-biru melengkung10px cdarkgrey" style="width :100px">Active</small>';
            }
            $("#subpay_status").html(statusui);

            if (isi.icon != null) {
                var icn = isi.icon;
                var cekimg = icn.slice(0, 1);

                if (cekimg == "/") {
                    var isiimg = icn.slice(1);
                } else {
                    var isiimg = isi.icon;
                }
                imglogo = server_cdn + cekimage_cdn(isiimg);
                $('#img_subpay').attr('src', imglogo);
            }

            $("#detail_nama_pay").html(isi.payment_title);
            $("#detail_time_limit").html(isi.payment_time_limit + "  Day");

            var uiku2 = '';
            $.each(isi.description, function (i, item) {
                uiku2 += '<li style="background-color: #ffffff !important;">' + item + '</li>';
            });
            $("#detail_deskripsi_pay").html(uiku2);

            $("#detail_bank_pay").html(isi.payment_bank_name);
            $("#detail_rekening").html(isi.payment_account);
            $("#detail_bankname").html(isi.payment_owner_name);

            if (isi.level_status != 2) {
                $(".isi_setting_subpay").html('<center><br><br><br><h4 class="clight" lang="en">Please activate this payment to start setting</h4></center');
            } else {
                get_setting_subpayment_admin(isi.id);
            }

            $("#modal_detail_payment_all_admin").modal("hide");
            $("#modal_detail_subpayment_super").modal("show");
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });

}

function get_setting_subpayment_admin(idnya) {
    $(".isi_setting_subpay").html("");
    $(".set_id_paymethod").val(idnya);

    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_setting_subpayment_admin',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "payment_method_id": idnya,
            "_token": token
        },
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    if (result.message === "Data Tidak ditemukan" || result.code === "PLQ97") {
                        $("#nosetting_pay").show();
                        $(".isi_setting_subpay").hide();
                        $("#btn_submit_setpay").hide();
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                }
            } else {
                var uiku = '';
                $.each(result, function (i, item) {
                    var htmltag = '';
                    if (item.setting_type == 1) {
                        var tipe = 'Input Text';
                        htmltag = '<input type="text" name="input_' + item.id + '" id="input_' + item.id + '" value="' + item.value + '"' +
                            'class="form-control input-abu param_setting">';
                    } else {
                        var tipe = 'Radio Button';
                        if (item.value == "true") {
                            htmltag = '<div class="form-group">' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true" checked> True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false"> False <i class="input-helper"></i></label>' +
                                '</div>';
                        } else {
                            htmltag = '<div class="form-group">' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-input" name="radio_pilih" id="true_' + item.id + '" value="true"> True <i class="input-helper"></i></label>' +
                                '</div>' +
                                '<div class="form-check set_mod">' +
                                '<label class="form-check-label">' +
                                '<input type="radio" class="form-check-inpu" name="radio_pilih" id="false_' + item.id + '" value="false" checked> False <i class="input-helper"></i></label>' +
                                '</div>';
                        }
                    }

                    uiku += '<div class="row" style="margin-bottom:0.5em;">' +
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
                $("#nosetting_pay").hide();
                $("#btn_submit_setpay").show();
                $(".isi_setting_subpay").html(uiku);
            }
        },
        error: function (result) {
            console.log(result);
            console.log('data not found');
        }
    });
}

function get_payment_module() {
    // $("#btn_submit_paymethod").attr("disabled", "disabled");
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_payment_module',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "_token": token
        },
        success: function (result) {
            var text = '';
            var isibank = '';

            var noimg = '/img/fitur.png';

            $.each(result, function (i, item) {
                text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value=""' +
                    'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';
                var deskrip = '';
                $.each(item.payment_methods, function (i, itm) {
                    $.each(itm.description, function (x, isides) {
                        deskrip += '<li sytle="background-color:#fff;">' + isides + '</li>';
                    });
                    isibank +=
                        '<div class="card border-oren hidendulu method' + item.id + '" id="cardpay' + itm.id + '">' +
                        '<div class="card-header" role="tab" sytle="background-color:#fff;">' +
                        '<h6 class="mb-0 pdb1">' +
                        '<a data-toggle="collapse" data-parent="#isi_show_bank" href="#collapseOne' + itm.id + '" ' +
                        'id="idpayq' + itm.id + '" onclick="pilihpay(' + itm.id + ');" aria-expanded="true"' +
                        'aria-controls="collapseOne' + itm.id + '">' +
                        '<img src="' + server_cdn + cekimage_cdn(itm.icon) + '" class="imgepay" style="width: 10%; height: auto;"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + itm.payment_title +
                        '<span class="float-right">' +
                        '<i class="fa fa-chevron-right"></i>' +
                        '</span>' +
                        '</a></h6></div>' +
                        '<div id="collapseOne' + itm.id + '" class="collapse" role="tabpanel">' +
                        '<div class="card-block"><ul>' + deskrip +
                        '</ul></div></div></div>';
                });
            });
            $("#isi_method_pay").html(text);
            $("#isi_show_bank").html(isibank);

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}
// ---------------------- END PAYMENT MANAGEMENT ---------------------------



// ---------------------- NOTIFICATION MANAGEMENT ------------------------
function get_list_setting_notif_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/get_list_setting_notif_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/admin';
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning Setting Notification');
                }
            } else {
                var uiku = '';
                var inputipe = '';

                $.each(result, function (i, item) {

                    if (item.input_type == 1) {
                        inputipe = ' <input type="text" name="param' + item.id + '" value="' + item.value + '" class="form-control input-abu param_setting">';
                    } else if (item.input_type == 2) {
                        if (item.value == 1) {
                            var one = 'checked';
                            var two = '';
                        } else if (item.value == 2) {
                            var one = '';
                            var two = 'checked';
                        } else {
                            var one = '';
                            var two = '';
                        }
                        inputipe = '<div class="form-group">' +
                            '<div class="form-check" >' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiotrue' + item.id + '" value="1" ' + one + '>' +
                            'True <i class="input-helper"></i></label>' +
                            '</div>' +
                            '<div class="form-check">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiofalse' + item.id + '" value="2" ' + one + '>' +
                            'False <i class="input-helper"></i></label>' +
                            '</div>' +
                            '</div>';
                    }

                    uiku += '<div class="row">' +
                        '<div class="col-6">' +
                        '<div class="form-group">' +
                        '<small class="cgrey1 tebal name_setting">' + item.title + '</small>' +
                        '<p class="clight s13 deskripsi_setting">' + item.description +
                        '</p>' +
                        '</div>' +
                        '</div >' +
                        '<div class="col-6">' + inputipe +
                        '<input type="hidden" id="id_set' + item.id + '" name="id_set' + item.id + '" value="' + item.id + '">' +
                        '</div>' +
                        '</div>';
                });
                $(".isi_seting_notifadmin").html(uiku);
            }
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}


function cek_param_list_user() {
    var comm = $("#komunitas_notif").val();
    var usertipe = $("#usertipe_notif").val();
    if (comm === null && usertipe === null) {
        $("#status_notif").attr("disabled", "disabled");
        swal("Cant Null", "User Type and Community cant be null", "warning");
    } else {
        $("#status_notif").removeAttr("disabled", "disabled");
    }
}


function tabel_generate_notif_admin() {
    $('#tabel_generate_notif_admin').dataTable().fnClearTable();
    $('#tabel_generate_notif_admin').dataTable().fnDestroy();
    $('#tabel_generate_notif_admin').show();
    $('#modal_filter_notif_admin').modal('hide');

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_generate_notif_admin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_generate_notification_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas_notif").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#list_judul_notif").val(),
                "notification_sub_type": $("#tipe_notif").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_generate_notif_admin tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'id' },
            { mData: 'title' },
            { mData: 'notification_sub_type_title' },
            { mData: 'user_type_title' },
            { mData: 'community_name' },
            { mData: 'notification_status' },
            { mData: 'sender_level_title' },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var inidt = [data, row.level_status, row.community_id];
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_notif_admin(\'' + inidt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
    });

}


function detail_notif_admin(dtku) {
    var dtnya = dtku.split(',');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_generate_notif_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "notification_id": dtnya[0],
            "level_status": dtnya[1],
            "community_id": dtnya[2],
            "_token": token
        },
        success: function (result) {
            console.log(result);
            var res = result;
            $("#modal_detail_notif").modal('show');
            $("#detail_judul").html(res.title);
            $("#detail_dekripsi").html(res.description);
            $("#detail_komunitas").html(res.community_name);
            $("#detail_tanggal").html(dateFormat(res.created_at));
            $("#detail_user").html(res.user_title);
            $("#detail_usertipe").html(res.user_type_title);
            $("#detail_tipenotif").html(res.message_type_title);
            $("#dibuat_oleh").html(res.created_by_title);
            $("#status_notif_admin").html(res.status);
            $("#status_msg").html(res.status_message);


        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Detail");
        }
    });
}


function get_list_user_notif() {
    var itempilih = $('#komunitas_notif').val();
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_user_notif_super",
        type: "POST",
        dataType: "json",
        data: {
            "user_type": $("#usertipe_notif").val(),
            "community_id": itempilih,
            "_token": token
        },
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
                $('#user_notif').empty();
                $('#user_notif').append("<option disabled value='0'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#user_notif').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#user_notif").html($('#user_notif option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#user_notif").get(0).selectedIndex = 0; const
                    OldSubf = "{{old('user_notif')}}";
                if (OldSubf !== '') {
                    $('#user_notif').val(OldSubf);
                }
            }
        },
        error: function (result) {
            $('#hide_user_notif').fadeOut("fast");
            $('#user_notif').empty();
            $('#user_notif').append("<option disabled value='0'>No Related User</option>");
        }
    });
}
// ---------------------- END NOTIFICATION MANAGEMENT ------------------------




// -------------------- INBOX MANAGEMENT ----------------------
function tabel_inbox_message_admin() {
    $('#tabel_inbox_message_admin').dataTable().fnClearTable();
    $('#tabel_inbox_message_admin').dataTable().fnDestroy();
    $('#tabel_inbox_message_admin').show();
    $('#modal_generate_inbox_tabel').modal('hide');

    var tabel = $('#tabel_inbox_message_admin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_generate_inbox_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas_inbox").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#filter_judul").val(),
                "message_type": $("#tipe_pesan").val(),
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_inbox_message_admin tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'id' },
            { mData: 'title' },
            { mData: 'message_type_title' },
            { mData: 'user_type_title' },
            { mData: 'community_name' },
            { mData: 'status' },
            {
                mData: 'created_at',
                render: function (data) {
                    return (dateFormat(data));
                }
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    var inidt = [data, row.level_status, row.community_id, row.status];
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_message_inbox_admin(\'' + inidt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });

}


function get_list_subscriber() {
    var itempilih = $("#komunitas_inbox").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/get_list_subscriber_inbox_admin",
        type: "POST",
        dataType: "json",
        data: {
            "user_type": $("#usertipe_inbox1").val(),
            "community_id": itempilih,
        },
        success: function (result) {
            // console.log(result);

            $('#list_user').empty();
            $('#list_user').append("<option disabled value='0'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#list_user').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
            }
            //Short Function Ascending//
            $("#list_user").html($('#list_user option').sort(function (x, y) {
                return $(x).val() < $(y).val() ? -1 : 1;
            }));

            $("#list_user").get(0).selectedIndex = 0; const
                OldSubf = "{{old('list_user')}}";
            if (OldSubf !== '') {
                $('#list_user').val(OldSubf);
            }
        },
        error: function (result) {
            $('#list_user').empty();
            $('#list_user').append("<option disabled value='0'>No Related User</option>");
        }
    });

}


function detail_message_inbox_admin(params) {
    var dtnya = params.split(',');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/detail_generate_message_inbox_super_admin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "message_id": dtnya[0],
            "level_status": dtnya[1],
            "community_id": dtnya[2],
        },
        success: function (result) {
            // console.log(result);
            var res = result;
            $("#modal_detail_message_inbox").modal('show');
            $("#detail_judul ").html(res.title);
            $("#detail_dekripsi ").html(res.description);
            $("#detail_komunitas ").html(res.community_name);
            $("#detail_date ").html(res.created_at);
            $("#detail_user ").html(res.user_title);
            $("#detail_usertipe ").html(res.user_type_title);
            $("#detail_tipepesan ").html(res.message_type_title);
            $("#detail_by ").html(res.created_by_title);
            $("#detail_status ").html(res.status);
            $("#id_message_inbox").val(res.id);
            $("#detail_statuspesan ").html(res.status_message);
            $("#detail_senderlevel").html(res.sender_level_title);
            $("#id_inbox").val(res.id);
            $("#level_status").val(res.level_status);

            if (res.status == "Active" && res.status_message == "Send") {
                $("#status_tipe").val("1");
                $(".tipe1").show();
                $(".tipe2").hide();
                $('#list_status option[id="id1"]').attr("selected", true);

            } else if (res.status == "Not Publish" && res.status_message == "Send") {
                $("#status_tipe").val("1");
                $(".tipe1").show();
                $(".tipe2").hide();
                $('#list_status option[id="id2"]').attr("selected", true);
            } else if (res.show_status == "Ditampilkan" && res.status_message == "Receive") {
                $("#status_tipe").val("2");
                $(".tipe2").show();
                $(".tipe1").hide();
                $('#list_status option[id="id3"]').attr("selected", true);
            } else {
                $("#status_tipe").val("2");
                $(".tipe2").show();
                $(".tipe1").hide();
                $('#list_status option[id="id4"]').attr("selected", true);
            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}
// -------------------- END INBOX MANAGEMENT -------------------

// -----------------------  EVENT  MANAGEMENT ------------------------
function tabel_event_list_admin() {
    var token = $('meta[name="csrf-token"]').attr('content');

    var tabel = $('#tabel_event_management').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_event_list_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_event_management tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'id' },
            { mData: 'title' },
            {
                mData: 'image',
                render: function (data, type, row) {
                    var noimg = '/img/kosong.png';
                    return '<img src=' + server_cdn + cekimage_cdn(data) + ' id="imgtbl' + row.id + '" class="rounded-circle img-fluid mini zoom"  onclick="clickImage(this)" onerror="this.onerror=null;this.src=\'' + noimg + '\';">';
                }
            },
            { mData: 'event_date' },
            { mData: 'event_time' },
            { mData: 'status_title' },
            { mData: 'ticket_type_title' },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-edit">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-share"> ' +
                        '<i class="mdi mdi-link-variant"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-edit">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>' +
                        '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-share"> ' +
                        '<i class="mdi mdi-link-variant"></i>' +
                        '</button>',
                    "targets": -1
                }
            ],

    });

    //DETAIL
    $('#tabel_event_management tbody').on('click', 'button.btn-edit', function () {
        var data = tabel.row($(this).parents('tr')).data();
        console.log(data);
        $("#id_event_admin").val(data.id);
        $("#modal_edit_event").modal('show');

        $("#edit_judul").val(data.title);
        $("#edit_deskripsi").text(data.description);
        $("#edit_link").val(data.link);
        $("#edit_tgl").val(data.event_date);
        $("#edit_time").val(data.event_time);

        $('#edit_status').val(data.status).attr("selected", "selected");
        $('#edit_type').val(data.ticket_type).attr("selected", "selected");



    });

    $('#tabel_event_management tbody').on('click', 'button.btn-share', function () {
        var data = tabel.row($(this).parents('tr')).data();

        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/share_event_admin',
            type: 'POST',
            datatype: 'JSON',
            data: {
                "event_id": data.id,
                "_token": token
            },
            success: function (result) {
                // console.log(result);
                if (result.success != false) {
                    var pretext = "Ayo ikuti !!   " + data.title + " ,  tanggal : " + data.event_date + " " + data.event_time +
                        " more information click -> " + data.link;
                    window.open('https://api.whatsapp.com/send?phone=0822000000000&text=' + pretext + '');
                } else {
                    ui.popup.show('warning', result.message, 'Sorry');
                }
            },
            error: function (result) {
                ui.popup.show('error', 'Cant Share Event', 'Sorry');
            }
        });
    });
}

function addRow_create_tiket() {
    // Add set name and id row
    var row = 1;
    var id = 2;

    $(document).on("click", "#addnewrow_ticket", function () {
        var new_row = '<div class="row newly" id="row' + row + '">' +
            '<div class="col-12"><hr></div>' +
            '<div class="col-md-11">' +
            '<div class="row">'+
            '<div class="col-md-4">' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Title Ticket</small>' +
            '<input type="text" id="tiket_judul' + id +'" name="tiket_judul'+id+'" class="form-control input-abu">' +
            '</div>' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Select Event</small>' +
            '<select class="form-control input-abu" name="tiket_event' + id + '" id="tiket_event' + id +'" required></select>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Description Ticket</small>' +
            '<input type="text" id="tiket_dekripsi' + id +'" name="tiket_dekripsi' + id +'"' +
            'class="form-control input-abu" required>' +
            '</div>' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Start Date</small>' +
            '<input type="date" id="tiket_mulaidate' + id + '" name="tiket_mulaidate' + id +'"'+
            'class="form-control input-abu" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Type Ticket</small>' +
            '<select class="form-control input-abu" name="tiket_type' + id + '" id="tiket_type' + id +'" required>' +
            '<option selected disabled lang="en">Choose</option>' +
            '<option value="0" lang="en">Free</option>' +
            '<option value="1" lang="en">Paid</option>' +
            '</select>' +
            '</div>' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">End Date</small>' +
            '<input type="date" id="tiket_akhirdate' + id +'" name="tiket_akhirdate' + id +'"' +
            'class="form-control input-abu" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Price</small>' +
            '<input type="text" id="tiket_harga' + id + '" name="tiket_harga' + id +'" class="form-control input-abu" required>' +
            '</div>' +
            '<div class="form-group">' +
            '<small class="clight" lang="en">Total Stock</small>' +
            '<input type="text" id="tiket_total' + id + '" name="tiket_total' + id +'" class="form-control input-abu" required>' +
            '</div>' +
            '</div></div>'+
            '</div>' +
            '<div class="col-md-1 del-row">' +
            '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delrow-tiket">' +
            '<i class="mdi mdi-delete"></i>' +
            '</button>' +
            '</div>' +
            '</div>';

        $('#isi_newrow_ticket').append(new_row);
        get_list_event_admin(id);
        row++;
        id++;
        return false;
    });

    // Remove criterion
    $(document).on("click", ".delrow-tiket", function () {
        //  alert("deleting row#"+row);
        if (row > 1) {
            $(this).closest('div .newly').remove();
            row--;
        }
        return false;
    });

}

function get_list_event_admin(id) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: "/admin/tabel_event_list_admin",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#tiket_event'+id).empty();
            $('#tiket_event' + id).append("<option disabled selected> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#tiket_event' + id).append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            var idnya = '#tiket_event' + id +' option';
            $("#tiket_event"+id).html($(idnya).sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));
        }
    });
}


$('#tiket_event_filter').change(function () {
    var dipilih = this.value;
    tabel_ticket_list_admin(dipilih);
});


function tabel_ticket_list_admin(id_event) {
    $('#tabel_ticket_event').DataTable().clear().destroy();
    $('#tabel_ticket_event').empty();

    // var uihead = '<thead>'+
    //     '<tr>' +
    //     '<th><b lang="en">ID Ticket</b></th>' +
    //     '<th><b lang="en">Title</b></th>' +
    //     '<th><b lang="en">Description</b></th>' +
    //     '<th><b lang="en">Type Ticket</b></th>' +
    //     '<th><b lang="en">Price</b></th>' +
    //     '<th><b lang="en">Total</b></th>' +
    //     '<th><b lang="en">Date</b></th>' +
    //     '<th><b lang="en">Remaining</b></th>' +
    //     '<th><b lang="en">Action</b></th>' +
    //     '</tr>' +
    //     '</thead>';
    // $('#tabel_ticket_event').html(uihead);

    var token = $('meta[name="csrf-token"]').attr('content');

    var tabel = $('#tabel_ticket_event').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/admin/tabel_ticket_list_admin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token,
                "id_event" : id_event
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_ticket_event tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'id' },
            {
                mData: 'title',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-100">' + data + '</p>';
                }
            },
            {
                mData: 'description',
                render: function (data, type, row, meta) {
                    return '<p class="s13 text-wrap width-200">' + data + '</p>';
                }
            },
            {
                mData: 'ticket_type',
                render: function (data, type, row, meta) {
                    if(data == 0){
                        return '<small class="cgrey">Free</small>';
                    }else{
                        return '<small class="cgrey">Paid</small>';
                    }
                }
            },
            { mData: 'price' },
            { mData: 'total' },
            {
                mData: 'start_date',
                render: function (data, type, row, meta) {
                    var enddate = row.end_date;
                    return '<small class="s13 text-wrap width-200">' + data + "<br>until<br>" + enddate +'</small>';
                    }
                    },
            { mData: 'remaining_ticket' },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-edit">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btn-edit">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>',
                    "targets": -1
                }
            ],

    });

    //DETAIL
    $('#tabel_ticket_event tbody').on('click', 'button.btn-edit', function () {
        var data = tabel.row($(this).parents('tr')).data();
        console.log(data);
        $("#id_event_admin").val(data.id);
        $("#modal_edit_event").modal('show');

        $("#edit_judul").val(data.title);
        $("#edit_deskripsi").text(data.description);
        $("#edit_link").val(data.link);
        $("#edit_tgl").val(data.event_date);
        $("#edit_time").val(data.event_time);

        $('#edit_status').val(data.status).attr("selected", "selected");
        $('#edit_type').val(data.ticket_type).attr("selected", "selected");
    });

}



// -----------------------  EVENT  MANAGEMENT ------------------------
