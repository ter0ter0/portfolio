<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Activity;

class SearchController extends Controller
{
    // 検索結果
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $tab = $request->input('tab', 'posts');

        $users = null;
        $posts = null;
        $activities = null;
        if ($tab === 'posts'){
            $posts = Post::where('content', 'Like', '%' . $keyword . '%')
                ->orWhereHas('tags', function ($query) use ($keyword) {
                    $query->where('name', 'Like', '%' . $keyword . '%');
                })
                ->paginate(10);
        } elseif ($tab === 'users') {
            $users = User::where('name', 'Like', '%' . $keyword . '%')->paginate(10);
        } else {
            $activities = Activity::where('shop_name', 'Like', '%' . $keyword . '%')->paginate(10);
        }

        $data = [
            'posts' => $posts,
            'users' => $users,
            'activities' => $activities,
            'keyword' => $keyword,
            'tab' => $tab,
        ];

        return view('search.search', $data);
    }
}
