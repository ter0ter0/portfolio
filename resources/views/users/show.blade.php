@extends('layouts.app')
@section('content')
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像">
                        @if (Auth::id() === $user->id)
                            <div class="mt-3">
                                <a href="" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                            </div>
                        @endif
                </div>
            </div>
            <div class="mt-2">
                @include('follow.follow_button', ['user' => $user])
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ $tab === 'timeline' ? 'active' : '' }}">タイムライン</a></li>
                <li class="nav-item"><a href="{{ route('user.followings', $user->id) }}" class="nav-link {{ $tab === 'followings' ? 'active' : '' }}">フォロー中<br><div class="badge badge-secondary">{{ $countFollowings }}</div></a></li>
                <li class="nav-item"><a href="{{ route('user.followers', $user->id) }}" class="nav-link {{ $tab === 'followers' ? 'active' : '' }}">フォロワー<br><div class="badge badge-secondary">{{ $countFollowers }}</div></a></li>
            </ul>
            @if ($tab === 'timeline')
                @include('posts.posts', ['user' => $user, 'posts' => $posts])
            @elseif ($tab === 'followings')
                @include('users.users', ['users' => $followings])
            @elseif ($tab === 'followers')
                @include('users.users', ['users' => $followers])
            @endif
        </div>
    </div>
@endsection
