<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'fatima@blog.com'],
            [
                'name' => 'Fatima',
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );

        // Manager user
        User::firstOrCreate(
            ['email' => 'manager@blog.com'],
            [
                'name' => 'Manager',
                'password' => 'manager123',
                'role' => 'manager',
            ]
        );

        // Client user
        User::firstOrCreate(
            ['email' => 'client@blog.com'],
            [
                'name' => 'Client',
                'password' => 'client123',
                'role' => 'client',
            ]
        );
    }
}
