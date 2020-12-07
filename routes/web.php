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


Route::prefix('panel')->group(function () {


	Route::prefix('login')->group(function () {

		Route::post('', 'App\Http\Controllers\Panel\LoginController@login');
		Route::get('', 'App\Http\Controllers\Panel\LoginController@form')->name('panel.login');
		Route::get('logout', 'App\Http\Controllers\Panel\LoginController@logout');
	});



	Route::group([ 'middleware' => 'auth' ], function() {
		Route::get('', '\App\Http\Controllers\Panel\HomeController@list');

		Route::prefix('user')->group(function () {
			Route::get('', 'App\Http\Controllers\Panel\UserController@list');
			Route::get('insert', 'App\Http\Controllers\Panel\UserController@form');
			Route::get('update/{id}', 'App\Http\Controllers\Panel\UserController@form');
			Route::post('save', 'App\Http\Controllers\Panel\UserController@save');
			Route::get('delete/{id}', 'App\Http\Controllers\Panel\UserController@delete');
			Route::get('restore/{id}', 'App\Http\Controllers\Panel\UserController@restore');
		});

		Route::prefix('user_type')->group(function () {
			Route::get('', 'App\Http\Controllers\Panel\UserTypeController@list');
			Route::get('insert', 'App\Http\Controllers\Panel\UserTypeController@form');
			Route::get('update/{id}', 'App\Http\Controllers\Panel\UserTypeController@form');
			Route::post('save', 'App\Http\Controllers\Panel\UserTypeController@save');
			Route::get('delete/{id}', 'App\Http\Controllers\Panel\UserTypeController@delete');
			Route::get('restore/{id}', 'App\Http\Controllers\Panel\UserTypeController@restore');
		});
	});

});
