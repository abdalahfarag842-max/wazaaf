<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            Candidate::create([
                'user_id' => $user->id,
                'phone' => '01012345678',
                'address' => 'Cairo',
                'cv' => 'cv.pdf',
                'bio' => 'Laravel Developer',
                'experience_years' => rand(0, 7),
            ]);
        }
    }
}