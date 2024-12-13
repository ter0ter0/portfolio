<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;

class BookmarksController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== \Auth::id()) {
            abort(403, 'このページにアクセスする権限がありません。');
        }
        $posts = $user->bookmarks()->orderBy('id', 'desc')->paginate(10);
        return view('bookmark.index', ['posts' => $posts]);
    }

    public function store($id)
    {
        \Auth::user()->bookmark($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unbookmark($id);
        return back();
    }
}
