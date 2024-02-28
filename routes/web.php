<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class,'index']);
Route::post('/services/load-products',[MainController::class,'loadProduct']);
Route::get('/category/{id}-{slug}.html', [CategoryController::class,'index']);
Route::get('/san-pham/{id}-{slug}.html', [ProductController::class,'index']);
Route::post('add-cart',[CartController::class,'index']);
Route::get('/carts',[CartController::class,'show']);
Route::post('update-cart',[CartController::class,'update']);
Route::get('carts/delete/{id}',[CartController::class,'remove']);
Route::post('/carts',[CartController::class,'addCart']);




