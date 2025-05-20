<ul class="list-unstyled">
    @foreach($replies as $reply)
        <li class="mb-3 text-center pl-4 pr-4">
            <hr class="my-4">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ $reply->user->image ? asset('storage/' . $reply->user->image) : Gravatar::src($reply->user->email, 55) }}" alt="ユーザのアバター画像" style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%;">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $reply->user->id) }}">{{$reply->user->name}}</a></p>
            </div>
            <div class="">
                <div id="reply-{{ $reply->id }}">
                    <div class="text-left d-inline-block w-75">
                        <p class="mb-2">{!! nl2br(e($reply->content)) !!}</p>
                        <p class="text-muted">{{$reply->created_at}}</p>
                    </div>
                    <div class="d-flex align-items-center w-75 mb-2 mx-auto">
                        <div class="mr-4">
                            @include('favorite.reply_favorite_button', ['reply' => $reply])
                        </div>
                    </div>
                </div>
                @if(Auth::id() === $reply->user_id)
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        <form method="POST" action="{{ route('reply.delete', $reply->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <a href="{{ route('reply.update', $reply->id) }}" class="btn btn-primary">編集する</a>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">{{ $replies->links('pagination::bootstrap-4') }}</div>
