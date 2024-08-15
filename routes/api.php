<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'headers'], function () {
    Route::get('/countries', 'GuestController@getAllCountries');
    Route::get('/countries/{country}', 'GuestController@getCountry');
    Route::get('/guests', 'GuestController@index');
    Route::post('/guests', 'GuestController@store');
    Route::get('/guests/{guest}', 'GuestController@show');
    Route::patch('/guests/{guest}', 'GuestController@update');
    Route::delete('/guests/{guest}', 'GuestController@delete');
});
