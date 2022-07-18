<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hotel as Hotel;
use App\Http\Controllers\Owner as Owner;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SafetyController;
use App\Http\Controllers\BedroomController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OutdoorController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BathroomController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilterBoxController;
use App\Http\Controllers\HotelSaveController;
use App\Http\Controllers\NobedroomController;
use App\Http\Controllers\VillasaveController;
use App\Http\Controllers\VillatypeController;
use App\Http\Controllers\Activity as Activity;
use App\Http\Controllers\MoreFilterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SearchHomeController;
use App\Http\Controllers\SortFilterController;
use App\Http\Controllers\TaxSettingController;
use App\Http\Controllers\UserRewardController;
use App\Http\Controllers\MenuListingController;
use App\Http\Controllers\PriceFilterController;
use App\Http\Controllers\ReservationsDashboard;
use App\Http\Controllers\VillaReviewController;
use App\Http\Controllers\ActivitysaveController;
use App\Http\Controllers\Dashboard as Dashboard;
use App\Http\Controllers\VillabookingController;
use App\Http\Controllers\VillaListingController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Restaurant as Restaurant;
use App\Http\Controllers\RestaurantsaveController;
use App\Http\Controllers\RestaurantTypeController;
use App\Http\Controllers\RewardCategoryController;
use App\Http\Controllers\ActivityListingController;
use App\Http\Controllers\InsightDashboardController;
use App\Http\Controllers\MenuReservationsController;
use App\Http\Controllers\VillaContactHostController;
use App\Http\Controllers\PropertyTypeVillaController;
use App\Http\Controllers\RestaurantListingController;
use App\Http\Controllers\UserRewardBalanceController;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\Collaborator as Collaborator;
use App\Http\Controllers\Map as Map;
use App\Http\Controllers\Translate as Translate;
use App\Http\Controllers\StaffRewardBalanceController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\Auth\RegisterCollabController;
use App\Http\Controllers\Auth\RegisterPartnerController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/index/get_lat_long/', [HomeController::class, 'get_lat_long'])->name('get_lat_long');


Route::post('/language/set', [LanguageController::class, 'set_language'])->name('language_set');
Route::post('/currency/set', [LanguageController::class, 'set_currency'])->name('currency_set');

Route::get('/autocomplete', [ViewController::class, 'get_location_ajax'])->name('autocomplete');

Route::get('/privacy-policy', function () {
    return view('user.privacy_policy');
})->name('privacy_policy');

Route::get('/terms', function () {
    return view('user.terms');
})->name('terms');

Route::get('/license', function () {
    return view('user.license');
})->name('license');

// partner auth
Route::get('/register/partner', [RegisterPartnerController::class, 'showRegistrationForm'])->name('register.partner');
Route::post('/register/partner', [RegisterPartnerController::class, 'register'])->name('register.partner.store');

// collabolator auth
Route::get('/register/collabs', [RegisterCollabController::class, 'showRegistrationForm'])->name('register.collab');
Route::post('/register/collabs', [RegisterCollabController::class, 'register'])->name('register.collab.store');

// GOOGLE SIGN IN
// Route::get('sign-in-google')
// Route::get('/google', 'SocialAuthGoogleController@redirect')->name('login_google');
// Route::get('/google/callback', 'SocialAuthGoogleController@callback');

// Socialite routes
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/facebook', [UserController::class, 'facebook'])->name('user.login.facebook');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
Route::get('auth/facebook/callback', [UserController::class, 'handleProviderCallbackFacebook'])->name('user.facebook.callback');
Route::get('/login-google', [UserController::class, 'login'])->middleware('guest')->name('login-google');

//curency
Route::get('/get-currency', [CurrencyController::class, 'get'])->name('get_currency');
Route::get('/update-currency', [CurrencyController::class, 'sync'])->name('update_currency');
Route::get('/get-language', [CurrencyController::class, 'language'])->name('get_language');

// Route::get('/home', 'HomeController@index')->name('home');

//----- PERMISSION -----
Route::middleware(['auth'])->group(function () {
    Route::get('/like/villa/{id}', [ViewController::class, 'like_favorit'])->name('like_favorit');
    Route::get('/like/restaurant/{id}', [Restaurant\RestaurantController::class, 'like_restaurant'])->name('like_restaurant');
    Route::get('/like/hotel/{id}', [HotelController::class, 'like_hotel'])->name('like_hotel');
    Route::get('/like/things-to-do/{id}', [Activity\ActivityListController::class, 'like_things_to_do'])->name('like_things_to_do');

    Route::get('/dashboard/permission', [PermissionController::class, 'index'])->name('admin_permission');
    Route::get('/dashboard/permission/datatable', [PermissionController::class, 'datatable'])->name('admin_permission_datatable');
    Route::get('/dashboard/permission/create', [PermissionController::class, 'create'])->name('admin_permission_create');
    Route::post('/dashboard/permission/store', [PermissionController::class, 'store'])->name('admin_permission_store');
    Route::get('/dashboard/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('admin_permission_delete');
    Route::get('/dashboard/role', [PermissionController::class, 'role'])->name('admin_permission_role_index');
    Route::get('dashboard/role/datatable', [PermissionController::class, 'role_datatable'])->name('admin_permission_role_datatable');
    Route::get('/dashboard/role_permission/{id}', [PermissionController::class, 'role_permission'])->name('admin_role_permission');
    Route::post('/dashboard/role_permission/store', [PermissionController::class, 'role_permission_store'])->name('admin_role_permission_store');
    Route::patch('/account-settings/login-security', [Dashboard\AccountSettingController::class, 'update_password'])->name('password_update');
});

/* --- DASHBOARD ADMIN ---*/
// Route::get('/admin/dashboard', 'DashboardController@index')->name('admin_dashboard')->middleware(['auth', 'allowedRolesToAccessBackend']);
// Route::get('/dashboard', 'DashboardController@index')->name('admin_dashboard')->middleware(['auth', 'allowedRolesToAccessBackend']);

//--- USER ----
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('admin_user');
    Route::get('/dashboard/user/trash', [UserController::class, 'trash'])->name('admin_user_trash');
    Route::get('/dashboard/user/datatable', [UserController::class, 'datatable'])->name('admin_user_datatable');
    Route::get('/dashboard/user/datatabletrash', [UserController::class, 'datatableTrash'])->name('admin_user_datatableTrash');
    Route::get('/dashboard/user/create', [UserController::class, 'create'])->name('admin_user_create');
    Route::post('/dashboard/user/store', [UserController::class, 'store'])->name('admin_user_store');
    Route::get('/dashboard/user/show/{id}', [UserController::class, 'show'])->name('admin_user_show');
    Route::put('/dashboard/user/update/{id}', [UserController::class, 'update'])->name('admin_user_update');
    Route::get('/dashboard/user/soft-delete/{id}', [UserController::class, 'softDestroy'])->name('admin_user_soft_delete');
    Route::get('/dashboard/user/restore-delete/{id}', [UserController::class, 'restoreDestroy'])->name('admin_user_restore_delete');
    Route::get('/dashboard/user/delete/{id}', [UserController::class, 'destroy'])->name('admin_user_delete');
});

Route::get('/dashboard-switch', [PartnerController::class, 'switch'])->name('switch')->middleware('auth');

// PARTNER
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('admin_dashboard');
    Route::get('/dashboard', [PartnerController::class, 'index'])->name('partner_dashboard');
    //dummy your reservations in dashboard partner
    Route::get('dashboard/arriving_soon', [PartnerController::class, 'index2'])->name('partner_dashboard2');
    Route::get('dashboard/checkout', [PartnerController::class, 'index3'])->name('partner_dashboard3');
    Route::get('dashboard/upcoming', [PartnerController::class, 'index4'])->name('partner_dashboard4');

    Route::get('/dashboard/reservations_datatables1', [ReservationsDashboard::class, 'datatables1'])->name('reservations_dashboard_datatables1');
    Route::get('/dashboard/reservations_datatables2', [ReservationsDashboard::class, 'datatables2'])->name('reservations_dashboard_datatables2');
    Route::get('/dashboard/reservations_datatables3', [ReservationsDashboard::class, 'datatables3'])->name('reservations_dashboard_datatables3');
    Route::get('/dashboard/reservations_datatables4', [ReservationsDashboard::class, 'datatables4'])->name('reservations_dashboard_datatables4');
    //end dummy route your reservations in dashboard partner

    //route account setting partner dashboard
    Route::get('/profile', [Dashboard\ProfileController::class, 'profile_index'])->name('profile_user');
    Route::post('/profile', [Dashboard\ProfileController::class, 'storeProfile'])->name('store_profile');
    Route::get('/users/edit-photo', [Dashboard\ProfileController::class, 'upload_foto'])->name('upload_foto_index');
    Route::post('/users/edit-photo/upload', [Dashboard\ProfileController::class, 'store_foto'])->name('store_foto_profile');
    Route::get('/account-settings', [Dashboard\AccountSettingController::class, 'index'])->name('account_setting');
    Route::get('/account-settings/personal-info', [Dashboard\AccountSettingController::class, 'personalInfo'])->name('personal_info');
    Route::get('/account-settings/personal-info/add-government-id', [Dashboard\AddGovernmentController::class, 'add_government'])->name('add_government');
    Route::post('/account-settings/personal-info/add-government-id', [Dashboard\AddGovernmentController::class, 'store_step_one']);
    Route::get('/account-settings/personal-info/add-government-id/step-two', [Dashboard\AddGovernmentController::class, 'step_two_index'])->name('add_government.step_two');
    Route::post('/account-settings/personal-info/add-government-id/step-two', [Dashboard\AddGovernmentController::class, 'store_step_two']);
    Route::get('/account-settings/personal-info/add-government-id/step-three', [Dashboard\AddGovernmentController::class, 'step_three_index'])->name('add_government.step_three');
    Route::post('/account-settings/personal-info/add-government-id/step-three', [Dashboard\AddGovernmentController::class, 'store_step_three']);

    Route::get('/account-settings/login-security', [Dashboard\AccountSettingController::class, 'login_security'])->name('login_security');
    Route::get('/account-settings/notification', [Dashboard\AccountSettingController::class, 'notification'])->name('notification_setting');
    Route::get('/account-settings/notification_account', [Dashboard\NotificationController::class, 'notification_account'])->name('notification_account');
    Route::post('/account-settings/notification1', [Dashboard\NotificationController::class, 'recognition_achievements'])->name('recognition-achievements');
    Route::post('/account-settings/notification2', [Dashboard\NotificationController::class, 'insights_tips'])->name('insights-tips');
    Route::post('/account-settings/notification3', [Dashboard\NotificationController::class, 'pricing_trends_suggestions'])->name('pricing-trends-suggestions');
    Route::post('/account-settings/notification4', [Dashboard\NotificationController::class, 'hosting_perks'])->name('hosting-perks');
    Route::post('/account-settings/notification5', [Dashboard\NotificationController::class, 'news_updates'])->name('news-updates');
    Route::post('/account-settings/notification6', [Dashboard\NotificationController::class, 'local_laws_regulations'])->name('local-laws-regulations');
    Route::post('/account-settings/notification7', [Dashboard\NotificationController::class, 'inspiration_offers'])->name('inspiration-offers');
    Route::post('/account-settings/notification8', [Dashboard\NotificationController::class, 'trip_planning'])->name('trip-planning');
    Route::post('/account-settings/notification9', [Dashboard\NotificationController::class, 'news_programs'])->name('news-programs');
    Route::post('/account-settings/notification10', [Dashboard\NotificationController::class, 'feedback'])->name('feedback');
    Route::post('/account-settings/notification11', [Dashboard\NotificationController::class, 'travel_regulations'])->name('travel-regulations');
    Route::post('/account-settings/notification12', [Dashboard\NotificationController::class, 'account_activity'])->name('account-activity');
    Route::post('/account-settings/notification13', [Dashboard\NotificationController::class, 'listing_activity'])->name('listing-activity');
    Route::post('/account-settings/notification14', [Dashboard\NotificationController::class, 'guest_policies'])->name('guest-policies');
    Route::post('/account-settings/notification15', [Dashboard\NotificationController::class, 'host_policies'])->name('host-policies');
    Route::post('/account-settings/notification16', [Dashboard\NotificationController::class, 'reminders'])->name('reminders');
    Route::post('/account-settings/notification17', [Dashboard\NotificationController::class, 'messages'])->name('notification_messages');

    Route::get('/account-settings/payments/payment-methods', [Dashboard\PaymentController::class, 'payments'])->name('payments');
    Route::get('/account-settings/payments/payout-methods', [Dashboard\PaymentController::class, 'payouts'])->name('payouts');
    Route::get('/account-settings/payments/tax-info', [Dashboard\PaymentController::class, 'taxes'])->name('taxes');
    Route::get('/account-settings/payments/guest-contributions', [Dashboard\PaymentController::class, 'guest_contributions'])->name('guest-contributions');

    Route::get('/account-settings/privacy-and-sharing', [Dashboard\PrivacySharingController::class, 'privacy_sharing'])->name('privacy_sharing');

    Route::get('/referral', [Dashboard\ReferralController::class, 'referral_index'])->name('referral_index');
    Route::get('/account-settings/preferences', [Dashboard\AccountSettingController::class, 'preferences'])->name('preferences');
    Route::post('/account-settings/preferences1', [Dashboard\AccountSettingController::class, 'language'])->name('global-language');
    Route::post('/account-settings/preferences2', [Dashboard\AccountSettingController::class, 'currency'])->name('global-currency');
    Route::post('/account-settings/preferences3', [Dashboard\AccountSettingController::class, 'timezone'])->name('global-timezone');
    Route::get('/account-delete', [Dashboard\AccountSettingController::class, 'formDelete'])->name('account-delete-form');
    Route::post('/account-delete', [Dashboard\AccountSettingController::class, 'storeDelete'])->name('account-store-delete');
    Route::post('/account-settings/login-security/google', [Dashboard\AccountSettingController::class, 'disconnectGoogle'])->name('disconnect-google');
    Route::post('/account-settings/login-security/facebook', [Dashboard\AccountSettingController::class, 'disconnectFacebook'])->name('disconnect-facebook');
    Route::post('/account-settings/currency', [Dashboard\AccountSettingController::class, 'change_currency'])->name('change-currency');
    Route::post('/account-settings/language', [Dashboard\AccountSettingController::class, 'change_language'])->name('change-language');

    Route::get('/refer', [Dashboard\ReferHostController::class, 'index'])->name('refer_host');
    Route::get('/refer/datatable', [Dashboard\ReferHostController::class, 'datatable'])->name('refer_datatable');


    Route::get('/help-guest', [Dashboard\HelpController::class, 'help_guest'])->name('help_guest');
    Route::get('/help-host', [Dashboard\HelpController::class, 'help_host'])->name('help_host');
    Route::get('/help-experience-host', [Dashboard\HelpController::class, 'help_experience_host'])->name('help_experience_host');
    Route::get('/help-travel-admin', [Dashboard\HelpController::class, 'help_travel_admin'])->name('help_travel_admin');


    Route::get('/dashboard/listing', [MenuListingController::class, 'index'])->name('listing_dashboard');
    Route::get('/manage-your-space', [MenuListingController::class, 'editListing'])->name('edit_listing_villa_dashboard');

    Route::get('/dashboard/hotel/listing', [Dashboard\HotelListingController::class, 'index'])->name('dashboard_listing_hotel');
    Route::get('/dashboard/hotel/listing/datatable', [Dashboard\HotelListingController::class, 'datatable'])->name('dashboard_listing_hotel_datatable');

    Route::get('/dashboard/government/unapproval', [Dashboard\GovernmentApprovalController::class, 'index'])->name('government_approval_index');
    Route::get('/dashboard/government/approval', [Dashboard\GovernmentApprovalController::class, 'approval_index'])->name('government_list_approval_index');
    Route::get('/dashboard/government/approval/datatable', [Dashboard\GovernmentApprovalController::class, 'datatable'])->name('government_unapproval_datatable');
    Route::get('/dashboard/government/approval/datatableapproval', [Dashboard\GovernmentApprovalController::class, 'datatableapproval'])->name('government_approval_datatable');
    Route::get('/dashboard/government/approve/{id}', [Dashboard\GovernmentApprovalController::class, 'approve'])->name('government_approve');


    Route::get('/dashboard/listing/datatable', [MenuListingController::class, 'datatable'])->name('admin_listing_datatable');
    Route::get('/dashboard/reservations', [MenuReservationsController::class, 'index'])->name('reservations_dashboard');
    Route::get('/dashboard/reservations/completed', [MenuReservationsController::class, 'reservations_completed_index'])->name('reservations_completed_index');
    Route::get('/dashboard/reservations/canceled', [MenuReservationsController::class, 'reservations_canceled_index'])->name('reservations_canceled_index');
    Route::get('/dashboard/reservations/all', [MenuReservationsController::class, 'reservations_all_index'])->name('reservations_all_index');

    Route::get('/dashboard/reservations/datatableUpcoming', [MenuReservationsController::class, 'datatableUpcoming'])->name('reservations_datatable_upcoming');
    Route::get('/dashboard/reservations/datatableCompleted', [MenuReservationsController::class, 'datatableCompleted'])->name('reservations_datatable_completed');
    Route::get('/dashboard/reservations/datatableCanceled', [MenuReservationsController::class, 'datatableCanceled'])->name('reservations_datatable_canceled');

    Route::get('/dashboard/inbox', [InboxController::class, 'index'])->name('partner_inbox');
    Route::get('/dashboard/inbox/datatable', [InboxController::class, 'datatable'])->name('partner_inbox_datatable');
    Route::get('/dashboard/inbox/show/{id}', [InboxController::class, 'show'])->name('partner_inbox_show');
    Route::get('/dashboard/calendar', [CalendarController::class, 'index'])->name('calendar_index');
    Route::get('/dashboard/calendar/all', [CalendarController::class, 'all'])->name('calendar.all');
    Route::get('/dashboard/calendar/villa/{id}', [CalendarController::class, 'filterVilla'])->name('calendar_filter');

    Route::get('/dashboard/calendar/{id}', [CalendarController::class, 'selectVilla'])->name('calendar.select_villa');
    Route::post('/dashboard/calendar/store', [CalendarController::class, 'storeEvent'])->name('calendar_store');
    Route::post('/dashboard/calendar/update', [CalendarController::class, 'updateEvent'])->name('calendar_update');
    Route::get('/dashboard/calendar/delete/{id}', [CalendarController::class, 'destroy'])->name('calendar_destroy');

    //insight
    Route::get('/dashboard/progress/opportunity', [InsightDashboardController::class, 'index'])->name('insight_dashboard');
    Route::get('/dashboard/progress/reviews', [InsightDashboardController::class, 'reviews'])->name('insight_dashboard_reviews');
    Route::get('/dashboard/notifications/owner', [Dashboard\NotificationController::class, 'notification_owner'])->name('notification_owner');

    Route::post('/dashboard/progress/reviews/five_star', [InsightDashboardController::class, 'five_star'])->name('insight_reviews_five_star');
    Route::post('/dashboard/progress/reviews/four_star', [InsightDashboardController::class, 'four_star'])->name('insight_reviews_four_star');
    Route::post('/dashboard/progress/reviews/three_star', [InsightDashboardController::class, 'three_star'])->name('insight_reviews_three_star');
    Route::post('/dashboard/progress/reviews/two_star', [InsightDashboardController::class, 'two_star'])->name('insight_reviews_two_star');
    Route::post('/dashboard/progress/reviews/one_star', [InsightDashboardController::class, 'one_star'])->name('insight_reviews_one_star');


    Route::get('/dashboard/progress/earnings', [Dashboard\EarningsController::class, 'earnings'])->name('insight_dashboard_earnings');
    Route::get('/dashboard/earnings/charts/{id}', [Dashboard\EarningsController::class, 'chart'])->name('chart_earnings');
    Route::get('/dashboard/earnings/{id}', [Dashboard\EarningsController::class, 'getEarnings'])->name('earnings_get_total_earnings');

    Route::get('/dashboard/progress/superhost', [InsightDashboardController::class, 'superhost'])->name('insight_dashboard_superhost');
    Route::get('/dashboard/progress/cleaning', [InsightDashboardController::class, 'cleaning'])->name('insight_dashboard_cleaning');
    Route::get('/dashboard/progress/views', [InsightDashboardController::class, 'views'])->name('insight_dashboard_views');

    Route::get('/users/transaction_history/completed-payouts', [TransactionHistoryController::class, 'completed_payouts'])->name('completed_payouts');
    Route::get('/users/transaction_history/upcoming-payouts', [TransactionHistoryController::class, 'upcoming_payouts'])->name('upcoming_payouts');
    Route::get('/users/transaction_history/gross-earnings', [TransactionHistoryController::class, 'gross_earnings'])->name('gross_earnings');

    Route::get('/manage-guidebook', [ManageGuidebookController::class, 'index'])->name('manage_guidebook');
});

// -- PERSONAL INFO --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::post('/account-settings/personal-info/name', [Dashboard\PersonalController::class, 'updateName'])->name('personal_update_name');
    Route::post('/account-settings/personal-info/gender', [Dashboard\PersonalController::class, 'updateGender'])->name('personal_update_gender');
    Route::post('/account-settings/personal-info/birthday', [Dashboard\PersonalController::class, 'updateBirthday'])->name('personal_update_birthday');
    Route::post('/account-settings/personal-info/email', [Dashboard\PersonalController::class, 'updateEmail'])->name('personal_update_email');
    Route::post('/account-settings/personal-info/phone', [Dashboard\PersonalController::class, 'updatePhone'])->name('personal_update_phone');
    Route::post('/account-settings/personal-info/address', [Dashboard\PersonalController::class, 'updateAddress'])->name('personal_update_address');
});

// -- VILLA ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/villa', [VillaController::class, 'index'])->name('admin_villa');
    // Route::get('/admin/villa/datatable', 'VillaController@datatable')->name('admin_villa_datatable');
    // Route::get('/admin/villa/create', 'VillaController@create')->name('admin_villa_create');
    // Route::post('/admin/villa/store', 'VillaController@store')->name('admin_villa_store');
    // Route::get('/admin/villa/show/{id}', 'VillaController@show')->name('admin_villa_show');
    // Route::put('/admin/villa/update/{id}', 'VillaController@update')->name('admin_villa_update');
    // Route::get('/admin/villa/delete/{id}', 'VillaController@destroy')->name('admin_villa_delete');
    // Route::get('/admin/villa/delete/{id}', 'ListingController@destroy')->name('admin_destroy_listing');

    Route::get('/dashboard/villa', [VillaController::class, 'index'])->name('admin_villa');
    Route::get('/dashboard/villa/datatable', [VillaController::class, 'datatable'])->name('admin_villa_datatable');
    Route::get('/dashboard/villa/soft-delete/{id}', [VillaListingController::class, 'softDestroy'])->name('admin_villa_soft_delete');
    Route::get('/dashboard/villa/restore-delete/{id}', [VillaListingController::class, 'restoreDestroy'])->name('admin_villa_restore_delete');

    Route::get('/dashboard/villa/trash', [VillaController::class, 'trash'])->name('admin_villa_trash');
    Route::get('/dashboard/villa/datatabletrash', [VillaController::class, 'datatableTrash'])->name('admin_villa_datatableTrash');
});

// -- reward program ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/dashboard/reward-category', [RewardCategoryController::class, 'index'])->name('admin_reward_category');
    Route::get('/dashboard/reward-category/datatable', [RewardCategoryController::class, 'datatable'])->name('admin_reward_category_datatable');
    Route::get('/dashboard/reward-category/create', [RewardCategoryController::class, 'create'])->name('admin_reward_category_create');
    Route::post('/dashboard/reward-category/store', [RewardCategoryController::class, 'store'])->name('admin_reward_category_store');
    Route::get('/dashboard/reward-category/show/{id}', [RewardCategoryController::class, 'show'])->name('admin_reward_category_show');
    Route::put('/dashboard/reward-category/update/{id}', [RewardCategoryController::class, 'update'])->name('admin_reward_category_update');
    Route::get('/dashboard/reward-category/delete/{id}', [RewardCategoryController::class, 'destroy'])->name('admin_reward_category_delete');

    Route::get('/dashboard/user-reward', [UserRewardController::class, 'index'])->name('admin_user_reward');
    Route::get('/dashboard/user-reward/datatable', [UserRewardController::class, 'datatable'])->name('admin_user_reward_datatable');
    Route::get('/dashboard/user-reward/create', [UserRewardController::class, 'create'])->name('admin_user_reward_create');
    Route::post('/dashboard/user-reward/store', [UserRewardController::class, 'store'])->name('admin_user_reward_store');
    Route::get('/dashboard/user-reward/show/{id}', [UserRewardController::class, 'show'])->name('admin_user_reward_show');
    Route::put('/dashboard/user-reward/update/{id}', [UserRewardController::class, 'update'])->name('admin_user_reward_update');
    Route::get('/dashboard/user-reward/delete/{id}', [UserRewardController::class, 'destroy'])->name('admin_user_reward_delete');
    Route::get('/dashboard/user-reward/update-status/{id}', [UserRewardController::class, 'update_status'])->name('admin_user_reward_update_status');

    Route::get('/dashboard/user-reward-balance', [UserRewardBalanceController::class, 'index'])->name('admin_user_reward_balance');
    Route::get('/dashboard/user-reward-balance/datatable', [UserRewardBalanceController::class, 'datatable'])->name('admin_user_reward_balance_datatable');

    Route::get('/dashboard/staff-reward-balance', [StaffRewardBalanceController::class, 'index'])->name('admin_staff_reward_balance');
    Route::get('/dashboard/staff-reward-balance/datatable', [StaffRewardBalanceController::class, 'datatable'])->name('admin_staff_reward_balance_datatable');

    Route::get('/dashboard/tax-setting', [TaxSettingController::class, 'index'])->name('admin_tax_setting');
    Route::get('/dashboard/tax-setting/datatable', [TaxSettingController::class, 'datatable'])->name('admin_tax_setting_datatable');
    Route::get('/dashboard/tax-setting/create', [TaxSettingController::class, 'create'])->name('admin_tax_setting_create');
    Route::post('/dashboard/tax-setting/store', [TaxSettingController::class, 'store'])->name('admin_tax_setting_store');
    Route::get('/dashboard/tax-setting/show/{id}', [TaxSettingController::class, 'show'])->name('admin_tax_setting_show');
    Route::put('/dashboard/tax-setting/update/{id}', [TaxSettingController::class, 'update'])->name('admin_tax_setting_update');
    Route::get('/dashboard/tax-setting/delete/{id}', [TaxSettingController::class, 'destroy'])->name('admin_tax_setting_delete');
});


//GET DISABLED DATE
Route::get('/villa/date_disabled/{id}', [VillabookingController::class, 'disabled'])->name('disable_date');
Route::get('/villa/get_total/{id}', [VillabookingController::class, 'get_total'])->name('get_total');

//BECOME HOST LANDING PAGE
Route::get('/admin/becomehost', [ListingController::class, 'becomehost'])->name('ahost');

//-- ADD VILLA --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/villa/add/continue', 'VillaController@add_step_continue')->name('villa_add_step_continue');
    // Route::get('/admin/villa/add/one', 'VillaController@add_step_one')->name('villa_add_step_one');
    // Route::get('/admin/villa/add/one_store', 'VillaController@add_step_one_store')->name('villa_add_step_one_store');
    // Route::get('/admin/villa/add/two', 'VillaController@add_step_two')->name('villa_add_step_two');
    // Route::post('/admin/villa/add/two_store', 'VillaController@add_step_two_store')->name('villa_add_step_two_store');
    // Route::get('/admin/villa/add/three', 'VillaController@add_step_three')->name('villa_add_step_three');
    // Route::post('/admin/villa/add/three_store', 'VillaController@add_step_three_store')->name('villa_add_step_three_store');
    // Route::get('/admin/villa/add/four', 'VillaController@add_step_four')->name('villa_add_step_four');
    // Route::post('/admin/villa/add/four_store', 'VillaController@add_step_four_store')->name('villa_add_step_four_store');
    // Route::get('/admin/villa/add/five', 'VillaController@add_step_five')->name('villa_add_step_five');
    // Route::post('/admin/villa/add/five_store', 'VillaController@add_step_five_store')->name('villa_add_step_five_store');
    // Route::get('/admin/villa/add/six', 'VillaController@add_step_six')->name('villa_add_step_six');
    // Route::get('/admin/villa/add/six_store', 'VillaController@add_step_six_store')->name('villa_add_step_six_store');
    // Route::get('/admin/villa/add/seven', 'VillaController@add_step_seven')->name('villa_add_step_seven');
    // Route::post('/admin/villa/add/seven_store', 'VillaController@add_step_seven_store')->name('villa_add_step_seven_store');
    // Route::get('/admin/villa/add/eight', 'VillaController@add_step_eight')->name('villa_add_step_eight');
    // Route::post('/admin/villa/add/eight_store', 'VillaController@add_step_eight_store')->name('villa_add_step_eight_store');
    // Route::get('/admin/villa/add/nine', 'VillaController@add_step_nine')->name('villa_add_step_nine');
    // Route::get('/admin/villa/add/nine', 'VillaController@add_step_nine')->name('villa_add_step_nine');
    // Route::post('/admin/villa/add/nine_store', 'VillaController@add_step_nine_store')->name('villa_add_step_nine_store');
    // Route::get('/admin/villa/add/ten', 'VillaController@add_step_ten')->name('villa_add_step_ten');

    Route::get('/admin/add-listing', [ListingController::class, 'add_listing'])->name('admin_add_listing');
    Route::post('/admin/villa/store', [VillaListingController::class, 'store'])->name('admin_villa_store');
    Route::get('/admin/villa/delete/{id}', [VillaListingController::class, 'destroy'])->name('admin_villa_destroy');
    Route::get('/admin/villa/update-status/{id}', [VillaListingController::class, 'status'])->name('admin_villa_update_status');
    Route::get('/admin/restaurant/update-status/{id}', [Restaurant\RestaurantController::class, 'update_status'])->name('admin_restaurant_update_status');
    Route::post('/admin/restaurant/grade/{id}', [Restaurant\RestaurantController::class, 'grade'])->name('restaurant_update_grade');
    Route::post('/admin/restaurant/store', [RestaurantListingController::class, 'store'])->name('admin_restaurant_store');
    Route::get('/admin/restaurant/delete/{id}', [RestaurantListingController::class, 'destroy'])->name('admin_restaurant_destroy');
    Route::post('/admin/things-to-do/store', [ActivityListingController::class, 'store'])->name('admin_activity_store');
    Route::get('/admin/things-to-do/delete/{id}', [ActivityListingController::class, 'destroy'])->name('admin_activity_destroy');
    Route::get('/admin/things-to-do/update-status/{id}', [Activity\ActivityController::class, 'update_status'])->name('admin_activity_update_status');
    Route::get('/villa/status/{id}', [VillaListingController::class, 'status'])->name('villa_update_status');
    Route::post('/villa/grade/{id}', [VillaListingController::class, 'grade'])->name('villa_update_grade');
    // Route::post('/villa/extra/{id}', 'VillaListingController@grade')->name('villa_update_grade');

    Route::get('/admin/villa-booking/update-status/completed/{id}', [ReservationsDashboard::class, 'updateStatusComplete'])->name('villa_booking_status_complete');
    Route::get('/admin/villa-booking/update-status/canceled/{id}', [ReservationsDashboard::class, 'updateStatusCanceled'])->name('villa_booking_status_canceled');
});

Route::get('villa/calendar/check', [VillabookingController::class, 'checkCookiesAvailability']);
Route::get('villa/calendar/{id}', [ViewController::class, 'fullcalendar'])->name('villa.fullcalendar');
Route::get('villa/calendar/not_available/{id}', [ViewController::class, 'fullcalendarNotAvailable'])->name('villa.fullcalendarNotAvailable');
Route::post('villa/calendar/import/{id}', [VillabookingController::class, 'importCalendar'])->name('villa_import_calendar');

//edit from frontend
Route::post('/villa/update/photo/position', [ViewController::class, 'update_position_photo'])->name('villaphoto_edit_position');
Route::post('/villa/update/video/position', [ViewController::class, 'update_position_video'])->name('villavideo_edit_position');
Route::post('/villa/update/price', [ViewController::class, 'villa_update_price'])->name('villa_update_price');
Route::post('/villa/update/not_available', [ViewController::class, 'villa_not_available'])->name('villa_not_available');
Route::post('/villa/update/bedroom', [ViewController::class, 'villa_update_bedroom'])->name('villa_update_bedroom');
Route::post('/villa/update/guest', [ViewController::class, 'villa_update_guest'])->name('villa_update_guest');
Route::post('/villa/update/location', [ViewController::class, 'villa_update_location'])->name('villa_update_location');
Route::post('/villa/update/description', [ViewController::class, 'villa_update_description'])->name('villa_update_description');
Route::post('/villa/update/name', [ViewController::class, 'villa_update_name'])->name('villa_update_name');
Route::get('/villa/get/name/{id}', [ViewController::class, 'villa_get_name'])->name('villa_get_name');
Route::post('/villa/update/short-description', [ViewController::class, 'villa_update_short_description'])->name('villa_update_short_description');
Route::get('/villa/get/short-description/{id}', [ViewController::class, 'villa_get_short_description'])->name('villa_get_short_description');
Route::post('/villa/update/amenities', [ViewController::class, 'villa_update_amenities'])->name('villa_update_amenities');
Route::post('/villa/update/tags', [ViewController::class, 'villa_update_tags'])->name('villa_update_tags');
Route::post('/villa/update/category', [ViewController::class, 'villa_update_category'])->name('villa_update_category');
// Route::get('/villa/get/category/{id}', [ViewController::class, 'villa_get_category'])->name('villa_get_category');
Route::post('/villa/update/story', [ViewController::class, 'villa_update_story'])->name('villa_update_story');
Route::post('/villa/update/photo', [ViewController::class, 'villa_update_photo'])->name('villa_update_photo');
Route::post('/villa/quick-enquiry', [ViewController::class, 'villa_quick_enquiry'])->name('villa_quick_enquiry');
Route::post('/villa/update/image', [ViewController::class, 'villa_update_image'])->name('villa_update_image');
Route::post('/villa/update/property-type', [ViewController::class, 'villa_update_property_type'])->name('villa_update_property_type');
Route::get('/villa/{id}/delete/story/{id_story}', [ViewController::class, 'villa_delete_story'])->name('villa_delete_story');
Route::patch('/villa/{id}/update/cancel-request-update-status', [ViewController::class, 'cancel_request_update_status'])->name('villa_cancel_request_update_status');
Route::get('/villa/{id}/delete/image', [ViewController::class, 'villa_delete_image'])->name('villa_delete_image');
Route::get('/villa/{id}/delete/photo/video/{id_video}', [ViewController::class, 'villa_delete_photo_video'])->name('villa_delete_photo_video');
Route::get('/villa/{id}/delete/photo/photo/{id_photo}', [ViewController::class, 'villa_delete_photo_photo'])->name('villa_delete_photo_photo');
Route::post('/villa/update/extra', [ViewController::class, 'villa_update_extra'])->name('villa_update_extra');

// ! Verified
// Route::middleware(['auth'])->group(
//     function () {
//     }
// );

// ! End Verified
Route::patch('/villa/{id}/update/request-update-status', [ViewController::class, 'request_update_status'])->name('villa_request_update_status');
Route::patch('/restaurant/{id}/update/request-update-status', [Restaurant\RestaurantController::class, 'request_update_status'])->name('restaurant_request_update_status');
Route::patch('/things-to-do/{id}/update/request-update-status', [Activity\ActivityController::class, 'request_update_status'])->name('activity_request_update_status');
Route::patch('/hotel/{id}/update/request-update-status', [Hotel\HotelDetailController::class, 'request_update_status'])->name('hotel_request_update_status');
Route::get('/villa/request/video/{id}/{name}', [ViewController::class, 'villa_request_video'])->name('villa_request_video');
Route::get('/hotel/request/video/{id}/{name}', [Hotel\HotelDetailController::class, 'hotel_request_video'])->name('hotel_request_video');
Route::get('/hotel/room/request/video/{id}/{name}', [Hotel\RoomDetailController::class, 'hotel_room_request_video'])->name('hotel_room_request_video');
Route::get('/restaurant/request/video/{id}/{name}', [Restaurant\RestaurantController::class, 'restaurant_request_video'])->name('restaurant_request_video');
Route::get('/things-to-do/request/video/{id}/{name}', [Activity\ActivityController::class, 'things_to_do_request_video'])->name('things_to_do_request_video');
Route::get('/things-to-do/price/request/video/{id}/{name}', [Activity\ActivityPriceController::class, 'things_to_do_price_request_video'])->name('things_to_do_price_request_video');

//--VILLA GALLERY --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/villa/create_gallery/{id}', [VillaController::class, 'create_gallery'])->name('admin_villa_create_gallery');
    Route::post('/admin/villa/store_gallery', [VillaController::class, 'store_gallery'])->name('admin_villa_store_gallery');
    Route::get('/admin/villa/delete_gallery/{id}', [VillaController::class, 'destroy_gallery'])->name('admin_villa_delete_gallery');
    Route::get('/admin/villa/delete_video/{id}', [VillaController::class, 'destroy_video'])->name('admin_villa_delete_video');
});

//--VILLA NEAR BY--
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/villa/index_nearby/{id}', [VillaController::class, 'index_nearby'])->name('admin_villa_index_nearby');
    Route::get('/admin/villa/datatable_nearby/{id}', [VillaController::class, 'datatable_nearby'])->name('admin_villa_datatable_nearby');
    Route::get('/admin/villa/create_nearby/{id}', [VillaController::class, 'create_nearby'])->name('admin_villa_create_nearby');
    Route::post('/admin/villa/store_nearby', [VillaController::class, 'store_nearby'])->name('admin_villa_store_nearby');
    Route::get('/admin/villa/delete_nearby/{id}', [VillaController::class, 'destroy_nearby'])->name('admin_villa_delete_nearby');
});

//--VILLA EXTRA PRICE--
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/villa/index_extraprice/{id}', [VillaController::class, 'index_extraprice'])->name('admin_villa_index_extraprice');
    Route::get('/admin/villa/datatable_extraprice/{id}', [VillaController::class, 'datatable_extraprice'])->name('admin_villa_datatable_extraprice');
    Route::get('/admin/villa/create_extraprice/{id}', [VillaController::class, 'create_extraprice'])->name('admin_villa_create_extraprice');
    Route::post('/admin/villa/store_extraprice', [VillaController::class, 'store_extraprice'])->name('admin_villa_store_extraprice');
    Route::get('/admin/villa/delete_extraprice/{id}', [VillaController::class, 'destroy_extraprice'])->name('admin_villa_delete_extraprice');
});

//-- VILLA BOOKING --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/villa/booking', 'VillabookingController@index')->name('admin_villa_booking');
    // Route::post('admin/villa/booking/store', 'VillabookingController@store')->name('admin_villa_booking_store');
    // Route::get('/admin/villa/booking/list', 'VillabookingController@list')->name('admin_villa_booking_list');
    // Route::get('/admin/villa/booking/datatable', 'VillabookingController@datatable')->name('admin_villa_booking_datatable');
    // Route::post('/admin/villa/booking/update/{id}', 'VillabookingController@update')->name('admin_villa_booking_update');
    // Route::get('/admin/villa/booking/delete/{id}', 'VillabookingController@delete')->name('admin_villa_booking_delete');
    Route::get('/dashboard/villa/booking', [VillabookingController::class, 'index'])->name('admin_villa_booking');
    Route::post('dashboard/villa/booking/store', [VillabookingController::class, 'store'])->name('admin_villa_booking_store');
    Route::get('/dashboard/villa/booking/list', [VillabookingController::class, 'list'])->name('admin_villa_booking_list');
    Route::get('/dashboard/villa/booking/datatable', [VillabookingController::class, 'datatable'])->name('admin_villa_booking_datatable');
    Route::post('/dashboard/villa/booking/update/{id}', [VillabookingController::class, 'update'])->name('admin_villa_booking_update');
    Route::get('/dashboard/villa/booking/delete/{id}', [VillabookingController::class, 'delete'])->name('admin_villa_booking_delete');
});

//-- VILLA TYPE ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/villatype', 'VillatypeController@index')->name('admin_villatype');
    // Route::get('/admin/villatype/datatable', 'VillatypeController@datatable')->name('admin_villatype_datatable');
    // Route::get('/admin/villatype/create', 'VillatypeController@create')->name('admin_villatype_create');
    // Route::post('/admin/villatype/store', 'VillatypeController@store')->name('admin_villatype_store');
    // Route::get('/admin/villatype/show/{id}', 'VillatypeController@show')->name('admin_villatype_show');
    // Route::put('/admin/villatype/update/{id}', 'VillatypeController@update')->name('admin_villatype_update');
    // Route::get('/admin/villatype/delete/{id}', 'VillatypeController@destroy')->name('admin_villatype_delete');
    Route::get('/dashboard/villa/type', [VillatypeController::class, 'index'])->name('admin_villatype');
    Route::get('/dashboard/villa/type/datatable', [VillatypeController::class, 'datatable'])->name('admin_villatype_datatable');
    Route::get('/dashboard/villa/type/create', [VillatypeController::class, 'create'])->name('admin_villatype_create');
    Route::post('/dashboard/villa/type/store', [VillatypeController::class, 'store'])->name('admin_villatype_store');
    Route::get('/dashboard/villa/type/show/{id}', [VillatypeController::class, 'show'])->name('admin_villatype_show');
    Route::put('/dashboard/villa/type/update/{id}', [VillatypeController::class, 'update'])->name('admin_villatype_update');
    Route::get('/dashboard/villa/type/delete/{id}', [VillatypeController::class, 'destroy'])->name('admin_villatype_delete');
});

//-- VILLA CONTACT HOST ---
Route::middleware(['auth'])->group(function () {
    Route::get('/conversation', [VillaContactHostController::class, 'index'])->name('messages');
    // Route::get('/villa/contact-host/conversation', [VillaContactHostController::class, 'index')->name('villa_get_messages');
    Route::post('/villa/contact-host/user/store-message', [VillaContactHostController::class, 'store_message'])->name('villa_store_user_message');
    Route::post('/villa/contact-host/owner/reply-message', [VillaContactHostController::class, 'reply_message'])->name('villa_reply_owner_message');
    Route::post('/villa/contact-host/admin/update-approve-user-message', [VillaContactHostController::class, 'update_approve_user_message'])->name('villa_update_approve_user_message');
    Route::post('/villa/contact-host/admin/update-disapprove-user-message', [VillaContactHostController::class, 'update_disapprove_user_message'])->name('villa_update_disapprove_user_message');
    Route::post('/villa/contact-host/admin/update-approve-owner-message', [VillaContactHostController::class, 'update_approve_owner_message'])->name('villa_update_approve_owner_message');
    Route::post('/villa/contact-host/admin/update-disapprove-owner-message', [VillaContactHostController::class, 'update_disapprove_owner_message'])->name('villa_update_disapprove_owner_message');
    Route::get('/admin/villa/contact-host/conversation', [VillaContactHostController::class, 'admin_index'])->name('admin_villa_get_messages');
    Route::get('/owner/villa/contact-host/conversation', [VillaContactHostController::class, 'owner_index'])->name('owner_villa_get_messages');
});

Route::get('/owner/profile/{id}', [Owner\ProfileController::class, 'showProfile'])->name('owner_profile_show');

//-- NO OF BEDROOM ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/no_bedroom', 'NobedroomController@index')->name('admin_no_bedroom');
    // Route::get('/admin/no_bedroom/datatable', 'NobedroomController@datatable')->name('admin_no_bedroom_datatable');
    // Route::get('/admin/no_bedroom/create', 'NobedroomController@create')->name('admin_no_bedroom_create');
    // Route::post('/admin/no_bedroom/store', 'NobedroomController@store')->name('admin_no_bedroom_store');
    // Route::get('/admin/no_bedroom/show/{id}', 'NobedroomController@show')->name('admin_no_bedroom_show');
    // Route::put('/admin/no_bedroom/update/{id}', 'NobedroomController@update')->name('admin_no_bedroom_update');
    // Route::get('/admin/no_bedroom/delete/{id}', 'NobedroomController@destroy')->name('admin_no_bedroom_delete');
    Route::get('/dashboard/villa/no_bedroom', [NobedroomController::class, 'index'])->name('admin_no_bedroom');
    Route::get('/dashboard/villa/no_bedroom/datatable', [NobedroomController::class, 'datatable'])->name('admin_no_bedroom_datatable');
    Route::get('/dashboard/villa/no_bedroom/create', [NobedroomController::class, 'create'])->name('admin_no_bedroom_create');
    Route::post('/dashboard/villa/no_bedroom/store', [NobedroomController::class, 'store'])->name('admin_no_bedroom_store');
    Route::get('/dashboard/villa/no_bedroom/show/{id}', [NobedroomController::class, 'show'])->name('admin_no_bedroom_show');
    Route::put('/dashboard/villa/no_bedroom/update/{id}', [NobedroomController::class, 'update'])->name('admin_no_bedroom_update');
    Route::get('/dashboard/villa/no_bedroom/delete/{id}', [NobedroomController::class, 'destroy'])->name('admin_no_bedroom_delete');
});


//-- BEDROOM ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/bedroom', 'BedroomController@index')->name('admin_bedroom');
    // Route::get('/admin/bedroom/datatable', 'BedroomController@datatable')->name('admin_bedroom_datatable');
    // Route::get('/admin/bedroom/create', 'BedroomController@create')->name('admin_bedroom_create');
    // Route::post('/admin/bedroom/store', 'BedroomController@store')->name('admin_bedroom_store');
    // Route::get('/admin/bedroom/show/{id}', 'BedroomController@show')->name('admin_bedroom_show');
    // Route::put('/admin/bedroom/update/{id}', 'BedroomController@update')->name('admin_bedroom_update');
    // Route::get('/admin/bedroom/delete/{id}', 'BedroomController@destroy')->name('admin_bedroom_delete');
    Route::get('/dashboard/villa/bedroom', [BedroomController::class, 'index'])->name('admin_bedroom');
    Route::get('/dashboard/villa/bedroom/datatable', [BedroomController::class, 'datatable'])->name('admin_bedroom_datatable');
    Route::get('/dashboard/villa/bedroom/create', [BedroomController::class, 'create'])->name('admin_bedroom_create');
    Route::post('/dashboard/villa/bedroom/store', [BedroomController::class, 'store'])->name('admin_bedroom_store');
    Route::get('/dashboard/villa/bedroom/show/{id}', [BedroomController::class, 'show'])->name('admin_bedroom_show');
    Route::put('/dashboard/villa/bedroom/update/{id}', [BedroomController::class, 'update'])->name('admin_bedroom_update');
    Route::get('/dashboard/villa/bedroom/delete/{id}', [BedroomController::class, 'destroy'])->name('admin_bedroom_delete');
});


//-- BATHROOM ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/bathroom', 'BathroomController@index')->name('admin_bathroom');
    // Route::get('/admin/bathroom/datatable', 'BathroomController@datatable')->name('admin_bathroom_datatable');
    // Route::get('/admin/bathroom/create', 'BathroomController@create')->name('admin_bathroom_create');
    // Route::post('/admin/bathroom/store', 'BathroomController@store')->name('admin_bathroom_store');
    // Route::get('/admin/bathroom/show/{id}', 'BathroomController@show')->name('admin_bathroom_show');
    // Route::put('/admin/bathroom/update/{id}', 'BathroomController@update')->name('admin_bathroom_update');
    // Route::get('/admin/bathroom/delete/{id}', 'BathroomController@destroy')->name('admin_bathroom_delete');
    Route::get('/dashboard/villa/bathroom', [BathroomController::class, 'index'])->name('admin_bathroom');
    Route::get('/dashboard/villa/bathroom/datatable', [BathroomController::class, 'datatable'])->name('admin_bathroom_datatable');
    Route::get('/dashboard/villa/bathroom/create', [BathroomController::class, 'create'])->name('admin_bathroom_create');
    Route::post('/dashboard/villa/bathroom/store', [BathroomController::class, 'store'])->name('admin_bathroom_store');
    Route::get('/dashboard/villa/bathroom/show/{id}', [BathroomController::class, 'show'])->name('admin_bathroom_show');
    Route::put('/dashboard/villa/bathroom/update/{id}', [BathroomController::class, 'update'])->name('admin_bathroom_update');
    Route::get('/dashboard/villa/bathroom/delete/{id}', [BathroomController::class, 'destroy'])->name('admin_bathroom_delete');
});


//-- KITCHEN ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/kitchen', 'KitchenController@index')->name('admin_kitchen');
    // Route::get('/admin/kitchen/datatable', 'KitchenController@datatable')->name('admin_kitchen_datatable');
    // Route::get('/admin/kitchen/create', 'KitchenController@create')->name('admin_kitchen_create');
    // Route::post('/admin/kitchen/store', 'KitchenController@store')->name('admin_kitchen_store');
    // Route::get('/admin/kitchen/show/{id}', 'KitchenController@show')->name('admin_kitchen_show');
    // Route::put('/admin/kitchen/update/{id}', 'KitchenController@update')->name('admin_kitchen_update');
    // Route::get('/admin/kitchen/delete/{id}', 'KitchenController@destroy')->name('admin_kitchen_delete');
    Route::get('/dashboard/villa/kitchen', [KitchenController::class, 'index'])->name('admin_kitchen');
    Route::get('/dashboard/villa/kitchen/datatable', [KitchenController::class, 'datatable'])->name('admin_kitchen_datatable');
    Route::get('/dashboard/villa/kitchen/create', [KitchenController::class, 'create'])->name('admin_kitchen_create');
    Route::post('/dashboard/villa/kitchen/store', [KitchenController::class, 'store'])->name('admin_kitchen_store');
    Route::get('/dashboard/villa/kitchen/show/{id}', [KitchenController::class, 'show'])->name('admin_kitchen_show');
    Route::put('/dashboard/villa/kitchen/update/{id}', [KitchenController::class, 'update'])->name('admin_kitchen_update');
    Route::get('/dashboard/villa/kitchen/delete/{id}', [KitchenController::class, 'destroy'])->name('admin_kitchen_delete');
});

//-- SERVICE ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/service', 'ServiceController@index')->name('admin_service');
    // Route::get('/admin/service/datatable', 'ServiceController@datatable')->name('admin_service_datatable');
    // Route::get('/admin/service/create', 'ServiceController@create')->name('admin_service_create');
    // Route::post('/admin/service/store', 'ServiceController@store')->name('admin_service_store');
    // Route::get('/admin/service/show/{id}', 'ServiceController@show')->name('admin_service_show');
    // Route::put('/admin/service/update/{id}', 'ServiceController@update')->name('admin_service_update');
    // Route::get('/admin/service/delete/{id}', 'ServiceController@destroy')->name('admin_service_delete');
    Route::get('/dashboard/villa/service', [ServiceController::class, 'index'])->name('admin_service');
    Route::get('/dashboard/villa/service/datatable', [ServiceController::class, 'datatable'])->name('admin_service_datatable');
    Route::get('/dashboard/villa/service/create', [ServiceController::class, 'create'])->name('admin_service_create');
    Route::post('/dashboard/villa/service/store', [ServiceController::class, 'store'])->name('admin_service_store');
    Route::get('/dashboard/villa/service/show/{id}', [ServiceController::class, 'show'])->name('admin_service_show');
    Route::put('/dashboard/villa/service/update/{id}', [ServiceController::class, 'update'])->name('admin_service_update');
    Route::get('/dashboard/villa/service/delete/{id}', [ServiceController::class, 'destroy'])->name('admin_service_delete');

    Route::get('/dashboard/villa/family', [OutdoorController::class, 'index'])->name('admin_family');
    Route::get('/dashboard/villa/family/datatable', [OutdoorController::class, 'datatable'])->name('admin_family_datatable');
    Route::get('/dashboard/villa/family/create', [OutdoorController::class, 'create'])->name('admin_family_create');
    Route::post('/dashboard/villa/family/store', [OutdoorController::class, 'store'])->name('admin_family_store');
    Route::get('/dashboard/villa/family/show/{id}', [OutdoorController::class, 'show'])->name('admin_family_show');
    Route::put('/dashboard/villa/family/update/{id}', [OutdoorController::class, 'update'])->name('admin_family_update');
    Route::get('/dashboard/villa/family/delete/{id}', [OutdoorController::class, 'destroy'])->name('admin_family_delete');

    Route::get('/dashboard/villa/outdoor', [FamilyController::class, 'index'])->name('admin_outdoor');
    Route::get('/dashboard/villa/outdoor/datatable', [FamilyController::class, 'datatable'])->name('admin_outdoor_datatable');
    Route::get('/dashboard/villa/outdoor/create', [FamilyController::class, 'create'])->name('admin_outdoor_create');
    Route::post('/dashboard/villa/outdoor/store', [FamilyController::class, 'store'])->name('admin_outdoor_store');
    Route::get('/dashboard/villa/outdoor/show/{id}', [FamilyController::class, 'show'])->name('admin_outdoor_show');
    Route::put('/dashboard/villa/outdoor/update/{id}', [FamilyController::class, 'update'])->name('admin_outdoor_update');
    Route::get('/dashboard/villa/outdoor/delete/{id}', [FamilyController::class, 'destroy'])->name('admin_outdoor_delete');
});

//-- SAFETY ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/safety', 'SafetyController@index')->name('admin_safety');
    // Route::get('/admin/safety/datatable', 'SafetyController@datatable')->name('admin_safety_datatable');
    // Route::get('/admin/safety/create', 'SafetyController@create')->name('admin_safety_create');
    // Route::post('/admin/safety/store', 'SafetyController@store')->name('admin_safety_store');
    // Route::get('/admin/safety/show/{id}', 'SafetyController@show')->name('admin_safety_show');
    // Route::put('/admin/safety/update/{id}', 'SafetyController@update')->name('admin_safety_update');
    // Route::get('/admin/safety/delete/{id}', 'SafetyController@destroy')->name('admin_safety_delete');
    Route::get('/dashboard/villa/safety', [SafetyController::class, 'index'])->name('admin_safety');
    Route::get('/dashboard/villa/safety/datatable', [SafetyController::class, 'datatable'])->name('admin_safety_datatable');
    Route::get('/dashboard/villa/safety/create', [SafetyController::class, 'create'])->name('admin_safety_create');
    Route::post('/dashboard/villa/safety/store', [SafetyController::class, 'store'])->name('admin_safety_store');
    Route::get('/dashboard/villa/safety/show/{id}', [SafetyController::class, 'show'])->name('admin_safety_show');
    Route::put('/dashboard/villa/safety/update/{id}', [SafetyController::class, 'update'])->name('admin_safety_update');
    Route::get('/dashboard/villa/safety/delete/{id}', [SafetyController::class, 'destroy'])->name('admin_safety_delete');
});

//-- AMENITIES ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/amenities', 'AmenitiesController@index')->name('admin_amenities');
    // Route::get('/admin/amenities/datatable', 'AmenitiesController@datatable')->name('admin_amenities_datatable');
    // Route::get('/admin/amenities/create', 'AmenitiesController@create')->name('admin_amenities_create');
    // Route::post('/admin/amenities/store', 'AmenitiesController@store')->name('admin_amenities_store');
    // Route::get('/admin/amenities/show/{id}', 'AmenitiesController@show')->name('admin_amenities_show');
    // Route::put('/admin/amenities/update/{id}', 'AmenitiesController@update')->name('admin_amenities_update');
    // Route::get('/admin/amenities/delete/{id}', 'AmenitiesController@destroy')->name('admin_amenities_delete');
    Route::get('/dashboard/villa/amenities', [AmenitiesController::class, 'index'])->name('admin_amenities');
    Route::get('/dashboard/villa/amenities/datatable', [AmenitiesController::class, 'datatable'])->name('admin_amenities_datatable');
    Route::get('/dashboard/villa/amenities/create', [AmenitiesController::class, 'create'])->name('admin_amenities_create');
    Route::post('/dashboard/villa/amenities/store', [AmenitiesController::class, 'store'])->name('admin_amenities_store');
    Route::get('/dashboard/villa/amenities/show/{id}', [AmenitiesController::class, 'show'])->name('admin_amenities_show');
    Route::put('/dashboard/villa/amenities/update/{id}', [AmenitiesController::class, 'update'])->name('admin_amenities_update');
    Route::get('/dashboard/villa/amenities/delete/{id}', [AmenitiesController::class, 'destroy'])->name('admin_amenities_delete');
});

//-- LOCATION ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/location', 'LocationController@index')->name('admin_location');
    // Route::get('/admin/location/datatable', 'LocationController@datatable')->name('admin_location_datatable');
    // Route::get('/admin/location/create', 'LocationController@create')->name('admin_location_create');
    // Route::post('/admin/location/store', 'LocationController@store')->name('admin_location_store');
    // Route::get('/admin/location/show/{id}', 'LocationController@show')->name('admin_location_show');
    // Route::put('/admin/location/update/{id}', 'LocationController@update')->name('admin_location_update');
    // Route::get('/admin/location/delete/{id}', 'LocationController@destroy')->name('admin_location_delete');
    Route::get('/dashboard/location', [LocationController::class, 'index'])->name('admin_location');
    Route::get('/dashboard/location/datatable', [LocationController::class, 'datatable'])->name('admin_location_datatable');
    Route::get('/dashboard/location/create', [LocationController::class, 'create'])->name('admin_location_create');
    Route::post('/dashboard/location/store', [LocationController::class, 'store'])->name('admin_location_store');
    Route::get('/dashboard/location/show/{id}', [LocationController::class, 'show'])->name('admin_location_show');
    Route::put('/dashboard/location/update/{id}', [LocationController::class, 'update'])->name('admin_location_update');
    Route::get('/dashboard/location/delete/{id}', [LocationController::class, 'destroy'])->name('admin_location_delete');
});

//-- REVIEW ----
Route::get('/review/create/{id}', [ReviewController::class, 'create'])->name('villa_review');
Route::post('/review/store', [ReviewController::class, 'store'])->name('villa_review_store');
Route::get('/review/delete/{id}', [ReviewController::class, 'delete'])->name('villa_review_delete');

//-- USER INDEX --
// Route::get('/index', 'ViewController@index')->name('index');

//user categori
Route::get('/villa/list', [ViewController::class, 'villa_list'])->name('villa_list');
Route::get('/homes/search', [SearchHomeController::class, 'index'])->name('search_home_combine');
// Filter Modal
Route::get('/hotel/filters', [Hotel\HotelSearchController::class, 'search'])->name('filters-hotel');

// filter villa
Route::get('/villa/property-type/{id}', [PropertyTypeVillaController::class, 'index'])->name('property_type');
Route::get('/villa/filter/{id}', [FilterController::class, 'filter'])->name('filter');
Route::get('/villa/price', [PriceFilterController::class, 'price'])->name('price');
Route::get('/villa/more-filter', [MoreFilterController::class, 'moreFilter'])->name('more_filter');
Route::get('/villa/boxfilter/', [FilterBoxController::class, 'filter'])->name('box_filter');
Route::get('/villa/amenities/', [FilterBoxController::class, 'amenities'])->name('amenities_filter');
Route::get('/villa/sort-low-to-high', [SortFilterController::class, 'sort_low_to_high'])->name('sort_low_to_high');
Route::get('/villa/sort-high-to-low', [SortFilterController::class, 'sort_high_to_low'])->name('sort_high_to_low');
Route::get('/villa/sort-popularity', [SortFilterController::class, 'popularity'])->name('sort_popularity');
Route::get('/villa/sort-newest', [SortFilterController::class, 'newest'])->name('sort_newest');
Route::get('/villa/sort-highest-rating', [SortFilterController::class, 'highest_rating'])->name('sort_highest_rating');

Route::post('/payment/va-invoice', [XenditController::class, 'invoice'])->name('invoice_va');
//user search
Route::get('/homes/{id}', [ViewController::class, 'villa'])->name('villa');
Route::get('/villa/{id}/{in}/{out}/{adult}/{child}', [ViewController::class, 'villa_set'])->name('villa_set');
Route::get('/story/{id}', [ViewController::class, 'story'])->name('villa_story');
Route::get('/story/next/{id}/{id_villa}', [ViewController::class, 'story_next'])->name('story_next');
Route::get('/villa/video/{id}', [ViewController::class, 'video'])->name('villa_video');
Route::get('/villa/description/{id}', [ViewController::class, 'description'])->name('villa_description');
Route::get('/suggestion', [ViewController::class, 'getVideoSuggestions'])->name('suggestion');
Route::get('/villa/amenities/{id}', [ViewController::class, 'amenities'])->name('list_amenities');
Route::get('/villa/bathroom/{id}', [ViewController::class, 'bathroom'])->name('list_bathroom');
Route::get('/villa/bedroom/{id}', [ViewController::class, 'bedroom'])->name('list_bedroom');
Route::get('/villa/kitchen/{id}', [ViewController::class, 'kitchen'])->name('list_kitchen');
Route::get('/villa/safety/{id}', [ViewController::class, 'safety'])->name('list_safety');
Route::get('/villa/service/{id}', [ViewController::class, 'service'])->name('list_service');
Route::get('/villa/review/{id}', [ViewController::class, 'review'])->name('villa_review');
Route::get('/villa/availabality/{id}', [ViewController::class, 'availabality'])->name('villa_availabality');
Route::post('/villa/confirm/store', [VillabookingController::class, 'user_store'])->name('villa_booking_user_store');

Route::get('/villa/availability/{id}/datatable', [ViewController::class, 'datatable_availability'])->name('villa_availability_datatable');

Route::get('/villa/favorit/{id}', [VillasaveController::class, 'favorit'])->name('villa_favorit');

Route::get('/villa/video/{id}', [ViewController::class, 'villa_video'])->name('list-villa_video');
// Route::post('/villa-list', 'ViewController@list')->name('list');

Route::get('/homes-list', [ViewController::class, 'list'])->name('list');
Route::get('/villa/map/{id}', [ViewController::class, 'villa_map'])->name('villa_map');
Route::get('/video/next', [ViewController::class, 'next'])->name('video_next');
// Route::get('/villa-search', 'SearchVillaController@search_combine')->name('search_villa_combine');

Route::get('/villa/video/open/{id}', [ViewController::class, 'video_open'])->name('video_open');

// things to know villa
Route::post('/houserules/post', [ViewController::class, 'villa_update_house_rules'])->name('villa_update_house_rules');
Route::post('/guessafety/post', [ViewController::class, 'villa_update_guest_safety'])->name('villa_update_guest_safety');
Route::post('/cancellation_policy/post', [ViewController::class, 'villa_update_cancellation_policy'])->name('villa_update_cancellation_policy');
Route::post('/villa/photo/caption/update', [ViewController::class, 'villa_update_caption_photo'])->name('villa_update_caption_photo');

//-- RESTAURANT ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::post('/restaurant/update/photo/position', [Restaurant\RestaurantController::class, 'restaurant_update_position_photo'])->name('restaurant_update_photo_photo_position');
    Route::post('/restaurant/update/video/position', [Restaurant\RestaurantController::class, 'restaurant_update_position_video'])->name('restaurant_update_photo_video_position');
    // Route::get('/admin/restaurant', 'RestaurantController@index')->name('admin_restaurant');
    // Route::get('/admin/restaurant/datatable', 'RestaurantController@datatable')->name('admin_restaurant_datatable');

    Route::get('/dashboard/restaurant', [RestaurantController::class, 'index'])->name('admin_restaurant');
    Route::get('/dashboard/restaurant/datatable', [RestaurantController::class, 'datatable'])->name('admin_restaurant_datatable');

    Route::get('/dashboard/restaurant/trash', [RestaurantController::class, 'trash'])->name('admin_restaurant_trash');
    Route::get('/dashboard/restaurant/datatabletrash', [RestaurantController::class, 'datatableTrash'])->name('admin_restaurant_datatabletrash');

    Route::get('/dashboard/restaurant/soft-delete/{id}', [RestaurantListingController::class, 'softDestroy'])->name('admin_restaurant_soft_delete');
    Route::get('/dashboard/restaurant/restore-delete/{id}', [RestaurantListingController::class, 'restoreDestroy'])->name('admin_restaurant_restore_delete');

    // Route::get('/admin/restaurant/add/continue', 'RestaurantController@add_step_continue')->name('restaurant_add_step_continue');
    // Route::get('/admin/restaurant/add/one_store', 'RestaurantController@add_step_one_store')->name('restaurant_add_step_one_store');
    // Route::get('/admin/restaurant/add/two', 'RestaurantController@add_step_two')->name('restaurant_add_step_two');
    // Route::post('/admin/restaurant/add/two_store', 'RestaurantController@add_step_two_store')->name('restaurant_add_step_two_store');
    // Route::get('/admin/restaurant/add/three', 'RestaurantController@add_step_three')->name('restaurant_add_step_three');
    // Route::post('/admin/restaurant/add/three_store', 'RestaurantController@add_step_three_store')->name('restaurant_add_step_three_store');
    // Route::get('/admin/restaurant/add/four', 'RestaurantController@add_step_four')->name('restaurant_add_step_four');
    // Route::post('/admin/restaurant/add/four_store', 'RestaurantController@add_step_four_store')->name('restaurant_add_step_four_store');
    // Route::get('/admin/restaurant/add/five', 'RestaurantController@add_step_five')->name('restaurant_add_step_five');
    // Route::post('/admin/restaurant/add/five_store', 'RestaurantController@add_step_five_store')->name('restaurant_add_step_five_store');
    // Route::get('/admin/restaurant/add/six', 'RestaurantController@add_step_six')->name('restaurant_add_step_six');
});

//---- RESTAURANT MENU ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/restaurant/index_menu/{id}', [RestaurantController::class, 'index_menu'])->name('admin_restaurant_index_menu');
    Route::get('/admin/restaurant/datatable_menu/{id}', [RestaurantController::class, 'datatable_menu'])->name('admin_restaurant_datatable_menu');
    Route::get('/admin/restaurant/create_menu/{id}', [RestaurantController::class, 'create_menu'])->name('admin_restaurant_create_menu');
    Route::post('/admin/restaurant/store_menu', [RestaurantController::class, 'store_menu'])->name('admin_restaurant_store_menu');
    Route::get('/admin/restaurant/delete_menu/{id}', [RestaurantController::class, 'destroy_menu'])->name('admin_restaurant_delete_menu');
});

//--RESTAURANT GALLERY --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/restaurant/create_gallery/{id}', [RestaurantController::class, 'create_gallery'])->name('admin_restaurant_create_gallery');
    Route::post('/admin/restaurant/store_gallery', [RestaurantController::class, 'store_gallery'])->name('admin_restaurant_store_gallery');
    Route::get('/admin/restaurant/delete_gallery/{id}', [RestaurantController::class, 'destroy_gallery'])->name('admin_restaurant_delete_gallery');
    Route::get('/admin/restaurant/delete_video/{id}', [RestaurantController::class, 'destroy_video'])->name('admin_restaurant_delete_video');
});

// RESTAURANT TYPE
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/type', 'RestaurantTypeController@index')->name('restaurant_type');
    // Route::get('/admin/restaurant/type/datatable', 'RestaurantTypeController@datatable')->name('admin_restaurant_type_datatable');
    // Route::get('/admin/restaurant/type/create', 'RestaurantTypeController@create')->name('admin_restaurant_type_create');
    // Route::post('/admin/restaurant/type/store', 'RestaurantTypeController@store')->name('admin_restaurant_type_store');
    // Route::get('/admin/restaurant/type/show/{id}', 'RestaurantTypeController@show')->name('admin_restaurant_type_show');
    // Route::put('/admin/restaurant/type/update/{id}', 'RestaurantTypeController@update')->name('admin_restaurant_type_update');
    // Route::get('/admin/restaurant/type/delete/{id}', 'RestaurantTypeController@destroy')->name('admin_restaurant_type_delete');
    Route::get('/dashboard/restaurant/type', [RestaurantTypeController::class, 'index'])->name('restaurant_type');
    Route::get('/dashboard/restaurant/type/datatable', [RestaurantTypeController::class, 'datatable'])->name('admin_restaurant_type_datatable');
    Route::get('/dashboard/restaurant/type/create', [RestaurantTypeController::class, 'create'])->name('admin_restaurant_type_create');
    Route::post('/dashboard/restaurant/type/store', [RestaurantTypeController::class, 'store'])->name('admin_restaurant_type_store');
    Route::get('/dashboard/restaurant/type/show/{id}', [RestaurantTypeController::class, 'show'])->name('admin_restaurant_type_show');
    Route::put('/dashboard/restaurant/type/update/{id}', [RestaurantTypeController::class, 'update'])->name('admin_restaurant_type_update');
    Route::get('/dashboard/restaurant/type/delete/{id}', [RestaurantTypeController::class, 'destroy'])->name('admin_restaurant_type_delete');
});

// RESTAURANT FACILITIES
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/facilities', 'Restaurant\RestaurantFacilitiesController@index')->name('restaurant_facilities');
    // Route::get('/admin/restaurant/facilities/datatable', 'Restaurant\RestaurantFacilitiesController@datatable')->name('admin_restaurant_facilities_datatable');
    // Route::get('/admin/restaurant/facilities/create', 'Restaurant\RestaurantFacilitiesController@create')->name('admin_restaurant_facilities_create');
    // Route::post('/admin/restaurant/facilities/store', 'Restaurant\RestaurantFacilitiesController@store')->name('admin_restaurant_facilities_store');
    // Route::get('/admin/restaurant/facilities/show/{id}', 'Restaurant\RestaurantFacilitiesController@show')->name('admin_restaurant_facilities_show');
    // Route::put('/admin/restaurant/facilities/update/{id}', 'Restaurant\RestaurantFacilitiesController@update')->name('admin_restaurant_facilities_update');
    // Route::get('/admin/restaurant/facilities/delete/{id}', 'Restaurant\RestaurantFacilitiesController@destroy')->name('admin_restaurant_facilities_delete');
    Route::get('/dashboard/restaurant/facilities', [Restaurant\RestaurantFacilitiesController::class, 'index'])->name('restaurant_facilities');
    Route::get('/dashboard/restaurant/facilities/datatable', [Restaurant\RestaurantFacilitiesController::class, 'datatable'])->name('admin_restaurant_facilities_datatable');
    Route::get('/dashboard/restaurant/facilities/create', [Restaurant\RestaurantFacilitiesController::class, 'create'])->name('admin_restaurant_facilities_create');
    Route::post('/dashboard/restaurant/facilities/store', [Restaurant\RestaurantFacilitiesController::class, 'store'])->name('admin_restaurant_facilities_store');
    Route::get('/dashboard/restaurant/facilities/show/{id}', [Restaurant\RestaurantFacilitiesController::class, 'show'])->name('admin_restaurant_facilities_show');
    Route::put('/dashboard/restaurant/facilities/update/{id}', [Restaurant\RestaurantFacilitiesController::class, 'update'])->name('admin_restaurant_facilities_update');
    Route::get('/dashboard/restaurant/facilities/delete/{id}', [Restaurant\RestaurantFacilitiesController::class, 'destroy'])->name('admin_restaurant_facilities_delete');
});

// RESTAURANT MEAL
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/meal', 'Restaurant\RestaurantMealController@index')->name('restaurant_meal');
    // Route::get('/admin/restaurant/meal/datatable', 'Restaurant\RestaurantMealController@datatable')->name('admin_restaurant_meal_datatable');
    // Route::get('/admin/restaurant/meal/create', 'Restaurant\RestaurantMealController@create')->name('admin_restaurant_meal_create');
    // Route::post('/admin/restaurant/meal/store', 'Restaurant\RestaurantMealController@store')->name('admin_restaurant_meal_store');
    // Route::get('/admin/restaurant/meal/show/{id}', 'Restaurant\RestaurantMealController@show')->name('admin_restaurant_meal_show');
    // Route::put('/admin/restaurant/meal/update/{id}', 'Restaurant\RestaurantMealController@update')->name('admin_restaurant_meal_update');
    // Route::get('/admin/restaurant/meal/delete/{id}', 'Restaurant\RestaurantMealController@destroy')->name('admin_restaurant_meal_delete');
    Route::get('/dashboard/restaurant/meal', [Restaurant\RestaurantMealController::class, 'index'])->name('restaurant_meal');
    Route::get('/dashboard/restaurant/meal/datatable', [Restaurant\RestaurantMealController::class, 'datatable'])->name('admin_restaurant_meal_datatable');
    Route::get('/dashboard/restaurant/meal/create', [Restaurant\RestaurantMealController::class, 'create'])->name('admin_restaurant_meal_create');
    Route::post('/dashboard/restaurant/meal/store', [Restaurant\RestaurantMealController::class, 'store'])->name('admin_restaurant_meal_store');
    Route::get('/dashboard/restaurant/meal/show/{id}', [Restaurant\RestaurantMealController::class, 'show'])->name('admin_restaurant_meal_show');
    Route::put('/dashboard/restaurant/meal/update/{id}', [Restaurant\RestaurantMealController::class, 'update'])->name('admin_restaurant_meal_update');
    Route::get('/dashboard/restaurant/meal/delete/{id}', [Restaurant\RestaurantMealController::class, 'destroy'])->name('admin_restaurant_meal_delete');
});

// RESTAURANT PRICE
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/price', 'Restaurant\RestaurantPriceController@index')->name('restaurant_price');
    // Route::get('/admin/restaurant/price/datatable', 'Restaurant\RestaurantPriceController@datatable')->name('admin_restaurant_price_datatable');
    // Route::get('/admin/restaurant/price/create', 'Restaurant\RestaurantPriceController@create')->name('admin_restaurant_price_create');
    // Route::post('/admin/restaurant/price/store', 'Restaurant\RestaurantPriceController@store')->name('admin_restaurant_price_store');
    // Route::get('/admin/restaurant/price/show/{id}', 'Restaurant\RestaurantPriceController@show')->name('admin_restaurant_price_show');
    // Route::put('/admin/restaurant/price/update/{id}', 'Restaurant\RestaurantPriceController@update')->name('admin_restaurant_price_update');
    // Route::get('/admin/restaurant/price/delete/{id}', 'Restaurant\RestaurantPriceController@destroy')->name('admin_restaurant_price_delete');
    Route::get('/dashboard/restaurant/price', [Restaurant\RestaurantPriceController::class, 'index'])->name('restaurant_price');
    Route::get('/dashboard/restaurant/price/datatable', [Restaurant\RestaurantPriceController::class, 'datatable'])->name('admin_restaurant_price_datatable');
    Route::get('/dashboard/restaurant/price/create', [Restaurant\RestaurantPriceController::class, 'create'])->name('admin_restaurant_price_create');
    Route::post('/dashboard/restaurant/price/store', [Restaurant\RestaurantPriceController::class, 'store'])->name('admin_restaurant_price_store');
    Route::get('/dashboard/restaurant/price/show/{id}', [Restaurant\RestaurantPriceController::class, 'show'])->name('admin_restaurant_price_show');
    Route::put('/dashboard/restaurant/price/update/{id}', [Restaurant\RestaurantPriceController::class, 'update'])->name('admin_restaurant_price_update');
    Route::get('/dashboard/restaurant/price/delete/{id}', [Restaurant\RestaurantPriceController::class, 'destroy'])->name('admin_restaurant_price_delete');
});

// RESTAURANT CUISINE
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/cuisine', 'Restaurant\RestaurantCuisineController@index')->name('restaurant_cuisine');
    // Route::get('/admin/restaurant/cuisine/datatable', 'Restaurant\RestaurantCuisineController@datatable')->name('admin_restaurant_cuisine_datatable');
    // Route::get('/admin/restaurant/cuisine/create', 'Restaurant\RestaurantCuisineController@create')->name('admin_restaurant_cuisine_create');
    // Route::post('/admin/restaurant/cuisine/store', 'Restaurant\RestaurantCuisineController@store')->name('admin_restaurant_cuisine_store');
    // Route::get('/admin/restaurant/cuisine/show/{id}', 'Restaurant\RestaurantCuisineController@show')->name('admin_restaurant_cuisine_show');
    // Route::put('/admin/restaurant/cuisine/update/{id}', 'Restaurant\RestaurantCuisineController@update')->name('admin_restaurant_cuisine_update');
    // Route::get('/admin/restaurant/cuisine/delete/{id}', 'Restaurant\RestaurantCuisineController@destroy')->name('admin_restaurant_cuisine_delete');
    Route::get('/dashboard/restaurant/cuisine', [Restaurant\RestaurantCuisineController::class, 'index'])->name('restaurant_cuisine');
    Route::get('/dashboard/restaurant/cuisine/datatable', [Restaurant\RestaurantCuisineController::class, 'datatable'])->name('admin_restaurant_cuisine_datatable');
    Route::get('/dashboard/restaurant/cuisine/create', [Restaurant\RestaurantCuisineController::class, 'create'])->name('admin_restaurant_cuisine_create');
    Route::post('/dashboard/restaurant/cuisine/store', [Restaurant\RestaurantCuisineController::class, 'store'])->name('admin_restaurant_cuisine_store');
    Route::get('/dashboard/restaurant/cuisine/show/{id}', [Restaurant\RestaurantCuisineController::class, 'show'])->name('admin_restaurant_cuisine_show');
    Route::put('/dashboard/restaurant/cuisine/update/{id}', [Restaurant\RestaurantCuisineController::class, 'update'])->name('admin_restaurant_cuisine_update');
    Route::get('/dashboard/restaurant/cuisine/delete/{id}', [Restaurant\RestaurantCuisineController::class, 'destroy'])->name('admin_restaurant_cuisine_delete');
});

// RESTAURANT DISHES
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/dishes', 'Restaurant\RestaurantDishesController@index')->name('restaurant_dishes');
    // Route::get('/admin/restaurant/dishes/datatable', 'Restaurant\RestaurantDishesController@datatable')->name('admin_restaurant_dishes_datatable');
    // Route::get('/admin/restaurant/dishes/create', 'Restaurant\RestaurantDishesController@create')->name('admin_restaurant_dishes_create');
    // Route::post('/admin/restaurant/dishes/store', 'Restaurant\RestaurantDishesController@store')->name('admin_restaurant_dishes_store');
    // Route::get('/admin/restaurant/dishes/show/{id}', 'Restaurant\RestaurantDishesController@show')->name('admin_restaurant_dishes_show');
    // Route::put('/admin/restaurant/dishes/update/{id}', 'Restaurant\RestaurantDishesController@update')->name('admin_restaurant_dishes_update');
    // Route::get('/admin/restaurant/dishes/delete/{id}', 'Restaurant\RestaurantDishesController@destroy')->name('admin_restaurant_dishes_delete');
    Route::get('/dashboard/restaurant/dishes', [Restaurant\RestaurantDishesController::class, 'index'])->name('restaurant_dishes');
    Route::get('/dashboard/restaurant/dishes/datatable', [Restaurant\RestaurantDishesController::class, 'datatable'])->name('admin_restaurant_dishes_datatable');
    Route::get('/dashboard/restaurant/dishes/create', [Restaurant\RestaurantDishesController::class, 'create'])->name('admin_restaurant_dishes_create');
    Route::post('/dashboard/restaurant/dishes/store', [Restaurant\RestaurantDishesController::class, 'store'])->name('admin_restaurant_dishes_store');
    Route::get('/dashboard/restaurant/dishes/show/{id}', [Restaurant\RestaurantDishesController::class, 'show'])->name('admin_restaurant_dishes_show');
    Route::put('/dashboard/restaurant/dishes/update/{id}', [Restaurant\RestaurantDishesController::class, 'update'])->name('admin_restaurant_dishes_update');
    Route::get('/dashboard/restaurant/dishes/delete/{id}', [Restaurant\RestaurantDishesController::class, 'destroy'])->name('admin_restaurant_dishes_delete');
});

// RESTAURANT DIETARY FOOD
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/dietary-food', 'Restaurant\RestaurantDietaryFoodController@index')->name('restaurant_dietary_food');
    // Route::get('/admin/restaurant/dietary-food/datatable', 'Restaurant\RestaurantDietaryFoodController@datatable')->name('admin_restaurant_dietary_food_datatable');
    // Route::get('/admin/restaurant/dietary-food/create', 'Restaurant\RestaurantDietaryFoodController@create')->name('admin_restaurant_dietary_food_create');
    // Route::post('/admin/restaurant/dietary-food/store', 'Restaurant\RestaurantDietaryFoodController@store')->name('admin_restaurant_dietary_food_store');
    // Route::get('/admin/restaurant/dietary-food/show/{id}', 'Restaurant\RestaurantDietaryFoodController@show')->name('admin_restaurant_dietary_food_show');
    // Route::put('/admin/restaurant/dietary-food/update/{id}', 'Restaurant\RestaurantDietaryFoodController@update')->name('admin_restaurant_dietary_food_update');
    // Route::get('/admin/restaurant/dietary-food/delete/{id}', 'Restaurant\RestaurantDietaryFoodController@destroy')->name('admin_restaurant_dietary_food_delete');
    Route::get('/dashboard/restaurant/dietary-food', [Restaurant\RestaurantDietaryFoodController::class, 'index'])->name('restaurant_dietary_food');
    Route::get('/dashboard/restaurant/dietary-food/datatable', [Restaurant\RestaurantDietaryFoodController::class, 'datatable'])->name('admin_restaurant_dietary_food_datatable');
    Route::get('/dashboard/restaurant/dietary-food/create', [Restaurant\RestaurantDietaryFoodController::class, 'create'])->name('admin_restaurant_dietary_food_create');
    Route::post('/dashboard/restaurant/dietary-food/store', [Restaurant\RestaurantDietaryFoodController::class, 'store'])->name('admin_restaurant_dietary_food_store');
    Route::get('/dashboard/restaurant/dietary-food/show/{id}', [Restaurant\RestaurantDietaryFoodController::class, 'show'])->name('admin_restaurant_dietary_food_show');
    Route::put('/dashboard/restaurant/dietary-food/update/{id}', [Restaurant\RestaurantDietaryFoodController::class, 'update'])->name('admin_restaurant_dietary_food_update');
    Route::get('/dashboard/restaurant/dietary-food/delete/{id}', [Restaurant\RestaurantDietaryFoodController::class, 'destroy'])->name('admin_restaurant_dietary_food_delete');
});


// RESTAURANT GOOD FOR
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/restaurant/goodfor', 'Restaurant\RestaurantGoodforController@index')->name('restaurant_goodfor');
    // Route::get('/admin/restaurant/goodfor/datatable', 'Restaurant\RestaurantGoodforController@datatable')->name('admin_restaurant_goodfor_datatable');
    // Route::get('/admin/restaurant/goodfor/create', 'Restaurant\RestaurantGoodforController@create')->name('admin_restaurant_goodfor_create');
    // Route::post('/admin/restaurant/goodfor/store', 'Restaurant\RestaurantGoodforController@store')->name('admin_restaurant_goodfor_store');
    // Route::get('/admin/restaurant/goodfor/show/{id}', 'Restaurant\RestaurantGoodforController@show')->name('admin_restaurant_goodfor_show');
    // Route::put('/admin/restaurant/goodfor/update/{id}', 'Restaurant\RestaurantGoodforController@update')->name('admin_restaurant_goodfor_update');
    // Route::get('/admin/restaurant/goodfor/delete/{id}', 'Restaurant\RestaurantGoodforController@destroy')->name('admin_restaurant_goodfor_delete');
    Route::get('/dashboard/restaurant/goodfor', [Restaurant\RestaurantGoodforController::class, 'index'])->name('restaurant_goodfor');
    Route::get('/dashboard/restaurant/goodfor/datatable', [Restaurant\RestaurantGoodforController::class, 'datatable'])->name('admin_restaurant_goodfor_datatable');
    Route::get('/dashboard/restaurant/goodfor/create', [Restaurant\RestaurantGoodforController::class, 'create'])->name('admin_restaurant_goodfor_create');
    Route::post('/dashboard/restaurant/goodfor/store', [Restaurant\RestaurantGoodforController::class, 'store'])->name('admin_restaurant_goodfor_store');
    Route::get('/dashboard/restaurant/goodfor/show/{id}', [Restaurant\RestaurantGoodforController::class, 'show'])->name('admin_restaurant_goodfor_show');
    Route::put('/dashboard/restaurant/goodfor/update/{id}', [Restaurant\RestaurantGoodforController::class, 'update'])->name('admin_restaurant_goodfor_update');
    Route::get('/dashboard/restaurant/goodfor/delete/{id}', [Restaurant\RestaurantGoodforController::class, 'destroy'])->name('admin_restaurant_goodfor_delete');
});

// RESTAURANT REVIEW
Route::post('/restaurant/review/store', [Restaurant\RestaurantReviewController::class, 'store'])->name('restaurant_review_store');
Route::post('/restaurant/review/delete', [Restaurant\RestaurantReviewController::class, 'destroy'])->name('restaurant_review_delete');
Route::post('/villa/review/store', [VillaReviewController::class, 'store'])->name('villa_review_store');
Route::post('/villa/review/delete', [VillaReviewController::class, 'destroy'])->name('villa_review_delete');
Route::post('/hotel/review/store', [Hotel\HotelReviewController::class, 'store'])->name('hotel_review_store');
Route::post('/hotel/review/delete', [Hotel\HotelReviewController::class, 'destroy'])->name('hotel_review_delete');

//restaurant list
// Route::post('/restaurant-list', 'ViewController@restaurant_list')->name('restaurant_list');
// Route::get('/restaurant-list/video/{id}', 'ViewController@restaurant_video')->name('list-restaurant_video');
// Route::get('/restaurant/video/next', 'ViewController@restaurant_next')->name('restaurant_video_next');
// Route::post('/restaurant-list', 'Restaurant\RestaurantListController@restaurant_list')->name('restaurant_list');
Route::get('/food-list', [Restaurant\RestaurantListController::class, 'restaurant_list'])->name('restaurant_list');
// Route::get('/restaurant/s', 'Restaurant\RestaurantSearchController@index')->name('search_restaurant');
Route::get('/food/search', [Restaurant\FoodSearchController::class, 'index'])->name('search_food');

//RESTAURANT DETAIL
// Route::get('/restaurant/{id}', 'ViewController@restaurant')->name('restaurant');
// Route::get('/restaurant_story/{id}', 'ViewController@restaurant_story')->name('restaurant_story');
// Route::get('/restaurant_story/next/{id}/{id_villa}', 'ViewController@restaurant_story_next')->name('restaurant_story_next');
// Route::get('/restaurant/video/{id}', 'ViewController@det_restaurant_video')->name('restaurant_video');
// Route::get('/restaurant/description/{id}', 'ViewController@restaurant_description')->name('restaurant_description');
// Route::get('/restaurant/menu/{id}', 'ViewController@restaurant_menu')->name('restaurant_menu');
Route::get('/food/{id}', [Restaurant\RestaurantController::class, 'index'])->name('restaurant');
Route::get('/restaurant/map/{id}', [Restaurant\RestaurantListController::class, 'restaurant_map'])->name('restaurant_map');
Route::get('/restaurant/menu/{id}', [Restaurant\RestaurantListController::class, 'restaurant_menu'])->name('restaurant_menu');
Route::get('/restaurant/favorit/{id}', [RestaurantsaveController::class, 'favorit'])->name('restaurant_favorit');
Route::get('/restaurant/video/{id}', [Restaurant\RestaurantListController::class, 'restaurant_video'])->name('restaurant_video');
Route::get('/restaurant/story/{id}', [Restaurant\RestaurantListController::class, 'restaurant_story'])->name('restaurant_story');
// Route::get('/story/next/{id}/{id_villa}', 'ViewController@story_next')->name('story_next');

// things to know restaurant
Route::post('/houserules-activity/post', [Activity\ActivityController::class, 'activity_update_activity_rules'])->name('activity_update_activity_rules');
Route::post('/guessafety-activity/post', [Activity\ActivityController::class, 'activity_update_guest_safety'])->name('activity_update_guest_safety');


Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::post('/restaurant/update/name', [Restaurant\RestaurantListController::class, 'restaurant_update_name'])->name('restaurant_update_name');
    Route::post('/restaurant/update/contact', [Restaurant\RestaurantListController::class, 'restaurant_update_contact'])->name('restaurant_update_contact');
    Route::post('/restaurant/update/location', [Restaurant\RestaurantListController::class, 'restaurant_update_location'])->name('restaurant_update_location');
    Route::post('/restaurant/update/short-description', [Restaurant\RestaurantListController::class, 'restaurant_update_short_description'])->name('restaurant_update_short_description');
    Route::post('/restaurant/update/description', [Restaurant\RestaurantListController::class, 'restaurant_update_description'])->name('restaurant_update_description');
    Route::get('/restaurant/get/time', [Restaurant\RestaurantListController::class, 'restaurant_get_time'])->name('restaurant_get_time');
    Route::post('/restaurant/update/time', [Restaurant\RestaurantListController::class, 'restaurant_update_time'])->name('restaurant_update_time');
    Route::post('/restaurant/update/type', [Restaurant\RestaurantListController::class, 'restaurant_update_type'])->name('restaurant_update_type');
    Route::patch('/restaurant/{id}/update/cancel-request-update-status', [Restaurant\RestaurantController::class, 'cancel_request_update_status'])->name('restaurant_cancel_request_update_status');
    // Route::post('/restaurant/update/story', 'ViewController@villa_update_story')->name('villa_update_story');
    Route::post('/restaurant/photo/store', [Restaurant\RestaurantListController::class, 'restaurant_store_photo'])->name('restaurant_store_photo');
    Route::post('/restaurant/menu/store', [Restaurant\RestaurantListController::class, 'restaurant_store_menu'])->name('restaurant_store_menu');
    Route::post('/restaurant/menu/store_multi', [Restaurant\RestaurantListController::class, 'restaurant_store_menu_multi'])->name('restaurant_store_menu_multi');
    Route::post('/restaurant/story/store', [Restaurant\RestaurantListController::class, 'restaurant_store_story'])->name('restaurant_store_story');
    Route::post('/restaurant/facilities/store', [Restaurant\RestaurantListController::class, 'restaurant_store_facilities'])->name('restaurant_store_facilities');
    Route::post('/restaurant/photo/caption/update', [Restaurant\RestaurantListController::class, 'restaurant_update_caption_photo'])->name('restaurant_update_caption_photo');
    Route::post('/restaurant/photo/tag/update', [Restaurant\RestaurantListController::class, 'restaurant_update_tag_photo'])->name('restaurant_update_tag_photo');
    Route::post('/restaurant/update/image', [Restaurant\RestaurantListController::class, 'restaurant_update_image'])->name('restaurant_update_image');
    Route::post('/restaurant/store/tag', [Restaurant\RestaurantListController::class, 'restaurant_store_tag'])->name('restaurant_store_tag');
    Route::get('/restaurant/{id}/delete/story/{id_story}', [Restaurant\RestaurantListController::class, 'restaurant_delete_story'])->name('restaurant_delete_story');
    Route::get('/restaurant/{id}/delete/image', [Restaurant\RestaurantListController::class, 'restaurant_delete_image'])->name('restaurant_delete_image');
    Route::get('/restaurant/{id}/delete/photo/video/{id_video}', [Restaurant\RestaurantListController::class, 'restaurant_delete_photo_video'])->name('restaurant_delete_photo_video');
    Route::get('/restaurant/{id}/delete/photo/photo/{id_photo}', [Restaurant\RestaurantListController::class, 'restaurant_delete_photo_photo'])->name('restaurant_delete_photo_photo');
    Route::get('/restaurant/{id}/delete/menu/{id_menu}', [Restaurant\RestaurantListController::class, 'restaurant_delete_menu'])->name('restaurant_delete_menu');
});

//-- ACTIVITY ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/things-to-do', 'ActivityController@index')->name('admin_activity');
    // Route::get('/admin/things-to-do/datatable', 'ActivityController@datatable')->name('admin_activity_datatable');
    Route::get('/dashboard/things-to-do', [ActivityController::class, 'index'])->name('admin_activity');
    Route::get('/dashboard/things-to-do/datatable', [ActivityController::class, 'datatable'])->name('admin_activity_datatable');

    Route::get('/dashboard/things-to-do/soft-delete/{id}', [ActivityListingController::class, 'softDestroy'])->name('admin_activity_soft_delete');
    Route::get('/dashboard/things-to-do/restore-delete/{id}', [ActivityListingController::class, 'restoreDestroy'])->name('admin_activity_restore_delete');

    Route::get('/dashboard/things-to-do/trash', [ActivityController::class, 'trash'])->name('admin_activity_trash');
    Route::get('/dashboard/things-to-do/datatabletrash', [ActivityController::class, 'datatableTrash'])->name('admin_activity_datatableTrash');

    // Route::get('/admin/things-to-do/add/continue', 'ActivityController@add_step_continue')->name('activity_add_step_continue');
    // Route::get('/admin/things-to-do/add/one_store', 'ActivityController@add_step_one_store')->name('activity_add_step_one_store');
    // Route::get('/admin/things-to-do/add/two', 'ActivityController@add_step_two')->name('activity_add_step_two');
    // Route::post('/admin/things-to-do/add/two_store', 'ActivityController@add_step_two_store')->name('activity_add_step_two_store');
    // Route::get('/admin/things-to-do/add/three', 'ActivityController@add_step_three')->name('activity_add_step_three');
    // Route::post('/admin/things-to-do/add/three_store', 'ActivityController@add_step_three_store')->name('activity_add_step_three_store');
    // Route::get('/admin/things-to-do/add/four', 'ActivityController@add_step_four')->name('activity_add_step_four');
    // Route::post('/admin/things-to-do/add/four_store', 'ActivityController@add_step_four_store')->name('activity_add_step_four_store');
    // Route::get('/admin/things-to-do/add/five', 'ActivityController@add_step_five')->name('activity_add_step_five');
    // Route::post('/admin/things-to-do/add/five_store', 'ActivityController@add_step_five_store')->name('activity_add_step_five_store');
    // Route::get('/admin/things-to-do/add/six', 'ActivityController@add_step_six')->name('activity_add_step_six');
});

//---- ACTIVITY PRICE ---
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/things-to-do/index_price/{id}', [ActivityController::class, 'index_price'])->name('admin_activity_index_price');
    Route::get('/admin/things-to-do/datatable_price/{id}', [ActivityController::class, 'datatable_price'])->name('admin_activity_datatable_price');
    Route::get('/admin/things-to-do/create_price/{id}', [ActivityController::class, 'create_price'])->name('admin_activity_create_price');
    Route::post('/admin/things-to-do/store_price', [ActivityController::class, 'store_price'])->name('admin_activity_store_price');
    Route::get('/admin/things-to-do/delete_price/{id}', [ActivityController::class, 'destroy_price'])->name('admin_activity_delete_price');
});

//--ACTIVITY GALLERY --
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    Route::get('/admin/things-to-do/create_gallery/{id}', [ActivityController::class, 'create_gallery'])->name('admin_activity_create_gallery');
    Route::post('/admin/things-to-do/store_gallery', [ActivityController::class, 'store_gallery'])->name('admin_activity_store_gallery');
    Route::get('/admin/things-to-do/delete_gallery/{id}', [ActivityController::class, 'destroy_gallery'])->name('admin_activity_delete_gallery');
    Route::get('/admin/things-to-do/delete_video/{id}', [ActivityController::class, 'destroy_video'])->name('admin_activity_delete_video');
});

// ACTIVITY FACILITIES
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/things-to-do/facilities', 'Activity\ActivityFacilitiesController@index')->name('activity_facilities');
    // Route::get('/admin/things-to-do/facilities/datatable', 'Activity\ActivityFacilitiesController@datatable')->name('admin_activity_facilities_datatable');
    // Route::get('/admin/things-to-do/facilities/create', 'Activity\ActivityFacilitiesController@create')->name('admin_activity_facilities_create');
    // Route::post('/admin/things-to-do/facilities/store', 'Activity\ActivityFacilitiesController@store')->name('admin_activity_facilities_store');
    // Route::get('/admin/things-to-do/facilities/show/{id}', 'Activity\ActivityFacilitiesController@show')->name('admin_activity_facilities_show');
    // Route::put('/admin/things-to-do/facilities/update/{id}', 'Activity\ActivityFacilitiesController@update')->name('admin_activity_facilities_update');
    // Route::get('/admin/things-to-do/facilities/delete/{id}', 'Activity\ActivityFacilitiesController@destroy')->name('admin_activity_facilities_delete');
    Route::get('/dashboard/things-to-do/facilities', [Activity\ActivityFacilitiesController::class, 'index'])->name('activity_facilities');
    Route::get('/dashboard/things-to-do/facilities/datatable', [Activity\ActivityFacilitiesController::class, 'datatable'])->name('admin_activity_facilities_datatable');
    Route::get('/dashboard/things-to-do/facilities/create', [Activity\ActivityFacilitiesController::class, 'create'])->name('admin_activity_facilities_create');
    Route::post('/dashboard/things-to-do/facilities/store', [Activity\ActivityFacilitiesController::class, 'store'])->name('admin_activity_facilities_store');
    Route::get('/dashboard/things-to-do/facilities/show/{id}', [Activity\ActivityFacilitiesController::class, 'show'])->name('admin_activity_facilities_show');
    Route::put('/dashboard/things-to-do/facilities/update/{id}', [Activity\ActivityFacilitiesController::class, 'update'])->name('admin_activity_facilities_update');
    Route::get('/dashboard/things-to-do/facilities/delete/{id}', [Activity\ActivityFacilitiesController::class, 'destroy'])->name('admin_activity_facilities_delete');
});

// ACTIVITY CATEGORY
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/things-to-do/category', 'Activity\ActivityCategoryController@index')->name('activity_category');
    // Route::get('/admin/things-to-do/category/datatable', 'Activity\ActivityCategoryController@datatable')->name('admin_activity_category_datatable');
    // Route::get('/admin/things-to-do/category/create', 'Activity\ActivityCategoryController@create')->name('admin_activity_category_create');
    // Route::post('/admin/things-to-do/category/store', 'Activity\ActivityCategoryController@store')->name('admin_activity_category_store');
    // Route::get('/admin/things-to-do/category/show/{id}', 'Activity\ActivityCategoryController@show')->name('admin_activity_category_show');
    // Route::put('/admin/things-to-do/category/update/{id}', 'Activity\ActivityCategoryController@update')->name('admin_activity_category_update');
    // Route::get('/admin/things-to-do/category/delete/{id}', 'Activity\ActivityCategoryController@destroy')->name('admin_activity_category_delete');
    Route::get('/dashboard/things-to-do/category', [Activity\ActivityCategoryController::class, 'index'])->name('activity_category');
    Route::get('/dashboard/things-to-do/category/datatable', [Activity\ActivityCategoryController::class, 'datatable'])->name('admin_activity_category_datatable');
    Route::get('/dashboard/things-to-do/category/create', [Activity\ActivityCategoryController::class, 'create'])->name('admin_activity_category_create');
    Route::post('/dashboard/things-to-do/category/store', [Activity\ActivityCategoryController::class, 'store'])->name('admin_activity_category_store');
    Route::get('/dashboard/things-to-do/category/show/{id}', [Activity\ActivityCategoryController::class, 'show'])->name('admin_activity_category_show');
    Route::put('/dashboard/things-to-do/category/update/{id}', [Activity\ActivityCategoryController::class, 'update'])->name('admin_activity_category_update');
    Route::get('/dashboard/things-to-do/category/delete/{id}', [Activity\ActivityCategoryController::class, 'destroy'])->name('admin_activity_category_delete');
});

// ACTIVITY SUBCATEGORY
Route::middleware(['auth', 'allowedRolesToAccessBackend'])->group(function () {
    // Route::get('/admin/things-to-do/sub-category', 'Activity\ActivitySubcategoryController@index')->name('activity_subcategory');
    // Route::get('/admin/things-to-do/sub-category/datatable', 'Activity\ActivitySubcategoryController@datatable')->name('admin_activity_subcategory_datatable');
    // Route::get('/admin/things-to-do/sub-category/create', 'Activity\ActivitySubcategoryController@create')->name('admin_activity_subcategory_create');
    // Route::post('/admin/things-to-do/sub-category/store', 'Activity\ActivitySubcategoryController@store')->name('admin_activity_subcategory_store');
    // Route::get('/admin/things-to-do/sub-category/show/{id}', 'Activity\ActivitySubcategoryController@show')->name('admin_activity_subcategory_show');
    // Route::put('/admin/things-to-do/sub-category/update/{id}', 'Activity\ActivitySubcategoryController@update')->name('admin_activity_subcategory_update');
    // Route::get('/admin/things-to-do/sub-category/delete/{id}', 'Activity\ActivitySubcategoryController@destroy')->name('admin_activity_subcategory_delete');
    Route::get('/dashboard/things-to-do/sub-category', [Activity\ActivitySubcategoryController::class, 'index'])->name('activity_subcategory');
    Route::get('/dashboard/things-to-do/sub-category/datatable', [Activity\ActivitySubcategoryController::class, 'datatable'])->name('admin_activity_subcategory_datatable');
    Route::get('/dashboard/things-to-do/sub-category/create', [Activity\ActivitySubcategoryController::class, 'create'])->name('admin_activity_subcategory_create');
    Route::post('/dashboard/things-to-do/sub-category/store', [Activity\ActivitySubcategoryController::class, 'store'])->name('admin_activity_subcategory_store');
    Route::get('/dashboard/things-to-do/sub-category/show/{id}', [Activity\ActivitySubcategoryController::class, 'show'])->name('admin_activity_subcategory_show');
    Route::put('/dashboard/things-to-do/sub-category/update/{id}', [Activity\ActivitySubcategoryController::class, 'update'])->name('admin_activity_subcategory_update');
    Route::get('/dashboard/things-to-do/sub-category/delete/{id}', [Activity\ActivitySubcategoryController::class, 'destroy'])->name('admin_activity_subcategory_delete');
});

// ACTIVITY REVIEW
Route::post('/things-to-do/review/store', [Activity\ActivityReviewController::class, 'store'])->name('activity_review_store');
Route::post('/things-to-do/review/delete', [Activity\ActivityReviewController::class, 'destroy'])->name('activity_review_delete');

//activity list
// Route::post('/activity-list', 'ViewController@activity_list')->name('activity_list');
// Route::get('/activity-list/video/{id}', 'ViewController@activity_video')->name('list-activity_video');
// Route::get('/things-to-do/video/next', 'ViewController@activity_next')->name('activity_video_next');
// Route::post('/activity-list', 'Activity\ActivityListController@activity_list')->name('activity_list');
Route::get('/wow-list', [Activity\ActivityListController::class, 'activity_list'])->name('activity_list');
// Route::get('/searchactivity', 'Activity\SearchActivityController@index')->name('search_activity');
// Route::get('/things-to-do/s', 'Activity\ActivitySearchController@index')->name('search_activity');
Route::get('/wow/search', [Activity\WowSearchController::class, 'index'])->name('search_wow');
Route::get('/wow/sub', [Activity\WowSubSearchController::class, 'index'])->name('search_wow_sub');
// Route::get('/filteractivity', 'Activity\ActivityFilterController@filter')->name('filter_activity');
// Route::get('/filteractivity/subcategory', 'Activity\ActivityFilterController@getCategorySubcategory')->name('filter_activity_get_subcategory');

//activity detail
// Route::get('/things-to-do/{id}', 'ViewController@activity')->name('activity');
// Route::get('/activity_story/{id}', 'ViewController@activity_story')->name('activity_story');
// Route::get('/activity_story/next/{id}/{id_villa}', 'ViewController@activity_story_next')->name('activity_story_next');
// Route::get('/things-to-do/video/{id}', 'ViewController@det_activity_vide    o')->name('activity_video');
// Route::get('/things-to-do/description/{id}', 'ViewController@activity_description')->name('activity_description');
// Route::get('/things-to-do/price/{id}', 'ViewController@activity_price')->name('activity_price');
Route::get('/wow/price/{id}/details', [Activity\ActivityPriceController::class, 'index'])->name('activity_price_index');

Route::get('/wow/{id}', [Activity\ActivityController::class, 'index'])->name('activity');

Route::post('/things-to-do/grade/{id}', [Activity\ActivityController::class, 'grade'])->name('activity_update_grade');

Route::get('/things-to-do/map/{id}', [Activity\ActivityListController::class, 'activity_map'])->name('activity_map');
// Route::get('/things-to-do/price/{id}', 'Activity\ActivityListController@activity_price')->name('activity_price');
Route::get('/things-to-do/favorit/{id}', [ActivitysaveController::class, 'favorit'])->name('activity_favorit');
Route::get('/things-to-do/video/{id}', [Activity\ActivityListController::class, 'activity_video'])->name('activity_video');
Route::get('/things-to-do/story/{id}', [Activity\ActivityListController::class, 'activity_story'])->name('activity_story');

// things to know activity
Route::post('/houserules-restaurant/post', [Restaurant\RestaurantController::class, 'restaurant_update_house_rules'])->name('restaurant_update_restaurant_rules');
Route::post('/guessafety-restaurant/post', [Restaurant\RestaurantController::class, 'restaurant_update_guest_safety'])->name('restaurant_update_guest_safety');
Route::patch('/things-to-do/price/update/name', [Activity\ActivityPriceController::class, 'activity_update_name'])->name('activity_price_update_name');
Route::patch('/things-to-do/price/update/short-description', [Activity\ActivityPriceController::class, 'activity_update_short_description'])->name('activity_price_short_description');
Route::patch('/things-to-do/price/update/description', [Activity\ActivityPriceController::class, 'activity_update_description'])->name('activity_price_description');
Route::post('/things-to-do/price/photo/store', [Activity\ActivityPriceController::class, 'activity_store_photo'])->name('activity_price_store_photo');
Route::get('/things-to-do/price/{id}/delete/photo/photo/{id_photo}', [Activity\ActivityPriceController::class, 'activity_delete_photo_photo'])->name('activity_price_delete_photo_photo');
Route::get('/things-to-do/price/{id}/delete/photo/video/{id_video}', [Activity\ActivityPriceController::class, 'activity_delete_photo_video'])->name('activity_price_delete_photo_video');
Route::get('/things-to-do/price/{id}/delete/image', [Activity\ActivityPriceController::class, 'activity_delete_image'])->name('activity_price_delete_image');
Route::patch('/things-to-do/price/update/image', [Activity\ActivityPriceController::class, 'activity_update_image'])->name('activity_price_update_image');
Route::post('/things-to-do/price/story/store', [Activity\ActivityPriceController::class, 'activity_store_story'])->name('activity_price_store_story');
Route::get('/things-to-do/price/{id}/delete/story/{id_story}', [Activity\ActivityPriceController::class, 'activity_delete_story'])->name('activity_price_delete_story');
Route::get('/things-to-do/price/story/{id}', [Activity\ActivityPriceController::class, 'activity_story'])->name('activity_price_story');
Route::patch('/things-to-do/update/price', [Activity\ActivityPriceController::class, 'update_price'])->name('activity_price_update_price');
Route::post('/things-to-do/update/name', [Activity\ActivityListController::class, 'activity_update_name'])->name('activity_update_name');
Route::post('/things-to-do/update/contact', [Activity\ActivityListController::class, 'activity_update_contact'])->name('activity_update_contact');
Route::post('/things-to-do/update/location', [Activity\ActivityListController::class, 'activity_update_location'])->name('activity_update_location');
Route::post('/things-to-do/update/short-description', [Activity\ActivityListController::class, 'activity_update_short_description'])->name('activity_update_short_description');
Route::post('/things-to-do/update/description', [Activity\ActivityListController::class, 'activity_update_description'])->name('activity_update_description');
Route::get('/things-to-do/get/time', [Activity\ActivityListController::class, 'activity_get_time'])->name('activity_get_time');
Route::post('/things-to-do/update/time', [Activity\ActivityListController::class, 'activity_update_time'])->name('activity_update_time');
Route::post('/things-to-do/update/photo/position', [Activity\ActivityListController::class, 'activity_update_position_photo'])->name('activity_update_photo_photo_position');
Route::post('/things-to-do/update/video/position', [Activity\ActivityListController::class, 'activity_update_position_video'])->name('activity_update_photo_video_position');
Route::post('/things-to-do/photo/store', [Activity\ActivityListController::class, 'activity_store_photo'])->name('activity_store_photo');
Route::post('/things-to-do/price/store', [Activity\ActivityListController::class, 'activity_store_price'])->name('activity_store_price');
Route::post('/things-to-do/story/store', [Activity\ActivityListController::class, 'activity_store_story'])->name('activity_store_story');
Route::post('/things-to-do/facilities/store', [Activity\ActivityListController::class, 'activity_store_facilities'])->name('activity_store_facilities');
Route::post('/things-to-do/update/image', [Activity\ActivityListController::class, 'activity_update_image'])->name('activity_update_image');
Route::patch('/things-to-do/{id}/update/cancel-request-update-status', [Activity\ActivityController::class, 'cancel_request_update_status'])->name('activity_cancel_request_update_status');
Route::get('/things-to-do/{id}/delete/story/{id_story}', [Activity\ActivityListController::class, 'activity_delete_story'])->name('activity_delete_story');
// Route::get('/things-to-do/{id}/delete/image', [Activity\ActivityListController::class, 'activity_delete_image'])->name('activity_delete_image');
Route::get('/things-to-do/{id}/delete/photo/video/{id_video}', [Activity\ActivityListController::class, 'activity_delete_photo_video'])->name('activity_delete_photo_video');
Route::get('/things-to-do/{id}/delete/photo/photo/{id_photo}', [Activity\ActivityListController::class, 'activity_delete_photo_photo'])->name('activity_delete_photo_photo');
Route::get('/things-to-do/{id}/delete/price/{id_price}', [Activity\ActivityListController::class, 'activity_delete_price'])->name('activity_delete_price');
Route::post('/things-to-do/subcategory/store', [Activity\ActivityListController::class, 'activity_store_subcategory'])->name('activity_store_subcategory');
Route::post('/things-to-do/photo/caption/update', [Activity\ActivityListController::class, 'activity_update_caption_photo'])->name('activity_update_caption_photo');

// other
Route::get('/villa-video', [ViewController::class, 'list_video'])->name('list_video');
Route::get('/villa-video-list/{id}', [ViewController::class, 'villa_list_video'])->name('list-villa_video_open');

Route::get('/pool_filter/{id}', [ViewController::class, 'get_table'])->name('refresh_table');
// Route::get('kirim-email','MailController@index');

// HOTEL
// Route::post('/hotel-list', 'HotelController@hotel_list')->name('hotel_list');

Route::post('/admin/hotel/store', [Hotel\HotelListingController::class, 'store'])->name('admin_hotel_store');

Route::get('/admin/hotel/update-status/{id}', [Hotel\HotelListingController::class, 'status'])->name('admin_hotel_update_status');
Route::patch('/hotel/{id}/update/cancel-request-update-status', [Hotel\HotelListingController::class, 'cancel_request_update_status'])->name('hotel_cancel_request_update_status');


Route::get('/hotel/search', [Hotel\HotelSearchController::class, 'index'])->name('search_hotel');

Route::post('/hotel/grade/{id}', [Hotel\HotelDetailController::class, 'grade'])->name('hotel_update_grade');

Route::get('/hotel-list', [HotelController::class, 'hotel_list'])->name('hotel_list');
Route::get('/hotel/map/{id}', [Hotel\HotelDetailController::class, 'hotel_map'])->name('hotel_map');
Route::get('/hotel/details/{id}', [Hotel\HotelDetailController::class, 'hotel_details'])->name('hotel_details');
Route::get('/hotel/villa-nearby/{id}', [Hotel\HotelDetailController::class, 'villa_nearby_hotel'])->name('villa_nearby_hotel');
Route::get('/hotel/things-to-do-nearby/{id}', [Hotel\HotelDetailController::class, 'activity_nearby_hotel'])->name('activity_nearby_hotel');
Route::get('/hotel/restaurant-nearby/{id}', [Hotel\HotelDetailController::class, 'restaurant_nearby_hotel'])->name('restaurant_nearby_hotel');
Route::get('/hotel/{id}', [Hotel\HotelDetailController::class, 'hotel'])->name('hotel');
Route::get('/hotel/story/{id}', [Hotel\HotelDetailController::class, 'story'])->name('hotel_story');
Route::get('/hotel/video/open/{id}', [Hotel\HotelDetailController::class, 'video_open'])->name('video_open');
Route::post('/hotel/add-room', [Hotel\HotelDetailController::class, 'store_room'])->name('store_room');

//Hotel Reservations Dashboard
Route::get('/dashboard/hotel/reservations/upcoming', [Hotel\HotelRoomBookingController::class, 'index'])->name('hotel_room_reservations_dashboard');
Route::get('/dashboard/hotel/reservations/upcoming/datatable', [Hotel\HotelRoomBookingController::class, 'datatableUpcoming'])->name('hotel_room_reservations_datatable');

Route::get('/dashboard/hotel/reservations/all', [Hotel\HotelRoomBookingController::class, 'all'])->name('hotel_reservations_all');
Route::get('/dashboard/hotel/reservations/all/datatable', [Hotel\HotelRoomBookingController::class, 'datatableAll'])->name('hotel_reservations_datatable_all');

//Hotel FullCalendar
Route::get('hotel/room/special-price/calendar/{id}', [Hotel\RoomDetailController::class, 'special_price_fullcalendar'])->name('hotel_special_price_fullcalendar');
Route::get('hotel/room/calendar/not_available/{id}', [Hotel\RoomDetailController::class, 'fullcalendar_notavailable'])->name('hotel_room_fullcalendar_notavailable');

//edit from detail frontend
Route::get('/hotel/favorit/{id}', [HotelSaveController::class, 'favorit'])->name('hotel_favorit');
Route::post('/hotel/update/image', [Hotel\HotelDetailController::class, 'hotel_update_image'])->name('hotel_update_image');
Route::get('/hotel/{id}/delete/image', [Hotel\HotelDetailController::class, 'hotel_delete_image'])->name('hotel_delete_image');
Route::post('/hotel/update/bedroom', [Hotel\HotelDetailController::class, 'hotel_update_bedroom'])->name('hotel_update_bedroom');
Route::post('/hotel/update/short-description', [Hotel\HotelDetailController::class, 'hotel_update_short_description'])->name('hotel_update_short_description');
Route::post('/hotel/update/story', [Hotel\HotelDetailController::class, 'hotel_update_story'])->name('hotel_update_story');
Route::get('/hotel/{id}/delete/story/{id_story}', [Hotel\HotelDetailController::class, 'hotel_delete_story'])->name('hotel_delete_story');
Route::post('/hotel/update/description', [Hotel\HotelDetailController::class, 'hotel_update_description'])->name('hotel_update_description');
Route::post('/hotel/update/amenities', [Hotel\HotelDetailController::class, 'hotel_update_amenities'])->name('hotel_update_amenities');
Route::post('/hotel/update/tags', [Hotel\HotelDetailController::class, 'hotel_update_tags'])->name('hotel_update_tags');
Route::post('/hotel/update/category', [Hotel\HotelDetailController::class, 'hotel_update_category'])->name('hotel_update_category');
Route::post('/hotel/update/location', [Hotel\HotelDetailController::class, 'hotel_update_location'])->name('hotel_update_location');
Route::post('/hotel/update/name', [Hotel\HotelDetailController::class, 'hotel_update_name'])->name('hotel_update_name');
Route::post('/hotel/photo/caption/update', [Hotel\HotelDetailController::class, 'hotel_update_caption_photo'])->name('hotel_update_caption_photo');


//HOTEL GALLERY
Route::post('/admin/hotel/store_gallery', [HotelController::class, 'store_gallery'])->name('admin_hotel_store_gallery');
Route::get('/hotel/{id}/delete/photo/photo/{id_photo}', [HotelController::class, 'hotel_delete_photo_photo'])->name('hotel_delete_photo_photo');
Route::get('/hotel/{id}/delete/photo/video/{id_video}', [HotelController::class, 'hotel_delete_photo_video'])->name('hotel_delete_photo_video');
Route::post('/hotel/update/photo/position', [Hotel\HotelDetailController::class, 'update_position_photo'])->name('hotel_photo_edit_position');
Route::post('/hotel/update/video/position', [Hotel\HotelDetailController::class, 'update_position_video'])->name('hotel_video_edit_position');


//Hotel ROOM Booking
Route::post('/hotel/room/confirm/', [Hotel\HotelRoomBookingController::class, 'confirm'])->name('hotel_room_booking_confirm');
Route::post('/hotel/room/confirm/store', [Hotel\HotelRoomBookingController::class, 'booking_store'])->name('hotel_room_booking_store');


//HOTEL ROOM
Route::get('/hotel/room/{id}', [Hotel\RoomDetailController::class, 'room_hotel'])->name('room_hotel');
Route::get('/hotel/room/story/{id}', [Hotel\RoomDetailController::class, 'story'])->name('room_story');
Route::get('/hotel/room/{id}/delete/story/{id_story}', [Hotel\RoomDetailController::class, 'room_delete_story'])->name('room_delete_story');
Route::get('/hotel/room/video/open/{id}', [Hotel\RoomDetailController::class, 'video_open'])->name('room_video_open');
Route::post('/hotel/room/update/name', [Hotel\RoomDetailController::class, 'room_update_name'])->name('room_update_name');

Route::post('/hotel/room/update/image', [Hotel\RoomDetailController::class, 'room_update_image'])->name('room_update_image');
Route::get('/hotel/room/{id}/delete/image', [Hotel\RoomDetailController::class, 'room_delete_image'])->name('room_delete_image');
Route::post('/hotel/room/update/short-description', [Hotel\RoomDetailController::class, 'room_update_short_description'])->name('room_update_short_description');
Route::post('/hotel/room/update/description', [Hotel\RoomDetailController::class, 'room_update_description'])->name('room_update_description');
Route::post('/hotel/room/update/story', [Hotel\RoomDetailController::class, 'room_update_story'])->name('room_update_story');
Route::post('/hotel/room/update/price', [Hotel\RoomDetailController::class, 'room_update_price'])->name('room_update_price');
Route::post('/hotel/room/update/room_size', [Hotel\RoomDetailController::class, 'update_room_size'])->name('update_room_size');
Route::post('/hotel/room/update/amenities', [Hotel\RoomDetailController::class, 'room_update_amenities'])->name('room_update_amenities');
Route::post('/hotel/room/photo/caption/update', [Hotel\RoomDetailController::class, 'room_update_caption_photo'])->name('room_update_caption_photo');

//GET DISABLE DATE ROOM HOTEL
Route::get('/hotel/room/date_disabled/{id}', [Hotel\HotelRoomBookingController::class, 'disabled'])->name('room_disable_date');
Route::post('/hotel/room/update/not_available', [Hotel\RoomDetailController::class, 'room_not_available'])->name('room_not_available');
Route::get('/hotel/room/get_total/{id}', [Hotel\HotelRoomBookingController::class, 'get_total'])->name('get_total');


//HOTEL ROOM GALLERY
Route::post('/admin/hotel/room/store_gallery', [Hotel\RoomDetailController::class, 'store_gallery'])->name('admin_hotel_room_store_gallery');
Route::get('/hotel/room/{id}/delete/photo/photo/{id_photo}', [Hotel\RoomDetailController::class, 'room_delete_photo_photo'])->name('room_delete_photo_photo');
Route::get('/hotel/room/{id}/delete/photo/video/{id_video}', [Hotel\RoomDetailController::class, 'room_delete_photo_video'])->name('room_delete_photo_video');
Route::post('/hotel/room/update/photo/position', [Hotel\RoomDetailController::class, 'update_position_photo'])->name('room_photo_edit_position');
Route::post('/hotel/room/update/video/position', [Hotel\RoomDetailController::class, 'update_position_video'])->name('room_video_edit_position');


//COLABORATOR
Route::get('/collaborator/search', [Collaborator\SearchCollaboratorController::class, 'index'])->name('search_collaborator');
Route::get('/collaborator-list', [Collaborator\CollaboratorController::class, 'collaborator_list'])->name('collaborator_list');
Route::get('/collaborator/{id}', [Collaborator\CollaboratorController::class, 'collaborator'])->name('collaborator');
Route::post('/collaborator/update/image', [Collaborator\CollaboratorController::class, 'collab_update_image'])->name('collab_update_image');
Route::post('/colaborator/update/name', [Collaborator\CollaboratorController::class, 'collab_update_name'])->name('collab_update_name');
Route::post('/colaborator/update/gender', [Collaborator\CollaboratorController::class, 'collab_update_gender'])->name('collab_update_gender');
Route::post('/colaborator/store/category', [Collaborator\CollaboratorController::class, 'collab_store_category'])->name('collab_store_category');
Route::post('/colaborator/update/location', [Collaborator\CollaboratorController::class, 'collab_update_location'])->name('collab_update_location');
Route::post('/colaborator/update/social-media', [Collaborator\CollaboratorController::class, 'collab_update_social_media'])->name('collab_update_social_media');
Route::get('/collab/story/{id}', [Collaborator\CollaboratorController::class, 'collab_story'])->name('collab_story');
Route::post('/collab/update/story', [Collaborator\CollaboratorController::class, 'update_story'])->name('collab_update_story');
Route::get('/collab/{id}/delete/story/{id_story}', [Collaborator\CollaboratorController::class, 'delete_story'])->name('collab_delete_story');
Route::get('/collab/{id}/delete/photo/photo/{id_photo}', [Collaborator\CollaboratorController::class, 'collab_delete_photo_photo'])->name('collab_delete_photo_photo');
Route::get('/collab/{id}/delete/photo/video/{id_video}', [Collaborator\CollaboratorController::class, 'collab_delete_photo_video'])->name('collab_delete_photo_video');
Route::post('/collab/update/description', [Collaborator\CollaboratorController::class, 'update_description'])->name('collab_update_description');
Route::post('/collab/update/language', [Collaborator\CollaboratorController::class, 'update_language'])->name('collab_update_language');
Route::post('/collaborator/update/photo', [Collaborator\CollaboratorController::class, 'collab_update_photo'])->name('collab_update_photo');
Route::get('/collaborator/video/open/{id}', [Collaborator\CollaboratorController::class, 'video_open'])->name('video_open');

Route::patch('/collab/{id}/update/request-update-status', [Collaborator\CollaboratorController::class, 'request_update_status'])->name('collab_request_update_status');
Route::patch('/collab/{id}/update/cancel-request-update-status', [Collaborator\CollaboratorController::class, 'cancel_request_update_status'])->name('collab_cancel_request_update_status');
Route::post('/collab/grade/{id}', [Collaborator\CollaboratorController::class, 'grade'])->name('collab_update_grade');
Route::get('/admin/collab/update-status/{id}', [Collaborator\CollaboratorController::class, 'status'])->name('admin_collab_update_status');

// User Profile
Route::get('/user-profile', [ProfileController::class, 'index'])->name('profile_index');
Route::get('/user-profile/hotels', [ProfileController::class, 'hotels'])->name('profile_hotels');
Route::get('/user-profile/restaurants', [ProfileController::class, 'restaurants'])->name('profile_restaurants');
Route::get('/user-profile/activities', [ProfileController::class, 'activities'])->name('profile_activities');

Route::get('/user-profile-backup', [ProfileController::class, 'index_backup'])->name('profile_index2');
Route::post('/user-profile/{id}', [ProfileController::class, 'update'])->name('profile_update');
Route::get('/reward-program', [ProfileController::class, 'reward_program'])->name('reward_program');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change_password');


//reward system
Route::get('/user/reward', [UserRewardController::class, 'reward_count'])->name('count_reward');

// map
Route::get('/map/by-coordinate-area/restaurant', [Map\LocationByCoordinateAreaController::class, 'restaurant'])->name('map_restaurant_location');
Route::get('/map/by-coordinate-area/restaurant/{id}', [Map\LocationByCoordinateAreaController::class, 'search_restaurant'])->name('map_restaurant_location_search');
Route::get('/map/by-coordinate-area/villa', [Map\LocationByCoordinateAreaController::class, 'villa'])->name('map_villa_location');
Route::get('/map/by-coordinate-area/villa/{id}', [Map\LocationByCoordinateAreaController::class, 'search_villa'])->name('map_villa_location_search');
Route::get('/map/by-coordinate-area/hotel', [Map\LocationByCoordinateAreaController::class, 'hotel'])->name('map_hotel_location');
Route::get('/map/by-coordinate-area/hotel/{id}', [Map\LocationByCoordinateAreaController::class, 'search_hotel'])->name('map_hotel_location_search');
Route::get('/map/by-coordinate-area/activity', [Map\LocationByCoordinateAreaController::class, 'activity'])->name('map_activity_location');
Route::get('/map/by-coordinate-area/activity/{id}', [Map\LocationByCoordinateAreaController::class, 'search_activity'])->name('map_activity_location_search');

// Translate
Route::get('/translate', [Translate\TranslateController::class, 'translate'])->name('translate');
Route::get('/translate-per-part', [Translate\TranslateController::class, 'translatePerGroup'])->name('translate_per_group');

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

// LOCALIZATION
Route::get('en', function () {
    session(['locale' => 'en']);
    return back();
});

Route::get('id', function () {
    session(['locale' => 'id']);
    return back();
});
//SESSION
Route::get('/session/theme', [CookiesController::class, 'set_cookie_theme'])->name('cookie_theme.set');
