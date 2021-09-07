<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RestaurantController;
use App\Http\Controllers\Api\Restaurant\OfferController;
use App\Http\Controllers\Api\Restaurant\OrderController;
use App\Http\Controllers\Api\Restaurant\TokenController;
use App\Http\Controllers\Api\Restaurant\ProductController;



Route::group(["namespace" => "Api"], function () {

    ###########  Restaurant Auth     ################

    Route::post("/register", [RestaurantController::class, "register"]);
    Route::post("/login", [RestaurantController::class, "login"]);
    Route::post("/reset-password", [RestaurantController::class, "resetPassword"]);
    Route::post("/new-password", [RestaurantController::class, "newPassword"]);



    Route::middleware("auth:restaurant-api")->group(function () {
        // update restaurant Profile
        Route::post("/update", [RestaurantController::class, "restaurantUpdate"]);
        // get Notification
        Route::get("/notifications", [OrderController::class, "notifications"]);

        //  Product Resource
        Route::prefix("product")->group(function () {
            Route::post("/create", [ProductController::class, "createProduct"]);
            Route::post("/update", [ProductController::class, "updateProduct"]);
            Route::post("/delete", [ProductController::class, "deleteProduct"]);
            Route::post("/toggle-active", [ProductController::class, "toggleActive"]);
        });

        //  Offer Resource
        Route::prefix("offer")->group(function () {
            Route::post("/create", [OfferController::class, "createOffer"]);
            Route::post("/update", [OfferController::class, "updateOffer"]);
            Route::post("/delete", [OfferController::class, "deleteOffer"]);
        });


        Route::prefix("order")->group(function () {
            // Orders  Routes
            Route::get('/new', [OrderController::class, "newOrders"]);
            Route::get('/current', [OrderController::class, "currentOrders"]);
            Route::get('/pervious', [OrderController::class, "PerviousOrders"]);
            Route::post("/accept", [OrderController::class, "acceptOrder"]);
            Route::post("/reject", [OrderController::class, "rejectOrder"]);
            Route::post("/delivered-client", [OrderController::class, "deliveredOrderClient"]);
        });



        // Add and remove Restaurant token
        Route::post("/add-token", [TokenController::class, "addToken"]);
        Route::post("/remove-token", [TokenController::class, "removeToken"]);
        // Payment routes
        Route::post("/paid", [OrderController::class, "restaurantPaid"]);
        Route::post("/paid-report", [OrderController::class, "restaurantPaidReport"]);
    });
});
