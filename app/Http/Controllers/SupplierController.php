<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Services\MasterSupplierService;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'supplier' => MasterSupplierService::show(),
            'title' => 'Master Supplier'
        ];
        return view('supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Supplier',
            'action' => 'New Data',
            'supplier' => [],
        ];
        return view('supplier.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $customer=MasterSupplierService::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $data = [
            'title' => 'Form Master Supplier',
            'action' => 'Edit Data',
            'supplier' => $supplier,
        ];
        return view('supplier.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier=MasterSupplierService::update($request->all(), $supplier);
        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier=MasterSupplierService::delete($supplier);
        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully');
    }
}
