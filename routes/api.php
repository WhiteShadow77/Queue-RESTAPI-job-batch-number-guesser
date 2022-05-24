<?php

use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/logs', [HomeController::class, 'show']);
Route::get('/logs/clear', [HomeController::class, 'clear']);
Route::get('/start', [HomeController::class,'start']);
Route::get('/batch', [HomeController::class,'batchInfo']);
Route::get('/cancel', [HomeController::class,'batchCancel']);
