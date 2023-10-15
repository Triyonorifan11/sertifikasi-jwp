<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\MasterUsersService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'users' => MasterUsersService::show(),
            'title' => 'Master Users'
        ];
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Users',
            'action' => 'New Data',
            'user' => [],
            'role_id' => Role::all(),
        ];
        return view('user.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user=MasterUsersService::create($request->all());
        if($user){
            return redirect()->route('user.index')->with('success', 'User created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'Form Master Users',
            'action' => 'Edit Data',
            'user' => $user,
            'role_id' => Role::all(),
        ];
        return view('user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user=MasterUsersService::update($request->all(), $user);
        if($user){
            return redirect()->route('user.index')->with('success', 'User updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user = MasterUsersService::delete($user);
            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('error', $th->getMessage());
        }

    }
}
