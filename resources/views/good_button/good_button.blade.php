@php
    $countGoodBtnUsers = $activity->goodBtnUsers()->count();
@endphp

@if (Auth::check())
    @if (Auth::user()->isGoodButton($activity->id))
        <form method="POST" action="{{ route('activity.unnice', $activity->id) }}#activity-{{ $activity->id }}" class="d-inline-block" data-toggle="tooltip" title="ナイスを削除">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn m-0 p-1 shadow-none">
                <img src="{{ asset('images/good-btn.png') }}" alt="ナイスボタン" width="20" height="20" style="vertical-align: text-top">
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('activity.nice', $activity->id) }}#activity-{{ $activity->id }}" class="d-inline-block" data-toggle="tooltip" title="ナイス！">
            @csrf
            <button type="submit" class="btn m-0 p-1 shadow-none">
                <img src="{{ asset('images/good-btn-white.png') }}" alt="ナイスボタン" width="20" height="20" style="vertical-align: text-top">
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="btn m-0 p-1 shadow-none" data-toggle="tooltip" title="ナイス！してログイン">
        <button type="submit" class="btn m-0 p-1 shadow-none">
            <img src="{{ asset('images/good-btn-white.png') }}" alt="ナイスボタン" width="20" height="20" style="vertical-align: text-top">
        </button>
    </a>
@endif
<span class="badge badge-pill">{{ $countGoodBtnUsers }}</span>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
