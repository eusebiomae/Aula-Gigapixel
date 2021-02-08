<?php

use App\Models\UserModel;
use Illuminate\Support\Facades\Route;
use Jose\Component\Core\JWK;
use Jose\Component\Core\JWT;
use Jose\Easy\Build;

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

Route::group([ 'prefix' => 'auth' ], function () {
	Route::post('', 'AuthController@auth');
	Route::get('getOctKey', 'AuthController@getOctKey');
});

Route::group([ 'middleware' => 'JWTApi' ], function () {
	Route::get('', function() {
		return null;
	});

	Route::apiResource('userType', 'UserTypeController');
	Route::apiResource('user', 'UserController');
});
