<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handles login and redirects based on the user's role.
     */
    public function login(Request $request)
    {
        // 1. Validate credentials (email/password only)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // 2. Attempt login using the default 'web' guard 
        //    (Allows ANY user in the 'users' table to authenticate if credentials match)
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            
            $request->session()->regenerate();
            
            $user = Auth::user();

            // 3. Check the user's role and redirect accordingly
            switch ($user->role) {
                case 'super_admin':
                    // If you have a separate Super Admin login flow
                    return redirect()->intended('/super-admin/dashboard'); 

                case 'admin':
                    // Hospital Admin redirect
                    return redirect()->intended('/dashboard');

                case 'Doctor':
                case 'Nurse':
                case 'Staff':
                    // Employee roles redirect
                    return redirect()->intended('/user/dashboard');

                default:
                    // Fallback redirect for any other role
                    return redirect()->intended('/');
            }
        }

        // Failure: If authentication failed (wrong email/password)
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    /**
     * Handles the generic logout for the web guard.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}