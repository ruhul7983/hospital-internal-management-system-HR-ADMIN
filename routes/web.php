<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('admin.dashboard');


require __DIR__.'/super-admin.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';