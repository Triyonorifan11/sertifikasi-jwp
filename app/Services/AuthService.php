<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    // Your service logic here
    public static function login($data)
    {
        // check if user active
        $user = User::where('username', $data['username'])->first();
        if(!$user){
            throw new Exception('Username you entered not found');
        }
        if(!$user->active){
            throw new Exception('User not active');
        }
        //  check password

        $credentials = $data->only('username', 'password');
        if (!Auth::attempt($credentials)) {
            throw new Exception('Password you entered is wrong');
        }
    }

    // logout
    public static function logout()
    {
        Auth::logout();
    }

    // check if user logged in
    public static function check()
    {
        return Auth::check();
    }

    // check if user active in session if not logout
    public static function checkActive()
    {
        if(Auth::check()){
            $user = Auth::user();
            if(!$user->active){
                Auth::logout();
            }
        }
    }

    // get user data with role
    public static function user()
    {
        return Auth::user();
    }
}
