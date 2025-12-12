<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure the User model is imported

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Assuming your login view is still resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Handles the Hospital Admin login logic.
     * Checks credentials against the 'users' table and filters by role = 'admin'.
     */
    public function login(Request $request)
    {
        // 1. Validate the incoming form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // 2. Define the specific credentials including the role constraint.
        // This ensures the user must exist AND have the role 'admin'.
        $adminCredentials = array_merge($credentials, [
            'role' => 'admin' // <--- CRITICAL CHANGE: FILTERING FOR 'admin' ROLE
        ]);

        // 3. Attempt login using the default 'web' guard 
        //    (which uses App\Models\User and the 'users' table)
        if (Auth::guard('web')->attempt($adminCredentials, $request->filled('remember'))) {
            
            // Success: Regenerate session ID for security
            $request->session()->regenerate();

            // Redirect to the Hospital Admin dashboard
            // NOTE: I kept '/super-admin/dashboard' as per your last request, 
            // but you may want to change this path to something like '/admin/dashboard'
            return redirect()->intended('/dashboard'); 
        }

        // Failure: Redirect back with a generic error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    /**
     * Handles the generic logout for the web guard.
     */
    public function logout(Request $request)
    {
        // Use the default 'web' guard for logout
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}