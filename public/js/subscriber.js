// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"

// LANG -EN-ID
var lang = new Lang();
lang.dynamic('id', '/js/langpack/id.json');
lang.init({
    defaultLang: 'en'
});


var server_cdn = '';
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
    server_cdn = $("#server_cdn").val();
    session_subscriber_logged();
    ses_auth_subs();
    init_ready();

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
            console.log("cdn : " + server_cdn);

            var user = result.user;
            get_list_notif_navbar(user.community_id);
            get_inbox_navbar();

            if (user.picture != undefined || user.picture != null) {

                $(".foto_profil_subs").attr("src", server_cdn + cekimage_cdn(user.picture));
                $("#view_edit_user").attr("src", server_cdn + cekimage_cdn(user.picture));
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

            get_payment_initial();

            //show membership
            $("#membership_id").val(user.membership_id);
            if (user.membership_id != 0) {
                show_my_membership(user.membership_id);
            } else {
                get_pricing_membership();
            }


            get_profile_custom_regis(result.custom_input);

        },
        error: function (result) {
            console.log("Cant Reach Session Logged User Dashboard");
        }
    });
}


function ses_auth_subs() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/ses_auth_subs',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            var result = result[0];
            var custom = result.cust_portal_login;

            var base_color = custom.base_color;
            document.documentElement.style.setProperty("--base_color_dash", base_color);
          console.log(result);
        },
        error: function (result) {
            console.log("user config auth subs");
        }
    });
}

// INITIAL LOGIN 2 - FITUR
function get_initial_feature(datafitur) {
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
            '<img src="' + server_cdn + cekimage_cdn(item.logo) + '" class="rounded-circle img-fluid img-card3"' +
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
    $('#show_initial_fitur').html(showui);
    $("#initial1").modal('show');

}



// FORMAT PISAH UANG RUPIAH
function rupiah(val) {
    if (val != undefined) {

        var bilangan = val;
        var reverse = bilangan.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');

        return ribuan;
    }
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
        d.getMinutes()].join(':');

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
    $("#show_mymember").hide();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/subscriber/get_pricing_membership",
        type: 'POST',
        dataSrc: '',
        timeout: 40000,
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if ($("#membership_id").val() === 0) {
                    $('.hideisimember').hide().fadeOut('fast');
                    $('#hide_membertipe').show();
                    if (result.status === 401 || result.message === "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/subscriber/url/' + $(".community_name").val();
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
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
                        '<h4 class="cgrey2 s20">' + item.membership + '</h4>' +
                        '<img src="' + server_cdn + cekimage_cdn(item.icon) + '"  class="rounded-circle img-fluid imgprice"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';" style="margin-bottom:0.7em;">' +
                        '<div class="hidetime1">' +
                        '<sup class="cgrey" style="font-size: 30px;">' +
                        '<small class="h6">IDR</small></sup>' +
                        '<label class="card-harga cgrey">' +
                        '<strong>' + rupiah(item.pricing) + '</strong></label>' +
                        '<small class="clight" lang="en">/Once</small>' +
                        '</div>' +
                        '<small class="ctosca"><a class="detailmember" onclick="detail_membership_subs(' + i + ')"' +
                        'lang="en" data-lang-token="More Information">More Information</a></small>' +
                        '<br><button type="submit" class="btn clr-blue klik-pricing" style="margin-top: 1em;"' +
                        'onclick="pilih_payment_initial(\'' + idprice + '<>' + item.pricing + '\')" lang="en">Get Now</button>' +
                        '</center>' +
                        '</div></div></div>';
                });
                $('.price_member').html(html);
                $("hideisimember").show();
                $("#hide_membertipe").hide();
                $("#show_mymember").hide();
            }
        }, error: function (result) {
            console.log(result);
            $('.hideisimember').hide().fadeOut('fast');
            $('#hide_membertipe').show();
            $("#show_mymember").hide();
        }
    });
}


function detail_membership_subs(index) {
    // alert(index);
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
            var dt = result[index];
            $("#member_judul").html(dt.membership);
            $("#member_deskripsi").html(dt.description);
            $("#member_harga").html('Rp ' + rupiah(dt.pricing));

            if (dt.image != undefined && dt.image != null && dt.image != 0) {
                $("#img_membershiptipe").attr("src", server_cdn + cekimage_cdn(dt.image));
            }
            var subf = '';
            var jum = 0;
            var noimg = '/img/fitur.png';

            $.each(dt.feature, function (i, item) {
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
                    '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important; min-width:200px;">' +
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

            $("#modal_detail_membership_subs").modal("show");
        },
        error: function (result) {
            console.log(result);
        }
    });
}


// navbar inbox
function get_inbox_navbar() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/tabel_generate_inbox_subs',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/subscriber/url/' + $(".community_name").val();
                    }, 5000);
                } else {
                    var nonotif = '<center><br><h3 class="clight">No Inbox Message</h3><br></center>';
                    $("#isi_pesan_navbar").html(nonotif);
                    $("#ada_inbox").hide();

                    $("#isi_card_inbox").hide();
                    $("#nodata_card_inbox").show();
                }
            } else {
                show_card_pesan_inbox_subs(result);
                if (result != undefined) {
                    var avatar = [
                        'avatar1', 'avatar2', 'avatar3', 'avatar4',
                        'avatar5', 'avatar6', 'avatar7', 'avatar8'
                    ];
                    var num = Math.floor(Math.random() * avatar.length);

                    var isiku = '';
                    var total = 0;
                    $.each(result, function (i, item) {
                        total++;
                        isiku += '<a class="dropdown-item preview-item">' +
                            '<div class="preview-thumbnail">' +
                            '<img src="/img/avatar/' + avatar[num] + '.png" alt="image" class="profile-pic">' +
                            '</div>' +
                            '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">' +
                            '<span class="s14 tebal">' + item.message_type_title + ' &nbsp; &nbsp;</small>' +
                            '<span class="ctosca s13 mb-2">' + dateTime(item.created_at) + '</span><br>' +
                            '<p class="cgrey2 s13 mt-1 mb-1"> from &nbsp; <b>' + item.created_by_title + '</b></p>' +
                            '<small class="clight s14">' + item.title + '</small>' +
                            '</div>' +
                            '</a><div class="dropdown-divider"></div>';
                    });
                    $("#total_inbox_navbar").html(total);
                    $("#isi_pesan_navbar").html(isiku);
                    $("#ada_inbox").show();
                } else {
                    var nonotif = '<center><br><h3 class="clight">No Inbox Message</h3><br></center>';
                    $("#isi_pesan_navbar").html(nonotif);
                    $("#ada_inbox").hide();
                }

            }
        },
        error: function (result) {
            console.log(result);
            var nonotif = '<center><br><h3 class="clight">No Inbox Message</h3><br></center>';
            $("#isi_pesan_navbar").html(nonotif);
            $("#ada_inbox").hide();

            $("#isi_card_inbox").hide();
            $("#nodata_card_inbox").show();
            console.log("Cant Show Pesan Inbox");
        }
    });

}


function show_card_pesan_inbox_subs(result) {
    if (result.length != 0) {
        var isiui = '';
        $.each(result, function (i, item) {
            // console.log(item);
            var inidt = [item.id, item.level_status, item.community_id, item.status];
            isiui += '<div class="mb-3 col-md-6">' +
                '<div class="row no-gutters" style="height:159px;">' +
                '<div class="col-md-4">' +
                '<img src="/img/inbox.jpg" class="img-stretch">' +
                '</div>' +
                '<div class="col-md-8 bg-gradient-abupurple" style="padding: 0px;border-radius: 0px 10px 10px 0px;">' +
                '<div class="card-body nopadding">' +
                '<span class="card-title">' + item.created_by_title + '</span> &nbsp;&nbsp;' +
                '<br><span class="cteal mt-1 tebal s14">' + item.message_type_title + '</span>' +
                '<span class="cgrey2 s13" > (' + item.sender_level_title + ')' +
                '<p class="card-text">' + item.title + '</p>' +
                '<div class="row">' +
                '<div class="col-md-6">' +
                '<p class="card-text">' +
                '<small class="ctosca">' + dateTime(item.created_at) + '</small>' +
                '</p>' +
                '</div>' +
                '<div class="col-md-6 nopadding">' +
                '<button type="button" class="btn btn-purpleabu btn-sm melengkung10px"' +
                'onclick="detail_message_inbox_admin(\'' + inidt + '\')">' +
                '<i class="mdi mdi-eye btn-icon-prepend">' +
                '</i> <span lang="en"> Detail</span>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div><br>' +
                '</div>';
        });
        $("#isi_card_inbox").html(isiui);
        $("#nodata_card_inbox").hide();
    }
}




function show_my_membership(idmember) {
    $('.hideisimember').hide();
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/subscriber/show_my_membership",
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "membership_id": idmember,
            "_token": token,
        },
        success: function (result) {
            // console.log(result);

            if (result.success == false) {
                if ($("#membership_id").val() != 0) {
                    $('#hide_membertipe').show();
                    $("#show_mymember").hide();
                    if (result.status === 401 || result.message === "Unauthorized") {
                        ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                        setTimeout(function () {
                            location.href = '/subscriber/url/' + $(".community_name").val();
                        }, 5000);
                    } else {
                        ui.popup.show('warning', result.message, 'Warning');
                    }
                }
            } else {
                var result = result[0];
                $("#member_judul2").html(result.membership);
                $("#member_deskripsi2").html(result.description);
                $("#member_harga2").html('Rp ' + rupiah(result.pricing));

                var html = '';
                var noimg = '/img/fitur.png';
                html += '<center><div class="col-md-12" style="margin-bottom:1.5em;">' +
                    '<div class="card cd-pricing pricing">' +
                    '<div class="card-body">' +
                    '<center>' +
                    '<h4 class="cgrey2 s20">' + result.membership + '</h4>' +
                    '<img src="' + server_cdn + cekimage_cdn(result.icon) + '"  class="rounded-circle img-fluid imgprice"' +
                    'onerror = "this.onerror=null;this.src=\'' + noimg + '\';" style="margin-bottom:1.2em;">' +
                    '<div class="hidetime1">' +
                    '<sup class="cgrey" style="font-size: 30px;">' +
                    '<small class="h6">IDR</small></sup>' +
                    '<label class="card-harga cgrey">' +
                    '<strong>' + rupiah(result.pricing) + '</strong></label>' +
                    '<small class="clight" lang="en">/Once</small>' +
                    '</div><br><h6 class="cteal" lang="en">Description</h6>' +
                    '<p class="clight s12">' + result.description + '</small>'
                '</center>' +
                    '</div></div></div></center>';
                $('#isi_show_mymember').html(html);
                $("#show_mymember").show();
                $("#hide_membertipe").hide();

                var subf = '';
                var jum = 0;
                var noimg = '/img/fitur.png';

                $.each(result.feature, function (i, item) {
                    var sub_ui = '';
                    $.each(item.sub_features, function (i, subitem) {
                        sub_ui += '<li><small class="cgrey2">' + subitem.title + '</small></li>';
                    });
                    jum++;
                    subf += '<div class="row" style="margin-bottom:0.5em;">' +
                        '<div class="col-md-6"' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                        'style = "margin-right: -2em; margin-bottom: 0.5em;" >' +
                        '<div class="card bg-gradient-blue card-img-holder text-white submember">' +
                        '<div class="card-body" style="padding: 1rem 0.5rem 0.5rem 0.5rem !important; min-width:200px;">' +
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
                        '<small class="cgrey s13">' + item.title + '</small>' +
                        '<ul class="submember">' + sub_ui + '</ul>' +
                        '</div></div>';
                });
                $("#show_feature_member2").html(subf);
                $("#total_fitur_member2").html(jum);

            }
        }, error: function (result) {
            console.log(result);
            $('.hideisimember').hide().fadeOut('fast');
            $('#hide_membertipe').show();
            $("#show_mymember").hide();
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

            var noimg = '/img/fitur.png';

            $.each(result, function (i, item) {
                text += '<button type="button" id="method' + item.id + '" class="btn btn-blueline col-md-5 btn-sm btn-fluid" value=""' +
                    'onclick="pilih_pay_bank(this)">' + item.payment_title + '</button >';
                var deskrip = '';
                $.each(item.comm_payment_methods, function (i, itm) {
                    $.each(itm.description, function (x, isides) {
                        deskrip += '<li sytle="background-color:#fff;">' + isides + '</li>';
                    });
                    isibank +=
                        '<div class="card border-oren hidendulu method' + item.id + '" id="cardpay' + itm.id + '">' +
                        '<div class="card-header paybankmember" role="tab" sytle="background-color:#fff;">' +
                        '<h6 class="mb-0 pdb1">' +
                        '<a data-toggle="collapse" data-parent=".isi_show_bank" href="#collapseOne' + itm.id + '" ' +
                        'id="idpayq' + itm.id + '" onclick="pilihpay(' + itm.id + ');" aria-expanded="true"' +
                        'aria-controls="collapseOne' + itm.id + '">' +
                        '<img src="' + server_cdn + cekimage_cdn(itm.icon) + '" class="imgepay" style="width: 10%; height: auto;"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"> &nbsp; &nbsp;' + itm.payment_title +
                        '<span class="float-right">' +
                        '<i class="fa fa-chevron-right"></i>' +
                        '</span>' +
                        '</a></h6></div>' +
                        '<div id="collapseOne' + itm.id + '" class="collapse" role="tabpanel">' +
                        '<div class="card-block"><ul class="paybankmember">' + deskrip +
                        '</ul></div></div></div>';
                });
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




function pilih_pay_bank(ini) {
    $("#btn_submit_paymethod").attr("disabled", "disabled");
    $(".hidendulu").removeClass('dipilih');
    $('.btn-blueline').removeClass('active');
    $("#" + ini.id).addClass('active');
    $("." + ini.id).addClass('dipilih');
    $("." + ini.id).removeClass('active');
    $("#btn_submit_paymethod").attr("disabled", "disabled");
}


function pilihpay(idpay) {
    $("#id_pay_initial").val(idpay);
    $(".border-oren").removeClass("active");
    $("#cardpay" + idpay).addClass("active");
    $("#btn_pay_next").removeAttr("disabled");
    $("#btn_submit_paymethod").removeAttr("disabled", "disabled");
}





function pilih_payment_initial(dtmember) { //FREE
    $("#id_membertype").val("");
    var dt = dtmember.split('<>');
    $("#modal_initial_membership").modal('hide');

    if (dt[1] != 0 && dt[1] != undefined) {
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
                        location.href = '/subscriber/url/' + $(".community_name").val();
                    }, 5000);
                } else {
                    var nonotif = '<center><br><h3 class="clight">No Notification</h3><br></center>';
                    $("#isi_notif_navbar").html(nonotif);
                    $("#ada_notif").hide();
                }
            } else {
                if (result != undefined) {
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
                            '<label class="preview-subject tebal mb-1 s14">' + item.created_by_title +
                            '</label> ' +
                            '<small class="text-gray ellipsis mb-1 mt-1"> ' + item.title + '</small > ' +
                            '<small class="cteal mt-1 mb-0">' + dformat + '</small > ' +
                            '</div> ' +
                            '</a> ' +
                            '<div class="dropdown-divider"></div>';
                    });
                    $("#isi_notif_navbar").html(isiku);
                    $("#ada_notif").show();
                } else {
                    var nonotif = '<center><br><h3 class="clight">No Notification</h3><br></center>';
                    $("#isi_notif_navbar").html(nonotif);
                    $("#ada_notif").hide();
                }

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
            // console.log(result);

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





//subscriber membershitype
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


function init_ready() {
    if ($("#page_news_management_subs").length != 0) {
        table_news_list();
    }

    if ($("#page_friends_subs").length != 0) {
        suggestion_list();
        tabel_friend_list();
        tabel_tes_friends();
    }
}



/// ------ NEWS MANAGEMENT  -----------
function table_news_list() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/table_news_list',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success === false) {
                $("#nodata_news").show();
                $("#news_container").hide();
                if (result.status === 401 || result.message === "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/subscriber/url/' + $(".community_name").val();
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                if (result != "News Empty") {
                    var newslist = '';
                    var jumlah = 0;
                    var nofoto = '/img/artikel.jpg';

                    $.each(result, function (i, item) {
                        jumlah++;
                        $news_id = parseInt(item.id);
                        // $date=item.author_name;

                        var headpic = server_cdn + cekimage_cdn(item.image);
                        newslist += '<div class="news-card" id="' + item.id + '">' +
                            '<div class="row"><div class="col-md-6 news_pic_container">' +
                            '<img src="' + headpic + '" class="img-fluid picimg_news"' +
                            'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';"></div>' +
                            '<div class="col-md-6 news_content_container"><h4 class="news-title">' + item.title + '</h4>' +
                            '<h6 class="author_name cgrey2 s13">Date : ' + item.createdAt + '</h6>' +
                            '<h6 class="author_name cgrey2 s13">Author : ' + item.author_name + '</h6>' +
                            '<br><a href="/subscriber/detail_news/' + item.id + '" class="btn btn-tosca btn-sm konco">' +
                            'See Detail' +
                            '</a></div>' +
                            '</div>' +
                            '</div>';
                    });
                    $("#nodata_news").hide();
                    $("#news_container").html(newslist);
                } else {
                    $("#nodata_news").show();
                    $("#news_container").hide();
                }

            }
        },
        error: function (result) {
            console.log("Cant Show News");
            console.log(result);
            $("#nodata_news").show();
            $("#news_container").hide();
        }
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

function send_message(friend_id) {
    $friend_id = friend_id;
    $("#modal_send_message").modal("show");
    $("#friend_id").val($friend_id);
};

function send_whatsapp(friend_id) {
    $friend_id = friend_id;
    $phonum = +628123229810;
    $pretext = "Halo, Salam kenal";
    window.open('https://api.whatsapp.com/send?phone=' + $phonum + '&text=' + $pretext + '');

}
/// -------- END NEW MANAGEMENT -----------



///---------- FRIEND MANAGEMENT SUBS ---------
function tabel_tes_friends() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/tabel_friend_management',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            console.log(result);
        },
        error: function (result) {
            console.log("Cant Show");
        }
    });
}

function tabel_friend_list() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_friend_manage').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/subscriber/tabel_friend_management',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"><h4 class="cgrey">Data Not Found</h4</td></tr>';
                $('#tabel_friend_manage tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'image',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    return '<img src=' + server_cdn + cekimage_cdn(data) + ' class="news-list-box">';
                }
            },
            { mData: 'full_name' },
            {
                mData: 'friend_id',
                render: function (data, type, row, meta) {
                    return '<a href="/subscriber/view_profile/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i></a>' +
                        '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=send_message("' + data + '")>' +
                        '<i class="mdi mdi-email matadetail"></i></i></a>' +
                        '<a href="#" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick=send_whatsapp("' + data + '")>' +
                        '<i class="mdi mdi-whatsapp matadetail"></i></i></a>';
                }
            }
        ],

    });
}

function suggestion_list() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_friends_sugestion',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.length == 0) {
                $(".divkonco.pagefriend").hide();
            }
            if (result.success === false) {
                $(".divkonco.pagefriend").hide();
            } else {
                var suggestionlist = '';
                var jumlah = 0;
                var nofoto = '/img/kosong.png';

                $.each(result, function (i, item) {
                    jumlah++;
                    $news_id = parseInt(item.id);
                    var $headpic = server_cdn + cekimage_cdn(item.image);

                    suggestionlist += '<div class="card konco" id="' + item.user_id + '">' +
                        '<div class="card-body color">' +
                        '<div class="close_konco">' +
                        '<button type="button" class="close cgrey2" aria-label="Close"' +
                        'onclick="hide_friendsugest(\'' + item.user_id + "<>" + jumlah + '\')">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                        '<center>' +
                        '<img src="' + server_cdn + cekimage_cdn(item.picture) + '" class="rounded-circle img-fluid mb-2 konco"' +
                        'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';">' +
                        '<h6 class="cgrey2 s13">' + item.full_name + '</h6>' +
                        '<button type="button" onclick="add_friend_suggest_subs(\'' + item.user_id + '\')" class="btn btn-tosca btn-sm konco">' +
                        '<i class="mdi mdi-account-plus"></i> &nbsp; Add' +
                        '</button>' +
                        '<center>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });

                $("#suggestion_list").html(suggestionlist);
            }
        },
        error: function (result) {
            console.log("Cant Show");
        }
    });
}

function add_friend_suggest_subs(idsubs) {
    alert(idsubs);
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/add_friend_suggest_subs',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token,
            "user_id_subs": idsubs
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                if (result.status === 401 || result.message === "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/subscriber/url/' + $(".community_name").val();
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                swal("Yeay!", "Friend has been added", "success");
                location.reload();
            }
        },
        error: function (result) {
            swal("Sorry!", "Failed to add new friend", "error");
            console.log(error);
        }
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

function send_message(friend_id) {
    $friend_id = friend_id;
    $("#modal_send_message_subs").modal("show");
    $("#friend_id").val($friend_id);
    // var editor = new nicEditor({iconsPath : '/img//nicEditorIcons.gif'}).panelInstance('news_edit_content');
    //  $('.nicEdit-panelContain').parent().width('100%');
    // $('.nicEdit-main').parent().width('98%');
    // $('.nicEdit-main').width('98%');
    // $('.nicEdit-main').height('200px');

    // var content  = nicEditors.findEditor('news_edit_content');
    //       content.setContent(res.content);
    //       $('textarea[name=news_edit_content]').val(res.content);

    //$("#news_picture").attr("src", server_cdn+res.image);
    // $("#news_picture").attr("src", server_cdn+res.image);
    //   $("#edit_title").val(res.title);
    //   $("#id_news").val(res.id);
    //   $("#toggle-status").val(res.id);
    //   $("#toggle-headline").val(res.id);
};

function send_whatsapp(friend_id) {
    $friend_id = friend_id;
    $phonum = +628123229810;
    $pretext = "Halo, Salam kenal";
    window.open('https://api.whatsapp.com/send?phone=' + $phonum + '&text=' + $pretext + '');

}
///---------- FRIEND MANAGEMENT SUBS ---------


// --------------- PROFIL MANAGEMENT SUBS --------------
function get_profile_custom_regis(params) {
    var uihtml = '';

    $.each(params, function (no, des) {
        // console.log(des);
        var item = des.param_form_array;
        var inputipe = des.custom_input;
        var cusinput = '';

        if (inputipe.id == 1) {
            var pilihan = item.splice(3);
            $.each(pilihan, function (i, item) {
                if (item == des.value) {
                    cusinput += '<div class="col-md-6 nopadding">' +
                        '<div class="form-check profile">' +
                        '<small class="form-check-label">' +
                        '<input type="radio" class="form-check-input input-abu" name="radio' + no + '" id="radio' + no + i + '" value="' + item + '" checked> ' +
                        item + '<i class="input-helper"></i></small>' +
                        '</div></div>';
                } else {
                    cusinput += '<div class="col-md-6 nopadding">' +
                        '<div class="form-check profile">' +
                        '<small class="form-check-label">' +
                        '<input type="radio" class="form-check-input input-abu" name="radio' + no + '" id="radio' + no + i + '" value="' + item + '"> ' +
                        item + '<i class="input-helper"></i></small>' +
                        '</div></div>';
                }
            });
        } else if (inputipe.id == 2) {
            cusinput = '<input id="number' + no + '" type="text"' +
                'class="form-control input-abu" name="number' + no + '"' +
                'value="' + des.value + '"' +
                'onkeypress="return isNumberKey(event)"' +
                'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';

        } else if (inputipe.id == 3) {
            cusinput = '<input id="text' + no + '" type="text"' +
                'class="form-control input-abu" name="text' + no + '"' +
                'value="' + des.value + '"' +
                'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';

        } else if (inputipe.id == 4) {
            cusinput = '<textarea id="textarea' + no + '" rows="2"' +
                'class="form-control input-abu" name="textarea' + no + '">' + des.value + '</textarea >';

        } else if (inputipe.id == 5) {
            cusinput = '<input id="date' + no + '" type="date"' +
                'class="form-control input-abu" name="date' + no + '"' +
                'value="' + des.value + '"' +
                'data-toggle="tooltip" data-placement="top" title="' + des.description + '">';

        }
        else if (inputipe.id == 6) {
            var list = item.splice(3);
            var cekbox = '';
            var cek = '';
            $.each(des.value, function (index, val) {
                if (val == item) {
                    cek += 'checked';
                } else {
                    cek = '';
                }
            });


            $.each(list, function (i, item) {
                cekbox += '<div class="form-check profile col-md-6">' +
                    '<input class="form-check-input" type="checkbox" name="checkbox' + no + '[]" value="' + item + '" id="checkbox' + i + '" ' + cek + '>' +
                    '<small class="form-check-label cekbox" for="checkbox' + no + '">' + item +
                    '</small>' +
                    '</div>';
            });
            cusinput = '<div class="row mgl-1em">' + cekbox + '</div>';
        } else if (inputipe.id == 7) {
            var pilihan = item.splice(2);
            var dropdown = '';
            $.each(pilihan, function (i, item) {
                if (item == des.value) {
                    dropdown += '<option value="' + item + '" selected>' + item + '</option>';
                } else {
                    dropdown += '<option value="' + item + '">' + item + '</option>';
                }
            });
            cusinput = '<select class="form-control input-abu fullwidth" name="dropdown' + no + '" id="dropdown' + no + '">' + dropdown + '</select>';

        }


        uihtml += '<div class="col-md-6 kanankiri30px">' +
            '<div class="form-group row">' +
            '<input type="hidden" name="id_' + no + '" value="' + des.id + '">' +
            '<label class="h6 cgrey s14" for="input' + no + '" lang="en">' + item[0] + '</label>' +
            cusinput +
            '</div>' +
            '</div>';


    });

    $("#custom_input_regis").html(uihtml);
}
// --------------- END PROFIL MANAGEMENT SUBS ----------------
