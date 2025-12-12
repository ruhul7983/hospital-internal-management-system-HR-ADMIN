<?php

// app/Http/Controllers/Admin/DepartmentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    // Helper to get the current admin's hospital ID
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }
    
    // index: Display a listing of the departments (scoped)
    public function index()
    {
        $departments = Department::where('hospital_id', $this->getHospitalId())
                                 ->orderBy('name')
                                 ->get();

        return view('admin.pages.setup.departments.index', compact('departments'));
    }

    // create: Show the form for creating a new department
    public function create()
    {
        // Actor types for checkboxes
        $actorTypes = ['Doctor', 'Nurse', 'Administrator', 'Technician'];
        return view('admin.pages.setup.departments.create', compact('actorTypes'));
    }

    // store: Store a newly created department in storage
    public function store(Request $request)
    {
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:departments,name,NULL,id,hospital_id,' . $hospitalId,
            'description' => 'nullable|string',
            'actor_types' => 'nullable|array', // Array of selected roles
            'actor_types.*' => 'in:Doctor,Nurse,Administrator,Technician', // Validate each item in the array
            'is_active'   => 'nullable|boolean',
        ]);
        
        Department::create([
            'hospital_id' => $hospitalId,
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            // Store selected actors as JSON array
            'actor_types' => $validated['actor_types'] ?? [], 
            // Checkbox value '1' (checked) is true, otherwise it is missing/false.
            'is_active'   => $request->has('is_active'), 
        ]);

        return redirect()->route('admin.pages.setup.departments.index')
                         ->with('success', 'Department created successfully.');
    }

    // edit: Show the form for editing the specified department (scoped)
    public function edit(Department $department)
    {
        // Security check: Ensure the department belongs to the logged-in hospital
        if ($department->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        $actorTypes = ['Doctor', 'Nurse', 'Administrator', 'Technician'];
        return view('admin.pages.setup.departments.edit', compact('department', 'actorTypes'));
    }

    // update: Update the specified department in storage
    public function update(Request $request, Department $department)
    {
        // Security check
        if ($department->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            // Unique check ignores the current department's ID
            'name'        => 'required|string|max:100|unique:departments,name,' . $department->id . ',id,hospital_id,' . $hospitalId,
            'description' => 'nullable|string',
            'actor_types' => 'nullable|array',
            'actor_types.*' => 'in:Doctor,Nurse,Administrator,Technician',
            'is_active'   => 'nullable|boolean',
        ]);

        $department->update([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'actor_types' => $validated['actor_types'] ?? [],
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.pages.setup.departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    // destroy: Remove the specified department from storage
    public function destroy(Department $department)
    {
        // Security check
        if ($department->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        $department->delete();
        return back()->with('success', 'Department deleted successfully.');
    }
}