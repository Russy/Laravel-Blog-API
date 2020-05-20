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

    Route::get('/page/{id}', 'PageController@getBySlug');
    Route::get('/pages', 'PageController@getPages');
    Route::get('/post/{id}', 'PostController@getBySlug');
    Route::get('/tags/{tag}', 'PostController@postsByTags');
    Route::get('/posts', 'PostController@getPosts');
    Route::post('/search', 'PostController@search');
    Route::get('/option/{name}', 'OptionsController@get');

    Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin'], function () {
        Route::prefix('admin')->group(function () {

            Route::get('/pages', 'PageController@getPages');
            Route::prefix('page')->group(function () {
                Route::post('/update', 'PageController@update');
                Route::get('/{id}', 'PageController@getById');
                Route::get('/delete/{id}', 'PageController@delete');
            });

            Route::get('/posts', 'PostController@getPosts');
            Route::prefix('post')->group(function () {
                Route::post('/update', 'PostController@update');
                Route::get('/{id}', 'PostController@getById');
                Route::get('/delete/{id}', 'PostController@delete');
            });

            Route::get('/tags', 'TagController@get');
            Route::prefix('tag')->group(function () {
                Route::post('/update', 'TagController@update');
                Route::get('/delete/{id}', 'TagController@delete');

            });

            Route::get('/categories', 'CategoryController@get');
            Route::prefix('category')->group(function () {
                Route::put('/update', 'CategoryController@update');
                Route::get('/delete/{id}', 'CategoryController@delete');
            });

            Route::get('/options', 'OptionsController@list');
            Route::post('/options', 'OptionsController@post');

        });

    });

});

