<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Halaman User (Public)
|--------------------------------------------------------------------------
*/

// Redirect root ke login admin
Route::get('/', function () {
    return redirect()->route('login');
});

// Form tamu publik (untuk QR)
Route::get('/form-tamu', [TamuController::class, 'create'])->name('tamu.form');
Route::post('/form-tamu', [TamuController::class, 'store'])->name('tamu.store');

Route::get('/success', [TamuController::class, 'success'])->name('tamu.success');


/*
|--------------------------------------------------------------------------
| Login Admin
|--------------------------------------------------------------------------
*/

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Export
Route::get('/tamu/export', [TamuController::class, 'export'])->name('tamu.export');


/*
|--------------------------------------------------------------------------
| Dashboard Admin (Protected)
|--------------------------------------------------------------------------
*/
Route::get('/statistik', [TamuController::class, 'statistik'])->name('statistik');
Route::middleware('admin')->group(function () {

    Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('dashboard');
    Route::get('/daftar-tamu', [TamuController::class, 'index'])->name('tamu.index');
    Route::get('/home', [TamuController::class, 'home'])->name('home');

});
