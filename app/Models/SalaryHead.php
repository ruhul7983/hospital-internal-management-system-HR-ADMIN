<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'name',
        'type',
        'calculation_type',
        'value',
        'is_basic',
        'is_editable',
    ];

    protected $casts = [
        'value' => 'float',
        'is_basic' => 'boolean',
        'is_editable' => 'boolean',
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}