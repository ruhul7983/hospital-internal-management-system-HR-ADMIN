<?php
// app/Http/Controllers/User/AttendanceController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval; // Needed for calculating differences

class AttendanceController extends Controller
{
    // Define the time zone for display/calculations
    private const TIMEZONE = 'Asia/Dhaka'; 

    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $hospitalId = $user->hospital_id;

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

        // --- 2. Fetch Attendance Records for the Month ---
        $attendances = Attendance::where('user_id', $userId)
            ->whereBetween('check_in_at', [$startOfMonth, $endOfMonth])
            ->orderBy('check_in_at', 'desc')
            ->get();
            
        // --- 3. Calculate Monthly Metrics ---
        $metrics = $this->calculateMetrics($attendances, $startOfMonth, $endOfMonth);

        // --- 4. Prepare Variables for Dropdowns ---
        $currentMonth = $month;
        $currentYear = $year;
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::create()->month($i)->format('F');
        }
        $years = range($now->year - 2, $now->year + 1); // e.g., 2023 to 2026

        return view('user.pages.attendance.index', compact(
            'attendances', 'metrics', 'months', 'years', 'currentMonth', 'currentYear'
        ));
    }

    private function calculateMetrics($attendances, $startOfMonth, $endOfMonth)
    {
        $workingDaysCount = 0;
        $presentDaysCount = 0;
        $lateArrivalCount = 0;
        $absentDaysCount = 0;
        
        // Loop through all days in the month up to the end date
        $date = $startOfMonth->copy();
        while ($date->lte($endOfMonth->startOfDay())) { // Use startOfDay to compare dates only
            $workingDaysCount++;
            $date->addDay();
        }
        
        // Calculate based on records
        foreach ($attendances as $record) {
            // Check if record has a valid check-in and check-out
            if ($record->check_out_at) {
                $presentDaysCount++;
                
                // Example: Check for late arrival (requires knowing the expected shift start time)
                // Since we don't have the expected shift time here, we'll simulate a simple check (e.g., late if checked in after 9 AM)
                if ($record->check_in_at->setTimezone(self::TIMEZONE)->hour >= 9 && $record->check_in_at->setTimezone(self::TIMEZONE)->minute > 0) {
                     $lateArrivalCount++;
                }
            }
        }
        
        // Simple approximation for absent days (total days - present days)
        $absentDaysCount = max(0, $workingDaysCount - $presentDaysCount);

        return [
            'working_days' => $workingDaysCount,
            'days_present' => $presentDaysCount,
            'late_arrivals' => $lateArrivalCount,
            'days_absent' => $absentDaysCount,
        ];
    }
}