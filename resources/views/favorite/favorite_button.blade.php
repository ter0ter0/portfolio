@if (Auth::check())
    @if (Auth::user()->isFavorite($post->id))
        <form method="POST" action="{{ route('post.unfavorite', $post->id) }}">
            @csrf
            @method('DELETE')
            <a href="#" title="いいね">
             <i class="bi bi-chat"></i> 
             <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart">いいねを外す</i></button>
                <span>485</span>
            </a>      
        </form>
    @else
        <form method="POST" action="{{ route('post.favorite', $post->id) }}">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none"><i class="bi bi-heart">いいね</i></button>
        </form>
    @endif
@endif