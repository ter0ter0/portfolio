
@if (Auth::check())
    @if (Auth::user()->isRepost($post->id))
        <form method="POST" action="{{ route('repost.delete', $post->id) }}#post-{{ $post->id }}"class="d-inline-block" data-toggle="tooltip" title="リポストを取り消す">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-arrow-repeat"></i></button>
        </form>
    @else
        <form method="POST" action="{{ route('repost.store', $post->id) }}#post-{{ $post->id }}" class="d-inline-block" data-toggle="tooltip" title="リポスト">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-arrow-repeat text-success"></i></button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="btn m-0 p-1 shadow-none" data-toggle="tooltip" title="ログインしてリポスト"><i class="bi bi-heart"></i></a>
@endif
<span id="favorite-count-{{ $post->id }}" class="badge badge-pill">{{ $post->repostedPosts()->count() }}</span>

<script>
    // ツールチップ初期化処理
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
