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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key to link to the hospital (Multi-tenancy)
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            $table->string('name', 100);
            $table->text('description')->nullable();
            
            // Storing actor types as a JSON array (or comma-separated string)
            $table->json('actor_types')->nullable(); 
            
            $table->boolean('is_active')->default(true); // Status toggle
            
            $table->timestamps();

            // Constraint: Department name must be unique ONLY within a hospital
            $table->unique(['hospital_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
