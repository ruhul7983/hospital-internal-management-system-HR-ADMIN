<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\AttendanceController;
use App\Http\Controllers\User\LeaveManagementController;
use App\Http\Controllers\User\SalaryController;

Route::middleware(['auth:web', 'role:Doctor,Nurse,Staff'])->prefix('user')->name('user.')->group(function () {
    
    // R E A D (Dashboard Index)
    // GET /user/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // A C T I O N (Check In / Check Out)
    // POST /user/attendance
    Route::post('/attendance', [DashboardController::class, 'checkInOut'])->name('attendance.checkinout');
});

Route::middleware(['auth:web', 'role:Doctor,Nurse,Staff'])->prefix('user/dashboard/leave-management')->name('user.leave-management.')->group(function () {
    
    // GET /user/dashboard/leave-management
    Route::get('/', [LeaveManagementController::class, 'index'])->name('index');
    
    // GET /user/dashboard/leave-management/create
    Route::get('/create', [LeaveManagementController::class, 'create'])->name('create');
    
    // POST /user/dashboard/leave-management
    Route::post('/', [LeaveManagementController::class, 'store'])->name('store');
});

Route::middleware(['auth:web', 'role:Doctor,Nurse,Staff'])->prefix('user')->name('user.')->group(function () {
    
    // ... (Your other user routes) ...
    
    // Attendance History Index
    // GET /user/dashboard/attendance/index
    Route::get('/dashboard/attendance/index', [AttendanceController::class, 'index'])->name('attendance.index');
});


Route::middleware(['auth:web', 'role:Doctor,Nurse,Staff'])->prefix('user/dashboard/salary')->name('user.salary.')->group(function () {
    
    // GET /user/dashboard/salary/index
    Route::get('/index', [SalaryController::class, 'index'])->name('index');
    
    // Optional: View payslip details route could be added here
    // Route::get('/{payrollRecord}/view', [SalaryController::class, 'show'])->name('show');
});