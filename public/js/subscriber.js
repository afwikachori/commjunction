// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"

// LANG -EN-ID
var lang = new Lang();
lang.dynamic('id', '/js/langpack/id.json');
lang.init({
    defaultLang: 'en'
});


var server_cdn = $("#server_cdn").val();
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
            // $("#lottie").show();
        },
        hideLoader: function hideLoader() {
            $("#modal_ajax").modal('hide');
            // $("#lottie").hide();
        },
    }
};


// (function () {
//     window.ybug_settings = { "id": "ftwv8rsw7kbwf9t2bkvk" };
//     var ybug = document.createElement('script'); ybug.type = 'text/javascript'; ybug.async = true;
//     ybug.src = 'https://widget.ybug.io/button/' + window.ybug_settings.id + '.js';
//     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ybug, s);
// })();

$(document).ready(function () {
    session_subscriber_logged();
});

// SESSION LOGIN SUBSVRIBER
function session_subscriber_logged() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function beforeSend(jxqhr) {
            ui.popup.showLoader();
            // setTimeout(function () {
            //     ui.popup.hideLoader();
            // }, 15000);
        },
        timeout: 20000,
        error: function error(event, jxqhr, status, _error) {
            ui.popup.show('error', status, 'Error');
            ui.popup.hideLoader();
        },
        complete: function complete() {
            ui.popup.hideLoader();
        }
    });
    $.ajax({
        url: '/subscriber/session_subscriber_logged',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 8000);
            console.log(result);
            console.log(result.access_token);

            var user = result.user;
            get_list_notif_navbar(user.community_id);
            if (user.picture != undefined || user.picture != null) {
                var oic = user.picture;
                var cekone = oic.slice(0, 1);
                var picsubs = '';
                if (cekone != "/") {
                    picsubs = "/" + user.picture;
                } else {
                    picsubs = user.picture;
                }
                // alert(server_cdn + picsubs);
                $(".foto_profil_subs").attr("src", server_cdn + picsubs);
                $("#view_edit_user").attr("src", server_cdn + picsubs);
            }

            $(".nama_komunitas").html(user.community_name);
            $(".community_name").val(user.community_name);
            $(".id_komunitas").val(user.community_id);
            $("#komunitas").val(user.community_id);
            $("#komunitas2").val(user.community_id);
            $("#komunitas_inbox").val(user.community_id);

            // Profil user
            $(".nama_subs_login").html(user.full_name);
            $(".membership_status").html(user.membership);
            $("#name_subs").val(user.full_name);
            $("#phone_subs").val(user.notelp);
            $("#username_subs").val(user.user_name);
            $("#email_subs").val(user.email);
            $("#alamat_subs").val(user.alamat);

            //initial login
            if (user.status == 1) { //first-login
                get_initial_feature(result.community_feature);
            }


            if (user.status == 1) {
                $('#show_toltip').prop('First Login');
            } else if (user.status == 2) {
                $('#show_toltip').prop('Waiting Membership Approval');
            } else if (user.status == 3) {
                $('#show_toltip').prop('Waiting Membership Approval');
                $("#label_user_aktif").show().fadeIn('slow');
            } else if (user.status == 4) {
                $('#show_toltip').prop('Non-Active');
            } else { //status=0 belum aktif
                swal("Your account not verified, please wait system or call Commjuction's Administrator", "Inactive", "error");
                window.location.href = "/subscriber/url/" + community_name;
            }




        },
        error: function (result) {
            console.log("Cant Reach Session Logged User Dashboard");
        }
    });
}


// INITIAL LOGIN 2 - FITUR
function get_initial_feature(datafitur) {
    // console.log(datafitur);
    var showui = '';
    var jum = 0;
    $.each(datafitur, function (i, item) {
        // console.log(item);
        jum++;
        showui += '<div class="col-md-6 stretch-card grid-margin" style="height:75px; padding-left: 5px; padding-right:4px; padding-bottom:0px; margin-bottom:0.5em;"' +
            'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
            'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
            '<div class="card bg-gradient-blue card-img-holder text-white">' +
            '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important;">' +
            '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
            'alt="circle-image" /> ' +
            '<div class="row">' +
            '<div class="col-md-3" style="padding-right:4px;">' +
            '<img src="' + cekimage_cdn(item.logo) + '" class="rounded-circle img-fluid img-card3"' +
            'onerror = "this.onerror=null;this.src=\' /img/fitur.png \';">' +
            '</div>' +
            '<div class="col-md-9" style="padding-left:5px;">' +
            '<b><small>' + item.titile + '</small></b>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
    });
    $('#show_initial_fitur').html(showui);
    $("#initial1").modal('show');

}



// FORMAT PISAH UANG RUPIAH
function rupiah(val) {
    var bilangan = val;
    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');

    return ribuan;
}


//FORMAT VALIDASI EMAIL
function IsEmail_valid(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

//TAB MENU LINE

$(".tabbable-line li a").click(function () {
    $(".tabbable-line li").removeClass('active');
    $(this).parent().addClass('active');
});


//IMAGE FILENAME INPUT
function filenameImg(input) {
    var fileName = $(input).val();
    if (fileName.length > 30) {
        var fileNameFst = fileName.substring(0, 30);
        $(input).next('.custom-file-label').html(fileNameFst + "...");
    } else {
        $(input).next('.custom-file-label').html(fileName);
    }
}

// FORMAT DATE TIME
function dateFormat(tgl) {
    var d = new Date(tgl);

    dformat = [d.getDate(), d.getMonth() + 1,
    d.getFullYear()].join('/') + '<br>' +
        [d.getHours(),
        d.getMinutes(),
        d.getSeconds()].join(':');

    return dformat;
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

// KLIK IMAGE PREVIEW
function clickImage(img) {
    var modal = document.getElementById("mdl-img-click");
    var img = document.getElementById(img.id);
    var modalImg = document.getElementById("mdl-img-view");

    img.onclick = function () {
        $('#mdl-img-click').modal('show');
        modalImg.src = this.src;
    }
}

// function FILE BROWSE PROFIL{
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
    var a = document.getElementById("new_pass_subs");
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
        foto = '/img/fitur.png';
    }

    return foto;
}



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
            // console.log(result);
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
                var html = '';
                var noimg = '/img/fitur.png';
                $.each(result, function (i, item) {
                    // console.log(item);
                    var idprice = item.id;
                    html += '<div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:1.5em;">' +
                        '<div class="card cd-pricing pricing' + idprice + '">' +
                        '<div class="card-body">' +
                        '<center>' +
                        '<h4 class="cgrey2 s20" style="margin-top: 0.5em;">' + item.membership + '</h4>' +
                        '<img src="' + server_cdn + item.icon + '"  class="rounded-circle img-fluid imgprice"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="hidetime1">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong>' + rupiah(item.pricing) + '</strong></label>' +
                        '<small class="clight" lang="en">/Once</small>' +
                        '</div>' +
                        '<button type="submit" class="btn clr-blue klik-pricing" style="margin-top: 0.5em;"' +
                        'onclick="pilih_payment_initial(\'' + idprice + '<>' + item.pricing + '\')" lang="en">'+
                        'Get Now</button>' +
                        '</center>' +
                        '</div></div></div>';
                });
                $('.price_member').html(html);
            }
        }
    });
}

function get_payment_initial() {
    $("#btn_submit_paymethod").attr("disabled", "disabled");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_payment_initial',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        success: function (result) {
            // console.log(result);
            var text = '';
            var isibank = '';

            $.each(result, function (i, item) {
                text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value="' + item.id + '"' +
                    'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';

                var des = item.comm_payment_type;
                isibank = '<div class="hidenlah">' +
                    '<h6 class="cgrey">' + des.payment_title + '</h6>' +
                    '<p class="clight">' + des.description + '</p>' +
                    '</div>';
            });
            $(".isi_method_pay").html(text);
            $(".isi_show_bank").html(isibank);

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}

function pilih_payment_initial(dtmember) {
    $("#id_membertype").val("");
    var dt = dtmember.split('<>');
    $("#modal_initial_membership").modal('hide');

    if (dt[1] != 0) {
        $("#modal_pay_initial").modal('show');
        $("#harga_member").html(rupiah(dt[1]));
        $("#id_membertype").val(dt[0]);
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/subscriber/set_initial_membership_pay',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "id_membertype": dt[0],
                "id_pay_initial": "0",
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
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                } else {
                    swal("Successfully", "Waiting your membership confirmation from Administrator", "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 3500);
                }
            },
            error: function (result) {
                console.log(result);
                console.log("Cant Show");
            }
        });

    }
}

function pilih_pay_bank(ini) {
    // console.log(ini.value);
    $("#id_pay_initial").val("");
    $(".hidendulu").removeClass('dipilih');
    $('.btn-blueline').removeClass('active');
    $("#" + ini.id).addClass('active');
    $(".hidenlah").show();
    $("#id_pay_initial").val(ini.value);
    if ($("#id_pay_initial").val() != "") {
        $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
    }
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_list_notif_navbar',
        type: 'POST',
        dataSrc: '',
        data: {
            "community_id": idkom,
            "start_date": ago,
            "end_date": today,
            "read_status": "1", //1:notread 2:read
            "notification_status": "receive", //send/receive
            "limit": 5
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

function formatDate(date) {
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


//show icon preview
function previewImgUpload(idhtml, input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + idhtml).show().attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
    }
}


// LOGOUT SUBSCRIBER DASHBOARD
function LogoutSubscriber() {
    var namakom = $(".community_name").val();
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
        url: '/subscriber/LogoutSubscriber',
        type: "POST",
        dataType: "json",
        timeout: 30000,
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/subscriber/url/' + namakom;
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                location.href = '/subscriber/url/' + namakom;
            }
        },
        error: function (result) {
            console.log(result);
                location.href = '/subscriber/url/' + namakom;
        }
    });
    // });
}

