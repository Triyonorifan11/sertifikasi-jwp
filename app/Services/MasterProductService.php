<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
class MasterProductService
{
    // Your service logic here
    public static function create($data)
    {
        $product = new Product();
        $product->product_code = $data['product_code'];
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_stock = $data['product_stock'];
        $product->unit_id = Hashids::decode($data['unit_id'])[0];
        $product->category_id = Hashids::decode($data['category_id'])[0];
        $product->product_description = $data['product_description'];
        $product->product_minimum_stock = $data['product_minimum_stock'];
        $product->product_status = isset($data['product_status']) ? $data['product_status'] : 'inactive';
        if (isset($data['product_image'])) {
            $file = $data['product_image'];
            $filename = $product->product_name.'_'. time() . '.' . $file->getClientOriginalExtension();
            $folder = "assets/images/product";
            $file->storeAs($folder, $filename, 'public');
            $product->product_image = $filename;
        }else{
            $product->product_image = 'default.jpg';
        }
        $product->save();
        ActivityLogService::logMasterCreate('Product',$product);
        return $product;
    }

    // show all data
    public static function show()
    {
        $products = Product::with('units:unit_name', 'categories:category_name')->get();

        return $products;
    }

    // update data
    public static function update($data, $product)
    {
        $product->product_code = $data['product_code'];
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_stock = $data['product_stock'];
        $product->product_status = isset($data['product_status']) ? $data['product_status'] : 'inactive';
        $product->product_minimum_stock = $data['product_minimum_stock'];
        $product->unit_id = Hashids::decode($data['unit_id'])[0];
        $product->category_id = Hashids::decode($data['category_id'])[0];
        $product->product_description = $data['product_description'];
        // image
        if (isset($data['product_image'])) {
            // delete old image
            $old_image = $product->product_image;
            if($old_image != 'default.jpg'){
                $path = public_path('assets/images/product/'.$old_image);
                unlink($path);
            }
            $file = $data['product_image'];
            $filename = $product->product_name.'_'. time() . '.' . $file->getClientOriginalExtension();
            $folder = "assets/images/product";
            $file->storeAs($folder, $filename, 'public');
            $product->product_image = $filename;
        }
        $product->save();
        ActivityLogService::logMasterUpdate('Product',$product);
        return $product;
    }

    // delete data
    public static function delete($product)
    {
        // delete image
        $old_image = $product->product_image;
        if($old_image != 'default.jpg'){
            $path = public_path('assets/images/product/'.$old_image);
            unlink($path);
        }
        $product->delete();
        ActivityLogService::logMasterDelete('Product',$product);
        return $product;
    }
}
