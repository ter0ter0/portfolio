<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class RepliesController extends Controller
{
    public function index($id)
    {
        $post = Post::findOrFail($id);
        return view('replies.index', [
            'post' => $post,
        ]);
    }
}
