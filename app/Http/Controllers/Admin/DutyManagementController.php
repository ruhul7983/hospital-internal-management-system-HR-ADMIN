<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DutyAssignment;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule; // Import Rule for conditional validation

class DutyManagementController extends Controller
{
    // ... getHospitalId and index methods remain the same ...

    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }

    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        $date = $request->input('duty_date', Carbon::today()->toDateString());
        $departments = Department::where('hospital_id', $hospitalId)->get(['id', 'name']);
        $shifts = Shift::where('hospital_id', $hospitalId)->get(['id', 'name', 'start_time', 'end_time']);
        $actorTypes = ['Doctor', 'Nurse', 'Staff'];
        
        $employeeQuery = User::where('hospital_id', $hospitalId)
                             ->whereIn('role', $actorTypes)
                             ->with('employee.department');

        if ($request->filled('actor_type')) {
            $employeeQuery->where('role', $request->actor_type);
        }

        $employees = $employeeQuery->get();

        $assignmentsData = DutyAssignment::where('hospital_id', $hospitalId)
                                         ->where('date', $date)
                                         ->get()
                                         ->keyBy('user_id');
        
        $assignments = $assignmentsData->map->shift_id;
        $statusMap = $assignmentsData->map->status;
        $assignedDeptMap = $assignmentsData->map->assigned_department_id; 

        return view('admin.pages.duty-management.index', compact(
            'date', 'departments', 'shifts', 'actorTypes', 'employees', 'assignments', 'statusMap', 'assignedDeptMap'
        ));
    }


    // --- BULK STORE: Handle form submission for saving multiple assignments ---
    public function bulkStore(Request $request)
    {
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            'duty_date' => 'required|date',
            'duty_assignments' => 'nullable|array',
            
            // FIX: Use Rule::when to skip exists check if the input is empty string (if disabled fields are enabled by JS)
            'duty_assignments.*.shift_id' => [
                'nullable', 'integer',
                Rule::when($request->filled('duty_assignments.*.shift_id'), [
                    'exists:shifts,id',
                ]),
            ],
            'duty_assignments.*.department_id' => [
                'nullable', 'integer',
                Rule::when($request->filled('duty_assignments.*.department_id'), [
                    'exists:departments,id',
                    // The exists rule already requires the field to exist in the table,
                    // but we can add hospital_id scoping here if needed, or rely on the query scope.
                ]),
            ],
            
            'duty_assignments.*.status' => 'required|in:Assigned,Not Assigned,On Leave',
        ]);

        $date = Carbon::parse($validated['duty_date'])->toDateString();
        $assignmentsData = $validated['duty_assignments'] ?? [];

        DB::beginTransaction();
        try {
            $userIds = array_keys($assignmentsData);
            
            DutyAssignment::where('hospital_id', $hospitalId)
                          ->where('date', $date)
                          ->whereIn('user_id', $userIds)
                          ->delete();

            $inserts = [];
            foreach ($assignmentsData as $userId => $assignment) {
                if ($assignment['status'] === 'Not Assigned') {
                    continue;
                }

                $isAssigned = $assignment['status'] === 'Assigned';

                $inserts[] = [
                    'hospital_id' => $hospitalId,
                    'user_id' => $userId,
                    'date' => $date,
                    'status' => $assignment['status'],
                    
                    // Conditionally set shift and assigned department IDs.
                    // We must ensure the input is not just an empty string passed from the disabled/re-enabled field.
                    'shift_id' => ($isAssigned && !empty($assignment['shift_id'])) ? $assignment['shift_id'] : null,
                    'assigned_department_id' => ($isAssigned && !empty($assignment['department_id'])) ? $assignment['department_id'] : null,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($inserts)) {
                DutyAssignment::insert($inserts);
            }

            DB::commit();
            
            return redirect()->route('admin.pages.duty-management.index', ['duty_date' => $date])
                             ->with('success', 'Duty assignments saved successfully for ' . $date);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to save assignments: ' . $e->getMessage());
        }
    }
}