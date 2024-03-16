<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MerchantController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProductImgsController;
use App\Http\Controllers\Api\SliderController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post("register/admin" , "adminRegister");
    Route::post("register/customer" , "customerRegister");
    Route::post("register/merchant" , "merchantRegister");
    Route::post("login/superAdmin" , "superAdminLogin")->middleware('superadmin');
    Route::post("login/admin" , "adminLogin")->middleware('admin');
    Route::post("login/customer" , "customerLogin")->middleware('customer');
    Route::post("login/merchant" , "merchantLogin")->middleware('merchant');
    Route::post("logout" , "logout")->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum','supercontroller'])->group(function(){
    Route::apiResources([
        "admins" => AdminController::class,
    ]);
});


Route::apiResources([
    "categories" => CategoryController::class,
    "items" => ItemController::class,
    "products" => ProductController::class,
    "product/images" => ProductImgsController::class,
    "customers" => CustomerController::class,
    "merchants" => MerchantController::class,
    "infos" => InfoController::class,
    "messages" => MessageController::class,
    "notifications" => NotificationController::class,
    "sliders" => SliderController::class,
]);

Route::get("product-images/{productId}",[ProductImgsController::class , 'oneProductImages']);