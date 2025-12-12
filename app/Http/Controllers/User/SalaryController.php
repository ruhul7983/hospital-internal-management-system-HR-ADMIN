<?php
// app/Http/Controllers/User/SalaryController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PayrollRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Ensure this is imported

class SalaryController extends Controller
{
    private const TIMEZONE = 'Asia/Dhaka'; 

    public function index(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $now = Carbon::now(self::TIMEZONE); // <-- $now is defined here
        
        // 1. Determine the year for filtering (Default to current year)
        $selectedYear = $request->input('year', $now->year);

        // 2. Fetch all payroll records... (rest of logic)
        $payrollRecords = PayrollRecord::where('user_id', $userId)
            ->where('year', $selectedYear)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
            
        // 3. Calculate Summary Statistics... (rest of logic)
        $lastPayout = $payrollRecords->where('status', 'Paid')->first();
        $ytdNetPay = $payrollRecords->where('year', $now->year)->sum('net_pay');
        $nextPayDate = $this->calculateNextPayday($now);
        $daysInMonth = $now->daysInMonth;
        $currentDay = $now->day;
        $workingDaysRemaining = max(0, $daysInMonth - $currentDay);

        $stats = [
            'last_payout' => $lastPayout,
            'ytd_earnings' => $ytdNetPay,
            'next_pay_date' => $nextPayDate,
            'working_days_remaining' => $workingDaysRemaining,
        ];
        
        $years = range($now->year, $now->year - 3);

        // --- CRITICAL FIX: Pass $now to the view ---
        return view('user.pages.salary.index', compact(
            'payrollRecords', 'stats', 'years', 'selectedYear', 'now' // <-- ADDED 'now'
        ));
    }
    
    private function calculateNextPayday(Carbon $now): Carbon
    {
        $payday = 28;
        
        if ($now->day >= $payday) {
            return $now->copy()->addMonthNoOverflow()->day($payday);
        } else {
            return $now->copy()->day($payday);
        }
    }
}