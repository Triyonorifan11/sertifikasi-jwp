<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Services\SalesOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'so' => SalesOrderService::show2(),
            'title' => 'My Order'
        ];
        return view('sales_order.index2', $data);
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
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'salesOrder' => SalesOrder::where('id', Hashids::decode($id))->get()[0],
            'title' => 'Sales Invoice',
            'action' => 'Detail',
        ];
        return view('sales_order.invoice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salesOrder = SalesOrder::where('id', Hashids::decode($id))->get();

        $query = "SELECT (i.product_stock + (select sum(po_qty) from purchase_orders where product_id = i.id group by product_id) - (select sum(so_qty) from sales_orders where product_id = i.id group by product_id)) stock FROM `products` i WHERE i.id = " . $salesOrder[0]->product_id;
        // return Product::find($id);
        $data = [
            'salesOrder' => $salesOrder[0],
            'title' => 'Detail My Order',
            'action' => 'Detail',
            'amt_stock' => DB::select($query),
        ];
        
        return view('sales_order.detail2', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
