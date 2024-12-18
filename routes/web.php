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
// 活動記録の一覧表示（トップページ）
Route::get('activities', 'PostsController@activities')->name('post.activities');

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
    // ユーザーの活動記録一覧ページ
    Route::get('activities', 'ActivitiesController@userActivities')->name('user.activities');
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
        // ブックマーク一覧ページの取得
        Route::get('bookmark', 'BookmarksController@index')->name('bookmark.index');
    });
    //DBに投稿を保存
    Route::post('', 'PostsController@store')->name('post.store');
    //投稿関係
    Route::prefix('posts/{id}')->group(function(){
        // 投稿編集画面
        Route::get('edit', 'PostsController@edit')->name('post.edit');
        // 投稿編集処理
        Route::put('edit', 'PostsController@update')->name('post.update');
        // 投稿の削除
        Route::delete('', 'PostsController@destroy')->name('post.delete');
        // いいねの登録
        Route::post('favorite', 'FavoritesController@store')->name('post.favorite');
        // いいねの削除
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('post.unfavorite');
        // ブックマーク関係
        Route::prefix('bookmark')->group(function(){
            // ブックマークの登録
            Route::post('', 'BookmarksController@store')->name('bookmark.store');
            // ブックマークの解除
            Route::delete('delete', 'BookmarksController@destroy')->name('bookmark.delete');
        });
        // 返信関係
        Route::prefix('reply')->group(function(){
            // 返信の追加処理
            Route::post('', 'RepliesController@store')->name('reply.store');
            // 返信の編集画面
            Route::get('edit', 'RepliesController@edit')->name('reply.edit');
            // 返信の編集処理
            Route::put('edit', 'RepliesController@update')->name('reply.update');
            // 返信の削除
            Route::delete('delete', 'RepliesController@destroy')->name('reply.delete');
            //返信に対するいいねの登録
            Route::post('favorite', 'ReplyFavoritesController@store')->name('reply.favorite');
            // 返信に対するいいねの削除
            Route::delete('unfavorite', 'ReplyFavoritesController@destroy')->name('reply.unfavorite');
        });
    });
    // 活動記録関係
    Route::prefix('activity')->group(function(){
        // 活動記録の新規登録ページ
        Route::get('create', 'ActivitiesController@create')->name('activity.create');
        // 活動記録の新規登録処理
        Route::post('', 'ActivitiesController@store')->name('activity.store');
        // 活動記録の編集ページ
        Route::get('{id}/edit', 'ActivitiesController@edit')->name('activity.edit');
        // 活動記録の編集処理
        Route::put('{id}', 'ActivitiesController@update')->name('activity.update');
        // 活動記録の削除
        Route::delete('{id}', 'ActivitiesController@destroy')->name('activity.delete');
    });
});
