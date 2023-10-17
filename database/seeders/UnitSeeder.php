<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initUnitsData =[
            // [
            //     'unit_name' => 'kg',
            // ],
            // [
            //     'unit_name' => 'gram',
            // ],
            // [
            //     'unit_name' => 'liter',
            // ],
            // [
            //     'unit_name' => 'ml',
            // ],
            [
                'unit_name' => 'pcs',
            ],
        ];
        // insert data to database
        foreach ($initUnitsData as $unit) {
            \App\Models\Unit::create($unit);
        }
    }
}
