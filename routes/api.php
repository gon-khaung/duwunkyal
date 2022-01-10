<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DynamicNameController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SitecontactController;
use App\Http\Controllers\UserController;

// use App\Http\Controllers\UserController;

Route::prefix("auth")->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("passwordChange", [AuthController::class, "passwordChange"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::post("password-reset", [AuthController::class, "passwordReset"]);
    Route::post("check-reset-token", [AuthController::class, "checkResetTokenAndId"]);

    Route::middleware("auth:api")->group(function () {
        Route::post("logout", [AuthController::class, "logout"]);
        Route::get("user", [AuthController::class, "user"]);
        Route::get("refresh", [AuthController::class, "refresh"]);
    });
});

// ==== category ====
Route::resource("categories", CategoryController::class);

// ==== dynamic ====
Route::resource("dynamicnames", DynamicNameController::class);

// ==== contact ====
Route::resource("contacts", ContactController::class);

// ==== site contact ====
Route::resource("sitecontacts", SitecontactController::class);

// ==== orders ====
Route::resource("orders", OrderController::class);

// ==== products ====
Route::resource("products", ProductController::class);

Route::get("shop_products", [ProductController::class, "shopProducts"]);

Route::post("users", [UserController::class, "index"]);
Route::put("users/{user}", [UserController::class, "update"]);
Route::delete("users/{user}", [UserController::class, "destroy"]);
