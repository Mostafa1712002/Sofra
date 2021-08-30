<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\General\MainController;
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


############ General api routes ####################



Route::group(["prefix" => 'v1', "namespace" => "Api"], function () {


    Route::get('/restaurants', [MainController::class, "restaurants"]);
    Route::get('/products', [MainController::class, "products"]);
    Route::get('/comments', [MainController::class, "comments"]);
    Route::get('/restaurant-info', [MainController::class, "restaurantInfo"]);
    Route::get('/about-us', [MainController::class, "aboutUs"]);
    Route::get('/categories', [MainController::class, "categories"]);
    Route::get('/cities', [MainController::class, "cities"]);
    Route::get('/districts', [MainController::class, "districts"]);
    Route::get('/offers', [MainController::class, "offers"]);
    Route::post('/contact-us', [MainController::class, "contactUs"]);
    Route::post("/admin-token",[AuthController::class,"loginAdmin"]);

Route::group(["middleware"=> "auth:restaurant-api,client-api"],function(){
    Route::get("/get-settings",[MainController::class,"allSettings"]);
    Route::post("/update-settings",[MainController::class,"updateSettings"]);

});


});
