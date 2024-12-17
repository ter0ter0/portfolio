<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Area;
Use App\Activity;
use App\Http\Requests\ActivityRequest;

class ActivitiesController extends Controller
{
    public function create()
    {
        $areas = Area::all();
        return view('activities.create', ['areas' => $areas]);
    }

    public function store(ActivityRequest $request)
    {
        $user = \Auth::user();
        $activity = new Activity;

        $path = $request->file('image')->store('shop-images', 'public');
        $activity->image = $path;

        $activity->user_id = $user->id;
        $activity->shop_name = $request->shop_name;
        $activity->area_id = $request->area_id;
        $activity->menu_name = $request->menu_name;
        $activity->comment = $request->comment;
        $activity->date = $request->date;
        $activity->save();

        return redirect()->route('post.index')->with('successMessage', '活動を記録しました');
    }
}
