<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TableController;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('point', PointsController::class);
Route::resource('polylines', PolylineController::class);
Route::resource('polygons', PolygonController::class);

Route::get('/map', [PointsController::class, 'index'])
->middleware(['auth', 'verified'])
->name('map');
Route::get('/table', [TableController::class, 'index'])->name('table');

require __DIR__.'/auth.php';
