<ul class="list-unstyled">
    @foreach($activities as $activity)
        <li class="mb-3 text-center">
            <hr class="my-4">
            <div class="text-left d-inline-block w-75 mb-3">
                <img class="mr-2 rounded-circle" src="{{ $activity->user->image ? asset('storage/' . $activity->user->image) : Gravatar::src($activity->user->email, 55) }}" alt="ユーザのアバター画像" style="width: 55px; height: 55px; object-fit: cover; border-radius: 50%;">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $activity->user->id) }}">{{$activity->user->name}}</a></p>
            </div>
            <div class="">
                <div id="activity-{{ $activity->id }}">
                    <div class="text-left d-inline-block w-75">
                        <div class="activity-img" style="width: 80%; aspect-ratio: 1 / 1;">
                            <img src="{{ asset('storage/' . $activity->image) }}" alt="ラーメンの画像" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                        </div>
                        <p class="mt-2" style="font-weight: bold; font-size: 20px;">{{ $activity->shopName }}</p>
                        <p><i class="fas fa-map-marker-alt" style="font-size: 20px;"></i> {{ $activity->area->area }}</p>
                        <p>
                            <img src="{{ asset('storage/icons/menuName_icon.svg') }}" alt="メニューアイコン" width="20" height="20" style="vertical-align: text-top">
                            {{ $activity->menuName }}
                        </p>
                        <p class="mb-2">{!! nl2br(e($activity->comment)) !!}</p>
                        <p class="text-muted">{{ $activity->date }}</p>
                    </div>
                </div>
                @if(Auth::id() === $activity->user_id)
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <a href="" class="btn btn-primary">編集する</a>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">{{ $activities->appends(['keyword' => request()->input('keyword', '')])->links('pagination::bootstrap-4') }}</div>
