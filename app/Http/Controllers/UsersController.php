<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $countActivities = $user->countActivities();
        $countActivitiesThisMonth = $user->countActivitiesThisMonth();

        $data = [
            'user' => $user,
            'posts' => $posts,
            'tab' =>'timeline',
            'countActivities' => $countActivities,
            'countActivitiesThisMonth' => $countActivitiesThisMonth,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // フォロワーの表示
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers()->paginate(10);
        $data = [
            'user' => $user,
            'followers' => $followers,
            'tab' => 'followers',
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // フォロー中ユーザーの表示
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings()->paginate(10);
        $data = [
            'user' => $user,
            'followings' => $followings,
            'tab' => 'followings',
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    // ユーザー編集画面の表示
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (\Auth::id() !== (int) $id) {
            abort(403);
        }

        return view('users.edit', [
            'user' => $user
        ]);
    }

    // ユーザー編集画面の更新処理
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($user->image) {
                \Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('image')->store('profile-images', 'public');
            $user->image = $path;
        }

        $user->name = $request->name; // フォームから送られてきたname
        $user->email = $request->email;// フォームから送られてきたemail
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('user.show', ['id' => $user->id])->with('successMessage', 'ユーザー情報を更新しました');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === \Auth::id()) {
            $user->delete();
        }
        return redirect()->route('post.index')->with('alertMessage', '退会しました');
    }
}
