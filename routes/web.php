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

######################## Admin  Control Panel ###################################


Auth::routes();

Route::group(["middleware" => "auth", "namespace" => "Web"], function () {

    Route::get("/", [HomeController::class, "index"]);
    Route::resource('city', CityController::class)->except("edit,create");
    Route::resource('district', DistrictController::class)->except("edit,create");
    Route::resource('category', CategoryController::class)->except("edit,create");














    Route::resource('user', UserController::class);
});
