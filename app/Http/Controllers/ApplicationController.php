<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $candidate = Auth::user()->candidate;

        if (!$candidate) {
            $applications = collect();
        } else {
            $applications = Application::with(['job.category'])
                ->where('candidate_id', $candidate->id)
                ->latest()
                ->get();
        }

        return view('applications.index', compact('applications'));
    }

    public function create(Request $request)
    {
        $job = Job::with('category')->findOrFail($request->job_id);

        if ($job->status === 'closed') {
            return redirect()->route('jobs.show', $job)->with('error', 'This job is closed.');
        }

        return view('applications.create', compact('job'));
    }
public function store(Request $request)
{
    $request->validate([
            'job_id'           => 'required|exists:job_lists,id',
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:50',
            'cv'               => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter'     => 'nullable|string|max:2000',
        ]);

        $job = Job::findOrFail($request->job_id);
        $user = Auth::user();

        // Store or update candidate profile
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        $candidate = Candidate::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone'            => $request->phone,
                'address'          => $request->address,
                'experience_years' => $request->experience_years,
                'bio'              => $request->cover_letter,
                'cv'               => $cvPath ?? (optional($user->candidate)->cv),
            ]
        );

        // Check not already applied
        $alreadyApplied = Application::where('job_list_id', $job->id)
            ->where('candidate_id', $candidate->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->route('applications.index')
                ->with('success', 'You have already applied for this job.');
        }

        Application::create([
            'job_list_id'  => $job->id,
            'candidate_id' => $candidate->id,
            'cover_letter' => $request->cover_letter,
            'status'       => 'pending',
        ]);

        return redirect()->route('applications.index')
            ->with('success', 'Your application has been submitted successfully! ');
    }
}
