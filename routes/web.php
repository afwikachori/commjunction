<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/coba','RegisterController@cobaView')->name('admin/coba');

Route::get('admin/testing','RegisterController@test')->name('admin/testing');

Route::get('admin/finalreview','RegisterController@ReviewAdminView')->name('admin/finalreview');

Route::get('admin/logoutsso','RegisterController@logoutssoView');

Route::get('logout','RegisterController@logout');



// ADMIN LOGIN COMMUNITY
// Route::get('admin','AdminCommController@login')->name('admin');
// Route::post('auth_adminlogin', 'AdminCommController@auth_adminlogin')->name('auth_adminlogin');

//ADMIN-COMMUNITY (DASHBOARD)
// Route::get('admin/dashboard','AdminCommController@adminDashboardView')->name('admin/dashboard');

//404
Route::get('404','RequestController@NotFoundView')->name('404');



// admin
Route::prefix('admin')->group(function(){
// GET
Route::get('/','AdminCommController@login')->name('admin');
Route::get('/logout', 'AdminCommController@LogoutAdmin')->name('logout');
Route::get('/dashboard','AdminCommController@adminDashboardView')->name('/dashboard');
Route::get('/publish','AdminCommController@publishAdminView')->name('/publish');
Route::get('/editprofil','AdminCommController@editProfilAdminView')->name('/editprofil');
Route::get('/editprofil','AdminCommController@editProfilAdminView')->name('/editprofil');

// admin/settings
Route::prefix('settings')->group(function(){
Route::get('/','AdminCommController@comSettingView')->name('settings');
Route::get('/loginregis','AdminCommController@loginRegisAdminView')->name('/loginregis');
Route::get('/membership','AdminCommController@membershipAdminView')->name('/membership');
Route::get('/registrasion_data','AdminCommController@regisdataAdminView')->name('/registrasion_data');
Route::get('/payment','AdminCommController@SetpaymentAdminView')->name('/payment');
}); //end-admin


//POST
Route::post('auth_adminlogin', 'AdminCommController@auth_adminlogin')->name('auth_adminlogin');
Route::post('session_admin_logged','AdminCommController@session_admin_logged')->name('session_admin_logged');

});






// REGISTER ADMIN COMMUNITY

//register1
Route::get('admin/register','RegisterController@registerAdminView')->name('admin/register');

Route::get('admin/registerinput','RegisterController@registerInputView')->name('admin/registerinput');

Route::post('registerfirst','RegisterController@registerfirst')->name('registerfirst');
Route::post('get_jenis_com', 'RegisterController@get_jenis_com');



/// SESSION - BACK 
Route::post('session_regisOne', 'RegisterController@session_regisOne')->name('session_regisOne');
Route::post('session_regisTwo', 'RegisterController@session_regisTwo')->name('session_regisTwo');
Route::post('session_pricing', 'RegisterController@session_pricing')->name('session_pricing');
Route::post('session_fitur', 'RegisterController@session_fitur')->name('session_fitur');
Route::post('session_payadmin', 'RegisterController@session_payadmin')->name('session_payadmin');




//FORGET PASSWORD - ADMIN COMMUNITY
Route::get('admin/forgetpass_admin','RegisterController@forgetpassAdminView')->name('admin/forgetpass_admin');

Route::post('requestOTP', 'RegisterController@requestOTP')->name('requestOTP');

Route::post('NewPass_admin', 'RegisterController@NewPass_admin')->name('NewPass_admin');

Route::get('session_resendotp', 'RegisterController@session_resendotp')->name('session_resendotp');


//OTP FORGET -ADMIN
Route::get('admin/otp_admin','RegisterController@otpAdminView')->name('admin/otp_admin');







//register2
Route::get('admin/register2','RegisterController@register2View')->name('register2');
Route::post('registersecond','RegisterController@registersecond')->name('registersecond');
Route::post('cekusername_admin', 'RegisterController@cekusername_admin')->name('cekusername_admin');
Route::post('cektelfon_admin', 'RegisterController@cektelfon_admin')->name('cektelfon_admin');
Route::post('cekemail_admin', 'RegisterController@cekemail_admin')->name('cekemail_admin');


//	ADMIN - CONFIRM PAYMENT REGIS
Route::get('admin/confirm','RegisterController@confirmView')->name('confirmView');

//register - CONFIRM PAYMENT - ADMIN COMM
Route::get('admin/confirmpay','RegisterController@confirmpayView')->name('confirmpayView');

Route::post('get_tipepay','RegisterController@get_tipepay')->name('get_tipepay');

Route::post('get_carapay','RegisterController@get_carapay')->name('get_carapay');

Route::post('get_invoice_num','RegisterController@get_invoice_num')->name('get_invoice_num');


Route::post('adminconfirmpay','RegisterController@adminconfirmpay')->name('adminconfirmpay');







// register - pricing
Route::get('admin/pricing','RegisterController@pricingView')->name('pricingView');
Route::post('get_pricing_com', 'RegisterController@get_pricing_com');
Route::post('pricingkefitur', 'RegisterController@pricingkefitur')->name('pricingkefitur');


// register - feature
Route::get('admin/features','RegisterController@featuresView')->name('admin/features');
Route::post('sendfeature', 'RegisterController@sendfeature')->name('sendfeature');

Route::get('session_backfitur', 'RegisterController@session_backfitur')->name('session_backfitur');

Route::post('addfromdetailFitur', 'RegisterController@addfromdetailFitur')->name('addfromdetailFitur');

// REGISTER ADMIN- DETAIL FITUR

Route::get('admin/features_detail','RegisterController@fiturdetailView')->name('admin/features_detail');

Route::get('admin/features_detail/{id_fitur}', 'RegisterController@detailFiturView')->name('features_detail');


// Route::post('getsubfitur', 'RegisterController@getsubfitur')->name('getsubfitur');


// register - payment
Route::get('admin/payment','RegisterController@paymentView')->name('paymentView');
Route::get('isi_payment','RegisterController@isi_payment')->name('isi_payment');

Route::post('getDetailPay', 'RegisterController@getDetailPay')->name('getDetailPay');

Route::post('getpayment_method', 'RegisterController@getpayment_method')->name('getpayment_method');

Route::post('sendIdPayment', 'RegisterController@sendIdPayment')->name('sendIdPayment');



// register 6 - register6
Route::get('admin/register6','RegisterController@registerSixView')->name('registerSixView');

Route::post('ReviewFinal','RegisterController@ReviewFinal')->name('ReviewFinal');

Route::post('getSelectedFitur', 'RegisterController@getSelectedFitur')->name('getSelectedFitur');

Route::post('getSelectedPrice', 'RegisterController@getSelectedPrice')->name('getSelectedPrice');

Route::post('getSelectedPayment', 'RegisterController@getSelectedPayment')->name('getSelectedPayment');



// FINAL ADMIN REGISTRASION 
Route::get('FinalAdminRegis', 'RegisterController@FinalAdminRegis')->name('FinalAdminRegis');




// LOADING _ FINISH 
Route::get('admin/loading','RegisterController@loadingcreatingView')->name('admin/loading');
Route::get('admin/finish','RegisterController@finishView')->name('finishView');






// confirm - payment
Route::get('admin/loading_payment','RegisterController@loadingpaymentView')->name('loadingpaymentView');
Route::get('admin/finish_payment','RegisterController@finishpaymentView')->name('finishpaymentView');



// SUBSCRIBER - REGISTRASION
Route::prefix('subscriber')->group(function(){
Route::get('/','SubscriberController@loginView')->name('subscriber');

Route::get('/dashboard','SubscriberController@DashboardSubsView')->name('dashboard');

Route::get('/url/{name_community}', 'SubscriberController@AuthSubscriber')->name('subscriber/url/{name_community}');

Route::post('ses_auth_subs', 'SubscriberController@ses_auth_subs')->name('ses_auth_subs');
Route::post('LoginSubscriber', 'SubscriberController@LoginSubscriber')->name('LoginSubscriber');
Route::post('session_subscriber_logged', 'SubscriberController@session_subscriber_logged')->name('session_subscriber_logged');
});


//GET



Route::get('subscriber/register','SubscriberController@registerSubsView')->name('subscriber/register');

Route::get('subscriber/subs_community','SubscriberController@registerCommView')->name('subscriber/subs_community');

Route::get('subscriber/subs_payment','SubscriberController@registerPaymentView')->name('subscriber/subs_payment');

//POST

Route::post('registerSubscriber', 'SubscriberController@registerSubscriber')->name('registerSubscriber');





//SUPERADMIN - MANAGEMENT

Route::get('superadmin','SuperadminController@loginSuperadminView')->name('superadmin');

Route::get('superadmin/dashboard','SuperadminController@dashboarSuperView')->name('superadmin/dashboard');

Route::get('superadmin/user','SuperadminController@UserSuperView')->name('superadmin/user');

Route::get('superadmin/payment','SuperadminController@paymentSuperView')->name('superadmin/payment');

// ---- post -----
Route::post('loginSuperadmin','SuperadminController@loginSuperadmin')->name('loginSuperadmin');

Route::post('postAddUser','SuperadminController@postAddUser')->name('postAddUser');

Route::post('session_logged_dashboard','SuperadminController@session_logged_dashboard')->name('session_logged_dashboard');

Route::post('get_priviledge','SuperadminController@get_priviledge')->name('get_priviledge');

Route::post('list_req_admincomm','SuperadminController@list_req_admincomm')->name('list_req_admincomm');

Route::post('verify_admincom','SuperadminController@verify_admincom')->name('verify_admincom');


