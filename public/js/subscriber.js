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
    thematic_color();

    session_subscriber_logged();

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
            $.cookie('id_komunitas_login', null);
            $.cookie('id_komunitas_login', user.community_id);


            get_list_notif_navbar(user.community_id);
            get_inbox_navbar_subs();

            $("#id_user_subs_trans").val(user.user_id);
            $("#subs_id_trans").val(user.user_id);

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


function thematic_color() {
    var base_color = $.cookie('base_color');
    var accent_color = $.cookie('accent_color');
    var background_color = $.cookie('background_color');
    var navbar_color = $.cookie('navbar_color');

    var idcomm_login = $.cookie('id_komunitas_login');

    if (idcomm_login != null && idcomm_login != undefined) {
        document.documentElement.style.setProperty('--base_color_dash', base_color);
        document.documentElement.style.setProperty('--accent_color_dash', accent_color);
        document.documentElement.style.setProperty('--bgcolor_dash', background_color);
        document.documentElement.style.setProperty('--navbar_color_dash', navbar_color);
    }
}

function ses_auth_subs() {
    $.cookie('base_color', null);
    $.cookie('accent_color', null);
    $.cookie('background_color', null);
    $.cookie('navbar_color', null);

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
            // console.log(result);
            var custom = result.cust_portal_login;

            // var base_color = custom.base_color;
            // document.documentElement.style
            //     .setProperty('--base_color_dash', base_color);
            // ----------------------------------------------------------------

            var id_kom_login = $(".id_komunitas").val();
            var id_kom_auth = result.id;

            $.cookie('base_color', custom.base_color, { expires: 30 });
            $.cookie('accent_color', custom.accent_color, { expires: 30 });
            $.cookie('background_color', custom.background_color, { expires: 30 });
            $.cookie('navbar_color', custom.navbar_color, { expires: 30 });
        },
        error: function (result) {
            $.cookie('base_color', null);
            $.cookie('accent_color', null);
            $.cookie('background_color', null);
            $.cookie('navbar_color', null);
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
function get_inbox_navbar_subs() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_inbox_navbar_subs',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data:{
            "_token" : token,
        },
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
                        if (item.sender_picture != 0){
                            var fotopic = server_cdn + cekimage_cdn(item.sender_picture);
                        }else{
                            var fotopic = '/img/avatar/'+avatar[num]+'.png';
                        }
                        total++;
                        isiku += '<a class="dropdown-item preview-item">' +
                            '<div class="preview-thumbnail">' +
                            '<img src="' + fotopic + '" alt="image" class="profile-pic">' +
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
            "notification_status": "receive", //send/receive
            "read_status": "1", //1:notread 2:read
            "limit": 5
        },
        timeout: 30000,
        success: function (result) {
            console.log(result);
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
                $.cookie('base_color', null);
                $.cookie('accent_color', null);
                $.cookie('id_komunitas_login', null);
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
    if ($("#page_dashboard_subscriber").length != 0) {
        ses_auth_subs();

        get_payment_initial();

        get_dashboard_news();
        get_friends_total();
        get_friends_sugestion();
        get_top_friends();

        get_last_news();
        get_love_news();
        get_topvisit_news();

        get_top_player();
        get_top_visit_club();
    }

    if ($("#page_news_management_subs").length != 0) {
        table_news_list();
    }

    if ($("#page_friends_subs").length != 0) {
        suggestion_list();
        tabel_friend_list();

        tabel_friend_pending_list();
        get_friends_total_tabel();
        get_list_setting_module_friends();

        $("#btn_find_filter_friend").click(function () {
            find_search_filter_friends();
        });
    }


    if ($("#page_transaction_management_subs").length != 0) {
        get_list_transaction_tipe();
        // get_list_subscriber_admin();

        $("#reset_tbl_trans").click(function () {
            resetparam_trans();
        });


        $("#btn_showtable_transaksi").click(function (e) {
            show_card_transaksi();
        });

        $("#btn_filter_transaksi").click(function (e) {
            filter_show_card_transaksi();
            $("#modal_trasaksi_filter").modal("hide");
        });
    }

    if ($("#page_notification_management_subs").length != 0){
        get_list_setting_notif_subs();
        show_card_notification();
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
                            '<br>'+
                            '<div class="row"><div class="col-md-6"><a href="/subscriber/detail_news/' + item.id + '" class="btn btn-tosca btn-sm konco">' +
                            'See Detail' +
                            '</a></div>'+
                            '<div class="col-md-6 kananin pad-right">'+
                            '<button type="button" class="btn btn-gradient-danger btn-rounded btn-icon btn-loveme"'+
                            'onclick="send_love_news(\'' + item.id +  '\')">'+
                            '<i class="mdi mdi-heart"></i>'+
                            '</button></div></div>'+
                            '</div>' +
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

function send_love_news(idnews) {
    var token = $('meta[name="csrf-token"]').attr('content');
    alert(idnews);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/send_love_news_subs',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token,
            "news_id" : idnews
        },
        success: function (result) {
            // console.log(result);
            if (result != undefined && result.success != false) {
                ui.popup.show('success', 'News already loved', 'Success');
            }else{
                ui.popup.show('warning', result.message, 'Warning');

            }
        },
        error: function (result) {
            ui.popup.show('error', 'Cant Love this news', 'Failed');
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

function send_message(dtfriend) {
    var teman = dtfriend.split('<>');
    var friend_id = teman[0];
    var nama_friend = teman[1];

    $("#kepada_sendpesan").html(nama_friend);
    $("#friend_id").val(friend_id);
    $("#modal_send_message_subs").modal("show");
};

function send_whatsapp(nohp) {
    var pretext = "Halo, Salam kenal";
    window.open('https://api.whatsapp.com/send?phone=' + nohp + '&text=' + pretext + '');

}
/// -------- END NEW MANAGEMENT -----------



///---------- FRIEND MANAGEMENT SUBS ---------
function get_friends_total_tabel() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_friends_total',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result != undefined && result.success != false) {
                $("#text_total_friends").html(result.total_friend + '&nbsp;<small class="clr-accent-color" lang="en">Friends<small>');
            }
        },
        error: function (result) {
            console.log("Cant Total Friends");
        }
    });
}

function get_list_setting_module_friends() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_list_setting_module_friends',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token
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
                var uiku = '';
                var inputipe = '';

                $.each(result, function (i, item) {
                    // console.log(item);
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
                $(".isi_seting_module_friend").html(uiku);
            }
        },
        error: function (result) {
            console.log("Cant Show Setting Friends");
            console.log(result);
        }
    });
}

function find_search_filter_friends() {
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/find_search_filter_friends',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token,
            "name": $("#name_friend").val()
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                $(".divkonco.pagefriend").hide();
                $("#find_friend_modal").modal('hide');
                swal("Failed", result.message, "error");
            } else {
                $("#suggestion_list").html("");
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
                        'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';"><br>' +
                        '<a class="cgrey2 s13 clr-accent-color" onclick="get_friend_profile(\'' + item.user_id + '\')">' + item.full_name + '</a>' +
                        '<button type="button" onclick="add_friend_suggest_subs(\'' + item.user_id + '\')" class="btn btn-accent btn-sm konco">' +
                        '<i class="mdi mdi-account-plus"></i> &nbsp; Add' +
                        '</button>' +
                        '<center>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });

                $("#suggestion_list").html(suggestionlist);
                $("#find_friend_modal").modal('hide');
            }
        },
        error: function (result) {
            $(".divkonco.pagefriend").hide();
            console.log("Cant Find Friends");
        }
    });
}


function get_friend_profile(id_subs) {
    // swal(id_subs);
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_friend_profile',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "_token": token,
            "user_id": id_subs
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                ui.popup.show('warning', result.message, 'Warning');
            } else {
                $('#profil_chat_wa').attr('onclick', 'send_whatsapp_teman(\'' + result.notelp + '\')');
                $('#profil_send_msg').attr('onclick', 'send_message_teman(\'' + result.user_id + '\')');

                if (result.picture != undefined && result.picture != 0) {
                    $("#foto_teman").attr("src", server_cdn + cekimage_cdn(result.picture));
                }
                $("#teman_nama").html(result.full_name);
                $("#teman_hp").html(result.notelp);
                $("#teman_email").html(result.email);
                $("#teman_username").html(result.user_name);

                $("#modal_detail_profil_friend").modal('show');
            }
        },
        error: function (result) {
            console.log(result);
            ui.popup.show('warning', 'Cant Show Profile', 'Warning');
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
                mData: 'picture',
                render: function (data, type, row, meta) {
                    var noimg = '/img/kosong.png'
                    var pic = server_cdn + cekimage_cdn(data);
                    return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgteman' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                }
            },
            { mData: 'full_name' },
            {
                mData: 'friend_id',
                render: function (data, type, row, meta) {
                    var nohp = row.notelp;
                    var nama = row.full_name;
                    var dtsend = data + '<>' + nama;
                    return '<a href="/subscriber/view_profile/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i></a>' +
                        '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"'+
                        'onclick="send_message(\'' + data + "<>" + nama + '\')">' +
                        '<i class="mdi mdi-email matadetail"></i></i></a>' +
                        '<a type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref" onclick="send_whatsapp("' + nohp + '")>' +
                        '<i class="mdi mdi-whatsapp matadetail"></i></i></a>';
                }
            }
        ],

    });
}


function tabel_friend_pending_list() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_friend_pending').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/subscriber/tabel_friend_pending_list',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty"><h4 class="cgrey">Data Not Found</h4</td></tr>';
                $('#tabel_friend_pending tbody').empty().append(nofound);
            },
        },
        columns: [
            {
                mData: 'picture',
                render: function (data, type, row, meta) {
                    // console.log(data);
                    var noimg = '/img/kosong.png'
                    var pic = server_cdn + cekimage_cdn(data);
                    // return '<img src=' + server_cdn + cekimage_cdn(data) + ' class="news-list-box">';
                    return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';

                }
            },
            { mData: 'full_name' },
            {
                mData: 'friend_id',
                render: function (data, type, row, meta) {
                    return '<a href="/subscriber/view_profile/' + data + '" type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref">' +
                        '<i class="mdi mdi-eye matadetail"></i></a> &nbsp;&nbsp;' +
                        '<a href="#" type="button" class="btn bg-hijau btn-rounded btn-icon detilhref" onclick=approv_new_friend("' + data + '")>' +
                        '<i class="mdi mdi-check-circle matadetail"></i></i></a>';
                }
            }
        ],

    });
}

function approv_new_friend(id_friend) {
    // swal(id_friend);
    $("#id_new_friend").val(id_friend);
    $("#modal_confirm_new_friend").modal('show');
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
                        'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';"><br>' +
                        '<a class="cgrey2 s13 clr-accent-color" onclick="get_friend_profile(\'' + item.user_id + '\')">' + item.full_name + '</a>' +
                        '<button type="button" onclick="add_friend_suggest_subs(\'' + item.user_id + '\')" class="btn btn-accent btn-sm konco">' +
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
            $(".divkonco.pagefriend").hide();
            console.log("Cant Show");
        }
    });
}

function add_friend_suggest_subs(idsubs) {
    // swal(idsubs);
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

function send_message_teman(friend_id) {
    // swal(friend_id);
    $("#modal_send_message_subs").modal("show");
    $("#friend_id").val(friend_id);
}

function send_whatsapp_teman(phone) {
    // var friend_id = friend_id;
    //  var phone = +628123229810;
    var pretext = "Halo, Salam kenal";
    window.open('https://api.whatsapp.com/send?phone=' + phone + '&text=' + pretext + '');

}
///---------- FRIEND MANAGEMENT SUBS ---------


// --------------- PROFIL MANAGEMENT SUBS --------------
function get_profile_custom_regis(params) {
    var uihtml = '';
    $.each(params, function (no, des) {
        var item = des.param_form_array;
        var inputipe = des.custom_input;
        var deskripsi = des.description;
        var cusinput = '';

        if (inputipe.id == 1) {
            if (item[2] == deskripsi ){
                var pilihan = item.splice(3);
            }else{
                var pilihan = item.splice(2);
            }
            // var pilihan = item.splice(2);

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
            if (item[2] == deskripsi) {
                var list = item.splice(3);
            } else {
                var list = item.splice(2);
            }
            // var list = item.splice(3);
            var cekbox = '';

            $.each(list, function (i, item) {

                var cek = isInArray(item, des.value) ? "checked " : " ";

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
            '<div class="col-md-12 nopadding"><label class="h6 cgrey s14 tebal" for="input' + no + '">' + item[0] + '</label></div>' +
            cusinput +
            '</div><br>' +
            '</div>';


    });

    $("#custom_input_regis").html(uihtml);
}
// --------------- END PROFIL MANAGEMENT SUBS ----------------


//--------------------------- TRANSACTION MANAGEMENT SUBS ----------------------------
function resetparam_trans() {
    $("#komunitas").val("");
    $("#tanggal_mulai").val("");
    $("#tanggal_selesai").val("");
    $("#tipe_trans").val("");
    $("#status_trans").val("");
    $("#subs_name").val("");
}

$("#reset_card_filtertrans").click(function () {
    $("#tanggal_mulai2").val("");
    $("#tipe_trans2").val("");
    $("#tanggal_selesai2").val("");
    $("#status_trans2").val("");

    $("#show_card_transaksi").html("");
    $("#showin_table_trans").hide();
    $(".showin_table_trans").hide();

    resetparam_trans();

    $("#tab_transaction_param").show();
});

function get_list_transaction_tipe() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: "/subscriber/get_list_transaction_tipe",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            if(result.success == false){
                get_list_transaction_tipe();
            }else{
            $('#tipe_trans').empty();
            $('#tipe_trans').append("<option disabled selected> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#tipe_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            //Short Function Ascending//
            $("#tipe_trans").html($('#tipe_trans option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));
            // ___________________________________________________________________
            $('#tipe_trans2').empty();
            $('#tipe_trans2').append("<option disabled selected> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#tipe_trans2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            //Short Function Ascending//
            $("#tipe_trans2").html($('#tipe_trans2 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));
        }
        },
        error: function (result) {
            get_list_transaction_tipe();
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
        url: "/subscriber/get_list_subcriber_name",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token,
        },
        success: function (result) {
            console.log(result);
            $('#subs_name').empty();
            $('#subs_name').append("<option value='null'> Choose</option>");

            var isilist = '';
            $.each(result, function (i, item) {
                isilist += '<option style="background-image:url(img/kosong.png);" value="' + item.id + '">' + item.full_name + '</option>';
            });
            $('#subs_name').html(isilist);

            // for (var i = result.length - 1; i >= 0; i--) {
            //     $('#subs_name').append('<option  style="" value=\''.concat(result[i].id, '\'>').concat(result[i].full_name, '</option>'));
            // }
            //Short Function Ascending//
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

function show_card_transaksi() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/tabel_transaksi_show',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "komunitas": $("#komunitas").val(),
            "tanggal_mulai": $("#tanggal_mulai").val(),
            "tanggal_selesai": $("#tanggal_selesai").val(),
            "tipe_trans": $("#tipe_trans").val(),
            "status_trans": $("#status_trans").val(),
            "subs_name": $("#id_user_subs_trans").val(),
            "_token": token
        },
        success: function (result) {
            console.log(result);

            if (result.length != 0) {
                var isiui = '';
                var num = 0;
                $.each(result, function (i, item) {
                    console.log(item);
                    num++;

                    var dt = [item.invoice_number, item.payment_level, item.community_id];
                    isiui +=
                        '<div class="col-md-6 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.transaction_type + '">' +
                        '<div class="card bg-gradient-abublue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                        'style="padding: 0.3rem 0.5rem; position:relative;"' +
                        'onclick="detail_transaksi_all(\'' + dt + '\')">Detail</button>' +
                        '<div class="row">' +
                        '<div class="col-md-4" style="padding:0px;">' +
                        '<img src="/img/money.png" class="rounded-circle img-fluid img-card mediumsize">' +
                        '</div>' +
                        '<div class="col-md-8">' +
                        '<small class="ctosca">Total</small>' +
                        '<h3 class="cteal"> Rp  ' + rupiah(item.grand_total) + '</h3>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<small class="cteal">' + item.transaction_type + '</small>' +
                        '<h4>' + item.transaction + '</h4>' +
                        '<p class="ctosca">' + item.invoice_number + '</p>' +
                        '</div>' +
                        '<div class="col-md-12" style="text-align: right; margin-top:-1em;">' +
                        '<small class="cteal"> ' + dateTime(item.created_at) + '</small><br>' +
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Status : ' + item.status_title +
                        '</small>' +
                        '</div>' +
                        '</div></div></div></div>';
                });

                $("#show_card_transaksi").html(isiui);

                $(".showin_table_trans").show();
                $("#tab_transaction_param").hide();

            }
        },
        error: function (result) {
            ui.popup.show('error', 'Show Data Transaction', 'Failed');
        }
    });
}

function filter_show_card_transaksi() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/tabel_transaksi_show',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "komunitas": $("#komunitas2").val(),
            "tanggal_mulai": $("#tanggal_mulai2").val(),
            "tanggal_selesai": $("#tanggal_selesai2").val(),
            "tipe_trans": $("#tipe_trans2").val(),
            "status_trans": $("#status_trans2").val(),
            "subs_name": $("#subs_id_trans").val(),
            "_token": token
        },
        success: function (result) {
            if (result.length != 0) {
                var isiui = '';
                var num = 0;
                $.each(result, function (i, item) {
                    console.log(item);
                    num++;

                    var dt = [item.invoice_number, item.payment_level, item.community_id];
                    isiui +=
                        '<div class="col-md-6 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.transaction_type + '">' +
                        '<div class="card bg-gradient-abublue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<button class="btn btn-sm btn-gradient-ijo melengkung10px float-right"' +
                        'style="padding: 0.3rem 0.5rem; position:relative;"' +
                        'onclick="detail_transaksi_all(\'' + dt + '\')">Detail</button>' +
                        '<div class="row">' +
                        '<div class="col-md-4" style="padding:0px;">' +
                        '<img src="/img/money.png" class="rounded-circle img-fluid img-card mediumsize">' +
                        '</div>' +
                        '<div class="col-md-8">' +
                        '<small class="ctosca">Total</small>' +
                        '<h3 class="cteal"> Rp  ' + rupiah(item.grand_total) + '</h3>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<small class="cteal">' + item.transaction_type + '</small>' +
                        '<h4>' + item.transaction + '</h4>' +
                        '<p class="ctosca">' + item.invoice_number + '</p>' +
                        '</div>' +
                        '<div class="col-md-12" style="text-align: right; margin-top:-1em;">' +
                        '<small class="cteal"> ' + dateTime(item.created_at) + '</small><br>' +
                        '<small lang="en" class="txt_detail_fitur h6 s12 cputih"> Status : ' + item.status_title +
                        '</small>' +
                        '</div>' +
                        '</div></div></div></div>';
                });

                $("#show_card_transaksi").html(isiui);

                $(".showin_table_trans").show();
                $("#tab_transaction_param").hide();

            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}

function show_tabel_transaksi() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_trans').dataTable().fnClearTable();
    $('#tabel_trans').dataTable().fnDestroy();

    $(".showin_table_trans").show();
    $("#tab_transaction_param").hide();

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
            url: '/subscriber/tabel_transaksi_show',
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
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                // $('#tabel_subscriber tbody').;
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

function detail_transaksi_all(dt_trans) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var trans = dt_trans.split(',');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        url: '/subscriber/detail_transaksi_subs',
        type: 'POST',
        datatype: 'JSON',
        timeout: 20000,
        data: {
            "invoice_number": trans[0],
            "payment_level": trans[1],
            "community_id": trans[2],
            "_token": token
        },
        success: function (result) {
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 5000);
            console.log(result);
            if (result.success == false) {
                ui.popup.show('error', result.message, 'Error');
                $("#modal_detail_trans").modal('hide');
            } else {

                $("#modal_detail_trans").modal('show');
                $("#invoice_trans").html(result.invoice_number);
                $("#date_trans").html(dateTime(result.created_at));
                $("#komunitas_trans").html(result.community_name);
                $("#subscriber_trans").html(result.name);
                $("#level_title_trans").html(result.level_title);
                $("#nominal_trans").html("Rp  " + rupiah(result.grand_total));
                $("#jenis_trans").html(result.transaction_type);
                $("#statusjudul_trans").html(result.status_title);
                $("#transaksi_trans").html(result.transaction);

                var uiku = '';
                if (result.data_confirmation != "") {
                    if (result.data_confirmation.file != null) {
                        $("#img_pay_confirm").attr("src", server_cdn + cekimage_cdn(result.data_confirmation.file));
                    }
                    $("#nama_confirm_trans").html(result.data_confirmation.created_by);
                    $("#date_confirm_trans").html(dateFormat(result.data_confirmation.created_at));

                    uiku = '<button type="button" class="btn btn-accent' +
                        'melengkung10px btn-sm"> Paid</button >';
                    $("#status_color").html(uiku);
                } else {
                    $("#img_pay_confirm").attr("src", "");
                    uiku = '<button type="button" class="btn btn-abu' +
                        'melengkung10px btn-sm"> Not Yet</button >';
                    $("#status_color").html(uiku);
                }


                if (result.data_verification.length != 0) {
                    if (result.data_verification.file != undefined) {
                        $("#img_pay_aprov").attr("src", server_cdn + cekimage_cdn(rresult.data_verification.file));
                    }
                    $("#name_approv_trans").html(result.data_verification.verification_by);
                    $("#date_approv_trans").html(dateFormat(result.data_verification.verification_at));

                }
            }

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Detail");
        }
    });
}
// ------------------------ END TRANSACTION MANAGEMENT SUBS -------------------------------



// -------------------------- DASHBOARD PAGE SUBSCRIBER -------------------------------

function get_dashboard_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_dashboard_news',
        type: 'POST',
        datatype: 'JSON',
        timeout: 30000,
        data: {
            "limit": 4,
            "_token": token
        },
        success: function (result) {
            console.log('data headline news');
            // console.log(result);
            if (result.success == false) {
                $("#nodata_dash_artikel").show();
                $("#idashbord_news").hide();
            } else {
                if (result != undefined) {
                    var berita = '';
                    $.each(result, function (i, item) {
                        var imge = cekimage_cdn(item.image);
                        var noimgnews = '/img/car1.png';

                        berita += '<div class="col-md-6 stretch-card grid-margin">' +
                            '<div class="card" style="height:217px;">' +
                            '<div class="imgsub-cont">' +
                            '<img src="' + server_cdn + imge + '" class="card-img-top artikeldash"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimgnews + '\';"' +
                            'style="border-radius: 8px 8px 0px 0px;"></div>' +
                            '<div class="card-body card-dashsub">' +
                            '<small class="card-text text-wrap">' + item.title +
                            '</small>' +
                            '</div>' +
                            '<div class="card-footer card-dashsub">' +
                            '<div class="row">' +
                            '<div class="col-md-8">' +
                            '<p class="card-text"><small class="text-muted">' +
                            dateTime(item.createdAt) + '</small></p>' +
                            '</div>' +
                            '<div class="col-md-4" style="text-align: right;">' +
                            '<p class="card-text"><small class="text-muted">' + item.scala + '</small> &nbsp; &nbsp;' +
                            '<a href="/subscriber/detail_news/' + item.id + '" class="btn btn-tosca btn-sm konco2"><small lang="en">See Detail</small></a></p>' +
                            '</div>' +
                            '</div>' +
                            '</div></div></div>';
                    });
                    $("#idashbord_news").html(berita);
                    $("#nodata_dash_artikel").hide();
                    $("#idashbord_news").show();
                }

            }

        },
        error: function (result) {
            $("#nodata_dash_artikel").show();
            $("#idashbord_news").hide();
            console.log("Cant Get Articles News");
        }
    });
}

function get_friends_total() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_friends_total',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                $(".total_friend").html("0");
                console.log(result);
            } else {
                $(".total_friend").html(result.total_friend);
            }
        },
        error: function (result) {
            $(".total_friend").html("0");
            // console.log(result);
            console.log("Cant Show total Friends");
        }
    });
}

function get_top_friends() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_top_friends',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                $("#topfriend_nodata").show();
                $("#isi_top_friends").hide();
            } else {
                if (result != undefined) {
                    var uishow = '';
                    var nopic = '/img/kosong.png';

                    $.each(result, function (i, item) {
                        if (item.picture != 0) {
                            var imgprofil = server_cdn + cekimage_cdn(item.picture);
                        } else {
                            var imgprofil = '/img/kosong.png';
                        }

                        uishow += '<div class="col-md-3 mgb-05">' +
                            '<img src="' + imgprofil + '" class="rounded-circle img-fluid wd-25px"' +
                            'onerror="this.onerror=null;this.src=\'' + nopic + '\';"> &nbsp;&nbsp;' +
                            '<a class="cgrey2 s14 clr-accent-color" onclick="get_friend_profile(\'' + item.user_id + '\')">' + item.full_name + '</a>' +
                            '</div>';
                    });
                    $("#topfriend_nodata").hide();
                    $("#isi_top_friends").html(uishow);
                } else {
                    $("#topfriend_nodata").show();
                    $("#isi_top_friends").hide();
                }
            }

        },
        error: function (result) {
            console.log('Cant Show Top Friends');
        }
    });
}

function get_friends_sugestion() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_friends_sugestion',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                $(".divkonco").hide();
            } else {
                if (result != undefined) {
                    var nofoto = '/img/kosong.png';
                    var isiui = '';
                    var jumlah = 0;
                    $.each(result, function (i, item) {
                        jumlah++;
                        news_id = parseInt(item.id);
                        // var headpic = server_cdn + cekimage_cdn(item.image);

                        isiui += '<div class="card konco" id="' + item.user_id + '">' +
                            '<div class="card-body color">' +
                            '<div class="close_konco">' +
                            '<button type="button" class="close cgrey2" aria-label="Close"' +
                            'onclick="hide_friendsugest(\'' + item.user_id + "<>" + jumlah + '\')">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>' +
                            '<center>' +
                            '<img src="' + server_cdn + cekimage_cdn(item.picture) + '" class="rounded-circle img-fluid mb-2 konco"' +
                            'onerror = "this.onerror=null;this.src=\'' + nofoto + '\';"><br>' +
                            '<a class="cgrey2 s13 clr-accent-color" onclick="get_friend_profile(\'' + item.user_id + '\')">' + item.full_name + '</a>' +
                            '<button type="button" onclick="add_friend_suggest_subs(\'' + item.user_id + '\')" class="btn btn-tosca btn-sm konco">' +
                            '<i class="mdi mdi-account-plus"></i> &nbsp; Add' +
                            '</button>' +
                            '<center>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $(".divkonco").show();
                    $("#div_friendsugest").html(isiui);
                }

            }
        },
        error: function (result) {
            // console.log(result);
            console.log("Cant Show Friend Suggest");
            $(".divkonco").hide();
        }
    });
}

function hide_friendsugest(dtcard) {
    var dt = dtcard.split('<>');
    $("#" + dt[0]).hide();
    if (dt[1] == 1) {
        $(".divkonco").fadeOut("slow").hide();
    }
}

function get_last_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_last_news',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "limit": 5,
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                $("#nodata_last_news").show();
                $("#isi_last_news").hide();
                // console.log(result);
            } else {
                var newsui = '';
                $.each(result, function (i, item) {
                    newsui += '<li>' +
                        '<a href="/subscriber/detail_news/' + item.id + '">' +
                        '<small class="cblue">' + dateTime(item.createdAt) + '</small><br>' +
                        '<small class="cgrey s13">' + item.title + '</small><br>' +
                        '</li>';
                });
                $("#isi_last_news").html(newsui);
                $("#nodata_last_news").hide();
                $("#isi_last_news").show();
            }

        },
        error: function (result) {
            $("#nodata_last_news").show();
            $("#isi_last_news").hide();
            // console.log(result);
            console.log("Cant Show Latest News");
        }
    });
}

function get_love_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_love_news',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "limit": 5,
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            var noimg = '/img/fitur.png';
            if (result.success == false) {
                $("#nodata_love_news").show();
                $("#isi_love_news").hide();
            } else {
                if (result != undefined) {

                    var loveui = '';
                    $.each(result, function (i, item) {
                        loveui += '<div class="row" style="margin-bottom:-0.5em;"><div class="col-md-2 pd-5px">' +
                            '<center><img src="http://' + server_cdn + cekimage_cdn(item.image) + '" class="rounded-circle img-fluid mb-2 lovenews"' +
                            'onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>' +
                            '</div>' +
                            '<div class="col-md-10 pd-5px">' +
                            '<a href="/subscriber/detail_news/' + item.id + '">' +
                            '<small class="cblue s12">' + dateTime(item.createdAt) + '</small></a>' +
                            '<br><small class="cgrey2 s12">' + item.title + '</small><br>' +
                            '</div></div>';
                    });
                    $("#isi_love_news").html(loveui);
                    $("#nodata_love_news").hide();
                    $("#isi_love_news").show();
                } else {
                    $("#nodata_love_news").show();
                    $("#isi_love_news").hide();
                }

            }

        },
        error: function (result) {
            $("#nodata_love_news").show();
            $("#isi_love_news").hide();
            // console.log(result);
            console.log("Cant Show love news");
        }
    });
}

function get_topvisit_news() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_topvisit_news',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "limit": 5,
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                $("#nodata_topvisit_news").show();
                $("#isi_topvisit_news").hide();
            } else {
                if (result != undefined) {
                    var newsui = '';
                    $.each(result, function (i, item) {
                        newsui += '<li>' +
                            '<a href="/subscriber/detail_news/' + item.id + '">' +
                            '<small class="cblue">' + dateTime(item.createdAt) + '</small><br>' +
                            '<small class="cgrey s13">' + item.title + '</small><br>' +
                            '</li>';
                    });
                    $("#isi_topvisit_news").html(newsui);
                    $("#nodata_topvisit_news").hide();
                    $("#isi_topvisit_news").show();
                } else {
                    $("#nodata_topvisit_news").show();
                    $("#isi_topvisit_news").hide();
                }
            }
        },
        error: function (result) {
            console.log("Cant Show top visit news");
            $("#nodata_topvisit_news").show();
            $("#isi_topvisit_news").hide();
        }
    });
}

function get_top_player() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_top_player',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "limit": 4,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                $("#topplayer_nodata").show();
                $("#isi_top_player").hide();
                console.log(result);
            }

            if (result.length == 0) {
                $("#topplayer_nodata").show();
                $("#isi_top_player").hide();
            } else {
                var iuplyr = '';
                var nopic = '';
                var gen = '';
                $.each(result, function (i, item) {
                    if (item.gender == "putri") {
                        nopic = '/img/pl-girl.png';
                        gen = 'Putri';
                    } else {
                        nopic = '/img/pl-boy.png';
                        gen = 'Putra';
                    }
                    iuplyr += '<div class="col-md-6 mgt-half">' +
                        '<div class="row pad-5px">' +
                        '<div class="col-md-2 pad-5px dikanan">' +
                        '<img src="' + server_cdn + item.photo + '" class="rounded-circle img-fluid wd-25px"' +
                        'onerror="this.onerror=null;this.src=\'' + nopic + '\';">' +
                        '</div>' +
                        '<div class="col-md-10 pad-5px">' +
                        '<small class="cgrey2">' + item.name + '</small>' +
                        '<small class="cblue"> &nbsp; (' + gen + ')</small><br>' +
                        '<small class="clight">Club : ' + item.club.name + '</small>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });
                $("#isi_top_player").html(iuplyr);
                $("#topplayer_nodata").hide();
                $("#isi_top_player").show();

            }
        },
        error: function (result) {
            $("#topplayer_nodata").show();
            $("#isi_top_player").hide();
            console.log("Cant Show top Player");
        }
    });
}

function get_top_visit_club() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_top_visit_club',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "limit": 4,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                console.log(result);
                $("#topclubvisit_nodata").show();
                $("#isi_top_visit_club").hide();
            }

            if (result.length == 0) {
                $("#topclubvisit_nodata").show();
                $("#isi_top_visit_club").hide();
            }

        },
        error: function (result) {
            $("#topclubvisit_nodata").show();
            $("#isi_top_visit_club").hide();
            console.log("Cant Show Top Club Visit");
        }
    });
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
    $("#modal_initial_membership").modal('show');
});

// ------------------------ END DASHBOARD PAGE SUBSCRIBER ------------------------------


// ------------------- PROFILE MANAGEMRNT -----------------
function isInArray(value, array) {
    return array.indexOf(value) > -1;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


// -------------------------- NOTIFICATION MANAGEMENT SUBS ----------------------------
function show_card_notification() {
    $('#modal_filter_notif_subs').modal('hide');
    var filter = $("#filter_read").val();

    if (filter != "") {
        var read = filter;
        var limit = 000;
    } else {
        var read = "1";
        var limit = 10;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_list_notif_management',
        type: 'POST',
        dataSrc: '',
        data: {
            "read_status": read, //1:notread 2:read
            "limit": limit,
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                $("#isi_card_notif").hide();
                $("#nodata_card_notif").show();
            } else {
                if (result.length != 0) {
                    var isiui = '';
                    $.each(result, function (i, item) {
                        var inidt = [item.id, item.level_status, item.community_id];
                        isiui += '<div class="col-md-4 stretch-card grid-margin">' +
                            '<div class="card sumari bg-gradient-kuning">' +
                            '<div class="card-body sumari">' +
                            '<div class="row">' +
                            '<div class="col-9"></div>' +
                            '<div class="col">' +
                            '<i class="mdi mdi-bell-outline mdi-24px float-right top-ico ctosca"></i>' +
                            '</div>' +
                            '</div>' +

                            '<div class="row">' +
                            '<div class="col-md-12">' +
                            '<span class="ctosca s15 tebal" lang="en">' + item.title + '</span>  &nbsp;' +
                            '<span class="cteal s13">(' + item.notification_sub_type_title + ')</span><br>' +
                            '<small class="cgrey2 mt-2">from : </small><br>' +
                            '<small class="cgrey tebal">' + item.sender_level_title + '</small> &nbsp;&nbsp;' +
                            '/ <small class="cgrey2">' + item.created_by_title + '</small><br>' +
                            '<small class="clight mt-2 tebal">' + dateTime(item.created_at) + '</small><br>' +
                            '</div></div>' +
                            '<div class="row mt-3 mb-4">' +
                            '<div class="col-md-7"><small class="cteal">' + item.read_status_title + '</small></div>' +
                            '<div class="col-md-5" style="text-align:right;">' +
                            '<a type="button" class="btn btn-accent btn-sm konco2"' +
                            'onclick="detail_notif_subs(\'' + inidt + '\')">' +
                            '<small class="cwhite" lang="en"><i class="mdi mdi-eye btn-icon-prepend"></i> &nbsp; Detail</small></a>' +
                            '</div>' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $("#isi_card_notif").html(isiui);
                    $("#nodata_card_notif").hide();

                }
            }
        },
        error: function (result) {
            console.log(result);
            $("#isi_card_notif").hide();
            $("#nodata_card_notif").show();
        }
    });
}


$("#btn_generate_notif_subs").click(function () {
    show_card_notification();
});



function get_list_setting_notif_subs() {
    var namakom = $(".community_name").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/get_list_setting_notif_subs',
        type: 'POST',
        datatype: 'JSON',
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
                            '<div class="form-check set_mod" >' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiotrue' + item.id + '" value="1" ' + one + '>' +
                            'True <i class="input-helper"></i></label>' +
                            '</div>' +
                            '<div class="form-check set_mod">' +
                            '<label class="form-check-label">' +
                            '<input type="radio" class="form-check-input" name="optionsRadios' + item.id + '" id="radiofalse' + item.id + '" value="2" ' + two + '>' +
                            'False <i class="input-helper"></i></label>' +
                            '</div>' +
                            '</div>';
                    }

                    uiku += ' <div class="row style="margin-bottom:1.5em;">' +
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
    if (comm == null || usertipe == null) {
        $("#status_notif").attr("disabled", "disabled");
        swal("Cant Null", "User Type and Community cant be null", "warning");
    } else {
        $("#status_notif").removeAttr("disabled", "disabled");
    }
}


var switchStatus_notif = false;
$("#status_notif").on('change', function () {
    if ($(this).is(':checked')) {
        switchStatus_notif = $(this).is(':checked');
        $("#hide_user_notif").fadeIn('fast');
        cek_param_list_user();
        $("#idstatus_notif").val("1");
    }
    else {
        switchStatus_notif = $(this).is(':checked');
        $("#hide_user_notif").fadeOut('fast');
        cek_param_list_user();
        $("#idstatus_notif").val("2");
    }
});

function detail_notif_subs(dtku) {
    var dtnya = dtku.split(',');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/subscriber/detail_notif_subs',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "notification_id": dtnya[0],
            "level_status": dtnya[1],
            "community_id": dtnya[2],
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

// ----------- xx -------------- NOTIFICATION MANAGEMENT SUBS ------------- xx --------------

