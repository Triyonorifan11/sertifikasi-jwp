<?php

namespace App\Services;

use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class KeranjangService
{
    // Your service logic here
    public static function showApi()
    {
        $products = Keranjang::with('user:name', 'product:product_name')->select(DB::raw('(products.product_stock + (select sum(po_qty) from purchase_orders where product_id = products.id group by product_id)) stock, products.*'))->where('user_id', Auth::user()->id)->get();
        // $products = DB::select($query);
        return $products;
    }

    public static function show(){
        $cart =  Keranjang::where('user_id', Auth::user()->id)->paginate(10);
        return $cart;
    }

    public static function count(){
        $cart = Keranjang::where('user_id', Auth::user()->id)->get();
        return $cart->count();
    }

    public static function create($data){
        $cart = new Keranjang();
        $cart = Keranjang::where('product_id', Hashids::decode($data['product_id'])[0])->where('user_id', $data['user_id'])->get();
        if($cart->count() == 1){
            self::updatestock($data, $cart);
        }else{
            self::createNew($data);
        }
    }

    private static function createNew($data){
        $keranjang = new Keranjang();
        $keranjang->product_id = Hashids::decode($data['product_id'])[0];
        $keranjang->qty = $data['qty'];
        $keranjang->user_id = $data['user_id'];
        $keranjang->save();
    }

    private static function updatestock($data, $cart){
        $cart[0]->product_id = Hashids::decode($data['product_id'])[0];
        $cart[0]->qty += $data['qty'];
        $cart[0]->user_id  = $data['user_id'];
        $cart[0]->save();
    }

    public static function delete($cart){
        $cart->delete();
        return $cart;
    }
}
