<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        // جيب كل اليوزرز بغض النظر عن الـ role
        $users = User::all();

        foreach ($users as $user) {
            Candidate::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => '01012345678',
                    'address' => 'Cairo',
                    'cv' => 'cv.pdf',
                    'bio' => 'Laravel Developer',
                    'experience_years' => rand(0, 7),
                ]
            );
        }
    }
}