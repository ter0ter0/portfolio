@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/tags/show.css') }}">
@endsection

@section('content')
    <div class="show__content">
        <h2 class="mt-2">{{ "#" . $tag->name }}</h2>
        @include('posts.posts', ['posts' => $posts])
    </div>
@endsection
