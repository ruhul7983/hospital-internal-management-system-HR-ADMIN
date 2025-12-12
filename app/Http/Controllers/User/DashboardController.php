<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DutyAssignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // --- INDEX: Load Dashboard Data ---
    public function index()
    {
        $user = Auth::user();
        $hospitalId = $user->hospital_id;
        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::tomorrow()->toDateString();

        // 1. Get today's attendance status (if checked in)
        $currentAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_at', $today)
            ->latest()
            ->first();

        // Determine button state
        $hasCheckedIn = $currentAttendance && $currentAttendance->check_out_at === null;
        $canCheckIn = ! $currentAttendance || $currentAttendance->check_out_at !== null;

        // 2. Get upcoming duty assignments (from tomorrow onwards)
        $upcomingDuties = DutyAssignment::where('user_id', $user->id)
            ->where('status', 'Assigned')
            ->where('date', '>=', $tomorrow)
            ->with(['shift', 'assignedDepartment']) // Eager load Shift and Department details
            ->orderBy('date')
            ->limit(5) // Limit to next 5 duties
            ->get();

        return view('user.pages.dashboard', compact(
            'currentAttendance', 'hasCheckedIn', 'canCheckIn', 'upcomingDuties'
        ));
    }

    // --- CHECK IN/OUT LOGIC ---
    public function checkInOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $currentAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in_at', $today)
            ->latest()
            ->first();

        // CHECK OUT LOGIC
        if ($currentAttendance && $currentAttendance->check_out_at === null) {
            $currentAttendance->check_out_at = now();
            $currentAttendance->save();

            // 🔑 FIX: Localize the timestamp to Asia/Dhaka (BST) before formatting
            $localizedTime = $currentAttendance->check_out_at->timezone('Asia/Dhaka')->format('H:i:s');

            return back()->with('success', 'Successfully checked out at '.$localizedTime);
        }

        // CHECK IN LOGIC
        elseif (! $currentAttendance || $currentAttendance->check_out_at !== null) {

            $todayDuty = DutyAssignment::where('user_id', $user->id)
                ->where('status', 'Assigned')
                ->where('date', $today)
                ->first();

            $attendance = Attendance::create([ // Store the new record in a variable
                'user_id' => $user->id,
                'hospital_id' => $user->hospital_id,
                'check_in_at' => now(),
                'duty_assignment_id' => $todayDuty->id ?? null,
            ]);

            // 🔑 FIX: Localize the new timestamp to Asia/Dhaka (BST) before formatting
            $localizedTime = $attendance->check_in_at->timezone('Asia/Dhaka')->format('H:i:s');

            return back()->with('success', 'Successfully checked in at '.$localizedTime);
        }

        return back()->with('error', 'Error: Cannot perform check-in/out at this time.');
    }
}
