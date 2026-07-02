<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Job;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    return view('admin.dashboard', [
        'jobsCount' => Job::count(),
        'candidatesCount' => Candidate::count(),
        'applicationsCount' => Application::count(),
        'categoriesCount' => Category::count(),

        // Applications Statistics
        'pendingApplications' => Application::where('status', 'pending')->count(),
        'reviewApplications' => Application::where('status', 'review')->count(),
        'acceptedApplications' => Application::where('status', 'accepted')->count(),
        'rejectedApplications' => Application::where('status', 'rejected')->count(),

        // Latest Jobs
        'latestJobs' => Job::latest()->take(10)->get(),

        // Latest Applications
        'latestApplications' => Application::with([
            'job',
            'candidate.user'
        ])->latest()->take(10)->get(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
