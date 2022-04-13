<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/user', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');


Route::post('/login/user', [LoginController::class, 'userLogin']);
Route::post('/register', [RegisterController::class, 'createUser']);

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/concerts', [App\Http\Controllers\AdminController::class, 'showConcertListing'])->name('adminConcerts');

    Route::get('/home', [ConcertController::class, 'index'])->name('home');
    Route::get('/booking/{concert_id}', [ConcertController::class, 'bookingConcertInfo']);
    Route::post('/booking/{concert_id}', [BookingController::class, 'makeBooking']);

    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'showUserListing']);

    Route::get('/user', [UserController::class, 'profile'])->name('profile');
    Route::get('/user/history', [App\Http\Controllers\BookingController::class, 'showBookingListing']);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
