<?php

use Illuminate\Support\Facades\Route;

Route::get('/super-admin/dashboard', function () {
    return view('super-admin.pages.dashboard');
})->name('super-admin.dashboard');

Route::prefix('super-admin')->name('super-admin.')->group(function () {

    Route::prefix('hospital')->name('hospital.')->group(function () {
        Route::get('/', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [App\Http\Controllers\SuperAdmin\HospitalController::class, 'destroy'])->name('delete');
    });
});


Route::get('/super-admin/subscription/', function () {
    return view('super-admin.pages.subscription.index');
})->name('super-admin.subscription.index');
Route::get('/super-admin/subscription/create', function () {
    return view('super-admin.pages.subscription.create');
})->name('super-admin.subscription.create');
Route::get('/super-admin/subscription/edit', function () {
    return view('super-admin.pages.subscription.edit');
})->name('super-admin.subscription.edit');
