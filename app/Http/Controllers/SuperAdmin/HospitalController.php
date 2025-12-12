<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    // Show all hospitals
    public function index()
    {
        // Use the 'administrator' relationship defined in the Hospital model
        $hospitals = Hospital::with('administrator')->latest()->paginate(10);

        return view('super-admin.pages.hospital.index', compact('hospitals'));
    }

    // Show create form
    public function create()
    {
        return view('super-admin.pages.hospital.create');
    }

    // Store hospital - **Simplified for Debugging**
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Hospital Fields
            'hospitalName' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'officialEmail' => 'required|email|unique:hospitals,officialEmail',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',

            // Admin User Fields (Check email uniqueness in 'users' table)
            'adminName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Wrap operations in a database transaction for reliability
        DB::beginTransaction();

        // ⛔ IMPORTANT: Removed try/catch block to expose raw database errors ⛔

        // 1. Prepare Hospital Data
        $hospitalData = [
            'hospitalName' => $validated['hospitalName'],
            'officialEmail' => $validated['officialEmail'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $hospitalData['logo'] = $request->file('logo')->store('hospital_logos', 'public');
        }

        // 2. Create the Hospital Record
        $hospital = Hospital::create($hospitalData);

        // 3. Create the Admin User Record
        // Password casting in User model handles hashing automatically
        User::create([
            'name' => $validated['adminName'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Pass plain password, User model casts it
            'role' => 'admin',
            'hospital_id' => $hospital->id,
        ]);

        DB::commit();

        return redirect()->route('super-admin.hospital.index')
            ->with('success', 'Hospital and Admin Created Successfully.');
    }

    // Edit page
    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);

        return view('super-admin.pages.hospital.edit', compact('hospital'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);

        $validated = $request->validate([
            'hospitalName' => 'required|string|max:255',
            'officialEmail' => 'required|email|unique:hospitals,officialEmail,'.$hospital->id,
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'adminName' => 'required|string|max:255',
            'email' => 'required|email|unique:hospitals,email,'.$hospital->id,

        ]);

        if ($request->hasFile('logo')) {
            // 1. Delete old logo
            if ($hospital->logo) {
                Storage::disk('public')->delete($hospital->logo);
            }
            // 2. Store new logo
            $validated['logo'] = $request->file('logo')->store('hospital_logos', 'public');
        }

        $hospital->update($validated);

        return redirect()->route('super-admin.hospital.index')
            ->with('success', 'Hospital Updated Successfully.');
    }

    // Delete hospital
    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);

        if ($hospital->logo) {
            Storage::disk('public')->delete($hospital->logo);
        }

        $hospital->delete();

        return back()->with('success', 'Hospital Deleted Successfully.');
    }
}
