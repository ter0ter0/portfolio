@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users/edit.css') }}">
@endsection

@section('content')
    <div class="edit__content">
        <h2 class="mt-2 mb-3">ユーザ情報を編集する</h2>
        @include('commons.error_messages')
        <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <div class="profile-image-preview" id="profileImagePreview" style="background-image: url('{{ $user->image ? asset('storage/' . $user->image) : Gravatar::src($user->email, 150) }}')"></div>
                <label class="profile-image-label" for="image">画像を選択する</label>
                <input class="profile-image-input" id="image" type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="name">ユーザ名</label>
                <input class="form-control" value="{{ old('name',$user->name) }}" name="name" />
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input class="form-control" value="{{ old('email',$user->email) }}" name="email" />
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input class="form-control" type="password" name="password" />
            </div>
            <div class="form-group">
                <label for="password_confirmation">パスワードの確認</label>
                <input class="form-control" type="password" name="password_confirmation" />
            </div>
            <div class="d-flex justify-content-between">
                <a class="btn btn-danger text-light" data-toggle="modal" data-target="#deleteConfirmModal">退会する</a>
                <button type="submit" class="btn btn-primary">更新する</button>
            </div>
        </form>
    </div>
    <!-- モーダルウィンドウ -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>確認</h4>
                </div>
                <div class="modal-body">
                    <label>本当に退会しますか？</label>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">退会する</button>
                        </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('image').addEventListener('change', function(event){
            const file = event.target.files[0];
            const preview = document.getElementById('profileImagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.style.backgroundImage = `url('${e.target.result}')`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.backgroundImage = '';
            }
        });
    </script>
@endsection
