<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeEntryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stempeluhr (Teil B: wird noch auf React/Inertia umgestellt – aktuell Blade)
    Route::get('/stempeln', [TimeEntryController::class, 'index'])->name('stempeln');
    Route::post('/kommen', [TimeEntryController::class, 'kommen'])->name('kommen');
    Route::post('/gehen', [TimeEntryController::class, 'gehen'])->name('gehen');
    Route::get('/uebersicht', [TimeEntryController::class, 'uebersicht'])->name('uebersicht');
});

require __DIR__.'/auth.php';
