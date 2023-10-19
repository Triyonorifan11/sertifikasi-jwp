<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Product;
use App\Services\PurchaseOrderService;
use App\Services\SalesOrderService;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'po' => PurchaseOrderService::show(),
            'title' => 'Daftar Purchase Order',
            'count_need_order' => SalesOrderService::count_pack(),
        ];
        return view('purchase_order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Purchase Order',
            'action' => 'New Data',
            'product' => Product::all(),
            'po' => [],
        ];
        return view('purchase_order.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        $po = PurchaseOrderService::create($request->all());
        return redirect()->route('purchase-order.index')->with('success', 'Purchase Order created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $data = [
            'title' => 'Form Purchase Order',
            'action' => 'Edit Data',
            'product' => Product::all(),
            'po' => $purchaseOrder,
        ];
        return view('purchase_order.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $po = PurchaseOrderService::update($request->all(), $purchaseOrder);
        return redirect()->route('purchase-order.index')->with('success', 'Purchase Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        try {
            PurchaseOrderService::delete($purchaseOrder);
            return redirect()->route('purchase-order.index')->with('success', 'Purchase Order deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('purchase-order.index')->with('error', $th->getMessage());
        }
    }
}
