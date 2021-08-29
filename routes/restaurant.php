<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RestaurantController;






Route::group(["prefix" => 'v1', "namespace" => "Api"], function () {

    ###########  Restaurant Auth     ################
    Route::post("/restaurant-register", [AuthController::class, "restaurantRegister"]);
    Route::post("/restaurant-login", [AuthController::class, "restaurantLogin"]);
    Route::post("restaurant-reset-password", [AuthController::class, "restaurantResetPassword"]);
    Route::post("restaurant-new-password", [AuthController::class, "restaurantNewPassword"]);

    Route::middleware("auth:restaurant-api")->group(function () {
        // update restaurant Profile
        Route::post("/restaurant-update", [AuthController::class, "restaurantUpdate"]);

        //  Product Resource
        Route::post("/create-product", [ProductController::class, "createProduct"]);
        Route::post("/update-product", [ProductController::class, "updateProduct"]);
        Route::post("/delete-product", [ProductController::class, "deleteProduct"]);
        //  Offer Resource
        Route::post("/create-offer", [OfferController::class, "createOffer"]);
        Route::post("/update-offer", [OfferController::class, "updateOffer"]);
        Route::post("/delete-offer", [OfferController::class, "deleteOffer"]);
        // Add and remove Restaurant token
        Route::post("/add-restaurant-token", [RestaurantController::class, "addToken"]);
        Route::post("/remove-restaurant-token", [RestaurantController::class, "removeToken"]);
        // Get Orders
        Route::post('/new-pending-orders', [RestaurantController::class, "newPendingOrders"]);
        Route::post('/current-pending-orders', [RestaurantController::class, "currentPendingOrders"]);
        Route::post('/restaurant-pervious-orders', [RestaurantController::class, "restaurantPerviousOrders"]);
        //   Order operations
        Route::post("/accept-order", [RestaurantController::class, "acceptOrder"]);
        Route::post("/reject-order", [RestaurantController::class, "rejectOrder"]);
        Route::post("/delivered-order", [RestaurantController::class, "deliveredOrder"]);

        // Payment routes
        Route::post("/restaurant-paid", [RestaurantController::class, "restaurantPaid"]);
        Route::post("/restaurant-paid-report", [RestaurantController::class, "restaurantPaidReport"]);
    });
});
