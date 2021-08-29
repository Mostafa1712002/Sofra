<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;





Route::group(["prefix" => 'v1', "namespace" => "Api"], function () {

    ###########  Client Auth     ################
    Route::post("/client-register", [AuthController::class, "clientRegister"]);
    Route::post("/client-login", [AuthController::class, "clientLogin"]);
    Route::post("client-reset-password", [AuthController::class, "clientResetPassword"]);
    Route::post("client-new-password", [AuthController::class, "clientNewPassword"]);


    ########## Auth   ##############
    Route::middleware(['auth:client-api'])->group(function () {
        // update Client Profile
        Route::post("/client-update", [AuthController::class, "clientUpdate"]);
        //  Create Comments
        Route::post('/create-comment', [ClientController::class, "createComment"]);
        // Create new Order
        Route::post("new-order", [ClientController::class, "newOrder"]);
        // Add and remove client token
        Route::post("/add-client-token", [ClientController::class, "addToken"]);
        Route::post("/remove-client-token", [ClientController::class, "removeToken"]);

        // get current orders
        Route::post('/client-current-orders',[ClientController::class,"currentOrders"]);
        // get pervious orders
        Route::post('/client-pervious-orders',[ClientController::class,"perviousOrders"]);

        //  decline  Orders
        Route::post('/decline-order', [ClientController::class,"declineOrder"]);
        // Accept order form client
        Route::post('/finish-order', [ClientController::class,"finishOrder"]);


    });



});
