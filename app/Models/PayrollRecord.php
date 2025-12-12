<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'user_id',
        'year',
        'month',
        'gross_salary',
        'total_deductions',
        'net_pay',
        'status',
        'components',
    ];

    protected $casts = [
        'components' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }
}