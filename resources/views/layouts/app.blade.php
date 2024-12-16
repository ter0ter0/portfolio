<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Ramengram</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="icon" href="{{ asset('favicon-ramen.png') }}" type="image/png">
        <link rel="stylesheet" href="{{ asset('/css/commons.css') }}">
        @yield('css')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="bg-img">
            @include('commons.header')
            <div class="container">
                @yield('content')
            </div>
            @include('commons.footer')
        </div>
        <script>
        document.getElementById('image_file').addEventListener('change', handleFilePreview);
        document.getElementById('video').addEventListener('change', handleFilePreview);

        function handleFilePreview(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('image_preview');
            const previewVideo = document.getElementById('video_preview');

            if (file) {
                const reader = new FileReader();

                if (file.type.startsWith('image/')) {
                    // 画像のプレビュー表示
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block';
                        previewVideo.style.display = 'none'; // 動画を非表示
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    // 動画のプレビュー表示
                    reader.onload = function(e) {
                        previewVideo.src = e.target.result;
                        previewVideo.style.display = 'block';
                        previewImage.style.display = 'none'; // 画像を非表示
                    };
                    reader.readAsDataURL(file);
                } else {
                    // 未対応のファイル形式
                    alert('画像または動画ファイルを選択してください。');
                    previewImage.style.display = 'none';
                    previewVideo.style.display = 'none';
                }
            } else {
                // ファイル未選択時のリセット
                previewImage.src = '#';
                previewVideo.src = '';
                previewImage.style.display = 'none';
                previewVideo.style.display = 'none';
            }
        }
        </script>
        @yield('script')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
