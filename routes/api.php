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

Route::post('/signin','API\AuthController@signin');
Route::post('/reset/password', 'API\AuthController@reset');
Route::apiResource('clients', 'API\APIClientsController')->middleware('auth:api');
Route::apiResource('orders', 'API\APIOrdersController')->middleware('auth:api');
Route::apiResource('pizzas', 'API\APIPizzasController')->middleware('auth:api');