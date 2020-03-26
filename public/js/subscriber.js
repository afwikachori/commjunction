
// LANG -EN-ID
// var lang = new Lang();
//       lang.dynamic('id', '/js/langpack/id.json');
//       lang.init({
//           defaultLang: 'en'
//       });

// onerror = "this.onerror=null;this.src=\'' + noimg + '\';"
var server_cdn = '{{ env("CDN") }}';
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
        url: '/subscriber/session_subscriber_logged',
        type: 'POST',
        datatype: 'JSON',
        success: function (result) {
            setTimeout(function () {
                ui.popup.hideLoader();
            }, 5000);
            console.log(result);
            console.log(result.access_token);
            var user = result.user;
                // $(".foto_profil_subs").attr("src", server_cdn + user.__);
            // user_id: "SUBS-147428681295867620200323"
            // user_name: "febri_12345"
            // level: 3
            // full_name: "Febri Al-Chori"
            // notelp: "081234512345"
            // email: "chunpika@yahoo.com"
            // status: 1
            // membership_id: 0
            // membership: "Belum ada membership"
            // community_id: "104"
            // community_created: "2019-11-29T10:47:49.000Z"
            // community_name: "Brian community"
            // community_description: "Ini community adalah sebuah kelompok sosial yang berbagi lingkungan, umumnya memiliki ketertarikan dan habitat yang sama."
            // community_logo: "public/community/edit761f85f9a28c38ba8a4335beeb7f589058dc4e135fbe71d0f4148726ecee3017.jpg"
            // community_type: "PECINTA KUCING"
            // membership_type: 2
            // membership_features: "Belum ada membership"

            $(".nama_subs_login").html(user.full_name);
            $(".membership_status").html(user.membership);
            $("#name_subs").val(user.full_name);
            $("#phone_subs").val(user.notelp);
            $("#username_subs").val(user.user_name);
            $("#email_subs").val(user.email);



        },
        error: function (result) {
            console.log("Cant Reach Session Logged User Dashboard");
        }
    });
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
