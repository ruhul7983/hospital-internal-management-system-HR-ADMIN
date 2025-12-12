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
        Schema::table('duty_assignments', function (Blueprint $table) {
            // New column for the department they are assigned to for this duty
            $table->foreignId('assigned_department_id')
                  ->nullable() // Must be nullable, as they might not be assigned (Not Assigned / On Leave)
                  ->after('shift_id')
                  ->constrained('departments')
                  ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('duty_assignments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('assigned_department_id');
        });
    }
};
