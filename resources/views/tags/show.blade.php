@extends('layouts.app')

@section('content')
    <h2 class="mt-5">{{ "#" . $tag->name }}</h2>
    @include('posts.posts', ['posts' => $posts])
@endsection
