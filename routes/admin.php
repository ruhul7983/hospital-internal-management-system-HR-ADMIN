<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DutyManagementController;

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('admin.dashboard');

// Shifts Management Routes
Route::get("/dashboard/hospital", function () {
    return view("admin.pages.setup.hospital.index");
})->name("admin.pages.setup.hospital.index");
Route::get("/dashboard/hospital/create", function () {
    return view("admin.pages.setup.hospital.create");
})->name("admin.pages.setup.hospital.create");
Route::get("/dashboard/hospital/edit", function () {
    return view("admin.pages.setup.hospital.edit");
})->name("admin.pages.setup.hospital.edit");

// Shifts Management Routes
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/shifts')->name('admin.pages.setup.shifts.')->group(function () {
    
    // index (GET /dashboard/shifts)
    Route::get('/', [ShiftController::class, 'index'])->name('index');

    // create (GET /dashboard/shifts/create)
    Route::get('/create', [ShiftController::class, 'create'])->name('create');
    
    // store (POST /dashboard/shifts/store)
    Route::post('/', [ShiftController::class, 'store'])->name('store');
    
    // edit (GET /dashboard/shifts/{shift}/edit)
    Route::get('/{shift}/edit', [ShiftController::class, 'edit'])->name('edit');

    // update (PUT/PATCH /dashboard/shifts/{shift})
    Route::put('/{shift}', [ShiftController::class, 'update'])->name('update');

    // destroy (DELETE /dashboard/shifts/{shift})
    Route::delete('/{shift}', [ShiftController::class, 'destroy'])->name('delete');
});


// Departments Management Routes
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/departments')->name('admin.pages.setup.departments.')->group(function () {
    
    // index (GET /dashboard/departments)
    Route::get('/', [DepartmentController::class, 'index'])->name('index');

    // create (GET /dashboard/departments/create)
    Route::get('/create', [DepartmentController::class, 'create'])->name('create');
    
    // store (POST /dashboard/departments)
    Route::post('/', [DepartmentController::class, 'store'])->name('store');
    
    // edit (GET /dashboard/departments/{department}/edit)
    // Note: Laravel can automatically find the Department model if the route variable matches the type-hint name
    Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');

    // update (PUT/PATCH /dashboard/departments/{department})
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');

    // destroy (DELETE /dashboard/departments/{department})
    Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('delete');
});

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




// Employee Management (Scoped by auth:web and role:admin)
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/employees')->name('admin.pages.employees.')->group(function () {
    
    // R E A D (Index)
    // GET /dashboard/employees
    Route::get('/', [EmployeeController::class, 'index'])->name('index'); 
    
    // C R E A T E
    // GET /dashboard/employees/create
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    // POST /dashboard/employees
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    
    // U P D A T E
    // GET /dashboard/employees/{employee}/edit
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    // PUT/PATCH /dashboard/employees/{employee}
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    
    // D E L E T E
    // DELETE /dashboard/employees/{employee}
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('delete');

    // C U S T O M  A C T I O N
    // PATCH /dashboard/employees/{user}/toggle-status
    // NOTE: This uses the User ID to target the 'is_active' column on the users table.
    Route::patch('/{user}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('toggleStatus');
});

// Duty managements
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/duty-management')->name('admin.pages.duty-management.')->group(function () {
    
    // R E A D (Index/Filter)
    // GET /dashboard/duty-management
    Route::get('/', [DutyManagementController::class, 'index'])->name('index');
    
    // C R E A T E / U P D A T E (Bulk Save)
    // POST /dashboard/duty-management
    Route::post('/', [DutyManagementController::class, 'bulkStore'])->name('bulkStore');
});

Route::get("/dashboard/leave-management", function () {
    return view("admin.pages.leave-management.index");
})->name("admin.pages.leave-management.index");


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