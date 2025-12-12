<?php
// app/Http/Controllers/Admin/EmployeeController.php (Full Code)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    private function getHospitalId(): int
    {
        // This is safe because of the 'role:admin' middleware check
        return Auth::user()->hospital_id;
    }

    // --- INDEX: View List of Employees ---
    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        
        // Eager load User and Department relationships for performance (N+1 fix)
        $employees = Employee::where('hospital_id', $hospitalId)
                             ->with(['user', 'department']) 
                             ->get(); // Get all for index page

        // Fetch all departments and roles for the filter dropdowns
        $departments = Department::where('hospital_id', $hospitalId)->get(['id', 'name']);
        $roles = ['Doctor', 'Nurse', 'Staff'];
        
        // You would apply filter logic here before calling ->get() if $request had filter values

        return view('admin.pages.employees.index', compact('employees', 'departments', 'roles'));
    }
    
    // --- CREATE: Show Form ---
    public function create()
    {
        $departments = Department::where('hospital_id', $this->getHospitalId())->get();
        $roles = ['Doctor', 'Nurse', 'Staff'];
        
        return view('admin.pages.employees.create', compact('departments', 'roles'));
    }

    // --- STORE: Create User & Employee (Transaction) ---
    public function store(Request $request)
    {
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            // User Data
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            
            // Role and Department Data
            'role' => 'required|in:Doctor,Nurse,Staff',
            'department_id' => 'nullable|exists:departments,id,hospital_id,' . $hospitalId, // Check exists and is scoped
            
            // Employee Data
            'phone' => 'nullable|string|max:20' ,
            'nid' => 'nullable|string|max:50|unique:employees,nid',
            'specialty' => 'nullable|string|max:100',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'picture' => 'nullable|image|max:2048', // 2MB max
            'active' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            // 1. Create the User (Login) Record
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'], // User model handles hashing via casts
                'role' => $validated['role'], 
                'hospital_id' => $hospitalId,
            ]);

            // 2. Handle Image Upload
            $picturePath = null;
            if ($request->hasFile('picture')) {
                $picturePath = $request->file('picture')->store('employee_pictures', 'public');
            }

            // 3. Create the Employee (Profile) Record
            Employee::create([
                'user_id' => $user->id,
                'hospital_id' => $hospitalId,
                'department_id' => $validated['department_id'] ?? null,
                'phone' => $validated['phone'] ,
                'nid' => $validated['nid'],
                'specialty' => $validated['specialty'],
                'date_of_birth' => $validated['dob'],
                'address' => $validated['address'],
                'picture' => $picturePath,
            ]);
            
            // 4. Update user status if necessary (since the checkbox input is 'active')
            $user->is_active = $request->has('active');
            $user->save();

            DB::commit();

            return redirect()->route('admin.pages.employees.index')
                             ->with('success', 'Employee created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($picturePath)) { Storage::disk('public')->delete($picturePath); }
            return back()->withInput()->with('error', 'Error creating employee: ' . $e->getMessage());
        }
    }

    // --- EDIT: Show Form ---
    // Use Route Model Binding to get the Employee, and eager load User/Department
    public function edit(Employee $employee)
    {
        // Security check: Ensure the employee belongs to the logged-in hospital
        if ($employee->hospital_id !== $this->getHospitalId()) {
            abort(403, "Access Denied: This employee is not part of your hospital's records.");
        }

        // Eager load the required relationships if they weren't loaded by route binding
        $employee->load('user', 'department');
        
        $departments = Department::where('hospital_id', $this->getHospitalId())->get(['id', 'name']);
        $roles = ['Doctor', 'Nurse', 'Staff'];
        
        return view('admin.pages.employees.edit', compact('employee', 'departments', 'roles'));
    }

    // --- UPDATE: Update User & Employee ---
    public function update(Request $request, Employee $employee)
    {
        if ($employee->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }

        $hospitalId = $this->getHospitalId();
        $user = $employee->user; // Get the related user record
        
        $validated = $request->validate([
            // User Data
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)], // Ignore current user's email
            'password' => 'nullable|string|min:6|confirmed', // Nullable for updates
            
            // Role and Department Data
            'role' => 'required|in:Doctor,Nurse,Staff',
            'department_id' => 'nullable|exists:departments,id,hospital_id,' . $hospitalId,
            
            // Employee Data
            'phone' => 'nullable|string|max:20',
            'nid' => ['nullable', 'string', 'max:50', Rule::unique('employees')->ignore($employee->id)], // Ignore current employee's NID
            'specialty' => 'nullable|string|max:100',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'picture' => 'nullable|image|max:2048', 
            'active' => 'nullable|boolean',
        ]);
        
        DB::beginTransaction();

        try {
            // 1. Update the User Record
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
            ];
            
            if ($request->filled('password')) {
                // The User model casts handle the hashing if 'password' field is present
                $userData['password'] = $validated['password'];
            }
            
            $user->update($userData);

            // 2. Handle Picture Update
            $picturePath = $employee->picture;
            if ($request->hasFile('picture')) {
                // Delete old picture
                if ($employee->picture) { Storage::disk('public')->delete($employee->picture); }
                $picturePath = $request->file('picture')->store('employee_pictures', 'public');
            }

            // 3. Update the Employee Profile
            $employee->update([
                'department_id' => $validated['department_id'] ?? null,
                'phone' => $validated['phone'],
                'nid' => $validated['nid'],
                'specialty' => $validated['specialty'],
                'date_of_birth' => $validated['dob'],
                'address' => $validated['address'],
                'picture' => $picturePath,
            ]);
            
            // 4. Update user status based on 'active' checkbox
            $user->is_active = $request->has('active');
            $user->save();

            DB::commit();

            return redirect()->route('admin.pages.employees.index')
                             ->with('success', 'Employee updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error updating employee: ' . $e->getMessage());
        }
    }
    
    // --- DESTROY: Delete Employee and User (Cascade handles this automatically) ---
    public function destroy(Employee $employee)
    {
        if ($employee->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        // Deleting the Employee triggers CASCADE on the User table's foreign key,
        // but since we link User->Employee, we delete the User to cascade down.
        // NOTE: If you linked Employee.user_id to User.id, deleting the User deletes the Employee.
        // Let's delete the Employee record, and let the user model handle cleanup.
        // Since you established a User->Employee HasOne relationship, it's cleaner to delete the User:
        $user = $employee->user;
        $user->delete(); // This should trigger the cascade delete of the Employee record

        // Manually delete picture if it exists
        if ($employee->picture) { Storage::disk('public')->delete($employee->picture); }
        
        return back()->with('success', 'Employee deleted successfully.');
    }
    
    // Placeholder for Toggle Status
    public function toggleStatus(User $user)
    {
        if ($user->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        $user->is_active = !$user->is_active;
        $user->save();
        
        return back()->with('success', 'Employee status updated.');
    }
}