<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class MasterSupplierService
{
    // Your service logic here
    public static function create($data)
    {
        $supplier = new Supplier();
        $supplier->supplier_name = $data['supplier_name'];
        $supplier->supplier_address = $data['supplier_address'];
        $supplier->supplier_phone = $data['supplier_phone'];
        $supplier->save();
        ActivityLogService::logMasterCreate('Supplier',$supplier);
        return $supplier;
    }

    // show all data
    public static function show()
    {
        $suppliers = Supplier::withoutDefault()->get();
        return $suppliers;
    }

    // update data
    public static function update($data, $supplier)
    {
        $supplier->supplier_name = $data['supplier_name'];
        $supplier->supplier_address = $data['supplier_address'];
        $supplier->supplier_phone = $data['supplier_phone'];
        $supplier->save();
        ActivityLogService::logMasterUpdate('Supplier',$supplier);
        return $supplier;
    }

    // delete data
    public static function delete($supplier)
    {
        $supplier->delete();
        ActivityLogService::logMasterDelete('Supplier',$supplier);
        return $supplier;
    }

}
