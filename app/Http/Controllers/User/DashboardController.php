<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DutyAssignment;
use App\Models\Shift; // Make sure to use the Shift model if needed later
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private const TIMEZONE = 'Asia/Dhaka';
    private const GRACE_PERIOD_MINUTES = 30; // Allowed to check-in 30 mins early

    // --- INDEX: Load Dashboard Data ---
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today(self::TIMEZONE)->toDateString();
        $tomorrow = Carbon::tomorrow(self::TIMEZONE)->toDateString();
        $now = Carbon::now(self::TIMEZONE);
        
        // 1. Get today's duty and attendance
        $currentAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_at', $today)
            ->latest()
            ->first();
        
        $todayDuty = DutyAssignment::where('user_id', $user->id)
            ->where('status', 'Assigned')
            ->where('date', $today)
            ->with('shift') // Load shift details for the dashboard UI
            ->first();

        // 2. Determine eligibility for check-in
        $hasCheckedIn = $currentAttendance && $currentAttendance->check_out_at === null;
        $canCheckIn = ! $hasCheckedIn; // Default: can check in if not already checked in

        $isDutyTimeRunning = false;
        $dutyTimeInfo = null;

        if ($todayDuty && $todayDuty->shift) {
            $shift = $todayDuty->shift;
            
            // Calculate time window in BST/Dhaka time
            $shiftStartTime = Carbon::parse($today . ' ' . $shift->start_time, self::TIMEZONE);
            $shiftEndTime = Carbon::parse($today . ' ' . $shift->end_time, self::TIMEZONE);

            // Handle overnight shifts (end time is on the next day)
            if ($shiftEndTime->lt($shiftStartTime)) {
                $shiftEndTime->addDay();
            }

            $checkInWindowStart = $shiftStartTime->copy()->subMinutes(self::GRACE_PERIOD_MINUTES);
            
            // Check if current time is within the grace period or duty period
            if ($now->between($checkInWindowStart, $shiftEndTime)) {
                $isDutyTimeRunning = true;
            }
            
            $dutyTimeInfo = [
                'start' => $shiftStartTime->format('h:i A'),
                'end' => $shiftEndTime->format('h:i A'),
                'window_start' => $checkInWindowStart->format('h:i A'),
            ];
        }

        // Final Check-in permission logic: Must be eligible AND duty must be running
        $canCheckIn = $canCheckIn && $isDutyTimeRunning;


        // 3. Get upcoming duty assignments (from tomorrow onwards)
        $upcomingDuties = DutyAssignment::where('user_id', $user->id)
            ->where('status', 'Assigned')
            ->where('date', '>=', $tomorrow)
            ->with(['shift', 'assignedDepartment'])
            ->orderBy('date')
            ->limit(5)
            ->get();

        return view('user.pages.dashboard', compact(
            'currentAttendance', 
            'hasCheckedIn', 
            'canCheckIn', // New conditional flag for enabling the button
            'upcomingDuties',
            'todayDuty', // Pass today's duty for display
            'isDutyTimeRunning', // Pass boolean for messaging
            'dutyTimeInfo' // Pass time window for display
        ));
    }

    // --- CHECK IN/OUT LOGIC (Enforces the Rule) ---
    public function checkInOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today(self::TIMEZONE)->toDateString();
        $now = Carbon::now(self::TIMEZONE);
        
        // Find today's assignment and existing attendance
        $currentAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_at', $today)
            ->latest()
            ->first();

        // 1. CHECK OUT LOGIC (No time restriction needed)
        if ($currentAttendance && $currentAttendance->check_out_at === null) {
            $currentAttendance->check_out_at = $now;
            $currentAttendance->save();

            $localizedTime = $currentAttendance->check_out_at->timezone(self::TIMEZONE)->format('H:i:s');
            return back()->with('success', 'Successfully checked out at '.$localizedTime);
        }

        // 2. CHECK IN LOGIC (Enforce Duty Time)
        elseif (! $currentAttendance || $currentAttendance->check_out_at !== null) {

            $todayDuty = DutyAssignment::where('user_id', $user->id)
                ->where('status', 'Assigned')
                ->where('date', $today)
                ->with('shift')
                ->first();

            // --- ENFORCEMENT START ---
            if (! $todayDuty || ! $todayDuty->shift) {
                return back()->with('error', 'Error: You have no duty assigned for today.');
            }

            $shift = $todayDuty->shift;
            $shiftStartTime = Carbon::parse($today . ' ' . $shift->start_time, self::TIMEZONE);
            $shiftEndTime = Carbon::parse($today . ' ' . $shift->end_time, self::TIMEZONE);

            // Handle overnight shifts
            if ($shiftEndTime->lt($shiftStartTime)) {
                $shiftEndTime->addDay();
            }

            $checkInWindowStart = $shiftStartTime->copy()->subMinutes(self::GRACE_PERIOD_MINUTES);
            
            if (! $now->between($checkInWindowStart, $shiftEndTime)) {
                $start = $checkInWindowStart->format('h:i A');
                $end = $shiftEndTime->format('h:i A');
                return back()->with('error', "Check-in failed. Your duty time is only running between {$start} and {$end}.");
            }
            // --- ENFORCEMENT END ---

            $attendance = Attendance::create([
                'user_id' => $user->id,
                'hospital_id' => $user->hospital_id,
                'check_in_at' => $now,
                'duty_assignment_id' => $todayDuty->id ?? null,
            ]);

            $localizedTime = $attendance->check_in_at->timezone(self::TIMEZONE)->format('H:i:s');
            return back()->with('success', 'Successfully checked in at '.$localizedTime);
        }

        return back()->with('error', 'Error: Cannot perform check-in/out at this time.');
    }
}