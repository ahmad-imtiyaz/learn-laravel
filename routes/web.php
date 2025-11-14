<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', fn() => redirect()->route('login'));

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ================== USER ======================
Route::middleware('auth')->group(function () {

    Route::get('/akun', fn() => view('akun.index'))->name('akun');

    // User hanya boleh LIHAT daftar hewan
    Route::get('/hewan', [HewanController::class, 'userIndex'])
        ->name('hewan.index');
});


// ================== ADMIN ======================
Route::middleware('auth')->group(function () {

    Route::get('/akun', fn() => view('akun.index'))->name('akun');

    Route::get('/hewan', [HewanController::class, 'userIndex'])
        ->name('hewan.index');
});
Route::middleware(['auth', 'admin'])->group(function () {

    // Kelola User
    Route::resource('users', UserController::class);

    // CRUD Hewan
    Route::get('/admin/hewan', [HewanController::class, 'adminIndex'])->name('admin.hewan.index');
    Route::get('/admin/hewan/create', [HewanController::class, 'create'])->name('admin.hewan.create');
    Route::post('/admin/hewan', [HewanController::class, 'store'])->name('admin.hewan.store');
    Route::get('/admin/hewan/{id}/edit', [HewanController::class, 'edit'])->name('admin.hewan.edit');
    Route::put('/admin/hewan/{id}', [HewanController::class, 'update'])->name('admin.hewan.update');
    Route::delete('/admin/hewan/{id}', [HewanController::class, 'destroy'])->name('admin.hewan.destroy');
});
