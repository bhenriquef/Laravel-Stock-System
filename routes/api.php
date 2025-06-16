<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialPurchaseController;
use App\Http\Controllers\MaterialPurchaseItemController;
use App\Http\Controllers\ProductMaterialController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\SaleProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ShippingsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;

Route::post('register',[UserController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[LoginController::class, 'logout']);

// Products
Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/new', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
})->middleware('auth:sanctum');

// Shippins
Route::apiResource('/shippings', ShippingsController::class)->middleware('auth:sanctum');

// Clients
Route::apiResource('/clients', ClientController::class)->middleware('auth:sanctum');

// Promotions
Route::apiResource('/promotions', PromotionsController::class)->middleware('auth:sanctum');

// Stock
Route::apiResource('/stock', StockController::class)->middleware('auth:sanctum');

// Sales
Route::apiResource('/sales', SalesController::class)->middleware('auth:sanctum');

// Sales Products
Route::apiResource('/sales_products', SaleProductsController::class)->middleware('auth:sanctum');

// Supplier
Route::apiResource('/supplier', SupplierController::class)->middleware('auth:sanctum');

// Materials
Route::apiResource('/material', MaterialController::class)->middleware('auth:sanctum');

// Material Purchase
Route::apiResource('/material_purchase', MaterialPurchaseController::class)->middleware('auth:sanctum');

// Material Purchase Item
Route::apiResource('/material_purchase_item', MaterialPurchaseItemController::class)->middleware('auth:sanctum');

// Product Material
Route::apiResource('/product_material', ProductMaterialController::class)->middleware('auth:sanctum');