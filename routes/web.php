<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\AsramaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\PageController;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

use App\Http\Controllers\RoleController;

Route::get('/children/generate-registration-number', [ChildController::class, 'generateRegistrationNumber'])->name('children.generate_registration_number');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('children', ChildController::class)->except(['index', 'show']);
        Route::resource('asramas', AsramaController::class)->except(['index', 'show']);
        Route::delete('/asramas/{asrama}/foto', [AsramaController::class, 'deleteFoto'])->name('asramas.delete_foto');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::delete('/children/documents/{document}', [ChildController::class, 'destroyDocument'])->name('children.documents.destroy');
    });


    // Accessible by User and Admin
    Route::get('/children', [ChildController::class, 'index'])->name('children.index');
    Route::get('/children/export', [ChildController::class, 'export'])->name('children.export');
    
    Route::get('/children/{child}', [ChildController::class, 'show'])->name('children.show');
    Route::get('/children/{child}/pdf', [ChildController::class, 'exportPdf'])->name('children.pdf');
    Route::get('/children/{child}/id-card', [ChildController::class, 'idCard'])->name('children.id_card');

    // Asrama Routes (accessible by all)
    Route::get('/asramas', [AsramaController::class, 'index'])->name('asramas.index');
    Route::get('/asramas/{asrama}', [AsramaController::class, 'show'])->name('asramas.show');

    // Laporan Keuangan Routes
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/create', [LaporanController::class, 'create'])->name('create');
        Route::post('/', [LaporanController::class, 'store'])->name('store');
        Route::get('/{laporan}', [LaporanController::class, 'show'])->name('show');
        Route::get('/{laporan}/edit', [LaporanController::class, 'edit'])->name('edit');
        Route::put('/{laporan}', [LaporanController::class, 'update'])->name('update');

        // Item management (only in draft)
        Route::post('/{laporan}/expense-item', [LaporanController::class, 'addExpenseItem'])->name('expense_item.store');
        Route::delete('/{laporan}/expense-item/{item}', [LaporanController::class, 'removeExpenseItem'])->name('expense_item.destroy');
        Route::post('/{laporan}/reimbursement-item', [LaporanController::class, 'addReimbursementItem'])->name('reimbursement_item.store');
        Route::delete('/{laporan}/reimbursement-item/{item}', [LaporanController::class, 'removeReimbursementItem'])->name('reimbursement_item.destroy');

        // Submit for approval
        Route::post('/{laporan}/submit', [LaporanController::class, 'submit'])->name('submit');
    });

    // Approval Routes
    Route::prefix('approval')->name('approval.')->group(function () {
        // Finance approval page
        Route::get('/finance', [ApprovalController::class, 'financeIndex'])
            ->name('finance.index');
        Route::post('/finance/{laporan}/approve', [ApprovalController::class, 'financeApprove'])
            ->name('finance.approve');

        // Director approval page
        Route::get('/director', [ApprovalController::class, 'directorIndex'])
            ->name('director.index');
        Route::post('/director/{laporan}/approve', [ApprovalController::class, 'directorApprove'])
            ->name('director.approve');

        // Reject (shared)
        Route::post('/{laporan}/reject', [ApprovalController::class, 'reject'])
            ->name('reject');
    });

    Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
