<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            // 🔑 Links to the User table (The authentication/login record)
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            
            // 🔑 Links to the Hospital (for multi-tenancy access control)
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Links to the Department
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');

            // Employee Specific Details
            $table->string('phone', 20)->nullable();
            $table->string('nid', 50)->unique()->nullable();
            $table->string('specialty', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('picture')->nullable(); // File path to profile image

            // Status is generally managed on the User model, but keeping this for easy filtering
            // $table->boolean('is_active')->default(true); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
