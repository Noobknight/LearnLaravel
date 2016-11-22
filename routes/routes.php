<?php
/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 15/11/2016
 * Time: 11:30 SA
 */

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('', ['users' => 'UserController@getUsers']);
        Route::get('{id}', ['users' => 'UserController@getUserById']);
    });
});