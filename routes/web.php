<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// AuthController login, auth
Route::get('/no-access', [ErrorController::class, 'no_access'])->name('no-access');
Route::middleware(['logged'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});
// group middleware auth
Route::middleware(['auth'])->group(function () {
    // HomeController index
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('home.home');
    })->name('home');
    Route::middleware(['user'])->group(function () {
        Route::resource('/category', CategoryController::class);
        Route::resource('/unit', UnitController::class);
        Route::resource('/customer', CustomerController::class);
        Route::resource('/supplier', SupplierController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/view-product', ViewProductController::class);
        Route::resource('/keranjang', KeranjangController::class);
        Route::resource('/purchase-order', PurchaseOrderController::class);
    });
});
