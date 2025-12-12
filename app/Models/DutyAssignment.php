<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Import BelongsTo

class DutyAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'user_id',
        'shift_id',
        'assigned_department_id',
        'status',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the shift associated with the duty assignment.
     * FIX: This method was required by the controller's ->with(['shift', ...]) call.
     */
    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
    
    /**
     * Get the department where the user is assigned for this duty.
     */
    public function assignedDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'assigned_department_id');
    }
    
    /**
     * Get the user (employee) assigned to this duty.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the hospital this duty belongs to.
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}