
// LANG -EN-ID
  var lang = new Lang();
        lang.dynamic('id', '/js/langpack/id.json');
        lang.init({
            defaultLang: 'en'
        });

function rupiah(val){
var   bilangan = val;
var reverse = bilangan.toString().split('').reverse().join(''),
  ribuan  = reverse.match(/\d{1,3}/g);
  ribuan  = ribuan.join('.').split('').reverse().join('');

return ribuan;
}

//ON ERROR IMAGE
function errorImg() {
    $('.rounded-circle').attr('src', '/img/fitur.png');
}


/* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }


//-------------- FORM REGISTER2 - ADMIN COMMUNITY.....................//
$('#name_admin').on('keyup', function () {
	var letters = /^[a-zA-Z\s]*$/;
if(this.value == ""){
	$("#name_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_nameadmin").hide();
}else if(this.value.match(letters) && this.value.length >= 3){
	$("#name_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_nameadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#name_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_nameadmin").show();
}
});

$('#phone_admin').on('keyup', function () {

if(this.value == ""){
	$("#phone_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_phone").hide();
  $("#pesan_phone2").hide();
}else if(!isNaN(this.value) && this.value.length >= 10){
	$("#phone_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_phone").hide();
  $("#pesan_phone2").hide();
	$(".error_regis2").hide();
	cektelfonadmin(this.value); //cek ajax to backend
}else{
	$("#phone_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_phone").show();
}
});

function cektelfonadmin(input){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/cektelfon_admin',
      data: {'notelp': input},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
      	console.log(result.success+" - "+ result.message);
      	if(result.success == true){
      		$("#phone_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
			$("#pesan_phone").hide();
			$(".error_regis2").hide();
      	}else{
      		$("#phone_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
			$("#pesan_phone2").show();
      $("#pesan_phone").hide();
      	}
      },
      error: function (result) {
      	console.log("Cant not check unique phone number");

      }
      });

  }


$('#email_admin').on('keyup', function () {
if(this.value == ""){
	$("#email_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_emailadmin").hide();
  $("#pesan_emailadmin2").hide();
  $(".error_regis2").hide();
}else if(IsEmail(this.value)){
	$("#email_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_emailadmin").hide();
  $("#pesan_emailadmin2").hide();
	$(".error_regis2").hide();
  cekemailadmin(this.value); //cek ajax to backend
}else{
	$("#email_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_emailadmin").show();
  $("#pesan_emailadmin2").hide();
}
});

function cekemailadmin(input){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
      url: '/cekemail_admin',
      data: {'email': input},
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result.success+" - "+ result.message);
        if(result.success == true){
          $("#email_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
          $("#pesan_emailadmin").hide();
          $("#pesan_emailadmin2").hide();
          $(".error_regis2").hide();
        }else{
          $("#email_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
          $("#pesan_emailadmin").hide();
          $("#pesan_emailadmin2").show();
        }
      },
      error: function (result) {
        console.log("Cant not check unique phone number");

      }
      });

  }


$('#alamat_admin').on('keyup', function () {
if(this.value == ""){
	$("#alamat_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
}else if(this.value.length >= 10){
	$("#alamat_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_alamatadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#alamat_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_alamatadmin").show();
}
});

$('#username_admin').on('keyup', function () {


	var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9_]+)$/;
if(this.value == ""){
	$("#username_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_usernameadmin").hide();
  $("#pesan_usernameadmin2").hide();
}else if(this.value.match(alpanumeric) && this.value.length >= 6){
	$("#username_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_usernameadmin").hide();
  $("#pesan_usernameadmin2").hide();
	$(".error_regis2").hide();
	cekusername_admin(this.value); //cek ajax to backend
}else{
	$("#username_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_usernameadmin").show();
  $("#pesan_usernameadmin2").hide();
}
});


function cekusername_admin(input){
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
      		$("#username_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
			$("#pesan_usernameadmin").hide();
      $("#pesan_usernameadmin2").hide();
			$(".error_regis2").hide();
      	}else{
      $("#username_admin").removeClass( "is-valid" ).addClass( "is-invalid" );
			$("#pesan_usernameadmin2").show();
      $("#pesan_usernameadmin").hide();
        }
      },
      error: function (result) {
      	console.log("Cant not check unique username");

      }
      });

  }


$('#password_admin').on('keyup', function () {
	var alpanumeric = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
if(this.value == ""){
	$("#password_admin").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_passadmin").hide();
  $(".error_regis2").hide();
}else if(this.value.match(alpanumeric) && this.value.length >= 8){
	$("#password_admin").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_passadmin").hide();
	$(".error_regis2").hide();
}else{
	$("#password_admin").removeClass("is-valid" ).addClass( "is-invalid" );
	$("#pesan_passadmin").show();
}
});

$('#password_confirm').on('keyup', function () {
	var pass = $('#password_admin').val();
if(this.value == ""){
	$("#password_confirm").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pconfirmpass").hide();
  $(".error_regis2").hide();
}else if(this.value == pass){
	$("#password_confirm").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pconfirmpass").hide();
	$(".error_regis2").hide();
}else{
	$("#password_confirm").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pconfirmpass").show();
}
});



// ---------------------- FORM  REGISTER 1 - ADMIN COMMUNITY --------------------//
$('#name_com').on('keyup', function () {
if(this.value == ""){
	$("#name_com").removeClass( "is-valid" ).removeClass( "is-invalid" );
  $("#pesan_namecom").hide();
  $(".error_register1").hide();
}else if( this.value.length >= 3){
	$("#name_com").removeClass( "is-invalid" ).addClass( "is-valid" );
	$("#pesan_namecom").hide();
	$(".error_register1").hide();
}else{
	$("#name_com").removeClass( "is-valid" ).addClass( "is-invalid" );
	$("#pesan_namecom").show();
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
$('.other_type_com').hide();
$('#type_com').show();

$("#pesan_typeother").hide();
$(".error_register1").hide();

$("#type_com").removeClass( "is-invalid is-valid" );
});


$('#type_com').change(function() {
var valjenis = $('#type_com option:selected').val();

if (valjenis != null) {
   $("#type_com").removeClass( "is-invalid" ).addClass( "is-valid" );
   $(".error_register1").hide();

   if(valjenis == 1){
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

//show icon preview
 function previewImgUpload(idhtml,input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#'+idhtml).show().attr('src', e.target.result);

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

   $("#text_dimensi").show();
   $("#pixelicon").text(": "+dimensi+" Pixel").show();
   if(this.value == ""){
    $("#icon_com").removeClass( "is-valid" ).removeClass( "is-invalid" );
    $("#pesan_icon").hide();
    $(".error_register1").hide();
}else if(imgwidth <= 300 && imgheight <= 300){
    $("#icon_com").removeClass( "is-invalid" ).addClass( "is-valid" );
    $("#pesan_icon").hide();
    $(".error_register1").hide();
}else{
    $("#icon_com").removeClass( "is-valid" ).addClass( "is-invalid" );
    $("#pesan_icon").show();
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

function clickImage(modal, img, mdl_img, caption ){
  var modal = document.getElementById(modal);

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById(img);
var modalImg = document.getElementById(mdl_img);
var captionText = document.getElementById(caption);
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("closeq")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
}




// SESSION LOGIN SUBSVRIBER
function session_subscriber_logged(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
      url: '/subscriber/session_subscriber_logged',
      type: 'POST',
      datatype: 'JSON',
      success: function (result) {
        console.log(result);
      // if (result != ""){
      //   $(".logged_fullname").text(result.user.full_name);
      // }
      },
      error: function (result) {
        console.log("Cant Reach Session Logged User Dashboard");
    }
});
}
