@php
    $countFavoriteUsers = $post->favoriteUsers()->count();
@endphp

@if (Auth::check())
    @if (Auth::user()->isFavorite($post->id))
        <form method="POST" action="{{ route('post.unfavorite', $post->id) }}#post-{{ $post->id }}"class="d-inline-block" data-toggle="tooltip" title="いいねを取り消す">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart-fill"></i></button> 
        </form>
    @else
        <form method="POST" action="{{ route('post.favorite', $post->id) }}#post-{{ $post->id }}" class="d-inline-block" data-toggle="tooltip" title="いいね">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart"></i></button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="btn m-0 p-1 shadow-none" data-toggle="tooltip" title="いいねしてログイン"><i class="bi bi-heart"></i></a>
@endif
<span id="favorite-count-{{ $post->id }}" class="badge badge-pill">{{ $countFavoriteUsers }}</span>

<script>
    // ツールチップ初期化処理
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>