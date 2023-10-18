<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Services\MasterProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class ViewProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'products' => MasterProductService::show($request),
            'title' => 'All Product Pixelshop',
            'category' => Category::all(),
        ];
        return view('products.index2', $data);
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
    public function store(Product $product)
    {
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = "SELECT (i.product_stock + (select sum(po_qty) from purchase_orders where product_id = i.id group by product_id)) stock FROM `products` i WHERE i.id = " . Hashids::decode($id)[0];
        // return Product::find($id);
        $data = [
            'product' => MasterProductService::select(Hashids::decode($id))[0],
            'title' => 'Detail Product',
            'action' => 'Detail',
            'category_id' => Category::all(),
            'unit_id' => Unit::all(),
            'amt_stock' => DB::select($query),
        ];
        
        return view('products.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
