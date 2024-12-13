<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class,'favorites','post_id','user_id')->withTimestamps();
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function bookmarkUsers()
    {
        return $this->belongsToMany(User::class,'bookmarks','post_id','user_id')->withTimestamps();
    }
}
