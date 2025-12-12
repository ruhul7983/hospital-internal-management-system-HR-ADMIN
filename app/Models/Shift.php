<?php

// app/Models/Shift.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'name',
        'start_time',
        'end_time',
        'actor',
        'break_minutes',
        'crosses_midnight',
    ];

    protected $casts = [
        'break_minutes' => 'integer',
        'crosses_midnight' => 'boolean',
    ];

    /**
     * Get the hospital that owns the shift.
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}