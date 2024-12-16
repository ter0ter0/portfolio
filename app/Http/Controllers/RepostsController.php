<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\PostRequest;

class RepostsController extends Controller
{
    public function store($postId) 
    {   
        $user = \Auth::User();
        $exist = $user->isRepost($postId);
        $originalPost = Post::findOrFail($postId);
        if (!$exist) {
            $repost = new Post();
            $repost->user_id = $user->id;
            $repost->content = $originalPost->content;
            $repost->repost_id = $originalPost->id;
            $repost->original_post_user_id = $originalPost->user_id;
            $repost->save();
        }
        return redirect()->back();
    }

    public function destroy($postId)
    {
        $user = \Auth::User();
        $repost = Post::where('repost_id', $postId)->where('user_id', $user->id)->first();
        if ($repost){
            $repost->delete();
        }
        return back();
    }
}
