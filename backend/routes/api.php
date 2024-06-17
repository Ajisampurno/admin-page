<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:api')->group(function () {

    Route::resource('dashboards', DashboardController::class);
    Route::resource('users', AuthController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('orders', OrderController::class);

    // Route untuk logout
    Route::post('logout', [AuthController::class, 'logout']);
});
