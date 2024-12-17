<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Rute untuk registrasi
Route::post('register', [AuthController::class, 'register']);

// Rute untuk login
Route::post('login', [AuthController::class, 'login']);

// Rute untuk mengambil data pengguna yang sudah terautentikasi (memerlukan autentikasi)
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);
