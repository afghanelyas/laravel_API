<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login" , [AuthController::class , "login"]);
Route::post("/register" , [AuthController::class , "register"]);
Route::post("/logout" , [AuthController::class , "logout"]);