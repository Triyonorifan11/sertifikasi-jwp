<?php

namespace App\Services;

use App\Models\InventoryHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class InventoryService
{
    // transaction
    public static function addStock(Product $product,$qty,$description){
        // check if product has enough stock
        self::create($product,$qty,$description);
        $product->product_stock += $qty;
        $product->save();
    }

    public static function reduceStock(Product $product,$qty,$description){
        // check if product has enough stock
        self::checkStock($product,$qty);
        self::create($product,-$qty,$description);
        $product->product_stock -= $qty;
        $product->save();
    }

    private static function checkStock(Product $product,$qty){
        if($product->product_stock < $qty){
            throw new \Exception('Stock is not enough');
        }
    }

    private static function create(Product $product,$qty,$description){
        $inventoryHistory = new InventoryHistory();
        $inventoryHistory->product_id = $product->id;
        $inventoryHistory->inital_stock = $product->product_stock;
        $inventoryHistory->description = $description;
        $inventoryHistory->input = $qty;
        $inventoryHistory->final_stock = $product->product_stock + $qty;
        $inventoryHistory->save();
    }
}
