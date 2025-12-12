<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_heads', function (Blueprint $table) {
            $table->id();
            
            // Multi-tenancy scope
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            $table->string('name', 100);
            
            // Earning, Deduction, Allowance
            $table->enum('type', ['Earning', 'Deduction', 'Allowance']); 
            
            // Fixed or Percentage (based on Basic Salary or Gross Pay)
            $table->enum('calculation_type', ['Fixed', 'Percentage']); 
            
            // Value: stores the fixed amount or the percentage (e.g., 5000 or 0.40)
            $table->decimal('value', 10, 4); 
            
            // Flags for special handling
            $table->boolean('is_basic')->default(false);
            $table->boolean('is_editable')->default(false);
            
            $table->timestamps();

            // Constraint: Name must be unique within a hospital
            $table->unique(['hospital_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_heads');
    }
};