<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Http\Requests\StoreSalesOrderRequest;
use App\Http\Requests\UpdateSalesOrderRequest;
use App\Models\Keranjang;
use App\Services\KeranjangService;
use App\Services\SalesOrderService;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'so' => SalesOrderService::show(),
            'title' => 'Daftar Sales Order',
            'count_need_order' => SalesOrderService::count_pack(),
        ];
        return view('sales_order.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesOrderRequest $request)
    {
        try {
            SalesOrderService::create($request->all());
            $keranjang = Keranjang::where('id', Hashids::decode($request->keranjang_id)[0]);
            KeranjangService::delete($keranjang);
            return redirect()->route('keranjang.index')->with('success', 'Order created successfully'); // ganti ke my-order untuk pembeli
        } catch (\Throwable $th) {
            return redirect()->route('keranjang.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesOrder $salesOrder)
    {
      
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesOrder $salesOrder)
    {
        $query = "SELECT (i.product_stock + IFNULL((SELECT SUM(po_qty) FROM purchase_orders WHERE product_id = i.id GROUP BY product_id), 0) - IFNULL((SELECT SUM(so_qty) FROM sales_orders WHERE product_id = i.id GROUP BY product_id), 0)) AS stock FROM `products` i WHERE i.id = " . $salesOrder->product_id;
        // return Product::find($id);
        $data = [
            'salesOrder' => $salesOrder,
            'title' => 'Detail Order',
            'action' => 'Detail',
            'count_need_order' => SalesOrderService::count_pack(),
            'amt_stock' => DB::select($query),
        ];
        
        return view('sales_order.detail', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesOrderRequest $request, SalesOrder $salesOrder)
    {
        try {
            SalesOrderService::updatestatus($request->all(), $salesOrder);
            if($request->status_so == 'Terkirim'){
                return redirect()->route('my-order.index')->with('success', 'Status Sales updated successfully');
            }else{
                return redirect()->route('sales-order.index')->with('success', 'Status Sales updated successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->route('sales-order.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}
