@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/activities/user_activities.css') }}">
@endsection

@section('content')
    <div class="activities__content">
        <h2 class="mt-2">ラ活の記録</h2>
        <div class="activity-card"></div>
        @include('activities.activities', ['activities' => $activities])
    </div>
@endsection
