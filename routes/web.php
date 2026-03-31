<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('children', ChildController::class)->except(['index', 'show']);
    });

    // Accessible by User and Admin
    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/export', [ChildController::class, 'export'])->name('children.export');
    Route::get('/children/{child}', [ChildController::class, 'show'])->name('children.show');
    Route::get('/children/{child}/pdf', [ChildController::class, 'exportPdf'])->name('children.pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
