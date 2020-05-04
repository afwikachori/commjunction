// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"

var server_cdn = '';
// LANG -EN-ID
var lang = new Lang();
lang.dynamic('id', '/js/langpack/id.json');
lang.init({
    defaultLang:'en'
});

// (function () {
//     window.ybug_settings = { "id": "ftwv8rsw7kbwf9t2bkvk" };
//     var ybug = document.createElement('script'); ybug.type = 'text/javascript'; ybug.async = true;
//     ybug.src = 'https://widget.ybug.io/button/' + window.ybug_settings.id + '.js';
//     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ybug, s);
// })();



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
                if (user.status == 1) { //first-login
                    get_initial_feature(result.feature); //isi data
                    $("#initial1").modal('show');
                    $("#comm_status_admin").html("Verified - First Login");
                    $(".statuscomm").html('Newbie');
                    $(".statuscomm").addClass('badge-warning');
                } else if (user.status == 2) {
                    $("#comm_status_admin").html("Community Active");
                    $(".statuscomm").html('Active');
                    $(".statuscomm").addClass('badge-success');
                } else { //status=0 belum aktif
                    $(".statuscomm").html('Deactive');
                    $(".statuscomm").addClass('badge-danger');
                    swal("Your account not verified, please wait system or call Commjuction's Administrator", "Inactive", "error");
                    window.location.href = "/admin";
                }

                //cek membership pricing free or not
                if (user.community_membership_type == 1){
                    // alert('free');
                    $(".input_pricemember").hide();
                    $("#harga_member").val(0);
                }else{
                    // alert('paid');
                    $(".input_pricemember").show();
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
        var imgk = cekimage_cdn(item.logo);
        html +=
            '<div class="col-md-6 mgku-1">' +
            '<div class="media">' +
        '<img src="' + server_cdn + imgk + '" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">' +
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
    if(img != null && img != undefined){
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
    }else{
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
