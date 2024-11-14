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
// ユーザーログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザー新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// トップページの表示
Route::get('/', 'PostsController@index')->name('post.index');

Route::group(['prefix' => 'users/{id}'], function(){
    // ユーザー詳細ページの表示
    Route::get('', 'UsersController@show')->name('user.show');
    // フォロワーの表示
    Route::get('followers', 'UsersController@followers')->name('user.followers');
    // フォロー中の表示
    Route::get('followings', 'UsersController@followings')->name('user.followings');
});


// ログイン後（ユーザー編集画面・更新）
Route::group(['middleware' => 'auth'], function(){
    Route::prefix('users/{id}')->group(function(){
        // 編集画面の表示
        Route::get('/edit', 'UsersController@edit')->name('user.edit');
        // 更新の送信
        Route::put('', 'UsersController@update')->name('user.update');
    });
    //DBに投稿を保存
    Route::post('', 'PostsController@store')->name('post.store');
    //投稿関係
    Route::prefix('posts')->group(function(){
        // 投稿編集画面
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        // 投稿編集処理
        Route::put('{id}/edit', 'PostsController@update')->name('post.update');
        // 投稿の削除
        Route::delete('{id}', 'PostsController@destroy')->name('post.delete');
    });
    // フォロー機能
    Route::group(['prefix' => 'users/{id}'], function(){
        Route::post('follow', 'FollowController@store')->name('user.follow');
        Route::delete('unfollow', 'FollowController@destroy')->name('user.unfollow');
    });
    // ユーザー関係
    Route::prefix('users/{id}')->group(function(){
            // ユーザー退会
        Route::delete('', 'UsersController@destroy')->name('user.delete');
    });

    // いいね機能
    Route::group(['prefix' => 'posts/{id}'], function(){
        Route::post('favorite', 'FavoritesController@store')->name('post.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('post.unfavorite');
    });
});
