<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View return type
use App\Models\Hospital;
use App\Models\User; 
// Removed Auth facade and getInitial helper function

class DashboardController extends Controller
{
    /**
     * Display the super admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // 1. Total Hospitals
        $totalHospitals = Hospital::count();
        
        // 2. Total Doctors
        $totalDoctors = User::where('role', 'doctor')->count();
        
        // 3. Total Patients
        $totalPatients = User::where('role', 'patient')->count();

        // Data array to pass to the view
        $stats = [
            'totalHospitals' => $totalHospitals,
            'totalDoctors' => $totalDoctors,
            'totalPatients' => $totalPatients,
        ];
        
        // Return the dashboard view with the calculated statistics
        // The header data is now automatically attached by the View Composer!
        return view('super-admin.pages.dashboard', $stats);
    }
    
    // REMOVE THE getInitial() METHOD FROM HERE
}