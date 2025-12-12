<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // avoid duplicate on repeated runs - use updateOrCreate
        SuperAdmin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Main Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'super-admin',
                'profilePic' => null,
            ]
        );
    }
}
