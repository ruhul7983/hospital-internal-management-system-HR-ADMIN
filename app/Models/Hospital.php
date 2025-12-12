<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model 
{
    protected $fillable = [
        'hospitalName',
        'logo',
        'officialEmail', 
        'phone',
        'address',
    ];
    
    // Define a relationship to find the primary administrator (role = 'admin')
    public function administrator(): HasOne
    {
        return $this->hasOne(User::class)->where('role', 'admin');
    }

    // Define a relationship for all users (optional, but good practice)
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}