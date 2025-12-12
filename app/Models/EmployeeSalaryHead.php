<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeSalaryHead extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'hospital_id',
        'user_id',
        'salary_head_id',
        'assigned_value',
        'week_off_day', // Added this field
    ];

    protected $casts = [
        'assigned_value' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function salaryHead(): BelongsTo
    {
        return $this->belongsTo(SalaryHead::class);
    }
}