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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key to link to the hospital
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Shift details
            $table->string('name', 100);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('actor', 50)->comment('e.g., Doctor, Nurse, Staff');
            $table->unsignedSmallInteger('break_minutes')->default(0);
            $table->boolean('crosses_midnight')->default(false);
            
            $table->timestamps();

            // Constraint to ensure shift name is unique ONLY within a hospital
            $table->unique(['hospital_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
