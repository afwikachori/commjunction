
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
        // console.log(result);
      if (result != ""){
        $(".logged_fullname").text(result.user.full_name);
      }
      },
      error: function (result) {
        console.log("Cant Reach Session Logged User Dashboard");
    }
});
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