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


Route::namespace('Api')->group(function () {
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::put('/page/update', 'PageController@update');
        Route::get('/page/{id}', 'PageController@getBySlug');
        Route::get('/pages', 'PageController@getPages');

        Route::put('/post/update', 'PostController@update');
        Route::get('/post/{id}', 'PostController@getBySlug');
        Route::get('/posts', 'PostController@getPosts');
    });

});

