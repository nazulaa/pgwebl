<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('api.points'); #semua
Route::get('/point/{id}', [ApiController::class, 'point'])->name('api.point'); #satu
Route::get('/polyline', [ApiController::class, 'polyline'])->name('api.polyline'); #semua
Route::get('/polylinee/{id}', [ApiController::class, 'polylinee'])->name('api.polylinee'); #satu
Route::get('/polygon', [ApiController::class, 'polygon'])->name('api.polygon'); #semua
Route::get('/polygonn/{id}', [ApiController::class, 'polygonn'])->name('api.polygonn'); #satu
