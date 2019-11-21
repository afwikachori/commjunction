<?php

Route::get('/', function () {
    return view('welcome');
});



//ADMIN COMMUNITY
Route::get('admin','RegisterController@login')->name('admin/login');
Route::post('loginadmin','RegisterController@loginadmin');

//register1
Route::get('admin/register','RegisterController@registerAdminView')->name('admin/register');
Route::post('registerfirst','RegisterController@registerfirst')->name('registerfirst');
Route::post('get_jenis_com', 'RegisterController@get_jenis_com');

//register2
Route::get('admin/register2','RegisterController@register2Admin')->name('register2');
Route::post('registersecond','RegisterController@registersecond')->name('registersecond');

//register - confirm payment
Route::get('admin/confirmpay','RegisterController@confirmpayView')->name('confirmpayView');
Route::post('adminconfirmpay','RegisterController@adminconfirmpay')->name('adminconfirmpay');

// register - pricing
Route::get('admin/pricing','RegisterController@pricingView')->name('pricingView');
Route::post('get_pricing_com', 'RegisterController@get_pricing_com');
Route::post('pricingkefitur', 'RegisterController@pricingkefitur')->name('pricingkefitur');

// register - feature
Route::get('admin/features','RegisterController@featuresView')->name('featuresView');
Route::post('sendfeature', 'RegisterController@sendfeature')->name('sendfeature');

// register - payment
Route::get('admin/payment','RegisterController@paymentView')->name('paymentView');
Route::post('getDetailPay', 'RegisterController@getDetailPay')->name('getDetailPay');
Route::post('sendPaymentAdmin', 'RegisterController@sendPaymentAdmin')->name('sendPaymentAdmin');



// register 6 - register6
Route::get('admin/register6','RegisterController@registerSixView')->name('registerSixView');\
Route::get('admin/loading_creating','RegisterController@loadingcreatingView')->name('loadingcreatingView');
Route::get('admin/finish','RegisterController@finishView')->name('finishView');

// confirm - payment
Route::get('admin/loading_payment','RegisterController@loadingpaymentView')->name('loadingpaymentView');
Route::get('admin/finish_payment','RegisterController@finishpaymentView')->name('finishpaymentView');

// SUBSCRIBER - REGISTRASION
Route::get('subscriber/login','SubscriberController@loginView')->name('subscriber/login');
Route::get('subscriber/registerSubs','SubscriberController@registerSubsView')->name('registerSubsView');



//SUPERADMIN - MANAGEMENT
Route::get('superadmin/register','RegisterController@registerSuperView')->name('superadmin/register');
Route::post('superregister','RegisterController@registerSuper')->name('superregister');
Route::get('superadmin/login','RegisterController@loginSuperadmin')->name('superadmin/login');


