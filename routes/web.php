<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EldDataController;

Route::post('/eld-data', [EldDataController::class, 'store']);
Route::get('/', function () {
    return view('welcome');
});
