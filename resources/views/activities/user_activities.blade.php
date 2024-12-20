@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/activities/user_activities.css') }}">
@endsection

@section('content')
    <div class="activities__content">
        <div class="content-f">
            <h2 class="mt-2">ラ活の記録</h2>
            <div class="activity__count">
                <p class="activity__count-total">トータル<span>{{ $countActivities }}</span>杯</p>
                <p class="activity__count-month">今月<span>{{ $countActivitiesThisMonth }}</span>杯</p>
            </div>
        </div>
        <div class="date-nav">
            <button class="date-nav__button">
                <a class="date-nav__link" href="{{ route('user.activities', ['id' => $user->id, 'date' => \Carbon\Carbon::parse($date)->subMonths(6)->format('Y-m')]) }}">＜</a>
            </button>
            <div class="date-nav__date">
                {{ \Carbon\Carbon::parse($date)->subMonths(5)->format('Y年m月') }} 〜 {{ \Carbon\Carbon::parse($date)->format('Y年m月') }}
            </div>
            <button class="date-nav__button">
                <a class="date-nav__link" href="{{ route('user.activities', ['id' => $user->id, 'date' => \Carbon\Carbon::parse($date)->addMonths(6)->format('Y-m')]) }}">＞</a>
            </button>
        </div>
        @include('activities.month_activities')
    </div>
@endsection
