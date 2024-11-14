<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\EldDataController;
use Illuminate\Support\Facades\Route;

Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/{int:id}', [DriverController::class, 'show']);
Route::post('/eld-data', [EldDataController::class, 'store']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);
