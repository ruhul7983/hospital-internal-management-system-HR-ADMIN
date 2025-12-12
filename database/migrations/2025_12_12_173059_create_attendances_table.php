<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // Multi-tenancy
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade');
            
            // User (Employee) who checked in
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            // Times
            $table->dateTime('check_in_at');
            $table->dateTime('check_out_at')->nullable();
            
            // Optional: Linked assignment ID for auditing (if needed)
            $table->foreignId('duty_assignment_id')->nullable()->constrained('duty_assignments')->onDelete('set null');
            
            $table->timestamps();

            // Constraint: A user can only check in once per day (optional, but prevents data errors)
            $table->unique(['user_id', 'hospital_id', 'check_in_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};