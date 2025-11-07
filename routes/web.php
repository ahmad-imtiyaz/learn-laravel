<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\TentangController;

Route::get('/', [HaloController::class, 'index']);
Route::get('/tentang', [TentangController::class, 'index']);
Route::get('/hewan', [HewanController::class, 'index']);
