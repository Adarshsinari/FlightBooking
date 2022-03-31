<?php

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

Route::get('flight_data/{id}', 'App\Http\Controllers\FlightRestAPIController@show');
Route::post('flight_data', 'App\Http\Controllers\FlightRestAPIController@store');
Route::put('flight_data/{id}', 'App\Http\Controllers\FlightRestAPIController@update');
Route::delete('flight_data/{id}', 'App\Http\Controllers\FlightRestAPIController@delete');
Route::fallback(function () {
    return response()->json(['message' => 'Route Not Found!'], 404);
});
