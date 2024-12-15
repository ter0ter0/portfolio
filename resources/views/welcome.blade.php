@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/welcome.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/search/search.css')}}">
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
    <div class="center jumbotron">
        <div class="text-center text-white mt-2 pt-1">
            <h1 class="custom__heading"><img src="{{ asset('images/logo_white.png') }}" alt="Ramengram"></h1>
        </div>
    </div>
    <div class="content-f">
        <div class="custom-left">
            <h5 class="text-center mb-3">"ラーメン"について140字以内で会話しよう！</h5>
            <div class="w-75 m-auto">
            @include('commons.error_messages')
            </div>
            <div class="text-center mb-3">
            @if(Auth::check())
                <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="4"></textarea>
                        <input class="form-control mt-3" type="text" id="tags" name="tags" placeholder="タグを入力（例：#ラーメン #つけ麺）">
                        <p class="text-left">※複数のタグを入力する場合は、半角スペースを入れてください。</p>
                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-primary">投稿する</button>
                        </div>
                    </div>
                </form>
            @endif
            </div>
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link {{ $tab === 'posts' ? 'active' : '' }}" style="height: 100%">投稿</a></li>
                <li class="nav-item"><a href="{{ route('post.activities') }}" class="nav-link {{ $tab === 'activities' ? 'active' : '' }}">ラ活報告</a></li>
            </ul>
            @if ($tab === 'posts')
                @include('posts.posts', ['posts' => $posts])
            @elseif ($tab === 'activities')
                @include('activities.activities', ['activities' => $activities])
            @endif
        </div>
        <aside class="custom-right">
            <div class="custom-search-input">
                <form class="input-group col-md-12" method="GET" action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="keyword" class="form-control input-lg" value="{{ old('keyword', $keyword ?? '') }}" placeholder="検索" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </form>
            </div>
            @include('favorite.top_favorite_posts', ['topPosts' => $topPosts])
        </aside>
    </div>
@endsection

@section('script')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            let tagsInput = document.getElementById('tags');
            let tags = tagsInput.value.split(' ').map(tag => tag.trim().replace(/^#/, '')).filter(tag=> tag !== '');
            tagsInput.value = tags.join(',');
        });
    </script>
@endsection
