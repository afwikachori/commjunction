
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
session_admin_logged();
// file_browser_profil();



});


function session_admin_logged(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/admin/session_admin_logged',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
      // console.log(result);
      //   console.log(result.access_token);
      var user = result.user;
    if (result != ""){
      $(".username_komunitas").html(user.user_name);
      $(".phone_komunitas").html(user.notelp);
      $(".email_komunitas").html(user.email);

      $(".logo_komunitas").attr("src", server_cdn+user.community_logo);
     if(user.picture != "0" ){
      $(".foto_profil_admin").attr("src", server_cdn+user.picture);
      $("#view_edit_user").attr("src", server_cdn+user.picture);
     }
      $(".foto_profil_admin").attr("src", server_cdn+user.picture);
      $("#view_edit_user").attr("src", server_cdn+user.picture);
      $(".user_admin_logged").html(user.full_name);
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
      // if(user.picture != "0"){
      //   $("#view_edit_user").attr("src", server_cdn+user.picture);
      // }


      //edit-profil comm
      $("#edit_namacom").val(user.community_name);
      $("#edit_deskripsicom").val(user.community_description);
      $("#edit_idcom").val(user.user_id);
      $(".logo_komunitas").attr("src", server_cdn+user.community_logo);

       if(user.status == 1){ //first-login
        get_initial_feature(result.feature); //isi data
        $("#initial1").modal('show');
        $("#comm_status_admin").html("Verified - First Login");
        $(".statuscomm").html('Newbie');
         $(".statuscomm").addClass('badge-warning');
      }else if(user.status == 2){
         $("#comm_status_admin").html("Active");
         $(".statuscomm").html('Active');
         $(".statuscomm").addClass('badge-success');
      }else{ //status=0 belum aktif
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


function get_initial_feature(datafitur){
var arr = [];
      arr.push(datafitur);

      var html ='';
     $.each(arr, function(i,item){
    // console.log(item.title);
    html +=
    '<div class="col-md-6 mgku-1">'+
      '<div class="media">'+
          '<img src="'+server_cdn+item.logo+'" class="align-self-center mr-3 rounded-circle" style="width: 10%; height: auto;">'+
           '<div class="media-body">'+
            '<h6 class="s13 cgrey" style="margin-bottom: 0em;">'+
            item.title+'</h6>'+
            '<small class="card-text clight s12">'+
            item.description+'</small>'+
          '</div>'+
        '</div>'+
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
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }//end-valid email


function clickImage(img){
var modal = document.getElementById("mdl-img-click");
var img = document.getElementById(img.id);
var modalImg = document.getElementById("mdl-img-view");

img.onclick = function(){
  $('#mdl-img-click').modal('show');
  modalImg.src = this.src;
}
}

function rupiah(val){
var   bilangan = val;
var reverse = bilangan.toString().split('').reverse().join(''),
  ribuan  = reverse.match(/\d{1,3}/g);
  ribuan  = ribuan.join('.').split('').reverse().join('');

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

$(".tabbable-line li a").click(function() {
  $(".tabbable-line li").removeClass('active');
    $(this).parent().addClass('active');
});


// function file_browser_profil(){

    var readURLuser = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#view_edit_user').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#file_edit_profil_user").on('change', function(){
        readURLuser(this);
    });

    $("#browse_user_admin").on('click', function() {
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
