<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Product extends Model
{
    use HasFactory;

    /*
    Function show only status active
    Usage : $products = Product::active()->get();
    */
    public function scopeActive($query)
    {
        return $query->where('product_status', 'active');
    }

    /*
    Function show only status inactive
    Usage : $products = Product::inactive()->get();
    */
    public function scopeInactive($query)
    {
        return $query->where('product_status', 'inactive');
    }

    /*
    Function show product has stock
    Usage : $products = Product::hasStock()->get();
    */
    public function scopeHasStock($query)
    {
        return $query->where('product_stock', '>', 0);
    }

    /*
    Function show product has no stock
    Usage : $products = Product::hasNoStock()->get();
    */
    public function scopeHasNoStock($query)
    {
        return $query->where('product_stock', 0);
    }

    /*
    Function show product stock is less than minimum stock
    Usage : $products = Product::lessThanMinimumStock()->get();
    */
    public function scopeLessThanMinimumStock($query)
    {
        return $query->where('product_stock', '<', 'product_minimum_stock');
    }

    // category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }


    protected function id(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => Hashids::encode($value)
        );
    }


    public function resolveRouteBinding($value, $field = null)
    {
        return $this->findOrFail(Hashids::decode($value)[0]);
    }
}
