<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. نبحث عن المستخدم باستخدام البريد الإلكتروني
        $user = User::where('email', 'admin@gmail.com')->first();

        // 2. إذا لم يكن المستخدم موجوداً، نقوم بإنشائه
        if (!$user) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '12345678', // سيتم تشفيرها تلقائياً بفضل الـ cast في الموديل
                'role' => 'admin',
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            // 3. إذا كان موجوداً، نخبرك بذلك بدلاً من إظهار خطأ
            $this->command->warn('Admin user already exists. Skipping...');
        }
    }
}