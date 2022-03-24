<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// index routes
Route::get('/', [HelloWorldController::class, 'index']);

// login routes
Route::get("/login", [AuthController::class, 'getLoginTemplate']);
Route::post("/login", [AuthController::class, "userLogin"]);

// Create accout route
Route::get("/create-account", [AuthController::class, "getCreateAccountTemplate"]);
Route::post("/create-account", [AuthController::class, "createAccount"]);
