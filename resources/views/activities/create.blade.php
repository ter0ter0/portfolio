@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/activities/form.css') }}">
@endsection

@section('content')
    <div class="activity__content">
        <h2 class="mt-2 mb-3">食べたラーメンを記録する</h2>
        @include('commons.error_messages')
        <form method="post" action="{{ route('activity.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="shop-image-preview" id="shopImagePreview"></div>
                <label class="shop-image-label" for="image">画像を選択する</label>
                <input class="shop-image-input" id="image" type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="shop_name">店舗名</label>
                <input class="form-control" type="text" value="{{ old('shop_name') }}" name="shop_name" id="shop_name" />
            </div>
            <div class="form-group">
                <label for="area">エリア</label>
                <select class="form-control create-form__select" name="area_id" id="area">
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->prefecture }}</option>
                    @endforeach
                </select>
                <i class="fas fa-caret-down custom-arrow"></i>
            </div>
            <div class="form-group">
                <label for="menu_name">食べたメニュー</label>
                <input class="form-control" type="text" value="{{ old('menu_name') }}" name="menu_name" id="menu_name" />
            </div>
            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea class="form-control" name="comment" id="comment" rows="4">{{ old('comment') }}</textarea>
            </div>
            <div class="form-group">
                <label for="date">食べた日付</label>
                <input class="form-control" type="date" value="{{ old('date') }}" name="date" id="date" />
            </div>
            <button type="submit" class="btn btn-primary">投稿する</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('image').addEventListener('change', function(event){
            const file = event.target.files[0];
            const preview = document.getElementById('shopImagePreview');

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
