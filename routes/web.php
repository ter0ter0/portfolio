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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // ログインページ表示
Route::post('login', 'Auth\LoginController@login')->name('login.post'); // ログイン認証
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); // ログアウト

// ユーザー新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// トップページの表示
Route::get('/', 'PostsController@index');
// ユーザー詳細ページの表示
Route::get('/users/{id}', 'UsersController@show')->name('user.show');

//ログイン後
Route::group(['middleware' => 'auth'],function(){ // ログインしている場合以下にアクセスできる。
    Route::prefix('posts')->group(function(){ // アドレスの先頭にpostsを付ける。
        Route::get('', 'PostsController@create')->name('post.create'); // 投稿の新規投稿画面を表示
        Route::post('', 'PostsController@store')->name('post.store'); // DBに投稿を保存
        Route::get('{id}', 'PostsController@destroy')->name('post.delete'); // DBの投稿を削除
    });
});
