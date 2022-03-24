<?php

use App\Http\Controllers\AdminController;
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

Route::post('concert', [AdminController::class, 'addConcert']);
Route::get('concertListing', [AdminController::class, 'getConcertListing']);
Route::put('concert/{id}', [AdminController::class, 'updateConcert']);
Route::delete('concert/{id}', [AdminController::class, 'deleteConcert']);
