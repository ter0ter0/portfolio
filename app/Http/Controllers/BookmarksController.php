<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
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
