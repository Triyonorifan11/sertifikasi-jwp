<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class MasterCategoriesService
{
    // Your service logic here
    public static function create($data)
    {
        $masterCategories = new Category();
        $masterCategories->category_name = $data['category_name'];
        $masterCategories->icon = $data['icon'];
        $masterCategories->save();
        ActivityLogService::logMasterCreate('Category',$masterCategories);
        return $masterCategories;
    }

    // show all data
    public static function show()
    {
        $masterCategories = Category::paginate(3);
        return $masterCategories;
    }

    // update data
    public static function update($data, $category)
    {
        $category->category_name = $data['category_name'];
        $category->icon = $data['icon'];
        $category->save();
        ActivityLogService::logMasterUpdate('Category',$category);
        return $category;
    }

    // delete data
    public static function delete($category)
    {
        $category->delete();
        ActivityLogService::logMasterDelete('Category',$category);
        return $category;
    }
}
