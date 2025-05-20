<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function goodBtnUsers()
    {
        return $this->belongsToMany(User::class, 'good_buttons', 'activity_id', 'user_id')->withTimestamps();
    }
}
