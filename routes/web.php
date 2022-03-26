<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use Illuminate\Http\Request;

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
Route::get('/', [TodoController::class, 'index']);
Route::post("/", [TodoController::class, 'createTask']);
Route::post("/update", [TodoController::class, "update"]);
Route::get("/progress/{status}/{id}", [TodoController::class, "progress"]);
Route::get("/logout", [TodoController::class, "logout"]);

// login routes
Route::get("/login", [AuthController::class, 'getLoginTemplate']);
Route::post("/login", [AuthController::class, "userLogin"]);

// Create accout route
Route::get("/create-account", [AuthController::class, "getCreateAccountTemplate"]);
Route::post("/create-account", [AuthController::class, "createAccount"]);

// Manager routes
Route::get("/users", [ManagerController::class, "getUsers"]);
Route::get("/users/{id}", [ManagerController::class, "getUser"]);
Route::post("/users/{id}", [ManagerController::class, "createTask"]);
