<?php

use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\FestivalsController;
use App\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FestivalsController::class, 'index']);

Route::resource('festivals', FestivalsController::class);
Route::resource('artists', ArtistsController::class);
Route::resource('locations', LocationsController::class);
