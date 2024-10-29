<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    // 投稿編集画面の表示
    public function edit($id)
    {
        $user = \Auth::user();
        $post = Post::findOrFail($id);
        $data = [
            'user' => $user,
            'post' => $post,
        ];
        return view('posts.edit', $data);
    }
}
