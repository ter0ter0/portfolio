@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users/show.css') }}">
@endsection

@section('content')
    @if (session('successMessage'))
        <div class="alert alert-success text-center w-30 mx-auto">
            {{ session('successMessage') }}
        </div>
    @elseif (session('alertMessage'))
        <div class="alert alert-danger text-center w-30 mx-auto">
            {{ session('alertMessage') }}
        </div>
    @endif
    <div class="content-f">
        <aside class="col-sm-4 mb-5">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title text-light">{{ $user->name }}</h3>
                </div>
                <div class="card-body text-center">
                    <div class="rounded-circle overflow-hidden mx-auto" style="max-width: 100%; width: 90%; aspect-ratio: 1 / 1;">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    @if (Auth::id() === $user->id)
                        <div class="custom-edit-btn">
                            <a href="{{ route('user.edit', $user->id) }}">ユーザ情報の編集</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                @include('follow.follow_button', ['user' => $user])
            </div>
            <div class="mt-2">
                <div class="activity-card">
                    <p class="activity__heading">ラ活の記録</p>
                    <div class="activity__count">
                        <p class="activity__count-total">トータル<span>10</span>杯</p>
                        <p class="activity__count-month">今月<span>2</span>杯</p>
                    </div>
                    <a class="activity__link" href="{{ route('user.activities', $user->id) }}">記録を見る <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="mt-2">
                @if (Auth::id() === $user->id)
                    <div class="custom-edit-btn__bookmark">
                        <a href="{{ route('bookmark.index', $user->id) }}"><i class="fas fa-bookmark"></i> 保存した投稿を見る</a>
                    </div>
                @endif
            </div>
        </aside>
        <div class="custom-tabs">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ $tab === 'timeline' ? 'active' : '' }}" style="height: 100%">タイムライン</a></li>
                <li class="nav-item"><a href="{{ route('user.followings', $user->id) }}" class="nav-link {{ $tab === 'followings' ? 'active' : '' }}">フォロー中<br><div class="badge badge-secondary">{{ $countFollowings }}</div></a></li>
                <li class="nav-item"><a href="{{ route('user.followers', $user->id) }}" class="nav-link {{ $tab === 'followers' ? 'active' : '' }}">フォロワー<br><div class="badge badge-secondary ml-2">{{ $countFollowers }}</div></a></li>
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
