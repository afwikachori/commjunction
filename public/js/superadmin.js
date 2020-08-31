// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"
// LANG -EN-ID
// var lang = new Lang();
//       lang.dynamic('id', '/js/langpack/id.json');
//       lang.init({
//           defaultLang: 'en'
//       });
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
        },
        hideLoader: function hideLoader() {
            $("#modal_ajax").modal('hide');
        },
    }
};

$(document).ready(function () {
    server_cdn = $("#server_cdn").val();
    console.log(server_cdn);
    session_logged_superadmin();
    init_ready();
});


// (function () {
//     window.ybug_settings = { "id": "ftwv8rsw7kbwf9t2bkvk" };
//     var ybug = document.createElement('script'); ybug.type = 'text/javascript'; ybug.async = true;
//     ybug.src = 'https://widget.ybug.io/button/' + window.ybug_settings.id + '.js';
//     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ybug, s);
// })();


// SESSION LOGIN SUPEADMIN
function session_logged_superadmin() {
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
            ui.popup.show('error', status, 'Error');
            ui.popup.hideLoader();
        },
        complete: function complete() {
            ui.popup.hideLoader();
        }
    });
    $.ajax({
        url: '/session_logged_superadmin',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {

            console.log(result.access_token);
            console.log(result);
            if (result != "") {
                $(".logged_fullname").text(result.user.full_name);
            }

            var user = result.user;

            $("#name_super").val(user.full_name);
            $("#username_super").val(user.user_name);
            $("#phone_super").val(user.notelp);
            $("#email_super").val(user.email);
            if (user.alamat != null) {
                $("#alamat_super").text(user.alamat);
            }

            var imguser = server_cdn + cekimage_cdn(user.picture);
            // console.log(imguser);
            if (user.picture != null) {
                $("#foto_profil_superadmin").attr("src", imguser);
                $("#view_edit_user").attr("src", imguser);
            }

            setTimeout(function () {
                ui.popup.hideLoader();
            }, 4000);

        },
        error: function (result) {
            console.log("Cant Reach Session Logged Admin Comjuction");
        }
    });
}


//tab-line
$(".tabbable-line li a").click(function () {
    $(".tabbable-line li").removeClass('active');
    $(this).parent().addClass('active');
});


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


//IMAGE FILENAME INPUT
// show filename di inputfile
function filenameImg(input) {
    var fileName = $(input).val();
    if (fileName.length > 30) {
        var fileNameFst = fileName.substring(0, 30);
        $(input).next('.custom-file-label').html(fileNameFst + "...");
    } else {
        $(input).next('.custom-file-label').html(fileName);
    }
}




function showPassNew() {
    var a = document.getElementById("new_pass_super");
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}


// IMAGE ERROR
function errorImg() {
    $('.rounded-circle').attr('src', '/img/noimg.jpg');
}


// IMAGE BROWSER EDIT PROFIL
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

//FORMAT DATE
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

function dateFormat(tgl) {
    var d = new Date(tgl);

    dformat = [d.getDate(), d.getMonth() + 1,
    d.getFullYear()].join('/') + '<br>' +
        [d.getHours(),
        d.getMinutes(),
        d.getSeconds()].join(':');

    return dformat;
}


// VALIDASI FORM SUPERADMIN - ADD User
$('#name_superadmin').on('keyup', function () {
    var letters = /^[a-zA-Z\s]*$/;
    if (this.value == "") {
        $("#name_superadmin").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_namesuper").hide();
    } else if (this.value.match(letters) && this.value.length >= 3) {
        $("#name_superadmin").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_namesuper").hide();
    } else {
        $("#name_superadmin").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_namesuper").html("At least 3 character and Only Letters!").show();
    }
});


$('#phone_super').on('keyup', function () {
    if (this.value == "") {
        $("#phone_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_phonesuper").hide();
    } else if (!isNaN(this.value) && this.value.length >= 10) {
        $("#phone_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_phonesuper").hide();
    } else {
        $("#phone_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_phonesuper").html("At least 10 Numbers").show();
    }
});


$('#email_super').on('keyup', function () {
    console.log(this.value);
    if (this.value == "") {
        $("#email_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_emailsuper").hide();
    } else if (IsEmail_valid(this.value)) {
        $("#email_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_emailsuper").hide();
    } else {
        $("#email_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_emailsuper").html("Include '@' in format email address!").show();
    }
});


$('#division_super').on('keyup', function () {
    var letters = /^[a-zA-Z\s]*$/;
    if (this.value == "") {
        $("#division_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_divisisuper").hide();
    } else if (this.value.match(letters)) {
        $("#division_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_divisisuper").hide();
    } else {
        $("#division_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_divisisuper").html("Only Letters Allowed").show();
    }
});


$('#password_super').on('keyup', function () {
    var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
    if (this.value == "") {
        $("#password_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_passuper").hide();
    } else if (this.value.match(alpanumeric) && this.value.length >= 8) {
        $("#password_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_passuper").hide();
        $(".error_regis2").hide();
    } else {
        $("#password_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_passuper").html("Mininum 8 character contain Numbers and Letters!").show();
    }
});


$('#password_confirm').on('keyup', function () {
    var pass = $('#password_super').val();
    if (this.value == "") {
        $("#password_confirm").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_cfpass").hide();
    } else if (this.value == pass) {
        $("#password_confirm").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_cfpass").hide();
    } else {
        $("#password_confirm").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_cfpass").html("Password & Confirm Password didnt match!").show();
    }
});


$('#username_super').on('keyup', function () {
    var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/;
    if (this.value == "") {
        $("#username_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_usernamesuper").hide();
    } else if (this.value.match(alpanumeric) && this.value.length >= 6) {
        $("#username_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_usernamesuper").hide();
        cekusername_superadmin(this.value); //cek ajax to backend
    } else {
        $("#username_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_usernamesuper").html("Mininum 6 character contain Numbers and Letters!").show();
    }
});


function cekusername_superadmin(input) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/cekusername_admin',
        data: { 'user_name': input },
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            console.log(result.success + " - " + result.message);
            if (result.success == true) {
                $("#username_super").removeClass("is-invalid").addClass("is-valid");
                $("#pesan_usernamesuper").hide();
            } else {
                $("#username_super").removeClass("is-valid").addClass("is-invalid");
                $("#pesan_usernamesuper").hide();
            }
        },
        error: function (result) {
            console.log("Cant not check unique username");

        }
    });

}


$('#pass_super').on('keyup', function () {
    var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
    if (this.value == "") {
        $("#pass_super").removeClass("is-valid").removeClass("is-invalid");
        $("#pesan_paswotsuper").hide();
    } else if (this.value.match(alpanumeric) && this.value.length >= 8) {
        $("#pass_super").removeClass("is-invalid").addClass("is-valid");
        $("#pesan_paswotsuper").hide();
    } else {
        $("#pass_super").removeClass("is-valid").addClass("is-invalid");
        $("#pesan_paswotsuper").html("Mininum 8 character contain Numbers and Letters!").show();
    }
});


$('#fileup').on('change', function () {
    if (this.value != "") {
        $("#btn_verifyreq").removeAttr("disabled");
        $("#pesan_fileup").hide();
    } else {
        $("#pesan_fileup").html("Please, Choose image first").show();

    }
});

function clickImage(img) {
    // $('#mdl-img-click').modal('show');
    var modal = document.getElementById("mdl-img-click");
    var img = document.getElementById(img.id);
    var modalImg = document.getElementById("mdl-img-view");

    img.onclick = function () {
        $('#mdl-img-click').modal('show');
        modalImg.src = this.src;
    }

    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("closeq")[0];

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }
}


function formatDatetime(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return date.getMonth() + 1 + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
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


// ---------------------------- DASHBOARD SUPERADMIN -------------------------------

function get_dashboard_superadmin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/get_dashboard_superadmin',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/superadmin';
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {

                chart_transaction(result.chart_transaction);
                chart_activity(result.chart_activity);

                var sum_subs = 0;
                $.each(result.total_subscriber, function (i, item) {
                    sum_subs += item.total_subscriber;
                });

                var sum_trans_count = 0;
                $.each(result.total_transaction_count, function (i, item) {
                    sum_trans_count += item.count;
                });

                var sum_trans_num = 0;
                $.each(result.total_transaction_number, function (i, item) {
                    sum_trans_num += item.jumlah;
                });


                $(".total_komunitas").html(result.total_community + " Communities");
                $(".total_subs").html(sum_subs + " Subscriber");
                $(".total_transaction_count").html(sum_trans_count + " Transaction");
                $(".total_trans_number").html(sum_trans_num + " Transaction");
                $("#isi_pending_regis").html(result.pending_registration[0].length);
                var topcom = result.top_community[0];
                $("#isi_top_comm").html(topcom[0].total_subscriber);
                $("#isi_nama_top_comm").html("Community Name : &nbsp;" + topcom[0].community);

                var toptrans = result.top_transaction[0];
                $("#isi_top_trans_count").html(toptrans[0].count);
                $("#isi_top_trans_comm").html("Community Name : &nbsp;" + toptrans[0].community);

                var topkom = '';
                $.each(result.top_community[0], function (i, item) {
                    topkom += '<li>' +
                        '<span class="cgrey s14">' + item.community + '</span>&nbsp;<i class="mdi mdi-arrow-right clight"></i>&nbsp;' +
                        '<span class="cblue s18">' + item.total_subscriber + '</span> <small class="cblue"> Subscriber</small><br>' +
                        '</li>';
                });
                $("#isi_listop_community").html(topkom);


                var toptrans = '';
                $.each(result.top_transaction[0], function (i, item) {
                    toptrans += '<li>' +
                        '<span class="cgrey s14">' + item.community + '</span>&nbsp; : &nbsp;' +
                        '<span class="cblue s18">' + item.count + '</span> <small class="cblue"> / Count</small><br>' +
                        '</li>';
                });
                $("#isi_listop_trans").html(toptrans);
            }
        },
        error: function (result) {
            ui.popup.show('warning', 'Get Dashboard', 'Warning');
            console.log(result);
        }
    });
}


function chart_activity(data) {
    // console.log(data);
    var ex = [];
    var ye = [];
    var colr = [];

    $.each(data, function (i, item) {
        ex.push(item.x);
        ye.push(item.y);
        colr.push(getRandomColor());
    });
    var ctx = document.getElementById('myChartActivity_superadmin').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [ex],
            datasets: [{
                label: 'Trasaction',
                backgroundColor: colr,
                borderColor: colr,
                data: [ye]
            }]
        },

        // Configuration options go here
        options: {}
    });
}


function init_ready() {
    if ($("#page_dashboard_super").length != 0) {
        get_dashboard_superadmin();
    }

    if ($("#page_verify_community").length != 0) {
        tabel_req_verify();
    }

    if ($("#page_subscriber_management").length != 0) {
        get_list_komunitas_superadmin();
    }

    if ($("#page_module_management").length != 0) {
        get_module_all_superadmin();
        addRowSubModule();
        var readURLuser = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#view_img_module').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file_img_module").on('change', function () {
            readURLuser(this);
        });

        $("#browse_img_module").on('click', function () {
            $("#file_img_module").click();
        });
    }


    if ($("#page_usertype_management").length != 0) {
        tabel_usertype_management();
        get_listfitur_usertype_ceklist();
        cek_error_addusertype();

        $(document).on('click', '.tree label', function (e) {
            $(this).next('ul').fadeToggle();
            e.stopPropagation();
        });

        $(document).on('change', '.tree input[type=checkbox]', function (e) {
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
            e.stopPropagation();
        });

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
    }

    if ($("#page_transaction_management").length != 0) {
        get_list_komunitas_trans();
        get_list_transaction_tipe();
        $("#reset_tbl_trans").click(function () {
            resetparam_trans();
        });
    }

    if ($("#page_user_management_super").length != 0) {
        get_user_tipe_manage();
        tabel_user_management();
    }

    if ($("#page_log_management_super").length != 0) {
        get_list_komunitas_log_manage();
    }


    if ($("#page_report_management").length != 0) {
        get_list_transaction_type_super();
        get_list_komunitas_report();
        get_list_fitur_super();
    }

    if ($("#page_pricing_management_super").length != 0) {
        tabel_all_pricing_super();
        get_list_fitur_pricing();
    }

    if ($("#page_module_report_management").length != 0) {
        get_list_community_modulereport();
        get_list_fitur_modulereport();
        $("#showin_subfitur").hide();
    }

    if ($("#page_payment_management_super").length != 0) {
        tabel_payment_all_super();
        get_list_bank_name_subpay();
        addRowDinamic_paysuper();
        var readURLpay = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#view_img_subpay').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file_img_subpay").on('change', function () {
            readURLpay(this);
        });
        $("#browse_img_subpay").on('click', function () {
            $("#file_img_subpay").click();
        });


        var readURLpayEdit = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#view_img_subpay_edit').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file_img_subpay_edit").on('change', function () {
            readURLpayEdit(this);
        });
        $("#browse_img_subpay_edit").on('click', function () {
            $("#file_img_subpay_edit").click();
        });

    }

    if ($("#page_notification_super").length != 0) {
        get_list_komunitas_notifsuper();
    }

    if ($("#page_inbox_management_super").length != 0) {
        get_list_komunitas_inbox();
    }


    if ($("#page_support_inquirylog").length != 0) {
        get_list_komunitas_support($('#status_komunitas').val());
    }


    if ($("#page_support_inquiry_spesific").length != 0) {
        if ($('#status_komunitas').val() == "all") {
            get_list_komunitas_support_specific("all");
        }
    }

    // if ($("#").length != 0) {

    // }

}

function chart_transaction(data) {
    // console.log(data);
    var ex = [];
    var ye = [];
    var colr = [];

    $.each(data, function (i, item) {
        ex.push(item.x);
        ye.push(item.y);
        colr.push(getRandomColor());
    });
    var ctx = document.getElementById('myChartTransaction_superadmin').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [ex],
            datasets: [{
                label: 'Trasaction',
                backgroundColor: colr,
                borderColor: colr,
                data: [ye]
            }]
        },

        // Configuration options go here
        options: {}
    });
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
// --------------------------- END DASHBOARD SUPERADMIN ------------------------------





// -------------------------- VERIFY NEW COMMUNITY ------------------------------
function tabel_req_verify() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_verify_superadmin').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/list_req_admincomm',
            type: 'POST',
            dataSrc: '',
            data: {
                "_token": token
            },
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_verify_superadmin tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'invoice_number' },
            { mData: 'nama' },
            { mData: 'payment_bank_name' },
            {
                mData: 'nominal',
                render: function (data, type, row, meta) {
                    return "Rp " + rupiah(data);
                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'file_customer',
                render: function (data, type, row, meta) {
                    var noimg = '/img/noimg.jpg'
                    var pic = server_cdn + cekimage_cdn(data);
                    return '<center><img src="' + pic + '" onclick="clickImage(this)" id="imgprev' + meta.row + '" class="img-mini zoom rounded-circle" onerror = "this.onerror=null;this.src=\'' + noimg + '\';"></center>';
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
    $('#tabel_verify_superadmin tbody').on('click', 'button', function () {
        var data = tabel.row($(this).parents('tr')).data();

        $('input[name="invoice_num"]').val(data.invoice_number);
        $("#modal_verify_admincom").modal('show');
        $("#btn_verifyreq").attr("disabled", true);

    });

}


function verify_reqadmin(invoice_num) {
    // $("#invoice_num").val(invoice_num);
    $('input[name="invoice_num"]').val(invoice_num);
    $("#modal_verify_admincom").modal('show');
    $("#btn_verifyreq").attr("disabled", true);
}



function show_pass_verify() {
    var a = document.getElementById("pass_super");
    if (a.type == "password") {
        a.type = "text";
    } else {
        a.type = "password";
    }
}
// ------------------ END VERIFY NEW COMMUNITY -------------------------




// ---------------------- SUBSCRIBER MANAGEMENT SUPER ---------------------------
function get_list_komunitas_superadmin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/tabel_subs_komunitas_super',
        type: 'POST',
        dataSrc: '',
        data: {
            "_token": token
        },
        timeout: 30000,
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_komunitas_superadmin();
                }
            } else {
                $('#komunitas_list').empty();
                $('#komunitas_list').append("<option selected disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_list').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_list").html($('#komunitas_list option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#komunitas_list").get(0).selectedIndex = 0;
                const OldSubs1 = "{{old('komunitas_list')}}";
                if (OldSubs1 !== '') {
                    $('#komunitas_list').val(OldSubs1);
                }
                // ______________________________
                $('#komunitas_list2').empty();
                $('#komunitas_list2').append("<option value='null'> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_list2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_list2").html($('#komunitas_list2 option').sort(function (x, y) {
                    return $(y).val() < $(x).val() ? -1 : 1;
                }));

                $("#komunitas_list2").get(0).selectedIndex = 0;
                const OldSubs2 = "{{old('komunitas_list2')}}";
                if (OldSubs2 !== '') {
                    $('#komunitas_list2').val(OldSubs2);
                }
            }
        },
        error: function (result) {
            ui.popup.show('Warning', 'Get list community', 'Warning');
        }
    });
}

$('#komunitas_list').change(function () {
    var item = $(this);
    var idkom = item.val();
    tabel_subscriber_commjuction(idkom);
});

$('#komunitas_list2').change(function () {
    var item = $(this);
    var idkom = item.val();
    tabel_subs_pending_super(idkom);
});


function tabel_subscriber_commjuction(idkomunitas) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_show_subs_hide').show();
    // $('#tabel_show_subs').dataTable().fnClearTable();
    // $('#tabel_show_subs').dataTable().fnDestroy();


    $('#tabel_show_subs').DataTable().clear().destroy();
    $('#tabel_show_subs').empty();

    var thead = '<thead><tr>' +
        '<th><b>ID Subscriber</b></th>' +
        '<th><b>Subscriber Name</b></th>' +
        '<th><b>Membership</b></th>' +
        '<th><b>Join Date</b></th>' +
        '<th><b>Status</b></th>' +
        '<th><b>Action</b></th>' +
        '</tr></thead>';

    $('#tabel_show_subs').html(thead);

    var tabel = $('#tabel_show_subs').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_subscriber_comm_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": idkomunitas,
                "_token": token
            }, timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5</td></tr>';
                $('#tabel_show_subs tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },

        columns: [
            { mData: 'user_id' },
            { mData: 'full_name' },
            {
                mData: 'membership',
                render: function (data, type, row, meta) {
                    if (data == null) {
                        return '<span class="clight">Tidak Ada<span>';
                    } else {
                        return data.membership;
                    }

                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'status',
                render: function (data, type, row, meta) {
                    var stat = '';
                    if (data == 0) {
                        var stat = 'Waiting Approval';
                    } else if (data == 1) {
                        stat = 'Approved';
                    } else if (data == 2) {
                        stat = 'Pending Membership';
                    } else if (data == 3) {
                        stat = 'Active';
                    } else {
                        stat = 'Nonactive';
                    }
                    return stat;

                }
            },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnshow">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnshow"><i class="mdi mdi-eye"></i></button>',
                    "targets": -1
                }
            ],

    });
    $("#modal_generate_komunitas").modal('hide');

    //DETAIL USERTYPE FROM DATATABLE
    $('#tabel_show_subs tbody').on('click', 'button.btnshow', function (e) {

        var rownya = $(this).parents('li').length ?
            $(this).parents('li') :
            $(this).parents('tr');
        var data = tabel.row(rownya).data();
        // var data = tabel.row($(this).parents('tr')).data();
        console.log(data);
        var stat = '';
        if (data.status == 0) {
            var stat = 'Waiting Approval';
        } else if (data.status == 1) {
            stat = 'Approved';
        } else if (data.status == 2) {
            stat = 'Pending Membership';
        } else if (data.status == 3) {
            stat = 'Active';
        } else {
            stat = 'Nonactive';
        }

        $("#detail_userid").html(data.user_id);
        $("#detail_fullname").html(data.full_name);
        $("#detail_date").html(dateTime(data.created_at));
        $("#detail_status").html(stat);

        if (data.membership != null) {
            var member = data.membership;
            $("#detail_membership").html(member.membership);
            $("#detail_pricing").html("Rp " + rupiah(member.pricing));
            $("#detail_deskripsi").html(member.description);
        } else {
            $("#div_membrship").hide();
        }
        $("#modal_detail_subs_active").modal("show");

    });

}

function reset_subs_all() {
    $('#tabel_show_subs_hide').hide();
    $('#tabel_show_subs').dataTable().fnClearTable();
    $('#tabel_show_subs').dataTable().fnDestroy();
    $("#komunitas_list").val("");
}

function tabel_subs_pending_super(idkomunitas) {
    var token = $('meta[name="csrf-token"]').attr('content');
    $('#tabel_subs_pending_hide').show();

    $('#tabel_subs_pending').DataTable().clear().destroy();
    $('#tabel_subs_pending').empty();

    var thead = '<thead><tr>' +
        '<th><b>ID Subscriber</b></th>' +
        '<th><b>Membership</b></th>' +
        '<th><b>Subscriber Name</b></th>' +
        '<th><b>Status</b></th>' +
        '<th><b>Join Date</b></th>' +
        '<th><b>Action</b></th>' +
        '</tr></thead>';

    $('#tabel_subs_pending').html(thead);

    var tabel = $('#tabel_subs_pending').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_subs_pending_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": idkomunitas,
                "_token": token
            }, timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_subs_pending tbody').empty().append(nofound);
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
                    if (data == null) {
                        var shw = '<span class="clight">Tidak Ada<span>';
                    } else {
                        var shw = data;
                    }
                    return shw;
                }
            },
            { mData: 'full_name' },
            {
                mData: 'status',
                render: function (data, type, row, meta) {
                    var stat = '';
                    if (data == 0) {
                        var stat = 'Waiting Approval';
                    } else if (data == 1) {
                        stat = 'Approved';
                    } else if (data == 2) {
                        stat = 'Pending Membership';
                    } else if (data == 3) {
                        stat = 'Active';
                    } else {
                        stat = 'Nonactive';
                    }
                    return stat;
                }
            },
            {
                mData: 'created_at',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnsee">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnsee"><i class="mdi mdi-eye"></i></button>',
                    "targets": -1
                }
            ],

    });
    $("#modal_generate_pending").modal('hide');

    //DETAIL USERTYPE FROM DATATABLE
    $('#tabel_subs_pending tbody').on('click', 'button.btnsee', function () {
        // var data = tabel.row($(this).parents('tr')).data();
        var rownya = $(this).parents('li').length ?
            $(this).parents('li') :
            $(this).parents('tr');
        var data = tabel.row(rownya).data();

        var stat = '';
        if (data.status == 0) {
            var stat = 'Waiting Approval';
        } else if (data.status == 1) {
            stat = 'Approved';
        } else if (data.status == 2) {
            stat = 'Pending Membership';
        } else if (data.status == 3) {
            stat = 'Active';
        } else {
            stat = 'Nonactive';
        }

        $("#detail_userid2").html(data.user_id);
        $("#detail_fullname2").html(data.full_name);
        $("#detail_date2").html(dateTime(data.created_at));
        $("#detail_status2").html(stat);

        $("#modal_detail_subs_pending").modal("show");
    });

}
//----------------------- END SUBSCRIBER MANAGEMENT SUPER --------------------------





//----------------------- MODULE MANAGEMENT SUPER ----------------------------
function get_module_all_superadmin() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/get_all_module_list_superadmin',
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
                        location.href = '/superadmin';
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                var isiui = '';
                var nomer = 0;
                $.each(result, function (i, item) {
                    nomer++;
                    var logo = server_cdn + cekimage_cdn(item.logo);
                    var noimg = '/img/fitur.png';

                    isiui += '<div class="col-lg-4 col-md-6 col-sm-12 stretch-card ' +
                        'grid-margin card-member' +
                        'data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                        '<div class="card bg-gradient-blue card-img-holder text-white member">' +
                        '<div class="card-body member">' +
                        '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />' +
                        '<img src="' + logo + '" class="rounded-circle img-fluid img-card module"' +
                        'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                        '<div class="row">' +
                        '<div class="col-md-7">' +
                        '<small class="cgrey">' + item.title + '</small>' +
                        '<h5>' + item.feature_type_title + '</h5>' +
                        '</div>' +
                        '<div class="col-md-5" style="text-align: right;">' +
                        '<button class="btn btn-sm btn-ready-card"' +
                        'onclick="detail_module_all(\'' + item.feature_id + '\')">Detail</button>' +
                        '</div>' +
                        '</div></div></div></div>';
                });
                $("#total_module").html(nomer + " Modules");
                $("#show_module_all_super").html(isiui);
            }
        },
        error: function (result) {
            ui.popup.show('warning', 'Cant Show List Module', 'Warning');
            console.log(result);
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
        url: '/superadmin/detail_module_all_super',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "feature_id": idsubfitur,
            "_token": token
        },
        success: function (result) {
            var dt = result[0];
            var noimg = '/img/fitur.png';

            $("#id_modulefitur").val(dt.feature_id);
            $("#payment_time").val();
            $("#payment_method_id").val();

            $("#logo_fitur_module").attr("src", server_cdn + cekimage_cdn(dt.logo));
            $("#module_name").html(dt.title);
            $("#module_name1").html(dt.title);
            $("#module_deskripsi").html(dt.description);
            $("#module_tipe").html(dt.feature_type_title);

            var isistatus = '';
            if (dt.status == false) {
                isistatus = '<label class="badge melengkung10px bg-abu cputih" ' +
                    'style="min-width:100px;"> Not Active</label >';
            } else {
                isistatus = '<label class="badge melengkung10px bg-ijo cputih" ' +
                    'style="min-width:100px;"> Active</label >';
            }
            $(".status_aktif").html(isistatus);

            if (dt.price_annual != 0) {
                $("#harga_tahunan").html("Rp " + rupiah(dt.price_annual));
            } else {
                $("#harga_tahunan").html('<center class="tebal cgrey">Free');
            }

            if (dt.price_monthly != 0) {
                $("#harga_bulanan").html("Rp " + rupiah(dt.price_monthly));
            } else {
                $("#harga_bulanan").html('<center class="tebal cgrey">Free');
            }

            if (dt.grand_pricing != 0) {
                $("#harga_grand").html("Rp " + rupiah(dt.grand_pricing));
            } else {
                $("#harga_grand").html('<center class="tebal cgrey">Free');
            }

            var subf = '';
            var jum = 0;
            $.each(dt.subfeature, function (i, item) {
                jum++;

                subf += '<div class="col-md-6 stretch-card grid-margin' +
                    'data-toggle="tooltip" data-placement="top" title="' + item.description + '"' +
                    'style="height:85px; padding-left: 5px; padding-bottom:5px;">' +
                    '<div class="card bg-gradient-blue card-img-holder text-white">' +
                    '<div class="card-body" style="padding: 1rem 0.5rem 1rem 0.5rem !important;">' +
                    '<img src="/purple/images/dashboard/circle.svg" class="card-img-absolute"' +
                    'alt="circle-image" /> ' +
                    '<div class="row">' +
                    '<div class="col-md-4">' +
                    '<img src="' + server_cdn + cekimage_cdn(item.logo) + '" class="rounded-circle img-fluid img-card2"' +
                    'onerror = "this.onerror=null;this.src=\'' + noimg + '\';">' +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<small>' + item.title + '</small>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
            $(".show_subfitur_module").html(subf);

            $("#md_all_aktifkan_module").modal("show");
        },
        error: function (result) {
            console.log("Cant Show Detail Module");
        }
    });
}

function addRowSubModule() {
    var row = 1;
    var id = 2;

    $(document).on("click", "#addnewrow", function () {
        var new_row = '<div class="row form-group newly" id="row' + row + '"' +
            'style="margin-top:1em;">' +
            '<div class="col-md-4" style="padding-right:0px;">' +
            '<input type="text" name="sub' + id + '[]" class="form-control input-abu" placeholder="Title">' +
            '</div>' +
            '<div class="col-md-7" style="padding-right:0px;">' +
            '<input type="text" name="sub' + id + '[]" class="form-control input-abu" placeholder="Description">' +
            '</div>' +
            '<div class="col-md" style="padding-right:0px; padding-left: 5px;">' +
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

    $(document).on("click", ".delete-row", function () {
        //  alert("deleting row#"+row);
        if (row > 1) {
            $(this).closest('div .newly').remove();
            row--;
        }
        return false;
    });
}

//---------------------- END MODULE MANAGEMENT SUPER --------------------------


// ----------------------- USERTYPE MANAGEMENT SUPER -----------------------------
function cek_error_addusertype() {
    var err_add = $("#error_priv").val();
    if (err_add != "" && err_add != undefined) {
        swal("Cant Null !", "Please Fill All Fields", "error").then((value) => {
            $("#modal_add_usertype").modal('show');
        });
    }

    var err_edit = $("#error_priv2").val();
    if (err_edit != "" && err_edit != undefined) {
        swal("Cant Null !", "Please Fill All Fields", "error").then((value) => {
            $("#modal_edit_usertype").modal('show');
        });
    }
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
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_listfitur_usertype_ceklist();
                }

            } else {
                $(".btnsubmit").removeAttr("disabled", "disabled");
                $(".loading_tree").hide();

                var parent_ui = '';
                $.each(result, function (i, item) {
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
                            '<input type="checkbox" name="fitur_id[]" value="0"  onclick="cek_nofitur(' + item.feature_id + ')" id="id_' + item.feature_id + '">' +
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
                // ___________________________________________________________________________________
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

function tabel_usertype_management() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_usertype_manage').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_usertype_superadmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_usertype_manage tbody').empty().append(nofound);
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
    $('#tabel_usertype_manage tbody').on('click', 'button', function () {
        var data = tabel.row($(this).parents('tr')).data();
        // console.log(data);
        $("#modal_edit_usertype").modal("show");
        $("#idfitur_usertype").val(data.id);
        $("#nama_usertipe_edit").val(data.title);
        $("#dekripsi_usertipe_edit").text(data.description);

        var subfitur = data.subfeature;
        var arr = [];
        $.each(subfitur, function (i, item) {
            $('#edit_fitur_id' + item.feature_id).prop('checked', true);
            $('#edit_subfitur_' + item.subfeature_id).prop('checked', true);
        });


    });

}

// ---------------------- END USERTYPE MANAGENET SUPER ----------------------------




// ---------------------- TRANSACTION MANAGEMENT ------------------------------
function resetparam_trans() {
    $("#komunitas").val("");
    $("#tanggal_mulai").val("");
    $("#tanggal_selesai").val("");
    $("#tipe_trans").val("");
    $("#status_trans").val("");
    $("#subs_name").val("");
}


function get_list_komunitas_trans() {
    $('.subs_name').hide();
    $(".showinsubs2").hide();
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_komunitas",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            $('#komunitas').empty();
            $('#komunitas').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            $("#komunitas").html($('#komunitas option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#komunitas").get(0).selectedIndex = 0;

            const OldKomunitas = "{{old('komunitas')}}";

            if (OldKomunitas !== '') {
                $('#komunitas').val(OldKomunitas);
            }
            // _________________________________________________________________
            $('#komunitas2').empty();
            $('#komunitas2').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#komunitas2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
            }
            $("#komunitas2").html($('#komunitas2 option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#komunitas2").get(0).selectedIndex = 0;

            const OldKomunitas2 = "{{old('komunitas2')}}";

            if (OldKomunitas2 !== '') {
                $('#komunitas2').val(OldKomunitas2);
            }
        }
    });
}



function get_list_transaction_tipe() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_transaction_tipe",
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




$('#komunitas').change(function () {
    var itempilih = this.value;
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_subcriber_name",
        type: "POST",
        dataType: "json",
        data: {
            "community_id": itempilih,
            "_token": token
        },
        success: function (result) {
            $('#subs_name').fadeIn("fast");
            $('#subs_name').empty();
            $('#subs_name').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#subs_name').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].full_name, "</option>"));
            }
            $("#subs_name").html($('#subs_name option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#subs_name").get(0).selectedIndex = 0; const
                OldSubs = "{{old('subs_name')}}";
            if (OldSubs !== '') {
                $('#subs_name').val(OldSubs);
            }

        },
        error: function (result) {
            $('#subs_name').fadeOut("fast");
        }
    });
});


$('#komunitas2').change(function () {
    var itempilih = this.value;
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_subcriber_name",
        type: "POST",
        dataType: "json",
        data: {
            "community_id": itempilih,
            "_token": token
        },
        success: function (result) {

            $('.showinsubs2').fadeIn("fast");
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
            $('#subs_name2').fadeOut("fast");
        }
    });
});


$("#btn_showtable_transaksi").click(function (e) {
    show_tabel_transaksi();
});



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
        ajax: {
            url: '/superadmin/tabel_transaksi_show',
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
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
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
}


function detail_transaksi_all(dt_trans) {
    $("#modal_detail_trans").modal('show');
    var trans = dt_trans.split(',');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_transaksi_superadmin',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "invoice_number": trans[0],
            "payment_level": trans[1],
            "community_id": trans[2],
            "_token": token
        },
        success: function (result) {
            console.log(result);

            $("#invoice_trans").html(result.invoice_number);
            $("#date_trans").html(result.created_at);
            $("#komunitas_trans").html(result.community_name);
            $("#subscriber_trans").html(result.name);
            $("#level_title_trans").html(result.level_title);
            $("#nominal_trans").html(result.grand_total);
            $("#jenis_trans").html(result.transaction_type);
            $("#statusjudul_trans").html(result.status_title);
            $("#transaksi_trans").html(result.transaction);

            var uiku = '';
            if (result.data_confirmation.file != "") {
                $("#img_pay_confirm").attr("src", server_cdn + result.data_confirmation.file);
                $("#nama_confirm_trans").html(result.data_confirmation.created_by);
                $("#date_confirm_trans").html(result.data_confirmation.created_at);

                uiku = '<button type="button" class="btn btn-tosca' +
                    'melengkung10px btn-sm"> Paid</button >';
                $("#status_color").html(uiku);
            } else {
                $("#img_pay_confirm").attr("src", "");
                uiku = '<button type="button" class="btn btn-abu' +
                    'melengkung10px btn-sm"> Not Yet</button >';
                $("#status_color").html(uiku);
            }


            if (result.data_verification.file != "") {
                $("#img_pay_aprov").attr("src", server_cdn + result.data_verification.file);
                $("#name_approv_trans").html(result.data_verification.verification_by);
                $("#date_approv_trans").html(result.data_verification.verification_at);
            }

        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Detail");
        }
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
            url: '/superadmin/tabel_transaksi_show',
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
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
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

// ---------------------- END TRANSACTION MANAGEMENT ----------------------------


// ---------------------- USER MANAGEMENT ------------------------------

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
            url: '/superadmin/tabel_user_management_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h3></td></tr>';
                $('#tabel_user_manage tbody').empty().append(nofound);
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
    $("#modal_detail_user").modal("show");
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_user_management_super',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "user_id": iduser,
            "_token": token
        },
        success: function (result) {
            var res = result[0];
            console.log(res);

            if (res.picture != null) {
                $("#foto_user").attr("src", server_cdn + res.picture);
            } else {
                $("#foto_user").attr("src", "/img/noimg.jpg");
            }

            $("#detail_nama").html(res.full_name);
            $("#detail_username").html(res.user_name);
            $("#detail_email").html(res.email);
            $("#detail_hp").html(res.notelp);

            if (res.alamat != null) {
                $("#detail_alamat").html(res.alamat);
            } else {
                $("#detail_alamat").html('-');
            }

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

function showPassUsermanage() {
    var a = document.getElementById("confirmpass_user");
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
        url: "/superadmin/get_user_tipe_manage",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
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
// ---------------------- END USER MANAGEMENT---------------------------


// ----------------------- LOG MANAGEMENT SUPERADMIN -----------------------

$("#btn_filter_log_super").click(function () {
    tabel_log_magement_super();
});


function tabel_log_magement_super() {
    // $('#tabel_log_magement_super').dataTable().fnClearTable();
    // $('#tabel_log_magement_super').dataTable().fnDestroy();

    $('#tabel_log_magement_super').DataTable().clear().destroy();
    $('#tabel_log_magement_super').empty();

    var uihead = '<thead>' +
        '<tr>' +
        '<th><b>Username</b></th>' +
        '<th><b>User Level</b></th>' +
        '<th><b>Module</b></th>' +
        '<th><b>Activity</b></th>' +
        '<th><b>Endpoint</b></th>' +
        '<th><b>Date Log</b></th>' +
        '<th><b>Code</b></th>' +
        '</tr>' +
        '</thead>';

    $('#tabel_log_magement_super').html(uihead);

    $('#tabel_log_magement_super').show();
    $('#modal_generate_log').modal('hide');

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_log_magement_super').DataTable({
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
            url: '/superadmin/tabel_log_management_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "user_level": $("#list_userlevel").val()
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="10" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_log_magement_super tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'user_name' },
            { mData: 'user_level' },
            { mData: 'module' },
            {
                mData: 'activity',
                render: function (data, type, row, meta) {
                    return '<span class="text-wrap width-300">' + data + '</span>';

                }
            },
            { mData: 'endpoint' },
            {
                mData: 'date',
                render: function (data, type, row, meta) {
                    return dateFormat(data);
                }
            },
            {
                mData: 'code_response',
                render: function (data, type, row, meta) {
                    if (data == null || data == "") {
                        var ii = '-';
                    } else {
                        var ii = '<small>' + data + '</small>';
                    }
                    return ii;
                }
            }
        ],

    });

}



function get_list_komunitas_log_manage() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_komunitas_log_manage",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_komunitas_log_manage();
                }
            } else {
                $('#list_komunitas').empty();
                $('#list_komunitas').append("<option selected disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));
                $("#list_komunitas").get(0).selectedIndex = 0;
                const OldKomunitas = "{{old('list_komunitas')}}";
                if (OldKomunitas !== '') {
                    $('#list_komunitas').val(OldKomunitas);
                }
            }
        },
        error: function (result) {
            console.log(result);
        }
    });
}
// -------------------- END LOG MANAGEMENT SUPERADMIN -------------------------


// ------------------------ REPORT MANAGEMENT -------------------------
$("#btn_generate_trans").click(function () {

    tabel_report_transaksi_super();
});


$("#btn_generate_reconcile").click(function () {
    var tglq = $("#tahun_concile").val();
    var tgl = tglq.split('-');
    var bulan = tgl[1];
    var tahun = tgl[0];
    tabel_report_concile_super(bulan, tahun);
});

$("#btn_generate_module").click(function () {
    var tglq = $("#tahun_module").val();
    var tgl = tglq.split('-');
    var bulan = tgl[1];
    var tahun = tgl[0];
    tabel_report_module_super(bulan, tahun);
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
            url: '/superadmin/tabel_concile_report_super',
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
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_concile_report tbody').empty().append(nofound);
            },
        },
        success: function (result) {
            console.log(result);
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
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
            }

        ],

    });
}

$("#btn_generate_komunitas").click(function () {
    var tglq = $("#tahun_komunitas").val();
    var tgl = tglq.split('-');
    var bulan = tgl[1];
    var tahun = tgl[0];
    tabel_report_komunitas_super(bulan, tahun);
});


function tabel_report_module_super(bulan, tahun) {
    $('#tabel_module_report').dataTable().fnClearTable();
    $('#tabel_module_report').dataTable().fnDestroy();

    $("#modal_module_transaksi").modal('hide');
    $("#tabel_module_report").show();


    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_module_report').DataTable({
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
            url: '/superadmin/tabel_module_report_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "feature_id": $("#list_fiture").val(),
                "month": bulan,
                "year": tahun,
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_module_report tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
            $('#tabel_module_report tbody').empty().append(nofound);

        },
        columns: [
            {
                mData: 'community_name',
                render: function (data, type, row, meta) {
                    if (data == "" || data == null) {
                        var dtk = "<div class='text-wrap width-200'>" + row.community_id + "</div>";
                    } else {
                        var dtk = "<div class='text-wrap width-200'>" + data + "</div>";
                    }
                    return "<div class='text-wrap width-200'>" + dtk + "</div>";
                },
            },
            { mData: 'module' },
            { mData: 'activity' },
            { mData: 'endpoint' },
            { mData: 'date' },
        ],

    });
}


function tabel_report_komunitas_super(bulan, tahun) {
    $('#tabel_komunitas_report').dataTable().fnClearTable();
    $('#tabel_komunitas_report').dataTable().fnDestroy();

    $("#modal_komunitas_transaksi").modal('hide');
    $("#tabel_komunitas_report").show();


    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_komunitas_report').DataTable({
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
            url: '/superadmin/tabel_komunitas_report_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#komuniti_trans3").val(),
                "month": bulan,
                "year": tahun,
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_komunitas_report tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
            $('#tabel_komunitas_report tbody').empty().append(nofound);

        },
        columns: [
            { mData: '_id' },
            { mData: 'module' },
            { mData: 'activity' },
            { mData: 'endpoint' },
            { mData: 'date' },
        ],

    });
}



function tabel_report_transaksi_super() {
    $('#tabel_transaksi_report').dataTable().fnClearTable();
    $('#tabel_transaksi_report').dataTable().fnDestroy();

    $("#modal_generate_transaksi").modal('hide');
    $("#tabel_transaksi_report").show();

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
            url: '/superadmin/tabel_report_transaksi_super',
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
                "community_id": $("#komuniti_trans").val(),
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_transaksi_report tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
            $('#tabel_transaksi_report tbody').empty().append(nofound);

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



function get_list_transaction_type_super() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_transaction_type_super",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            if (result.success == false) {
                console.log(result);
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_transaction_type_super();
                }

            } else {
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
            }
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show");
        }
    });
}



function get_list_komunitas_report() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_komunitas_log_manage",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_komunitas_report();
                }
            } else {
                $('#komuniti_trans').empty();
                $('#komuniti_trans').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#komuniti_trans").html($('#komuniti_trans option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans").get(0).selectedIndex = 0;
                // _______________________________________________________________

                $('#komuniti_trans2').empty();
                $('#komuniti_trans2').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans2').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#komuniti_trans2").html($('#komuniti_trans2 option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans2").get(0).selectedIndex = 0;
                // _______________________________________________________________

                $('#komuniti_trans3').empty();
                $('#komuniti_trans3').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komuniti_trans3').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#komuniti_trans3").html($('#komuniti_trans3 option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komuniti_trans3").get(0).selectedIndex = 0;
            }
        }
    });
}


function get_list_fitur_super() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_fitur_super",
        type: "POST",
        dataType: "json",
        success: function (result) {
            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_fitur_super();
                }
            } else {
                $('#list_fiture').empty();
                $('#list_fiture').append("<option selected disabled>Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_fiture').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                $("#list_fiture").html($('#list_fiture option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_fiture").get(0).selectedIndex = 0;
            }
        }
    });
}
// ------------------------ END REPORT MANAGEMENT -----------------------



// ------------------------- PRICING MANAGEMENT --------------------------
var switchStatus_pricing = false;
$("#edit_status_pricing").on('change', function () {
    if ($(this).is(':checked')) {
        switchStatus_pricing = $(this).is(':checked');
    }
    else {
        switchStatus_pricing = $(this).is(':checked');
    }
});


$("#file_img_pricing").on('change', function () {
    readURLuser_pricing(this);
});

$("#browse_img_pricing").on('click', function () {
    $("#file_img_pricing").click();
});


$("#file_img_pricing_edit").on('change', function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#view_img_pricing_edit').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
});

$("#browse_img_pricing_edit").on('click', function () {
    $("#file_img_pricing_edit").click();
});


$('#add_tipepricing').change(function () {
    var itempilih = this.value;
    if (itempilih == 1) {
        $("#hide_fitur_add").show(); //div colum
        $("#hide_multi_add").show();
        $("#fiturpricing").hide();
    } else {
        $("#hide_fitur_add").show(); //div colum
        $("#hide_multi_add").hide();
        $("#fiturpricing").show();
    }
});

var readURLuser_pricing = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#view_img_pricing').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function tabel_all_pricing_super() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_all_pricing_super').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            },
        },
        ajax: {
            url: '/superadmin/tabel_pricing_management_superadmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty"><h class="cgrey">Data Not Found</h</td></tr>';
                $('#tabel_module_report_superadmin tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'id' },
            {
                mData: 'title',
                render: function (data, type, full, meta) {
                    return "<div class='text-wrap width-200'>" + data + "</div>";
                },
            },
            {
                mData: 'price_monthly',
                render: function (data, type, row, meta) {
                    var bulanan = 'Rp. ' + rupiah(data);
                    return bulanan;
                }
            },
            {
                mData: 'price_annual',
                render: function (data, type, row, meta) {
                    var tahunan = 'Rp. ' + rupiah(data);
                    return tahunan;
                }
            },
            {
                mData: 'pricing_type_title',
                render: function (data, type, full, meta) {
                    return "<div class='text-wrap width-200'>" + data + "</div>";
                }
            },
            {
                mData: 'status_title',
                render: function (data, type, row, meta) {
                    var dt = row.status;
                    var isine = '';
                    if (dt == 0) {
                        isine = '<label class="badge bg-abu melengkung10px cwhite">Deactive</label>';
                    } else if (dt == 1) {
                        isine = '<label class="badge bg-tosca melengkung10px cwhite">Active</label>';
                    }
                    return isine;
                }
            },
            {
                mData: 'pricing_feature',
                render: function (data, type, row, meta) {
                    var totalfitur = data.length;
                    if (totalfitur == 0) {
                        return '<center>' + totalfitur + '</center>';
                    } else if (totalfitur == 1) {
                        return '<center>' + totalfitur + '  <small>Feature </small></center>';
                    } else {
                        return '<center>' + totalfitur + '   <small>Features </small></center>';
                    }
                }
            },
            {
                mData: 'id',
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                        'onclick="detail_pricing_super(\'' + data + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });

}


function detail_pricing_super(idku) {
    $('#modal_detail_pricing_super').modal('show');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_pricing_super',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "pricing_id": idku,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            $(".rmpricing").removeAttr("checked", "checked");

            if (result.length == 0) {
                var res = result;
            } else {
                var res = result[0];
            }

            var isitatus = '';
            if (res.status == 0) {
                isitatus = '<label class="badge bg-abu melengkung10px cwhite">Deactive</label>';
            } else if (res.status == 1) {
                isitatus = '<label class="badge bg-tosca melengkung10px cwhite">Active</label>';
            }

            if (res.icon != null) {
                $("#img_logo_pricing").attr("src", server_cdn + cekimage_cdn(res.icon));
                $("#view_img_pricing_edit").attr("src", server_cdn + cekimage_cdn(res.icon));
            }

            var arf = [];
            var len = res.pricing_feature.length;
            $.each(res.pricing_feature, function (i, item) {
                //  console.log(item.feature_id);
                arf.push(item.feature_id);
            });
            var fiturs = arf.toString();


            //edit
            $("#edit_nama_pricing").val(res.title);
            $("#edit_deskripsi_pricing").text(res.description);
            $("#edit_tipepricing").val(res.pricing_type);
            $("#edit_sekali").val(res.grand_pricing);
            $("#edit_bulanan").val(res.price_monthly);
            $("#edit_tahunan").val(res.price_annual);
            $("#id_pricing_edit").val(idku);
            if (res.status == 1) {
                $("#edit_status_pricing").attr("checked", true);
            } else {
                $("#edit_status_pricing").attr("checked", false);
            }
            // $("edit_status_pricing").val();

            if (res.pricing_type == 1) {
                $("#hide_fitur_edit").show(); //div colum
                $("#hide_multi_edit").show();
                $("#fiturpricing_edit").hide();
            } else {
                $("#hide_fitur_edit").show(); //div colum
                $("#hide_multi_edit").hide();
                $("#fiturpricing_edit").show();
            }

            $.each(fiturs.split(","), function (i, e) {
                console.log(e);
                if (result.pricing_type == 2) {
                    $("#fiturpricing_edit").val(e);
                } else {
                    $("#edit_fitur_" + e).attr("checked", "checked");
                }
            });


            $("#pricing_status").html(isitatus);
            $("#foto_user").attr("src", server_cdn + res.icon);
            $("#pricing_name").html(res.title);
            $("#pricing_type").html(res.pricing_type_title);
            $("#pricing_deskripsi").html(res.description);
            $("#pricing_tahunan").html('Rp ' + rupiah(res.price_annual));
            $("#pricing_bulanan").html('Rp ' + rupiah(res.price_monthly));
            $("#pricing_sekali").html('Rp ' + rupiah(res.grand_pricing));

            var fiturnya = '';
            var jum = 0;
            $.each(res.pricing_feature, function (i, item) {
                jum++;
                fiturnya += '<li><small class="cgreyblue s14">' + item.feature_title + '</small></li>';
            });
            console.log(jum);
            if (jum != 0) {
                $("#total_fiturpricing").html(jum + ' Features');
                $("#fitur_pricing").html(fiturnya);
            } else {
                $("#total_fiturpricing").html(' No Features Avaliable');
            }
        },
        error: function (result) {
            console.log(result);
        }
    });

}




function get_list_fitur_pricing() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_fitur_pricing",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);

            var listfitur = '';

            $.each(result, function (i, item) {
                listfitur += '<div class="form-check pricing">' +
                    '<small class="form-check-label cgrey" data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                    '<input type="checkbox" class="form-check-input" id="fiturcek_' + item.id + '" name="multi_fiturpricing[]" value="' + item.id + '">' +
                    item.title + '<i class="input-helper"></i></small></div >';
            });
            $("#show_ceklist_fitur").html(listfitur);
            // _____________________________________________________________

            $('#fiturpricing').empty();
            $('#fiturpricing').append("<option disabled> Choose</option>");
            for (var i = result.length - 1; i >= 0; i--) {
                $('#fiturpricing').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            //Short Function Ascending//
            $("#fiturpricing").html($('#fiturpricing option').sort(function (x, y) {
                return $(x).text() < $(y).text() ? -1 : 1;
            }));

            $("#fiturpricing").get(0).selectedIndex = 0;

            const Oldfiturq = "{{old('fiturpricing')}}";

            if (Oldfiturq !== '') {
                $('#fiturpricing').val(Oldfiturq);
            }
            // _____________________________________________________________

            var editfitur = '';

            $.each(result, function (i, item) {
                editfitur += '<div class="form-check pricing">' +
                    '<small class="form-check-label cgrey" data-toggle="tooltip" data-placement="top" title="' + item.description + '">' +
                    '<input type="checkbox" class="form-check-input rmpricing" id="edit_fitur_' + item.id + '" name="edit_multi_fiturpricing[]" value="' + item.id + '">' +
                    item.title + '<i class="input-helper"></i></small></div >';
            });
            $("#edit_show_ceklist_fitur").html(editfitur);

            // _____________________________________________________________

            $('#fiturpricing_edit').empty();
            $('#fiturpricing_edit').append("<option disabled> Choose</option>");
            for (var i = result.length - 1; i >= 0; i--) {
                $('#fiturpricing_edit').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            $("#fiturpricing_edit").html($('#fiturpricing_edit option').sort(function (x, y) {
                return $(x).text() < $(y).text() ? -1 : 1;
            }));

            $("#fiturpricing_edit").get(0).selectedIndex = 0;

            const Oldfiturqedit = "{{old('fiturpricing_edit')}}";

            if (Oldfiturqedit !== '') {
                $('#fiturpricing_edit').val(Oldfiturqedit);
            }

        }
    });
}
// ----------------------- END PRICIING MANAGEMENT ---------------------------



// ------------------- MODULE REPORT MANAGEMENT -------------------------
$("#btn_filter_log_super").click(function () {
    tabel_module_report_superadmin();
});

$("#reset_tabel_modulereport").click(function () {
    $("#list_komunitas").val("");
    $("#tanggal_mulai2").val("");
    $("#tanggal_selesai2").val("");
    $("#list_userlevel").val("");
    $("#list_fitur").val("");
    $("#list_subfitur").val("");
    $('#tabel_module_report_superadmin').hide();
    // $('#modal_generate_module_activity').modal('show');
    $('#tabel_module_report_superadmin').dataTable().fnClearTable();
    $('#tabel_module_report_superadmin').dataTable().fnDestroy();
});

function tabel_module_report_superadmin() {
    $('#tabel_module_report_superadmin').dataTable().fnClearTable();
    $('#tabel_module_report_superadmin').dataTable().fnDestroy();

    $('#tabel_module_report_superadmin').show();
    $('#modal_generate_module_activity').modal('hide');
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_module_report_superadmin').DataTable({
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
            },
        },
        ajax: {
            url: '/superadmin/tabel_module_report_superadmin',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "user_level": $("#list_userlevel").val(),
                "feature_id": $("#list_fitur").val(),
                "sub_feature_id": $("#list_subfitur").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_module_report_superadmin tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
        },
        columns: [
            { mData: 'user_name' },
            { mData: 'user_level' },
            { mData: 'module' },
            { mData: 'activity' },
            { mData: 'endpoint' },
            { mData: 'date' },
            { mData: 'code_response' },
            // {
            //     mData: 'code_response',
            //     render: function (data, type, row, meta) {
            //         var dt = [row.response];

            //         return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
            //             'onclick="detail_log_super(\'' + data + '\')">' +
            //             '<i class="mdi mdi-eye"></i>' +
            //             '</button>';
            //     }
            // }
        ],

    });
}


function get_list_community_modulereport() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_community_modulereport",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_community_modulereport();
                }
            } else {
                $('#list_komunitas').empty();
                $('#list_komunitas').append("<option selected disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));
                $("#list_komunitas").get(0).selectedIndex = 0;
                const OldKomunitas = "{{old('list_komunitas')}}";
                if (OldKomunitas !== '') {
                    $('#list_komunitas').val(OldKomunitas);
                }
            }
        }
    });
}


function get_list_fitur_modulereport() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_fitur_modulereport",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            $('#list_fitur').empty();
            $('#list_fitur').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#list_fitur').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            $("#list_fitur").html($('#list_fitur option').sort(function (x, y) {
                return $(x).text() < $(y).text() ? -1 : 1;
            }));
            $("#list_fitur").get(0).selectedIndex = 0;
            const Oldfitur = "{{old('list_fitur')}}";
            if (Oldfitur !== '') {
                $('#list_fitur').val(Oldfitur);
            }
        }
    });
}



$('#list_fitur').change(function () {
    var itempilih = this.value;
    get_subfitur_modulereport(itempilih);
});


function get_subfitur_modulereport(itempilih){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_subfitur_modulereport",
        type: "POST",
        dataType: "json",
        data: {
            "feature_id": itempilih,
        },
        success: function (result) {
            console.log(result);
            if (result.success == false && result.status != 404) {
                get_subfitur_modulereport(itempilih);
            } else {
            $('#showin_subfitur').fadeIn("fast");
            $('#list_subfitur').empty();
            $('#list_subfitur').append("<option value='null'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#list_subfitur').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }
            $("#list_subfitur").html($('#list_subfitur option').sort(function (x, y) {
                return $(y).val() < $(x).val() ? -1 : 1;
            }));

            $("#list_subfitur").get(0).selectedIndex = 0; const
                OldSubf = "{{old('list_subfitur')}}";
            if (OldSubf !== '') {
                $('#list_subfitur').val(OldSubf);
            }
        }
        },
        error: function (result) {
            $('#showin_subfitur').fadeOut("fast");
        }
    });
}
// ------------------ END MODULE REPORT MANAGEMENT ------------------------



// ---------------------------- PAYMENT MANAGEMENT SUPER ---------------------------------

function addRowDinamic_paysuper() {
    // Add row
    var row = 1;
    var id = 2;

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

        var row_baru = '<div class="newly"  id="row' + row + '">' +
            '<hr>' +
            '<div class="row">' +
            '<div class="col-md-3">' +
            '<div class="form-group">' +
            '<small class="clight s13">Title</small>' +
            '<input type="text"  name="set_judul' + id + '" class="form-control input-abu">' +
            '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<small class="clight s13">Setting Type</small>' +
            '<select class="form-control input-abu" name="set_tipe' + id + '">' +
            '<option selected disabled> Choose </option>' +
            '<option value="1"> Radio Button </option>' +
            '<option value="2"> Inputan </option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-5">' +
            '<div class="form-group">' +
            '<small class="clight s13">Description</small>' +
            '<textarea type="text" name="set_deskripsi' + id + '" ' +
            'class="form-control input-abu" rows="1"></textarea>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<div class=" form-group">' +
            '<small class="clight s13">Value</small>' +
            '<input type="text"  name="set_value' + id + '" class="form-control input-abu" required>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md" style="margin-top: 0.5em;">' +
            '<small class="clight s13">Tag Html</small>' +
            '</div>' +
            '<div class="col-md-10">' +
            '<input type="text" name="set_tag_html' + id + '"' +
            'class="form-control input-abu"></input> ' +
            '</div>' +
            '<div class="col-md">' +
            '<button type="button" class="btn btn-inverse-secondary btn-rounded btn-icon delete-row" style="width: 25px; height: 25px; margin-top: 0.7em;">' +
            '<i class="mdi mdi-delete"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '<br></div>';

        $('#isi_newrow').append(row_baru);
        row++;
        id++;
        return false;
    });

    $(document).on("click", ".delete-row", function () {
        if (row > 1) {
            $(this).closest('div .newly').remove();
            row--;
        }
        return false;
    });

}


function tabel_payment_all_super() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_payment_all_super').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_payment_all_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_payment_all_super tbody').empty().append(nofound);
            },
        },
        success: function (result) {
            console.log(result);
        },
        error: function (request, status, errorThrown) {
            console.log(errorThrown);
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
            $('#tabel_payment_all_super tbody').empty().append(nofound);

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
                        'onclick="detail_payment_all_super(\'' + dt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
    });

}


function detail_payment_all_super(dtpay) {
    var param = dtpay.split('<>');
    var token = $('meta[name="csrf-token"]').attr('content');
    $("#modal_detail_payment_all_super").modal('show');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_payment_all_super',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "payment_id": param[0],
            "level_status": param[1],
            "status": param[2],
            "_token": token
        },
        success: function (result) {
            // console.log(result[0]);
            var res = result[0];
            $('#tabel_sub_payment_super').dataTable().fnClearTable();
            $('#tabel_sub_payment_super').dataTable().fnDestroy();

            $("#detail_judul").html(res.payment_title);
            $("#detail_deskripsi").html(res.description);
            $("#detail_pricebulan").html("Rp " + rupiah(res.price_monthly));
            $("#detail_pricetahun").html("Rp " + rupiah(res.price_annual));
            $("#detail_minbulan").html(res.minimum_monthly_subscription);
            $("#detail_mintahun").html(res.minimum_annual_subscription);

            $("#edit_idpay").val("");
            $("#edit_idpay").val(param[0]);
            $("#subid_payment").val(param[0]);
            $("#edit_nama_pay").val(res.payment_title);
            $("#edit_deskripsi_pay").text(res.description);
            $("#edit_harga_bulanan_pay").val(res.price_monthly);
            $("#edit_harga_tahunan_pay").val(res.price_annual);
            $("#edit_min_bulanan_pay").val(res.minimum_monthly_subscription);
            $("#edit_min_tahunan_pay").val(res.minimum_annual_subscription);


            var jsnDt = res.payment_methods;

            $('#tabel_sub_payment_super').dataTable({
                responsive: true,
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
                            var dtimg = server_cdn + data;
                            return '<img src="' + dtimg + '" style="width:30px; height:30px;" id="imgsubpay_' + row + '" class="rounded-circle img-fluid" onclick="clickImage(this)" onerror="errorImg()">';
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
                            }
                            return isine;
                        }
                    },
                    {
                        mData: 'payment_time_limit',
                        render: function (data, type, row, meta) {
                            var inin = '';
                            if (data == 0) {
                                inin = data;
                            } else if (data == 1) {
                                inin = '<small class="clight"> ' + data + '  Day</small>';
                            } else {
                                inin = '<small class="clight"> ' + data + '  Days</small>';
                            }
                            return inin;
                        }
                    },
                    { mData: 'payment_account' },
                    {
                        mData: 'description',
                        render: function (data, type, row, meta) {
                            var uiku = '';
                            $.each(data, function (i, item) {
                                uiku += '<li>' + item + '</li>';
                            });
                            return "<div class='text-wrap width-300'><ul>" + uiku + "</ul></div>";
                        },
                    },
                    {
                        mData: 'id',
                        render: function (data, type, row, meta) {
                            var datasubpay = {
                                "id": row.id,
                                "payment_title": row.payment_title,
                                "icon": row.icon,
                                "payment_bank_name": row.payment_bank_name,
                                "payment_owner_name": row.payment_owner_name,
                                "payment_time_limit": row.payment_time_limit,
                                "payment_account": row.payment_account,
                                "status": row.status,
                                "description": row.description,
                            };
                            var ini = JSON.stringify(datasubpay);
                            localStorage.setItem("data_subpay", ini);

                            return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref"' +
                                'onclick="mdl_detail_subpayment_all(\'' + data + '\')">' +
                                '<i class="mdi mdi-eye"></i>' +
                                '</button>';
                        }
                    }
                ],
            });
        }
    });

}


function mdl_detail_subpayment_all(params) {
    sessionStorage.removeItem('data_subpay');
    $("#modal_detail_payment_all_super").modal("hide");
    $("#modal_detail_subpayment_super").modal("show");

    var dtk = localStorage.getItem("data_subpay");
    var isi = JSON.parse(dtk);
    // console.log("id payment method = " + isi.id);
    get_setting_subpayment_super(isi.id);

    var statusui = '';
    if (isi.status == 0) {
        statusui = '<small class="badge bg-abu melengkung10px cwhite" style="width :100px">Deactive</small>';
    } else {
        statusui = '<small class="badge bg-biru melengkung10px cdarkgrey" style="width :100px">Active</small>';
    }
    $("#subpay_status").html(statusui);

    var icn = isi.icon;
    var cekimg = icn.slice(0, 1);

    if (cekimg == "/") {
        var isiimg = icn.slice(1);
    } else {
        var isiimg = isi.icon;
    }
    var imglogo = server_cdn + cekimage_cdn(isiimg);

    $('#img_subpay').attr('src', imglogo);
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

    //SET DATA EDIT SUB-PAYMENT
    $("#payment_method_id").val(isi.id);
    $("#edit_sub_namapay ").val(isi.payment_title);
    $("#edit_sub_timelimit ").val(isi.payment_time_limit);
    $('select[name="edit_sub_nama_bank"]').val(isi.payment_bank_name);
    $("#view_img_subpay_edit").attr('src', imglogo);
    $("#edit_sub_deskripsi ").text(isi.description);
    $("#edit_sub_nama_bank ").val(isi.payment_bank_name);
    $("#edit_sub_owner_bank ").val(isi.payment_owner_name);
    $("#edit_sub_rekening ").val(isi.payment_account);

}


function get_setting_subpayment_super(idnya) {
    $(".set_id_paymethod").val(idnya);
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/get_setting_subpayment_super',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "payment_method_id": idnya,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            if (result.success == false && result.status != 404) {
                get_setting_subpayment_super(idnya);
            } else if (result.success == false && result.status == 404) {
                $(".isi_setting_subpay").html('<br><br><br><br><br><center><h5 class="clight">No Data Setting</h5></center>');
            } else {
                var uiku = '';
                $.each(result, function (i, item) {
                    if (item.setting_type == 1) {
                        var tipe = 'Input Text';
                    } else {
                        var tipe = 'Radio Button';
                    }
                    uiku += '<div class="row" style="margin-bottom:0.5em;">' +
                        '<div class="col-9"><div class="form-group">' +
                        '<h6 class="cgrey1 tebal name_setting">' + item.title +
                        '<small class="cblue"> &nbsp;&nbsp;&nbsp;' + tipe + '</small></h6>' +
                        '<p class="clight s13" style="margin-top:-0.5em;">' + item.description +
                        '</p>' +
                        '</div>' +
                        '</div >' +
                        '<div class="col-3">' +
                        '<input type="text" value="' + item.value + '"' +
                        'class="form-control input-abu param_setting" disabled>' +
                        '</div></div></div>';
                });
                $(".isi_setting_subpay").html(uiku);
            }
        },
        error: function (result) {
            if (result == '404') {
                console.log('data not found');
            }
        }
    });
}


function get_list_bank_name_subpay() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_bank_name_subpay",
        type: "POST",
        dataType: "json",
        data: {
            "_token": token
        },
        success: function (result) {
            // console.log(result);
            $('#sub_nama_bank').empty();
            $('#sub_nama_bank').append("<option disabled value='0'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#sub_nama_bank').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
            }
            $("#sub_nama_bank").html($('#sub_nama_bank option').sort(function (x, y) {
                return $(x).val() < $(y).val() ? -1 : 1;
            }));
            $("#sub_nama_bank").get(0).selectedIndex = 0;
            // ______________________________________________________________________________

            $('#edit_sub_nama_bank').empty();
            $('#edit_sub_nama_bank').append("<option disabled value='0'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#edit_sub_nama_bank').append("<option value=\"".concat(result[i].nama_bank, "\">").concat(result[i].nama_bank, "</option>"));
            }
            $("#edit_sub_nama_bank").html($('#edit_sub_nama_bank option').sort(function (x, y) {
                return $(x).val() < $(y).val() ? -1 : 1;
            }));

            $("#edit_sub_nama_bank").get(0).selectedIndex = 0;
        }
    });
}

//-------------------------- END PAYMENT MANAGEMENT SUPER -------------------------------



// -------------------------- NOTIFCATION MANAGEMENT SUPER ------------------------------

$("#btn_generate_notif_super").click(function () {
    tabel_generate_notif_super();
});

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

function tabel_generate_notif_super() {
    $('#tabel_generate_notif_super').dataTable().fnClearTable();
    $('#tabel_generate_notif_super').dataTable().fnDestroy();
    $('#tabel_generate_notif_super').show();
    $('#modal_filter_notif_super').modal('hide');

    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_generate_notif_super').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_generate_notification_super',
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
            // success: function (result) {
            // console.log(result);
            // },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_generate_notif_super tbody').empty().append(nofound);
            },
        },
        columns: [
            { mData: 'id' },
            { mData: 'title' },
            { mData: 'notification_sub_type_title' },
            { mData: 'user_type_title' },
            { mData: 'community_name' },
            { mData: 'notification_status' },
            { mData: 'created_by' },
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
                        'onclick="detail_notif_super(\'' + inidt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });

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


function get_list_komunitas_notifsuper() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_komunitas_log_manage",
        type: "POST",
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if (result.status != 404) {
                    get_list_komunitas_notifsuper();
                }
            } else {
                $('#list_komunitas_notif').empty();
                $('#list_komunitas_notif').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas_notif').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#list_komunitas_notif").html($('#list_komunitas_notif option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#list_komunitas_notif").get(0).selectedIndex = 0;
                // _________________________________________________________________________

                $('#komunitas_notif').empty();
                $('#komunitas_notif').append("<option value='0' disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_notif').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                $("#komunitas_notif").html($('#komunitas_notif option').sort(function (x, y) {
                    return $(x).val() < $(y).val() ? -1 : 1;
                }));

                $("#komunitas_notif").get(0).selectedIndex = 0;
                Olddt = "{{old('usekomunitas_notifr_notif')}}";
                if (Olddt !== '') {
                    $('#komunitas_notif').val(Olddt);
                }
            }
        },
        error: function (result) {
            get_list_komunitas_notifsuper();
        }
    });
}


function detail_notif_super(dtku) {
    var dtnya = dtku.split(',');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_generate_notif_super',
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
            if (result.success == false) {
                if (result.status == 401 || result.message == "Unauthorized") {
                    ui.popup.show('error', 'Another user has been logged', 'Unauthorized ');
                    setTimeout(function () {
                        location.href = '/superadmin';
                    }, 5000);
                } else {
                    ui.popup.show('warning', result.message, 'Warning');
                }
            } else {
                var res = result;
                $("#modal_detail_notif").modal('show');
                $("#detail_judul").html(res.title);
                $("#detail_dekripsi").html(res.description);
                $("#detail_komunitas").html(res.community_name);
                $("#detail_tanggal").html(dateFormat(res.created_at));
                $("#detail_user").html(res.user_id);
                $("#detail_usertipe").html(res.user_type_title);
                $("#detail_tipenotif").html(res.notifcation_sub_type_title);
                $("#dibuat_oleh").html(res.created_by);

            }
        },
        error: function (result) {
            console.log("Cant Show");
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


$('#komunitas_notif').change(function () {
    var itempilih = this.value;
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_user_notif_super",
        type: "POST",
        dataType: "json",
        data: {
            "user_type": $("#usertipe_notif").val(),
            "community_id": itempilih,
            "_token": token
        },
        success: function (result) {
            console.log(result);
            $('#user_notif').empty();
            $('#user_notif').append("<option disabled value='0'> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#user_notif').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
            }
            $("#user_notif").html($('#user_notif option').sort(function (x, y) {
                return $(x).val() < $(y).val() ? -1 : 1;
            }));

            $("#user_notif").get(0).selectedIndex = 0; const
                OldSubf = "{{old('user_notif')}}";
            if (OldSubf !== '') {
                $('#user_notif').val(OldSubf);
            }
        },
        error: function (result) {
            $('#hide_user_notif').fadeOut("fast");
            $('#user_notif').empty();
            $('#user_notif').append("<option disabled value='0'>No Related User</option>");
        }
    });
});
// ------------------------- END NOTIFICATION MANAGEMENT SUPER -----------------------------


// -------------------------- INBOX MANAGEMENT SUPER ----------------------------

$("#btn_generate_inbox_super").click(function () {
    tabel_inbox_message_super();
});


function tabel_inbox_message_super() {
    $('#tabel_inbox_message_super').dataTable().fnClearTable();
    $('#tabel_inbox_message_super').dataTable().fnDestroy();
    $('#tabel_inbox_message_super').show();
    $('#modal_generate_inbox_tabel').modal('hide');
    var token = $('meta[name="csrf-token"]').attr('content');
    var tabel = $('#tabel_inbox_message_super').DataTable({
        responsive: true,
        language: {
            paginate: {
                next: '<i class="mdi mdi-chevron-right"></i>',
                previous: '<i class="mdi mdi-chevron-left">'
            }
        },
        ajax: {
            url: '/superadmin/tabel_generate_inbox_super',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas_inbox").val(),
                "start_date": $("#tanggal_mulai2").val(),
                "end_date": $("#tanggal_selesai2").val(),
                "filter_title": $("#filter_judul").val(),
                "message_type": $("#tipe_pesan").val(),
                "_token": token
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="9" class="dataTables_empty"><h5 class="cgrey">Data Not Found</h5></td></tr>';
                $('#tabel_inbox_message_super tbody').empty().append(nofound);
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
                        'onclick="detail_message_inbox_super(\'' + inidt + '\')">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],

    });

}


$('#bc_status').change(function () {
    var dipilih = this.value;
    if (dipilih == 1) {
        $("#hide_user_notif").fadeIn("fast");
    } else {
        $("#hide_user_notif").fadeOut("fast");
    }

});


$('#komunitas_inbox').change(function () {
    var itempilih = this.value;
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_user_inbox_super",
        type: "POST",
        dataType: "json",
        data: {
            "user_type": $("#usertipe_inbox").val(),
            "community_id": itempilih,
            "_token": token
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
            $('#hide_user_notif').fadeOut("fast");
            $('#list_user').empty();
            $('#list_user').append("<option disabled value='0'>No Related User</option>");
        }
    });
});


function get_list_komunitas_inbox() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/superadmin/get_list_komunitas_inbox",
        type: "POST",
        dataType: "json",
        success: function (result) {
            console.log(result);

            if (result.success == false) {
                if (result.status == 404) { // Apabila Data Tidak Ditemukan
                    ui.popup.show('warning', result.message, 'Warning');
                } else {
                    get_list_komunitas_inbox();
                }
            } else {
                $('#list_komunitas_inbox').empty();

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_komunitas_inbox').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_komunitas_inbox").html($('#list_komunitas_inbox option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_komunitas_inbox").get(0).selectedIndex = 0;
                // _________________________________________________________________________

                $('#komunitas_inbox').empty();

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#komunitas_inbox').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                }
                //Short Function Ascending//
                $("#komunitas_inbox").html($('#komunitas_inbox option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#komunitas_inbox").get(0).selectedIndex = 0;
                Olddt = "{{old('usekomunitas_notifr_notif')}}";
                if (Olddt !== '') {
                    $('#komunitas_inbox').val(Olddt);
                }

            }
        }
    });
}

function detail_message_inbox_super(params) {
    var dtnya = params.split(',');
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/superadmin/detail_generate_message_inbox_super',
        type: 'POST',
        datatype: 'JSON',
        data: {
            "message_id": dtnya[0],
            "level_status": dtnya[1],
            "community_id": dtnya[2],
            "_token": token
        },
        success: function (result) {
            console.log(result);
            var res = result;

            $("#detail_judul").html(res.title);
            $("#detail_dekripsi").html(res.description);
            $("#detail_komunitas").html(res.community_name);
            $("#detail_date").html(dateFormat(res.created_at));
            $("#detail_user").html(res.user_title);
            $("#detail_usertipe").html(res.user_type_title);
            $("#detail_tipepesan").html(res.message_type_title);
            $("#detail_by").html(res.created_by_title);
            $("#detail_status").html(res.status);
            $("#id_message_inbox").val(res.id);
            $("#id_inbox").val(res.id);
            $("#detail_statuspesan").html(res.status_message);
            $("#detail_senderlevel").html(res.sender_level_title);
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


            // --- data for delete ----
            $("#message_id").val(res.id);
            $("#level_statusq").val(res.level_status);
            $("#community_id").val(res.community_id);
            $("#nama_pesan").html(res.title);


            $("#modal_detail_message_inbox").modal('show');


        },
        error: function (result) {
            console.log(result);
        }
    });
}
// ------------------------ END INBOX MANAGEMENT SUPER ---------------------------




// ---------------------- OPERATIONAL SUPPORT SYSTEM _ SUPERADMIN ----------------------

function tabel_tes_inquiry() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/support/tabel_inquiry_log_activity',
        type: 'POST',
        dataSrc: '',
        timeout: 30000,
        data: {
            "community_id": $("#list_komunitas").val(),
            "start_date": $("#tanggal_mulai").val(),
            "end_date": $("#tanggal_selesai").val(),
            "endpoint": $("#list_endpoint").val(),
            "activity_type": $("#activity_type").val(),
            "subscriber_id": $("#list_subscriber").val(),
        },
        success: function (result) {
            console.log('tabel log ');
            console.log(result);
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show tabel log");
        }
    });
}


$("#btn_generate_log_activity").click(function () {
    tabel_inquiry_log_activity();
    // tabel_tes_inquiry();
});


function tabel_inquiry_log_activity() {
    // $('#tabel_inquiry_log_activity').dataTable().fnClearTable();
    // $('#tabel_inquiry_log_activity').dataTable().fnDestroy();

    $('#tabel_inquiry_log_activity').DataTable().clear().destroy();
    $('#tabel_inquiry_log_activity').empty();

    var uihead = '<thead>' +
        '<tr>' +
        '<th><b> Endpoint </b></th>' +
        '<th><b> Activity </b></th>' +
        '<th><b> Username</b></th>' +
        '<th><b> User Level </b></th>' +
        '<th><b> Date </b></th>' +
        '<th><b> Log Status </b></th>' +
        '<th><b> Action </b></th>' +
        '</tr>' +
        '</thead>';
    $('#tabel_inquiry_log_activity').html(uihead);

    $("#modal_generate_log_activity").modal('hide');
    $("#tabel_inquiry_log_activity").show();

    var tabel = $('#tabel_inquiry_log_activity').DataTable({
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
            url: '/support/tabel_inquiry_log_activity',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "start_date": $("#tanggal_mulai").val(),
                "end_date": $("#tanggal_selesai").val(),
                "endpoint": $("#list_endpoint").val(),
                "activity_type": $("#activity_type").val(),
                "subscriber_id": $("#list_subscriber").val(),
            },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_inquiry_log_activity tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_inquiry_log_activity tbody').empty().append(nofound);

        },
        columns: [
            {
                mData: 'endpoint',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: 'activity',
                render: function (data, type, row, meta) {
                    return '<span class="s12 text-wrap width-250">' + data + '</span>';
                }
            },
            {
                mData: 'user_name',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: 'user_level',
                render: function (data, type, row, meta) {
                    var ini = '';
                    if (data == 1) {
                        ini = '<span class="s13">Admin Commjuction</span>';
                    } else if (data == 2) {
                        ini = '<span class="s13">Admin Community</span>';
                    } else {
                        ini = '<span class="s13">Subscriber</span>';
                    }
                    return ini;
                }
            },
            {
                mData: 'date',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + dateFormat(data) + '</span>';
                }
            },
            {
                mData: 'log_status',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnlihat">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnlihat"><i class="mdi mdi-eye"></i></button>',
                    "targets": -1
                }
            ],

    });

    //DETAIL USERTYPE FROM DATATABLE
    $('#tabel_inquiry_log_activity tbody').on('click', 'button.btnlihat', function () {
        var rownya = $(this).parents('li').length ?
            $(this).parents('li') :
            $(this).parents('tr');
        var data = tabel.row(rownya).data();

        $("#detail_response").jJsonViewer("");
        $("#detail_judul").html("");
        $("#detail_date").html("");
        $("#detail_endpoint").html("");
        $("#detail_ip").html("");
        $("#detail_log_status").html("");
        $("#detail_module").html("");
        $("#detail_request").html("");
        $("#detail_status").html("");
        $("#detail_username").html("");
        $("#detail_userid").html("");
        $("#detail_level").html("");
        $("#detail_elapsed").html("");
        $("#detail_time").html("");

        console.log(data);
        $("#detail_response").jJsonViewer(data.response);
        $("#detail_judul").html(data.activity);
        $("#detail_date").html(dateTime(data.date));
        $("#detail_endpoint").html(data.endpoint);
        $("#detail_ip").html(data.ip);
        $("#detail_log_status").html(data.log_status);
        $("#detail_module").html(data.module);
        $("#detail_request").html(data.request);
        $("#detail_status").html(data.status);
        $("#detail_username").html(data.user_name);
        $("#detail_userid").html(data.user_id);
        var lv = '';
        if (data.user_level == 1) {
            lv = 'Admin Commjunction';
        } else if (data.user_level == 2) {
            lv = 'Admin Community';
        } else {
            lv = 'Subscriber';
        }
        $("#detail_level").html(lv);
        $("#detail_elapsed").html(data.elapsed_time);
        $("#detail_time").html(data.time);

        $("#modal_detail_log_activity").modal('show');

    });

    //RESET FORM FILTER
    $("#list_komunitas").val("");
    $("#tanggal_mulai").val("");
    $("#tanggal_selesai").val("");
    $("#list_endpoint").val("");
    $("#activity_type").val("");
    $("#list_subscriber").val("");
    $("#list_feature").val("");
    $("#list_subfeature").val("");
}






$('#status_komunitas').change(function () {
    var item = $(this);
    var id_status = item.val();

    get_list_komunitas_support(id_status);
});


function get_list_komunitas_support(id_status) {
    // alert(id_status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_komunitas_support",
        type: "POST",
        dataType: "json",
        data: {
            "community_status": id_status
        },
        success: function (result) {
            console.log(result);
            if (result.success == false && result.status != 404) {
                get_list_komunitas_support(id_status)
            } else {
                get_list_feature_support();

                $("#hide_status_kom").show();
                $('#list_komunitas').empty();
                if (result.success == false && result.code == "CMQ01") {
                    $('#list_komunitas').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_komunitas').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_komunitas").get(0).selectedIndex = 0;
                }
            }
        }
    });
} //endfunction

$('#list_komunitas').change(function () {
    var item = $(this);
    var id_kom = item.val();

    get_list_subscriber_support(id_kom);
});

function get_list_feature_support() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_feature_support",
        type: "POST",
        dataType: "json",
        success: function (result) {
            console.log(result);

            $('#list_feature').empty();
            $('#list_feature').append("<option disabled> Choose</option>");

            for (var i = result.length - 1; i >= 0; i--) {
                $('#list_feature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
            }

            $("#list_feature").html($('#list_feature option').sort(function (x, y) {
                return $(x).text() < $(y).text() ? -1 : 1;
            }));

            $("#list_feature").get(0).selectedIndex = 0;

        }
    });
} //endfunction


$('#list_feature').change(function () {
    var item = $(this);
    var id_fitur = item.val();

    get_list_subfeature_support(id_fitur);
});

function get_list_subfeature_support(feature_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_subfeature_support",
        type: "POST",
        dataType: "json",
        data: {
            "feature_id": feature_id
        },
        success: function (result) {
            console.log(result);

            $("#hide_subfitur").show();
            $('#list_subfeature').empty();
            if (result.success == false || result.code == "CMQ01") {
                $('#list_subfeature').append("<option disabled selected> No Data </option>");
            } else {
                $('#list_subfeature').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_subfeature').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].title, "</option>"));
                }
                //Short Function Ascending//
                $("#list_subfeature").html($('#list_subfeature option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_subfeature").get(0).selectedIndex = 0;
            }
        }
    });
} //endfunction

$('#list_subfeature').change(function () {
    var item = $(this);
    var id_subfitur = item.val();

    get_list_endpoint_support(id_subfitur);
});


function get_list_endpoint_support(id_subfitur) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_endpoint_support",
        type: "POST",
        dataType: "json",
        data: {
            "subfeature_id": id_subfitur
        },
        success: function (result) {
            console.log(result);

            $("#hide_endpoint").show();
            $("#hide_aktivitastipe").show();
            $('#list_endpoint').empty();
            if (result.success == false && result.code == "CMQ01") {
                $('#list_endpoint').append("<option disabled selected> No Data </option>");
            } else {
                $('#list_endpoint').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_endpoint').append("<option value=\"".concat(result[i].endpoint, "\">").concat(result[i].endpoint, "</option>"));
                }
                //Short Function Ascending//
                $("#list_endpoint").html($('#list_endpoint option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_endpoint").get(0).selectedIndex = 0;
            }
        }
    });
} //endfunction


$('#activity_type').change(function () {
    var item = $(this);
    var id_tipe = item.val();

    if (id_tipe == "2") {
        $("#hide_subscriber").show();
    } else {
        $("#list_subscriber").val(null);
        $("#hide_subscriber").hide();
    }

});


function get_list_subscriber_support(id_kom) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_subscriber_support",
        type: "POST",
        dataType: "json",
        data: {
            "community_id": id_kom
        },
        success: function (result) {
            console.log(result);

            $('#list_subscriber').empty();
            if (result.success == false || result.code == "CMQ01") {
                $('#list_subscriber').append("<option disabled selected> No Data </option>");
            } else {
                $('#list_subscriber').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_subscriber').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_subscriber").html($('#list_subscriber option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_subscriber").get(0).selectedIndex = 0;
            }
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Subcriber");
        }
    });
} //endfunction



$("#btn_generate_specific").click(function () {
    tabel_inquiry_spesific_com();
});


function tabel_inquiry_spesific_com() {
    // $('#tabel_inquiry_spesific_com').dataTable().fnClearTable();
    // $('#tabel_inquiry_spesific_com').dataTable().fnDestroy();

    $('#tabel_inquiry_spesific_com').DataTable().clear().destroy();
    $('#tabel_inquiry_spesific_com').empty();

    var uihead = '<thead>' +
        '<tr>' +
        '<th><b> Endpoint </b></th>' +
        '<th><b> Activity </b></th>' +
        '<th><b> IP Address</b></th>' +
        '<th><b> Date </b></th>' +
        '<th><b> Time </b></th>' +
        '<th><b> User Level </b></th>' +
        '<th><b> Action </b></th>' +
        '</tr>' +
        '</thead>';
    $('#tabel_inquiry_spesific_com').html(uihead);

    $("#modal_generate_spesific_com").modal('hide');
    $("#tabel_inquiry_spesific_com").show();

    var tabel = $('#tabel_inquiry_spesific_com').DataTable({
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
            url: '/support/tabel_inquiry_spesific_com',
            type: 'POST',
            dataSrc: '',
            timeout: 30000,
            data: {
                "community_id": $("#list_komunitas").val(),
                "activity_type": $("#activity_type").val(),
                "subscriber_id": $("#list_subscriber").val(),
            },
            // success: function (result) {
            //     console.log('tabel com ');
            //     console.log(result);
            // },
            error: function (jqXHR, ajaxOptions, thrownError) {
                var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
                $('#tabel_inquiry_spesific_com tbody').empty().append(nofound);
            },
        },
        error: function (request, status, errorThrown) {
            var nofound = '<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><h3 class="cgrey">Data Not Found</h3</td></tr>';
            $('#tabel_inquiry_spesific_com tbody').empty().append(nofound);

        },
        columns: [
            {
                mData: 'endpoint',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: 'activity',
                render: function (data, type, row, meta) {
                    return '<span class="s12 text-wrap width-250">' + data + '</span>';
                }
            },
            {
                mData: 'ip',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: 'date',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + dateFormat(data) + '</span>';
                }
            },

            {
                mData: 'time',
                render: function (data, type, row, meta) {
                    return '<span class="s13">' + data + '</span>';
                }
            },
            {
                mData: 'user_level',
                render: function (data, type, row, meta) {
                    var ini = '';
                    if (data == 1) {
                        ini = '<span class="s13">Admin Commjuction</span>';
                    } else if (data == 2) {
                        ini = '<span class="s13">Admin Community</span>';
                    } else {
                        ini = '<span class="s13">Subscriber</span>';
                    }
                    return ini;
                }
            },
            {
                mData: null,
                render: function (data, type, row, meta) {
                    return '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnsee">' +
                        '<i class="mdi mdi-eye"></i>' +
                        '</button>';
                }
            }
        ],
        columnDefs:
            [
                {
                    "data": null,
                    "defaultContent": '<button type="button" class="btn btn-gradient-light btn-rounded btn-icon detilhref btnsee"><i class="mdi mdi-eye"></i></button>',
                    "targets": -1
                }
            ],

    });

    //DETAIL USERTYPE FROM DATATABLE
    $('#tabel_inquiry_spesific_com tbody').on('click', 'button.btnsee', function () {
        var rownya = $(this).parents('li').length ?
            $(this).parents('li') :
            $(this).parents('tr');
        var data = tabel.row(rownya).data();
        console.log(data);

        $("#detail_response").jJsonViewer("");
        $("#activity").html("");
        $("#date").html("");
        $("#elapsed_time").html("");
        $("#endpoint").html("");
        $("#feature_id").html("");
        $("#ip").html("");
        $("#module").html("");
        $("#module_endpoint_id").html("");
        $("#request").html("");
        $("#status").html("");
        $("#subfeature_id").html("");
        $("#time").html("");
        $("#user_id").html("");
        $("#user_level").html("");
        $("#user_name").html("");

        var userlv = '';
        if (data.user_level == 1) {
            userlv = 'Admin Commjunction';
        } else if (data.user_level == 2) {
            userlv = 'Admin Community';
        } else {
            userlv = 'Subscriber';
        }

        $("#detail_response").jJsonViewer(data.response);
        $("#activity").html(data.activity);
        $("#date").html(dateTime(data.date));
        $("#elapsed_time").html(data.elapsed_time);
        $("#endpoint").html(data.endpoint);
        $("#feature_id").html(data.feature_id);
        $("#ip").html(data.ip);
        $("#module").html(data.module);
        $("#module_endpoint_id").html(data.module_endpoint_id);
        $("#request").html(data.request);
        $("#status").html(data.status);
        $("#subfeature_id").html(data.subfeature_id);
        $("#time").html(data.time);
        $("#user_id").html(data.user_id);
        $("#user_level").html(userlv);
        $("#user_name").html(data.user_name);


        $("#modal_detail_spesific_inquiry").modal('show');
    });

    $("#list_komunitas").val("");
    $("#activity_type").val("");
    $("#list_subscriber").val("");
}



$('#status_komunitas').change(function () {
    var item = $(this);
    var id_status = item.val();

    get_list_komunitas_support_specific(id_status);
});


function get_list_komunitas_support_specific(id_status) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_komunitas_support",
        type: "POST",
        dataType: "json",
        data: {
            "community_status": id_status
        },
        success: function (result) {
            console.log(result);

            if (result.success == false && result.status != 404) {
                get_list_komunitas_support(id_status)
            } else {

                $("#hide_status_kom").show();
                $('#list_komunitas').empty();
                if (result.success == false && result.code == "CMQ01") {
                    $('#list_komunitas').append("<option disabled selected> No Data </option>");
                } else {
                    $('#list_komunitas').append("<option disabled> Choose</option>");

                    for (var i = result.length - 1; i >= 0; i--) {
                        $('#list_komunitas').append("<option value=\"".concat(result[i].id, "\">").concat(result[i].name, "</option>"));
                    }
                    //Short Function Ascending//
                    $("#list_komunitas").html($('#list_komunitas option').sort(function (x, y) {
                        return $(x).text() < $(y).text() ? -1 : 1;
                    }));

                    $("#list_komunitas").get(0).selectedIndex = 0;
                }
            }
        }
    });
} //endfunction

$('#list_komunitas').change(function () {
    var item = $(this);
    var id_kom = item.val();

    get_list_subscriber_support(id_kom);
    if (id_kom != null && id_kom != "") {
        $("#hide_aktivitastipe").show();
    } else {
        $("#hide_aktivitastipe").hide();
    }
});



$('#activity_type').change(function () {
    var item = $(this);
    var id_tipe = item.val();

    if (id_tipe == "2") {
        $("#hide_subscriber").show();
    } else {
        $("#list_subscriber").val(null);
        $("#hide_subscriber").hide();
    }

});


function get_list_subscriber_support(id_kom) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/support/get_list_subscriber_support",
        type: "POST",
        dataType: "json",
        data: {
            "community_id": id_kom
        },
        success: function (result) {
            console.log(result);

            $('#list_subscriber').empty();
            if (result.success == false || result.code == "CMQ01") {
                $('#list_subscriber').append("<option disabled selected> No Data </option>");
            } else {
                $('#list_subscriber').append("<option disabled> Choose</option>");

                for (var i = result.length - 1; i >= 0; i--) {
                    $('#list_subscriber').append("<option value=\"".concat(result[i].user_id, "\">").concat(result[i].full_name, "</option>"));
                }
                //Short Function Ascending//
                $("#list_subscriber").html($('#list_subscriber option').sort(function (x, y) {
                    return $(x).text() < $(y).text() ? -1 : 1;
                }));

                $("#list_subscriber").get(0).selectedIndex = 0;
            }
        },
        error: function (result) {
            console.log(result);
            console.log("Cant Show Subcriber");
        }
    });
} //endfunction





 // ----------- XX ----------- OPERATIONAL SUPPORT SYSTEM _ SUPERADMIN ----------- XX -----------
