<?php

use Illuminate\Support\Facades\Route;

Route::get('/super-admin/dashboard', function () {
    return view('super-admin.pages.dashboard');
})->name('super-admin.dashboard');

Route::get('/super-admin/hospital/', function () {
    return view('super-admin.pages.hospital.index');
})->name('super-admin.hospital.index');
Route::get('/super-admin/hospital/create', function () {
    return view('super-admin.pages.hospital.create');
})->name('super-admin.hospital.create');

Route::get('/super-admin/subscription/', function () {
    return view('super-admin.pages.subscription.index');
})->name('super-admin.subscription.index');
Route::get('/super-admin/subscription/create', function () {
    return view('super-admin.pages.subscription.create');
})->name('super-admin.subscription.create');
Route::get('/super-admin/subscription/edit', function () {
    return view('super-admin.pages.subscription.edit');
})->name('super-admin.subscription.edit');
