@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/search/search.css')}}">
@endsection

@section('content')
	<div class="search-custom-content">
        <div class="col-md-6">
            <h2>検索フォーム</h2>
            <div class="custom-search-input">
                <form class="input-group col-md-12" method="GET" action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="keyword" class="form-control input-lg" value="{{ old('keyword', $keyword ?? '') }}" placeholder="キーワードを入力してください" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </form>
            </div>
        </div>
        <div class="mt-4">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('search', ['keyword' => $keyword, 'tab' => 'posts']) }}" class="nav-link {{ $tab === 'posts' ? 'active' : '' }}">投稿</a></li>
                <li class="nav-item"><a href="{{ route('search', ['keyword' => $keyword, 'tab' => 'users']) }}" class="nav-link {{ $tab === 'users' ? 'active' : '' }}">ユーザー</a></li>
                <li class="nav-item"><a href="{{ route('search', ['keyword' => $keyword, 'tab' => 'activities']) }}" class="nav-link {{ $tab === 'activities' ? 'active' : '' }}">ラ活報告</a></li>
            </ul>
            @if ($tab === 'posts' && $posts)
                @if (!$posts->isEmpty())
                    @include('posts.posts', ['posts' => $posts])
                @else
                    <p>該当する投稿はありません。</p>
                @endif
            @elseif ($tab === 'users' && $users)
                @if (!$users->isEmpty())
                    @include('users.users', ['users' => $users])
                @else
                    <p>該当するユーザーはありません。</p>
                @endif
            @elseif ($tab === 'activities' && $activities)
                @if (!$activities->isEmpty())
                    @include('activities.activities', ['activities' => $activities])
                @else
                    <p>該当するラ活報告はありません。</p>
                @endif
            @endif
        </div>
	</div>
@endsection
