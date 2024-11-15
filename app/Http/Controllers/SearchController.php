<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class SearchController extends Controller
{
    // 検索結果
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $tab = $request->input('tab', 'posts');

        if ($tab === 'posts'){
            $posts = Post::where('content', 'Like', '%' . $keyword . '%')->paginate(10);
            $users = null;
        } else {
            $users = User::where('name', 'Like', '%' . $keyword . '%')->paginate(10);
            $posts = null;
        }

        $data = [
            'posts' => $posts,
            'users' => $users,
            'keyword' => $keyword,
            'tab' => $tab,
        ];

        return view('search.search', $data);
    }
}
