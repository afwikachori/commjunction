//-------------- FORM REGISTER2 - ADMIN COMMUNITY.....................//
$('#name_admin').on('keyup', function () {
	var letters = /^[A-Za-z]+$/;
if(this.value == ""){
	$("#name_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
}else if(this.value.match(letters) && this.value.length >= 3){
	$("#name_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_nameadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#name_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_nameadmin").text('At least 3 character and Only Letters!').show();
}
});

$('#phone_admin').on('keyup', function () {
if(this.value == ""){
	$("#phone_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(!isNaN(this.value) && this.value.length >= 10){
	$("#phone_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_phone").hide();
	$(".error_regis2").hide();
}else{
	$("#phone_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_phone").text("At least contains 10 Numbers!").show();
}
});

$('#email_admin').on('keyup', function () {
if(this.value == ""){
	$("#email_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(IsEmail(this.value)){
	$("#email_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_emailadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#email_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_emailadmin").text("Include '@' in format email address!").show();
}
});


$('#alamat_admin').on('keyup', function () {
if(this.value == ""){
	$("#alamat_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value.length >= 10){
	$("#alamat_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_alamatadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#alamat_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_alamatadmin").text("Input your detail address!").show();
}
});

$('#username_admin').on('keyup', function () {
	var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
if(this.value == ""){
	$("#username_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value.match(alpanumeric) && this.value.length >= 6){
	$("#username_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_usernameadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#username_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_usernameadmin").text("Mininum 6 character contain Numbers and Letters!").show();
}
});

$('#password_admin').on('keyup', function () {
	var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
if(this.value == ""){
	$("#password_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value.match(alpanumeric) && this.value.length >= 8){
	$("#password_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_passadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#password_admin").removeClass("is-valid" ).addClass( "is-invalid" );
	$("#pesan_passadmin").text("Mininum 8 character contain Numbers and Letters!").show();
}
});

$('#password_confirm').on('keyup', function () {
	var pass = $('#password_admin').val();
if(this.value == ""){
	$("#password_confirm").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value == pass){
	$("#password_confirm").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pconfirmpass").hide();
	$(".error_regis2").hide();
}else{
	$("#password_confirm").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pconfirmpass").text("Password & Confirm Password didnt match!").show();
}
});



// ---------------------- FORM  REGISTER 1 - ADMIN COMMUNITY --------------------//
$('#name_com').on('keyup', function () {
if(this.value == ""){
	$("#name_com").removeClass( "is-valid" ).removeClass( "is-invalid" );
}else if( this.value.length >= 3){
	$("#name_com").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_namecom").hide();
	$(".error_register1").hide();
}else{
	$("#name_com").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_namecom").text('At least 3 character!').show();
}
});

$("#descrip_com").on("keyup", function () {
if(this.value == ""){
	$("#descrip_com").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value.length >= 10){
	$("#descrip_com").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_deskrpsi").hide();
	$(".error_register1").hide();
}else{
	$("#descrip_com").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_deskrpsi").text("Describe your Community more than 10 Characters!").show();
}
});

//dropdown ajax - jenis community
$( "#close_other" ).click(function() {
$("#pesan_typeother").hide();
$(".error_register1").hide();
});

$('#type_com').change(function() {
var valjenis = $('#type_com option:selected').val();

if (valjenis != null) {
   $("#type_com").removeClass( "is-invalid" ).addClass( "is-valid" );
   $(".error_register1").hide();

   if(valjenis == 0){
   	$('#other_type_com').on('keyup', function () {
   		if(this.value < 1){
   			$("#pesan_typeother").text('Please fill your Community Type!').show();
   		}else{
   			$("#pesan_typeother").hide();
   		}
   	});
   }
}else{
   // $("#type_com").removeClass( "is-valid" ).addClass( "is-invalid" );
   $(".error_register1").show();
}
    }
);


//dropdown ajax - range member community
$('#range_member').change(function() {
var valmember = $('#range_member option:selected').val();

if (valmember != null) {
   $("#range_member").removeClass( "is-invalid" ).addClass( "is-valid" );
   $(".error_register1").hide();
}else{
   $(".error_register1").show();
}
    }
);







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


//show icon preview
 function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#iconcom_view').show().attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }


//image dimension & pesan error img
function dimensionImg(input){
 var file = input.files[0];
  img = new Image();
  img.src = _URL.createObjectURL(file);

  img.onload = function() {
   var imgwidth = this.width;
   var imgheight = this.height;
   var dimensi =(imgwidth +' x '+ imgheight);

   $("#text_dimensi").text("Your image: "+dimensi+" Pixels");
   if(this.value == ""){
    $("#icon_com").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(imgwidth <= 300 && imgheight <= 300){
    $("#icon_com").removeClass( "is-invalid" ).addClass( "is-valid" );
    $("#pesan_icon").hide();
    $(".error_register1").hide();
}else{
    $("#icon_com").removeClass( "is-valid" ).addClass( "is-invalid" );
    $("#pesan_icon").text("Maximum dimension is 300 X 300 Pixels !").show();
}
   }
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