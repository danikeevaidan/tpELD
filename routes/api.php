<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\EldDataController;
use Illuminate\Support\Facades\Route;

Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/{int:id}', [DriverController::class, 'show']);
Route::post('/eld-data', [EldDataController::class, 'store']);
