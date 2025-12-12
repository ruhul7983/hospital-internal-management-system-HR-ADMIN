<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            
            // Multi-tenancy
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Employee who submitted the request
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            // Leave details
            $table->string('type', 50); // e.g., Casual, Sick, Unpaid
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            
            // Approval Status (Managed by Hospital Admin)
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('rejection_reason')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};