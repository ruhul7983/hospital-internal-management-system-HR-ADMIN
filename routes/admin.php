<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DutyManagementController;
use App\Http\Controllers\Admin\LeaveManagementController;
use App\Http\Controllers\Admin\SalaryHeadController;
use App\Http\Controllers\Admin\SalarySetupController;
use App\Http\Controllers\Admin\SalaryGenerationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;

// Admin Dashboard
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard')->name('admin.')->group(function () {
    
    // GET /dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // ... (rest of your admin routes)
});
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout'); 

// FIX 2: Add the User Logout Route (as the header might be shared)
Route::post('user/logout', [AuthController::class, 'logout'])->name('user.logout');
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

// Leave Management (Admin Side)
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/leave-management')->name('admin.pages.leave-management.')->group(function () {
    
    // GET /dashboard/leave-management (Index/List)
    Route::get('/', [LeaveManagementController::class, 'index'])->name('index');
    
    // PATCH /dashboard/leave-management/{leaveRequest}/status (Approve/Reject Action)
    Route::patch('/{leaveRequest}/status', [LeaveManagementController::class, 'updateStatus'])->name('updateStatus');
    
    // Optional: Add a route for viewing details if a dedicated page is needed
    // Route::get('/{leaveRequest}', [LeaveManagementController::class, 'show'])->name('show');
});

// Salary Management 
// Head
// Salary Head Management (Admin Side)
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/salary/head')->name('admin.salary.head.')->group(function () {
    
    // GET /dashboard/salary/head
    Route::get('/', [SalaryHeadController::class, 'index'])->name('index');
    
    // GET /dashboard/salary/head/create
    Route::get('/create', [SalaryHeadController::class, 'create'])->name('create');
    
    // POST /dashboard/salary/head
    Route::post('/', [SalaryHeadController::class, 'store'])->name('store');
    
    // GET /dashboard/salary/head/{head}/edit
    Route::get('/{head}/edit', [SalaryHeadController::class, 'edit'])->name('edit');
    
    // PUT/PATCH /dashboard/salary/head/{head}
    Route::put('/{head}', [SalaryHeadController::class, 'update'])->name('update');

    // DELETE /dashboard/salary/head/{head}
    Route::delete('/{head}', [SalaryHeadController::class, 'destroy'])->name('delete');
});


// Salary Management 
// Setup
// Salary Setup Management (Admin Side)
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/salary/setup')->name('admin.salary.setup.')->group(function () {
    
    // GET /dashboard/salary/setup (Index/List)
    Route::get('/', [SalarySetupController::class, 'index'])->name('index');
    
    // POST /dashboard/salary/setup/{user} (Save setup for selected user)
    // NOTE: Passing user ID in the action route helps identify the recipient.
    Route::post('/{user}', [SalarySetupController::class, 'saveSetup'])->name('save');
});
// Route::get("/dashboard/salary/head/create", function () {
//     return view("admin.pages.salary.head.create");
// })->name("admin.salary.head.create");
// Route::get("/dashboard/salary/head/edit", function () {
//     return view("admin.pages.salary.head.edit");
// })->name("admin.salary.head.edit");

// Salary Management 
// Setup
Route::middleware(['auth:web', 'role:admin'])->prefix('dashboard/salary')->name('admin.salary.')->group(function () {
    
    // --- Salary Head (Setup Configuration) ---
    // (Assuming this group uses the prefix 'head' and name 'head.')
    
    // --- Salary Setup (Per User Assignment) ---
    // (Assuming this group uses the prefix 'setup' and name 'setup.')


    // =========================================================
    // FIX: SALARY GENERATION GROUP - Using your desired index name
    // =========================================================
    Route::prefix('generate')->group(function () {
        
        // 🔑 Index Route (Uses the specific name you provided in your question)
        // GET /dashboard/salary/generate
        Route::get('/', [SalaryGenerationController::class, 'index'])->name('setup.generate'); 
        
        // POST /dashboard/salary/generate/run (Performs the bulk calculation)
        // Full name: admin.salary.generate.run
        Route::post('/run', [SalaryGenerationController::class, 'generate'])->name('generate.run');
        
        // PATCH /dashboard/salary/generate/{record}/paid (Mark paid)
        // Full name: admin.salary.generate.markPaid
        Route::patch('/{record}/paid', [SalaryGenerationController::class, 'markPaid'])->name('generate.markPaid');
    });

    // NOTE: If your sidebar used "admin.salary.generate.index" before,
    // you must now change it to "admin.salary.setup.generate".
});
// for git