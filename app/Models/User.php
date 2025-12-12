<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// === CRITICAL FIXES: Import the Relationship Types ===
use Illuminate\Database\Eloquent\Relations\HasOne; 
use Illuminate\Database\Eloquent\Relations\HasMany; 
// ====================================================
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'hospital_id',
        'is_active', // Assuming you added this in a previous migration/step
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // Assuming you added is_active to casts, if not, skip this line:
            'is_active' => 'boolean', 
        ];
    }

    /**
     * Get the hospital that owns the user (for admin/staff).
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Get the employee profile (one-to-one relationship).
     */
    public function employee(): HasOne 
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Get the custom salary components assigned to this user (one-to-many relationship).
     */
    public function employeeSalaryHead(): HasMany 
    {
        return $this->hasMany(EmployeeSalaryHead::class);
    }
}