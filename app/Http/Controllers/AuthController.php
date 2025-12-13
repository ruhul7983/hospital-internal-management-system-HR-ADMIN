<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
// Assuming App\Models\SuperAdmin is implicitly available through the 'superadmin' guard configuration

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handles login and redirects based on the user's guard and role.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1️⃣ Try Super Admin login FIRST (Uses the dedicated 'superadmin' guard)
        if (Auth::guard('super_admin')->attempt($credentials)) { 
            $request->session()->regenerate();
            // This is where you set the path the Super Admin should land on
            return redirect()->intended(route('super-admin.dashboard')); 
        }

        // 2️⃣ Try normal users (users table, using the default 'web' guard)
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            // Use strtolower for case-insensitive role comparison for robustness
            switch (strtolower($user->role)) { 
                case 'admin':
                    return redirect('/dashboard'); // Hospital Admin dashboard

                case 'Doctor':
                case 'Nurse':
                case 'Staff':
                    return redirect('/user/dashboard'); // General User/Staff dashboard

                default:
                    // If the user has a role that isn't recognized or defined
                    Auth::guard('web')->logout();
                    return redirect('/')->with('error', 'Login successful, but role access is undefined.');
            }
        }

        // If both attempts fail
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    /**
     * Handles the generic logout, logging out from all custom guards.
     */
    public function logout(Request $request)
    {
        // Explicitly log out from both guards
        Auth::guard('web')->logout();
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}