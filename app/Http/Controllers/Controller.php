<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userCounts($user){
        $countFollowers = $user->followers()->count();
        $countFollowings = $user->followings()->count();
        $countFavorites = $user->favorites()->count(); // いいね数をカウント
        return [
            'countFollowers' => $countFollowers,
            'countFollowings' => $countFollowings,
            'countFavorite' => $countFavorites,
        ];
    }
}
