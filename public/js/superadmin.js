
// LANG -EN-ID
  // var lang = new Lang();
  //       lang.dynamic('id', '/js/langpack/id.json');
  //       lang.init({
  //           defaultLang: 'en'
  //       });

var server_cdn = '{{ env("CDN") }}';

$(document).ready(function () {
    session_logged_superadmin();

});


//tab-line
$(".tabbable-line li a").click(function () {
    $(".tabbable-line li").removeClass('active');
    $(this).parent().addClass('active');
});


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
// show filename di inputfile
function filenameImg(input){
    var fileName = $(input).val();
         if ( fileName.length > 30){
           var fileNameFst=fileName.substring(0,30);
           $(input).next('.custom-file-label').html(fileNameFst+"...");
         }else{
          $(input).next('.custom-file-label').html(fileName);
         }
}



// SESSION LOGIN SUPEADMIN
function session_logged_superadmin(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url: '/session_logged_superadmin',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
          console.log(result.access_token);
      if (result != ""){
        $(".logged_fullname").text(result.user.full_name);
      }
      },
      error: function (result) {
        console.log("Cant Reach Session Logged Admin Comjuction");
    }
});
}


function errorImg() {
    $('.rounded-circle').attr('src', '/img/noimg.jpg');
}



// VALIDASI FORM SUPERADMIN - ADD User
$('#name_superadmin').on('keyup', function () {
  var letters = /^[a-zA-Z\s]*$/;
if(this.value == ""){
  $("#name_superadmin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_namesuper").hide();
}else if(this.value.match(letters) && this.value.length >= 3){
  $("#name_superadmin").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_namesuper").hide();
}else{
  $("#name_superadmin").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_namesuper").html("At least 3 character and Only Letters!").show();
}
});


$('#phone_super').on('keyup', function () {
if(this.value == ""){
  $("#phone_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_phonesuper").hide();
}else if(!isNaN(this.value) && this.value.length >= 10){
  $("#phone_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_phonesuper").hide();
}else{
  $("#phone_super").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_phonesuper").html("At least 10 Numbers").show();
}
});


$('#email_super').on('keyup', function () {
  console.log(this.value);
if(this.value == ""){
  $("#email_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_emailsuper").hide();
}else if(IsEmail_valid(this.value)){
  $("#email_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_emailsuper").hide();
}else{
  $("#email_super").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_emailsuper").html("Include '@' in format email address!").show();
}
});


$('#division_super').on('keyup', function () {
  var letters = /^[a-zA-Z\s]*$/;
if(this.value == ""){
  $("#division_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_divisisuper").hide();
}else if(this.value.match(letters)){
  $("#division_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_divisisuper").hide();
}else{
  $("#division_super").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_divisisuper").html("Only Letters Allowed").show();
}
});


$('#password_super').on('keyup', function () {
  var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
if(this.value == ""){
  $("#password_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_passuper").hide();
}else if(this.value.match(alpanumeric) && this.value.length >= 8){
  $("#password_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_passuper").hide();
  $(".error_regis2").hide();
}else{
  $("#password_super").removeClass("is-valid" ).addClass( "is-invalid" );
  $("#pesan_passuper").html("Mininum 8 character contain Numbers and Letters!").show();
}
});


$('#password_confirm').on('keyup', function () {
  var pass = $('#password_super').val();
if(this.value == ""){
  $("#password_confirm").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_cfpass").hide();
}else if(this.value == pass){
  $("#password_confirm").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_cfpass").hide();
}else{
  $("#password_confirm").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_cfpass").html("Password & Confirm Password didnt match!").show();
}
});


$('#username_super').on('keyup', function () {
  var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/;
if(this.value == ""){
  $("#username_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_usernamesuper").hide();
}else if(this.value.match(alpanumeric) && this.value.length >= 6){
  $("#username_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_usernamesuper").hide();
  cekusername_superadmin(this.value); //cek ajax to backend
}else{
  $("#username_super").removeClass( "is-valid" ).addClass( "is-invalid" );
  $("#pesan_usernamesuper").html("Mininum 6 character contain Numbers and Letters!").show();
}
});


function cekusername_superadmin(input){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/cekusername_admin',
      data: {'user_name': input},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
      console.log(result.success+" - "+ result.message);
      if(result.success == true){
      $("#username_super").removeClass( "is-invalid" ).addClass( "is-valid" );
      $("#pesan_usernamesuper").hide();
        }else{
      $("#username_super").removeClass( "is-valid" ).addClass( "is-invalid" );
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
if(this.value == ""){
  $("#pass_super").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_paswotsuper").hide();
}else if(this.value.match(alpanumeric) && this.value.length >= 8){
  $("#pass_super").removeClass( "is-invalid" ).addClass( "is-valid" );
  $("#pesan_paswotsuper").hide();
}else{
  $("#pass_super").removeClass("is-valid" ).addClass( "is-invalid" );
  $("#pesan_paswotsuper").html("Mininum 8 character contain Numbers and Letters!").show();
}
});


$('#fileup').on('change', function () {
  if(this.value != ""){
    $("#btn_verifyreq").removeAttr("disabled");
    $("#pesan_fileup").hide();
  }else{
    $("#pesan_fileup").html("Please, Choose image first").show();

  }
 });

function clickImage(img){
  // $('#mdl-img-click').modal('show');
var modal = document.getElementById("mdl-img-click");
var img = document.getElementById(img.id);
var modalImg = document.getElementById("mdl-img-view");

img.onclick = function(){
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

