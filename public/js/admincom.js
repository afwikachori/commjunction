// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"
var server_cdn = $(".server_cdn").val();
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
    session_admin_logged();
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

            setTimeout(function () {
                ui.popup.hideLoader();
            }, 8000);

            // get_result_setup_comsetting();

            var user = result.user;
            if (result != "") {
                $(".username_komunitas").html(user.user_name);
                $(".phone_komunitas").html(user.notelp);
                $(".email_komunitas").html(user.email);

                if (user.community_logo != undefined || user.community_logo != null) {
                    var oic = user.community_logo;
                    var cekone = oic.slice(0, 1);
                    var imgkom = '';
                    if (cekone != "/") {
                        imgkom = "/" + user.community_logo;
                    } else {
                        imgkom = user.community_logo;
                    }
                    $(".logo_komunitas").attr("src", server_cdn + imgkom);
                }

                if (user.picture != undefined || user.picture != null) {
                    var oic = user.picture;
                    var cekone = oic.slice(0, 1);
                    var picsubs = '';
                    if (cekone != "/") {
                        picsubs = "/" + user.picture;
                    } else {
                        picsubs = user.picture;
                    }

                    $(".foto_profil_admin").attr("src", server_cdn + picsubs);
                    $("#view_edit_user").attr("src", server_cdn + picsubs);
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
                $(".nama_komunitas").html(user.community_name);

                //Notif management
                $("#komunitas_notif").val(user.community_id);

                //edit-profil comm
                $("#edit_namacom").val(user.community_name);
                $("#edit_deskripsicom").val(user.community_description);
                $("#edit_idcom").val(user.user_id);
                $(".logo_komunitas").attr("src", server_cdn + user.community_logo);

                //initial login
                if (user.status == 1) { //first-login
                    get_initial_feature(result.feature); //isi data
                    $("#initial1").modal('show');
                    $("#comm_status_admin").html("Verified - First Login");
                    $(".statuscomm").html('Newbie');
                    $(".statuscomm").addClass('badge-warning');
                } else if (user.status == 2) {
                    $("#comm_status_admin").html("Active");
                    $(".statuscomm").html('Active');
                    $(".statuscomm").addClass('badge-success');
                } else { //status=0 belum aktif
                    $(".statuscomm").html('Deactive');
                    $(".statuscomm").addClass('badge-danger');
                    swal("Your account not verified, please wait system or call Commjuction's Administrator", "Inactive", "error");
                    window.location.href = "/admin";
                }


            }
        },
        error: function (result) {
            console.log("Cant Reach Session Logged Admin Community Dashboard");
        }
    });
}


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
                if (tipeform.data != null || tipeform.data != "" || tipeform.data != 0) {
                    $('#optionsRadios').val(tipeform.data).attr("selected", "selected");
                    if (tipeform.ready == true) {
                        $('#optionsRadios').attr("disabled", "disabled");
                    }
                }


                var portal = result[1];
                if (portal.data.headline_text != null || portal.data.headline_text != "" || portal.data.headline_text != 0) {
                    $("#headline").val(portal.data.headline_text);
                    $("#description_custom").val(portal.data.description);

                }

                if (portal.data.image != undefined || portal.data.image != null || portal.data.image != 0) {
                    if (oic == undefined || oic == "undefined"){
                      oic = "";
                    }else{
                        var oic = portal.data.image;
                    }
                    var cekone = oic.slice(0, 1);
                    var imgportal = '';
                    if (cekone != "/") {
                        imgportal = "/" + portal.data.image;
                    } else {
                        imgportal = portal.data.image;
                    }
                    $(".img_portal").attr("src", server_cdn + imgportal);
                }
                if (portal.ready == true) {
                    $('#headline').attr("disabled", "disabled");
                    $('#description_custom').attr("disabled", "disabled");
                    $("#up_img_portal").hide();
                    $(".img_portal").show();
                }

                var domain = result[2];
                if (domain.data.subdomain != null || domain.data.subdomain == "") {
                    $('#subdomain').val(domain.data.subdomain);
                    if (domain.ready == true) {
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

function LogoutAdmin() {
    // $("#btn_logout_all").click(function () {

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
        timeout: 30000,
        success: function (result) {
            if (result == "sukses") {
                location.href = '/admin';
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
    var arr = [];
    arr.push(datafitur);

    var html = '';
    $.each(arr, function (i, item) {
        // console.log(item.title);
        html +=
            '<div class="col-md-6 mgku-1">' +
            '<div class="media">' +
            '<img src="' + server_cdn + item.logo + '" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">' +
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
    var modal = document.getElementById("mdl-img-click");
    var img = document.getElementById(img.id);
    var modalImg = document.getElementById("mdl-img-view");

    img.onclick = function () {
        $('#mdl-img-click').modal('show');
        modalImg.src = this.src;
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
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [day, month, year].join('/');
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
