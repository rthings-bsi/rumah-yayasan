<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\AsramaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('children', ChildController::class)->except(['index', 'show']);
        Route::resource('asramas', AsramaController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class);
        Route::delete('/children/documents/{document}', [ChildController::class, 'destroyDocument'])->name('children.documents.destroy');
    });


    // Accessible by User and Admin
    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/export', [ChildController::class, 'export'])->name('children.export');
    Route::get('/children/generate-registration-number', [ChildController::class, 'generateRegistrationNumber'])->name('children.generate_registration_number');
    Route::get('/children/{child}', [ChildController::class, 'show'])->name('children.show');
    Route::get('/children/{child}/pdf', [ChildController::class, 'exportPdf'])->name('children.pdf');

    // Asrama Routes (accessible by all)
    Route::get('/asramas', [AsramaController::class, 'index'])->name('asramas.index');
    Route::get('/asramas/{asrama}', [AsramaController::class, 'show'])->name('asramas.show');
    Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
