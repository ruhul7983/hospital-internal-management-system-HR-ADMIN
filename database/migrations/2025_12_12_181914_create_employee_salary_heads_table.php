<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_salary_heads', function (Blueprint $table) {
            $table->id();
            
            // Multi-tenancy scope
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // Link to the specific employee user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            // Link to the configuration/type of head (Basic, HRA, PF, etc.)
            $table->foreignId('salary_head_id')->constrained('salary_heads')->onDelete('cascade');

            // The actual assigned value (fixed amount, or custom percentage amount)
            $table->decimal('assigned_value', 10, 2); 
            
            // The employee's primary week off day (stored here as part of their salary/schedule setup)
            $table->enum('week_off_day', ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'])->nullable();

            $table->timestamps();

            // Constraint: An employee can only have one value per salary head
            $table->unique(['user_id', 'salary_head_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_salary_heads');
    }
};