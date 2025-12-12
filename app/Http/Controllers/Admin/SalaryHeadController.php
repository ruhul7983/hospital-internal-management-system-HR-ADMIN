<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryHeadController extends Controller
{
    private function getHospitalId(): int
    {
        return Auth::user()->hospital_id;
    }
    
    // --- INDEX ---
    public function index()
    {
        $hospitalId = $this->getHospitalId();
        
        $heads = SalaryHead::where('hospital_id', $hospitalId)
                           ->orderBy('is_basic', 'desc')
                           ->orderBy('name', 'asc')
                           ->get(); // Using get() since the list is likely small

        return view('admin.pages.salary.head.index', compact('heads'));
    }

    // --- CREATE ---
    public function create()
    {
        $types = ['Earning', 'Deduction', 'Allowance'];
        $calculationTypes = ['Fixed', 'Percentage'];
        return view('admin.pages.salary.head.create', compact('types', 'calculationTypes'));
    }

    // --- STORE ---
    public function store(Request $request)
    {
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:salary_heads,name,NULL,id,hospital_id,' . $hospitalId,
            'type' => 'required|in:Earning,Deduction,Allowance',
            'calculation_type' => 'required|in:Fixed,Percentage',
            'value' => 'required|numeric|min:0',
            'is_basic' => 'nullable|boolean',
            'is_editable' => 'nullable|boolean',
        ]);
        
        // Handle "Set as Basic" uniqueness logic
        if ($request->has('is_basic')) {
            SalaryHead::where('hospital_id', $hospitalId)->update(['is_basic' => false]);
        }

        SalaryHead::create([
            'hospital_id' => $hospitalId,
            'name' => $validated['name'],
            'type' => $validated['type'],
            'calculation_type' => $validated['calculation_type'],
            'value' => $validated['value'],
            'is_basic' => $request->has('is_basic'),
            'is_editable' => $request->has('is_editable'),
        ]);

        return redirect()->route('admin.salary.head.index')->with('success', 'Salary Head created successfully.');
    }

    // --- EDIT ---
    public function edit(SalaryHead $head)
    {
        if ($head->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        $types = ['Earning', 'Deduction', 'Allowance'];
        $calculationTypes = ['Fixed', 'Percentage'];
        return view('admin.pages.salary.head.edit', compact('head', 'types', 'calculationTypes'));
    }

    // --- UPDATE ---
    public function update(Request $request, SalaryHead $head)
    {
        if ($head->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        $hospitalId = $this->getHospitalId();

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:salary_heads,name,' . $head->id . ',id,hospital_id,' . $hospitalId,
            'type' => 'required|in:Earning,Deduction,Allowance',
            'calculation_type' => 'required|in:Fixed,Percentage',
            'value' => 'required|numeric|min:0',
            'is_basic' => 'nullable|boolean',
            'is_editable' => 'nullable|boolean',
        ]);
        
        // Handle "Set as Basic" uniqueness logic
        if ($request->has('is_basic')) {
            SalaryHead::where('hospital_id', $hospitalId)
                      ->where('id', '!=', $head->id)
                      ->update(['is_basic' => false]);
        }

        $head->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'calculation_type' => $validated['calculation_type'],
            'value' => $validated['value'],
            'is_basic' => $request->has('is_basic'),
            'is_editable' => $request->has('is_editable'),
        ]);

        return redirect()->route('admin.salary.head.index')->with('success', 'Salary Head updated successfully.');
    }

    // --- DESTROY ---
    public function destroy(SalaryHead $head)
    {
        if ($head->hospital_id !== $this->getHospitalId()) {
            abort(403);
        }
        
        if ($head->is_basic) {
            return back()->with('error', 'Cannot delete the designated Basic Salary Head.');
        }

        $head->delete();
        return back()->with('success', 'Salary Head deleted successfully.');
    }
}