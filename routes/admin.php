<?php

use Illuminate\Support\Facades\Route;
Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('admin.dashboard');

// Shifts Management Routes
Route::get("/dashboard/shifts", function () {
    return view("admin.pages.setup.shifts.index");
})->name("admin.pages.setup.shifts.index");
Route::get("/dashboard/shifts/create", function () {
    return view("admin.pages.setup.shifts.create");
})->name("admin.pages.setup.shifts.create");
Route::get("/dashboard/shifts/edit", function () {
    return view("admin.pages.setup.shifts.edit");
})->name("admin.pages.setup.shifts.edit");


// Departments Management Routes
Route::get("/dashboard/departments", function () {
    return view("admin.pages.setup.departments.index");
})->name("admin.pages.setup.departments.index");
Route::get("/dashboard/departments/create", function () {
    return view("admin.pages.setup.departments.create");
})->name("admin.pages.setup.departments.create");
Route::get("/dashboard/departments/edit", function () {
    return view("admin.pages.setup.departments.edit");
})->name("admin.pages.setup.departments.edit");

// Overtime managements
Route::get("/dashboard/overtimes", function () {
    return view("admin.pages.setup.overtimes.index");
})->name("admin.pages.setup.overtimes.index");
Route::get("/dashboard/overtimes/create", function () {
    return view("admin.pages.setup.overtimes.create");
})->name("admin.pages.setup.overtimes.create");
Route::get("/dashboard/overtimes/edit", function () {
    return view("admin.pages.setup.overtimes.edit");
})->name("admin.pages.setup.overtimes.edit");


// Employees managements
Route::get("/dashboard/employees", function () {
    return view("admin.pages.employees.index");
})->name("admin.pages.employees.index");
Route::get("/dashboard/employees/create", function () {
    return view("admin.pages.employees.create");
})->name("admin.pages.employees.create");
Route::get("/dashboard/employees/edit", function () {
    return view("admin.pages.employees.edit");
})->name("admin.pages.employees.edit");

// Duty managements

Route::get("/dashboard/duty-management", function () {
    return view("admin.pages.duty-management.index");
})->name("admin.pages.duty-management.index");


// Salary Management 
// Head
Route::get("/dashboard/salary/head", function () {
    return view("admin.pages.salary.head.index");
})->name("admin.salary.head.index");
Route::get("/dashboard/salary/head/create", function () {
    return view("admin.pages.salary.head.create");
})->name("admin.salary.head.create");
Route::get("/dashboard/salary/head/edit", function () {
    return view("admin.pages.salary.head.edit");
})->name("admin.salary.head.edit");


// Salary Management 
// Setup
Route::get("/dashboard/salary/setup", function () {
    return view("admin.pages.salary.setup.index");
})->name("admin.salary.setup.index");
// Route::get("/dashboard/salary/head/create", function () {
//     return view("admin.pages.salary.head.create");
// })->name("admin.salary.head.create");
// Route::get("/dashboard/salary/head/edit", function () {
//     return view("admin.pages.salary.head.edit");
// })->name("admin.salary.head.edit");

// Salary Management 
// Setup
Route::get("/dashboard/salary/generate", function () {
    return view("admin.pages.salary.generate.index");
})->name("admin.salary.setup.generate");