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
        Schema::table('hospitals', function (Blueprint $table) {
            // Drop the columns that are now stored in the 'users' table
            $table->dropColumn(['adminName', 'email', 'password']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            // Restore the columns if needed for rollback (optional, but good practice)
            $table->string('adminName')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
        });
    }
};
