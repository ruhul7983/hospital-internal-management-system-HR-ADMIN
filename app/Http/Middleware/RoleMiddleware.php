<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if the user is authenticated first
        if (!Auth::check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();

        // Check if the authenticated user's role matches the required role
        if ($user->role !== $role) {
            // If the role doesn't match, deny access (HTTP 403 Forbidden)
            abort(403, 'Unauthorized. Access restricted to the ' . ucfirst($role) . ' role.');
        }

        // If the role matches, allow the request to proceed
        return $next($request);
    }
}
