@if  (Auth::check())
    @if (Auth::user()->isFavorite($post->id))
        <form method="POST" action="{{ route('post.unfavorite', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart">いいねを外す</i></button>
        </form>
    @else
        <form method="POST" action="{{ route('post.favorite', $post->id) }}">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart">いいね</i></button>
        </form>
    @endif
@endif