<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'user_id',
        'shift_id',
        'assigned_department_id', // <-- NEW FIELD
        'status',
        'date',
    ];

    // ... (rest of the model code)

    // Add new relationship
    public function assignedDepartment()
    {
        return $this->belongsTo(Department::class, 'assigned_department_id');
    }
}