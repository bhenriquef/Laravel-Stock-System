<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::post('register',[UserController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[LoginController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/products', ProductController::class)->middleware('auth:sanctum');;

