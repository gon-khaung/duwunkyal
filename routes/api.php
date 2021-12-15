<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
Route::get("/admin/user/{user}", [UserController::class, "show"]);
Route::put("/admin/user/{user}", [UserController::class, "update"]);
Route::delete("/admin/user/{user}", [UserController::class, "destroy"]);
