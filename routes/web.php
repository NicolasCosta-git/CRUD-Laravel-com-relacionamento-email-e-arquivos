<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pizzeria', 'PizzeriaController@index')->middleware('auth')->name('pizzeria');
Route::group(['middleware' => ['role:super_administrador']], function () {
    Route::resource('clients', 'ClientsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('pizzas', 'PizzasController');
});
Route::resource('orders', 'OrdersController')->only(['index','show']);
Route::resource('pizzas', 'PizzasController')->only(['index','show']);