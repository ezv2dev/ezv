\<?php

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

    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    Route::get('/', 'ListingController@becomehost')->name('ahost');

    Auth::routes();

    // Register
    Route::get('/register/partner', 'Auth\RegisterPartnerController@showRegistrationForm')->name('register.partner');
    Route::post('/register/partner', 'Auth\RegisterPartnerController@register')->name('register.partner.store');
    Route::get('/register/collabs', 'Auth\RegisterCollabController@showRegistrationForm')->name('register.collab');
    Route::post('/register/collabs', 'Auth\RegisterCollabController@register')->name('register.collab.store');

    Route::middleware(['auth', 'isOwner'])->group(
        function () {
            Route::get('/home-old', 'HomeController@index')->name('index');
            Route::get('/index/get_lat_long/', 'HomeController@get_lat_long')->name('get_lat_long');

            Route::post('/language/set', 'LanguageController@set_language')->name('language_set');
            Route::post('/currency/set', 'LanguageController@set_currency')->name('currency_set');

            Route::get('/autocomplete', 'ViewController@get_location_ajax')->name('autocomplete');

            Route::get('/privacy-policy', function () {
                return view('user.privacy_policy');
            })->name('privacy_policy');

            Route::get('/terms', function () {
                return view('user.terms');
            })->name('terms');

            Route::get('/license', function () {
                return view('user.license');
            })->name('license');

            // Villa List
            Route::get('/villa-list', 'ViewController@list')->name('list');
            Route::get('/villa-search', 'SearchVillaController@search_combine')->name('search_villa_combine');

            // Restaurant List
            Route::get('/restaurant-list', 'Restaurant\RestaurantListController@restaurant_list')->name('restaurant_list');
            Route::get('/restaurant/s', 'Restaurant\RestaurantSearchController@index')->name('search_restaurant');

            // Activity List
            Route::get('/things-to-do-list', 'Activity\ActivityListController@activity_list')->name('activity_list');
            Route::get('/things-to-do/s', 'Activity\ActivitySearchController@index')->name('search_activity');

            // Hotel List
            Route::get('/hotel/search', 'Hotel\HotelSearchController@index')->name('search_hotel');
            Route::get('/hotel-list', 'HotelController@hotel_list')->name('hotel_list');

            Route::get('/like/favorit/{id}', 'ViewController@like_favorit')->name('like_favorit');
        }
    );

    // Socialite routes
    Route::get('sign-in-google', 'UserController@google')->name('user.login.google');
    Route::get('auth/facebook', 'UserController@facebook')->name('user.login.facebook');
    Route::get('auth/google/callback', 'UserController@handleProviderCallback')->name('user.google.callback');
    Route::get('auth/facebook/callback', 'UserController@handleProviderCallbackFacebook')->name('user.facebook.callback');
    Route::get('/login-google', 'UserController@login')->middleware('guest')->name('login-google');

    //curency
    Route::get('/get-currency', 'CurrencyController@get')->name('get_currency');
    Route::get('/update-currency', 'CurrencyController@sync')->name('update_currency');
    Route::get('/get-language', 'CurrencyController@language')->name('get_language');

    //----- PERMISSION -----
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard/permission', 'PermissionController@index')->name('admin_permission');
        Route::get('/dashboard/permission/datatable', 'PermissionController@datatable')->name('admin_permission_datatable');
        Route::get('/dashboard/permission/create', 'PermissionController@create')->name('admin_permission_create');
        Route::post('/dashboard/permission/store', 'PermissionController@store')->name('admin_permission_store');
        Route::get('/dashboard/permission/delete/{id}', 'PermissionController@destroy')->name('admin_permission_delete');
        Route::get('/dashboard/role', 'PermissionController@role')->name('admin_permission_role_index');
        Route::get('dashboard/role/datatable', 'PermissionController@role_datatable')->name('admin_permission_role_datatable');
        Route::get('/dashboard/role_permission/{id}', 'PermissionController@role_permission')->name('admin_role_permission');
        Route::post('/dashboard/role_permission/store', 'PermissionController@role_permission_store')->name('admin_role_permission_store');
    });

    //--- USER ----
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard', 'PartnerController@index')->name('partner_dashboard');
        Route::get('/dashboard/user', 'UserController@index')->name('admin_user');
        Route::get('/dashboard/user/trash', 'UserController@trash')->name('admin_user_trash');
        Route::get('/dashboard/user/datatable', 'UserController@datatable')->name('admin_user_datatable');
        Route::get('/dashboard/user/datatabletrash', 'UserController@datatableTrash')->name('admin_user_datatableTrash');
        Route::get('/dashboard/user/create', 'UserController@create')->name('admin_user_create');
        Route::post('/dashboard/user/store', 'UserController@store')->name('admin_user_store');
        Route::get('/dashboard/user/show/{id}', 'UserController@show')->name('admin_user_show');
        Route::put('/dashboard/user/update/{id}', 'UserController@update')->name('admin_user_update');
        Route::get('/dashboard/user/soft-delete/{id}', 'UserController@softDestroy')->name('admin_user_soft_delete');
        Route::get('/dashboard/user/restore-delete/{id}', 'UserController@restoreDestroy')->name('admin_user_restore_delete');
        Route::get('/dashboard/user/delete/{id}', 'UserController@destroy')->name('admin_user_delete');
    });

    // PARTNER
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/admin', 'DashboardController@index')->name('admin_dashboard');
        //dummy your reservations in dashboard partner
        Route::get('dashboard/arriving_soon', 'PartnerController@index2')->name('partner_dashboard2');
        Route::get('dashboard/checkout', 'PartnerController@index3')->name('partner_dashboard3');
        Route::get('dashboard/upcoming', 'PartnerController@index4')->name('partner_dashboard4');

        Route::get('/dashboard/reservations_datatables1', 'ReservationsDashboard@datatables1')->name('reservations_dashboard_datatables1');
        Route::get('/dashboard/reservations_datatables2', 'ReservationsDashboard@datatables2')->name('reservations_dashboard_datatables2');
        Route::get('/dashboard/reservations_datatables3', 'ReservationsDashboard@datatables3')->name('reservations_dashboard_datatables3');
        Route::get('/dashboard/reservations_datatables4', 'ReservationsDashboard@datatables4')->name('reservations_dashboard_datatables4');
        //end dummy route your reservations in dashboard partner

        //route account setting partner dashboard
        Route::get('/profile', 'Dashboard\ProfileController@profile_index')->name('profile_user');
        Route::post('/profile', 'Dashboard\ProfileController@storeProfile')->name('store_profile');
        Route::get('/users/edit-photo', 'Dashboard\ProfileController@upload_foto')->name('upload_foto_index');
        Route::post('/users/edit-photo/upload', 'Dashboard\ProfileController@store_foto')->name('store_foto_profile');
        Route::get('/account-settings', 'Dashboard\AccountSettingController@index')->name('account_setting');
        Route::get('/account-settings/personal-info', 'Dashboard\AccountSettingController@personalInfo')->name('personal_info');
        Route::get('/account-settings/personal-info/add-government-id', 'Dashboard\AddGovernmentController@add_government')->name('add_government');
        Route::post('/account-settings/personal-info/add-government-id', 'Dashboard\AddGovernmentController@store_step_one');
        Route::get('/account-settings/personal-info/add-government-id/step-two', 'Dashboard\AddGovernmentController@step_two_index')->name('add_government.step_two');
        Route::post('/account-settings/personal-info/add-government-id/step-two', 'Dashboard\AddGovernmentController@store_step_two');
        Route::get('/account-settings/personal-info/add-government-id/step-three', 'Dashboard\AddGovernmentController@step_three_index')->name('add_government.step_three');
        Route::post('/account-settings/personal-info/add-government-id/step-three', 'Dashboard\AddGovernmentController@store_step_three');

        Route::get('/account-settings/login-security', 'Dashboard\AccountSettingController@login_security')->name('login_security');
        Route::get('/account-settings/notification', 'Dashboard\AccountSettingController@notification')->name('notification_setting');
        Route::get('/account-settings/notification_account', 'Dashboard\NotificationController@notification_account')->name('notification_account');
        Route::post('/account-settings/notification1', 'Dashboard\NotificationController@recognition_achievements')->name('recognition-achievements');
        Route::post('/account-settings/notification2', 'Dashboard\NotificationController@insights_tips')->name('insights-tips');
        Route::post('/account-settings/notification3', 'Dashboard\NotificationController@pricing_trends_suggestions')->name('pricing-trends-suggestions');
        Route::post('/account-settings/notification4', 'Dashboard\NotificationController@hosting_perks')->name('hosting-perks');
        Route::post('/account-settings/notification5', 'Dashboard\NotificationController@news_updates')->name('news-updates');
        Route::post('/account-settings/notification6', 'Dashboard\NotificationController@local_laws_regulations')->name('local-laws-regulations');
        Route::post('/account-settings/notification7', 'Dashboard\NotificationController@inspiration_offers')->name('inspiration-offers');
        Route::post('/account-settings/notification8', 'Dashboard\NotificationController@trip_planning')->name('trip-planning');
        Route::post('/account-settings/notification9', 'Dashboard\NotificationController@news_programs')->name('news-programs');
        Route::post('/account-settings/notification10', 'Dashboard\NotificationController@feedback')->name('feedback');
        Route::post('/account-settings/notification11', 'Dashboard\NotificationController@travel_regulations')->name('travel-regulations');
        Route::post('/account-settings/notification12', 'Dashboard\NotificationController@account_activity')->name('account-activity');
        Route::post('/account-settings/notification13', 'Dashboard\NotificationController@listing_activity')->name('listing-activity');
        Route::post('/account-settings/notification14', 'Dashboard\NotificationController@guest_policies')->name('guest-policies');
        Route::post('/account-settings/notification15', 'Dashboard\NotificationController@host_policies')->name('host-policies');
        Route::post('/account-settings/notification16', 'Dashboard\NotificationController@reminders')->name('reminders');
        Route::post('/account-settings/notification17', 'Dashboard\NotificationController@messages')->name('messages');

        Route::get('/account-settings/payments/payment-methods', 'Dashboard\PaymentController@payments')->name('payments');
        Route::get('/account-settings/payments/payout-methods', 'Dashboard\PaymentController@payouts')->name('payouts');
        Route::get('/account-settings/payments/tax-info', 'Dashboard\PaymentController@taxes')->name('taxes');
        Route::get('/account-settings/payments/guest-contributions', 'Dashboard\PaymentController@guest_contributions')->name('guest-contributions');

        Route::get('/account-settings/privacy-and-sharing', 'Dashboard\PrivacySharingController@privacy_sharing')->name('privacy_sharing');
        Route::patch('/account-settings/login-security', 'Dashboard\AccountSettingController@update_password')->name('password_update');
        Route::get('/referral', 'Dashboard\ReferralController@referral_index')->name('referral_index');
        Route::get('/account-settings/preferences', 'Dashboard\AccountSettingController@preferences')->name('preferences');
        Route::post('/account-settings/preferences1', 'Dashboard\AccountSettingController@language')->name('global-language');
        Route::post('/account-settings/preferences2', 'Dashboard\AccountSettingController@currency')->name('global-currency');
        Route::post('/account-settings/preferences3', 'Dashboard\AccountSettingController@timezone')->name('global-timezone');
        Route::get('/account-delete', 'Dashboard\AccountSettingController@formDelete')->name('account-delete-form');
        Route::post('/account-delete', 'Dashboard\AccountSettingController@storeDelete')->name('account-store-delete');
        Route::post('/account-settings/login-security/google', 'Dashboard\AccountSettingController@disconnectGoogle')->name('disconnect-google');
        Route::post('/account-settings/login-security/facebook', 'Dashboard\AccountSettingController@disconnectFacebook')->name('disconnect-facebook');
        Route::post('/account-settings/currency', 'Dashboard\AccountSettingController@change_currency')->name('change-currency');
        Route::post('/account-settings/language', 'Dashboard\AccountSettingController@change_language')->name('change-language');

        Route::get('/refer', 'Dashboard\ReferHostController@index')->name('refer_host');
        Route::get('/refer/datatable', 'Dashboard\ReferHostController@datatable')->name('refer_datatable');


        Route::get('/help-guest', 'Dashboard\HelpController@help_guest')->name('help_guest');
        Route::get('/help-host', 'Dashboard\HelpController@help_host')->name('help_host');
        Route::get('/help-experience-host', 'Dashboard\HelpController@help_experience_host')->name('help_experience_host');
        Route::get('/help-travel-admin', 'Dashboard\HelpController@help_travel_admin')->name('help_travel_admin');


        Route::get('/dashboard/listing', 'MenuListingController@index')->name('listing_dashboard');
        Route::get('/manage-your-space', 'MenuListingController@editListing')->name('edit_listing_villa_dashboard');

        Route::get('/dashboard/hotel/listing', 'Dashboard\HotelListingController@index')->name('dashboard_listing_hotel');
        Route::get('/dashboard/hotel/listing/datatable', 'Dashboard\HotelListingController@datatable')->name('dashboard_listing_hotel_datatable');

        Route::get('/dashboard/government/unapproval', 'Dashboard\GovernmentApprovalController@index')->name('government_approval_index');
        Route::get('/dashboard/government/approval', 'Dashboard\GovernmentApprovalController@approval_index')->name('government_list_approval_index');
        Route::get('/dashboard/government/approval/datatable', 'Dashboard\GovernmentApprovalController@datatable')->name('government_unapproval_datatable');
        Route::get('/dashboard/government/approval/datatableapproval', 'Dashboard\GovernmentApprovalController@datatableapproval')->name('government_approval_datatable');
        Route::get('/dashboard/government/approve/{id}', 'Dashboard\GovernmentApprovalController@approve')->name('government_approve');


        Route::get('/dashboard/listing/datatable', 'MenuListingController@datatable')->name('admin_listing_datatable');
        Route::get('/dashboard/reservations', 'MenuReservationsController@index')->name('reservations_dashboard');
        Route::get('/dashboard/reservations/completed', 'MenuReservationsController@reservations_completed_index')->name('reservations_completed_index');
        Route::get('/dashboard/reservations/canceled', 'MenuReservationsController@reservations_canceled_index')->name('reservations_canceled_index');
        Route::get('/dashboard/reservations/all', 'MenuReservationsController@reservations_all_index')->name('reservations_all_index');

        Route::get('/dashboard/reservations/datatableUpcoming', 'MenuReservationsController@datatableUpcoming')->name('reservations_datatable_upcoming');
        Route::get('/dashboard/reservations/datatableCompleted', 'MenuReservationsController@datatableCompleted')->name('reservations_datatable_completed');
        Route::get('/dashboard/reservations/datatableCanceled', 'MenuReservationsController@datatableCanceled')->name('reservations_datatable_canceled');

        Route::get('/dashboard/inbox', 'InboxController@index')->name('partner_inbox');
        Route::get('/dashboard/inbox/datatable', 'InboxController@datatable')->name('partner_inbox_datatable');
        Route::get('/dashboard/inbox/show/{id}', 'InboxController@show')->name('partner_inbox_show');
        Route::get('/dashboard/calendar', 'CalendarController@index')->name('calendar_index');
        Route::get('/dashboard/calendar/all', 'CalendarController@all')->name('calendar.all');
        Route::get('/dashboard/calendar/villa/{id}', 'CalendarController@filterVilla')->name('calendar_filter');

        Route::get('/dashboard/calendar/{id}', 'CalendarController@selectVilla')->name('calendar.select_villa');
        Route::post('/dashboard/calendar/store', 'CalendarController@storeEvent')->name('calendar_store');
        Route::post('/dashboard/calendar/update', 'CalendarController@updateEvent')->name('calendar_update');
        Route::get('/dashboard/calendar/delete/{id}', 'CalendarController@destroy')->name('calendar_destroy');

        //insight
        Route::get('/dashboard/progress/opportunity', 'InsightDashboardController@index')->name('insight_dashboard');
        Route::get('/dashboard/progress/reviews', 'InsightDashboardController@reviews')->name('insight_dashboard_reviews');

        Route::post('/dashboard/progress/reviews/five_star', 'InsightDashboardController@five_star')->name('insight_reviews_five_star');
        Route::post('/dashboard/progress/reviews/four_star', 'InsightDashboardController@four_star')->name('insight_reviews_four_star');
        Route::post('/dashboard/progress/reviews/three_star', 'InsightDashboardController@three_star')->name('insight_reviews_three_star');
        Route::post('/dashboard/progress/reviews/two_star', 'InsightDashboardController@two_star')->name('insight_reviews_two_star');
        Route::post('/dashboard/progress/reviews/one_star', 'InsightDashboardController@one_star')->name('insight_reviews_one_star');


        Route::get('/dashboard/progress/earnings', 'Dashboard\EarningsController@earnings')->name('insight_dashboard_earnings');
        Route::get('/dashboard/earnings/charts/{id}', 'Dashboard\EarningsController@chart')->name('chart_earnings');
        Route::get('/dashboard/earnings/{id}', 'Dashboard\EarningsController@getEarnings')->name('earnings_get_total_earnings');

        Route::get('/dashboard/progress/superhost', 'InsightDashboardController@superhost')->name('insight_dashboard_superhost');
        Route::get('/dashboard/progress/cleaning', 'InsightDashboardController@cleaning')->name('insight_dashboard_cleaning');
        Route::get('/dashboard/progress/views', 'InsightDashboardController@views')->name('insight_dashboard_views');

        Route::get('/users/transaction_history/completed-payouts', 'TransactionHistoryController@completed_payouts')->name('completed_payouts');
        Route::get('/users/transaction_history/upcoming-payouts', 'TransactionHistoryController@upcoming_payouts')->name('upcoming_payouts');
        Route::get('/users/transaction_history/gross-earnings', 'TransactionHistoryController@gross_earnings')->name('gross_earnings');

        Route::get('/manage-guidebook', 'ManageGuidebookController@index')->name('manage_guidebook');
    });

    // -- PERSONAL INFO --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::post('/account-settings/personal-info/name', 'Dashboard\PersonalController@updateName')->name('personal_update_name');
        Route::post('/account-settings/personal-info/gender', 'Dashboard\PersonalController@updateGender')->name('personal_update_gender');
        Route::post('/account-settings/personal-info/birthday', 'Dashboard\PersonalController@updateBirthday')->name('personal_update_birthday');
        Route::post('/account-settings/personal-info/email', 'Dashboard\PersonalController@updateEmail')->name('personal_update_email');
        Route::post('/account-settings/personal-info/phone', 'Dashboard\PersonalController@updatePhone')->name('personal_update_phone');
        Route::post('/account-settings/personal-info/address', 'Dashboard\PersonalController@updateAddress')->name('personal_update_address');
    });

    // -- VILLA ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/villa', 'VillaController@index')->name('admin_villa');
        Route::get('/dashboard/villa', 'VillaController@index')->name('admin_villa');
        Route::get('/dashboard/villa/datatable', 'VillaController@datatable')->name('admin_villa_datatable');
        Route::get('/dashboard/villa/soft-delete/{id}', 'VillaListingController@softDestroy')->name('admin_villa_soft_delete');
        Route::get('/dashboard/villa/restore-delete/{id}', 'VillaListingController@restoreDestroy')->name('admin_villa_restore_delete');
        Route::get('/dashboard/villa/trash', 'VillaController@trash')->name('admin_villa_trash');
        Route::get('/dashboard/villa/datatabletrash', 'VillaController@datatableTrash')->name('admin_villa_datatableTrash');
    });

    // -- reward program ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/reward-category', 'RewardCategoryController@index')->name('admin_reward_category');
        Route::get('/dashboard/reward-category/datatable', 'RewardCategoryController@datatable')->name('admin_reward_category_datatable');
        Route::get('/dashboard/reward-category/create', 'RewardCategoryController@create')->name('admin_reward_category_create');
        Route::post('/dashboard/reward-category/store', 'RewardCategoryController@store')->name('admin_reward_category_store');
        Route::get('/dashboard/reward-category/show/{id}', 'RewardCategoryController@show')->name('admin_reward_category_show');
        Route::put('/dashboard/reward-category/update/{id}', 'RewardCategoryController@update')->name('admin_reward_category_update');
        Route::get('/dashboard/reward-category/delete/{id}', 'RewardCategoryController@destroy')->name('admin_reward_category_delete');
        Route::get('/dashboard/user-reward', 'UserRewardController@index')->name('admin_user_reward');
        Route::get('/dashboard/user-reward/datatable', 'UserRewardController@datatable')->name('admin_user_reward_datatable');
        Route::get('/dashboard/user-reward/create', 'UserRewardController@create')->name('admin_user_reward_create');
        Route::post('/dashboard/user-reward/store', 'UserRewardController@store')->name('admin_user_reward_store');
        Route::get('/dashboard/user-reward/show/{id}', 'UserRewardController@show')->name('admin_user_reward_show');
        Route::put('/dashboard/user-reward/update/{id}', 'UserRewardController@update')->name('admin_user_reward_update');
        Route::get('/dashboard/user-reward/delete/{id}', 'UserRewardController@destroy')->name('admin_user_reward_delete');
        Route::get('/dashboard/user-reward/update-status/{id}', 'UserRewardController@update_status')->name('admin_user_reward_update_status');
        Route::get('/dashboard/user-reward-balance', 'UserRewardBalanceController@index')->name('admin_user_reward_balance');
        Route::get('/dashboard/user-reward-balance/datatable', 'UserRewardBalanceController@datatable')->name('admin_user_reward_balance_datatable');
        Route::get('/dashboard/staff-reward-balance', 'StaffRewardBalanceController@index')->name('admin_staff_reward_balance');
        Route::get('/dashboard/staff-reward-balance/datatable', 'StaffRewardBalanceController@datatable')->name('admin_staff_reward_balance_datatable');
        Route::get('/dashboard/tax-setting', 'TaxSettingController@index')->name('admin_tax_setting');
        Route::get('/dashboard/tax-setting/datatable', 'TaxSettingController@datatable')->name('admin_tax_setting_datatable');
        Route::get('/dashboard/tax-setting/create', 'TaxSettingController@create')->name('admin_tax_setting_create');
        Route::post('/dashboard/tax-setting/store', 'TaxSettingController@store')->name('admin_tax_setting_store');
        Route::get('/dashboard/tax-setting/show/{id}', 'TaxSettingController@show')->name('admin_tax_setting_show');
        Route::put('/dashboard/tax-setting/update/{id}', 'TaxSettingController@update')->name('admin_tax_setting_update');
        Route::get('/dashboard/tax-setting/delete/{id}', 'TaxSettingController@destroy')->name('admin_tax_setting_delete');
    });


    //GET DISABLED DATE
    Route::get('/villa/date_disabled/{id}', 'VillabookingController@disabled')->name('disable_date');
    Route::get('/villa/get_total/{id}', 'VillabookingController@get_total')->name('get_total');

    //-- ADD VILLA --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/add-listing', 'ListingController@add_listing')->name('admin_add_listing');
        Route::post('/admin/villa/store', 'VillaListingController@store')->name('admin_villa_store');
        Route::get('/admin/villa/delete/{id}', 'VillaListingController@destroy')->name('admin_villa_destroy');
        Route::get('/admin/villa/update-status/{id}', 'VillaListingController@status')->name('admin_villa_update_status');
        Route::get('/admin/restaurant/update-status/{id}', 'Restaurant\RestaurantController@update_status')->name('admin_food_update_status');
        Route::post('/admin/restaurant/grade/{id}', 'Restaurant\RestaurantController@grade')->name('restaurant_update_grade');
        Route::post('/admin/restaurant/store', 'RestaurantListingController@store')->name('admin_restaurant_store');
        Route::get('/admin/restaurant/delete/{id}', 'RestaurantListingController@destroy')->name('admin_restaurant_destroy');
        Route::post('/admin/things-to-do/store', 'ActivityListingController@store')->name('admin_activity_store');
        Route::get('/admin/things-to-do/delete/{id}', 'ActivityListingController@destroy')->name('admin_activity_destroy');
        Route::get('/admin/things-to-do/update-status/{id}', 'Activity\ActivityController@update_status')->name('admin_activity_update_status');
        Route::get('/villa/status/{id}', 'VillaListingController@status')->name('villa_update_status');
        Route::post('/villa/grade/{id}', 'VillaListingController@grade')->name('villa_update_grade');
        Route::post('/villa/extra/{id}', 'VillaListingController@grade')->name('villa_update_grade');
        Route::get('/admin/villa-booking/update-status/completed/{id}', 'ReservationsDashboard@updateStatusComplete')->name('villa_booking_status_complete');
        Route::get('/admin/villa-booking/update-status/canceled/{id}', 'ReservationsDashboard@updateStatusCanceled')->name('villa_booking_status_canceled');
    });

    Route::get('villa/calendar/{id}', 'ViewController@fullcalendar')->name('villa.fullcalendar');
    Route::get('villa/calendar/not_available/{id}', 'ViewController@fullcalendarNotAvailable')->name('villa.fullcalendarNotAvailable');

    //edit from frontend
    Route::post('/villa/update/photo/position', 'ViewController@update_position_photo')->name('villaphoto_edit_position');
    Route::post('/villa/update/video/position', 'ViewController@update_position_video')->name('villavideo_edit_position');
    Route::post('/villa/update/price', 'ViewController@villa_update_price')->name('villa_update_price');
    Route::post('/villa/update/not_available', 'ViewController@villa_not_available')->name('villa_not_available');
    Route::post('/villa/update/bedroom', 'ViewController@villa_update_bedroom')->name('villa_update_bedroom');
    Route::post('/villa/update/guest', 'ViewController@villa_update_guest')->name('villa_update_guest');
    Route::post('/villa/update/location', 'ViewController@villa_update_location')->name('villa_update_location');
    Route::post('/villa/update/description', 'ViewController@villa_update_description')->name('villa_update_description');
    Route::post('/villa/update/name', 'ViewController@villa_update_name')->name('villa_update_name');
    Route::post('/villa/update/short-description', 'ViewController@villa_update_short_description')->name('villa_update_short_description');
    Route::post('/villa/update/amenities', 'ViewController@villa_update_amenities')->name('villa_update_amenities');
    Route::post('/villa/update/story', 'ViewController@villa_update_story')->name('villa_update_story');
    Route::post('/villa/update/photo', 'ViewController@villa_update_photo')->name('villa_update_photo');
    Route::post('/villa/update/image', 'ViewController@villa_update_image')->name('villa_update_image');
    Route::post('/villa/update/property-type', 'ViewController@villa_update_property_type')->name('villa_update_property_type');
    Route::get('/villa/{id}/delete/story/{id_story}', 'ViewController@villa_delete_story')->name('villa_delete_story');
    Route::patch('/villa/{id}/update/cancel-request-update-status', 'ViewController@cancel_request_update_status')->name('villa_cancel_request_update_status');
    Route::get('/villa/{id}/delete/image', 'ViewController@villa_delete_image')->name('villa_delete_image');
    Route::get('/villa/{id}/delete/photo/video/{id_video}', 'ViewController@villa_delete_photo_video')->name('villa_delete_photo_video');
    Route::get('/villa/{id}/delete/photo/photo/{id_photo}', 'ViewController@villa_delete_photo_photo')->name('villa_delete_photo_photo');
    Route::post('/villa/update/extra', 'ViewController@villa_update_extra')->name('villa_update_extra');


    // ! Verified
    // Route::middleware(['auth'])->group(
    //     function () {
    //     }
    // );
    Route::patch('/villa/{id}/update/request-update-status', 'ViewController@request_update_status')->name('villa_request_update_status');
    Route::patch('/restaurant/{id}/update/request-update-status', 'Restaurant\RestaurantController@request_update_status')->name('restaurant_request_update_status');
    Route::patch('/things-to-do/{id}/update/request-update-status', 'Activity\ActivityController@request_update_status')->name('activity_request_update_status');
    Route::patch('/hotel/{id}/update/request-update-status', 'Hotel\HotelDetailController@request_update_status')->name('hotel_request_update_status');
    // ! End Verified

    //--VILLA GALLERY --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/villa/create_gallery/{id}', 'VillaController@create_gallery')->name('admin_villa_create_gallery');
        Route::post('/admin/villa/store_gallery', 'VillaController@store_gallery')->name('admin_villa_store_gallery');
        Route::get('/admin/villa/delete_gallery/{id}', 'VillaController@destroy_gallery')->name('admin_villa_delete_gallery');
        Route::get('/admin/villa/delete_video/{id}', 'VillaController@destroy_video')->name('admin_villa_delete_video');
    });

    //--VILLA NEAR BY--
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/villa/index_nearby/{id}', 'VillaController@index_nearby')->name('admin_villa_index_nearby');
        Route::get('/admin/villa/datatable_nearby/{id}', 'VillaController@datatable_nearby')->name('admin_villa_datatable_nearby');
        Route::get('/admin/villa/create_nearby/{id}', 'VillaController@create_nearby')->name('admin_villa_create_nearby');
        Route::post('/admin/villa/store_nearby', 'VillaController@store_nearby')->name('admin_villa_store_nearby');
        Route::get('/admin/villa/delete_nearby/{id}', 'VillaController@destroy_nearby')->name('admin_villa_delete_nearby');
    });

    //--VILLA EXTRA PRICE--
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/villa/index_extraprice/{id}', 'VillaController@index_extraprice')->name('admin_villa_index_extraprice');
        Route::get('/admin/villa/datatable_extraprice/{id}', 'VillaController@datatable_extraprice')->name('admin_villa_datatable_extraprice');
        Route::get('/admin/villa/create_extraprice/{id}', 'VillaController@create_extraprice')->name('admin_villa_create_extraprice');
        Route::post('/admin/villa/store_extraprice', 'VillaController@store_extraprice')->name('admin_villa_store_extraprice');
        Route::get('/admin/villa/delete_extraprice/{id}', 'VillaController@destroy_extraprice')->name('admin_villa_delete_extraprice');
    });

    //-- VILLA BOOKING --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/booking', 'VillabookingController@index')->name('admin_villa_booking');
        Route::post('dashboard/villa/booking/store', 'VillabookingController@store')->name('admin_villa_booking_store');
        Route::get('/dashboard/villa/booking/list', 'VillabookingController@list')->name('admin_villa_booking_list');
        Route::get('/dashboard/villa/booking/datatable', 'VillabookingController@datatable')->name('admin_villa_booking_datatable');
        Route::post('/dashboard/villa/booking/update/{id}', 'VillabookingController@update')->name('admin_villa_booking_update');
        Route::get('/dashboard/villa/booking/delete/{id}', 'VillabookingController@delete')->name('admin_villa_booking_delete');
    });

    //-- VILLA TYPE ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/type', 'VillatypeController@index')->name('admin_villatype');
        Route::get('/dashboard/villa/type/datatable', 'VillatypeController@datatable')->name('admin_villatype_datatable');
        Route::get('/dashboard/villa/type/create', 'VillatypeController@create')->name('admin_villatype_create');
        Route::post('/dashboard/villa/type/store', 'VillatypeController@store')->name('admin_villatype_store');
        Route::get('/dashboard/villa/type/show/{id}', 'VillatypeController@show')->name('admin_villatype_show');
        Route::put('/dashboard/villa/type/update/{id}', 'VillatypeController@update')->name('admin_villatype_update');
        Route::get('/dashboard/villa/type/delete/{id}', 'VillatypeController@destroy')->name('admin_villatype_delete');
    });

    //-- VILLA CONTACT HOST ---
    Route::middleware(['auth'])->group(function () {
        Route::get('/conversation', 'VillaContactHostController@index')->name('messages');
        Route::post('/villa/contact-host/user/store-message', 'VillaContactHostController@store_message')->name('villa_store_user_message');
        Route::post('/villa/contact-host/owner/reply-message', 'VillaContactHostController@reply_message')->name('villa_reply_owner_message');
        Route::post('/villa/contact-host/admin/update-approve-user-message', 'VillaContactHostController@update_approve_user_message')->name('villa_update_approve_user_message');
        Route::post('/villa/contact-host/admin/update-disapprove-user-message', 'VillaContactHostController@update_disapprove_user_message')->name('villa_update_disapprove_user_message');
        Route::post('/villa/contact-host/admin/update-approve-owner-message', 'VillaContactHostController@update_approve_owner_message')->name('villa_update_approve_owner_message');
        Route::post('/villa/contact-host/admin/update-disapprove-owner-message', 'VillaContactHostController@update_disapprove_owner_message')->name('villa_update_disapprove_owner_message');
        Route::get('/admin/villa/contact-host/conversation', 'VillaContactHostController@admin_index')->name('admin_villa_get_messages');
        Route::get('/owner/villa/contact-host/conversation', 'VillaContactHostController@owner_index')->name('owner_villa_get_messages');
    });

    //-- NO OF BEDROOM ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/no_bedroom', 'NobedroomController@index')->name('admin_no_bedroom');
        Route::get('/dashboard/villa/no_bedroom/datatable', 'NobedroomController@datatable')->name('admin_no_bedroom_datatable');
        Route::get('/dashboard/villa/no_bedroom/create', 'NobedroomController@create')->name('admin_no_bedroom_create');
        Route::post('/dashboard/villa/no_bedroom/store', 'NobedroomController@store')->name('admin_no_bedroom_store');
        Route::get('/dashboard/villa/no_bedroom/show/{id}', 'NobedroomController@show')->name('admin_no_bedroom_show');
        Route::put('/dashboard/villa/no_bedroom/update/{id}', 'NobedroomController@update')->name('admin_no_bedroom_update');
        Route::get('/dashboard/villa/no_bedroom/delete/{id}', 'NobedroomController@destroy')->name('admin_no_bedroom_delete');
    });


    //-- BEDROOM ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/bedroom', 'BedroomController@index')->name('admin_bedroom');
        Route::get('/dashboard/villa/bedroom/datatable', 'BedroomController@datatable')->name('admin_bedroom_datatable');
        Route::get('/dashboard/villa/bedroom/create', 'BedroomController@create')->name('admin_bedroom_create');
        Route::post('/dashboard/villa/bedroom/store', 'BedroomController@store')->name('admin_bedroom_store');
        Route::get('/dashboard/villa/bedroom/show/{id}', 'BedroomController@show')->name('admin_bedroom_show');
        Route::put('/dashboard/villa/bedroom/update/{id}', 'BedroomController@update')->name('admin_bedroom_update');
        Route::get('/dashboard/villa/bedroom/delete/{id}', 'BedroomController@destroy')->name('admin_bedroom_delete');
    });


    //-- BATHROOM ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/bathroom', 'BathroomController@index')->name('admin_bathroom');
        Route::get('/dashboard/villa/bathroom/datatable', 'BathroomController@datatable')->name('admin_bathroom_datatable');
        Route::get('/dashboard/villa/bathroom/create', 'BathroomController@create')->name('admin_bathroom_create');
        Route::post('/dashboard/villa/bathroom/store', 'BathroomController@store')->name('admin_bathroom_store');
        Route::get('/dashboard/villa/bathroom/show/{id}', 'BathroomController@show')->name('admin_bathroom_show');
        Route::put('/dashboard/villa/bathroom/update/{id}', 'BathroomController@update')->name('admin_bathroom_update');
        Route::get('/dashboard/villa/bathroom/delete/{id}', 'BathroomController@destroy')->name('admin_bathroom_delete');
    });


    //-- KITCHEN ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/kitchen', 'KitchenController@index')->name('admin_kitchen');
        Route::get('/dashboard/villa/kitchen/datatable', 'KitchenController@datatable')->name('admin_kitchen_datatable');
        Route::get('/dashboard/villa/kitchen/create', 'KitchenController@create')->name('admin_kitchen_create');
        Route::post('/dashboard/villa/kitchen/store', 'KitchenController@store')->name('admin_kitchen_store');
        Route::get('/dashboard/villa/kitchen/show/{id}', 'KitchenController@show')->name('admin_kitchen_show');
        Route::put('/dashboard/villa/kitchen/update/{id}', 'KitchenController@update')->name('admin_kitchen_update');
        Route::get('/dashboard/villa/kitchen/delete/{id}', 'KitchenController@destroy')->name('admin_kitchen_delete');
    });

    //-- SERVICE ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/service', 'ServiceController@index')->name('admin_service');
        Route::get('/dashboard/villa/service/datatable', 'ServiceController@datatable')->name('admin_service_datatable');
        Route::get('/dashboard/villa/service/create', 'ServiceController@create')->name('admin_service_create');
        Route::post('/dashboard/villa/service/store', 'ServiceController@store')->name('admin_service_store');
        Route::get('/dashboard/villa/service/show/{id}', 'ServiceController@show')->name('admin_service_show');
        Route::put('/dashboard/villa/service/update/{id}', 'ServiceController@update')->name('admin_service_update');
        Route::get('/dashboard/villa/service/delete/{id}', 'ServiceController@destroy')->name('admin_service_delete');

        Route::get('/dashboard/villa/family', 'OutdoorController@index')->name('admin_family');
        Route::get('/dashboard/villa/family/datatable', 'OutdoorController@datatable')->name('admin_family_datatable');
        Route::get('/dashboard/villa/family/create', 'OutdoorController@create')->name('admin_family_create');
        Route::post('/dashboard/villa/family/store', 'OutdoorController@store')->name('admin_family_store');
        Route::get('/dashboard/villa/family/show/{id}', 'OutdoorController@show')->name('admin_family_show');
        Route::put('/dashboard/villa/family/update/{id}', 'OutdoorController@update')->name('admin_family_update');
        Route::get('/dashboard/villa/family/delete/{id}', 'OutdoorController@destroy')->name('admin_family_delete');

        Route::get('/dashboard/villa/outdoor', 'FamilyController@index')->name('admin_outdoor');
        Route::get('/dashboard/villa/outdoor/datatable', 'FamilyController@datatable')->name('admin_outdoor_datatable');
        Route::get('/dashboard/villa/outdoor/create', 'FamilyController@create')->name('admin_outdoor_create');
        Route::post('/dashboard/villa/outdoor/store', 'FamilyController@store')->name('admin_outdoor_store');
        Route::get('/dashboard/villa/outdoor/show/{id}', 'FamilyController@show')->name('admin_outdoor_show');
        Route::put('/dashboard/villa/outdoor/update/{id}', 'FamilyController@update')->name('admin_outdoor_update');
        Route::get('/dashboard/villa/outdoor/delete/{id}', 'FamilyController@destroy')->name('admin_outdoor_delete');
    });

    //-- SAFETY ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/safety', 'SafetyController@index')->name('admin_safety');
        Route::get('/dashboard/villa/safety/datatable', 'SafetyController@datatable')->name('admin_safety_datatable');
        Route::get('/dashboard/villa/safety/create', 'SafetyController@create')->name('admin_safety_create');
        Route::post('/dashboard/villa/safety/store', 'SafetyController@store')->name('admin_safety_store');
        Route::get('/dashboard/villa/safety/show/{id}', 'SafetyController@show')->name('admin_safety_show');
        Route::put('/dashboard/villa/safety/update/{id}', 'SafetyController@update')->name('admin_safety_update');
        Route::get('/dashboard/villa/safety/delete/{id}', 'SafetyController@destroy')->name('admin_safety_delete');
    });

    //-- AMENITIES ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/villa/amenities', 'AmenitiesController@index')->name('admin_amenities');
        Route::get('/dashboard/villa/amenities/datatable', 'AmenitiesController@datatable')->name('admin_amenities_datatable');
        Route::get('/dashboard/villa/amenities/create', 'AmenitiesController@create')->name('admin_amenities_create');
        Route::post('/dashboard/villa/amenities/store', 'AmenitiesController@store')->name('admin_amenities_store');
        Route::get('/dashboard/villa/amenities/show/{id}', 'AmenitiesController@show')->name('admin_amenities_show');
        Route::put('/dashboard/villa/amenities/update/{id}', 'AmenitiesController@update')->name('admin_amenities_update');
        Route::get('/dashboard/villa/amenities/delete/{id}', 'AmenitiesController@destroy')->name('admin_amenities_delete');
    });

    //-- LOCATION ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/location', 'LocationController@index')->name('admin_location');
        Route::get('/dashboard/location/datatable', 'LocationController@datatable')->name('admin_location_datatable');
        Route::get('/dashboard/location/create', 'LocationController@create')->name('admin_location_create');
        Route::post('/dashboard/location/store', 'LocationController@store')->name('admin_location_store');
        Route::get('/dashboard/location/show/{id}', 'LocationController@show')->name('admin_location_show');
        Route::put('/dashboard/location/update/{id}', 'LocationController@update')->name('admin_location_update');
        Route::get('/dashboard/location/delete/{id}', 'LocationController@destroy')->name('admin_location_delete');
    });

    //-- REVIEW ----
    Route::get('/review/create/{id}', 'ReviewController@create')->name('villa_review');
    Route::post('/review/store', 'ReviewController@store')->name('villa_review_store');
    Route::get('/review/delete/{id}', 'ReviewController@delete')->name('villa_review_delete');

    //user categori
    Route::get('/villa/list', 'ViewController@villa_list')->name('villa_list');

    // Filter Modal
    Route::get('/hotel/filters', 'Hotel\HotelSearchController@search')->name('filters-hotel');

    // filter villa
    Route::get('/villa/property-type/{id}', 'PropertyTypeVillaController@index')->name('property_type');
    Route::get('/villa/filter/{id}', 'FilterController@filter')->name('filter');
    Route::get('/villa/price', 'PriceFilterController@price')->name('price');
    Route::get('/villa/more-filter', 'MoreFilterController@moreFilter')->name('more_filter');
    Route::get('/villa/boxfilter/', 'FilterBoxController@filter')->name('box_filter');
    Route::get('/villa/amenities/', 'FilterBoxController@amenities')->name('amenities_filter');
    Route::get('/villa/sort-low-to-high', 'SortFilterController@sort_low_to_high')->name('sort_low_to_high');
    Route::get('/villa/sort-high-to-low', 'SortFilterController@sort_high_to_low')->name('sort_high_to_low');
    Route::get('/villa/sort-popularity', 'SortFilterController@popularity')->name('sort_popularity');
    Route::get('/villa/sort-newest', 'SortFilterController@newest')->name('sort_newest');
    Route::get('/villa/sort-highest-rating', 'SortFilterController@highest_rating')->name('sort_highest_rating');

    //user search
    Route::get('/villa/{id}', 'ViewController@villa')->name('villa');
    Route::get('/villa/{id}/{in}/{out}/{adult}/{child}', 'ViewController@villa_set')->name('villa_set');
    Route::get('/story/{id}', 'ViewController@story')->name('villa_story');
    Route::get('/story/next/{id}/{id_villa}', 'ViewController@story_next')->name('story_next');
    Route::get('/villa/video/{id}', 'ViewController@video')->name('villa_video');
    Route::get('/villa/description/{id}', 'ViewController@description')->name('villa_description');
    Route::get('/suggestion', 'ViewController@getVideoSuggestions')->name('suggestion');
    Route::get('/villa/amenities/{id}', 'ViewController@amenities')->name('list_amenities');
    Route::get('/villa/bathroom/{id}', 'ViewController@bathroom')->name('list_bathroom');
    Route::get('/villa/bedroom/{id}', 'ViewController@bedroom')->name('list_bedroom');
    Route::get('/villa/kitchen/{id}', 'ViewController@kitchen')->name('list_kitchen');
    Route::get('/villa/safety/{id}', 'ViewController@safety')->name('list_safety');
    Route::get('/villa/service/{id}', 'ViewController@service')->name('list_service');
    Route::get('/villa/review/{id}', 'ViewController@review')->name('villa_review');
    Route::get('/villa/availabality/{id}', 'ViewController@availabality')->name('villa_availabality');
    Route::post('/villa/confirm/', 'ViewController@confirm')->name('villa_booking_confirm');
    Route::post('/villa/confirm/store', 'VillabookingController@user_store')->name('villa_booking_user_store');

    Route::get('/villa/favorit/{id}', 'VillasaveController@favorit')->name('villa_favorit');

    Route::get('/villa/video/{id}', 'ViewController@villa_video')->name('list-villa_video');
    Route::get('/villa/map/{id}', 'ViewController@villa_map')->name('villa_map');
    Route::get('/video/next', 'ViewController@next')->name('video_next');


    Route::get('/villa/video/open/{id}', 'ViewController@video_open')->name('video_open');

    // things to know villa
    Route::post('/houserules/post', 'ViewController@villa_update_house_rules')->name('villa_update_house_rules');
    Route::post('/guessafety/post', 'ViewController@villa_update_guest_safety')->name('villa_update_guest_safety');
    Route::post('/cancellation_policy/post', 'ViewController@villa_update_cancellation_policy')->name('villa_update_cancellation_policy');
    Route::post('/villa/photo/caption/update', 'ViewController@villa_update_caption_photo')->name('villa_update_caption_photo');

    //-- RESTAURANT ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::post('/restaurant/update/photo/position', 'Restaurant\RestaurantController@restaurant_update_position_photo')->name('restaurant_update_photo_photo_position');
        Route::post('/restaurant/update/video/position', 'Restaurant\RestaurantController@restaurant_update_position_video')->name('restaurant_update_photo_video_position');

        Route::get('/dashboard/restaurant', 'RestaurantController@index')->name('admin_restaurant');
        Route::get('/dashboard/restaurant/datatable', 'RestaurantController@datatable')->name('admin_restaurant_datatable');

        Route::get('/dashboard/restaurant/trash', 'RestaurantController@trash')->name('admin_restaurant_trash');
        Route::get('/dashboard/restaurant/datatabletrash', 'RestaurantController@datatableTrash')->name('admin_restaurant_datatabletrash');

        Route::get('/dashboard/restaurant/soft-delete/{id}', 'RestaurantListingController@softDestroy')->name('admin_restaurant_soft_delete');
        Route::get('/dashboard/restaurant/restore-delete/{id}', 'RestaurantListingController@restoreDestroy')->name('admin_restaurant_restore_delete');
    });

    //---- RESTAURANT MENU ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/restaurant/index_menu/{id}', 'RestaurantController@index_menu')->name('admin_restaurant_index_menu');
        Route::get('/admin/restaurant/datatable_menu/{id}', 'RestaurantController@datatable_menu')->name('admin_restaurant_datatable_menu');
        Route::get('/admin/restaurant/create_menu/{id}', 'RestaurantController@create_menu')->name('admin_restaurant_create_menu');
        Route::post('/admin/restaurant/store_menu', 'RestaurantController@store_menu')->name('admin_restaurant_store_menu');
        Route::get('/admin/restaurant/delete_menu/{id}', 'RestaurantController@destroy_menu')->name('admin_restaurant_delete_menu');
    });

    //--RESTAURANT GALLERY --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/restaurant/create_gallery/{id}', 'RestaurantController@create_gallery')->name('admin_restaurant_create_gallery');
        Route::post('/admin/restaurant/store_gallery', 'RestaurantController@store_gallery')->name('admin_restaurant_store_gallery');
        Route::get('/admin/restaurant/delete_gallery/{id}', 'RestaurantController@destroy_gallery')->name('admin_restaurant_delete_gallery');
        Route::get('/admin/restaurant/delete_video/{id}', 'RestaurantController@destroy_video')->name('admin_restaurant_delete_video');
    });

    // RESTAURANT TYPE
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/type', 'RestaurantTypeController@index')->name('restaurant_type');
        Route::get('/dashboard/restaurant/type/datatable', 'RestaurantTypeController@datatable')->name('admin_restaurant_type_datatable');
        Route::get('/dashboard/restaurant/type/create', 'RestaurantTypeController@create')->name('admin_restaurant_type_create');
        Route::post('/dashboard/restaurant/type/store', 'RestaurantTypeController@store')->name('admin_restaurant_type_store');
        Route::get('/dashboard/restaurant/type/show/{id}', 'RestaurantTypeController@show')->name('admin_restaurant_type_show');
        Route::put('/dashboard/restaurant/type/update/{id}', 'RestaurantTypeController@update')->name('admin_restaurant_type_update');
        Route::get('/dashboard/restaurant/type/delete/{id}', 'RestaurantTypeController@destroy')->name('admin_restaurant_type_delete');
    });

    // RESTAURANT FACILITIES
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/facilities', 'Restaurant\RestaurantFacilitiesController@index')->name('restaurant_facilities');
        Route::get('/dashboard/restaurant/facilities/datatable', 'Restaurant\RestaurantFacilitiesController@datatable')->name('admin_restaurant_facilities_datatable');
        Route::get('/dashboard/restaurant/facilities/create', 'Restaurant\RestaurantFacilitiesController@create')->name('admin_restaurant_facilities_create');
        Route::post('/dashboard/restaurant/facilities/store', 'Restaurant\RestaurantFacilitiesController@store')->name('admin_restaurant_facilities_store');
        Route::get('/dashboard/restaurant/facilities/show/{id}', 'Restaurant\RestaurantFacilitiesController@show')->name('admin_restaurant_facilities_show');
        Route::put('/dashboard/restaurant/facilities/update/{id}', 'Restaurant\RestaurantFacilitiesController@update')->name('admin_restaurant_facilities_update');
        Route::get('/dashboard/restaurant/facilities/delete/{id}', 'Restaurant\RestaurantFacilitiesController@destroy')->name('admin_restaurant_facilities_delete');
    });

    // RESTAURANT MEAL
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/meal', 'Restaurant\RestaurantMealController@index')->name('restaurant_meal');
        Route::get('/dashboard/restaurant/meal/datatable', 'Restaurant\RestaurantMealController@datatable')->name('admin_restaurant_meal_datatable');
        Route::get('/dashboard/restaurant/meal/create', 'Restaurant\RestaurantMealController@create')->name('admin_restaurant_meal_create');
        Route::post('/dashboard/restaurant/meal/store', 'Restaurant\RestaurantMealController@store')->name('admin_restaurant_meal_store');
        Route::get('/dashboard/restaurant/meal/show/{id}', 'Restaurant\RestaurantMealController@show')->name('admin_restaurant_meal_show');
        Route::put('/dashboard/restaurant/meal/update/{id}', 'Restaurant\RestaurantMealController@update')->name('admin_restaurant_meal_update');
        Route::get('/dashboard/restaurant/meal/delete/{id}', 'Restaurant\RestaurantMealController@destroy')->name('admin_restaurant_meal_delete');
    });

    // RESTAURANT PRICE
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/price', 'Restaurant\RestaurantPriceController@index')->name('restaurant_price');
        Route::get('/dashboard/restaurant/price/datatable', 'Restaurant\RestaurantPriceController@datatable')->name('admin_restaurant_price_datatable');
        Route::get('/dashboard/restaurant/price/create', 'Restaurant\RestaurantPriceController@create')->name('admin_restaurant_price_create');
        Route::post('/dashboard/restaurant/price/store', 'Restaurant\RestaurantPriceController@store')->name('admin_restaurant_price_store');
        Route::get('/dashboard/restaurant/price/show/{id}', 'Restaurant\RestaurantPriceController@show')->name('admin_restaurant_price_show');
        Route::put('/dashboard/restaurant/price/update/{id}', 'Restaurant\RestaurantPriceController@update')->name('admin_restaurant_price_update');
        Route::get('/dashboard/restaurant/price/delete/{id}', 'Restaurant\RestaurantPriceController@destroy')->name('admin_restaurant_price_delete');
    });

    // RESTAURANT CUISINE
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/cuisine', 'Restaurant\RestaurantCuisineController@index')->name('restaurant_cuisine');
        Route::get('/dashboard/restaurant/cuisine/datatable', 'Restaurant\RestaurantCuisineController@datatable')->name('admin_restaurant_cuisine_datatable');
        Route::get('/dashboard/restaurant/cuisine/create', 'Restaurant\RestaurantCuisineController@create')->name('admin_restaurant_cuisine_create');
        Route::post('/dashboard/restaurant/cuisine/store', 'Restaurant\RestaurantCuisineController@store')->name('admin_restaurant_cuisine_store');
        Route::get('/dashboard/restaurant/cuisine/show/{id}', 'Restaurant\RestaurantCuisineController@show')->name('admin_restaurant_cuisine_show');
        Route::put('/dashboard/restaurant/cuisine/update/{id}', 'Restaurant\RestaurantCuisineController@update')->name('admin_restaurant_cuisine_update');
        Route::get('/dashboard/restaurant/cuisine/delete/{id}', 'Restaurant\RestaurantCuisineController@destroy')->name('admin_restaurant_cuisine_delete');
    });

    // RESTAURANT DISHES
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/dishes', 'Restaurant\RestaurantDishesController@index')->name('restaurant_dishes');
        Route::get('/dashboard/restaurant/dishes/datatable', 'Restaurant\RestaurantDishesController@datatable')->name('admin_restaurant_dishes_datatable');
        Route::get('/dashboard/restaurant/dishes/create', 'Restaurant\RestaurantDishesController@create')->name('admin_restaurant_dishes_create');
        Route::post('/dashboard/restaurant/dishes/store', 'Restaurant\RestaurantDishesController@store')->name('admin_restaurant_dishes_store');
        Route::get('/dashboard/restaurant/dishes/show/{id}', 'Restaurant\RestaurantDishesController@show')->name('admin_restaurant_dishes_show');
        Route::put('/dashboard/restaurant/dishes/update/{id}', 'Restaurant\RestaurantDishesController@update')->name('admin_restaurant_dishes_update');
        Route::get('/dashboard/restaurant/dishes/delete/{id}', 'Restaurant\RestaurantDishesController@destroy')->name('admin_restaurant_dishes_delete');
    });

    // RESTAURANT DIETARY FOOD
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/dietary-food', 'Restaurant\RestaurantDietaryFoodController@index')->name('restaurant_dietary_food');
        Route::get('/dashboard/restaurant/dietary-food/datatable', 'Restaurant\RestaurantDietaryFoodController@datatable')->name('admin_restaurant_dietary_food_datatable');
        Route::get('/dashboard/restaurant/dietary-food/create', 'Restaurant\RestaurantDietaryFoodController@create')->name('admin_restaurant_dietary_food_create');
        Route::post('/dashboard/restaurant/dietary-food/store', 'Restaurant\RestaurantDietaryFoodController@store')->name('admin_restaurant_dietary_food_store');
        Route::get('/dashboard/restaurant/dietary-food/show/{id}', 'Restaurant\RestaurantDietaryFoodController@show')->name('admin_restaurant_dietary_food_show');
        Route::put('/dashboard/restaurant/dietary-food/update/{id}', 'Restaurant\RestaurantDietaryFoodController@update')->name('admin_restaurant_dietary_food_update');
        Route::get('/dashboard/restaurant/dietary-food/delete/{id}', 'Restaurant\RestaurantDietaryFoodController@destroy')->name('admin_restaurant_dietary_food_delete');
    });


    // RESTAURANT GOOD FOR
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/restaurant/goodfor', 'Restaurant\RestaurantGoodforController@index')->name('restaurant_goodfor');
        Route::get('/dashboard/restaurant/goodfor/datatable', 'Restaurant\RestaurantGoodforController@datatable')->name('admin_restaurant_goodfor_datatable');
        Route::get('/dashboard/restaurant/goodfor/create', 'Restaurant\RestaurantGoodforController@create')->name('admin_restaurant_goodfor_create');
        Route::post('/dashboard/restaurant/goodfor/store', 'Restaurant\RestaurantGoodforController@store')->name('admin_restaurant_goodfor_store');
        Route::get('/dashboard/restaurant/goodfor/show/{id}', 'Restaurant\RestaurantGoodforController@show')->name('admin_restaurant_goodfor_show');
        Route::put('/dashboard/restaurant/goodfor/update/{id}', 'Restaurant\RestaurantGoodforController@update')->name('admin_restaurant_goodfor_update');
        Route::get('/dashboard/restaurant/goodfor/delete/{id}', 'Restaurant\RestaurantGoodforController@destroy')->name('admin_restaurant_goodfor_delete');
    });

    // RESTAURANT REVIEW
    Route::post('/restaurant/review/store', 'Restaurant\RestaurantReviewController@store')->name('restaurant_review_store');
    Route::post('/restaurant/review/delete', 'Restaurant\RestaurantReviewController@destroy')->name('restaurant_review_delete');

    //RESTAURANT DETAIL
    Route::get('/restaurant/{id}', 'Restaurant\RestaurantController@index')->name('restaurant');
    Route::get('/restaurant/map/{id}', 'Restaurant\RestaurantListController@restaurant_map')->name('restaurant_map');
    Route::get('/restaurant/menu/{id}', 'Restaurant\RestaurantListController@restaurant_menu')->name('restaurant_menu');
    Route::get('/restaurant/favorit/{id}', 'RestaurantsaveController@favorit')->name('restaurant_favorit');
    Route::get('/restaurant/video/{id}', 'Restaurant\RestaurantListController@restaurant_video')->name('restaurant_video');
    Route::get('/restaurant/story/{id}', 'Restaurant\RestaurantListController@restaurant_story')->name('restaurant_story');
    // Route::get('/story/next/{id}/{id_villa}', 'ViewController@story_next')->name('story_next');

    // things to know restaurant
    Route::post('/houserules-activity/post', 'Activity\ActivityController@activity_update_activity_rules')->name('activity_update_activity_rules');
    Route::post('/guessafety-activity/post', 'Activity\ActivityController@activity_update_guest_safety')->name('activity_update_guest_safety');


    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::patch('/restaurant/update/name', 'Restaurant\RestaurantListController@restaurant_update_name')->name('restaurant_update_name');
        Route::patch('/restaurant/update/contact', 'Restaurant\RestaurantListController@restaurant_update_contact')->name('restaurant_update_contact');
        Route::post('/restaurant/update/location', 'Restaurant\RestaurantListController@restaurant_update_location')->name('restaurant_update_location');
        Route::patch('/restaurant/update/short-description', 'Restaurant\RestaurantListController@restaurant_update_short_description')->name('restaurant_update_short_description');
        Route::patch('/restaurant/update/description', 'Restaurant\RestaurantListController@restaurant_update_description')->name('restaurant_update_description');
        Route::patch('/restaurant/update/time', 'Restaurant\RestaurantListController@restaurant_update_time')->name('restaurant_update_time');
        Route::patch('/restaurant/update/type', 'Restaurant\RestaurantListController@restaurant_update_type')->name('restaurant_update_type');
        Route::patch('/restaurant/{id}/update/cancel-request-update-status', 'Restaurant\RestaurantController@cancel_request_update_status')->name('restaurant_cancel_request_update_status');
        // Route::post('/restaurant/update/story', 'ViewController@villa_update_story')->name('villa_update_story');
        Route::post('/restaurant/photo/store', 'Restaurant\RestaurantListController@restaurant_store_photo')->name('restaurant_store_photo');
        Route::post('/restaurant/menu/store', 'Restaurant\RestaurantListController@restaurant_store_menu')->name('restaurant_store_menu');
        Route::post('/restaurant/menu/store_multi', 'Restaurant\RestaurantListController@restaurant_store_menu_multi')->name('restaurant_store_menu_multi');
        Route::post('/restaurant/story/store', 'Restaurant\RestaurantListController@restaurant_store_story')->name('restaurant_store_story');
        Route::post('/restaurant/facilities/store', 'Restaurant\RestaurantListController@restaurant_store_facilities')->name('restaurant_store_facilities');
        Route::post('/restaurant/photo/caption/update', 'Restaurant\RestaurantListController@restaurant_update_caption_photo')->name('restaurant_update_caption_photo');
        Route::patch('/restaurant/update/image', 'Restaurant\RestaurantListController@restaurant_update_image')->name('restaurant_update_image');
        Route::post('/restaurant/store/tag', 'Restaurant\RestaurantListController@restaurant_store_tag')->name('restaurant_store_tag');
        Route::get('/restaurant/{id}/delete/story/{id_story}', 'Restaurant\RestaurantListController@restaurant_delete_story')->name('restaurant_delete_story');
        Route::get('/restaurant/{id}/delete/image', 'Restaurant\RestaurantListController@restaurant_delete_image')->name('restaurant_delete_image');
        Route::get('/restaurant/{id}/delete/photo/video/{id_video}', 'Restaurant\RestaurantListController@restaurant_delete_photo_video')->name('restaurant_delete_photo_video');
        Route::get('/restaurant/{id}/delete/photo/photo/{id_photo}', 'Restaurant\RestaurantListController@restaurant_delete_photo_photo')->name('restaurant_delete_photo_photo');
        Route::get('/restaurant/{id}/delete/menu/{id_menu}', 'Restaurant\RestaurantListController@restaurant_delete_menu')->name('restaurant_delete_menu');
    });

    //-- ACTIVITY ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        // Route::get('/admin/things-to-do', 'ActivityController@index')->name('admin_activity');
        // Route::get('/admin/things-to-do/datatable', 'ActivityController@datatable')->name('admin_activity_datatable');
        Route::get('/dashboard/things-to-do', 'ActivityController@index')->name('admin_activity');
        Route::get('/dashboard/things-to-do/datatable', 'ActivityController@datatable')->name('admin_activity_datatable');

        Route::get('/dashboard/things-to-do/soft-delete/{id}', 'ActivityListingController@softDestroy')->name('admin_activity_soft_delete');
        Route::get('/dashboard/things-to-do/restore-delete/{id}', 'ActivityListingController@restoreDestroy')->name('admin_activity_restore_delete');

        Route::get('/dashboard/things-to-do/trash', 'ActivityController@trash')->name('admin_activity_trash');
        Route::get('/dashboard/things-to-do/datatabletrash', 'ActivityController@datatableTrash')->name('admin_activity_datatableTrash');
    });

    //---- ACTIVITY PRICE ---
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/things-to-do/index_price/{id}', 'ActivityController@index_price')->name('admin_activity_index_price');
        Route::get('/admin/things-to-do/datatable_price/{id}', 'ActivityController@datatable_price')->name('admin_activity_datatable_price');
        Route::get('/admin/things-to-do/create_price/{id}', 'ActivityController@create_price')->name('admin_activity_create_price');
        Route::post('/admin/things-to-do/store_price', 'ActivityController@store_price')->name('admin_activity_store_price');
        Route::get('/admin/things-to-do/delete_price/{id}', 'ActivityController@destroy_price')->name('admin_activity_delete_price');
    });

    //--ACTIVITY GALLERY --
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/admin/things-to-do/create_gallery/{id}', 'ActivityController@create_gallery')->name('admin_activity_create_gallery');
        Route::post('/admin/things-to-do/store_gallery', 'ActivityController@store_gallery')->name('admin_activity_store_gallery');
        Route::get('/admin/things-to-do/delete_gallery/{id}', 'ActivityController@destroy_gallery')->name('admin_activity_delete_gallery');
        Route::get('/admin/things-to-do/delete_video/{id}', 'ActivityController@destroy_video')->name('admin_activity_delete_video');
    });

    // ACTIVITY FACILITIES
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/things-to-do/facilities', 'Activity\ActivityFacilitiesController@index')->name('activity_facilities');
        Route::get('/dashboard/things-to-do/facilities/datatable', 'Activity\ActivityFacilitiesController@datatable')->name('admin_activity_facilities_datatable');
        Route::get('/dashboard/things-to-do/facilities/create', 'Activity\ActivityFacilitiesController@create')->name('admin_activity_facilities_create');
        Route::post('/dashboard/things-to-do/facilities/store', 'Activity\ActivityFacilitiesController@store')->name('admin_activity_facilities_store');
        Route::get('/dashboard/things-to-do/facilities/show/{id}', 'Activity\ActivityFacilitiesController@show')->name('admin_activity_facilities_show');
        Route::put('/dashboard/things-to-do/facilities/update/{id}', 'Activity\ActivityFacilitiesController@update')->name('admin_activity_facilities_update');
        Route::get('/dashboard/things-to-do/facilities/delete/{id}', 'Activity\ActivityFacilitiesController@destroy')->name('admin_activity_facilities_delete');
    });

    // ACTIVITY CATEGORY
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/things-to-do/category', 'Activity\ActivityCategoryController@index')->name('activity_category');
        Route::get('/dashboard/things-to-do/category/datatable', 'Activity\ActivityCategoryController@datatable')->name('admin_activity_category_datatable');
        Route::get('/dashboard/things-to-do/category/create', 'Activity\ActivityCategoryController@create')->name('admin_activity_category_create');
        Route::post('/dashboard/things-to-do/category/store', 'Activity\ActivityCategoryController@store')->name('admin_activity_category_store');
        Route::get('/dashboard/things-to-do/category/show/{id}', 'Activity\ActivityCategoryController@show')->name('admin_activity_category_show');
        Route::put('/dashboard/things-to-do/category/update/{id}', 'Activity\ActivityCategoryController@update')->name('admin_activity_category_update');
        Route::get('/dashboard/things-to-do/category/delete/{id}', 'Activity\ActivityCategoryController@destroy')->name('admin_activity_category_delete');
    });

    // ACTIVITY SUBCATEGORY
    Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
        Route::get('/dashboard/things-to-do/sub-category', 'Activity\ActivitySubcategoryController@index')->name('activity_subcategory');
        Route::get('/dashboard/things-to-do/sub-category/datatable', 'Activity\ActivitySubcategoryController@datatable')->name('admin_activity_subcategory_datatable');
        Route::get('/dashboard/things-to-do/sub-category/create', 'Activity\ActivitySubcategoryController@create')->name('admin_activity_subcategory_create');
        Route::post('/dashboard/things-to-do/sub-category/store', 'Activity\ActivitySubcategoryController@store')->name('admin_activity_subcategory_store');
        Route::get('/dashboard/things-to-do/sub-category/show/{id}', 'Activity\ActivitySubcategoryController@show')->name('admin_activity_subcategory_show');
        Route::put('/dashboard/things-to-do/sub-category/update/{id}', 'Activity\ActivitySubcategoryController@update')->name('admin_activity_subcategory_update');
        Route::get('/dashboard/things-to-do/sub-category/delete/{id}', 'Activity\ActivitySubcategoryController@destroy')->name('admin_activity_subcategory_delete');
    });

    // ACTIVITY REVIEW
    Route::post('/things-to-do/review/store', 'Activity\ActivityReviewController@store')->name('activity_review_store');
    Route::post('/things-to-do/review/delete', 'Activity\ActivityReviewController@destroy')->name('activity_review_delete');

    //activity detail
    Route::get('/things-to-do/{id}', 'Activity\ActivityController@index')->name('activity');
    Route::post('/things-to-do/grade/{id}', 'Activity\ActivityController@grade')->name('activity_update_grade');

    Route::get('/things-to-do/map/{id}', 'Activity\ActivityListController@activity_map')->name('activity_map');
    // Route::get('/things-to-do/price/{id}', 'Activity\ActivityListController@activity_price')->name('activity_price');
    Route::get('/things-to-do/price/{id}/details', 'Activity\ActivityPriceController@index')->name('activity_price_index');
    Route::get('/things-to-do/favorit/{id}', 'ActivitysaveController@favorit')->name('activity_favorit');
    Route::get('/things-to-do/video/{id}', 'Activity\ActivityListController@activity_video')->name('activity_video');
    Route::get('/things-to-do/story/{id}', 'Activity\ActivityListController@activity_story')->name('activity_story');

    // things to know activity
    Route::post('/houserules-restaurant/post', 'Restaurant\RestaurantController@restaurant_update_house_rules')->name('restaurant_update_restaurant_rules');
    Route::post('/guessafety-restaurant/post', 'Restaurant\RestaurantController@restaurant_update_guest_safety')->name('restaurant_update_guest_safety');
    Route::patch('/things-to-do/price/update/name', 'Activity\ActivityPriceController@activity_update_name')->name('activity_price_update_name');
    Route::patch('/things-to-do/price/update/short-description', 'Activity\ActivityPriceController@activity_update_short_description')->name('activity_price_short_description');
    Route::patch('/things-to-do/price/update/description', 'Activity\ActivityPriceController@activity_update_description')->name('activity_price_description');
    Route::post('/things-to-do/price/photo/store', 'Activity\ActivityPriceController@activity_store_photo')->name('activity_price_store_photo');
    Route::get('/things-to-do/price/{id}/delete/photo/photo/{id_photo}', 'Activity\ActivityPriceController@activity_delete_photo_photo')->name('activity_price_delete_photo_photo');
    Route::get('/things-to-do/price/{id}/delete/photo/video/{id_video}', 'Activity\ActivityPriceController@activity_delete_photo_video')->name('activity_price_delete_photo_video');
    Route::get('/things-to-do/price/{id}/delete/image', 'Activity\ActivityPriceController@activity_delete_image')->name('activity_price_delete_image');
    Route::patch('/things-to-do/price/update/image', 'Activity\ActivityPriceController@activity_update_image')->name('activity_price_update_image');
    Route::post('/things-to-do/price/story/store', 'Activity\ActivityPriceController@activity_store_story')->name('activity_price_store_story');
    Route::get('/things-to-do/price/{id}/delete/story/{id_story}', 'Activity\ActivityPriceController@activity_delete_story')->name('activity_price_delete_story');
    Route::get('/things-to-do/price/story/{id}', 'Activity\ActivityPriceController@activity_story')->name('activity_price_story');
    Route::patch('/things-to-do/update/price', 'Activity\ActivityPriceController@update_price')->name('activity_price_update_price');
    Route::patch('/things-to-do/update/name', 'Activity\ActivityListController@activity_update_name')->name('activity_update_name');
    Route::patch('/things-to-do/update/contact', 'Activity\ActivityListController@activity_update_contact')->name('activity_update_contact');
    Route::post('/things-to-do/update/location', 'Activity\ActivityListController@activity_update_location')->name('activity_update_location');
    Route::patch('/things-to-do/update/short-description', 'Activity\ActivityListController@activity_update_short_description')->name('activity_update_short_description');
    Route::patch('/things-to-do/update/description', 'Activity\ActivityListController@activity_update_description')->name('activity_update_description');
    Route::patch('/things-to-do/update/time', 'Activity\ActivityListController@activity_update_time')->name('activity_update_time');
    Route::post('/things-to-do/update/photo/position', 'Activity\ActivityListController@activity_update_position_photo')->name('activity_update_photo_photo_position');
    Route::post('/things-to-do/update/video/position', 'Activity\ActivityListController@activity_update_position_video')->name('activity_update_photo_video_position');
    Route::post('/things-to-do/photo/store', 'Activity\ActivityListController@activity_store_photo')->name('activity_store_photo');
    Route::post('/things-to-do/price/store', 'Activity\ActivityListController@activity_store_price')->name('activity_store_price');
    Route::post('/things-to-do/story/store', 'Activity\ActivityListController@activity_store_story')->name('activity_store_story');
    Route::post('/things-to-do/facilities/store', 'Activity\ActivityListController@activity_store_facilities')->name('activity_store_facilities');
    Route::patch('/things-to-do/update/image', 'Activity\ActivityListController@activity_update_image')->name('activity_update_image');
    Route::patch('/things-to-do/{id}/update/cancel-request-update-status', 'Activity\ActivityController@cancel_request_update_status')->name('activity_cancel_request_update_status');
    Route::get('/things-to-do/{id}/delete/story/{id_story}', 'Activity\ActivityListController@activity_delete_story')->name('activity_delete_story');
    Route::get('/things-to-do/{id}/delete/image', 'Activity\ActivityListController@activity_delete_image')->name('activity_delete_image');
    Route::get('/things-to-do/{id}/delete/photo/video/{id_video}', 'Activity\ActivityListController@activity_delete_photo_video')->name('activity_delete_photo_video');
    Route::get('/things-to-do/{id}/delete/photo/photo/{id_photo}', 'Activity\ActivityListController@activity_delete_photo_photo')->name('activity_delete_photo_photo');
    Route::get('/things-to-do/{id}/delete/price/{id_price}', 'Activity\ActivityListController@activity_delete_price')->name('activity_delete_price');
    Route::post('/things-to-do/subcategory/store', 'Activity\ActivityListController@activity_store_subcategory')->name('activity_store_subcategory');
    Route::post('/things-to-do/photo/caption/update', 'Activity\ActivityListController@activity_update_caption_photo')->name('activity_update_caption_photo');

    // other
    Route::get('/villa-video', 'ViewController@list_video')->name('list_video');
    Route::get('/villa-video-list/{id}', 'ViewController@villa_list_video')->name('list-villa_video_open');

    Route::get('/pool_filter/{id}', 'ViewController@get_table')->name('refresh_table');

    // HOTEL
    // Route::post('/hotel-list', 'HotelController@hotel_list')->name('hotel_list');

    Route::post('/admin/hotel/store', 'Hotel\HotelListingController@store')->name('admin_hotel_store');

    Route::get('/admin/hotel/update-status/{id}', 'Hotel\HotelListingController@status')->name('admin_hotel_update_status');
    Route::patch('/hotel/{id}/update/cancel-request-update-status', 'Hotel\HotelListingController@cancel_request_update_status')->name('hotel_cancel_request_update_status');

    Route::post('/hotel/grade/{id}', 'Hotel\HotelDetailController@grade')->name('hotel_update_grade');

    Route::get('/hotel/map/{id}', 'Hotel\HotelDetailController@hotel_map')->name('hotel_map');
    Route::get('/hotel/details/{id}', 'Hotel\HotelDetailController@hotel_details')->name('hotel_details');
    Route::get('/hotel/villa-nearby/{id}', 'Hotel\HotelDetailController@villa_nearby_hotel')->name('villa_nearby_hotel');
    Route::get('/hotel/things-to-do-nearby/{id}', 'Hotel\HotelDetailController@activity_nearby_hotel')->name('activity_nearby_hotel');
    Route::get('/hotel/restaurant-nearby/{id}', 'Hotel\HotelDetailController@restaurant_nearby_hotel')->name('restaurant_nearby_hotel');
    Route::get('/hotel/{id}', 'Hotel\HotelDetailController@hotel')->name('hotel');
    Route::get('/hotel/story/{id}', 'Hotel\HotelDetailController@story')->name('hotel_story');
    Route::get('/hotel/video/open/{id}', 'Hotel\HotelDetailController@video_open')->name('video_open');
    Route::post('/hotel/add-room', 'Hotel\HotelDetailController@store_room')->name('store_room');

    //Hotel Reservations Dashboard
    Route::get('/dashboard/hotel/reservations/upcoming', 'Hotel\HotelRoomBookingController@index')->name('hotel_room_reservations_dashboard');
    Route::get('/dashboard/hotel/reservations/upcoming/datatable', 'Hotel\HotelRoomBookingController@datatableUpcoming')->name('hotel_room_reservations_datatable');

    Route::get('/dashboard/hotel/reservations/all', 'Hotel\HotelRoomBookingController@all')->name('hotel_reservations_all');
    Route::get('/dashboard/hotel/reservations/all/datatable', 'Hotel\HotelRoomBookingController@datatableAll')->name('hotel_reservations_datatable_all');

    //Hotel FullCalendar
    Route::get('hotel/room/special-price/calendar/{id}', 'Hotel\RoomDetailController@special_price_fullcalendar')->name('hotel_special_price_fullcalendar');
    Route::get('hotel/room/calendar/not_available/{id}', 'Hotel\RoomDetailController@fullcalendar_notavailable')->name('hotel_room_fullcalendar_notavailable');

    //edit from detail frontend
    Route::get('/hotel/favorit/{id}', 'HotelSaveController@favorit')->name('hotel_favorit');
    Route::post('/hotel/update/image', 'Hotel\HotelDetailController@hotel_update_image')->name('hotel_update_image');
    Route::get('/hotel/{id}/delete/image', 'Hotel\HotelDetailController@hotel_delete_image')->name('hotel_delete_image');
    Route::post('/hotel/update/bedroom', 'Hotel\HotelDetailController@hotel_update_bedroom')->name('hotel_update_bedroom');
    Route::post('/hotel/update/short-description', 'Hotel\HotelDetailController@hotel_update_short_description')->name('hotel_update_short_description');
    Route::post('/hotel/update/story', 'Hotel\HotelDetailController@hotel_update_story')->name('hotel_update_story');
    Route::get('/hotel/{id}/delete/story/{id_story}', 'Hotel\HotelDetailController@hotel_delete_story')->name('hotel_delete_story');
    Route::post('/hotel/update/description', 'Hotel\HotelDetailController@hotel_update_description')->name('hotel_update_description');
    Route::post('/hotel/update/amenities', 'Hotel\HotelDetailController@hotel_update_amenities')->name('hotel_update_amenities');
    Route::post('/hotel/update/location', 'Hotel\HotelDetailController@hotel_update_location')->name('hotel_update_location');
    Route::post('/hotel/update/name', 'Hotel\HotelDetailController@hotel_update_name')->name('hotel_update_name');
    Route::post('/hotel/photo/caption/update', 'Hotel\HotelDetailController@hotel_update_caption_photo')->name('hotel_update_caption_photo');


    //HOTEL GALLERY
    Route::post('/admin/hotel/store_gallery', 'HotelController@store_gallery')->name('admin_hotel_store_gallery');
    Route::get('/hotel/{id}/delete/photo/photo/{id_photo}', 'HotelController@hotel_delete_photo_photo')->name('hotel_delete_photo_photo');
    Route::get('/hotel/{id}/delete/photo/video/{id_video}', 'HotelController@hotel_delete_photo_video')->name('hotel_delete_photo_video');
    Route::post('/hotel/update/photo/position', 'Hotel\HotelDetailController@update_position_photo')->name('hotel_photo_edit_position');
    Route::post('/hotel/update/video/position', 'Hotel\HotelDetailController@update_position_video')->name('hotel_video_edit_position');


    //Hotel ROOM Booking
    Route::post('/hotel/room/confirm/', 'Hotel\HotelRoomBookingController@confirm')->name('hotel_room_booking_confirm');
    Route::post('/hotel/room/confirm/store', 'Hotel\HotelRoomBookingController@booking_store')->name('hotel_room_booking_store');


    //HOTEL ROOM
    Route::get('/hotel/room/{id}', 'Hotel\RoomDetailController@room_hotel')->name('room_hotel');
    Route::get('/hotel/room/story/{id}', 'Hotel\RoomDetailController@story')->name('room_story');
    Route::get('/hotel/room/{id}/delete/story/{id_story}', 'Hotel\RoomDetailController@room_delete_story')->name('room_delete_story');
    Route::get('/hotel/room/video/open/{id}', 'Hotel\RoomDetailController@video_open')->name('room_video_open');
    Route::post('/hotel/room/update/name', 'Hotel\RoomDetailController@room_update_name')->name('room_update_name');

    Route::post('/hotel/room/update/image', 'Hotel\RoomDetailController@room_update_image')->name('room_update_image');
    Route::get('/hotel/room/{id}/delete/image', 'Hotel\RoomDetailController@room_delete_image')->name('room_delete_image');
    Route::post('/hotel/room/update/short-description', 'Hotel\RoomDetailController@room_update_short_description')->name('room_update_short_description');
    Route::post('/hotel/room/update/description', 'Hotel\RoomDetailController@room_update_description')->name('room_update_description');
    Route::post('/hotel/room/update/story', 'Hotel\RoomDetailController@room_update_story')->name('room_update_story');
    Route::post('/hotel/room/update/price', 'Hotel\RoomDetailController@room_update_price')->name('room_update_price');
    Route::post('/hotel/room/update/room_size', 'Hotel\RoomDetailController@update_room_size')->name('update_room_size');
    Route::post('/hotel/room/update/amenities', 'Hotel\RoomDetailController@room_update_amenities')->name('room_update_amenities');
    Route::post('/hotel/room/photo/caption/update', 'Hotel\RoomDetailController@room_update_caption_photo')->name('room_update_caption_photo');

    //GET DISABLE DATE ROOM HOTEL
    Route::get('/hotel/room/date_disabled/{id}', 'Hotel\HotelRoomBookingController@disabled')->name('room_disable_date');
    Route::post('/hotel/room/update/not_available', 'Hotel\RoomDetailController@room_not_available')->name('room_not_available');
    Route::get('/hotel/room/get_total/{id}', 'Hotel\HotelRoomBookingController@get_total')->name('get_total');


    //HOTEL ROOM GALLERY
    Route::post('/admin/hotel/room/store_gallery', 'Hotel\RoomDetailController@store_gallery')->name('admin_hotel_room_store_gallery');
    Route::get('/hotel/room/{id}/delete/photo/photo/{id_photo}', 'Hotel\RoomDetailController@room_delete_photo_photo')->name('room_delete_photo_photo');
    Route::get('/hotel/room/{id}/delete/photo/video/{id_video}', 'Hotel\RoomDetailController@room_delete_photo_video')->name('room_delete_photo_video');
    Route::post('/hotel/room/update/photo/position', 'Hotel\RoomDetailController@update_position_photo')->name('room_photo_edit_position');
    Route::post('/hotel/room/update/video/position', 'Hotel\RoomDetailController@update_position_video')->name('room_video_edit_position');


    //COLABORATOR
    Route::get('/collaborator-list', 'Collaborator\CollaboratorController@collaborator_list')->name('collaborator_list');
    Route::get('/collaborator/{id}', 'Collaborator\CollaboratorController@collaborator')->name('collaborator');
    Route::post('/collaborator/update/image', 'Collaborator\CollaboratorController@collab_update_image')->name('collab_update_image');
    Route::post('/colaborator/update/name', 'Collaborator\CollaboratorController@collab_update_name')->name('collab_update_name');
    Route::post('/colaborator/store/category', 'Collaborator\CollaboratorController@collab_store_category')->name('collab_store_category');
    Route::post('/colaborator/update/location', 'Collaborator\CollaboratorController@collab_update_location')->name('collab_update_location');
    Route::get('/collab/story/{id}', 'Collaborator\CollaboratorController@collab_story')->name('collab_story');
    Route::post('/collab/update/story', 'Collaborator\CollaboratorController@update_story')->name('collab_update_story');
    Route::get('/collab/{id}/delete/story/{id_story}', 'Collaborator\CollaboratorController@delete_story')->name('collab_delete_story');
    Route::get('/collab/{id}/delete/photo/photo/{id_photo}', 'Collaborator\CollaboratorController@collab_delete_photo_photo')->name('collab_delete_photo_photo');
    Route::get('/collab/{id}/delete/photo/video/{id_video}', 'Collaborator\CollaboratorController@collab_delete_photo_video')->name('collab_delete_photo_video');
    Route::post('/collab/update/description', 'Collaborator\CollaboratorController@update_description')->name('collab_update_description');
    Route::post('/collab/update/language', 'Collaborator\CollaboratorController@update_language')->name('collab_update_language');

    Route::post('/collaborator/update/photo', 'Collaborator\CollaboratorController@collab_update_photo')->name('collab_update_photo');
    Route::get('/collaborator/video/open/{id}', 'Collaborator\CollaboratorController@video_open')->name('video_open');

    // User Profile
    Route::get('/user-profile', 'ProfileController@index')->name('profile_index');
    Route::get('/user-profile/hotels', 'ProfileController@hotels')->name('profile_hotels');
    Route::get('/user-profile/restaurants', 'ProfileController@restaurants')->name('profile_restaurants');
    Route::get('/user-profile/activities', 'ProfileController@activities')->name('profile_activities');

    Route::get('/user-profile-backup', 'ProfileController@index_backup')->name('profile_index2');
    Route::post('/user-profile/{id}', 'ProfileController@update')->name('profile_update');
    Route::get('/reward-program', 'ProfileController@reward_program')->name('reward_program');
    Route::get('/change-password', 'ChangePasswordController@index')->name('change_password');


    //reward system
    Route::get('/user/reward', 'UserRewardController@reward_count')->name('count_reward');

    // map
    Route::get('/map/by-coordinate-area/restaurant', 'Map\LocationByCoordinateAreaController@restaurant')->name('map_restaurant_location');
    Route::get('/map/by-coordinate-area/restaurant/{id}', 'Map\LocationByCoordinateAreaController@search_restaurant')->name('map_restaurant_location_search');
    Route::get('/map/by-coordinate-area/villa', 'Map\LocationByCoordinateAreaController@villa')->name('map_villa_location');
    Route::get('/map/by-coordinate-area/villa/{id}', 'Map\LocationByCoordinateAreaController@search_villa')->name('map_villa_location_search');
    Route::get('/map/by-coordinate-area/hotel', 'Map\LocationByCoordinateAreaController@hotel')->name('map_hotel_location');
    Route::get('/map/by-coordinate-area/hotel/{id}', 'Map\LocationByCoordinateAreaController@search_hotel')->name('map_hotel_location_search');
    Route::get('/map/by-coordinate-area/activity', 'Map\LocationByCoordinateAreaController@activity')->name('map_activity_location');
    Route::get('/map/by-coordinate-area/activity/{id}', 'Map\LocationByCoordinateAreaController@search_activity')->name('map_activity_location_search');

    //clear
    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('config:cache');
        return "OK";
        // return what you want
    });

    Route::get('/clear-view', function () {
        $exitCode = Artisan::call('view:clear');
        return "OK";
        // return what you want
    });

    Route::get('/clear-route', function () {
        $exitCode = Artisan::call('route:clear');
        return "OK";
        // return what you want
    });
