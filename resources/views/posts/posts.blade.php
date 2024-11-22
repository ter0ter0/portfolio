<ul class="list-unstyled">
    @foreach($posts as $post)
        <li class="mb-3 text-center">
            <hr class="my-4">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{Gravatar::src($post->user->email, 55)}}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $post->user->id) }}">{{$post->user->name}}</a></p>
            </div>
            <div class="">
                <div id="post-{{ $post->id }}">
                    <div class="text-left d-inline-block w-75">
                        <p class="mb-2">{!! nl2br(e($post->content)) !!}</p>
                        <p class="text-muted">{{$post->created_at}}</p>
                    </div>
                    <div class="d-flex align-items-center w-75 mb-2 mx-auto">
                        <div class="mr-4">
                            @include('replies.reply_button')
                        </div>
                        <div class="mr-4">
                            @include('favorite.favorite_button', ['post' => $post])
                        </div>
                    </div>
                </div>
                @if(Auth::id() === $post->user_id)
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        <form method="POST" action="{{ route('post.delete',$post->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">編集する</a>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">{{ $posts->appends(['keyword' => request()->input('keyword', '')])->links('pagination::bootstrap-4') }}</div>
