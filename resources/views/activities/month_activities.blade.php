<div class="activity-list">
    @foreach ($activities as $month => $monthActivities)
        <div class="month-list">
            <h3 class="month-list__heading">{{ $month }}（{{ $monthActivities->count() }}）</h3>
            <div class="month-list__content-f">
                @foreach ($monthActivities as $activity)
                    <div class="activity-card">
                        <a href="{{ route('activity.show', $activity->id) }}">
                            <div class="activity-card__img">
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="活動記録の画像">
                            </div>
                            <div class="activity-card__shop-name">
                                <p>{{ $activity->shop_name}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
