<?php

//Route::view('/', 'welcome');
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UsersController;
use Illuminate\Support\Facades\Auth;
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Route::get('userVerification-resend/{token}', 'UserVerificationController@resend')->name('userVerification.resend');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('frontend.home');
Route::get('/help-center/{name?}/{category?}', 'HomeController@help')->name('help_center');
Route::get('/blogs', 'HomeController@blogs')->name('blogs');
Route::get('/blog/{name}/{id}', 'HomeController@blogs')->name('blog');
Route::get('/contact-us', 'HomeController@contact')->name('contact');
Route::post('/contact-us', 'HomeController@contact')->name('contact');
Route::get('/trips', 'HomeController@trips')->name('trips');
Route::get('/email-verify-now', 'VerificationController@show')->name('email_verification');
Route::get('/verification/verify', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('log-out',function (){
    Auth::logout();
    return redirect()->route('home');
})->name('log-out');
Route::get('/page/{page_name}/{pID}', 'HomeController@page')->name('page_view');
Auth::routes();
Route::get('cities_list/get_by_state', 'Admin\CitiesController@get_by_state')->name('cities.get_by_state');
Route::get('states_list/get_by_country', 'Admin\StatesController@get_by_country')->name('states.get_by_country');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/email-verify-now', 'Auth\VerificationController@show')->name('email_verification');
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {

//    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/newsletter', 'HomeController@newsletter')->name('newsletter');
    Route::get('/newsletter/{do}/{token}', 'HomeController@newsletter')->name('unsubscribe_newsletter');
    Route::get('/trip/{trip_title}/{event}', 'EventsController@trip_view')->name('trip_view');
    //checkout routes
Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout/{step}/{trip}/{room?}', 'checkout_review')->name('checkout_review');
        Route::get('checkout-info/{payment_info?}', 'checkout_userInfo')->name('checkout_info');
        Route::post('checkout-info-update', 'checkout_userInfo_update')->name('checkout_info_update');
        Route::group(['middleware' => ['auth']], function () {
            Route::get('checkout-payment', 'checkout_payment')->name('checkout_payment');
            Route::post('checkout-update-payment', 'checkout_payment_save')->name('checkout_payment_save');
            Route::get('checkout-confirmation', 'checkout_confirm')->name('checkout_confirm');
            Route::post('custom-booking-process', 'custom_order_process')->name('custom_order_process');
            Route::get('booking-complete', 'checkout_complete')->name('checkout_complete');
        });
});
//    After Login
    Route::group(['middleware' => ['auth']], function () {
        Route::controller(UsersController::class)
            ->prefix('account')
            ->as('account.')
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::post('add-payment-method', 'add_payment_method')->name('add_payment_method');
                Route::get('edit-profile', 'edit')->name('edit');
                Route::get('add-favorite', 'favourite')->name('favourite');
                Route::get('update-payment-method/{paymentmethod}/{type?}', 'default_remove_payment')->name('default_remove_payment');
                Route::post('save-profile/{user}', 'update')->name('save');
                Route::post('save/media', 'storeMedia')->name('storeMedia');
            });
        Route::get('custom-trip/{trip_title}/{trip}', 'EventsController@customized_trip')->name('custom_trip');
        Route::get('invoice/{invoice}', 'PaymentsController@invoice')->name('invoice_view');
        Route::post('new-payment/{payment}', 'PaymentsController@trip_balance_payment')->name('trip_balance_payment');
        Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
        Route::resource('testimonials', 'TestimonialController')->only(['store']);
    });
    /*
        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');

        // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

        // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
        Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
        Route::resource('users', 'UsersController');

        // Content Category
        Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
        Route::resource('content-categories', 'ContentCategoryController');

        // Content Tag
        Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
        Route::resource('content-tags', 'ContentTagController');

        // Content Page
        Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
        Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
        Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
        Route::resource('content-pages', 'ContentPageController');

        // Faq Category
        Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
        Route::resource('faq-categories', 'FaqCategoryController');

        // Faq Question
        Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
        Route::resource('faq-questions', 'FaqQuestionController');

        // Blog Category
        Route::delete('blog-categories/destroy', 'BlogCategoryController@massDestroy')->name('blog-categories.massDestroy');
        Route::resource('blog-categories', 'BlogCategoryController');

        // Blog Tag
        Route::delete('blog-tags/destroy', 'BlogTagController@massDestroy')->name('blog-tags.massDestroy');
        Route::resource('blog-tags', 'BlogTagController');

        // Blog Post
        Route::delete('blog-posts/destroy', 'BlogPostController@massDestroy')->name('blog-posts.massDestroy');
        Route::post('blog-posts/media', 'BlogPostController@storeMedia')->name('blog-posts.storeMedia');
        Route::post('blog-posts/ckmedia', 'BlogPostController@storeCKEditorImages')->name('blog-posts.storeCKEditorImages');
        Route::resource('blog-posts', 'BlogPostController');

        // Countries
        Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
        Route::resource('countries', 'CountriesController');

        // States
        Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
        Route::resource('states', 'StatesController');

        // Cities
        Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
        Route::resource('cities', 'CitiesController');

    //    // Admin
    //    Route::delete('admins/destroy', 'AdminController@massDestroy')->name('admins.massDestroy');
    //    Route::resource('admins', 'AdminController');

        // Event Addons
        Route::delete('event-addons/destroy', 'EventAddonsController@massDestroy')->name('event-addons.massDestroy');
        Route::resource('event-addons', 'EventAddonsController');

        // Events
        Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
        Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
        Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
        Route::resource('events', 'EventsController');

        // Costume
        Route::delete('costumes/destroy', 'CostumeController@massDestroy')->name('costumes.massDestroy');
        Route::resource('costumes', 'CostumeController');

        // Costume Attribute
        Route::delete('costume-attributes/destroy', 'CostumeAttributeController@massDestroy')->name('costume-attributes.massDestroy');
        Route::resource('costume-attributes', 'CostumeAttributeController');

        // Event Ticket
        Route::delete('event-tickets/destroy', 'EventTicketController@massDestroy')->name('event-tickets.massDestroy');
        Route::resource('event-tickets', 'EventTicketController');

        // Event Booking
        Route::delete('event-bookings/destroy', 'EventBookingController@massDestroy')->name('event-bookings.massDestroy');
        Route::resource('event-bookings', 'EventBookingController');

        // Traveler
        Route::delete('travelers/destroy', 'TravelerController@massDestroy')->name('travelers.massDestroy');
        Route::resource('travelers', 'TravelerController');

        // Payments
        Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
        Route::resource('payments', 'PaymentsController');

        // Hotels
        Route::delete('hotels/destroy', 'HotelsController@massDestroy')->name('hotels.massDestroy');
        Route::resource('hotels', 'HotelsController');

        // Hotel Rooms
        Route::delete('hotel-rooms/destroy', 'HotelRoomsController@massDestroy')->name('hotel-rooms.massDestroy');
        Route::resource('hotel-rooms', 'HotelRoomsController');

        // Amenities
        Route::delete('amenities/destroy', 'AmenitiesController@massDestroy')->name('amenities.massDestroy');
        Route::post('amenities/media', 'AmenitiesController@storeMedia')->name('amenities.storeMedia');
        Route::post('amenities/ckmedia', 'AmenitiesController@storeCKEditorImages')->name('amenities.storeCKEditorImages');
        Route::resource('amenities', 'AmenitiesController');

        // Setting
        Route::delete('settings/destroy', 'SettingController@massDestroy')->name('settings.massDestroy');
        Route::resource('settings', 'SettingController');

        // Testimonial
        Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
        Route::resource('testimonials', 'TestimonialController');

        // Booking Room
        Route::delete('booking-rooms/destroy', 'BookingRoomController@massDestroy')->name('booking-rooms.massDestroy');
        Route::resource('booking-rooms', 'BookingRoomController');

        // Package Amenities
        Route::delete('package-amenities/destroy', 'PackageAmenitiesController@massDestroy')->name('package-amenities.massDestroy');
        Route::post('package-amenities/media', 'PackageAmenitiesController@storeMedia')->name('package-amenities.storeMedia');
        Route::post('package-amenities/ckmedia', 'PackageAmenitiesController@storeCKEditorImages')->name('package-amenities.storeCKEditorImages');
        Route::resource('package-amenities', 'PackageAmenitiesController');

        Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
        Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
        Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
        Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');*/
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::get('users-export', 'UsersController@export')->name('users.export');
    Route::resource('users', 'UsersController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');
    Route::get('content-pages-export', 'ContentPageController@export')->name('content-pages.export');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Blog Category
    Route::delete('blog-categories/destroy', 'BlogCategoryController@massDestroy')->name('blog-categories.massDestroy');
    Route::resource('blog-categories', 'BlogCategoryController');

    // Blog Tag
    Route::delete('blog-tags/destroy', 'BlogTagController@massDestroy')->name('blog-tags.massDestroy');
    Route::resource('blog-tags', 'BlogTagController');

    // Blog Post
    Route::delete('blog-posts/destroy', 'BlogPostController@massDestroy')->name('blog-posts.massDestroy');
    Route::post('blog-posts/media', 'BlogPostController@storeMedia')->name('blog-posts.storeMedia');
    Route::post('blog-posts/ckmedia', 'BlogPostController@storeCKEditorImages')->name('blog-posts.storeCKEditorImages');
    Route::get('blogs-export', 'BlogPostController@export')->name('blog-posts.export');
    Route::resource('blog-posts', 'BlogPostController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StatesController');
    Route::get('states_list/get_by_country', 'StatesController@get_by_country')->name('states.get_by_country');


    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');
    Route::get('cities_list/get_by_state', 'CitiesController@get_by_state')->name('cities.get_by_state');

    // Admin
    Route::delete('admins/destroy', 'AdminController@massDestroy')->name('admins.massDestroy');
    Route::post('admins/media', 'AdminController@storeMedia')->name('admins.storeMedia');
    Route::post('admins/ckmedia', 'AdminController@storeCKEditorImages')->name('admins.storeCKEditorImages');
    Route::get('admins-export', 'AdminController@export')->name('admins.export');
    Route::resource('admins', 'AdminController');

    // Event Addons
    Route::delete('event-addons/destroy', 'EventAddonsController@massDestroy')->name('event-addons.massDestroy');
    Route::resource('event-addons', 'EventAddonsController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::get('events/room-pricing/{trip}', 'EventsController@event_room_pricing')->name('events.room_pricing');
    Route::post('events/room-pricing/{trip}/update', 'EventsController@event_room_pricing')->name('events.room_pricing_update');
    Route::get('events/installment-pricing/{trip}', 'EventsController@event_installment_pricing')->name('events.installment_pricing');
    Route::post('events/installment-pricing/{trip}/update', 'EventsController@event_installment_pricing')->name('events.installment_pricing_update');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Costume
    Route::delete('costumes/destroy', 'CostumeController@massDestroy')->name('costumes.massDestroy');
    Route::resource('costumes', 'CostumeController');

    // Costume Attribute
    Route::delete('costume-attributes/destroy', 'CostumeAttributeController@massDestroy')->name('costume-attributes.massDestroy');
    Route::resource('costume-attributes', 'CostumeAttributeController');

    // Event Ticket
    Route::delete('event-tickets/destroy', 'EventTicketController@massDestroy')->name('event-tickets.massDestroy');
    Route::resource('event-tickets', 'EventTicketController');

    // Event Booking
    Route::delete('event-bookings/destroy', 'EventBookingController@massDestroy')->name('event-bookings.massDestroy');
    Route::get('event-bookings/new-booking/{trip}', 'EventBookingController@create_booking')->name('event-bookings.create_booking');
    Route::post('event-bookings/new-booking-create', 'EventBookingController@custom_order_process')->name('event-bookings.custom_order_process');
    Route::resource('event-bookings', 'EventBookingController');

    // Traveler
    Route::delete('travelers/destroy', 'TravelerController@massDestroy')->name('travelers.massDestroy');
    Route::resource('travelers', 'TravelerController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // Hotels
    Route::delete('hotels/destroy', 'HotelsController@massDestroy')->name('hotels.massDestroy');
    Route::resource('hotels', 'HotelsController');

    // Hotel Rooms
    Route::delete('hotel-rooms/destroy', 'HotelRoomsController@massDestroy')->name('hotel-rooms.massDestroy');
    Route::post('hotel-rooms/media', 'HotelRoomsController@storeMedia')->name('hotel-rooms.storeMedia');
    Route::post('hotel-rooms/ckmedia', 'HotelRoomsController@storeCKEditorImages')->name('hotel-rooms.storeCKEditorImages');

    Route::resource('hotel-rooms', 'HotelRoomsController');

    // Amenities
    Route::delete('amenities/destroy', 'AmenitiesController@massDestroy')->name('amenities.massDestroy');
    Route::post('amenities/media', 'AmenitiesController@storeMedia')->name('amenities.storeMedia');
    Route::post('amenities/ckmedia', 'AmenitiesController@storeCKEditorImages')->name('amenities.storeCKEditorImages');
    Route::resource('amenities', 'AmenitiesController');

    // Setting
    Route::delete('settings/destroy', 'SettingController@massDestroy')->name('settings.massDestroy');
    Route::put('settings_update/{setting}', 'SettingController@update_single')->name('settings.update_single');
    Route::resource('settings', 'SettingController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::resource('testimonials', 'TestimonialController');
    Route::get('testimonials-export', 'TestimonialController@export')->name('testimonials.export');

    // Booking Room
    Route::delete('booking-rooms/destroy', 'BookingRoomController@massDestroy')->name('booking-rooms.massDestroy');
    Route::resource('booking-rooms', 'BookingRoomController');

    // Package Amenities
    Route::delete('package-amenities/destroy', 'PackageAmenitiesController@massDestroy')->name('package-amenities.massDestroy');
    Route::post('package-amenities/media', 'PackageAmenitiesController@storeMedia')->name('package-amenities.storeMedia');
    Route::post('package-amenities/ckmedia', 'PackageAmenitiesController@storeCKEditorImages')->name('package-amenities.storeCKEditorImages');
    Route::resource('package-amenities', 'PackageAmenitiesController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

