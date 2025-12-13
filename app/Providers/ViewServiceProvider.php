<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        // 🚨 CRITICAL FIX: The view path must match where the partial is located.
        // Assuming your layout includes: @include('super-admin.partials.header')
        View::composer('super-admin.partials.header', function ($view) {
            
            // Initialize headerData as an empty array
            $headerData = [];
            
            // Check the Super Admin guard
            if (Auth::guard('super_admin')->check()) {
                
                $user = Auth::guard('super_admin')->user();

                // Prepare the data array
                $headerData = [
                    'name' => $user->name,
                    'profilePic' => $user->profilePic,
                    // Pass the name to the helper function
                    'initial' => $this->getInitial($user->name), 
                ];
            }
            
            // 💡 IMPORTANT: Always attach the variable, even if empty, to prevent Undefined Variable error.
            $view->with('headerData', $headerData);
        });
    }
    
    /**
     * Helper function to get the first letter of the name for the avatar.
     */
    protected function getInitial(string $name): string
    {
        // Get the first letter of the first word, cleaned and capitalized.
        return strtoupper(substr(trim($name), 0, 1));
    }
}