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
Route::get('/subs_management','AdminCommController@SubsManagementView')->name('/subs_management');
Route::get('/membership_management','AdminCommController@MembershipManagementView')->name('/membership_management');
Route::get('/user_management','AdminCommController@UserManagementView')->name('/user_management');

Route::get('detail_subscriber/{id_subs}', 'AdminCommController@detailSubcriberManagementView')->name('detail_subscriber/{id_subs}');
Route::get('edit_subscriber/{id_subs}', 'AdminCommController@editSubsManagementView')->name('edit_subscriber/{id_subs}');

Route::get('detail_pendingsubs/{id_subs}', 'AdminCommController@detailPendingSubcriberView')->name('detail_pendingsubs/{id_subs}');


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
Route::post('get_dashboard_admin','AdminCommController@get_dashboard_admin')->name('get_dashboard_admin');

Route::post('tabel_subs_management','AdminCommController@tabel_subs_management')->name('tabel_subs_management');
Route::post('tabel_subs_pending','AdminCommController@tabel_subs_pending')->name('tabel_subs_pending');

Route::post('edit_profil_community','AdminCommController@edit_profil_community')->name('edit_profil_community');

Route::post('setting_publish_comm','AdminCommController@setting_publish_comm')->name('setting_publish_comm');

Route::post('setting_loginresgis_comm','AdminCommController@setting_loginresgis_comm')->name('setting_loginresgis_comm');

Route::post('setting_membership_comm','AdminCommController@setting_membership_comm')->name('setting_membership_comm');

Route::post('tabel_list_regisdata','AdminCommController@tabel_list_regisdata')->name('tabel_list_regisdata');

Route::post('setting_regisdata_comm','AdminCommController@setting_regisdata_comm')->name('setting_regisdata_comm');

Route::post('get_list_membership_admin','AdminCommController@get_list_membership_admin')->name('get_list_membership_admin');

Route::post('tabel_req_membership','AdminCommController@tabel_req_membership')->name('tabel_req_membership');

Route::post('filter_membership_subs', 'AdminCommController@filter_membership_subs')->name('filter_membership_subs');

Route::post('tabel_payment_community','AdminCommController@tabel_payment_community')->name('tabel_payment_community');

Route::post('get_membership_subs', 'AdminCommController@get_membership_subs');

Route::post('get_payment_tipe', 'AdminCommController@get_payment_tipe');

Route::post('get_bank_pay','AdminCommController@get_bank_pay');

Route::post('get_detail_membership_req', 'AdminCommController@get_detail_membership_req')->name('get_detail_membership_req');

Route::post('edit_profile_admincom', 'AdminCommController@edit_profile_admincom')->name('edit_profile_admincom');

Route::post('change_password_admincom', 'AdminCommController@change_password_admincom')->name('change_password_admincom');

Route::post('tabel_user_management', 'AdminCommController@tabel_user_management')->name('tabel_user_management');

Route::post('add_user_management', 'AdminCommController@add_user_management')->name('add_user_management');

Route::post('get_user_tipe_manage', 'AdminCommController@get_user_tipe_manage')->name('get_user_tipe_manage');

Route::post('nonaktif_status_subs', 'AdminCommController@nonaktif_status_subs')->name('nonaktif_status_subs');

Route::post('approval_req_membership', 'AdminCommController@approval_req_membership')->name('approval_req_membership');

Route::post('detail_user_management', 'AdminCommController@detail_user_management')->name('detail_user_management');

Route::post('edit_user_management', 'AdminCommController@edit_user_management')->name('edit_user_management');

Route::post('approval_pending_subs', 'AdminCommController@approval_pending_subs')->name('approval_pending_subs');

Route::post('add_payment_subs', 'AdminCommController@add_payment_subs')->name('add_payment_subs');



}); //ADMIN-COMMUNITY








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
Route::prefix('dashboard')->group(function(){
Route::get('/','SubscriberController@DashboardSubsView')->name('dashboard');
Route::get('/membership','SubscriberController@MembershipSubsView')->name('membership');
});

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
Route::get('superadmin/logout', 'SuperadminController@LogoutSuperadmin')->name('superadmin/logout');

Route::post('loginSuperadmin','SuperadminController@loginSuperadmin')->name('loginSuperadmin');

Route::post('postAddUser','SuperadminController@postAddUser')->name('postAddUser');

Route::post('session_logged_dashboard','SuperadminController@session_logged_dashboard')->name('session_logged_dashboard');

Route::post('get_priviledge','SuperadminController@get_priviledge')->name('get_priviledge');

Route::post('list_req_admincomm','SuperadminController@list_req_admincomm_func')->name('list_req_admincomm');

Route::post('verify_admincom','SuperadminController@verify_admincom')->name('verify_admincom');


