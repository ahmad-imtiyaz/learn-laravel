<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Route::get('/', [HewanController::class, 'index'])->name('hewan.index');
Route::get('/', fn() => redirect()->route('login'));

// 🔒 Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman User
Route::middleware('auth')->group(function () {
    Route::view('/akun', 'akun.index')->name('akun');
    Route::resource('hewan', HewanController::class)->only(['index']);
});

// halaman admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class); //manajemen user
    Route::resource('hewan', HewanController::class)->except(['index']); //CRUD hewan)
});

// akun dan password
Route::post('/akun/update-password', function (Request $request) {
    $request->validate([
        'password' => 'required|confirmed|min:5',
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success', 'Password berhasil diubah!');
})->name('akun.updatePassword')->middleware('auth');
