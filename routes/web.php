<?php

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
//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('categories', 'CategoryController');

Route::resource('businesses', 'BusinessController');
Route::get('businesses/{business}/review', 'BusinessController@review')->name('review');

Route::resource('information', 'InformationController');

Route::resource('admins', 'AdminController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::post('admins/{admin}/add_pass', 'AdminController@add_pass')->name('add_pass');

Route::resource('activities', 'ActivityController');