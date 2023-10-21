<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookAreaController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RoomTypeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index']);


Route::get('/dashboard', function () {
    return view('frontend.user.user-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/edit-profile', [FrontController::class, 'editProfile'])->name('user.edit-profile');
    Route::post('/profile/store', [FrontController::class, 'userStore'])->name('profile.store');
    Route::get('/user-logout', [FrontController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change-paswword', [FrontController::class, 'userChangePassword'])->name('user.change-password');
    Route::post('/password/change/password', [FrontController::class, 'userChangePasswordStore'])->name('user.change-password-store');
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
    Route::post('/admin/booking-area/update', [BookAreaController::class, 'bookAreaUpdate'])->name('admin.book-area-update');
});

//Room Type
Route::controller(RoomTypeController::class)->group(function () {
    Route::get('/admin/room-types', [RoomTypeController::class, 'roomTypeList'])->name('admin.room-list');
});
