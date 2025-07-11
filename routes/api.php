<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource('todo', TodoController::class)->middleware('auth:sanctum');

Route::get('me', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::delete('me', [UserController::class, 'destroy'])->middleware('auth:sanctum');