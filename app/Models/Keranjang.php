<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Keranjang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
