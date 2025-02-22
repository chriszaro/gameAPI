<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manually creating specific users (for initial admin user, etc.)
        User::create([
            'username' => 'john57',
            'password' => Hash::make('password'), // Hash the password!
            'role' => 'Admin', // Or however you set the role
        ]);

        User::create([
            'username' => 'jane68',
            'password' => Hash::make('secret'), // Hash the password!
            'role' => 'Regular User', // Or however you set the role
        ]);
    }
}
