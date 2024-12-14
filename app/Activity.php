<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'area_id',
        'image',
        'shopName',
        'menuName',
        'comment',
        'date',
    ];
}
