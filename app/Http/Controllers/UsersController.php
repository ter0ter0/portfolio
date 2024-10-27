<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
    }
}
