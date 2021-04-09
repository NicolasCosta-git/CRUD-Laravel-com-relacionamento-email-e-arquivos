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
Route::get('/pizzeria','PizzeriaController@index')->middleware('auth')->name('pizzeria');
Route::resource('pizzas', 'PizzasController')->middleware('auth');
Route::resource('clients', 'ClientsController')->middleware('auth');
Route::resource('orders', 'OrdersController')->middleware('auth');