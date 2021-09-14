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
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::post('/d', 'DevicesController@store');
Route::get('/a/{id}', 'ApplicationsController@show');
Route::get('/d/{id}', 'DevicesController@show');
Route::get('/u/{id}', 'UsersController@show');
Route::post('/a/{id}', 'ApplicationsController@destroy');
Route::POST('/d/{id}', 'DevicesController@destroy');
Route::post('/a', 'ApplicationsController@store');
Route::post('/u', 'RegisterController@store');
Route::post('/aEdit/{id}', 'ApplicationsController@edit');
Route::put('/d/{id}', 'DevicesController@edit');
Route::post('/u/{id}', 'UsersController@destroy');



