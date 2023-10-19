<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/category', [CategoryController::class, 'store']);
Route::get('/product/getDataTable', [ProductController::class, 'getDataTable']);
Route::get('/my-cart/getDataTable', [KeranjangController::class, 'getDataTable']);
