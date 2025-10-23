<?php

use Illuminate\Support\Facades\Route;
Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('admin.dashboard');

Route::get("/dashboard/shifts", function () {
    return view("admin.pages.setup.shifts.index");
})->name("admin.pages.setup.shifts.index");


Route::get("/dashboard/shifts/create", function () {
    return view("admin.pages.setup.shifts.create");
})->name("admin.pages.setup.shifts.create");

Route::get("/dashboard/shifts/edit", function () {
    return view("admin.pages.setup.shifts.edit");
})->name("admin.pages.setup.shifts.edit");