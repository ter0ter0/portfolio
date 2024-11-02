<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('welcome', [
            'posts' => $posts,
        ]);
    }

    // 投稿編集画面の表示
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    // 投稿編集処理
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save();
        return redirect()->route('post.index');
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('welcome', [
            'posts' => $posts,
        ]);
    }
    
    // 新規投稿処理
    public function store(PostRequest $request)
    {
        $user = \Auth::user();
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $user->id;
        $post->save();
        return redirect()->back();
    }
}
