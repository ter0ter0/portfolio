@extends('layouts.app')
@section('css')
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
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="pr-3"></i>Topic Posts</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>
            <div class="w-75 m-auto">
            @include('commons.error_messages')
            </div>
            <div class="text-center mb-3">
            @if(Auth::check())
                <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="4"></textarea>
                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-primary">投稿する</button>
                        </div>
                    </div>
                </form>
            @endif
            </div>
            @include('posts.posts', ['posts' => $posts])
        </div>
        <aside class="col-sm-4 border-left">
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
           @include('posts.trending_posts', ['topPosts' => $topPosts])
        </aside>
    </div>
@endsection
