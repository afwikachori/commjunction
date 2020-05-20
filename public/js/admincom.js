// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"

var server_cdn = '';
// LANG -EN-ID
var lang = new Lang();
lang.dynamic('id', '/js/langpack/id.json');
lang.init({
    defaultLang: 'en'
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
            "_token" : token
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
        data : {
            "_token" : token
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
    //   alert("0 ");
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

}



//DASHBOARD
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
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [dt.x],
            datasets: [{
                label: dt.x,
                backgroundColor: 'rgb(255, 255, 230)',
                borderColor: 'rgb(0, 184, 230)',
                data: [dt.y]
            }]
        },

        // Configuration options go here
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
        data : {
            "_token" : token
        },
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
        data : {
            "_token" : token
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
            data : {
                "_token" : token
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
        data : {
            "_token" : token
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
} //endfunction

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
            "_token" : token
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
