<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;
use App\Models\Category;
use App\Models\Unit;
use App\Services\KeranjangService;
use App\Services\MasterProductService;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'cart' => KeranjangService::show(),
            'title' => 'My Cart'
        ];
        return view('cart.index', $data);
    }

    public function getDataTable(){
        $data = KeranjangService::showApi();
        return response()->json($data);
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
    public function store(StoreKeranjangRequest $request)
    {
        $result = KeranjangService::create($request->all());
        return redirect()->route('my-cart.index')->with('success', 'Products add to cart successfully');
        // try {
        // } catch (\Throwable $th) {
        //     return redirect()->route('my-cart.index')->with('error', $th->getMessage());
        // }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        $query = "SELECT (i.product_stock + (select sum(po_qty) from purchase_orders where product_id = i.id group by product_id)) stock FROM `products` i WHERE i.id = " . $keranjang->product_id;
        $data = [
            'keranjang' => $keranjang,
            'title' => 'Detail Keranjang',
            'action' => 'Detail',
            'category_id' => Category::all(),
            'unit_id' => Unit::all(),
            'amt_stock' => DB::select($query)[0],
        ];
        return view('cart.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeranjangRequest $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        try {
            $delete = KeranjangService::delete($keranjang);
            return redirect()->route('my-cart.index')->with('success', 'Cart deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('my-cart.index')->with('error', $th->getMessage());
        }
    }
}
