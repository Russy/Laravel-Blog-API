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
    Route::get('/posts', 'PostController@getPosts');
    Route::post('/search', 'PostController@search');

    Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin'], function () {

        Route::put('/admin/page/update', 'PageController@update');
        Route::put('/admin/post/update', 'PostController@update');

        Route::get('/admin/page/{id}', 'PageController@getBySlug');
        Route::get('/admin/pages', 'PageController@getPages');
        Route::get('/admin/post/{id}', 'PostController@getBySlug');
        Route::get('/admin/posts', 'PostController@getPosts');

        Route::put('/admin/tag/update', 'TagController@update');
        Route::get('/admin/tags', 'TagController@get');

        Route::put('/admin/category/update', 'CategoryController@update');
        Route::get('/admin/categories', 'CategoryController@get');

        Route::delete('/admin/category/delete/{id}', 'CategoryController@delete');
        Route::delete('/admin/page/delete/{id}', 'PageController@delete');
        Route::delete('/admin/post/delete/{id}', 'PostController@delete');
        Route::delete('/admin/tag/delete/{id}', 'TagController@delete');

    });

});

