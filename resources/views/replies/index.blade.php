@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/replies/index.css') }}">
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
    <div class="post-content mb-4 text-center">
        <div class="text-left d-inline-block w-75 mb-2">
            <img class="mr-2 rounded-circle" src="{{ $post->user->image ? asset('storage/' . $post->user->image) : Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像" style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%;">
            <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $post->user->id) }}">{{$post->user->name}}</a></p>
        </div>
        <div class="">
            <div id="post-{{ $post->id }}">
                <div class="text-left d-inline-block w-75">
                    <p class="mb-2">{!! nl2br(e($post->content)) !!}</p>
                    <p class="text-muted">{{$post->created_at}}</p>
                </div>
            </div>
            @if(Auth::id() === $post->user_id)
                <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                    <form method="POST" action="{{ route('post.delete',$post->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">編集する</a>
                </div>
            @endif
        </div>
    </div>
    <div class="w-75 m-auto">
    @include('commons.error_messages')
    </div>
    <div class="text-center mb-3">
    @if(Auth::check())
        <form method="POST" action="{{ route('reply.store', $post->id) }}" class="d-inline-block w-75">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="content" rows="4"></textarea>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary">返信する</button>
                </div>
            </div>
        </form>
    @endif
    </div>
    @include('replies.replies', ['post' => $post])
@endsection
