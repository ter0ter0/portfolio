<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'tag' => $tag,
            'posts' => $posts,
        ];
        return view('tags.show', $data);
    }
}
