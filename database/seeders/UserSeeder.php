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
        $users = [
            [
                'name' => 'Administrator',
                'username' => 'admin123',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'Superadmin',
                'last_login_at' => now(),
            ],
            [
                'name' => 'Operator',
                'username' => 'operator2024',
                'email' => 'operator@gmail.com',
                'password' => Hash::make('operator123'),
                'role' => 'Admin',
                'last_login_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
