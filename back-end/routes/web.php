<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Rute untuk menampilkan halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk menangani proses login
Route::post('login', [LoginController::class, 'login']);

// Rute untuk halaman home (setelah login berhasil)
Route::get('/home', function () {
    return view('home');
})->middleware('auth');
