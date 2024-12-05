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

// タグのリンク先の表示
Route::get('/tags/{id}', 'TagsController@show')->name('tag.show');

//検索機能
Route::prefix('search')->group(function(){
    Route::get('', 'SearchController@search')->name('search');
});

Route::prefix('users/{id}')->group(function(){
    // ユーザー詳細ページの表示
    Route::get('', 'UsersController@show')->name('user.show');
    // フォロワーの表示
    Route::get('followers', 'UsersController@followers')->name('user.followers');
    // フォロー中の表示
    Route::get('followings', 'UsersController@followings')->name('user.followings');
});

// 返信ページの表示
Route::get('posts/{id}/reply', 'RepliesController@index')->name('reply.index');

// ログイン後（ユーザー編集画面・更新）
Route::group(['middleware' => 'auth'], function(){
    Route::prefix('users/{id}')->group(function(){
        // 編集画面の表示
        Route::get('/edit', 'UsersController@edit')->name('user.edit');
        // 更新の送信
        Route::put('', 'UsersController@update')->name('user.update');
        // ユーザー退会
        Route::delete('', 'UsersController@destroy')->name('user.delete');
        // フォロー追加
        Route::post('follow', 'FollowController@store')->name('user.follow');
        // フォロー解除
        Route::delete('unfollow', 'FollowController@destroy')->name('user.unfollow');
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

        // 返信関係
        Route::prefix('{id}/reply')->group(function(){
            // 返信の追加処理
            Route::post('', 'RepliesController@store')->name('reply.store');
            // 返信の編集画面
            Route::get('edit', 'RepliesController@edit')->name('reply.edit');
            // 返信の編集処理
            Route::put('edit', 'RepliesController@update')->name('reply.update');
            // 返信の削除
            Route::delete('delete', 'RepliesController@destroy')->name('reply.delete');
        });
    });
    // いいね機能
    Route::group(['prefix' => 'posts/{id}'], function(){
        Route::post('favorite', 'FavoritesController@store')->name('post.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('post.unfavorite');
    });
});
