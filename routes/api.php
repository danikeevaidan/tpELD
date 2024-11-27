<?php

use App\Events\DriverStatusChanged;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\ScheduleEntryController;
use App\Http\Controllers\EldDataController;
use App\Http\Controllers\NotificationController;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/{int:id}', [DriverController::class, 'show']);
Route::post('/eld-data', [EldDataController::class, 'store']);

Route::middleware('auth:sanctum')->post('/schedule-entries', [ScheduleEntryController::class, 'store']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);

Route::put('/read-notification', [NotificationController::class, 'readNotification']);

Route::get('/test', function (Request $request) {
    event(new DriverStatusChanged(Driver::find($request['id']), $request['message'], 'info'));
});
