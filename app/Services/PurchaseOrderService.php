<?php

namespace App\Services;

use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class PurchaseOrderService
{
    // show all data
    public static function show()
    {
        $user = PurchaseOrder::paginate(10);
        return $user;
    }

    public static function create($data){
        $po = new PurchaseOrder();
        $po->po_no = "PO-".date('y') . date('m'). '-'.date('his');
        $po->product_id = Hashids::decode($data['product_id'])[0];
        $po->po_qty = $data['po_qty'];
        $po->description = $data['description'];
        $po->save();
        ActivityLogService::logPOCreate('Purchase Order',$po);
        return $po;
    }

    public static function update($data, $po){
        $po->product_id = Hashids::decode($data['product_id'])[0];
        $po->po_qty = $data['po_qty'];
        $po->description = $data['description'];
        $po->save();
        ActivityLogService::logPOUpdate('Purchase Order',$po);
        return $po;
    }

    // delete data
    public static function delete($po)
    {
        $po->delete();
        ActivityLogService::logPODelete('Purchase Order',$po);
        return $po;
    }
}
