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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('shop-images', 'public');
            $activity->image = $path;
        }

        $activity->user_id = $user->id;
        $activity->shopName = $request->shopName;
        $activity->area_id = $request->area_id;
        $activity->menuName = $request->menuName;
        $activity->comment = $request->comment;
        $activity->date = $request->date;
        $activity->save();

        return redirect()->route('post.index')->with('successMessage', '活動を記録しました');
    }
}
