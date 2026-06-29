<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $companyIds = Company::pluck('id')->toArray();

        for ($i = 1; $i <= 40; $i++) {

            Job::create([
                'company_id' => fake()->randomElement($companyIds),

                'category_id' => rand(1, 8),
                'title' => "Job $i",
                'description' => "Description for Job $i",
                'salary' => rand(7000, 25000),
                'location' => 'Cairo',
                'job_type' => collect([
                    'full_time',
                    'part_time',
                    'remote',
                    'internship'
                ])->random(),
                'status' => collect([
                    'open',
                    'closed'
                ])->random(),
                'deadline' => now()->addDays(rand(10, 60)),
            ]);
        }
    }
}