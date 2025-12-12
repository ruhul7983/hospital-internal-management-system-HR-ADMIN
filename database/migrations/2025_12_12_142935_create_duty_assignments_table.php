<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('duty_assignments', function (Blueprint $table) {
            $table->id();

            // Multi-tenancy scope
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Employee being assigned
            // We link directly to the User table for login/role data
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            // The assigned shift (from the shifts table)
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->onDelete('set null');

            // The status of the employee for that day
            $table->enum('status', ['Assigned', 'Not Assigned', 'On Leave'])->default('Not Assigned');
            
            // The specific date of the assignment
            $table->date('date'); 

            $table->timestamps();

            // Constraint: A user can only have one status/shift per day within a hospital
            $table->unique(['hospital_id', 'user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('duty_assignments');
    }
};