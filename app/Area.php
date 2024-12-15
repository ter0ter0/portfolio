<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
