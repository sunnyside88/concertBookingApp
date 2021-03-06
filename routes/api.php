<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('concert', [ConcertController::class, 'addConcert']);
Route::get('concertListing', [ConcertController::class, 'getConcertListing']);
Route::get('concert/{id}', [ConcertController::class, 'readConcert']);
Route::put('concert/{id}', [ConcertController::class, 'updateConcert']);
Route::delete('concert/{id}', [ConcertController::class, 'deleteConcert']);

Route::get('userListing', [UserController::class, 'getUserListing']);
Route::delete('user/{id}', [UserController::class, 'deleteUser']);

Route::get('bookingListing', [BookingController::class, 'getBookingListing']);
Route::get('bookingListing/{user_id}', [BookingController::class, 'getBookingsByUserId']);
Route::delete('booking/{id}', [BookingController::class, 'deleteBooking']);
