@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/posts/edit.css')}}">
@endsection

@section('content')
@if (session('alertMessage'))
    <div class="alert alert-success text-center w-25 mx-auto">
        {{ session('successMessage') }}
    </div>
@endif
    <div class="edit__content">
        <h2 class="mt-2">投稿を編集する</h2>
        @include('commons.error_messages')
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                @if (session('image_path') || $post->image_path)
                <div class="text-center m-5">
                    <img src="{{ asset('/storage/img/' . $post->image_path) }}" alt="Uploaded Image" class="img-fluid">
                </div>
                @endif                
                <textarea id="content" class="form-control" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
        </form>
    </div>
@endsection
