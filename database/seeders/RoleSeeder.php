<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Role::create([
                'role_name' => 'admin',
                'role_description' => 'admin',
                'master_product' => true,
                'master_user' => true,
                'master_role' => true,
                'master_unit' => true,
                'master_category' => true,
                'sales_order' => true,
                'purchase_order' => true,
                'keranjang' => true,
                'delivery_status' => true,
            ]);
    }
}
