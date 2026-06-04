<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Fatima',
            'email' => 'fatima@blog.com',
            'password' => 'admin123',
        ]);
    }
}
