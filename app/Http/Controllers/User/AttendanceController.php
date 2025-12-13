<?php
// app/Http/Controllers/User/AttendanceController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval; 
use Carbon\CarbonPeriod; // For iterating dates

class AttendanceController extends Controller
{
    // Define the time zone for display/calculations
    private const TIMEZONE = 'Asia/Dhaka'; 

    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $hospitalId = $user->hospital_id;

        // 1. Determine the employee's Start Date from the User model's created_at timestamp
        $startDateProxy = $user->created_at; 
        
        // --- 1. Get Month/Year for Filtering (Default to Current Month) ---
        $now = Carbon::now(self::TIMEZONE);
        $month = $request->input('month', $now->month);
        $year = $request->input('year', $now->year);

        $startOfMonth = Carbon::createFromDate($year, $month, 1, self::TIMEZONE)->startOfDay();
        $endOfMonth = Carbon::createFromDate($year, $month, 1, self::TIMEZONE)->endOfMonth()->endOfDay();
        
        // Ensure we only show up to today if viewing the current month
        if ($year == $now->year && $month == $now->month) {
            $endOfMonth = $now;
        }
        
        // --- CRITICAL FIX 1: Adjust $startOfMonth if it precedes the user's creation date ---
        $startDateForCalculation = $startOfMonth->copy();
        
        // If the 1st of the selected month is BEFORE the user's created_at date,
        // start counting from the created_at date instead.
        if ($startDateForCalculation->lt($startDateProxy->startOfDay())) {
             $startDateForCalculation = $startDateProxy->startOfDay();
        }

        // --- 2. Fetch Attendance Records for the Month ---
        $attendances = Attendance::where('user_id', $userId)
            // Use the original startOfMonth for the query to ensure we catch all records from that month
            ->whereBetween('check_in_at', [$startOfMonth, $endOfMonth])
            ->orderBy('check_in_at', 'desc')
            ->get();
            
        // --- 3. Calculate Monthly Metrics ---
        // Pass the adjusted start date ($startDateForCalculation)
        $metrics = $this->calculateMetrics($attendances, $startDateForCalculation, $endOfMonth);

        // --- 4. Prepare Variables for Dropdowns ---
        $currentMonth = $month;
        $currentYear = $year;
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::create()->month($i)->format('F');
        }
        $years = range($now->year - 2, $now->year + 1); 

        return view('user.pages.attendance.index', compact(
            'attendances', 'metrics', 'months', 'years', 'currentMonth', 'currentYear'
        ));
    }

    private function calculateMetrics($attendances, $startDateForCalculation, $endOfMonth)
    {
        $presentDaysCount = 0;
        $lateArrivalCount = 0;
        
        // Get unique dates the user was present
        $presentDates = $attendances->pluck('check_in_at')->map(fn($date) => $date->format('Y-m-d'))->unique();
        $workingDaysCount = 0;
        
        // Iterate only from the adjusted start date up to the end date
        // This prevents counting days before the user was registered.
        $period = CarbonPeriod::create($startDateForCalculation->startOfDay(), $endOfMonth->startOfDay());

        foreach ($period as $date) {
            $workingDaysCount++;
            $dateString = $date->format('Y-m-d');

            if ($presentDates->contains($dateString)) {
                $presentDaysCount++;
                
                // Late calculation
                $record = $attendances->first(fn($a) => $a->check_in_at->format('Y-m-d') === $dateString);
                
                if ($record && $record->check_out_at) {
                    // Example: Check for late arrival after 9:00 AM (09:00)
                    if ($record->check_in_at->setTimezone(self::TIMEZONE)->hour >= 9 && $record->check_in_at->setTimezone(self::TIMEZONE)->minute > 0) {
                         $lateArrivalCount++;
                    }
                }
            }
        }
        
        // Calculate days absent only for days the user was required to work (i.e., within the calculation period)
        $absentDaysCount = max(0, $workingDaysCount - $presentDaysCount);

        return [
            'working_days' => $workingDaysCount,
            'days_present' => $presentDaysCount,
            'late_arrivals' => $lateArrivalCount,
            'days_absent' => $absentDaysCount,
        ];
    }
}