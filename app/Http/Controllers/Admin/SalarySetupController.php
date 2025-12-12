<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryHead;
use App\Models\SalaryHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalarySetupController extends Controller
{
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }

    // --- INDEX: Load data for the setup view ---
    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        $selectedUserId = $request->input('user_id');
        $weekOffDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        // 1. Fetch employee list (Users who are not 'admin' or 'super_admin')
        $employeeList = User::where('hospital_id', $hospitalId)
                            ->whereIn('role', ['Doctor', 'Nurse', 'Staff'])
                            ->orderBy('name')
                            ->get();

        $selectedUser = null;
        $salaryHeadsData = collect([]);
        $assignedWeekOff = null;
        
        if ($selectedUserId) {
            // 2. Fetch the selected user
            $selectedUser = User::where('id', $selectedUserId)
                                ->where('hospital_id', $hospitalId)
                                ->firstOrFail();

            // 3. Fetch all salary heads (configuration) for the hospital
            $allHeads = SalaryHead::where('hospital_id', $hospitalId)->get();
            
            // 4. Fetch the employee's custom assigned values/week off
            $assignedValues = EmployeeSalaryHead::where('user_id', $selectedUserId)
                                                ->pluck('assigned_value', 'salary_head_id');
            
            // Get the week off day from any assigned head, or null
            $assignedWeekOff = EmployeeSalaryHead::where('user_id', $selectedUserId)
                                                ->value('week_off_day');

            // 5. Merge configuration with assigned values
            $salaryHeadsData = $allHeads->map(function ($head) use ($assignedValues) {
                
                $head->current_value = $assignedValues->get($head->id, $head->value); // Default to head's value if not customised
                
                // Calculate display details (e.g., "40% of Basic")
                if ($head->calculation_type === 'Percentage') {
                    $head->display_multiplier = ($head->value * 100) . '%';
                } else {
                    $head->display_multiplier = number_format($head->value, 0);
                }
                
                return $head;
            });
        }

        return view('admin.pages.salary.setup.index', compact(
            'employeeList', 'selectedUser', 'salaryHeadsData', 'weekOffDays', 'assignedWeekOff'
        ));
    }

    // --- SAVE: Handle salary and week off assignment ---
    public function saveSetup(Request $request, User $user)
    {
        // 1. Security Check
        if ($user->hospital_id !== $this->getHospitalId() || !in_array($user->role, ['Doctor', 'Nurse', 'Staff'])) {
            abort(403);
        }

        // 2. Validation
        $validationRules = [
            'head_value.*' => 'required|numeric|min:0',
            'week_off' => 'nullable|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
        ];
        
        $validated = $request->validate($validationRules);
        $headValues = $validated['head_value'] ?? [];
        $weekOff = $validated['week_off'];
        $hospitalId = $this->getHospitalId();

        DB::beginTransaction();
        try {
            // 3. Get all relevant Salary Heads
            $allHeads = SalaryHead::where('hospital_id', $hospitalId)->get();

            // 4. Process Head Values
            foreach ($allHeads as $head) {
                // Check if the head's value was submitted (only editable fields might be submitted, 
                // but we rely on the hidden fields to ensure all values are sent)
                if (isset($headValues[$head->id])) {
                    
                    // Only save if the head is editable OR if it's the basic salary head
                    if ($head->is_editable || $head->is_basic) {
                        
                        $value = (float)$headValues[$head->id];
                        
                        EmployeeSalaryHead::updateOrCreate(
                            [
                                'user_id' => $user->id,
                                'salary_head_id' => $head->id,
                                'hospital_id' => $hospitalId
                            ],
                            [
                                'assigned_value' => $value,
                                'week_off_day' => $weekOff, // Update week off day in the same record
                            ]
                        );
                    }
                }
            }
            
            // 5. Handle Week Off Day for the whole employee record (using updateOrCreate approach)
            // Since we need to save the week off day even if no salary heads were customized,
            // we create a placeholder update/create if no salary heads were customized.
            if ($allHeads->isEmpty()) {
                 EmployeeSalaryHead::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'salary_head_id' => null, // Use null if you have a dummy head ID, or adapt the migration if you need to store it outside this table
                        'hospital_id' => $hospitalId
                    ],
                    [
                        'week_off_day' => $weekOff, 
                    ]
                );
            }


            DB::commit();
            return redirect()->route('admin.salary.setup.index', ['user_id' => $user->id])
                             ->with('success', "Salary and schedule setup saved for {$user->name}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error saving salary setup: ' . $e->getMessage());
        }
    }
}
