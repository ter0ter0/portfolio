<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Post;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('users.show', $data);
    }

    // フォロワーの投稿表示
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followerIds = $user->followers()->pluck('users.id');
        $posts = Post::whereIn('user_id', $followerIds)->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('users.show', $data);
    }

    // フォロー中ユーザーの投稿表示
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followingIds = $user->followings()->pluck('users.id');
        $posts = Post::whereIn('user_id', $followingIds)->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('users.show', $data);
    }
}
