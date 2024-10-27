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

// トップページの表示
Route::get('/', 'PostsController@index');
// ユーザー詳細ページの表示
Route::get('/users/{id}', 'UsersController@show')->name('user.show');
