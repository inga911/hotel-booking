<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookAreaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomListController;
use App\Http\Controllers\SettingController;
use App\Models\Testimonials;

Route::get('/', [FrontController::class, 'index']);
Route::get('/show-all-room', [FrontController::class, 'showAllRoom'])->name('frontend.show.all.room');
Route::get('/show-room/{room}', [FrontController::class, 'showRoom'])->name('frontend.show.room');
//Contact
Route::get('/contact', [FrontController::class, 'contact'])->name('frontend.contact');
Route::post('/store-contact', [FrontController::class, 'storeContact'])->name('frontend.store.contact');


// Booking Search
Route::controller(FrontController::class)->group(function () {
    Route::get('/bookings', 'bookingSearch')->name('booking.search');
    Route::get('/check-room-availability', 'checkRoomAvailability')->name('check.room.availability');
});

//USER SIDE
Route::get('/booking-details', function () {
    return view('frontend.user.reservations-details');
})->middleware(['auth', 'verified'])->name('user.reservations-details');

Route::middleware('auth')->group(function () {
    Route::get('/edit-profile', [FrontController::class, 'editProfile'])->name('user.edit-profile');
    Route::post('/profile/store', [FrontController::class, 'userStore'])->name('profile.store');
    Route::get('/user-logout', [FrontController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change-paswword', [FrontController::class, 'userChangePassword'])->name('user.change-password');
    Route::post('/password/change/password', [FrontController::class, 'userChangePasswordStore'])->name('user.change-password-store');

    //User booking
    Route::get('/booking-details', [BookingController::class, 'userBooking'])->name('user.reservations-details');
    Route::get('/user-invoice/{id}', [BookingController::class, 'userInvoice'])->name('user.invoice');


    // //Testimonials 
    // Route::get('/testimonials-create', [TestimonialsController::class, 'createTestimonials'])->name('testimonials.create');
    // Route::post('/testimonials-store', [TestimonialsController::class, 'storeTestimonials'])->name('testimonials.store');
});
//Reservation
Route::middleware(['auth'])->group(function () {
    Route::controller(BookingController::class)->group(function () {
        Route::get('/make-reservation/{room}', 'makeReservation')->name('frontend.reservation');
        Route::get('/booking-store', 'reservationStore')->name('frontend.reservation.store');
        Route::post('/payment-store/{room}', 'paymentStore')->name('frontend.payment.store');
        // Route::match(['get', 'post'], '/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');
    });
});


require __DIR__ . '/auth.php';

//ADMIN SIDE
Route::middleware(['auth', 'roles:admin'])->group(function () {
    //Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');

    // Booking Area routes
    Route::get('/admin/booking-area', [BookAreaController::class, 'createBookArea'])->name('admin.book-area');
    Route::post('/admin/booking-area/store', [BookAreaController::class, 'storeBookArea'])->name('admin.book-area-store');
    Route::post('/admin/booking-area/update', [BookAreaController::class, 'bookAreaUpdate'])->name('admin.book-area-update');

    // Room Types routes
    Route::get('/admin/room-types/list', [RoomTypeController::class, 'roomTypeList'])->name('admin.room-type-list');
    Route::get('/admin/room-types', [RoomTypeController::class, 'addRoomType'])->name('admin.add-room-type');
    Route::post('/admin/room-types/store', [RoomTypeController::class, 'roomTypeStore'])->name('admin.room-type-store');
    Route::get('/admin/room-types/edit/{roomType}', [RoomTypeController::class, 'roomTypeEdit'])->name('admin.room-type-edit');
    Route::post('/admin/room-types/update/{roomType}', [RoomTypeController::class, 'roomTypeUpdate'])->name('admin.room-type-update');
    Route::delete('/delete/{roomType}', [RoomTypeController::class, 'destroy'])->name('admin.room-type-delete');

    // Room routes
    Route::get('/admin/room-type/{roomType}/rooms', [RoomController::class, 'roomIndexList'])->name('admin.room-type.rooms');
    Route::get('/admin/create-room', [RoomController::class, 'createRoom'])->name('admin.create-room');
    Route::post('/admin/room/store', [RoomController::class, 'roomStore'])->name('admin.room-store');
    Route::get('/admin/edit/{room}', [RoomController::class, 'roomEdit'])->name('admin.room-edit');
    Route::post('/admin/update/{room}', [RoomController::class, 'roomUpdate'])->name('admin.room-update');
    Route::delete('/delete-room/{room}', [RoomController::class, 'destroy'])->name('admin.room-delete');
    Route::delete('/delete-photo/{photo}', [RoomController::class, 'destroyPhoto'])->name('admin.delete-photo');

    //Booking List
    Route::get('/booking/list', [BookingController::class, 'bookingList'])->name('admin.booking-list');
    Route::get('/booking/edit/{id}', [BookingController::class, 'bookingEdit'])->name('admin.booking-edit');

    //Booking Edit/Update
    Route::post('/update/booking/status/{id}', [BookingController::class, 'updateBookingStatus'])->name('admin.update-booking-status');
    Route::post('/update/booking/check-in-out/{id}', [BookingController::class, 'updateCheckInOut'])->name('admin.update-check-in-out');


    //Room List 
    Route::get('/view-room-list', [RoomListController::class, 'viewRoomList'])->name('admin.booked-room-list');

    //Settings(.env)
    Route::get('/smtp-setting', [SettingController::class, 'smtpSetting'])->name('admin.smtp-setting');
    Route::post('/smtp-update', [SettingController::class, 'smtpUpdate'])->name('admin.smtp-update');

    //Contacts request
    Route::get('/request-message', [AdminController::class, 'requestMessage'])->name('admin.request-message');
});

// //Notification
// Route::controller(BookingController::class)->group(function () {
//     Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
// });
