<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Services\MasterCustomersService;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'customer' => MasterCustomersService::show(),
            'title' => 'Master Customer'
        ];
        return view('customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Customer',
            'action' => 'New Data',
            'customer' => [],
        ];
        return view('customer.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer=MasterCustomersService::create($request->all());
        return redirect()->route('customer.index')->with('success', 'Customer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $data = [
            'title' => 'Form Edit Master Customer',
            'action' => 'Edit Data',
            'customer' => $customer,
        ];
        return view('customer.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer =  MasterCustomersService::update($request->all(), $customer);
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer=MasterCustomersService::delete($customer);
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully');
    }
}
