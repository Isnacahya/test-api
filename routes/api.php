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

Route::get('data', 'ApiController@getAllData')->name('data');
Route::get('data/{orderId}', 'ApiController@getData');
Route::post('data', 'ApiController@createData');
Route::put('data/{orderId}', 'ApiController@updateData');
Route::delete('data/{orderId}', 'ApiController@deleteData');
Route::get('order', 'ApiController@getAllOrder');
