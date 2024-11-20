<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Reply;

class RepliesController extends Controller
{
    public function index($id)
    {
        $post = Post::findOrFail($id);
        $replies = $post->replies()->orderBy('id', 'asc')->paginate(10);
        $data = [
            'post' => $post,
            'replies' => $replies,
        ];
        return view('replies.index', $data);
    }
}
