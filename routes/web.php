<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute Halaman Utama Mading (Ini yang akan memanggil desain grid poster)
Route::get('/', [EventController::class, 'index'])->name('home');

// Rute Form Upload Poster (Khusus yang sudah login)
Route::middleware('auth')->group(function () {
    // Menampilkan halaman form
    Route::get('/admin/tambah-poster', [EventController::class, 'create']);
    
    // Menangkap data form dan menyimpannya (BARIS BARU INI)
    Route::post('/admin/tambah-poster', [EventController::class, 'store']); 
});