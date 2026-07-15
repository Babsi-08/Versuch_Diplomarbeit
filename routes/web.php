<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TimeEntryController;
use Illuminate\Support\Facades\Route;

// Login (nur für Gäste)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Geschützter Bereich (nur eingeloggt)
Route::middleware('auth')->group(function () {
    Route::get('/', [TimeEntryController::class, 'index'])->name('dashboard');
    Route::post('/kommen', [TimeEntryController::class, 'kommen']);
    Route::post('/gehen', [TimeEntryController::class, 'gehen']);
    Route::get('/uebersicht', [TimeEntryController::class, 'uebersicht'])->name('uebersicht');
});
