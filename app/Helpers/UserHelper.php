<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserHelper{
    public static function createUser($name,$username,$password)
    {
        $user = new User();
        $user->name = $name;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->save();
        return $user;
    }
}
