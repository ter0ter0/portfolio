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
                <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row-btn">
                            <div id="image-preview-container" class="mt-3">
                                <img id="image_preview" src="#" alt="選択した画像のプレビュー" class="img-fluid" style="display:none; max-width: 100%; height: auto;">
                                <video id="video_preview" controls class="img-fluid" style="display:none; max-width: 100%; height: auto;">
                                    <source src="#" type="video/mp4">
                                    お使いのブラウザでは動画を再生できません。
                                </video>
                            </div>
                            <textarea class="form-control" name="content" rows="4" style="margin-top: 10px;" placeholder="投稿についてコメントしよう！"></textarea>
                                <label for="image_file" class="custom-file-upload" style= "margin-top:10px">
                                    画像をアップロード
                                    <input type="file" id="image_file" name="image_file" style="display:none;">
                                </label>
                                <label for="video" class="custom-file-upload">
                                    動画をアップロード
                                    <input type="file" id="video" name="video" style="display:none;">
                                </label>
                                <div class="text-left mt-3">
                                    <button type="submit" class="btn btn-primary">投稿する</button>
                                </div>
                        </div>
                    </div>
                    @if (session('image_path'))
                    <div class="text-center mt-3">
                        <img src="{{ asset('/storage/img/' . session('image_path')) }}" alt="アップロードした画像" class="img-fluid">
                    </div>
                    @endif
                    @if (session('video_path'))
                    <div class="text-center mt-3">
                        <video controls class="img-fluid">
                            <source src="{{ asset('/storage/videos/' . session('video_path')) }}" type="video/mp4">
                            お使いのブラウザでは動画を再生できません。
                        </video>
                    </div>
                    @endif
                </form>
            @endif
            </div>
            @include('posts.posts', ['posts' => $posts])
        </div>
        <aside class="col-sm-4 border-left">
            <div class="custom-search-input">
                <form class="input-group col-md-12" method="GET" action="">
                    @csrf
                    <input type="text" name="keyword" class="form-control input-lg" value="{{ old('keyword', $keyword ?? '') }}" placeholder="検索" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </form>
            </div>
        </aside>
    </div>
@endsection