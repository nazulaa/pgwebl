<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\PolylineController;

Route::get('/', [PointsController::class, 'index'])->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');

Route::post('/store-point', [TableController::class, 'store'])->name('store.point');

Route::resource('point', PointsController::class);

Route::resource('polylines', PolylineController::class);

Route::resource('polygons', PolygonController::class);
