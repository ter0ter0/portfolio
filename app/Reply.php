<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content', 'user_id', 'post_ed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replyFavoriteUsers()
    {
        return $this->belongsToMany(User::class,'reply_favorites','reply_id','user_id')->withTimestamps();
    }
}
