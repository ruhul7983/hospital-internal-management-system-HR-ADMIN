<?php

// app/Models/Department.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    protected $fillable = [
        'hospital_id',
        'name',
        'description',
        'actor_types',
        'is_active',
    ];

    protected $casts = [
        'actor_types' => 'array', // Casts the JSON field to a PHP array
        'is_active' => 'boolean',
    ];

    /**
     * Get the hospital that owns the department.
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}