<?php

use App\Http\Controllers\Api\Admin\BrandController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DivisionController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Seller\SellerController;
use App\Http\Controllers\Api\ShopController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function(){

    Route::get('brands',[BrandController::class,'index']);
    Route::get('categories',[CategoryController::class,'index']);
    Route::get('products',[ProductController::class,'index']);
    Route::get('sliders',[SliderController::class,'index']);
    Route::get('divisions',[DivisionController::class,'index']);
    Route::get('sellers',[SellerController::class,'index']);

    Route::get('shop-products',[ShopController::class,'index']);

    Route::get('sellers/products/{slug}',[SellerController::class,'sellerProducts']);
});


