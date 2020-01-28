

var server_cdn = '{{ env("CDN") }}';

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
        console.log(result);
      if (result != ""){
      $("#pic_comm").attr("src", server_cdn+result.community_logo);
      $(".admin_name_logged").html(result.full_name);
      
//       $(".status-comm").html();
//       Baru daftar community
// Sudah di verifikasi tapi admin belum login
// Admin sudah login tapi belum di publish
// Sudah di publish

      }
      },
      error: function (result) {
        console.log("Cant Reach Session Logged Admin Community Dashboard");
    }
});
}
