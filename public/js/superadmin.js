
// LANG -EN-ID
  // var lang = new Lang();
  //       lang.dynamic('id', '/js/langpack/id.json');
  //       lang.init({
  //           defaultLang: 'en'
  //       });



// FORMAT PISAH UANG RUPIAH
function rupiah(val){
var   bilangan = val;    
var reverse = bilangan.toString().split('').reverse().join(''),
  ribuan  = reverse.match(/\d{1,3}/g);
  ribuan  = ribuan.join('.').split('').reverse().join('');
 
return ribuan;
}



// SESSION LOGIN SUPEADMIN 
function session_logged_dashboard(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/session_logged_dashboard',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      if (result != ""){
        $(".logged_fullname").text(result.user.full_name);
      }
      },
      error: function (result) {
        console.log("Cant Reach Session Logged User Dashboard");
    }
});
}



