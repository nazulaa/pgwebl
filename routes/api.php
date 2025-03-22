<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('api.points');
Route::get('/polyline', [ApiController::class, 'polyline'])->name('api.polyline');
Route::get('/polygon', [ApiController::class, 'polygon'])->name('api.polygon');
