@php
    $countBookmarkUsers = $post->bookmarkUsers()->count();
@endphp

@if (Auth::check())
    @if (Auth::user()->isBookmark($post->id))
        <form method="POST" action="{{ route('bookmark.delete', $post->id) }}#post-{{ $post->id }}"class="d-inline-block" data-toggle="tooltip" title="保存を解除">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="fas fa-bookmark"></i></button>
        </form>
    @else
        <form method="POST" action="{{ route('bookmark.store', $post->id) }}#post-{{ $post->id }}" class="d-inline-block" data-toggle="tooltip" title="投稿を保存する">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="far fa-bookmark"></i></button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="btn m-0 p-1 shadow-none" data-toggle="tooltip" title="投稿を保存してログイン"><i class="far fa-bookmark"></i></a>
@endif
<span id="favorite-count-{{ $post->id }}" class="badge badge-pill">{{ $countBookmarkUsers }}</span>

<script>
    // ツールチップ初期化処理
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
