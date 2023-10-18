<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
            $filename = $product->product_name . '_' . time() . '.' . $file->getClientOriginalExtension();
            $folder = "assets/images/product";
            $file->storeAs($folder, $filename, 'public');
            $product->product_image = $filename;
        } else {
            $product->product_image = 'default.jpg';
        }
        $product->save();
        ActivityLogService::logMasterCreate('Product', $product);
        return $product;
    }

    // show all data
    public static function show($request)
    {
        $cat_filter = $request->get('category_filter');
        $query = "SELECT (i.product_stock + (select sum(po_qty) from purchase_orders where product_id = i.id group by product_id)) stock, i.* FROM `products` i";
        $products = Product::with('units:unit_name', 'categories:category_name')->select(DB::raw('(products.product_stock + (select sum(po_qty) from purchase_orders where product_id = products.id group by product_id)) stock, products.*'));
        if($cat_filter){
            $products->where('products.category_id', Hashids::decode($cat_filter)[0]);
        }
        // $products = DB::select($query);
        $result = $products->orderBy('created_at', 'desc')->paginate(10);
        return $result;
    }

    public static function showApi()
    {
        $products = Product::with('units:unit_name', 'categories:category_name')->select(DB::raw('(products.product_stock + (select sum(po_qty) from purchase_orders where product_id = products.id group by product_id)) stock, products.*'))->get();
        // $products = DB::select($query);
        return $products;
    }

    public static function select($id){
        return Product::with('units:unit_name', 'categories:category_name')->select(DB::raw('(products.product_stock + (select sum(po_qty) from purchase_orders where product_id = products.id group by product_id)) stock, products.*'))->where('id', $id)->get();
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
            // delete image
            $old_image = $product->product_image;
            if ($old_image != 'default.jpg') {
                $path = '/assets/images/product/' . $old_image;
                Storage::disk('public')->delete($path);
            }
            $file = $data['product_image'];
            $filename = $product->product_name . '_' . time() . '.' . $file->getClientOriginalExtension();
            $folder = "assets/images/product";
            $file->storeAs($folder, $filename, 'public');
            $product->product_image = $filename;
        }
        $product->save();
        ActivityLogService::logMasterUpdate('Product', $product);
        return $product;
    }

    // delete data
    public static function delete($product)
    {
        // delete image
        $old_image = $product->product_image;
        if ($old_image != 'default.jpg') {
            $path = '/assets/images/product/' . $old_image;
            Storage::disk('public')->delete($path);
        }
        $product->delete();
        ActivityLogService::logMasterDelete('Product', $product);
        return $product;
    }
}
