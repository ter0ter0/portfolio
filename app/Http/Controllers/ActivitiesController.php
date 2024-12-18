<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Area;
Use App\Activity;
Use App\User;
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

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        $areas = Area::all();
        $user = \Auth::user();

        if ($user->id !== $activity->user_id) {
            abort(403);
        }

        $data = [
            'activity' => $activity,
            'areas' => $areas,
        ];

        return view('activities.edit', $data);
    }

    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $user = \Auth::user();

        \Storage::disk('public')->delete($activity->image);
        $path = $request->file('image')->store('shop-images', 'public');
        $activity->image = $path;

        $activity->user_id = $user->id;
        $activity->shop_name = $request->shop_name;
        $activity->area_id = $request->area_id;
        $activity->menu_name = $request->menu_name;
        $activity->comment = $request->comment;
        $activity->date = $request->date;
        $activity->save();

        return redirect()->route('post.index')->with('successMessage', '活動記録を更新しました');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        if ($activity->user_id === \Auth::id()){
            $activity->delete();
        }
        return back()->with('alertMessage', '活動記録を削除しました');
    }

    // ユーザーが所有する活動記録の一覧
    public function userActivities($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== \Auth::id()) {
            abort(403);
        }

        $activities = $user->activities()->orderBy('id', 'desc')->paginate(10);

        return view('activities.user_activities', ['activities' => $activities]);
    }
}
