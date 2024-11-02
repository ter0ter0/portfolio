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
