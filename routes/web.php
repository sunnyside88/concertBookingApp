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
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('can:isAdmin')->name('admin');
    Route::get('/admin/concerts', [App\Http\Controllers\AdminController::class, 'showConcertListing'])->middleware('can:isAdmin')->name('adminConcerts');

    Route::get('/home', [ConcertController::class, 'index'])->name('home')->middleware('can:isUser');
    Route::get('/booking/{concert_id}', [ConcertController::class, 'bookingConcertInfo'])->middleware('can:isUser');
    Route::post('/booking/{concert_id}', [BookingController::class, 'makeBooking'])->middleware('can:isUser');

    Route::get('/admin/users', [UserController::class, 'index'])->middleware('can:isAdmin')->middleware('can:isUser');
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'showUserListing'])->middleware('can:isAdmin');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
