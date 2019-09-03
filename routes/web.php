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

Auth::routes();

Route::get('/', 'PostController@index')->name('posts.list');

Route::get('/posts/{slug}', 'PostController@showBySlug')
    ->where('slug', '[A-Za-z0-9-]+')
    ->name('posts.post_link');

Route::get('/p/{id}', 'PostController@show')
    ->where('id', '[0-9]+')
    ->name('posts.post_short_link');

Route::post('/comments/store', 'CommentController@store')->name('comments.store');


Route::group([
    'middleware' => 'dashboard',
    'prefix' => 'dashboard',
    ], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        
        Route::get('posts', 'Dashboard\PostController@index')->name('dashboard.posts');
    });
