<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Post;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
            'tab' =>'timeline',
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // フォロワーの投稿表示
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers()->paginate(10);
        $data = [
            'user' => $user,
            'followers' => $followers,
            'tab' => 'followers',
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // フォロー中ユーザーの投稿表示
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings()->paginate(10);
        $data = [
            'user' => $user,
            'followings' => $followings,
            'tab' => 'followings',
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === \Auth::id()) {
            $user->delete();
        }
        return redirect()->route('post.index');
    }
}
