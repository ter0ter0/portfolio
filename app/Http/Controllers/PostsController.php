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
        $topPosts = Post::withMostFavorite(10)->get();
        return view('welcome', ['posts' => $posts, 'topPosts' => $topPosts]);
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
        return redirect()->route('post.index')->with('successMessage', '投稿内容を更新しました');
    }
    
    // 新規投稿処理
    public function store(PostRequest $request)
    {
        $user = \Auth::user();
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $user->id;
        $post->save();
        return redirect()->back()->with('successMessage', '投稿しました');
    }

    // 投稿の削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id === \Auth::id()){
            $post->delete();
        }
        return back()->with('alertMessage', '投稿を削除しました');
    }
}
