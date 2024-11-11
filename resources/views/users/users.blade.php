@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="mb-3 text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="text-left d-inline-block w-50 mb-2 mr-2">
                        <img class="mr-2 rounded-circle" src="{{Gravatar::src($user->email, 55)}}" alt="ユーザのアバター画像">
                        <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $user->id) }}">{{$user->name}}</a></p>
                    </div>
                    <div class="d-inline-block ml-0">
                        @include('follow.follow_button', ['user' => $user])
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="m-auto" style="width: fit-content">{{ $users->links('pagination::bootstrap-4') }}</div>
@else
    <p>ユーザーが見つかりませんでした。</p>
@endif
