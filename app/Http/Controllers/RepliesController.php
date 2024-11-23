<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Reply;
use App\Http\Requests\ReplyRequest;

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

    public function store(ReplyRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = \Auth::user();
        $reply = new Reply;
        $reply->content = $request->content;
        $reply->user_id = $user->id;
        $reply->post_id = $post->id;
        $reply->save();
        return redirect()->back()->with('successMessage', '返信しました');
    }
}
