<?php
Route::domain('{subdomain}.smartcomm.id')->group(function () {
    // Route::get('/', function ($subdomain) {
    //     dd($subdomain);
    // });
      Route::get('/', 'SubscriberController@GetdataSubdomainSubscriber');
});


Route::get('/', function () {
    // dd(env('CDN'));
    return view('welcome');
});

Route::get('/teshtml', function () {
    return view('teshtml');
});



Route::get('admin/finalreview', 'RegisterController@ReviewAdminView')->name('admin/finalreview');

Route::get('admin/logoutsso', 'RegisterController@logoutssoView');

Route::get('logout', 'RegisterController@logout');

//404
Route::get('404', 'RequestController@NotFoundView')->name('404');






// ADMIN COMMUNITY
Route::prefix('admin')->group(function () {
    Route::get('/featurelist', 'RegisterController@FeatureListRegisterView')->name('/featurelist');
    Route::get('/', 'AdminCommController@login')->name('/');
    Route::get('/dashboard', 'AdminCommController@adminDashboardView')->name('/dashboard');
    Route::get('/publish', 'AdminCommController@publishAdminView')->name('/publish');
    Route::get('/editprofil', 'AdminCommController@editProfilAdminView')->name('/editprofil');
    Route::get('/editprofil', 'AdminCommController@editProfilAdminView')->name('/editprofil');
    Route::get('/subs_management', 'AdminCommController@SubsManagementView')->name('/subs_management');
    Route::get('/membership_management', 'AdminCommController@MembershipManagementView')->name('/membership_management');
    Route::get('/user_management', 'AdminCommController@UserManagementView')->name('/user_management');
    Route::get('detail_subscriber/{id_subs}', 'AdminCommController@detailSubcriberManagementView')->name('detail_subscriber/{id_subs}');
    Route::get('edit_subscriber/{id_subs}', 'AdminCommController@editSubsManagementView')->name('edit_subscriber/{id_subs}');
    Route::get('detail_pendingsubs/{id_subs}', 'AdminCommController@detailPendingSubcriberView')->name('detail_pendingsubs/{id_subs}');
    Route::get('/module_management', 'AdminCommController@ModuleManagementView')->name('/module_management');
    Route::get('setting_publish_comm', 'AdminCommController@setting_publish_comm')->name('setting_publish_comm');
    Route::get('/notification_management', 'AdminCommController@NotificationManagementAdminCommunity')->name('/notification_management');
    Route::get('/payment_management', 'AdminCommController@PaymentManagementAdminCommunity')->name('/payment_management');
    Route::get('/inbox_management', 'AdminCommController@InboxMessageManagementAdmin')->name('/inbox_management');
    Route::get('/usertype_management', 'AdminCommController@usertypeManagementAdminView')->name('/usertype_management');
    Route::get('/transaction', 'AdminCommController@TransactionManagementViewAdmin')->name('/transaction');
    Route::get('/module_report', 'AdminCommController@ModuleReportManagementView')->name('/module_report');
    Route::get('/report_management', 'AdminCommController@ReportManagementViewAdmin')->name('/report_management');
    Route::get('logout_admin_href', 'AdminCommController@logout_admin_href')->name('logout_admin_href');


    // MODULE EVENT
    Route::get('/event', 'ModuleController@EventModuleView')->name('get.admin.event-list');
    Route::post('tabel_event_list_admin', 'ModuleController@tabel_event_list_admin')->name('tabel_event_list_admin');
    Route::post('create_new_event_admin', 'ModuleController@create_new_event_admin')->name('post.admin.create-event');
    Route::post('edit_new_event_admin', 'ModuleController@edit_new_event_admin')->name('post.admin.edit-event');
    Route::post('share_event_admin', 'ModuleController@share_event_admin')->name('post.admin.share-event');
    Route::post('create_new_ticket_admin', 'ModuleController@create_new_ticket_admin')->name('post.admin.create-ticket');
    Route::post('tabel_ticket_list_admin', 'ModuleController@tabel_ticket_list_admin')->name('post.admin.list-ticket');
    Route::post('delete_ticket_event_admin', 'ModuleController@delete_ticket_event_admin')->name('post.admin.delete-ticket');
   // PARTICIPANT
    Route::get('/participant', 'ModuleController@participantEventModuleView')->name('get.admin.participant-list');

    //VENUE
    Route::get('/venue_list', 'ModuleController@VenueListAdmin')->name('get.admin.venue-list');
    Route::get('/last_venue', 'ModuleController@LastVenueListAdmin')->name('get.admin.last-venue');
    Route::get('detail_venue/{id_venue}', 'ModuleController@detailVenueAdmin')->name('get.admin.detail-venue/{id_subs}');
    Route::get('/venue', 'ModuleController@createNewVenueAdmin')->name('get.admin.create-venue');
    Route::get('/publish_venue/{id_venue}', 'ModuleController@publishVenueAdmin')->name('post.admin.publish-venue/{id_venue}');


    Route::post('create_new_venue', 'ModuleController@PostcreateNewVenueAdmin')->name('post.admin.create-venue');






    //NEWS
    Route::get('/news_management', 'ModuleController@NewsManagementView')->name('/news_management');
    Route::get('/news_list', 'ModuleController@NewsList')->name('/news_list');
    Route::get('/get_detail_news/{id_news}', 'ModuleController@getDetailNews')->name('/get_detail_news');
    Route::get('/community_setting', 'AdminCommController@CommunitySettingsView')->name('community_setting');


    //POST
    Route::post('send_love_news_admin', 'ModuleController@send_love_news_admin')->name('send_love_news_admin');
    Route::post('/tabel_news_management', 'ModuleController@tabel_news_management')->name('/tabel_news_management');
    Route::post('/get_detail_news', 'ModuleController@getDetailNews')->name('/get_detail_news');
    Route::post('get_data_edit', 'ModuleController@getDataEdit')->name('get_data_edit');
    Route::post('edit_news_management', 'ModuleController@edit_news_management')->name('edit_news_management');
    Route::post('add_news_management', 'ModuleController@add_news_management')->name('add_news_management');
    Route::post('publish_news', 'ModuleController@PublishNews')->name('publish_news');
    Route::post('scrape_news', 'ModuleController@ScrapeNews')->name('scrape_news');
    Route::post('get_headline_news', 'ModuleController@getHeadlineNews')->name('get_headline_news');
    Route::post('tabel_last_news', 'ModuleController@LastNews')->name('tabel_last_news');
    Route::post('table_topvisit_news', 'ModuleController@TopVisitNews')->name('table_topvisit_news');
    Route::post('table_toploved_news', 'ModuleController@TopLovedNews')->name('table_toploved_news');
    Route::post('publish_headline', 'ModuleController@PublishHeadline')->name('publish_headline');



    Route::post('get_status_com_publish', 'AdminCommController@get_status_com_publish')->name('get_status_com_publish');
    Route::post('get_list_custum_inputipe', 'AdminCommController@get_list_custum_inputipe')->name('get_list_custum_inputipe');
    Route::post('get_list_notif_navbar', 'AdminCommController@get_list_notif_navbar')->name('get_list_notif_navbar');
    Route::post('setting_subpayment_admin', 'AdminCommController@setting_subpayment_admin')->name('setting_subpayment_admin');
    Route::post('get_payment_module', 'AdminCommController@get_payment_module')->name('get_payment_module');
    Route::post('detail_tabel_subpayment', 'AdminCommController@detail_tabel_subpayment')->name('detail_tabel_subpayment');
    Route::post('edit_usertype_management_admin', 'AdminCommController@edit_usertype_management_admin')->name('edit_usertype_management_admin');
    Route::post('LogoutAdmin', 'AdminCommController@LogoutAdmin')->name('LogoutAdmin');
    Route::post('send_setting_module_admin', 'AdminCommController@send_setting_module_admin')->name('send_setting_module_admin');
    Route::post('get_result_setup_comsetting', 'AdminCommController@get_result_setup_comsetting')->name('get_result_setup_comsetting');
    Route::post('tabel_report_subscriber_admin', 'AdminCommController@tabel_report_subscriber_admin')->name('tabel_report_subscriber_admin');
    Route::post('get_list_subscriber_report', 'AdminCommController@get_list_subscriber_report')->name('get_list_subscriber_report');
    Route::post('get_list_transaction_type_admin', 'AdminCommController@get_list_transaction_type_admin')->name('get_list_transaction_type_admin');
    Route::post('tabel_concile_report_admin', 'AdminCommController@tabel_concile_report_admin')->name('tabel_concile_report_admin');
    Route::post('tabel_report_transaksi_admin', 'AdminCommController@tabel_report_transaksi_admin')->name('tabel_report_transaksi_admin');
    Route::post('edit_payment_subs', 'AdminCommController@edit_payment_subs')->name('edit_payment_subs');
    Route::post('get_list_user_notif_super', 'AdminCommController@get_list_user_notif_super')->name('get_list_user_notif_super');
    Route::post('detail_transaksi_superadmin', 'AdminCommController@detail_transaksi_superadmin')->name('detail_transaksi_superadmin');
    Route::post('tabel_transaksi_show', 'AdminCommController@tabel_transaksi_show')->name('tabel_transaksi_show');
    Route::post('edit_setting_regisdata_comm', 'AdminCommController@edit_setting_regisdata_comm')->name('edit_setting_regisdata_comm');
    Route::post('get_list_subcriber_name', 'AdminCommController@get_list_subcriber_name')->name('get_list_subcriber_name');
    Route::post('get_list_transaction_tipe', 'AdminCommController@get_list_transaction_tipe')->name('get_list_transaction_tipe');
    Route::post('get_list_komunitas', 'AdminCommController@get_list_komunitas')->name('get_list_komunitas');
    Route::post('add_new_usertype_management_admin', 'AdminCommController@add_new_usertype_management_admin')->name('add_new_usertype_management_admin');
    Route::post('get_list_fitur_membership_admin', 'AdminCommController@get_list_fitur_membership_admin')->name('get_list_fitur_membership_admin');
    Route::post('get_listfitur_usertype_ceklist', 'AdminCommController@get_listfitur_usertype_ceklist')->name('get_listfitur_usertype_ceklist');
    Route::post('add_create_membership_admin', 'AdminCommController@add_create_membership_admin')->name('add_create_membership_admin');
    Route::post('tabel_usertype_admin', 'AdminCommController@tabel_usertype_admin')->name('tabel_usertype_admin');
    Route::post('get_list_setting_module_admin', 'AdminCommController@get_list_setting_module_admin')->name('get_list_setting_module_admin');
    Route::post('change_status_inbox_message_admin', 'AdminCommController@change_status_inbox_message_admin')->name('change_status_inbox_message_admin');
    Route::post('delete_message_inbox_admin', 'AdminCommController@delete_message_inbox_admin')->name('delete_message_inbox_admin');
    Route::post('send_inbox_message_admin', 'AdminCommController@send_inbox_message_admin')->name('send_inbox_message_admin');
    Route::post('detail_generate_message_inbox_super_admin', 'AdminCommController@detail_generate_message_inbox_super_admin')->name('detail_generate_message_inbox_super_admin');
    Route::post('get_list_subscriber_inbox_admin', 'AdminCommController@get_list_subscriber_inbox_admin')->name('get_list_subscriber_inbox_admin');
    Route::post('tabel_generate_inbox_admin', 'AdminCommController@tabel_generate_inbox_admin')->name('tabel_generate_inbox_admin');
    Route::post('aktivasi_payment_admin', 'AdminCommController@aktivasi_payment_admin')->name('aktivasi_payment_admin');
    Route::post('get_setting_subpayment_admin', 'AdminCommController@get_setting_subpayment_admin')->name('get_setting_subpayment_admin');
    Route::post('detail_payment_all_admin', 'AdminCommController@detail_payment_all_admin')->name('detail_payment_all_admin');
    Route::post('tabel_payment_active_admin', 'AdminCommController@tabel_payment_active_admin')->name('tabel_payment_active_admin');
    Route::post('tabel_payment_all_admin', 'AdminCommController@tabel_payment_all_admin')->name('tabel_payment_all_admin');
    Route::post('setting_notification_admin', 'AdminCommController@setting_notification_admin')->name('setting_notification_admin');
    Route::post('get_list_setting_notif_admin', 'AdminCommController@get_list_setting_notif_admin')->name('get_list_setting_notif_admin');
    Route::post('send_notification_admin', 'AdminCommController@send_notification_admin')->name('send_notification_admin');
    Route::post('list_komunitas_notif', 'AdminCommController@list_komunitas_notif')->name('list_komunitas_notif');
    Route::post('detail_generate_notif_admin', 'AdminCommController@detail_generate_notif_admin')->name('detail_generate_notif_admin');
    Route::post('tabel_generate_notification_admin', 'AdminCommController@tabel_generate_notification_admin')->name('tabel_generate_notification_admin');
    Route::post('auth_adminlogin', 'AdminCommController@auth_adminlogin')->name('auth_adminlogin');
    Route::post('session_admin_logged', 'AdminCommController@session_admin_logged')->name('session_admin_logged');
    Route::post('get_dashboard_admin', 'AdminCommController@get_dashboard_admin')->name('get_dashboard_admin');
    Route::post('tabel_subs_management', 'AdminCommController@tabel_subs_management')->name('tabel_subs_management');
    Route::post('tabel_subs_pending', 'AdminCommController@tabel_subs_pending')->name('tabel_subs_pending');
    Route::post('edit_profil_community', 'AdminCommController@edit_profil_community')->name('edit_profil_community');
    Route::post('setting_loginresgis_comm', 'AdminCommController@setting_loginresgis_comm')->name('setting_loginresgis_comm');
    Route::post('setting_membership_comm', 'AdminCommController@setting_membership_comm')->name('setting_membership_comm');
    Route::post('tabel_list_regisdata', 'AdminCommController@tabel_list_regisdata')->name('tabel_list_regisdata');
    Route::post('add_regisdata_comm', 'AdminCommController@add_regisdata_comm')->name('add_regisdata_comm');
    Route::post('get_list_membership_admin', 'AdminCommController@get_list_membership_admin')->name('get_list_membership_admin');
    Route::post('tabel_req_membership', 'AdminCommController@tabel_req_membership')->name('tabel_req_membership');
    Route::post('filter_membership_subs', 'AdminCommController@filter_membership_subs')->name('filter_membership_subs');
    Route::post('tabel_payment_community', 'AdminCommController@tabel_payment_community')->name('tabel_payment_community');
    Route::post('get_membership_subs', 'AdminCommController@get_membership_subs');
    Route::post('get_payment_tipe', 'AdminCommController@get_payment_tipe');
    Route::post('get_bank_pay', 'AdminCommController@get_bank_pay');
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
    Route::post('delete_payment_subs', 'AdminCommController@delete_payment_subs')->name('delete_payment_subs');
    Route::post('get_active_module_list', 'AdminCommController@get_active_module_list')->name('get_active_module_list');
    Route::post('get_all_module_list', 'AdminCommController@get_all_module_list')->name('get_all_module_list');
    Route::post('detail_module_all', 'AdminCommController@detail_module_all')->name('detail_module_all');
    Route::post('aktifasi_module_admincomm', 'AdminCommController@aktifasi_module_admincomm')->name('aktifasi_module_admincomm');
    Route::post('cek_prepare_publish', 'AdminCommController@cek_prepare_publish')->name('cek_prepare_publish');
    Route::post('tabel_subscriber_report_super', 'AdminCommController@tabel_subscriber_report_super')->name('tabel_subscriber_report_super');
    Route::post('get_list_subscriber_report_super', 'AdminCommController@get_list_subscriber_report_super')->name('get_list_subscriber_report_super');

//=========================== SUPPORTPAL ==============================//
Route::prefix('supportpal')->group(function () {
    Route::get('/', function () {
        if (session()->has('session_admin_logged')) {
           return view('admin.supportpal.awal');
        }else{
            return redirect('admin');
        }
    });

    Route::prefix('article')->group(function () {
    Route::get('/', function () {
        return view('admin.supportpal.article_view');
    });
    Route::get('article-list', 'SupportpalController@listArticle')->name('get.admin.list');
    Route::post('article-detail', 'SupportpalController@detailArticle')->name('get.admin.detail');
    Route::post('article-search', 'SupportpalController@searchArticle')->name('get.admin.search');
    Route::post('set-rating', 'SupportpalController@setRating')->name('post.admin.rating');
    });

    Route::prefix('ticket')->group(function () {
    Route::get('/', function () {
        return view('admin.supportpal.ticket_view');
    });
    Route::get('ticket-list', 'SupportpalController@listTicket')->name('get.ticket.list.admin');
    Route::get('ticket-detail/{id}', 'SupportpalController@detailTicket')->name('get.ticket.detail.admin');
    Route::get('ticket-create', 'SupportpalController@createTicketView')->name('get.ticket.create.admin');
    Route::post('ticket-createreq', 'SupportpalController@createTicketReq')->name('post.ticket.createreq.admin');
    Route::get('ticket-update/{id}/{value}', 'SupportpalController@updateTicket')->name('get.ticket.update.admin');
    });

    Route::prefix('message')->group(function () {
    Route::get('{id}', 'SupportpalController@listMessage')->name('get.message.list.admin');
    Route::post('create', 'SupportpalController@createMessage')->name('post.message.create.admin');
    });
}); //end-supportpal

}); //ADMIN-COMMUNITY


// REGISTER ADMIN COMMUNITY
//register1
Route::get('admin/register', 'RegisterController@registerAdminView')->name('admin/register');
Route::get('admin/registerinput', 'RegisterController@registerInputView')->name('admin/registerinput');
Route::post('registerfirst', 'RegisterController@registerfirst')->name('registerfirst');
Route::post('get_jenis_com', 'RegisterController@get_jenis_com');
/// SESSION - BACK
Route::post('session_regisOne', 'RegisterController@session_regisOne')->name('session_regisOne');
Route::post('session_regisTwo', 'RegisterController@session_regisTwo')->name('session_regisTwo');
Route::post('session_pricing', 'RegisterController@session_pricing')->name('session_pricing');
Route::post('session_fitur', 'RegisterController@session_fitur')->name('session_fitur');
Route::post('session_payadmin', 'RegisterController@session_payadmin')->name('session_payadmin');
//FORGET PASSWORD - ADMIN COMMUNITY
Route::get('admin/forgetpass_admin', 'RegisterController@forgetpassAdminView')->name('admin/forgetpass_admin');
Route::post('requestOTP', 'RegisterController@requestOTP')->name('requestOTP');
Route::post('NewPass_admin', 'RegisterController@NewPass_admin')->name('NewPass_admin');
Route::get('session_resendotp', 'RegisterController@session_resendotp')->name('session_resendotp');
//OTP FORGET -ADMIN
Route::get('admin/otp_admin', 'RegisterController@otpAdminView')->name('admin/otp_admin');
//register2
Route::get('admin/register2', 'RegisterController@register2View')->name('register2');
Route::post('registersecond', 'RegisterController@registersecond')->name('registersecond');
Route::post('cekusername_admin', 'RegisterController@cekusername_admin')->name('cekusername_admin');
Route::post('cektelfon_admin', 'RegisterController@cektelfon_admin')->name('cektelfon_admin');
Route::post('cekemail_admin', 'RegisterController@cekemail_admin')->name('cekemail_admin');
//	ADMIN - CONFIRM PAYMENT REGIS
Route::get('admin/confirm', 'RegisterController@confirmView')->name('confirmView');
//register - CONFIRM PAYMENT - ADMIN COMM
Route::get('admin/confirmpay', 'RegisterController@confirmpayView')->name('confirmpayView');
Route::post('get_tipepay', 'RegisterController@get_tipepay')->name('get_tipepay');
Route::post('get_carapay', 'RegisterController@get_carapay')->name('get_carapay');
Route::post('get_invoice_num', 'RegisterController@get_invoice_num')->name('get_invoice_num');
Route::post('adminconfirmpay', 'RegisterController@adminconfirmpay')->name('adminconfirmpay');
// register - pricing
Route::get('admin/pricing', 'RegisterController@pricingView')->name('pricingView');
Route::post('get_pricing_com', 'RegisterController@get_pricing_com');
Route::post('pricingkefitur', 'RegisterController@pricingkefitur')->name('pricingkefitur');
// register - feature
Route::post('get_list_feature_regis', 'RegisterController@get_list_feature_regis')->name('get_list_feature_regis');
Route::get('admin/features', 'RegisterController@featuresView')->name('admin/features');
Route::post('sendfeature', 'RegisterController@sendfeature')->name('sendfeature');
Route::get('session_backfitur', 'RegisterController@session_backfitur')->name('session_backfitur');
// REGISTER ADMIN- DETAIL FITUR
Route::get('admin/features_detail', 'RegisterController@fiturdetailView')->name('admin/features_detail');
Route::get('admin/features_detail/{id_fitur}', 'RegisterController@detailFiturView')->name('features_detail');
// register - payment


Route::get('admin/paymentmethod', 'RegisterController@paymentMethodRegisView')->name('paymentmethod');
Route::post('get_payment_method_regis', 'RegisterController@get_payment_method_regis')->name('get_payment_method_regis');

Route::get('admin/payment', 'RegisterController@paymentView')->name('paymentView');
Route::get('isi_payment', 'RegisterController@isi_payment')->name('isi_payment');
Route::post('getDetailPay', 'RegisterController@getDetailPay')->name('getDetailPay');
Route::post('getpayment_method', 'RegisterController@getpayment_method')->name('getpayment_method');
Route::post('sendIdPayment', 'RegisterController@sendIdPayment')->name('sendIdPayment');
// register 6 - Final Regis Admin
Route::get('admin/review', 'RegisterController@ReviewRegisView')->name('admin/review');
Route::post('GetAllDataRegisAdmin', 'RegisterController@GetAllDataRegisAdmin')->name('GetAllDataRegisAdmin');


Route::get('admin/review', 'RegisterController@ReviewRegisView')->name('admin/review');
Route::post('ReviewFinal', 'RegisterController@ReviewFinal')->name('ReviewFinal');
Route::post('getSelectedFitur', 'RegisterController@getSelectedFitur')->name('getSelectedFitur');
Route::post('getSelectedPrice', 'RegisterController@getSelectedPrice')->name('getSelectedPrice');
Route::post('getSelectedPayment', 'RegisterController@getSelectedPayment')->name('getSelectedPayment');
// FINAL ADMIN REGISTRASION
Route::post('FinalAdminRegis', 'RegisterController@FinalAdminRegis')->name('FinalAdminRegis');

Route::post('cek_payment_free_or_not', 'RegisterController@cek_payment_free_or_not')->name('cek_payment_free_or_not');

// LOADING _ FINISH
Route::get('admin/loading', 'RegisterController@loadingcreatingView')->name('admin/loading');
Route::get('admin/finish', 'RegisterController@finishView')->name('finishView');
// confirm - payment
Route::get('admin/loading_payment', 'RegisterController@loadingpaymentView')->name('loadingpaymentView');
Route::get('admin/finish_payment', 'RegisterController@finishpaymentView')->name('finishpaymentView');
// CEK VALIDASI REGIS
Route::post('cek_valid_email_subs', 'RegisterController@cek_valid_email_subs')->name('cek_valid_email_subs');
Route::post('cek_valid_phone_subs', 'RegisterController@cek_valid_phone_subs')->name('cek_valid_phone_subs');
Route::post('cek_valid_username_subs', 'RegisterController@cek_valid_username_subs')->name('cek_valid_username_subs');




// SUBSCRIBER - ROUTE
Route::prefix('subscriber')->group(function () {
    Route::get('/', 'SubscriberController@loginView')->name('subscriber');
    Route::get('/url/{name_community}', 'SubscriberController@AuthSubscriber')->name('subscriber/url/{name_community}');
    Route::get('/dashboard', 'SubscriberController@DashboardSubsView')->name('/dashboard');
    Route::get('/membership', 'SubscriberController@MembershipSubsView')->name('/membership');
    Route::get('/inbox_management', 'SubscriberController@InboxManagementSubsView')->name('/inbox_management');
    Route::get('/transaction_management', 'SubscriberController@TransactionSubsView')->name('/transaction_management');
    Route::get('/notification_management', 'SubscriberController@NotificationManagementViewSubs')->name('/notification_management');
    Route::get('/dashboard_setting', 'SubscriberController@ModuleSettingSubsView')->name('/dashboard_setting');
    Route::get('logout_subs_href', 'SubscriberController@logout_subs_href')->name('logout_subs_href');

    Route::get('/tes_enkrip', 'SubscriberController@TesEnkripView')->name('/tes_enkrip');

    //EVENT _ TICKET
    Route::get('/buy_ticket', 'ModuleController@buyTicketEvent')->name('get.subs.buy-ticket');


    //FRIENDS
    Route::get('/friend_list', 'ModuleController@FriendList')->name('/friend_list');
    Route::get('/view_profile/{friend_id}', 'ModuleController@friendProfile')->name('/view_profile');

    //NEWS
    Route::get('/news_list', 'ModuleController@NewsList')->name('/news_list');
    Route::get('/detail_news/{id_news}', 'ModuleController@DetailNews')->name('/detail_news');
    Route::post('send_love_news_subs', 'ModuleController@send_love_news_subs')->name('send_love_news_subs');

    // FRIEND MODULE

    Route::post('get_top_friends', 'ModuleController@get_top_friends')->name('get_top_friends');

    Route::post('get_friend_profile', 'ModuleController@get_friend_profile')->name('get_friend_profile');

    Route::post('find_search_filter_friends', 'ModuleController@find_search_filter_friends')->name('find_search_filter_friends');

    Route::post('get_list_setting_module_friends', 'ModuleController@get_list_setting_module_friends')->name('get_list_setting_module_friends');

    Route::post('setting_module_friend', 'ModuleController@setting_module_friend')->name('setting_module_friend');

    Route::post('confirm_new_friend', 'ModuleController@confirm_new_friend')->name('confirm_new_friend');

    Route::post('/tabel_friend_pending_list', 'ModuleController@tabel_friend_pending_list')->name('tabel_friend_pending_list');

    Route::post('/tabel_friend_management', 'ModuleController@tabel_friend_management')->name('/tabel_friend_management');
    Route::post('/view_profile/{id_subs}', 'ModuleController@friendProfile')->name('/view_profile');
    Route::post('/friend_send_message', 'ModuleController@SendMessage')->name('friend_send_message');

    // NEWS MODULE

    Route::post('/table_news_list', 'ModuleController@table_news_list')->name('/table_news_list');



    //POST

    Route::post('tes_enkrip', 'SubscriberController@tes_enkrip')->name('tes_enkrip');
    Route::post('get_inbox_navbar_subs', 'SubscriberController@get_inbox_navbar_subs')->name('get_inbox_navbar_subs');

    Route::post('edit_profile_custom_regis', 'SubscriberController@edit_profile_custom_regis')->name('edit_profile_custom_regis');
    Route::post('add_friend_suggest_subs', 'SubscriberController@add_friend_suggest_subs')->name('add_friend_suggest_subs');
    Route::post('get_top_visit_club', 'SubscriberController@get_top_visit_club')->name('get_top_visit_club');
    Route::post('get_top_player', 'SubscriberController@get_top_player')->name('get_top_player');
    Route::post('get_topvisit_news', 'SubscriberController@get_topvisit_news')->name('get_topvisit_news');
    Route::post('get_love_news', 'SubscriberController@get_love_news')->name('get_love_news');
    Route::post('get_last_news', 'SubscriberController@get_last_news')->name('get_last_news');
    Route::post('get_friends_sugestion', 'SubscriberController@get_friends_sugestion')->name('get_friends_sugestion');
    Route::post('get_friends_total', 'SubscriberController@get_friends_total')->name('get_friends_total');
    Route::post('get_list_setting_module_subs', 'SubscriberController@get_list_setting_module_subs')->name('get_list_setting_module_subs');
    Route::post('detail_notif_subs', 'SubscriberController@detail_notif_subs')->name('detail_notif_subs');
    Route::post('setting_notification_subs', 'SubscriberController@setting_notification_subs')->name('setting_notification_subs');
    Route::post('tabel_generate_notification_subs', 'SubscriberController@tabel_generate_notification_subs')->name('tabel_generate_notification_subs');
    Route::post('get_list_setting_notif_subs', 'SubscriberController@get_list_setting_notif_subs')->name('get_list_setting_notif_subs');
    Route::post('get_invoice_num_membership', 'SubscriberController@get_invoice_num_membership')->name('get_invoice_num_membership');
    Route::post('LogoutSubscriber', 'SubscriberController@LogoutSubscriber')->name('LogoutSubscriber');
    Route::post('confirm_pay_membership_subs', 'SubscriberController@confirm_pay_membership_subs')->name('confirm_pay_membership_subs');
    Route::post('get_list_notif_navbar', 'SubscriberController@get_list_notif_navbar')->name('get_list_notif_navbar');
    Route::post('get_list_notif_management', 'SubscriberController@get_list_notif_management')->name('get_list_notif_management');
    Route::post('set_initial_membership_pay', 'SubscriberController@set_initial_membership_pay')->name('set_initial_membership_pay');
    Route::post('get_payment_initial', 'SubscriberController@get_payment_initial')->name('get_payment_initial');
    Route::post('get_pricing_membership', 'SubscriberController@get_pricing_membership')->name('get_pricing_membership');
    Route::post('show_my_membership', 'SubscriberController@show_my_membership')->name('show_my_membership');
    Route::post('change_status_inbox_message_subs', 'SubscriberController@change_status_inbox_message_subs')->name('change_status_inbox_message_subs');
    Route::post('detail_inbox_subscriber', 'SubscriberController@detail_inbox_subscriber')->name('detail_inbox_subscriber');
    Route::post('get_list_subscriber_inbox', 'SubscriberController@get_list_subscriber_inbox')->name('get_list_subscriber_inbox');
    Route::post('tabel_generate_inbox_subs', 'SubscriberController@tabel_generate_inbox_subs')->name('tabel_generate_inbox_subs');
    Route::post('detail_transaksi_subs', 'SubscriberController@detail_transaksi_subs')->name('detail_transaksi_subs');
    Route::post('tabel_transaksi_show', 'SubscriberController@tabel_transaksi_show')->name('tabel_transaksi_show');
    Route::post('get_list_transaction_tipe', 'SubscriberController@get_list_transaction_tipe')->name('get_list_transaction_tipe');
    Route::post('get_list_subcriber_name', 'SubscriberController@get_list_subcriber_name')->name('get_list_subcriber_name');
    Route::post('get_dashboard_news', 'SubscriberController@get_dashboard_news')->name('get_dashboard_news');
    Route::post('change_password_subs', 'SubscriberController@change_password_subs')->name('change_password_subs');
    Route::post('edit_profile_subs', 'SubscriberController@edit_profile_subs')->name('edit_profile_subs');
    Route::post('ses_auth_subs', 'SubscriberController@ses_auth_subs')->name('ses_auth_subs');
    Route::post('LoginSubscriber', 'SubscriberController@LoginSubscriber')->name('LoginSubscriber');
    Route::post('session_subscriber_logged', 'SubscriberController@session_subscriber_logged')->name('session_subscriber_logged');


//=========================== SUPPORTPAL ==============================//
Route::prefix('supportpal')->group(function () {
    Route::get('/', function () {
    if (session()->has('session_subscriber_logged')) {
           return view('subscriber.supportpal.awal');
    }else{
        if (session()->has('auth_subs')) {
           $auth_subs = session()->get('auth_subs');
            $url_loginsubs = '/subscriber/url/' . $auth_subs[0]['name'];
            return redirect($url_loginsubs);
        }else{
            return redirect('/');
        }
    }
    });

    Route::prefix('article')->group(function () {
    Route::get('/', function () {
        return view('subscriber.supportpal.article_view');
    });
    Route::get('article-list', 'SupPalSubsController@listArticle')->name('get.user.list');
    Route::post('article-detail', 'SupPalSubsController@detailArticle')->name('get.user.detail');
    Route::post('article-search', 'SupPalSubsController@searchArticle')->name('get.user.search');
    Route::post('set-rating', 'SupPalSubsController@setRating')->name('post.user.rating');
    });

    Route::prefix('ticket')->group(function () {
    Route::get('/', function () {
        return view('subscriber.supportpal.ticket_view');
    });
    Route::get('ticket-list', 'SupPalSubsController@listTicket')->name('get.ticket.list');
    Route::get('ticket-detail/{id}', 'SupPalSubsController@detailTicket')->name('get.ticket.detail');
    Route::get('ticket-create', 'SupPalSubsController@createTicketView')->name('get.ticket.create');
    Route::post('ticket-createreq', 'SupPalSubsController@createTicketReq')->name('post.ticket.createreq');
    Route::get('ticket-update/{id}/{value}', 'SupPalSubsController@updateTicket')->name('get.ticket.update');
    });

    Route::prefix('message')->group(function () {
    Route::get('{id}', 'SupPalSubsController@listMessage')->name('get.message.list');
    Route::post('create', 'SupPalSubsController@createMessage')->name('post.message.create');
    });

}); //end-supportpal

});
//GET
Route::get('subscriber/register', 'SubscriberController@registerSubsView')->name('subscriber/register');
Route::get('subscriber/subs_community', 'SubscriberController@registerCommView')->name('subscriber/subs_community');
Route::get('subscriber/subs_payment', 'SubscriberController@registerPaymentView')->name('subscriber/subs_payment');
//POST
Route::post('registerSubscriber', 'SubscriberController@registerSubscriber')->name('registerSubscriber');














//SUPERADMIN
Route::prefix('superadmin')->group(function () {
    Route::get('/', 'SuperadminController@loginSuperadminView')->name('superadmin');
    Route::get('/dashboard', 'SuperadminController@dashboarSuperView')->name('/dashboard');
    Route::get('/add_user', 'SuperadminController@UserSuperView')->name('/add_user');
    Route::get('/verify', 'SuperadminController@paymentSuperView')->name('/verify');
    Route::get('/module', 'SuperadminController@ModuleManagementView')->name('/module');
    // Route::get('/logout', 'SuperadminController@LogoutSuperadmin')->name('/logout');
    Route::get('/usertype', 'SuperadminController@UserTypeView')->name('/usertype');
    Route::get('/subscriber', 'SuperadminController@SubscriberManagementSuperView')->name('/subscriber');
    Route::get('/user_manage', 'SuperadminController@UserManagementSuperView')->name('/user_manage');
    Route::get('/log_management', 'SuperadminController@LogManagementSuperView')->name('/log_management');
    Route::get('/module_report', 'SuperadminController@ModuleReportSuperView')->name('/module_report');
    Route::get('/pricing_management', 'SuperadminController@PricingManageSuperView')->name('/pricing_management');
    Route::get('/report_management', 'SuperadminController@reportManagementSuperadmin')->name('/report_management');
    Route::get('/payment_management', 'SuperadminController@paymentManagementSuperadmin')->name('/payment_management');
    Route::get('/notification_management', 'SuperadminController@NotificationManagementSuperadmin')->name('/notification_management');
    Route::get('/inbox_management', 'SuperadminController@InboxManagementSuperadmin')->name('/inbox_management');
    Route::get('/transaction', 'SuperadminController@TransactionManagementView')->name('/transaction');


    //-------POST------
    Route::post('LogoutSuperadmin', 'SuperadminController@LogoutSuperadmin')->name('LogoutSuperadmin');
    Route::post('get_dashboard_superadmin', 'SuperadminController@get_dashboard_superadmin');
    Route::post('get_all_module_list_superadmin', 'SuperadminController@get_all_module_list_superadmin');
    Route::post('detail_module_all_super', 'SuperadminController@detail_module_all_super');
    Route::post('add_create_new_module', 'SuperadminController@add_create_new_module')->name('add_create_new_module');
    Route::post('tabel_usertype_superadmin', 'SuperadminController@tabel_usertype_superadmin')->name('tabel_usertype_superadmin');
    Route::post('get_listfitur_usertype_ceklist', 'SuperadminController@get_listfitur_usertype_ceklist')->name('get_listfitur_usertype_ceklist');
    Route::post('add_new_usertype_management', 'SuperadminController@add_new_usertype_management')->name('add_new_usertype_management');
    Route::post('edit_usertype_management', 'SuperadminController@edit_usertype_management')->name('edit_usertype_management');
    Route::post('add_endpoint_module', 'SuperadminController@add_endpoint_module')->name('add_endpoint_module');
    Route::post('get_list_komunitas', 'SuperadminController@get_list_komunitas')->name('get_list_komunitas');
    Route::post('get_list_transaction_tipe', 'SuperadminController@get_list_transaction_tipe')->name('get_list_transaction_tipe');
    Route::post('get_list_subcriber_name', 'SuperadminController@get_list_subcriber_name')->name('get_list_subcriber_name');
    Route::post('tabel_transaksi_show', 'SuperadminController@tabel_transaksi_show')->name('tabel_transaksi_show');
    Route::post('detail_transaksi_superadmin', 'SuperadminController@detail_transaksi_superadmin')->name('detail_transaksi_superadmin');
    Route::post('tabel_subs_komunitas_super', 'SuperadminController@tabel_subs_komunitas_super')->name('tabel_subs_komunitas_super');
    Route::post('tabel_subscriber_comm_super', 'SuperadminController@tabel_subscriber_comm_super')->name('tabel_subscriber_comm_super');
    Route::post('tabel_subs_pending_super', 'SuperadminController@tabel_subs_pending_super')->name('tabel_subs_pending_super');
    Route::post('tabel_user_management_super', 'SuperadminController@tabel_user_management_super')->name('tabel_user_management_super');
    Route::post('detail_user_management_super', 'SuperadminController@detail_user_management_super')->name('detail_user_management_super');
    Route::post('tabel_log_management_super', 'SuperadminController@tabel_log_management_super')->name('tabel_log_management_super');
    Route::post('get_list_komunitas_log_manage', 'SuperadminController@get_list_komunitas_log_manage')->name('get_list_komunitas_log_manage');
    Route::post('get_list_community_modulereport', 'SuperadminController@get_list_community_modulereport')->name('get_list_community_modulereport');
    Route::post('get_list_fitur_modulereport', 'SuperadminController@get_list_fitur_modulereport')->name('get_list_fitur_modulereport');
    Route::post('get_subfitur_modulereport', 'SuperadminController@get_subfitur_modulereport')->name('get_subfitur_modulereport');
    Route::post('tabel_module_report_superadmin', 'SuperadminController@tabel_module_report_superadmin')->name('tabel_module_report_superadmin');
    Route::post('tabel_pricing_management_superadmin', 'SuperadminController@tabel_pricing_management_superadmin')->name('tabel_pricing_management_superadmin');
    Route::post('detail_pricing_super', 'SuperadminController@detail_pricing_super')->name('detail_pricing_super');
    Route::post('add_pricing_super', 'SuperadminController@add_pricing_super')->name('add_pricing_super');
    Route::post('get_list_fitur_pricing', 'SuperadminController@get_list_fitur_pricing')->name('get_list_fitur_pricing');
    Route::post('edit_pricing_super', 'SuperadminController@edit_pricing_super')->name('edit_pricing_super');
    Route::post('get_list_transaction_type_super', 'SuperadminController@get_list_transaction_type_super')->name('get_list_transaction_type_super');
    Route::post('tabel_report_transaksi_super', 'SuperadminController@tabel_report_transaksi_super')->name('tabel_report_transaksi_super');
    Route::post('tabel_concile_report_super', 'SuperadminController@tabel_concile_report_super')->name('tabel_concile_report_super');
    Route::post('tabel_payment_all_super', 'SuperadminController@tabel_payment_all_super')->name('tabel_payment_all_super');
    Route::post('tabel_payment_active_super', 'SuperadminController@tabel_payment_active_super')->name('tabel_payment_active_super');
    Route::post('add_payment_management_super', 'SuperadminController@add_payment_management_super')->name('add_payment_management_super');
    Route::post('detail_payment_all_super', 'SuperadminController@detail_payment_all_super')->name('detail_payment_all_super');
    Route::post('get_setting_subpayment_super', 'SuperadminController@get_setting_subpayment_super')->name('get_setting_subpayment_super');
    Route::post('get_list_bank_name_subpay', 'SuperadminController@get_list_bank_name_subpay')->name('get_list_bank_name_subpay');
    Route::post('add_subpayment_super', 'SuperadminController@add_subpayment_super')->name('add_subpayment_super');
    Route::post('edit_payment_management_super', 'SuperadminController@edit_payment_management_super')->name('edit_payment_management_super');
    Route::post('edit_subpayment_super', 'SuperadminController@edit_subpayment_super')->name('edit_subpayment_super');
    Route::post('tabel_generate_notification_super', 'SuperadminController@tabel_generate_notification_super')->name('tabel_generate_notification_super');
    Route::post('get_list_user_notif_super', 'SuperadminController@get_list_user_notif_super')->name('get_list_user_notif_super');
    Route::post('send_notification_super', 'SuperadminController@send_notification_super')->name('send_notification_super');
    Route::post('detail_generate_notif_super', 'SuperadminController@detail_generate_notif_super')->name('detail_generate_notif_super');
    Route::post('add_setting_sub_payment', 'SuperadminController@add_setting_sub_payment')->name('add_setting_sub_payment');
    Route::post('tabel_generate_inbox_super', 'SuperadminController@tabel_generate_inbox_super')->name('tabel_generate_inbox_super');
    Route::post('send_inbox_message_super', 'SuperadminController@send_inbox_message_super')->name('send_inbox_message_super');
    Route::post('get_list_user_inbox_super', 'SuperadminController@get_list_user_inbox_super')->name('get_list_user_inbox_super');
    Route::post('detail_generate_message_inbox_super', 'SuperadminController@detail_generate_message_inbox_super')->name('detail_generate_message_inbox_super');
    Route::post('delete_message_inbox_super', 'SuperadminController@delete_message_inbox_super')->name('delete_message_inbox_super');
    Route::post('tabel_komunitas_report_super', 'SuperadminController@tabel_komunitas_report_super')->name('tabel_komunitas_report_super');
    Route::post('get_list_fitur_super', 'SuperadminController@get_list_fitur_super')->name('get_list_fitur_super');
    Route::post('tabel_module_report_super', 'SuperadminController@tabel_module_report_super')->name('tabel_module_report_super');
    Route::post('change_status_inbox_message_super', 'SuperadminController@change_status_inbox_message_super')->name('change_status_inbox_message_super');
    Route::post('edit_profile_superadmin', 'SuperadminController@edit_profile_superadmin')->name('edit_profile_superadmin');
    Route::post('get_user_tipe_manage', 'SuperadminController@get_user_tipe_manage')->name('get_user_tipe_manage');
    Route::post('change_password_superadmin', 'SuperadminController@change_password_superadmin')->name('change_password_superadmin');
    Route::post('add_user_management_super', 'SuperadminController@add_user_management_super')->name('add_user_management_super');
    Route::post('edit_user_management_super', 'SuperadminController@edit_user_management_super')->name('edit_user_management_super');
    Route::post('get_session_logged_superadmin', 'SuperadminController@get_session_logged_superadmin')->name('get_session_logged_superadmin');

});
// ---- post : superadmin-----
Route::post('InputloginSuperadmin', 'SuperadminController@InputloginSuperadmin')->name('InputloginSuperadmin');
Route::post('loginSuperadmin', 'SuperadminController@loginSuperadmin')->name('loginSuperadmin');
Route::post('postAddUser', 'SuperadminController@postAddUser')->name('postAddUser');
Route::post('session_logged_superadmin', 'SuperadminController@session_logged_superadmin')->name('session_logged_superadmin');
Route::post('get_priviledge', 'SuperadminController@get_priviledge')->name('get_priviledge');
Route::post('list_req_admincomm', 'SuperadminController@list_req_admincomm_func')->name('list_req_admincomm');
Route::post('verify_admincom', 'SuperadminController@verify_admincom')->name('verify_admincom');


//SUPERADMIN
Route::prefix('support')->group(function () {
    Route::get('/', 'SupportCommjunction@OpeningSupportView')->name('support');
    Route::get('/inquiry_specific', 'SupportCommjunction@InquirySpecificView')->name('/inquiry_specific');
    Route::get('/inquiry_log', 'SupportCommjunction@InquiryLogActivityView')->name('/inquiry_log');
    Route::get('/reactivate_deactivate', 'SupportCommjunction@ReactivateDeactivateView')->name('/reactivate_deactivate');
    Route::get('/knowledge', 'SupportCommjunction@knowledgeSupportView')->name('/knowledge');
    Route::get('/subdomain', 'SupportCommjunction@SubdomainSupportView')->name('/subdomain');
    Route::get('/reset_pass', 'SupportCommjunction@ResetPassSupportView')->name('/reset_pass');
    Route::get('/reset_attempt', 'SupportCommjunction@ResetFailedAttemptSupportView')->name('/reset_attempt');
    Route::get('/resend_mail', 'SupportCommjunction@ResendMailSupportView')->name('/resend_mail');



    //POST

    Route::post('get_list_komunitas_support', 'SupportCommjunction@get_list_komunitas_support')->name('get_list_komunitas_support');
    Route::post('get_list_feature_support', 'SupportCommjunction@get_list_feature_support')->name('get_list_feature_support');
    Route::post('get_list_subfeature_support', 'SupportCommjunction@get_list_subfeature_support')->name('get_list_subfeature_support');
    Route::post('get_list_endpoint_support', 'SupportCommjunction@get_list_endpoint_support')->name('get_list_endpoint_support');
    Route::post('get_list_subscriber_support', 'SupportCommjunction@get_list_subscriber_support')->name('get_list_subscriber_support');
    Route::post('tabel_inquiry_log_activity', 'SupportCommjunction@tabel_inquiry_log_activity')->name('tabel_inquiry_log_activity');
    Route::post('tabel_inquiry_spesific_com', 'SupportCommjunction@tabel_inquiry_spesific_com')->name('tabel_inquiry_spesific_com');
    Route::post('change_status_reactive', 'SupportCommjunction@change_status_reactive')->name('change_status_reactive');
    Route::post('change_reactive_subscriber', 'SupportCommjunction@change_reactive_subscriber')->name('change_reactive_subscriber');
    Route::post('tabel_knowledge_support', 'SupportCommjunction@tabel_knowledge_support')->name('tabel_knowledge_support');
    Route::post('add_knowledge_support', 'SupportCommjunction@add_knowledge_support')->name('add_knowledge_support');
    Route::post('edit_knowledge_support', 'SupportCommjunction@edit_knowledge_support')->name('edit_knowledge_support');
    Route::post('delete_knowledge_support', 'SupportCommjunction@delete_knowledge_support')->name('delete_knowledge_support');
    Route::post('change_status_subdomain', 'SupportCommjunction@change_status_subdomain')->name('change_status_subdomain');
    Route::post('get_list_admin_support', 'SupportCommjunction@get_list_admin_support')->name('get_list_admin_support');
    Route::post('reset_pass_share_otp', 'SupportCommjunction@reset_pass_share_otp')->name('reset_pass_share_otp');
    Route::post('reset_pass_share_otp', 'SupportCommjunction@reset_pass_share_otp')->name('reset_pass_share_otp');
    Route::post('get_random_otp', 'SupportCommjunction@get_random_otp')->name('get_random_otp');
    Route::post('reset_attempt_otp', 'SupportCommjunction@reset_attempt_otp')->name('reset_attempt_otp');
    Route::post('reset_attempt_login', 'SupportCommjunction@reset_attempt_login')->name('reset_attempt_login');
    Route::post('resend_mail_otp_admin', 'SupportCommjunction@resend_mail_otp_admin')->name('resend_mail_otp_admin');
    Route::post('resend_invoice_payment_admin', 'SupportCommjunction@resend_invoice_payment_admin')->name('resend_invoice_payment_admin');
    Route::post('resend_invoice_regis_community', 'SupportCommjunction@resend_invoice_regis_community')->name('resend_invoice_regis_community');
    Route::post('resend_invoice_module_admin', 'SupportCommjunction@resend_invoice_module_admin')->name('resend_invoice_module_admin');
    Route::post('resend_invoice_membership_subs', 'SupportCommjunction@resend_invoice_membership_subs')->name('resend_invoice_membership_subs');
    Route::post('resend_membership_approv_subs', 'SupportCommjunction@resend_membership_approv_subs')->name('resend_membership_approv_subs');
    Route::post('resend_mail_subs_approv', 'SupportCommjunction@resend_mail_subs_approv')->name('resend_mail_subs_approv');
    Route::post('resend_mail_subs_nonaktif', 'SupportCommjunction@resend_mail_subs_nonaktif')->name('resend_mail_subs_nonaktif');
});
