<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DutyAssignment;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }

    /**
     * Display the Admin dashboard view with aggregated data.
     */
    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        $today = Carbon::today()->toDateString();
        $now = Carbon::now();
        
        // --- 1. Key Metrics ---
        $employeeCount = User::where('hospital_id', $hospitalId)
                             ->whereIn('role', ['Doctor', 'Nurse', 'Staff'])
                             ->count();
                             
        $pendingLeaves = LeaveRequest::where('hospital_id', $hospitalId)
                                     ->where('status', 'Pending')
                                     ->count();
                                     
        // Today's Check-ins
        $todayCheckIns = Attendance::where('hospital_id', $hospitalId)
                                   ->whereDate('check_in_at', $today)
                                   ->count();

        // Total Net Pay Generated for the current year
        $ytdNetPay = PayrollRecord::where('hospital_id', $hospitalId)
                                  ->where('year', $now->year)
                                  ->sum('net_pay');

        $metrics = compact('employeeCount', 'pendingLeaves', 'todayCheckIns', 'ytdNetPay');


        // --- 2. Recent/Upcoming Activity ---
        
        // Upcoming Duties (Next 7 days)
        $nextWeek = $now->copy()->addDays(7)->toDateString();
        $upcomingDuties = DutyAssignment::where('hospital_id', $hospitalId)
                                        ->where('date', '>=', $today)
                                        ->where('date', '<=', $nextWeek)
                                        ->where('status', 'Assigned')
                                        ->with('user', 'assignedDepartment', 'shift')
                                        ->orderBy('date')
                                        ->limit(5)
                                        ->get();
        
        // Recent Leave Requests
        $recentLeaves = LeaveRequest::where('hospital_id', $hospitalId)
                                    ->with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();

        return view('admin.pages.dashboard', compact(
            'metrics',
            'upcomingDuties',
            'recentLeaves'
        ));
    }
}