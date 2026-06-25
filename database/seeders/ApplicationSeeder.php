<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 150; $i++) {

            Application::create([
                'job_list_id' => Job::inRandomOrder()->first()->id,
                'candidate_id' => Candidate::inRandomOrder()->first()->id,
                'cover_letter' => 'I am interested in this job.',
                'status' => collect([
                    'pending',
                    'reviewed',
                    'accepted',
                    'rejected'
                ])->random(),
            ]);

        }
    }
}