<ul class="list-unstyled">
    <h5 class="text-center mt-3 mb-3">人気投稿</h5>
    @if($topPosts->isNotEmpty())
        @foreach($topPosts as $post)
            @if (!$post->original_post_id)
                <li class="mb-3 text-center">
                    <hr class="my-4">
                    <div class="text-left d-inline-block w-75 mb-2">
                        <img class="mr-2 rounded-circle" src="{{ $post->user->image ? asset('storage/' . $post->user->image) : Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像" style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%;">
                        <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a></p>
                    </div>
                    <div class="text-left d-inline-block w-75">
                        <p class="mb-2">{!! nl2br(e($post->content)) !!}</p>
                        <p class="text-muted">{{$post->created_at}}</p>
                    </div>
                    <div class="text-left d-inline-block w-75">
                        @include('favorite.favorite_button', ['post' => $post])
                    </div>
                </li>
            @endif
        @endforeach
    @else
        <p class="text-center">いいねされた投稿はありません。</p>
    @endif
</ul>
