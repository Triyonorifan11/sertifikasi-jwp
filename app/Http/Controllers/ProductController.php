<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Unit;
use App\Services\MasterProductService;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'products' => MasterProductService::show(),
            'title' => 'Master Products'
        ];
        return view('products.index', $data);
    }

    public function getDataTable(){
        $data = MasterProductService::showApi();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Products',
            'action' => 'New Data',
            // 'product' => '',
            'category_id' => Category::all(),
            'unit_id' => Unit::all(),
        ];
        return view('products.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            MasterProductService::create($request->all());
            return redirect()->route('products.index')->with('success', 'Products created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $query = "SELECT (i.product_stock + (select sum(po_qty) from purchase_orders where product_id = i.id group by product_id) - (select sum(so_qty) from sales_orders where product_id = i.id group by product_id)) stock FROM `products` i WHERE i.id = " . Hashids::decode($product->id)[0];

        $data = [
            'title' => 'Form Master Products',
            'action' => 'Edit Data',
            'product' => $product,
            'category_id' => Category::all(),
            'unit_id' => Unit::all(),
            'amt_stock' => DB::select($query),
        ];
        return view('products.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            MasterProductService::update($request->all(), $product);
            return redirect()->route('products.index')->with('success', 'Products updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            MasterProductService::delete($product);
            return redirect()->route('products.index')->with('success', 'Products deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', $th->getMessage());
        }
    }

}
