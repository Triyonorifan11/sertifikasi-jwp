<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Supplier::create([
            'supplier_name' => 'Umum',
            'supplier_address' => '',
            'supplier_phone' => '',
            'is_default' => true
        ]);
    }
}
