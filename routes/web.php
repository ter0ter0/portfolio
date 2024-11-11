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
Route::get('login','Auth\LoginController@showLoginForm')->name('login'); // ログインページ表示
Route::post('login','Auth\LoginController@login')->name('login.post'); // ログイン認証
Route::get('logout','Auth\LoginController@logout')->name('logout'); // ログアウト

// ユーザー新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// トップページの表示
Route::get('/', 'PostsController@index')->name('post.index');
// ユーザー詳細ページの表示
Route::get('/users/{id}', 'UsersController@show')->name('user.show');


// ログイン後（ユーザー編集画面・更新）
Route::group(['middleware' => 'auth'], function(){
    Route::prefix('users/{id}')->group(function(){
        // 編集画面の表示
        Route::get('/edit', 'UsersController@edit')->name('user.edit');
        // 更新の送信
        Route::put('', 'UsersController@update')->name('user.update');
    });
            //投稿関係
    Route::prefix('posts')->group(function(){
        // 投稿編集画面
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        // 投稿編集処理
        Route::put('{id}/edit', 'PostsController@update')->name('post.update');
    });
});