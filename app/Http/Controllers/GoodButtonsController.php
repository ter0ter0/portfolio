<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodButtonsController extends Controller
{
    public function store($id)
    {
        \Auth::user()->goodButton($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unGoodButton($id);
        return back();
    }
}
