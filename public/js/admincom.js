
var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
  session_admin_logged();
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
      var user = result.user;
    if (result != ""){
      $(".logo_komunitas").attr("src", server_cdn+user.community_logo);
      $(".user_admin_logged").html(user.full_name);
      $(".judul_komunitas").html(user.community_name);
      $(".deskripsi_komunitas").html(user.community_description);
      
       if(user.status == 1){ //first-login
        get_initial_feature(result.feature); //isi data 
        $("#initial1").modal('show');
        $("#comm_status_admin").html("Verified - First Login");
      }else if(user.status == 2){
         $("#comm_status_admin").html("Active");
      }else{ //status=0 belum aktif
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
