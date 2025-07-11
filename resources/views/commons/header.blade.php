<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="header__logo">
            <a class="navbar-brand" href="/"><img src="{{ asset('images/logo_white.png') }}" alt="Ramengram"></a>
        </div>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item"><a href="{{ route('activity.create', Auth::user()->id )}}" class="nav-link text-light"><i class="fas fa-camera"></i> 記録する</a></li>
                    <li class="nav-item"><a href="{{ route('user.show', Auth::user()->id )}}" class="nav-link text-light">{{ Auth::user()->name }}</a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light">ログアウト</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-light">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link text-light">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>


