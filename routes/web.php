<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//
Auth::routes();
//---------------------------------------------------------
Route::post('/admin_panel/forgetPass/resetpass', [
        'uses' => 'adminLoginController@resetPass',
        'as' => '/admin_panel/forgetPass/resetpass',
    ]
);
Route::post('/admin_panel/logout/action', [
        'uses' => 'adminLoginController@logout_action',
        'as' => '/admin_panel/logout/action',
    ]
);
Route::post('/admin_panel/forgetPass/verify', [
        'uses' => 'adminLoginController@forgetPassVerify',
        'as' => '/admin_panel/forgetPass/verify',
    ]
);
Route::post('/admin_panel/action/forgetPass', [
        'uses' => 'adminLoginController@forgetPassAction',
        'as' => '/admin_panel/action/forgetPass',
    ]
);
Route::post('/admin_panel/login/action', [
        'uses' => 'adminLoginController@loginAction',
        'as' => '/admin_panel/login/action',
    ]
);
Route::get('/admin_panel/login', [
        'uses' => 'adminLoginController@loginPage',
        'as' => '/admin_panel/login',
    ]
);
Route::get('/admin_panel/login/forget_pass', [
        'uses' => 'adminLoginController@forgetPassPage',
        'as' => '/admin_panel/login/forget_pass',
    ]
);
Route::group(['middleware' => 'adminAuth'],function(){

    Route::get('admin_panel/view/{action}/{member_id}', [
            'uses' => 'documentController@adminView',
            'as' => 'admin_panel/view/',
        ]
    );
    Route::get('admin_panel/download/{action}/{member_id}', [
            'uses' => 'documentController@adminDownload',
            'as' => 'admin_panel/download/',
        ]
    );
    Route::get('/admin_panel', [
            'uses' => 'adminDashboardController@index',
            'as' => '/admin_panel',
        ]
    );
    Route::get('/admin_panel/add/admin', [
            'uses' => 'adminDashboardController@addAdmin',
            'as' => '/admin_panel/add/admin',
        ]
    );
    Route::get('/admin_panel/members', [
            'uses' => 'adminDashboardController@members',
            'as' => '/admin_panel/members',
        ]
    );
    Route::get('/admin_panel/members/details/{user_id}', [
            'uses' => 'adminDashboardController@membersDetails',
            'as' => '/admin_panel/members/details/',
        ]
    );
    Route::get('/admin_panel/payments', [
            'uses' => 'adminDashboardController@payments',
            'as' => '/admin_panel/payments',
        ]
    );
    Route::get('/admin_panel/sms', [
            'uses' => 'smsController@smsView',
            'as' => '/admin_panel/sms',
        ]
    );
    Route::post('admin_panel/sms/send/action', [
            'uses' => 'smsController@smsSendFunc',
            'as' => 'admin_panel/sms/send/action',
        ]
    );
    Route::get('/admin_panel/balance/update/sms', [
            'uses' => 'smsController@smsBalanceUpdate',
            'as' => '/admin_panel/balance/update/sms',
        ]
    );
    Route::get('/admin_panel/admins', [
            'uses' => 'adminDashboardController@admins',
            'as' => '/admin_panel/admins',
        ]
    );

    Route::get('/admin_panel/add/unite', [
            'uses' => 'adminDashboardController@addUnite',
            'as' => '/admin_panel/add/unite',
        ]
    );
    Route::get('/admin_panel/add/members_type', [
            'uses' => 'adminDashboardController@addmemberstype',
            'as' => '/admin_panel/add/members_type',
        ]
    );
    Route::post('admin_panel/add/unite/action', [
            'uses' => 'adminManageController@addUnite',
            'as' => 'admin_panel/add/unite/action',
        ]
    );
    Route::post('admin_panel/add/member_type/action', [
            'uses' => 'adminManageController@addMembertype',
            'as' => 'admin_panel/add/member_type/action',
        ]
    );
    Route::get('admin_panel/edit/member_type/{target}', [
            'uses' => 'adminDashboardController@updatememberstype',
            'as' => 'admin_panel/edit/member_type',
        ]
    );
    Route::get('admin_panel/edit_light/member_type/{target}/{action}', [
            'uses' => 'adminManageController@updateLightmemberstype',
            'as' => 'admin_panel/edit_light/member_type',
        ]
    );
    Route::post('admin_panel/edit/action/member_type', [
            'uses' => 'adminManageController@updateMembertype',
            'as' => 'admin_panel/edit/action/member_type',
        ]
    );

    Route::get('admin_panel/edit/unite/{target}', [
            'uses' => 'adminDashboardController@updateUnite',
            'as' => 'admin_panel/edit/unite',
        ]
    );
    Route::get('admin_panel/edit_light/unite/{target}/{action}', [
            'uses' => 'adminManageController@updateLightunite',
            'as' => 'admin_panel/edit_light/unite',
        ]
    );
    Route::post('admin_panel/edit/action/unite', [
            'uses' => 'adminManageController@updateUnite',
            'as' => 'admin_panel/edit/action/unite',
        ]
    );

    Route::get('admin_panel/update/account', [
            'uses' => 'adminManageController@accountUpdate',
            'as' => 'admin_panel/update/account',
        ]
    );

    Route::post('admin_panel/update/account/action', [
            'uses' => 'adminManageController@accountUpdateAction',
            'as' => 'admin_panel/update/account/action',
        ]
    );

    Route::post('admin_panel/add/admin/action', [
            'uses' => 'adminManageController@addAdmin',
            'as' => 'admin_panel/add/admin/action',
        ]
    );
    Route::post('admin_panel/update/admin/action/', [
            'uses' => 'adminManageController@updateAdmin',
            'as' => 'admin_panel/update/admin/action',
        ]
    );
    Route::get('/admin_panel/update/admin/{admin_id}', [
            'uses' => 'adminDashboardController@updateAdmin',
            'as' => '/admin_panel/update/admin',
        ]
    );
    Route::get('/admin_panel/admins/active/{admin_id}', [
            'uses' => 'adminManageController@adminActive',
            'as' => '/admin_panel/admins/active',
        ]
    );
    Route::get('/admin_panel/admins/trash/{admin_id}', [
            'uses' => 'adminManageController@admintrash',
            'as' => '/admin_panel/admins/trash',
        ]
    );

    Route::get('/admin_panel/admins/mute/{admin_id}', [
            'uses' => 'adminManageController@adminMute',
            'as' => '/admin_panel/admins/mute',
        ]
    );
    Route::get('/admin_panel/coupons/{action}', [
            'uses' => 'couponController@couponPage',
            'as' => '/admin_panel/coupons',
        ]
    );
    Route::get('/admin_panel/newCreate/coupons', [
            'uses' => 'couponController@couponNewCreate',
            'as' => '/admin_panel/newCreate/coupons',
        ]
    );
    Route::get('/admin_panel/delete/coupons/{id}', [
            'uses' => 'couponController@couponDelete',
            'as' => '/admin_panel/delete/coupons',
        ]
    );
    Route::post('/admin_panel/newCreate/coupons/action', [
            'uses' => 'couponController@couponNewCreateAction',
            'as' => '/admin_panel/newCreate/coupons/action',
        ]
    );
    Route::get('/admin_panel/custom_page/{action}', [
            'uses' => 'customPageContent@pageContent',
            'as' => '/admin_panel/custom_page',
        ]
    );
    Route::post('/admin_panel/action/custom_page', [
            'uses' => 'customPageContent@pageContentAction',
            'as' => '/admin_panel/action/custom_page',
        ]
    );
    Route::post('admin_panel/add/withdraw/action', [
            'uses' => 'adminManageController@withdrawAddd',
            'as' => 'admin_panel/add/withdraw/action',
        ]
    );
    Route::get('admin_panel/delete/withdraw/action/{target}', [
            'uses' => 'adminManageController@withdrawDelete',
            'as' => 'admin_panel/delete/withdraw/action',
        ]
    );
    Route::get('admin_panel/pdf/show/action/{members_id}', [
            'uses' => 'pdfController@printPDFbyAdmin',
            'as' => 'customer.printpdf.admin',
        ]
    );


});

//guest member--------------------------------------------------
Route::get('/', [
        'uses' => 'membersViewController@index',
        'as' => '/',
    ]
);
Route::get('/searchmembers', [
        'uses' => 'membersViewController@searchMembers',
        'as' => '/searchmembers',
    ]
);
Route::post('/search_members/result', [
        'uses' => 'membersViewController@searchResult',
        'as' => '/search_members/result',
    ]
);
Route::get('/login', [
        'uses' => 'membersViewController@member_login',
        'as' => '/login',
    ]
);
Route::get('/about_membership', [
        'uses' => 'membersViewController@membershipView',
        'as' => '/about_membership',
    ]
);
Route::get('/contact', [
        'uses' => 'membersViewController@contactView',
        'as' => '/contact',
    ]
);
Route::get('/donation', [
        'uses' => 'membersViewController@donationView',
        'as' => '/donation',
    ]
);
Route::get('/registration', [
        'uses' => 'membersViewController@member_registration',
        'as' => '/registration',
    ]
);
//----------forget password--------------
Route::post('/forget_password/phone_verify', [
        'uses' => 'membersAuthAction@resetPassPhoneVerify',
        'as' => '/forget_password/phone_verify',
    ]
);
Route::post('/reset_password', [
        'uses' => 'membersAuthAction@resetPassView',
        'as' => '/reset_password',
    ]
);
Route::post('/reset_password/action', [
        'uses' => 'membersAuthAction@resetPassAction',
        'as' => '/reset_password/action',
    ]
);
Route::get('/forget_password', [
        'uses' => 'membersViewController@forgetPassword',
        'as' => '/forget_password',
    ]
);
//login / registration action---------------------------

Route::post('/registration/action', [
        'uses' => 'membersAuthAction@registration_action',
        'as' => '/registration/action',
    ]
);
Route::post('/registration/phoneVerify/action', [
        'uses' => 'membersAuthAction@phone_verify_action',
        'as' => '/registration/phoneVerify/action',
    ]
);
Route::get('/user_panel/members/phone-verify/{name}/{phone}/{otp}/{password}/{current_unite}', [
        'uses' => 'membersAuthAction@phone_verify',
        'as' => '/user_panel/members/phone-verify/',
    ]
);

Route::post('/login/action', [
        'uses' => 'membersAuthAction@login_action',
        'as' => '/login/action',
    ]
);
Route::post('/logout/action', [
        'uses' => 'membersAuthAction@logout_action',
        'as' => '/logout/action',
    ]
);
Route::get('/new_login', [
        'uses' => 'membersAuthAction@new_login',
        'as' => '/new_login',
    ]
);
Route::get('/payment', [
        'uses' => 'membersAuthAction@payment',
        'as' => '/payment',
    ]
);
Route::get('/Verification_doc', [
        'uses' => 'membersAuthAction@verification_doc',
        'as' => '/Verification_doc',
    ]
);

//user-panel----------------------------------------------------
Route::group(['middleware' => 'membersLogin'],function(){
    Route::get('user_panel/view/{action}', [
            'uses' => 'documentController@userView',
            'as' => 'user_panel/view/',
        ]
    );
    Route::get('user_panel/download/{action}', [
            'uses' => 'documentController@userDownload',
            'as' => 'user_panel/download/',
        ]
    );


    Route::get('/user_panel/user_details', [
            'uses' => 'userPanelController@user_details_show',
            'as' => '/user_panel/user_details',
        ]
    );
    Route::get('/user_panel/contact_info', [
            'uses' => 'userPanelController@contact_info_show',
            'as' => '/user_panel/contact_info',
        ]
    );
    Route::get('/user_panel/payment_details', [
            'uses' => 'userPanelController@payment_details_show',
            'as' => '/user_panel/payment_details',
        ]
    );
    Route::get('/user_panel/account_settings', [
            'uses' => 'userPanelController@account_settings_show',
            'as' => '/user_panel/account_settings',
        ]
    );
    Route::get('/user_panel/verification_doc', [
            'uses' => 'userPanelController@verification_doc_show',
            'as' => '/user_panel/verification_doc',
        ]
    );
    Route::get('/user_panel/help', [
            'uses' => 'userPanelController@help_show',
            'as' => '/user_panel/help',
        ]
    );
//    --------user edit data------------

    Route::get('/user_panel/user_details/personal_info/edit', [
            'uses' => 'userEditShowByUser@editPersonalInfo',
            'as' => '/user_panel/user_details/personal_info/edit',
        ]
    );
    Route::get('/user_panel/user_details/cadet_details/edit', [
            'uses' => 'userEditShowByUser@editCadetDetails',
            'as' => '/user_panel/user_details/cadet_details/edit',
        ]
    );Route::get('/user_panel/user_details/contact_details/edit', [
            'uses' => 'userEditShowByUser@editContactDetails',
            'as' => '/user_panel/user_details/contact_details/edit',
        ]
    );
    Route::get('/user_panel/user_details/edu_pro_details/edit', [
            'uses' => 'userEditShowByUser@editEduPro',
            'as' => '/user_panel/user_details/edu_pro_details/edit',
        ]
    );
    Route::get('/user_panel/user_details/document_details/edit', [
            'uses' => 'userEditShowByUser@editDoc',
            'as' => '/user_panel/user_details/document_details/edit',
        ]
    );
    Route::get('/user_panel/user_details/address_details/edit', [
            'uses' => 'userEditShowByUser@editAddressDetails',
            'as' => '/user_panel/user_details/address_details/edit',
        ]
    );
//    user update data save----------------
    Route::post('/user_panel/account_settings/updatePhone', [
            'uses' => 'userEditByUser@changePhone',
            'as' => '/user_panel/account_settings/updatePhone',
        ]
    );
    Route::post('/user_panel/account_settings/updatePhone/confirm', [
            'uses' => 'userEditByUser@changePhoneVerify',
            'as' => '/user_panel/account_settings/updatePhone/confirm',
        ]
    );
    Route::post('/user_panel/account_settings/updatePassword', [
            'uses' => 'userEditByUser@changePass',
            'as' => '/user_panel/account_settings/updatePassword',
        ]
    );
    Route::post('/user_panel/account_settings/updateImage', [
            'uses' => 'userEditByUser@changeImage',
            'as' => '/user_panel/account_settings/updateImage',
        ]
    );
//    ------------------------------------------
    Route::post('/user_panel/user_details/personal_info/edit/action', [
            'uses' => 'userEditByUser@editPersonalInfo',
            'as' => '/user_panel/user_details/personal_info/edit/action',
        ]
    );
    Route::post('/user_panel/user_details/cadet_details/edit/action', [
            'uses' => 'userEditByUser@editCadetDetails',
            'as' => '/user_panel/user_details/cadet_details/edit/action',
        ]
    );
    Route::post('/user_panel/user_details/contact_details/edit/action', [
            'uses' => 'userEditByUser@editContactDetails',
            'as' => '/user_panel/user_details/contact_details/edit/action',
        ]
    );
    Route::post('/user_panel/user_details/edu_pro_details/edit/action', [
            'uses' => 'userEditByUser@editEduPro',
            'as' => '/user_panel/user_details/edu_pro_details/edit/action',
        ]
    );
    Route::post('/user_panel/user_details/document_details/edit/action', [
            'uses' => 'userEditByUser@editDoc',
            'as' => '/user_panel/user_details/document_details/edit/action',
        ]
    );
    Route::post('/user_panel/user_details/address_details/edit/action', [
            'uses' => 'userEditByUser@editAddressDetails',
            'as' => '/user_panel/user_details/address_details/edit/action',
        ]
    );
    Route::get('/customer/print-pdf', [
        'as' => 'customer.printpdf',
     'uses' => 'pdfController@printPDF'
     ]);

});
//first-login actions-------------------------
Route::post('/user_panel/first_login/document_details/edit/action', [
        'uses' => 'firstLoginActions@verify_doc',
        'as' => '/user_panel/first_login/document_details/edit/action',
    ]
);

Route::post('/user_panel/payment/action', [
        'uses' => 'paymentController@payment',
        'as' => '/user_panel/payment/action',
    ]
);
Route::post('/user_panel/payment/coupon/action', [
        'uses' => 'paymentController@paymentCoupon',
        'as' => '/user_panel/payment/coupon/action',
    ]
);
Route::post('/first_login/personal_info/action', [
        'uses' => 'firstLoginActions@personal_info_save',
        'as' => '/first_login/personal_info/action',
    ]
);
Route::get('/first_login/action', [
        'uses' => 'firstLoginActions@personal_info_save',
        'as' => '/first_login/action',
    ]
);
Route::post('/first_login/address_details/action', [
        'uses' => 'firstLoginActions@address_details_save',
        'as' => '/first_login/address_details/action',
    ]
);
Route::post('/first_login/edu_pro_details/action', [
        'uses' => 'firstLoginActions@edu_pro_details_save',
        'as' => '/first_login/edu_pro_details/action',
    ]
);
Route::post('/first_login/cadet_details/action', [
        'uses' => 'firstLoginActions@cadet_details_save',
        'as' => '/first_login/cadet_details/action',
    ]
);
Route::post('/first_login/contact_details/action', [
        'uses' => 'firstLoginActions@contact_info_save',
        'as' => '/first_login/contact_details/action',
    ]
);

//---------------------------------------------members edit -------
Route::get('/admin_panel/members/beca_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editBecaDetails',
        'as' => '/admin_panel/members/beca_details/edit',
    ]
);
Route::get('/admin_panel/members/personal_info/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editPersonalInfo',
        'as' => '/admin_panel/members/personal_info/edit',
    ]
);


Route::get('/admin_panel/members/account_settings/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editAccountSettings',
        'as' => '/admin_panel/members/account_settings/edit',
    ]
);
Route::get('/admin_panel/members/cadet_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editCadetDetails',
        'as' => '/admin_panel/members/cadet_details/edit',
    ]
);
Route::get('/admin_panel/members/contact_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editContactDetails',
        'as' => '/admin_panel/members/contact_details/edit',
    ]
);
Route::get('/admin_panel/members/edu_pro_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editEduPro',
        'as' => '/admin_panel/members/edu_pro_details/edit',
    ]
);
Route::get('/admin_panel/members/document_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editDoc',
        'as' => '/admin_panel/members/document_details/edit',
    ]
);
Route::get('/admin_panel/members/address_details/edit/{members_id}', [
        'uses' => 'userEditShowByAdmin@editAddressDetails',
        'as' => '/admin_panel/members/address_details/edit',
    ]
);
//---------------------------------------------members edit action-------
Route::post('/admin_panel/members/beca_details/edit/action', [
        'uses' => 'userEditByAdmin@editBecaDetails',
        'as' => '/admin_panel/members/beca_details/edit/action',
    ]
);
Route::post('/admin_panel/members/account_settings/action/edit/', [
        'uses' => 'userEditByAdmin@accountSettingsEdit',
        'as' => '/admin_panel/members/account_settings/action/edit/',
    ]
);

Route::post('/admin_panel/members/personal_info/edit/action', [
        'uses' => 'userEditByAdmin@editPersonalInfo',
        'as' => '/admin_panel/members/personal_info/edit/action',
    ]
);
Route::post('/admin_panel/members/cadet_details/edit/action', [
        'uses' => 'userEditByAdmin@editCadetDetails',
        'as' => '/admin_panel/members/cadet_details/edit/action',
    ]
);Route::post('/admin_panel/members/contact_details/edit/action', [
        'uses' => 'userEditByAdmin@editContactDetails',
        'as' => '/admin_panel/members/contact_details/edit/action',
    ]
);
Route::post('/admin_panel/members/edu_pro_details/edit/action', [
        'uses' => 'userEditByAdmin@editEduPro',
        'as' => '/admin_panel/members/edu_pro_details/edit/action',
    ]
);
Route::post('/admin_panel/members/document_details/edit/action', [
        'uses' => 'userEditByAdmin@editDoc',
        'as' => '/admin_panel/members/document_details/edit/action',
    ]
);
Route::post('/admin_panel/members/address_details/edit/action', [
        'uses' => 'userEditByAdmin@editAddressDetails',
        'as' => '/admin_panel/members/address_details/edit/action',
    ]
);
//--------
Route::get('/admin_panel/members/beca_details/edit/status/{members_id}/{status}', [
        'uses' => 'userEditByAdmin@editMemberStatus',
        'as' => '/admin_panel/members/beca_details/edit/status',
    ]
);
Route::get('/admin_panel/members/beca_details/edit/permission/{members_id}/{action}/{status}', [
        'uses' => 'userEditByAdmin@editPermissionStatus',
        'as' => '/admin_panel/members/beca_details/edit/permission',
    ]
);
Route::get('/admin_panel/members/account_info/edit/{members_id}/{action}', [
        'uses' => 'userEditByAdmin@editAcountinfo',
        'as' => '/admin_panel/members/account_info/edit',
    ]
);
Route::post('/admin_panel/members/account_info/check_doc_on/edit', [
        'uses' => 'userEditByAdmin@editAcountinfo_check_doc',
        'as' => '/admin_panel/members/account_info/check_doc_on/edit',
    ]
);
Route::get('/admin_panel/first_login', [
        'uses' => 'adminDashboardController@firstloginShow',
        'as' => '/admin_panel/first_login',
    ]
);
Route::post('/admin_panel/action/firstLogin', [
        'uses' => 'adminManageController@firstloginAction',
        'as' => '/admin_panel/action/firstLogin',
    ]
);
//--------------------------------------------------------------------sms test----------------------------------
Route::get('/send-sms', [
        'uses' => 'smsSend@send_sms',
        'as' => '/send-sms',
    ]
);
//-----------------------------------------ckeditor----------------
Route::post('ckeditor/image_upload', 'ckeditorController@upload')->name('upload');
