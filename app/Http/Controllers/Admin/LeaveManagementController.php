<?php

// app/Http/Controllers/Admin/LeaveManagementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class LeaveManagementController extends Controller
{
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }

    // --- INDEX: List All Leave Requests for the Hospital ---
    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        
        // Filter by Status (Pending is default)
        $filterStatus = $request->input('status', 'All');
        
        $query = LeaveRequest::where('hospital_id', $hospitalId)
                             // Eager load the user (employee) to display name/role
                             ->with('user'); 

        if ($filterStatus !== 'All') {
            $query->where('status', $filterStatus);
        }
        
        $leaveRequests = $query->orderBy('status', 'asc') // Pending first
                               ->orderBy('start_date', 'asc')
                               ->paginate(10); // Use pagination for large lists
                               
        // Calculate metrics for the cards (Total and Pending Count)
        $metrics = [
            'total' => LeaveRequest::where('hospital_id', $hospitalId)->count(),
            'pending' => LeaveRequest::where('hospital_id', $hospitalId)->where('status', 'Pending')->count(),
        ];
        
        $currentFilter = $filterStatus;

        return view('admin.pages.leave-management.index', compact('leaveRequests', 'metrics', 'currentFilter'));
    }

    // --- UPDATE STATUS: Approve/Reject a request ---
    public function updateStatus(Request $request, LeaveRequest $leaveRequest)
    {
        // 1. Security Check: Ensure the request belongs to this hospital
        if ($leaveRequest->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }

        // 2. Validation
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Approved', 'Rejected'])],
            // Only require rejection reason if rejecting
            'rejection_reason' => Rule::when($request->status === 'Rejected', 'required|string|max:500'),
        ]);

        // 3. Update the request
        $leaveRequest->status = $validated['status'];
        
        if ($validated['status'] === 'Rejected') {
            $leaveRequest->rejection_reason = $validated['rejection_reason'];
        } else {
            $leaveRequest->rejection_reason = null; // Clear if approved
        }
        
        $leaveRequest->save();

        return back()->with('success', "Leave request for {$leaveRequest->user->name} has been marked as {$validated['status']}.");
    }
}