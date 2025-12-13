<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest; // Need this for Admin counts

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // === TARGET VIEWS ===
        // Target the main layouts/headers for Super Admin, Hospital Admin, and Employee (User)
        View::composer([
            'super-admin.partials.header', 
            'admin.layouts.main', 
            'user.layouts.main'
        ], function ($view) {
            
            $headerData = [
                'name' => null,
                'role' => null,
                'hospitalName' => null,
                'initial' => '?',
                'pendingNotifications' => 0,
            ];
            
            $user = null;

            // 1. Check Super Admin Guard
            if (Auth::guard('super_admin')->check()) {
                $user = Auth::guard('super_admin')->user();
                $headerData['role'] = 'Super Admin';
                
            } 
            // 2. Check Default (web) Guard for Admin/User roles
            elseif (Auth::check()) {
                $user = Auth::user();

                // Load necessary relationships
                $user->load('hospital');
                
                $headerData['role'] = $user->role;
                
                if ($user->hospital) {
                    $headerData['hospitalName'] = $user->hospital->name;
                }
                
                // Fetch Admin-Specific Metrics
                if ($user->role === 'admin') {
                    $headerData['pendingNotifications'] = LeaveRequest::where('hospital_id', $user->hospital_id)
                                                                    ->where('status', 'Pending')
                                                                    ->count();
                }
            }
            
            // Populate common user data if found
            if ($user) {
                $headerData['name'] = $user->name;
                // Assuming User model has a profile image attribute named 'profile_pic' or similar
                // $headerData['profilePic'] = $user->profile_pic;
                $headerData['initial'] = $this->getInitial($user->name); 
            }
            
            // Pass the consistent structure to all header views
            $view->with('headerData', $headerData);
        });
    }
    
    /**
     * Helper function to get the initials of the name.
     */
    protected function getInitial(string $name): string
    {
        $parts = explode(' ', trim($name));
        $initials = '';
        foreach ($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
            if (strlen($initials) >= 2) break; // Use maximum of two initials
        }
        return $initials;
    }
}