<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_records', function (Blueprint $table) {
            $table->id();
            
            // Multi-tenancy scope
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Employee
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Period
            $table->year('year');
            $table->unsignedTinyInteger('month');
            
            // Financial Summary
            $table->decimal('gross_salary', 10, 2);
            $table->decimal('total_deductions', 10, 2);
            $table->decimal('net_pay', 10, 2);
            
            // Status (if paid or pending payment)
            $table->enum('status', ['Generated', 'Paid', 'Deleted'])->default('Generated');

            // Details of components (stores the calculated breakdown)
            $table->json('components'); 

            $table->timestamps();

            // Constraint: Only one payroll record per user per month
            $table->unique(['user_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_records');
    }
};