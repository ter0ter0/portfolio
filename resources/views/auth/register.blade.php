@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/auth/register.css')}}">
@endsection

@section('content')
    <div class="register__content">
        <div class="text-center mt-2 mb-4">
            <h1 class="custom__heading"><img src="{{ asset('images/logo.png') }}" alt="Ramengram"></h1>
        </div>
        <div class="text-center mt-3">
            <p class="text-left d-inline-block">新規ユーザ登録すると投稿で<br>コミュニケーションができるようになります。</p>
        </div>
        <div class="text-center">
            <h3 class="login_title text-left d-inline-block mt-5">新規ユーザ登録</h3>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-sm-6 offset-sm-3">
                <form method="POST" action="{{ route('signup.post') }}">
                    @include('commons.error_messages')
                    @csrf
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">パスワード確認</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">新規登録</button>
                </form>
            </div>
        </div>
    </div>
@endsection


