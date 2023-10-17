<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\Log;

class MasterRoleService
{
    // Your service logic here
    public static function create($data)
    {
        $role = new Role();
        isset($data['master_category'])=="ON" ? $data['master_category']=1 : $data['master_category']=0;
        isset($data['master_product'])=="ON" ? $data['master_product']=1 : $data['master_product']=0;
        isset($data['master_unit'])=="ON" ? $data['master_unit']=1 : $data['master_unit']=0;
        isset($data['master_user'])=="ON" ? $data['master_user']=1 : $data['master_user']=0;
        isset($data['master_role'])=="ON" ? $data['master_role']=1 : $data['master_role']=0;
        isset($data['sales_order'])=="ON" ? $data['sales_order']=1 : $data['sales_order']=0;
        isset($data['purchase_order'])=="ON" ? $data['purchase_order']=1 : $data['purchase_order']=0;
        isset($data['keranjang'])=="ON" ? $data['keranjang']=1 : $data['keranjang']=0;
        isset($data['delivery_status'])=="ON" ? $data['delivery_status']=1 : $data['delivery_status']=0;

        $role->create($data);
        ActivityLogService::logMasterCreate('Role',$role);
        return $role;
    }

    // show all data
    public static function show()
    {
        $roles = Role::paginate(10);
        return $roles;
    }

    // update data
    public static function update($data, $role)
    {
        $role->role_name = $data['role_name'];
        $role->role_description = $data['role_description'];
        $role->master_category = isset($data['master_category']) == "ON" ? 1 : 0;
        $role->master_product = isset($data['master_product']) == "ON" ? 1 : 0;
        $role->master_unit = isset($data['master_unit']) == "ON" ? 1 : 0;
        $role->master_user = isset($data['master_user']) == "ON" ? 1 : 0;
        $role->master_role = isset($data['master_role']) == "ON" ? 1 : 0;
        $role->sales_order = isset($data['sales_order']) == "ON" ? 1 : 0;
        $role->purchase_order = isset($data['purchase_order']) == "ON" ? 1 : 0;
        $role->keranjang = isset($data['keranjang']) == "ON" ? 1  : 0;
        $role->delivery_status = isset($data['delivery_status']) == "ON" ?1 : 0;
        
        $role->save();
        ActivityLogService::logMasterUpdate('Role',$role);
        return $role;
    }

    // delete data
    public static function delete($role)
    {
        // check if role has users
        if($role->users()->count() > 0){
            // throw error
            throw new \Exception('Role has users');
        }
        $role->delete();
        ActivityLogService::logMasterDelete('Role',$role);
        return $role;
    }
}

