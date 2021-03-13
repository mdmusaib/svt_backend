<?php

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

Route::get('getBookings','BookingController@index');
Route::get('getVehicle','VehicleController@index');

Route::post('addBooking','BookingController@create');
Route::get('getBooking/{id}','BookingController@show');
Route::post('updateBooking/{id}','BookingController@update');
// Route::delete('address/{id}','AddressController@delete');

Route::post('updateVehicle','VehicleController@update');