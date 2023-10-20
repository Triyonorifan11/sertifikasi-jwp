<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSalesOrderRequest;
use App\Models\SalesOrder;
use App\Services\KeranjangService;
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
            'title' => 'My Order',
            'count_my_cart' => KeranjangService::count(),
            'count_send_order' => SalesOrderService::count_send()
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

        $query = "SELECT (i.product_stock + IFNULL((SELECT SUM(po_qty) FROM purchase_orders WHERE product_id = i.id GROUP BY product_id), 0) - IFNULL((SELECT SUM(so_qty) FROM sales_orders WHERE product_id = i.id GROUP BY product_id), 0)) AS stock FROM `products` i WHERE i.id = " . $salesOrder[0]->product_id;
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
    public function update(UpdateSalesOrderRequest $request,SalesOrder $salesOrder)
    {
        try {
            $salesOrder = SalesOrder::find($salesOrder->id);
            // dd($salesOrder->status_so);
            // SalesOrderService::updatestatus($request->all(), $salesOrder);
            // if($request->status_so == 'Terkirim'){
            //     return redirect()->route('my-order.index')->with('success', 'Status Sales updated successfully');
            // }else{
            //     return redirect()->route('sales-order.index')->with('success', 'Status Sales updated successfully');
            // }
        } catch (\Throwable $th) {
            return redirect()->route('sales-order.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
