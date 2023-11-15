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

Route::get('/', [FrontController::class, 'index']);
Route::get('/show-all-room', [FrontController::class, 'showAllRoom'])->name('frontend.show.all.room');
Route::get('/show-room/{room}', [FrontController::class, 'showRoom'])->name('frontend.show.room');



Route::get('/dashboard', function () {
    return view('frontend.user.user-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/edit-profile', [FrontController::class, 'editProfile'])->name('user.edit-profile');
    Route::post('/profile/store', [FrontController::class, 'userStore'])->name('profile.store');
    Route::get('/user-logout', [FrontController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change-paswword', [FrontController::class, 'userChangePassword'])->name('user.change-password');
    Route::post('/password/change/password', [FrontController::class, 'userChangePasswordStore'])->name('user.change-password-store');
    Route::get('/testimonials-create', [TestimonialsController::class, 'createTestimonials'])->name('testimonials.create');
    Route::post('/testimonials-store', [TestimonialsController::class, 'storeTestimonials'])->name('testimonials.store');
});

require __DIR__ . '/auth.php';

//Admin group
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
});


//Booking Area
Route::controller(BookAreaController::class)->group(function () {
    Route::get('/admin/booking-area', [BookAreaController::class, 'createBookArea'])->name('admin.book-area');
    Route::post('/admin/booking-area/store', [BookAreaController::class, 'storeBookArea'])->name('admin.book-area-store');
    Route::post('/admin/booking-area/update', [BookAreaController::class, 'bookAreaUpdate'])->name('admin.book-area-update');
});

//Room Type
Route::controller(RoomTypeController::class)->group(function () {
    Route::get('/admin/room-types/list', [RoomTypeController::class, 'roomTypeList'])->name('admin.room-list');
    Route::get('/admin/room-types', [RoomTypeController::class, 'addRoomType'])->name('admin.add-room-type');
    Route::post('/admin/room-types/store', [RoomTypeController::class, 'roomTypeStore'])->name('admin.room-type-store');
    Route::get('/admin/room-types/edit/{roomType}', [RoomTypeController::class, 'roomTypeEdit'])->name('admin.room-type-edit');
    Route::post('/admin/room-types/update/{roomType}', [RoomTypeController::class, 'roomTypeUpdate'])->name('admin.room-type-update');
    Route::delete('/delete/{roomType}', [RoomTypeController::class, 'destroy'])->name('admin.room-type-delete');
});

// Create Room
Route::controller(RoomController::class)->group(function () {
    Route::get('/admin/room-type/{roomType}/rooms', 'roomIndexList')->name('admin.room-type.rooms');
    Route::get('/admin/create-room', [RoomController::class, 'createRoom'])->name('admin.create-room');
    Route::post('/admin/room/store', [RoomController::class, 'roomStore'])->name('admin.room-store');
    Route::get('/admin/edit/{room}', [RoomController::class, 'roomEdit'])->name('admin.room-edit');
    // Route::post('/admin/update/{room}', [RoomController::class, 'roomUpdate'])->name('admin.room-update');
    Route::post('/admin/update/{room}', [RoomController::class, 'roomUpdate'])->name('admin.room-update');

    Route::delete('/delete-room/{room}', [RoomController::class, 'destroy'])->name('admin.room-delete');
    Route::delete('/delete-photo/{photo}', [RoomController::class, 'destroyPhoto'])->name('admin.delete-photo');
    Route::get('/admin/room-number/{room}/', 'roomNumberList')->name('admin.room-number-list');
});


// Booking Search
Route::controller(FrontController::class)->group(function () {
    Route::get('/bookings', 'bookingSearch')->name('booking.search');
    Route::get('/check-room-availability', 'checkRoomAvailability')->name('check.room.availability');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(BookingController::class)->group(function () {
        Route::get('/make-reservation/{room}', 'makeReservation')->name('frontend.reservation');
        Route::get('/booking-store', 'reservationStore')->name('frontend.reservation.store');
        Route::post('/payment-store/{room}', 'paymentStore')->name('frontend.payment.store');
        // Route::match(['get', 'post'], '/stripe_pay', [BookingController::class, 'stripe_pay'])->name('stripe_pay');
    });
});
