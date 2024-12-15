<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tag;
use App\Activity;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        $topPosts = $this->mostFavorite();
        $data = [
            'posts' => $posts,
            'topPosts' => $topPosts,
            'tab' => 'posts'
        ];
        return view('welcome', $data);
    }

    // 活動記録の一覧表示
    public function activities()
    {
        $activities = Activity::orderBy('id','desc')->paginate(10);
        $topPosts = $this->mostFavorite();
        return view('welcome', [
            'activities' => $activities,
            'topPosts' => $topPosts,
            'tab' => 'activities'
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

        // タグの処理
        if (!empty($request->tags)) {
            $tags = collect(explode(',', $request->tags))->map(fn($tag) => trim($tag))->filter()->unique();

            $tagIds = $tags->map(function ($tagName) {
                return Tag::firstOrCreate(['name' => $tagName])->id;
            });

            $post->tags()->sync($tagIds); // 中間テーブルを更新
        }

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

    public function mostFavorite()
    {
        return Post::withCount('favoriteUsers')
        ->whereHas('favoriteUsers')
        ->orderBy('favorite_users_count', 'desc')
        ->paginate(5);
    }

}
