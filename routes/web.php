<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HewanController;

Route::get('/', [HewanController::class, 'index'])->name('hewan.index');
// Route::get('/hewan/tambah', [HewanController::class, 'create'])->name('hewan.create');
// Route::post('/hewan/simpan', [HewanController::class, 'store'])->name('hewan.store');
// Route::get('/hewan/edit/{id}', [HewanController::class, 'edit'])->name('hewan.edit');
// Route::post('/hewan/update/{id}', [HewanController::class, 'update'])->name('hewan.update');
// Route::delete('/hewan/hapus/{id}', [HewanController::class, 'destroy'])->name('hewan.destroy');

Route::resource('hewan', HewanController::class);
