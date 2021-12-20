<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

// use App\Http\Controllers\UserController;

Route::prefix("auth")->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("passwordChange", [AuthController::class, "passwordChange"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::get("refresh", [AuthController::class, "refresh"]);
    Route::get("user", [AuthController::class, "user"]);
    Route::middleware("auth:api")->group(function () {
        Route::post("logout", [AuthController::class, "logout"]);
    });
});

// ==== account ====
Route::resource("categories", CategoryController::class);
