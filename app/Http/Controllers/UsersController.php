<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Post;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
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
        $user->name = $request->name; // フォームから送られてきたname
        $user->email = $request->email;// フォームから送られてきたemail
        $user->password = bcrypt($request->password);   
        $user->save();
        return redirect()->route('user.show', ['id' => $user->id]); 
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === \Auth::id()) {
            $user->delete();
        }
        return redirect()->route('post.index');
    }
}
