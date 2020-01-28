
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


//FORMAT VALIDASI EMAIL
function IsEmail_valid(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}


//IMAGE FILENAME INPUT
function filenameImg(input){
    var fileName = $(input).val();
         if ( fileName.length > 30){
           var fileNameFst=fileName.substring(0,30);
           $(input).next('.custom-file-label').html(fileNameFst+"...");
         }else{
          $(input).next('.custom-file-label').html(fileName);
         }
}



// SESSION LOGIN SUBSVRIBER 
// function session_subscriber_logged(){
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });
// $.ajax({
//       url: '/subscriber/session_subscriber_logged',
//       type: 'POST',
//       datatype: 'JSON',
//       success: function (result) {
//         console.log("usbs : "+result);
//       // if (result != ""){
//       //   $(".logged_fullname").text(result.user.full_name);
//       // }
//       },
//       error: function (result) {
//         console.log("Cant Reach Session Logged User Dashboard");
//     }
// });
// }
