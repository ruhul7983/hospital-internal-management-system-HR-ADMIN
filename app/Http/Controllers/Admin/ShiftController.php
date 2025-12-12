<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    // Ensure Hospital Admin is logged in and get their Hospital ID
    private function getHospitalId(): int
    {
        // This relies on the 'auth:web' middleware ensuring a user is logged in.
        // The user model must have the hospital_id field.
        return Auth::user()->hospital_id;
    }

    public function index(Request $request)
    {
        $hospitalId = $this->getHospitalId();
        
        // Start query scoped to the hospital
        $query = Shift::where('hospital_id', $hospitalId);

        // Filter logic
        if ($request->filled('actor')) {
            $query->where('actor', $request->actor);
        }

        $shifts = $query->latest()->get();

        return view('admin.pages.setup.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('admin.pages.setup.shifts.create');
    }

    public function store(Request $request)
    {
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:shifts,name,NULL,id,hospital_id,' . $hospitalId, // Unique per hospital
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time', // Simple check, cross-midnight needs custom logic
            'actor' => 'required|in:Doctor,Nurse,Staff',
            'break_minutes' => 'nullable|integer|min:0',
            'crosses_midnight' => 'boolean',
        ]);
        
        // Add the mandatory hospital_id to the validated data
        Shift::create([
            'hospital_id' => $hospitalId,
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'actor' => $validated['actor'],
            'break_minutes' => $validated['break_minutes'] ?? 0,
            'crosses_midnight' => $request->has('crosses_midnight'),
        ]);

        return redirect()->route('admin.pages.setup.shifts.index')
            ->with('success', 'Shift created successfully.');
    }

    public function edit(Shift $shift)
    {
        // Use Policy or Manual Check: Ensure the shift belongs to the admin's hospital
        if ($shift->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        return view('admin.pages.setup.shifts.edit', compact('shift'));
    }

    public function update(Request $request, Shift $shift)
    {
        if ($shift->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        $hospitalId = $this->getHospitalId();
        
        $validated = $request->validate([
            // Unique check ignores the current shift's ID
            'name' => 'required|string|max:100|unique:shifts,name,' . $shift->id . ',id,hospital_id,' . $hospitalId,
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'actor' => 'required|in:Doctor,Nurse,Staff',
            'break_minutes' => 'nullable|integer|min:0',
            'crosses_midnight' => 'boolean',
        ]);

        $shift->update([
            'name' => $validated['name'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'actor' => $validated['actor'],
            'break_minutes' => $validated['break_minutes'] ?? 0,
            'crosses_midnight' => $request->has('crosses_midnight'),
        ]);

        return redirect()->route('admin.pages.setup.shifts.index')
            ->with('success', 'Shift updated successfully.');
    }

    public function destroy(Shift $shift)
    {
        if ($shift->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        $shift->delete();
        return back()->with('success', 'Shift deleted successfully.');
    }
}