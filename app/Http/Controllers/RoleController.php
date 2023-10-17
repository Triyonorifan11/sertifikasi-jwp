<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\MasterRoleService;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'roles' => MasterRoleService::show(),
            'title' => 'Master Role'
        ];
        return view('roles.index', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'title' => 'Form Master Role',
            'action' => 'New Data',
            'role' => [],
        ];
        return view('roles.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = MasterRoleService::create($request->all());
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $data = [
            'title' => 'Form Edit Master Role',
            'action' => 'Edit Data',
            'role' => $role,
        ];
        return view('roles.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role =  MasterRoleService::update($request->all(), $role);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            MasterRoleService::delete($role);
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error', $th->getMessage());
        }
    }
}
