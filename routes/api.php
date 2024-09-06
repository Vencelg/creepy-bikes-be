<?php

use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('places', [PlaceController::class, 'list']);
Route::get('places/{id}', [PlaceController::class, 'detail']);
