<?php
use Illuminate\Support\Facades\Route;
Route::get('/user/dashboard', function () {
    return view('user.pages.dashboard');
})->name('user.dashboard');

Route::get('/user/dashboard/leave-management', function () {
    return view('user.pages.leave-management.index');
})->name('user.leave-management.index');
Route::get('/user/dashboard/leave-management/create', function () {
    return view('user.pages.leave-management.create');
})->name('user.leave-management.create');
Route::get('/user/dashboard/attendance/index', function () {
    return view('user.pages.attendance.index');
})->name('user.attendance.index');
Route::get('/user/dashboard/salary/index', function () {
    return view('user.pages.salary.index');
})->name('user.salary.index');