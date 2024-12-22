<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // フォロワーを取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }

    // ユーザーがフォローしている人を取得
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    // フォローする
    public function follow($userId)
    {
        $exist = $this->isFollowing($userId);
        if ($exist) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    // フォロー解除
    public function unfollow($userId)
    {
        $exist = $this->isFollowing($userId);
        if ($exist) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }

    // フォローしているかどうか確認
    public function isFollowing($userId)
    {
        return $this->followings()->where('following_id', $userId)->exists();
    }

    // cascade削除(論理削除)が適用されないため下記のbootメソッドで子テーブルを削除
    public static function boot()
    {
        parent::boot();
        static::deleted(function ($user) {
            $user->posts()->delete();
            $user->replies()->delete();
        });
    }

    // いいね機能・リレーション
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withPivot('original_post_id')->withTimestamps();
    }

    // いいねをする
    public function favorite($postId)
    {
        $user = \Auth::User();
        $post = Post::findOrFail($postId);
        $repostId = $post->original_post_id ?? null;
        $exist = $this->isFavorite($postId);

        if ($exist) {
            return false;
        }
        else {
            if ($repostId) {
                $originalPost = $post->originalPosts;
                $user->favorites()->syncWithoutDetaching([
                    $post->id => ['original_post_id' => $repostId],
                    $originalPost->id
                ]);
            }
            else {
                $reposts = $post->repostedPosts;
                $postIdsWithPivot = [];

                foreach ($reposts as $repost) {
                    $postIdsWithPivot[$repost->id]  = ['original_post_id' => $post->id];
                }
                $postIdsWithPivot[$post->id]  = ['original_post_id' => null];
                $user->favorites()->syncWithoutDetaching($postIdsWithPivot);
            }
            return true;
        }
    }

    // いいねを外す
    public function unfavorite($postId)
    {
        $user = \Auth::User();
        $post = Post::findOrFail($postId);
        $repostId = $post->original_post_id ?? null;
        $exist = $this->isFavorite($postId);

        if ($exist) {
            if ($repostId) {
                $originalPost = $post->originalPosts;
                $user->favorites()->detach([
                    $post->id,
                    $originalPost->id
                ]);
            }
            else {
                $repost = $post->repostedPosts;
                $postIds = $repost->pluck('id')->toArray();
                $postIds[] = $post->id;
                $user->favorites()->detach($postIds);
            }
            return true;
        }
        else {
            return false;
        }
    }

    // いいねしているかどうか確認
    public function isFavorite($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }

    // 返信に対するいいね機能・リレーション
    public function replyFavorites()
    {
        return $this->belongsToMany(Reply::class, 'reply_favorites', 'user_id', 'reply_id')->withTimestamps();
    }

    // いいねをする
    public function replyFavorite($replyId)
    {
        $exist = $this->isReplyFavorite($replyId);
        if ($exist) {
            return false;
        }
        else {
            $this->replyFavorites()->attach($replyId);
            return true;
        }
    }

    // いいねを外す
    public function replyUnfavorite($replyId)
    {
        $exist = $this->isReplyFavorite($replyId);
        if ($exist) {
            $this->replyFavorites()->detach($replyId);
            return true;
        }
        else {
            return false;
        }
    }

    // いいねしているかどうか確認
    public function isReplyFavorite($replyId)
    {
        return $this->replyFavorites()->where('reply_id', $replyId)->exists();
    }

    // ブックマーク機能・リレーション
    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }

    // ブックマークを登録
    public function bookmark($postId)
    {
        $exist = $this->isBookmark($postId);
        if ($exist) {
            return false;
        }
        else {
            $this->bookmarks()->attach($postId);
            return true;
        }
    }

    // ブックマークを解除
    public function unbookmark($postId)
    {
        $exist = $this->isBookmark($postId);
        if ($exist) {
            $this->bookmarks()->detach($postId);
            return true;
        }
        else {
            return false;
        }
    }

    // ブックマークしているかどうか確認
    public function isBookmark($postId)
    {
        return $this->bookmarks()->where('post_id', $postId)->exists();
    }

    // リポストしているかどうか確認
    public function isRepost($postId)
    {
        return $this->posts()->where('original_post_id', $postId)->exists();
    }
}
