<ul class="list-unstyled">
    @foreach($posts as $post)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{Gravatar::src($post->user->email, 55)}}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $post->user->id) }}">{{$post->user->name}}</a></p>
            </div>
            <div class="">
                <div class="text-left d-inline-block w-75">
                <div class="mt-1 mb-3">
                @if (!empty($post->image_path))
                    <img src="{{ asset('storage/img/' . $post->image_path) }}" alt="投稿画像" style="width: 100%;">
                @endif

                @if (!empty($post->video_path))
                        <video controls class="video">
                            <source src="{{ asset('storage/videos/' . $post->video_path) }}" type="video/mp4">
                            ご利用のブラウザは動画をサポートしていません。
                        </video>
                    @endif
                </div>
                    <p class="mb-2">{!! nl2br(e($post->content)) !!}</p>
                    <p class="text-muted">{{$post->created_at}}</p>
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
<div class="m-auto" style="width: fit-content">{{ $posts->links('pagination::bootstrap-4') }}</div>