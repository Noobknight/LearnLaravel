<?php

use Illuminate\Http\Request;
use App\Http\Controllers;

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

Route::get('getUsers/', 'UserController@getListUsers');
Route::get('getUserProperties/', 'UserController@getProperties');
Route::get('getDetailProperty/', 'UserController@getDetailProperty');
Route::get('getUserById/', 'UserController@getUserById');
Route::get('/', 'UserController@getUserById');
Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function () {
    Route::post('/auth/login', 'Auth\AuthController@authenticate');
    Route::get('/auth/getToken', 'Auth\AuthController@getAuthenticatedUser');
});
