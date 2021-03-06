<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

 */

######################## Admin  Control Panel ###################n################


Auth::routes();

Route::group(["middleware" => ["auth", "auto-check-permission"], "namespace" => "Web"], function () {

    Route::get("/", [HomeController::class, "index"])->name("home");
    // Ingredients of app Routes
    Route::resource('order', OrderController::class)->except("index,show");
    Route::resource('city', CityController::class)->except("edit,create");
    Route::resource('district', DistrictController::class)->except("edit,create");
    Route::resource('category', CategoryController::class)->except("edit,create");
    Route::resource("offer", OfferController::class)->only(["index", "destroy"]);
    Route::resource("contact", ContactController::class)->only(["index", "destroy"]);
    Route::resource('payment', PaymentController::class);

    //  Members of App Routes
    Route::resource('restaurant', RestaurantController::class)->only(["destroy", "show", "index"]);
    Route::post('/restaurant-active', [App\Http\Controllers\Web\RestaurantController::class, "active"])->name("restaurant.active");
    Route::resource('client', ClientController::class)->except("show");
    Route::post('/client-active', [App\Http\Controllers\Web\ClientController::class, "active"])->name("client.active");


    // Setting of App Routes
    Route::resource("/setting", SettingController::class)->only(["store", "index"]);

    // Roles and users
    Route::resource('user', UserController::class);
    Route::get("/password/edit", [App\Http\Controllers\Web\UserController::class, "editPassword"])->name("user.password-edit");
    Route::put("/password/update", [App\Http\Controllers\Web\UserController::class, "updatePassword"])->name("user.password-update");
    Route::resource('role', RoleController::class);
});
