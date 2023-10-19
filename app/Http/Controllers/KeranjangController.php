<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;
use App\Services\KeranjangService;
use App\Services\MasterProductService;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'products' => KeranjangService::show(),
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
        //
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
        //
    }
}
