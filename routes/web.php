<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LogoutController;

use Illuminate\Support\Facades\Auth;

Auth::routes();
//Route::view('/', 'welcome');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/user', [LoginController::class, 'showLoginForm']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/admin/concerts', [App\Http\Controllers\AdminController::class, 'showConcertListing'])->name('adminConcerts');

Route::post('/login/user', [LoginController::class, 'userLogin'])->name('login');
Route::post('/register', [RegisterController::class, 'createUser'])->name('register');


Route::group(['middleware' => 'auth:user'], function () {
    Route::view('/home', 'home');
    Route::view('/admin', 'admin');
    Route::view('/admin/concerts', 'adminConcerts');
    Route::view('/admin/users', 'adminUsers');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
