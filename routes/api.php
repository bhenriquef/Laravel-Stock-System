<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::post('register',[UserController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[LoginController::class, 'logout']);

// Route::apiResource('/products', ProductController::class)->middleware('auth:sanctum');;
Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/new', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
})->middleware('auth:sanctum');

