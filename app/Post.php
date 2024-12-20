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

    // リポスト機能自己参照リレーション
    // オリジナルの投稿をリポストした投稿を取得。（リポスト投稿を取得）
    public function repostedPosts()
    {
        return $this->hasMany(self::class, 'original_post_id');
    }

    // リポスト投稿のオリジナルの投稿を取得。（元の投稿を取得）
    public function originalPosts()
    {
        return $this->belongsTo(self::class, 'original_post_id');
    }

    // オリジナル投稿が削除と更新された時、リポスト投稿も削除と更新。
    protected static function boot() 
    {
        parent::boot();
        static::deleting(function ($post) {
            $post->repostedPosts()->each(function ($repostedPost) {
                $repostedPost->delete();
            });
        });
        static::updated(function ($post) {
            $post->repostedPosts()->each(function ($repostedPost) use($post) {
                $repostedPost->content = $post->content;
                $repostedPost->save();
            });
        });
    }
}
