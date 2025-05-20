@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/replies/edit.css')}}">
@endsection

@section('content')
@if (session('alertMessage'))
    <div class="alert alert-success text-center w-25 mx-auto">
        {{ session('successMessage') }}
    </div>
@endif
    <div class="edit__content">
        <h2 class="mt-2">返信内容を編集する</h2>
        @include('commons.error_messages')
        <form method="POST" action="{{ route('reply.update', $reply->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea id="content" class="form-control" name="content" rows="5">{{ old('content', $reply->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">更新する</button>
        </form>
    </div>
@endsection
