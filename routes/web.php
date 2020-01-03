<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/coba','RegisterController@cobaView')->name('admin/coba');

Route::get('admin/testing','RegisterController@test')->name('admin/testing');

Route::get('admin/reviewfinal','RegisterController@ReviewAdminView')->name('admin/reviewfinal');

Route::get('admin/logoutsso','RegisterController@logoutssoView');

Route::get('logout','RegisterController@logout');







//ADMIN COMMUNITY
Route::get('admin','RegisterController@login')->name('admin/login');
Route::post('auth_adminlogin', 'RegisterController@auth_adminlogin')->name('auth_adminlogin');
Route::post('loginadmin','RegisterController@loginadmin');

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

Route::post('session_resendotp', 'RegisterController@session_resendotp')->name('session_resendotp');


//OTP FORGET -ADMIN
Route::get('admin/otp_admin','RegisterController@otpAdminView')->name('admin/otp_admin');







//register2
Route::get('admin/register2','RegisterController@register2View')->name('register2');
Route::post('registersecond','RegisterController@registersecond')->name('registersecond');
Route::post('cekusername_admin', 'RegisterController@cekusername_admin')->name('cekusername_admin');
Route::post('cektelfon_admin', 'RegisterController@cektelfon_admin')->name('cektelfon_admin');
Route::post('cekemail_admin', 'RegisterController@cekemail_admin')->name('cekemail_admin');




//register - confirm payment
Route::get('admin/confirmpay','RegisterController@confirmpayView')->name('confirmpayView');
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

// register - detail fitur
Route::get('admin/features_detail','RegisterController@fiturdetailView')->name('admin/features_detail');

Route::get('admin/features_detail/{id_fitur}', 'RegisterController@detailFiturView')->name('features_detail');


// Route::post('getsubfitur', 'RegisterController@getsubfitur')->name('getsubfitur');


// register - payment
Route::get('admin/payment','RegisterController@paymentView')->name('paymentView');

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
Route::post('FinalAdminRegis', 'RegisterController@FinalAdminRegis')->name('FinalAdminRegis');




// LOADING _ FINISH 
Route::get('admin/loading_creating','RegisterController@loadingcreatingView')->name('loadingcreatingView');
Route::get('admin/finish','RegisterController@finishView')->name('finishView');






// confirm - payment
Route::get('admin/loading_payment','RegisterController@loadingpaymentView')->name('loadingpaymentView');
Route::get('admin/finish_payment','RegisterController@finishpaymentView')->name('finishpaymentView');



// SUBSCRIBER - REGISTRASION
Route::get('subscriber','SubscriberController@loginView')->name('subscriber');
Route::get('subscriber/subs_personal','SubscriberController@registerPersonalView')->name('subscriber/subs_personal');
Route::get('subscriber/subs_community','SubscriberController@registerCommView')->name('subscriber/subs_community');
Route::get('subscriber/subs_payment','SubscriberController@registerPaymentView')->name('subscriber/subs_payment');

Route::post('url_subscriber', 'SubscriberController@url_subscriber')->name('url_subscriber');
Route::post('registerSubs', 'SubscriberController@registerSubs')->name('registerSubs');





//ADMIN-COMMUNITY (DASHBOARD)
Route::get('admin/dashboard','AdminCommController@adminDashboardView')->name('admin/dashboard');






//SUPERADMIN - MANAGEMENT
Route::get('superadmin/register','SuperadminController@registerSuperView')->name('superadmin/register');

Route::get('superadmin','SuperadminController@loginSuperadmin')->name('superadmin');

Route::get('superadmin/dashboard','SuperadminController@dashboarSuperView')->name('superadmin/dashboard');

Route::get('superadmin/user','SuperadminController@UserSuperView')->name('superadmin/user');


Route::post('postAddUser','SuperadminController@postAddUser')->name('postAddUser');