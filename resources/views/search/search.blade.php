@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/search/search.css')}}">
@endsection
@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-6">
            <h2>検索フォーム</h2>
            <div class="custom-search-input">
                <form class="input-group col-md-12" method="GET" action="">
                    @csrf
                    <input type="text" name="keywrd" class="form-control input-lg" value="{{ old('keyword') }}" placeholder="キーワードで検索" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </form>
            </div>
        </div>
	</div>
</div>
@endsection
