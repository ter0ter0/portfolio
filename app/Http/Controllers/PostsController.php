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
        return view('welcome');
    }

    public function create() 
    {
        $user = \Auth::user(); // ログイン認証
        $posts = $user->posts()->orderby('id','desc')->paginate(10); // 投稿をidの降順で10個まで表示
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('posts.posts',$data); // ビューへ渡す
    }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return back();
    }
}
