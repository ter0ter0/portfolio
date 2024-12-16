@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bookmark/index.css') }}">
@endsection

@section('content')
    <div class="index__content">
        <h2 class="mt-2">保存した投稿</h2>
        @include('posts.posts', ['posts' => $posts])
    </div>
@endsection
