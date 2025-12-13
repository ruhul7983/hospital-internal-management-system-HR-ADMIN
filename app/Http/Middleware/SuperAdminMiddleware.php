<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // CRITICAL FIX 1: Check authentication using the dedicated 'super_admin' guard.
        if (!Auth::guard('super_admin')->check()) { 
            // If not logged in as a super admin, redirect to the login page
            return redirect()->route('login'); 
        }

        // Fetch the authenticated user from the 'super_admin' guard
        $user = Auth::guard('super_admin')->user();
        
        // CRITICAL FIX 2: Check the role, using strtolower for robustness
        // (This check assumes the role column is on the SuperAdmin model/table)
        if (strtolower($user->role) !== 'super-admin') { 
            // Optional: Logout if the role somehow doesn't match
            Auth::guard('super_admin')->logout();
            return redirect('/')->with('error', 'Unauthorized access level.');
        }

        return $next($request);
    }
}