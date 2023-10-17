<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'role_description',
        'master_category',
        'master_product',
        'master_unit',
        'master_user',
        'master_role',
        'sales_order',
        'purchase_order',
        'keranjang',
        'delivery_status'
    ];
    // user
    public function users()
    {
        return $this->hasMany(User::class);
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
