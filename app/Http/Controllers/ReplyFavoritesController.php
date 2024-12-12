<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReplyFavoritesController extends Controller
{
    public function store($id)
    {
        \Auth::user()->replyFavorite($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->replyUnFavorite($id);
        return back();
    }
}
