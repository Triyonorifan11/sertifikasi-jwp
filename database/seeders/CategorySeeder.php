<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $initCategoryData = [
            [
                'category_name' => 'Makanan',
                'icon' => 'fas fa-utensils'
            ],
            [
                'category_name' => 'Minuman',
                "icon" => "fas fa-glass-martini-alt",
            ],
            [
                'category_name' => 'Bumbu',
                "icon" => "fas fa-pepper-hot",
            ],
            [
                'category_name' => 'Peralatan',
                "icon" => "fas fa-blender",
            ],
        ];
        // insert data to database
        foreach ($initCategoryData as $category) {
            \App\Models\Category::create($category);
        }
    }
}
