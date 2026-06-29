<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::insert([
            [
                'name' => 'Google',
                'email' => 'careers@google.com',
                'website' => 'https://google.com',
                'location' => 'Cairo',
                'description' => 'Leading technology company.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Microsoft',
                'email' => 'careers@microsoft.com',
                'website' => 'https://microsoft.com',
                'location' => 'Alexandria',
                'description' => 'Global software and cloud company.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amazon',
                'email' => 'jobs@amazon.com',
                'website' => 'https://amazon.com',
                'location' => 'Giza',
                'description' => 'E-commerce and cloud computing company.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}