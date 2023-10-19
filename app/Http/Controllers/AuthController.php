<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Services\AuthService;
use App\Services\MasterUsersService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login()
    {
        $props = [
            'title' => 'Login',
        ];
        return view('auth.login',$props);
    }

    public function auth(LoginRequest $request)
    {
        try {
            AuthService::login($request);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect(route('home'));
    }

    public function register(){
        $props = [
            'title' => 'Form Register Users',
            'action' => 'New Data',
            'user' => [],
            'role_id' => Role::where('role_name', 'Pembeli')->get(),
        ];
        return view('auth.register',$props);
    }

    public function store_register(StoreUserRequest $request){
        $user=MasterUsersService::create($request->all());
        if($user){
            return redirect()->route('login')->with('success', 'User created successfully');
        }
    }

    public function logout()
    {
        AuthService::logout();
        return redirect(route('login'));
    }
}
