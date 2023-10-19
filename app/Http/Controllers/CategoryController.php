<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\KeranjangService;
use App\Services\MasterCategoriesService;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => MasterCategoriesService::show(),
            'title' => 'Master Category',
            'count_my_cart' => KeranjangService::count(),
        ];
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Category',
            'action' => 'New Data',
            'category' => [],
        ];
        return view('category.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category=MasterCategoriesService::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $data = [
            'title' => 'Form Edit Master Category',
            'action' => 'Edit Data',
            'category' => $category,
        ];
        return view('category.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category =  MasterCategoriesService::update($request->all(), $category);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = MasterCategoriesService::delete($category);
        //parent::responseAPI($category, 'Category deleted successfully', OK);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
