<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class MasterCustomersService
{
    // Your service logic here
    public static function create($data)
    {
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        ActivityLogService::logMasterCreate('Customer',$customer);
        return $customer;
    }

    // show all data
    public static function show()
    {
        $customers = Customer::withoutDefault()->get();
        return $customers;
    }

    // update data
    public static function update($data, $customer)
    {
        $customer->customer_name = $data['customer_name'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        ActivityLogService::logMasterUpdate('Customer',$customer);
        return $customer;
    }

    // delete data
    public static function delete($customer)
    {
        $customer->delete();
        ActivityLogService::logMasterDelete('Customer',$customer);
        return $customer;
    }

}
