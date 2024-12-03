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

    // 返信編集画面の表示
    public function edit($id)
    {
        $reply = Reply::findOrFail($id);
        $user = \Auth::user();

        if ($user->id !== $reply->user_id) {
            abort(403);
        }

        return view('replies.edit', ['reply' => $reply]);
    }

    // 返信の編集処理
    public function update(ReplyRequest $request, $id)
    {
        $reply = Reply::findOrFail($id);
        $reply->content = $request->content;
        $reply->save();
        return redirect()->route('reply.index', $reply->post->id)->with('successMessage', '返信内容を更新しました');
    }

    // 返信の削除
    public function destroy(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);
        if ($reply->user_id === \Auth::id()){
            $reply->delete();
        }
        return back()->with('alertMessage', '返信を削除しました');
    }
}
