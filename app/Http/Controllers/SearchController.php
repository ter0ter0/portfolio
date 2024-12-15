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

        $users = null;
        $posts = null;
        if ($tab === 'posts'){
            $posts = Post::where('content', 'Like', '%' . $keyword . '%')->paginate(10);
        } else {
            $users = User::where('name', 'Like', '%' . $keyword . '%')->paginate(10);
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
