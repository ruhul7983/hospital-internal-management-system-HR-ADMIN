<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route to handle the form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
});


Route::post('/super-admin/logout', [AuthController::class, 'logout'])
    ->name('super-admin.logout');

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('admin.dashboard');


require __DIR__.'/super-admin.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';