<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ClientController;
use App\Http\Controllers\Api\Client\MainController;
use App\Http\Controllers\Api\Client\OrderController;
use App\Http\Controllers\Api\Client\TokenController;


Route::group(["namespace" => "Api"], function () {

    ###########  Client Auth     ################
    Route::post("/register", [ClientController::class, "register"]);
    Route::post("/login", [ClientController::class, "login"]);
    Route::post("reset-password", [ClientController::class, "resetPassword"]);
    Route::post("new-password", [ClientController::class, "newPassword"]);




    ########## Which is Must Auth    ##############
    Route::middleware(['auth:client-api'])->group(function () {
        Route::post("/update", [ClientController::class, "update"]);
        Route::post('/create-comment', [MainController::class, "createComment"]);
        Route::post("/add-token", [MainController::class, "addToken"]);
        Route::post("/remove-token", [MainController::class, "removeToken"]);
        Route::get("/notifications", [MainController::class, "notifications"]);


        Route::prefix("order")->group(function () {

            Route::get('/current', [OrderController::class, "currentOrders"]);
            Route::get('/pervious', [OrderController::class, "perviousOrders"]);

            Route::post("/new", [OrderController::class, "newOrder"]);
            Route::post('/decline', [OrderController::class, "declineOrder"]);
            Route::post('/finish', [OrderController::class, "finishOrder"]);
        });
    });
});
