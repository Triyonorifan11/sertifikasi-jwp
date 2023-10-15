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
        $role->create($data);
        ActivityLogService::logMasterCreate('Role',$role);
        return $role;
    }

    // show all data
    public static function show()
    {
        $roles = Role::all();
        return $roles;
    }

    // update data
    public static function update($data, $role)
    {
        $role->role_name = $data['role_name'];
        $role->role_description = $data['role_description'];
        $role->master_category = isset($data['master_category']) ? $data['master_category'] : FALSE;
        $role->master_product = isset($data['master_product']) ? $data['master_product'] : FALSE;
        $role->master_customer = isset($data['master_customer']) ? $data['master_customer'] : FALSE;
        $role->master_supplier = isset($data['master_supplier']) ? $data['master_supplier'] : FALSE;
        $role->master_unit = isset($data['master_unit']) ? $data['master_unit'] : FALSE;
        $role->master_user = isset($data['master_user']) ? $data['master_user'] : FALSE;
        $role->master_role = isset($data['master_role']) ? $data['master_role'] : FALSE;
        $role->sales_order = isset($data['sales_order']) ? $data['sales_order'] : FALSE;
        $role->purchase_order = isset($data['purchase_order']) ? $data['purchase_order'] : FALSE;
        $role->report_sales_order = isset($data['report_sales_order']) ? $data['report_sales_order'] : FALSE;
        $role->report_purchase_order = isset($data['report_purchase_order']) ? $data['report_purchase_order'] : FALSE;
        $role->report_stock = isset($data['report_stock']) ? $data['report_stock'] : FALSE;
        $role->report_profit_loss = isset($data['report_profit_loss']) ? $data['report_profit_loss'] : FALSE;
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

