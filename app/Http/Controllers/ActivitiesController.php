<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Area;
Use App\Activity;
Use App\User;
use App\Http\Requests\ActivityRequest;
use Carbon\Carbon;

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

        if ($request->hasFile('image')) {
            \Storage::disk('public')->delete($activity->image);
            $path = $request->file('image')->store('shop-images', 'public');
            $activity->image = $path;
        }

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
    public function userActivities(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // dateパラメータを取得、デフォルトは現在の月
        $date = $request->query('date', Carbon::now()->format('Y-m'));
        $endDate = Carbon::parse($date)->endOfMonth(); // 終了日
        $startDate = $endDate->copy()->subMonths(5)->startOfMonth(); // 過去6ヶ月間の開始日

        // 6ヶ月分のデータを取得
        $activities = $user->activities()
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($activity) {
                return Carbon::parse($activity->date)->format('Y年n月'); // 月毎にグループ化
            });

        $countActivities = $user->countActivities();
        $countActivitiesThisMonth = $user->countActivitiesThisMonth();

        return view('activities.user_activities', [
            'user' => $user,
            'activities' => $activities,
            'countActivities' => $countActivities,
            'countActivitiesThisMonth' => $countActivitiesThisMonth,
            'date' => $date, // 現在の範囲の開始月をビューに渡す
        ]);
    }
}
