<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Candidates
        for ($i = 1; $i <= 30; $i++) {
            User::create([
                'name' => "Candidate $i",
                'email' => "candidate$i@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ]);
        }
    }
}