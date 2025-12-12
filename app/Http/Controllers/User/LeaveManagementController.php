<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveManagementController extends Controller
{
    private function getUserId()
    {
        return Auth::id();
    }
    
    private function getHospitalId()
    {
        return Auth::user()->hospital_id;
    }

    // --- INDEX: List all leave requests for the user ---
    public function index()
    {
        $leaveRequests = LeaveRequest::where('user_id', $this->getUserId())
                                     ->orderBy('start_date', 'desc')
                                     ->get();
                                     
        return view('user.pages.leave-management.index', compact('leaveRequests'));
    }

    // --- CREATE: Show form for new request ---
    public function create()
    {
        // Default leave types for the dropdown
        $leaveTypes = [
            'casual' => 'Casual Leave',
            'sick' => 'Sick Leave',
            'emergency' => 'Emergency Leave',
            'unpaid' => 'Unpaid Leave',
        ];
        return view('user.pages.leave-management.create', compact('leaveTypes'));
    }

    // --- STORE: Handle submission of new leave request ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string|in:casual,sick,emergency,unpaid',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        LeaveRequest::create([
            'hospital_id' => $this->getHospitalId(),
            'user_id' => $this->getUserId(),
            'type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'status' => 'Pending', // Always pending upon submission
        ]);

        return redirect()->route('user.leave-management.index')
                         ->with('success', 'Leave request submitted successfully. Awaiting approval.');
    }
}