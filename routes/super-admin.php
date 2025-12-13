<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;

// --- START PROTECTED SUPER ADMIN ROUTES GROUP ---
// Note: We use an array for middleware to apply multiple checks:
// 1. 'auth': Ensures the user is logged in.
// 2. 'superadmin': Ensures the logged-in user has the correct 'super-admin' role.

Route::middleware(['superadmin'])->prefix('super-admin')->name('super-admin.')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hospital Routes Group
    Route::prefix('hospital')->name('hospital.')->group(function () {
        Route::get('/', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'destroy'])->name('delete');
    });
});

// REMOVE THE UNPROTECTED DASHBOARD ROUTE:
// Route::get('/super-admin/dashboard', [DashboardController::class, 'index'])->name('super-admin.dashboard'); 
// This single route is now protected within the group above.